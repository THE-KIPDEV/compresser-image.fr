<?php
$title = $pageTitle ?? SITE_NAME;
$description = $pageDescription ?? SITE_DESC;
$path = strtok($_SERVER['REQUEST_URI'] ?? '/', '?');
$canonical = $canonicalUrl ?? SITE_URL . ($path === '/' ? '/' : rtrim($path, '/'));
$privatePage = preg_match('~^/(connexion|inscription|tableau-de-bord|paiement)(/|$)~', $path);
?>
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($description) ?>">
<meta name="robots" content="<?= $privatePage ? 'noindex, follow' : 'index, follow, max-image-preview:large' ?>">
<link rel="canonical" href="<?= e($canonical) ?>">

<!-- Open Graph -->
<meta property="og:type" content="website">
<meta property="og:title" content="<?= e($title) ?>">
<meta property="og:description" content="<?= e($description) ?>">
<meta property="og:url" content="<?= e($canonical) ?>">
<meta property="og:site_name" content="<?= e(SITE_NAME) ?>">
<meta property="og:image" content="<?= asset('images/og-image.png') ?>">
<meta property="og:locale" content="fr_FR">

<!-- Twitter -->
<meta name="twitter:card" content="summary_large_image">
<meta name="twitter:title" content="<?= e($title) ?>">
<meta name="twitter:description" content="<?= e($description) ?>">
<meta name="twitter:image" content="<?= asset('images/og-image.png') ?>">

<!-- JSON-LD -->
<script type="application/ld+json"><?= json_encode([
    '@context' => 'https://schema.org', '@type' => 'WebApplication',
    'name' => SITE_NAME, 'url' => SITE_URL, 'description' => $description,
    'applicationCategory' => 'MultimediaApplication', 'operatingSystem' => 'Web',
    'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'EUR'],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG) ?></script>
