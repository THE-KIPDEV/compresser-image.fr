<?php

class SeoController
{
    public function compresserPng(): void
    {
        $pageTitle = 'Compresser PNG en ligne gratuitement — Réduire taille PNG';
        $pageDescription = 'Compressez vos fichiers PNG gratuitement. Réduction jusqu\'à 80% sans perte de qualité visible. Outil en ligne rapide et sécurisé.';
        $extraCss = ['home.css', 'compressor.css', 'seo.css'];
        $extraJs = ['compressor.js'];
        $seoFormat = 'PNG';
        $seoSlug = 'compresser-png';

        view('seo/format', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs', 'seoFormat', 'seoSlug'));
    }

    public function compresserJpeg(): void
    {
        $pageTitle = 'Compresser JPEG en ligne gratuitement — Réduire taille JPG';
        $pageDescription = 'Compressez vos fichiers JPEG/JPG gratuitement. Réduction jusqu\'à 70% avec une qualité optimale. Outil en ligne rapide et sécurisé.';
        $extraCss = ['home.css', 'compressor.css', 'seo.css'];
        $extraJs = ['compressor.js'];
        $seoFormat = 'JPEG';
        $seoSlug = 'compresser-jpeg';

        view('seo/format', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs', 'seoFormat', 'seoSlug'));
    }

    public function compresserWebp(): void
    {
        $pageTitle = 'Compresser WebP en ligne gratuitement — Réduire taille WebP';
        $pageDescription = 'Compressez vos fichiers WebP gratuitement. Le format le plus performant pour le web. Outil en ligne rapide et sécurisé.';
        $extraCss = ['home.css', 'compressor.css', 'seo.css'];
        $extraJs = ['compressor.js'];
        $seoFormat = 'WebP';
        $seoSlug = 'compresser-webp';

        view('seo/format', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs', 'seoFormat', 'seoSlug'));
    }

    public function reduireTaille(): void
    {
        $pageTitle = 'Réduire la taille d\'une image en ligne — Gratuit et rapide';
        $pageDescription = 'Réduisez la taille de vos images en quelques secondes. PNG, JPEG, WebP supportés. Comparez avant/après avec notre slider interactif.';
        $extraCss = ['home.css', 'compressor.css', 'seo.css'];
        $extraJs = ['compressor.js'];

        view('seo/reduire-taille', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs'));
    }

    public function optimiserWeb(): void
    {
        $pageTitle = 'Optimiser vos images pour le web — Performance et SEO';
        $pageDescription = 'Optimisez vos images pour améliorer la vitesse de votre site web et votre SEO. Compression intelligente sans perte de qualité visible.';
        $extraCss = ['home.css', 'compressor.css', 'seo.css'];
        $extraJs = ['compressor.js'];

        view('seo/optimiser-web', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs'));
    }
}
