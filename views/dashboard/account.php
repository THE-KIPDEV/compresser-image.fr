<section class="dashboard-section">
    <div class="container container-sm">
        <h1>Mon compte</h1>

        <div class="account-card">
            <h2>Informations</h2>
            <div class="account-info">
                <div class="info-row">
                    <span class="info-label">Email</span>
                    <span class="info-value"><?= e($user['email']) ?></span>
                </div>
                <div class="info-row">
                    <span class="info-label">Plan</span>
                    <span class="info-value">
                        <?php if (isPro()): ?>
                            <span class="badge-pro">PRO</span>
                            <?php if ($user['plan_expires_at']): ?>
                                — Expire le <?= date('d/m/Y', strtotime($user['plan_expires_at'])) ?>
                            <?php endif; ?>
                        <?php else: ?>
                            Gratuit — <a href="<?= url('/tarifs') ?>">Passer en Pro</a>
                        <?php endif; ?>
                    </span>
                </div>
                <div class="info-row">
                    <span class="info-label">Inscrit depuis</span>
                    <span class="info-value"><?= date('d/m/Y', strtotime($user['created_at'])) ?></span>
                </div>
            </div>
        </div>

        <div class="account-card">
            <h2>Changer le mot de passe</h2>
            <form method="POST" action="<?= url('/tableau-de-bord/compte') ?>" class="auth-form">
                <?= csrfField() ?>
                <div class="form-group">
                    <label for="current_password">Mot de passe actuel</label>
                    <input type="password" id="current_password" name="current_password" required>
                </div>
                <div class="form-group">
                    <label for="new_password">Nouveau mot de passe</label>
                    <input type="password" id="new_password" name="new_password" required minlength="8">
                </div>
                <button type="submit" class="btn btn-primary">Mettre à jour</button>
            </form>
        </div>

        <a href="<?= url('/tableau-de-bord') ?>" class="btn btn-ghost">Retour au tableau de bord</a>
    </div>
</section>
