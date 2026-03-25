<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <?php partial('seo-head', get_defined_vars()); ?>
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
</head>
<body>
    <?php partial('header'); ?>
    <?php partial('flash'); ?>

    <main>
        <?= $content ?>
    </main>

    <?php partial('footer'); ?>

    <script src="<?= asset('js/app.js') ?>"></script>
    <?php if (!empty($extraJs)): foreach ((array)$extraJs as $js): ?>
        <script src="<?= asset('js/' . $js) ?>"></script>
    <?php endforeach; endif; ?>
</body>
</html>
