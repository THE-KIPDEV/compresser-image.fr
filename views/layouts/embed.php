<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= e($pageTitle ?? SITE_NAME) ?></title>
    <!-- Version embarquable : ne doit jamais concurrencer la page canonique. -->
    <meta name="robots" content="noindex">
    <link rel="canonical" href="<?= e(SITE_URL) ?>/">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/variables.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/global.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/responsive.css') ?>">
    <?php if (!empty($extraCss)): foreach ((array)$extraCss as $css): ?>
        <link rel="stylesheet" href="<?= asset('css/' . $css) ?>">
    <?php endforeach; endif; ?>
    <link rel="icon" type="image/svg+xml" href="<?= asset('images/favicon.svg') ?>">
    <!-- Pas de tracker kipstats ici : la page tourne en iframe sur des domaines tiers. -->
    <style>
        .embed-attribution { text-align: center; font-size: 0.78rem; color: var(--gray-500, #6b7280); padding: 12px 16px 20px; }
        .embed-attribution a { color: var(--primary, #4f46e5); font-weight: 600; text-decoration: none; }
        .embed-attribution a:hover { text-decoration: underline; }
    </style>
</head>
<body>
    <main>
        <?= $content ?>
    </main>

    <p class="embed-attribution">
        Outil fourni par
        <a href="<?= e(SITE_URL) ?>/" target="_top" rel="noopener">compresser-image.fr</a>
    </p>

    <?php /* pricingUrl vide : en iframe, rediriger vers /tarifs (X-Frame-Options) afficherait une page blanche. */ ?>
    <script>window.APP = { pro: <?= isPro() ? 'true' : 'false' ?>, loggedIn: <?= isLoggedIn() ? 'true' : 'false' ?>, pricingUrl: '', compressUrl: '<?= url('/api/compress') ?>' };</script>
    <?php if (!empty($extraJs)): foreach ((array)$extraJs as $js): ?>
        <script src="<?= asset('js/' . $js) ?>"></script>
    <?php endforeach; endif; ?>
</body>
</html>
