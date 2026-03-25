<?php

class PaymentController
{
    public function createCheckout(): void
    {
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            jsonResponse(['error' => 'Méthode non autorisée'], 405);
        }

        requireAuth();

        $user = currentUser();

        // Create Stripe Checkout Session via cURL
        $data = [
            'mode'                => 'subscription',
            'success_url'         => url('/paiement/succes') . '?session_id={CHECKOUT_SESSION_ID}',
            'cancel_url'          => url('/paiement/annule'),
            'customer_email'      => $user['email'],
            'client_reference_id' => (string) $user['id'],
            'line_items[0][price]'    => STRIPE_PRICE_PRO_MONTHLY,
            'line_items[0][quantity]' => 1,
        ];

        // If user already has a Stripe customer ID
        if (!empty($user['stripe_customer_id'])) {
            unset($data['customer_email']);
            $data['customer'] = $user['stripe_customer_id'];
        }

        $ch = curl_init('https://api.stripe.com/v1/checkout/sessions');
        curl_setopt_array($ch, [
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_POST           => true,
            CURLOPT_POSTFIELDS     => http_build_query($data),
            CURLOPT_HTTPHEADER     => [
                'Authorization: Bearer ' . STRIPE_SECRET_KEY,
            ],
        ]);

        $response = curl_exec($ch);
        $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        curl_close($ch);

        $session = json_decode($response, true);

        if ($httpCode !== 200 || empty($session['url'])) {
            jsonResponse(['error' => 'Erreur lors de la création du paiement.'], 500);
        }

        jsonResponse(['url' => $session['url']]);
    }

    public function webhook(): void
    {
        $payload = file_get_contents('php://input');
        $sigHeader = $_SERVER['HTTP_STRIPE_SIGNATURE'] ?? '';

        // Verify webhook signature
        $elements = explode(',', $sigHeader);
        $timestamp = null;
        $signatures = [];

        foreach ($elements as $element) {
            $parts = explode('=', $element, 2);
            if ($parts[0] === 't') $timestamp = $parts[1];
            if ($parts[0] === 'v1') $signatures[] = $parts[1];
        }

        if (!$timestamp || empty($signatures)) {
            http_response_code(400);
            exit;
        }

        $signedPayload = $timestamp . '.' . $payload;
        $expected = hash_hmac('sha256', $signedPayload, STRIPE_WEBHOOK_SECRET);

        $valid = false;
        foreach ($signatures as $sig) {
            if (hash_equals($expected, $sig)) {
                $valid = true;
                break;
            }
        }

        if (!$valid) {
            http_response_code(400);
            exit;
        }

        $event = json_decode($payload, true);
        $userModel = new User();

        switch ($event['type']) {
            case 'checkout.session.completed':
                $session = $event['data']['object'];
                $userId = (int) $session['client_reference_id'];
                $customerId = $session['customer'];

                $userModel->updatePlan($userId, 'pro', $customerId);
                break;

            case 'customer.subscription.deleted':
            case 'customer.subscription.updated':
                $subscription = $event['data']['object'];
                $customerId = $subscription['customer'];
                $user = $userModel->findByStripeCustomerId($customerId);

                if ($user) {
                    $status = $subscription['status'];
                    if ($status === 'active' || $status === 'trialing') {
                        $expiresAt = date('Y-m-d H:i:s', $subscription['current_period_end']);
                        $userModel->updatePlanExpiry($user['id'], $expiresAt);
                    } else {
                        $userModel->updatePlan($user['id'], 'free', $customerId);
                    }
                }
                break;

            case 'invoice.payment_failed':
                $invoice = $event['data']['object'];
                $customerId = $invoice['customer'];
                $user = $userModel->findByStripeCustomerId($customerId);
                if ($user) {
                    // Keep pro access until period ends, Stripe handles retry
                }
                break;
        }

        http_response_code(200);
        echo json_encode(['received' => true]);
        exit;
    }

    public function success(): void
    {
        flash('success', 'Paiement réussi ! Bienvenue dans Compresser Image Pro.');
        redirect(url('/tableau-de-bord'));
    }

    public function cancel(): void
    {
        flash('info', 'Paiement annulé.');
        redirect(url('/tarifs'));
    }
}
