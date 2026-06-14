<!-- Hero SEO -->
<section class="hero seo-hero">
    <div class="container">
        <h1><?= e($page['h1']) ?></h1>
        <p class="hero-sub"><?= e($page['subtitle']) ?></p>
        <div class="hero-formats">
            <span class="format-pill">PNG</span>
            <span class="format-pill">JPG</span>
            <span class="format-pill">WebP</span>
            <span class="format-pill-sep">gratuit · sans inscription</span>
        </div>
    </div>
</section>

<?php partial('compressor', ['widgetHint' => $page['widgetHint'] ?? null, 'widgetConfig' => $page['widget'] ?? []]); ?>

<!-- SEO Content -->
<section class="seo-content">
    <div class="container container-sm">
        <?= $page['intro'] ?>

        <?php if (!empty($page['how'])): ?>
            <h2>Comment <?= e(lcfirst($page['h1'])) ?> ?</h2>
            <ol class="seo-steps">
                <?php foreach ($page['how'] as $step): ?>
                    <li><strong><?= e($step[0]) ?>.</strong> <?= e($step[1]) ?></li>
                <?php endforeach; ?>
            </ol>
        <?php endif; ?>

        <?php if (!empty($page['faq'])): ?>
            <h2>Questions fréquentes</h2>
            <div class="seo-faq">
                <?php foreach ($page['faq'] as $qa): ?>
                    <details class="faq-item">
                        <summary><?= e($qa[0]) ?></summary>
                        <p><?= e($qa[1]) ?></p>
                    </details>
                <?php endforeach; ?>
            </div>
        <?php endif; ?>

        <?php if (!empty($related)): ?>
            <h2>Autres outils</h2>
            <ul class="seo-related">
                <?php foreach ($related as $r): ?>
                    <li><a href="<?= e($r['url']) ?>"><?= e($r['label']) ?></a></li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <!-- Encart affiliation Amazon -->
        <aside style="margin-top:var(--space-2xl);padding:var(--space-lg);background:var(--bg);border:1px solid var(--border);border-radius:var(--radius-lg);box-shadow:var(--shadow-sm);">
            <h2 style="font-size:1.1rem;margin-bottom:.4rem;">Matériel recommandé</h2>
            <p style="color:var(--text-secondary);line-height:1.6;margin-bottom:1rem;font-size:.95rem;">Vous compressez vos photos pour gagner de la place ? Pensez aussi à les sauvegarder sur un support fiable :</p>
            <div style="display:flex;flex-wrap:wrap;gap:.6rem;margin-bottom:1rem;">
                <a href="https://www.amazon.fr/s?k=disque+dur+externe&tag=yohannleskits-21" target="_blank" rel="sponsored nofollow noopener" style="display:inline-block;padding:.55rem 1rem;border:1px solid #FF9900;color:#b35900;border-radius:var(--radius-full);font-weight:600;font-size:.9rem;text-decoration:none;background:#fff8ef;">Disque dur externe</a>
                <a href="https://www.amazon.fr/s?k=SSD+externe&tag=yohannleskits-21" target="_blank" rel="sponsored nofollow noopener" style="display:inline-block;padding:.55rem 1rem;border:1px solid #FF9900;color:#b35900;border-radius:var(--radius-full);font-weight:600;font-size:.9rem;text-decoration:none;background:#fff8ef;">SSD externe</a>
                <a href="https://www.amazon.fr/s?k=cle+USB&tag=yohannleskits-21" target="_blank" rel="sponsored nofollow noopener" style="display:inline-block;padding:.55rem 1rem;border:1px solid #FF9900;color:#b35900;border-radius:var(--radius-full);font-weight:600;font-size:.9rem;text-decoration:none;background:#fff8ef;">Clé USB</a>
                <a href="https://www.amazon.fr/s?k=carte+memoire+SD&tag=yohannleskits-21" target="_blank" rel="sponsored nofollow noopener" style="display:inline-block;padding:.55rem 1rem;border:1px solid #FF9900;color:#b35900;border-radius:var(--radius-full);font-weight:600;font-size:.9rem;text-decoration:none;background:#fff8ef;">Carte mémoire SD</a>
            </div>
            <p style="color:var(--text-muted);font-size:.78rem;line-height:1.5;margin:0;">En tant que Partenaire Amazon, je réalise un bénéfice sur les achats remplissant les conditions requises. Liens sponsorisés.</p>
        </aside>
    </div>
</section>

<?php if (!empty($page['faq'])): ?>
<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@type'    => 'FAQPage',
    'mainEntity' => array_map(fn($qa) => [
        '@type'          => 'Question',
        'name'           => $qa[0],
        'acceptedAnswer' => ['@type' => 'Answer', 'text' => $qa[1]],
    ], $page['faq']),
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
<?php endif; ?>
