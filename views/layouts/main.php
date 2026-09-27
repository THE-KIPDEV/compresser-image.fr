<!DOCTYPE html>
<html lang="fr">
<head>
    <script src="https://orbeconsent.com/c/6807d17568bfc9f6.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php partial('seo-head', get_defined_vars()); ?>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="<?= asset('css/variables.css') ?>">
    <link rel="stylesheet" href="<?= asset('css/global.css') ?>">
    <?php if (!empty($extraCss)): foreach ((array)$extraCss as $css): ?>
        <link rel="stylesheet" href="<?= asset('css/' . $css) ?>">
    <?php endforeach; endif; ?>
    <link rel="stylesheet" href="<?= asset('css/responsive.css') ?>">

    <link rel="icon" type="image/svg+xml" href="<?= asset('images/favicon.svg') ?>">
    <script type="text/plain" data-consent="mesure" data-consent-svc="kipstats" defer src="https://kipstats.com/tracker.js" data-site="kp_ce7b7111"></script>
</head>
<body>
    <?php partial('header'); ?>
    <?php partial('flash'); ?>

    <main>
        <?= $content ?>
    </main>

    <?php partial('footer'); ?>

    <script>window.APP = { pro: <?= isPro() ? 'true' : 'false' ?>, loggedIn: <?= isLoggedIn() ? 'true' : 'false' ?>, pricingUrl: '<?= url('/tarifs') ?>', compressUrl: '<?= url('/api/compress') ?>' };</script>
    <script src="<?= asset('js/app.js') ?>"></script>
    <?php if (!empty($extraJs)): foreach ((array)$extraJs as $js): ?>
        <script src="<?= asset('js/' . $js) ?>"></script>
    <?php endforeach; endif; ?>
</body>
</html>
