<header class="site-header">
    <div class="container">
        <a href="<?= url('/') ?>" class="logo">
            <svg width="32" height="32" viewBox="0 0 32 32" fill="none" xmlns="http://www.w3.org/2000/svg">
                <rect width="32" height="32" rx="8" fill="url(#logo-grad)"/>
                <path d="M8 20L13 14L17 18L21 13L24 16" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                <circle cx="12" cy="12" r="2" fill="white" opacity="0.8"/>
                <path d="M7 22H25L22 26H10L7 22Z" fill="white" opacity="0.3"/>
                <defs>
                    <linearGradient id="logo-grad" x1="0" y1="0" x2="32" y2="32">
                        <stop stop-color="#6366f1"/>
                        <stop offset="1" stop-color="#8b5cf6"/>
                    </linearGradient>
                </defs>
            </svg>
            <span>Compresser<strong>Image</strong></span>
        </a>

        <nav class="nav-desktop">
            <a href="<?= url('/') ?>" class="nav-link">Compresser</a>
            <a href="<?= url('/tarifs') ?>" class="nav-link">Tarifs</a>
            <a href="<?= url('/compresser-png') ?>" class="nav-link">PNG</a>
            <a href="<?= url('/compresser-jpeg') ?>" class="nav-link">JPEG</a>
            <a href="<?= url('/compresser-webp') ?>" class="nav-link">WebP</a>
        </nav>

        <div class="nav-actions">
            <?php if (isLoggedIn()): ?>
                <?php if (isPro()): ?>
                    <span class="badge-pro">PRO</span>
                <?php endif; ?>
                <a href="<?= url('/tableau-de-bord') ?>" class="btn btn-ghost">Tableau de bord</a>
                <a href="<?= url('/deconnexion') ?>" class="btn btn-ghost">Déconnexion</a>
            <?php else: ?>
                <a href="<?= url('/connexion') ?>" class="btn btn-ghost">Connexion</a>
                <a href="<?= url('/inscription') ?>" class="btn btn-primary btn-sm">S'inscrire</a>
            <?php endif; ?>
        </div>

        <button class="burger" aria-label="Menu" onclick="document.body.classList.toggle('menu-open')">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>

    <nav class="nav-mobile">
        <a href="<?= url('/') ?>">Compresser</a>
        <a href="<?= url('/tarifs') ?>">Tarifs</a>
        <a href="<?= url('/compresser-png') ?>">PNG</a>
        <a href="<?= url('/compresser-jpeg') ?>">JPEG</a>
        <a href="<?= url('/compresser-webp') ?>">WebP</a>
        <div class="nav-mobile-actions">
            <?php if (isLoggedIn()): ?>
                <a href="<?= url('/tableau-de-bord') ?>" class="btn btn-primary">Tableau de bord</a>
                <a href="<?= url('/deconnexion') ?>" class="btn btn-ghost">Déconnexion</a>
            <?php else: ?>
                <a href="<?= url('/connexion') ?>" class="btn btn-ghost">Connexion</a>
                <a href="<?= url('/inscription') ?>" class="btn btn-primary">S'inscrire gratuitement</a>
            <?php endif; ?>
        </div>
    </nav>
</header>
