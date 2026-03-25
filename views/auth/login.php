<section class="auth-section">
    <div class="container container-xs">
        <div class="auth-card">
            <h1>Connexion</h1>
            <p class="auth-subtitle">Accédez à votre compte pour gérer vos compressions.</p>

            <form method="POST" action="<?= url('/connexion') ?>" class="auth-form">
                <?= csrfField() ?>
                <div class="form-group">
                    <label for="email">Email</label>
                    <input type="email" id="email" name="email" required autofocus placeholder="votre@email.com">
                </div>
                <div class="form-group">
                    <label for="password">Mot de passe</label>
                    <input type="password" id="password" name="password" required placeholder="Votre mot de passe">
                </div>
                <button type="submit" class="btn btn-primary btn-lg btn-block">Se connecter</button>
            </form>

            <p class="auth-link">Pas encore de compte ? <a href="<?= url('/inscription') ?>">S'inscrire gratuitement</a></p>
        </div>
    </div>
</section>
