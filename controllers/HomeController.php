<?php

class HomeController
{
    public function index(): void
    {
        $pageTitle = 'Compresser vos images gratuitement en ligne — PNG, JPEG, WebP';
        $pageDescription = 'Compressez vos images gratuitement en ligne. Réduisez jusqu\'à 80% la taille de vos fichiers PNG, JPEG et WebP sans perte de qualité visible. Comparez avant/après avec notre slider interactif.';
        $extraCss = ['home.css', 'compressor.css'];
        $extraJs = ['compressor.js'];

        view('home/index', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs'));
    }

    public function pricing(): void
    {
        $pageTitle = 'Tarifs — Compresser Image Pro';
        $pageDescription = 'Découvrez nos offres pour compresser vos images. Gratuit pour un usage basique, Pro à 4.90€/mois pour la compression maximale et le traitement par lot.';
        $extraCss = ['home.css'];

        view('home/pricing', compact('pageTitle', 'pageDescription', 'extraCss'));
    }

    public function legal(): void
    {
        $pageTitle = 'Mentions légales — Compresser Image';
        view('home/legal', compact('pageTitle'));
    }

    public function privacy(): void
    {
        $pageTitle = 'Politique de confidentialité — Compresser Image';
        view('home/privacy', compact('pageTitle'));
    }

    public function terms(): void
    {
        $pageTitle = 'Conditions générales d\'utilisation — Compresser Image';
        view('home/terms', compact('pageTitle'));
    }
}
