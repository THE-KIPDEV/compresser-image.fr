<footer class="site-footer">
    <div class="container">
        <div class="footer-grid">
            <div class="footer-brand">
                <a href="<?= url('/') ?>" class="logo">
                    <svg width="28" height="28" viewBox="0 0 32 32" fill="none">
                        <rect width="32" height="32" rx="8" fill="url(#logo-grad2)"/>
                        <path d="M8 20L13 14L17 18L21 13L24 16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="12" cy="12" r="2" fill="white" opacity="0.8"/>
                        <defs><linearGradient id="logo-grad2" x1="0" y1="0" x2="32" y2="32"><stop stop-color="#6366f1"/><stop offset="1" stop-color="#8b5cf6"/></linearGradient></defs>
                    </svg>
                    <span>CompresserImage</span>
                </a>
                <p>Compressez vos images gratuitement, directement dans votre navigateur. Rapide, sécurisé, sans inscription.</p>
            </div>

            <div class="footer-links">
                <h4>Outils</h4>
                <a href="<?= url('/compresser-png') ?>">Compresser PNG</a>
                <a href="<?= url('/compresser-jpeg') ?>">Compresser JPEG</a>
                <a href="<?= url('/compresser-webp') ?>">Compresser WebP</a>
                <a href="<?= url('/reduire-taille-image') ?>">Réduire taille image</a>
                <a href="<?= url('/optimiser-image-web') ?>">Optimiser pour le web</a>
            </div>

            <div class="footer-links">
                <h4>Compte</h4>
                <a href="<?= url('/tarifs') ?>">Tarifs</a>
                <a href="<?= url('/connexion') ?>">Connexion</a>
                <a href="<?= url('/inscription') ?>">Inscription</a>
            </div>

            <div class="footer-links">
                <h4>Légal</h4>
                <a href="<?= url('/mentions-legales') ?>">Mentions légales</a>
                <a href="<?= url('/politique-de-confidentialite') ?>">Confidentialité</a>
                <a href="<?= url('/cgu') ?>">CGU</a>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; <?= date('Y') ?> compresser-image.fr — Tous droits réservés.</p>
        </div>
    </div>
</footer>
