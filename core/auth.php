<?php

function loginUser(array $user): void
{
    $_SESSION['user_id'] = $user['id'];
    session_regenerate_id(true);
}

function logoutUser(): void
{
    $_SESSION = [];
    if (ini_get('session.use_cookies')) {
        $params = session_get_cookie_params();
        setcookie(session_name(), '', time() - 42000,
            $params['path'], $params['domain'],
            $params['secure'], $params['httponly']
        );
    }
    session_destroy();
}

function requireAuth(): void
{
    if (!isLoggedIn()) {
        flash('error', 'Vous devez être connecté.');
        redirect(url('/connexion'));
    }
}

function requirePro(): void
{
    requireAuth();
    if (!isPro()) {
        flash('error', 'Cette fonctionnalité nécessite un abonnement Pro.');
        redirect(url('/tarifs'));
    }
}
