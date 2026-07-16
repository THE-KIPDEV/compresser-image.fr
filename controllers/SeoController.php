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

    /**
     * /reduire-taille-png — requête à double intention (poids OU dimensions).
     * Page dédiée avec son propre encodeur PNG-8 (public/js/png-reducer.js) :
     * contrairement au compresseur générique, la sortie reste un PNG.
     */
    public function reduireTaillePng(): void
    {
        $pageTitle       = 'Réduire la taille d\'un PNG : poids ou dimensions ? Guide 2026';
        $pageDescription = 'Réduire un PNG en Ko/Mo ou en pixels : nos mesures réelles par palette (256 à 16 couleurs), la sortie reste en PNG, transparence conservée. Gratuit, sans upload.';
        $extraCss        = ['home.css', 'compressor.css', 'seo.css', 'png-reducer.css'];
        $extraJs         = ['png-reducer.js'];

        // FAQ affichée en HTML + reprise en JSON-LD FAQPage par la vue.
        // (Les réponses acceptent un peu de HTML pour les liens internes.)
        $faq = [
            [
                'Réduire la taille d\'un PNG sans perte de qualité, c\'est possible ?',
                'Oui, mais « sans perte » a deux sens. Optimiser un PNG sans rien toucher aux pixels (retirer les métadonnées, recompresser plus finement) ne rapporte que quelques pourcents. Réduire le nombre de couleurs fait gagner 70 à 85 % sur un logo ou une capture, mais c\'est une perte : la palette est plus petite. Sur nos mesures, à 256 couleurs l\'écart avec l\'original est de 2,7/255 sur un logo — invisible en pratique, mais ce n\'est pas du sans perte au sens strict.',
            ],
            [
                'La transparence de mon PNG est-elle conservée ?',
                'Oui. L\'outil écrit la transparence dans un chunk tRNS, entrée de palette par entrée de palette, et le damier gris affiché sous chaque résultat vous le montre directement. Une réserve honnête : en dessous de 64 couleurs, la palette manque de place pour les demi-transparences des contours antialiasés, et les bords deviennent crénelés. Restez à 128 ou 256 couleurs pour un logo à bords lisses.',
            ],
            [
                'Pourquoi mon PNG ne descend pas, ou grossit ?',
                'C\'est presque toujours un dégradé ou une photo. Ces images n\'ont pas de couleurs répétées à factoriser : la quantification remplace une progression régulière (que les filtres PNG adorent) par des index qui sautent à chaque bande, et le fichier peut grossir. Notre dégradé de test passe de 9,3 à 13,8 Ko en 256 couleurs. Dans ce cas l\'outil vous rend l\'original intact — et la vraie solution est de convertir en JPG ou en WebP.',
            ],
            [
                'Quelle est la différence avec la page Compresser PNG ?',
                'Le compresseur générique ré-encode les PNG en WebP : c\'est plus efficace, mais le fichier change d\'extension. Cette page garde du PNG en sortie, expose le nombre de couleurs et ajoute un mode « poids maximal ». Utilisez-la quand vous avez besoin que le résultat reste un vrai fichier .png.',
            ],
            [
                'PNG ou WebP, lequel choisir ?',
                'Le WebP est plus léger que le PNG à qualité visuelle égale, et il gère la transparence lui aussi. Tous les navigateurs le lisent depuis 2020. Le PNG garde l\'avantage sur les vieux logiciels de bureau et certains formulaires administratifs qui refusent encore le WebP. Pour le web, WebP ; pour un dépôt de dossier, PNG.',
            ],
            [
                'Combien de PNG puis-je traiter d\'un coup ?',
                '10 fichiers, 10 Mo chacun. Cette limite n\'est pas commerciale : tout le traitement se fait dans la mémoire de votre onglet, et au-delà les navigateurs commencent à ramer sérieusement.',
            ],
        ];

        view('seo/reduire-taille-png', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs', 'faq'));
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

    /** Load the programmatic SEO landing-page definitions. */
    private function pages(): array
    {
        static $pages = null;
        if ($pages === null) {
            $pages = require CONFIG_PATH . '/seo-pages.php';
        }
        return $pages;
    }

    /**
     * Generic, data-driven SEO landing page. One slug = one search query,
     * all powered by the same compressor (see config/seo-pages.php).
     */
    public function landing(string $slug): void
    {
        $pages = $this->pages();
        if (!isset($pages[$slug])) {
            error404();
            return;
        }
        $page = $pages[$slug];

        // Internal mesh: sibling tools (deterministic, starting after this slug)
        // plus the format pages, for a stable crawlable link graph.
        $slugs   = array_keys($pages);
        $pos     = array_search($slug, $slugs, true);
        $ordered = array_merge(array_slice($slugs, $pos + 1), array_slice($slugs, 0, $pos));
        $related = [];
        foreach (array_slice($ordered, 0, 5) as $s) {
            $related[] = ['url' => url('/' . $s), 'label' => $pages[$s]['h1']];
        }
        $related[] = ['url' => url('/compresser-png'),  'label' => 'Compresser PNG'];
        $related[] = ['url' => url('/compresser-webp'), 'label' => 'Compresser WebP'];

        $pageTitle       = $page['title'];
        $pageDescription = $page['description'];
        $extraCss        = ['home.css', 'compressor.css', 'seo.css'];
        $extraJs         = ['compressor.js'];

        view('seo/landing', compact('page', 'slug', 'related', 'pageTitle', 'pageDescription', 'extraCss', 'extraJs'));
    }

    /**
     * Dynamic robots.txt (references the sitemap, built from SITE_URL).
     */
    public function robots(): void
    {
        header('Content-Type: text/plain; charset=utf-8');
        $lines = [
            'User-agent: *',
            'Allow: /',
            'Disallow: /api/',
            'Disallow: /uploads/',
            'Disallow: /tableau-de-bord',
            'Disallow: /connexion',
            'Disallow: /inscription',
            'Disallow: /paiement/',
            '',
            'Sitemap: ' . SITE_URL . '/sitemap.xml',
            '',
        ];
        echo implode("\n", $lines);
        exit;
    }

    /**
     * Dynamic sitemap.xml listing every public, indexable page.
     */
    public function sitemap(): void
    {
        // path => changefreq, priority
        $urls = [
            '/'                              => ['weekly',  '1.0'],
            '/tarifs'                        => ['monthly', '0.8'],
            '/compresser-png'                => ['monthly', '0.9'],
            '/compresser-jpeg'               => ['monthly', '0.9'],
            '/compresser-webp'               => ['monthly', '0.9'],
            '/reduire-taille-image'          => ['monthly', '0.9'],
            '/reduire-taille-png'            => ['monthly', '0.9'],
            '/optimiser-image-web'           => ['monthly', '0.9'],
        ];
        // Programmatic SEO landing pages.
        foreach (array_keys($this->pages()) as $slug) {
            $urls['/' . $slug] = ['monthly', '0.8'];
        }
        $urls += [
            '/mentions-legales'              => ['yearly',  '0.3'],
            '/politique-de-confidentialite'  => ['yearly',  '0.3'],
            '/cgu'                           => ['yearly',  '0.3'],
        ];

        header('Content-Type: application/xml; charset=utf-8');
        echo '<?xml version="1.0" encoding="UTF-8"?>' . "\n";
        echo '<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">' . "\n";
        foreach ($urls as $path => [$freq, $priority]) {
            echo "  <url>\n";
            echo '    <loc>' . e(SITE_URL . $path) . "</loc>\n";
            echo "    <changefreq>$freq</changefreq>\n";
            echo "    <priority>$priority</priority>\n";
            echo "  </url>\n";
        }
        echo '</urlset>';
        exit;
    }
}
