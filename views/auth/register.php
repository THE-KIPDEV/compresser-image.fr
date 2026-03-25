<section class="auth-section">
    <div class="container container-xs">
        <div class="auth-card">
            <h1>Créer un compte</h1>
            <p class="auth-subtitle">Inscrivez-vous pour accéder aux fonctionnalités Pro et à votre historique.</p>

            <form method="POST" action="<?= url('/inscription') ?>" class="auth-form">
                <?= csrfField() ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required autofocus placeholder="votre@email.com">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required minlength="8" placeholder="Minimum 8 caractères">
                </div>
                <div class="form-group">
                    <label for="password_confirm">Confirmer le mot de passe</label>
                    <input type="password" id="password_confirm" name="password_confirm" required minlength="8" placeholder="Confirmez votre mot de passe">
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Créer mon compte</button>
            </form>

            <p class="auth-link">Déjà un compte ? <a href="<?= url('/connexion') ?>">Se connecter</a></p>
        </div>
    </div>
</section>
