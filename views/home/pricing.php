<section class="pricing-hero">
    <div class="container">
        <h1>Des images plus légères,<br><span class="gradient-text">un site plus rapide</span></h1>
        <p class="hero-sub">Choisissez l'offre qui vous convient. Commencez gratuitement, passez en Pro quand vous en avez besoin.</p>
    </div>
</section>

<section class="pricing-section">
    <div class="container">
        <div class="pricing-grid">
            <!-- Free -->
            <div class="pricing-card">
                <div class="pricing-header">
                    <h3>Gratuit</h3>
                    <p class="pricing-desc">Pour un usage occasionnel</p>
                    <div class="pricing-price">
                        <span class="price">0€</span>
                        <span class="price-period">pour toujours</span>
                    </div>
                </div>
                <ul class="pricing-features">
                    <li class="included">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 9L7.5 12.5L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Compression illimitée
                    </li>
                    <li class="included">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 9L7.5 12.5L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        PNG, JPEG, WebP
                    </li>
                    <li class="included">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 9L7.5 12.5L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Slider avant/après
                    </li>
                    <li class="included">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 9L7.5 12.5L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Jusqu'à 10 images par lot
                    </li>
                    <li class="included">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 9L7.5 12.5L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Max 10 Mo par image
                    </li>
                    <li class="excluded">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M5 5L13 13M13 5L5 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        Méga compression serveur
                    </li>
                    <li class="excluded">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M5 5L13 13M13 5L5 13" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                        Historique de compressions
                    </li>
                </ul>
                <a href="<?= url('/') ?>" class="btn btn-ghost btn-lg btn-block">Commencer gratuitement</a>
            </div>

            <!-- Pro -->
            <div class="pricing-card pricing-card-featured">
                <div class="pricing-badge">Populaire</div>
                <div class="pricing-header">
                    <h3>Pro</h3>
                    <p class="pricing-desc">Pour les professionnels du web</p>
                    <div class="pricing-price">
                        <span class="price">4,90€</span>
                        <span class="price-period">/mois</span>
                    </div>
                </div>
                <ul class="pricing-features">
                    <li class="included">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 9L7.5 12.5L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Tout le plan Gratuit
                    </li>
                    <li class="included highlight">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 9L7.5 12.5L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        <strong>Méga compression serveur (-90%)</strong>
                    </li>
                    <li class="included">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 9L7.5 12.5L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        100 images par lot
                    </li>
                    <li class="included">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 9L7.5 12.5L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Max 50 Mo par image
                    </li>
                    <li class="included">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 9L7.5 12.5L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Historique de compressions
                    </li>
                    <li class="included">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 9L7.5 12.5L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Sans publicité
                    </li>
                    <li class="included">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M4 9L7.5 12.5L14 6" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Support prioritaire
                    </li>
                </ul>
                <?php if (isLoggedIn()): ?>
                    <button class="btn btn-primary btn-lg btn-block" onclick="createCheckout()">S'abonner — 4,90€/mois</button>
                <?php else: ?>
                    <a href="<?= url('/inscription') ?>" class="btn btn-primary btn-lg btn-block">Créer un compte Pro</a>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
<script>
function createCheckout() {
    fetch('<?= url('/api/create-checkout') ?>', {
        method: 'POST',
        headers: { 'Content-Type': 'application/x-www-form-urlencoded', 'X-Csrf-Token': '<?= csrfToken() ?>' },
    })
    .then(r => r.json())
    .then(data => { if (data.url) window.location.href = data.url; else alert(data.error); })
    .catch(() => alert('Erreur lors du paiement.'));
}
</script>
