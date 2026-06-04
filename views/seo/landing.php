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
