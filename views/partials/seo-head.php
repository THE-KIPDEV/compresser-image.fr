<?php
$title = $pageTitle ?? SITE_NAME;
$description = $pageDescription ?? SITE_DESC;
$canonical = $canonicalUrl ?? SITE_URL . ($_SERVER['REQUEST_URI'] === '/' ? '' : $_SERVER['REQUEST_URI']);
?>
<title><?= e($title) ?></title>
<meta name="description" content="<?= e($description) ?>">
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
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "WebApplication",
    "name": "<?= e(SITE_NAME) ?>",
    "url": "<?= e(SITE_URL) ?>",
    "description": "<?= e($description) ?>",
    "applicationCategory": "MultimediaApplication",
    "operatingSystem": "Web",
    "offers": {
        "@type": "Offer",
        "price": "0",
        "priceCurrency": "EUR"
    }
}
</script>
