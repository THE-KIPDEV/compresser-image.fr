<?php

class DashboardController
{
    public function index(): void
    {
        requireAuth();

        $user = currentUser();
        $compression = new Compression();
        $stats = $compression->getUserStats(currentUserId());
        $recent = $compression->getRecent(currentUserId(), 20);

        $pageTitle = 'Tableau de bord — Compresser Image';
        $extraCss = ['dashboard.css'];

        view('dashboard/index', compact('pageTitle', 'extraCss', 'user', 'stats', 'recent'));
    }

    public function account(): void
    {
        requireAuth();

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            requireCsrf();

            $userModel = new User();
            $currentPassword = input('current_password');
            $newPassword = input('new_password');

            $user = currentUser();

            if ($currentPassword && $newPassword) {
                if (!password_verify($currentPassword, $user['password'])) {
                    flash('error', 'Mot de passe actuel incorrect.');
                    redirect(url('/tableau-de-bord/compte'));
                }

                if (strlen($newPassword) < 8) {
                    flash('error', 'Le nouveau mot de passe doit faire au moins 8 caractères.');
                    redirect(url('/tableau-de-bord/compte'));
                }

                $userModel->updatePassword(currentUserId(), $newPassword);
                flash('success', 'Mot de passe mis à jour.');
            }

            redirect(url('/tableau-de-bord/compte'));
        }

        $user = currentUser();
        $pageTitle = 'Mon compte — Compresser Image';
        $extraCss = ['dashboard.css', 'auth.css'];

        view('dashboard/account', compact('pageTitle', 'extraCss', 'user'));
    }
}
