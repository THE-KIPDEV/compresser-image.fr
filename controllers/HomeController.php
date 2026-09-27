<?php

class HomeController
{
    public function index(): void
    {
        $pageTitle = 'Compresser vos images gratuitement en ligne — PNG, JPEG, WebP';
        $pageDescription = 'Compressez vos images PNG, JPEG et WebP en ligne. 3 images gratuites par jour : réglez la qualité et comparez le résultat avant de télécharger.';
        $extraCss = ['home.css', 'compressor.css'];
        $extraJs = ['png8-encoder.js', 'compressor.js'];

        view('home/index', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs'));
    }

    /**
     * Version embarquable du compresseur (iframe sur des sites tiers).
     * Outil seul, sans header/footer ni tracker, avec lien d'attribution
     * en dur vers la page d'accueil (voir layouts/embed.php).
     */
    public function embed(): void
    {
        $pageTitle = 'Compresseur d\'images — PNG, JPEG, WebP';
        $extraCss = ['home.css', 'compressor.css'];
        $extraJs = ['png8-encoder.js', 'compressor.js'];

        view('home/embed', compact('pageTitle', 'extraCss', 'extraJs'), 'embed');
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
