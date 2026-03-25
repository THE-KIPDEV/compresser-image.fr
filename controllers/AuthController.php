<?php

class AuthController
{
    public function login(): void
    {
        if (isLoggedIn()) {
            redirect(url('/tableau-de-bord'));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            requireCsrf();

            $email = input('email');
            $password = input('password');

            if (!$email || !$password) {
                flash('error', 'Veuillez remplir tous les champs.');
                redirect(url('/connexion'));
            }

            $userModel = new User();
            $user = $userModel->findByEmail($email);

            if (!$user || !password_verify($password, $user['password'])) {
                flash('error', 'Email ou mot de passe incorrect.');
                redirect(url('/connexion'));
            }

            loginUser($user);
            flash('success', 'Connexion réussie !');
            redirect(url('/tableau-de-bord'));
        }

        $pageTitle = 'Connexion — Compresser Image';
        $extraCss = ['auth.css'];
        view('auth/login', compact('pageTitle', 'extraCss'));
    }

    public function register(): void
    {
        if (isLoggedIn()) {
            redirect(url('/tableau-de-bord'));
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            requireCsrf();

            $email = input('email');
            $password = input('password');
            $passwordConfirm = input('password_confirm');

            if (!$email || !$password) {
                flash('error', 'Veuillez remplir tous les champs.');
                redirect(url('/inscription'));
            }

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                flash('error', 'Adresse email invalide.');
                redirect(url('/inscription'));
            }

            if (strlen($password) < 8) {
                flash('error', 'Le mot de passe doit faire au moins 8 caractères.');
                redirect(url('/inscription'));
            }

            if ($password !== $passwordConfirm) {
                flash('error', 'Les mots de passe ne correspondent pas.');
                redirect(url('/inscription'));
            }

            $userModel = new User();
            if ($userModel->findByEmail($email)) {
                flash('error', 'Cette adresse email est déjà utilisée.');
                redirect(url('/inscription'));
            }

            $userId = $userModel->create($email, $password);
            loginUser(['id' => $userId]);
            flash('success', 'Compte créé avec succès !');
            redirect(url('/tableau-de-bord'));
        }

        $pageTitle = 'Inscription — Compresser Image';
        $extraCss = ['auth.css'];
        view('auth/register', compact('pageTitle', 'extraCss'));
    }

    public function logout(): void
    {
        logoutUser();
        flash('success', 'Vous êtes déconnecté.');
        redirect(url('/'));
    }
}
