<?php

class SeoController
{
    public function compresserPng(): void
    {
        $pageTitle = 'Compresser PNG en ligne gratuitement — Réduire taille PNG';
        $pageDescription = 'Compressez vos fichiers PNG gratuitement. Réduction jusqu\'à 80% sans perte de qualité visible. Outil en ligne rapide et sécurisé.';
        $extraCss = ['home.css', 'compressor.css', 'seo.css'];
        $extraJs = ['png8-encoder.js', 'compressor.js'];
        $seoFormat = 'PNG';
        $seoSlug = 'compresser-png';

        view('seo/format', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs', 'seoFormat', 'seoSlug'));
    }

    public function compresserJpeg(): void
    {
        $pageTitle = 'Compresser JPEG en ligne gratuitement — Réduire taille JPG';
        $pageDescription = 'Compressez vos fichiers JPEG/JPG gratuitement. Réduction jusqu\'à 70% avec une qualité optimale. Outil en ligne rapide et sécurisé.';
        $extraCss = ['home.css', 'compressor.css', 'seo.css'];
        $extraJs = ['png8-encoder.js', 'compressor.js'];
        $seoFormat = 'JPEG';
        $seoSlug = 'compresser-jpeg';

        view('seo/format', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs', 'seoFormat', 'seoSlug'));
    }

    public function compresserWebp(): void
    {
        $pageTitle = 'Compresser WebP en ligne gratuitement — Réduire taille WebP';
        $pageDescription = 'Compressez vos fichiers WebP gratuitement. Le format le plus performant pour le web. Outil en ligne rapide et sécurisé.';
        $extraCss = ['home.css', 'compressor.css', 'seo.css'];
        $extraJs = ['png8-encoder.js', 'compressor.js'];
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

    /**
     * /convertir-heic-en-jpg — seul cluster que le site ne pouvait pas servir :
     * le sélecteur refusait les HEIC (photos iPhone). Page dédiée + décodage HEIC
     * 100 % navigateur (public/js/heic-decode.js → libheif WASM), sortie JPG.
     */
    public function convertirHeicJpg(): void
    {
        $pageTitle       = 'Convertir HEIC en JPG en ligne — sans uploader vos photos';
        $pageDescription = 'Convertissez vos photos iPhone HEIC en JPG directement dans le navigateur, rien n\'est envoyé sur un serveur. EXIF et géolocalisation supprimés, lot de 10, gratuit et sans inscription.';
        $extraCss        = ['home.css', 'compressor.css', 'seo.css'];
        // heic-decode.js charge libheif (WASM) à la demande, au 1er HEIC déposé.
        $extraJs         = ['png8-encoder.js', 'heic-decode.js', 'compressor.js'];

        // FAQ affichée en HTML + reprise en JSON-LD FAQPage par la vue.
        $faq = [
            [
                'Pourquoi mon iPhone enregistre-t-il en HEIC et pas en JPG ?',
                'Depuis iOS 11 (2017), Apple stocke les photos en HEIC : c\'est un conteneur qui compresse avec le codec HEVC (H.265), le même que la vidéo 4K. À qualité égale, une photo HEIC pèse environ deux fois moins qu\'un JPEG. Le revers, c\'est la compatibilité : Windows, Android et beaucoup de sites ne savent pas ouvrir un .heic. Vous pouvez d\'ailleurs demander à l\'iPhone de photographier directement en JPG (Réglages → Appareil photo → Formats → « Le plus compatible »), mais ça ne convertit pas les photos déjà prises.',
            ],
            [
                'La conversion garde-t-elle la qualité de la photo ?',
                'Oui. On décode le HEIC à sa résolution d\'origine (une photo d\'iPhone récent fait autour de 4032 × 3024 px, soit 12 mégapixels) puis on ré-encode en JPG à qualité 90 %. À l\'œil, aucune différence. Un JPG reste plus gros qu\'un HEIC à qualité identique, c\'est le prix de la compatibilité universelle : comptez en gros deux fois le poids du HEIC de départ.',
            ],
            [
                'Mes photos sont-elles envoyées sur un serveur ?',
                'Non, et c\'est toute la différence avec Convertio, iLoveIMG ou heictojpg. Le décodage HEIC tourne dans votre navigateur, via une version de la bibliothèque libheif compilée en WebAssembly. Aucun octet de vos photos ne part sur Internet. Preuve concrète : chargez la page, coupez le Wi-Fi, déposez vos HEIC — la conversion marche toujours.',
            ],
            [
                'Les données EXIF et la géolocalisation sont-elles conservées ?',
                'Non, et sur une photo iPhone c\'est plutôt une bonne nouvelle. Un HEIC embarque la date, le modèle d\'appareil et surtout les coordonnées GPS de l\'endroit exact où la photo a été prise. Notre conversion passe par un canvas, qui ne recopie que les pixels : le JPG produit ne contient plus aucune métadonnée. Vous pouvez partager la photo sans diffuser l\'adresse de votre domicile.',
            ],
            [
                'Puis-je convertir plusieurs HEIC d\'un coup ?',
                'Oui, jusqu\'à 10 photos par lot, avec un bouton « Tout télécharger ». La limite n\'est pas commerciale : le décodage HEVC est gourmand et tout se passe dans la mémoire de votre onglet. Au-delà, un téléphone d\'entrée de gamme commence à ramer. Pour une pellicule entière, procédez par paquets de 10.',
            ],
            [
                'Quels logiciels lisent le JPG une fois converti ?',
                'Tous. Le JPEG est normalisé depuis 1992 (ISO/IEC 10918-1) et il n\'existe aucun système, site ou imprimante qui ne le lise pas : Windows, Android, un formulaire administratif, une pièce jointe d\'e-mail, un site de petites annonces. C\'est exactement pour ça qu\'on convertit vers le JPG plutôt que de laisser vos photos en HEIC.',
            ],
            [
                'Faut-il installer une application ou créer un compte ?',
                'Ni l\'un ni l\'autre. La page est l\'outil : vous déposez, ça convertit, vous téléchargez. Gratuit, sans inscription, sans filigrane sur vos images.',
            ],
            [
                'HEIC trop lourd à envoyer : je peux aussi le compresser ?',
                'Oui, et c\'est le vrai intérêt ici. Un HEIC recraché en JPG peut peser 3 ou 4 Mo, trop pour un formulaire ou un mail. Une fois la photo en JPG, passez-la dans notre outil de <a href="' . url('/compresser-image-100-ko') . '">poids maximal en Ko</a> pour viser une taille précise (par exemple sous 500 Ko), ou par la page <a href="' . url('/reduire-poids-image') . '">réduire le poids d\'une image</a>.',
            ],
        ];

        view('seo/convertir-heic', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs', 'faq'));
    }

    public function reduireTaille(): void
    {
        $pageTitle = 'Réduire la taille d\'une image en ligne — Gratuit et rapide';
        $pageDescription = 'Réduisez la taille de vos images en quelques secondes. PNG, JPEG, WebP supportés. Comparez avant/après avec notre slider interactif.';
        $extraCss = ['home.css', 'compressor.css', 'seo.css'];
        $extraJs = ['png8-encoder.js', 'compressor.js'];

        view('seo/reduire-taille', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs'));
    }

    public function optimiserWeb(): void
    {
        $pageTitle = 'Optimiser vos images pour le web — Performance et SEO';
        $pageDescription = 'Optimisez vos images pour améliorer la vitesse de votre site web et votre SEO. Compression intelligente sans perte de qualité visible.';
        $extraCss = ['home.css', 'compressor.css', 'seo.css'];
        $extraJs = ['png8-encoder.js', 'compressor.js'];

        view('seo/optimiser-web', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs'));
    }

    /**
     * /compresser-image-50-ko — page cible-poids manquante de la série (20/100 Ko, 1 Mo).
     * Réutilise le compresseur générique en mode « poids cible » (compressor.js),
     * pré-réglé sur 50 Ko, sortie JPG.
     */
    public function compresserImage50Ko(): void
    {
        $pageTitle       = 'Compresser une image en 50 Ko — Outil gratuit en ligne';
        $pageDescription = 'Compressez une image sous 50 Ko en ligne gratuitement. Cible pré-réglée, qualité puis dimensions ajustées automatiquement. Idéal photo d\'identité, avatar, formulaire.';
        $extraCss        = ['home.css', 'compressor.css', 'seo.css', 'png-reducer.css'];
        $extraJs         = ['png8-encoder.js', 'compressor.js'];

        $faq = [
            [
                'Peut-on rester net à 50 Ko ?',
                'Cela dépend entièrement des dimensions. En dessous de ~600 px de côté (avatar, photo d\'identité de 413 × 531 px, vignette), oui : 50 Ko suffisent pour un rendu impeccable. Sur une photo de smartphone en pleine définition laissée à 4000 px, non : à ce débit, la qualité JPG s\'effondre. La netteté à 50 Ko se gagne en réduisant d\'abord les pixels, pas en forçant la compression.',
            ],
            [
                'Faut-il redimensionner en plus de compresser ?',
                'Sur une grande image, oui, et c\'est même l\'étape décisive. Le poids d\'une photo varie avec sa surface : diviser la largeur par deux divise le nombre de pixels par quatre. Aucune baisse de qualité n\'approche ce résultat. L\'outil déclenche ce redimensionnement tout seul quand la qualité seule ne fait pas passer l\'image sous 50 Ko, et vous indique les dimensions retenues.',
            ],
            [
                'Quel format pour le plus petit poids ?',
                'Pour une photo, le JPG — c\'est la sortie de cet outil, car c\'est le seul format à la fois réglable en poids et accepté partout. Le WebP serait 25 à 35 % plus léger à qualité égale, mais beaucoup de formulaires administratifs le refusent encore. Le PNG est le pire choix pour une photo : à 50 Ko sur une image en nuances continues, il n\'a quasiment aucune chance.',
            ],
            [
                'L\'image fera-t-elle exactement 50 Ko ?',
                'Un peu moins, et c\'est voulu : une limite écrite « 50 Ko maximum » refuse un fichier de 50,0 Ko pile. L\'outil retient la meilleure qualité qui reste sous la barre — typiquement 47 à 49 Ko — et affiche le poids obtenu avec un verdict. Si la cible reste hors d\'atteinte, il l\'écrit clairement au lieu de vous livrer un fichier trop lourd.',
            ],
            [
                'Mes fichiers sont-ils envoyés sur un serveur ?',
                'Non. Toute la compression se fait dans votre navigateur. Les métadonnées EXIF, dont la géolocalisation que votre téléphone inscrit dans la photo, ne sont pas conservées dans le JPG produit.',
            ],
        ];

        view('seo/compresser-50ko', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs', 'faq'));
    }

    /**
     * /reduire-taille-png-sans-perte — angle « lossless » : le PNG est déjà sans perte.
     * Réutilise l\'encodeur PNG-8 (png-reducer.js) via la partial png-tool, sortie PNG.
     */
    public function reduireTaillePngSansPerte(): void
    {
        $pageTitle       = 'Réduire la taille d\'un PNG sans perte — vrai lossless ou pas ?';
        $pageDescription = 'Le PNG est déjà sans perte : ce que « réduire sans perte » veut vraiment dire. Optimisation lossless réelle vs quantification, gains chiffrés, transparence conservée. Gratuit, sans upload.';
        $extraCss        = ['home.css', 'compressor.css', 'seo.css', 'png-reducer.css'];
        $extraJs         = ['png-reducer.js'];

        $faq = [
            [
                'La transparence est-elle conservée ?',
                'Oui. L\'outil écrit la transparence dans un chunk tRNS, entrée de palette par entrée de palette. Une réserve honnête : en dessous de 64 couleurs, la palette manque de place pour les demi-transparences des contours antialiasés, et les bords deviennent crénelés. Pour un logo à bords lisses, restez à 128 ou 256 couleurs.',
            ],
            [
                'Quelle différence entre PNG-8 et PNG-24 ?',
                'Le PNG-8 est « indexé » : il ne stocke qu\'une palette de 256 couleurs maximum, et chaque pixel n\'est qu\'un numéro dans cette palette (un octet). Le PNG-24 est « couleurs vraies » : chaque pixel garde ses trois composantes rouge/vert/bleu (trois octets), soit 16,7 millions de teintes possibles. Beaucoup de logos sont enregistrés en PNG-24 alors qu\'ils n\'utilisent que 200 couleurs : les repasser en PNG-8 est sans perte et divise le poids par deux ou trois.',
            ],
            [
                'Pourquoi mon PNG ne maigrit presque pas ?',
                'Deux causes. Soit il était déjà bien compressé, et la marge sans perte restante ne dépasse pas quelques pourcents — c\'est normal, le PNG est sans perte par nature. Soit c\'est une photo ou un grand dégradé : ces images n\'ont aucune couleur répétée à factoriser, aucune technique sans perte n\'y gagne, et la ré-indexation peut même les alourdir. Dans ce cas, le vrai levier est de changer de format (JPG ou WebP), donc d\'accepter une perte.',
            ],
            [
                'Est-ce que ré-indexer en palette est vraiment « sans perte » ?',
                'Oui, à une condition stricte : que l\'image tienne dans 256 couleurs. Si c\'est le cas, chaque pixel retrouve exactement sa couleur d\'origine, aucune n\'est fusionnée — c\'est bijectif, donc sans perte. L\'outil compte les couleurs distinctes de votre fichier avant de compresser et vous prévient : à 256 ou moins, le résultat est identique pixel pour pixel ; au-delà, réduire davantage passe par une perte assumée.',
            ],
            [
                'Est-ce comme TinyPNG ?',
                'La méthode par défaut de TinyPNG est la quantification avec réduction de couleurs — leur documentation parle de « lossy ». C\'est efficace mais ce n\'est pas du sans perte au sens strict, et votre fichier est téléversé sur leurs serveurs. Ici, tout reste dans votre navigateur et l\'outil distingue explicitement le cas réellement sans perte (≤ 256 couleurs) du cas avec perte.',
            ],
        ];

        view('seo/reduire-png-sans-perte', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs', 'faq'));
    }

    /**
     * /reduire-taille-png-windows — guide « par système ». Paint/Photos ne compressent pas
     * un PNG, ils le redimensionnent. Réutilise png-reducer.js comme alternative en ligne.
     */
    public function reduireTaillePngWindows(): void
    {
        $pageTitle       = 'Réduire la taille d\'un PNG sous Windows (Paint, Photos) — et l\'alternative';
        $pageDescription = 'Réduire un PNG sous Windows avec Paint et l\'appli Photos, pas-à-pas. Pourquoi ces outils redimensionnent mais ne compressent pas, et comment vraiment compresser un PNG en ligne. Encart macOS.';
        $extraCss        = ['home.css', 'compressor.css', 'seo.css', 'png-reducer.css'];
        $extraJs         = ['png-reducer.js'];

        $faq = [
            [
                'Windows peut-il compresser un PNG sans le redimensionner ?',
                'Nativement, non. Ni Paint ni l\'application Photos n\'ont de réglage de compression pour le PNG : leur seul levier de poids est le nombre de pixels, donc le redimensionnement. Ré-enregistrer un PNG aux mêmes dimensions ne l\'allège pas et peut l\'alourdir. Compresser à dimensions égales suppose de réduire la palette de couleurs, ce que font seulement des outils dédiés (en ligne ou à installer).',
            ],
            [
                'Faut-il installer un logiciel ?',
                'Non. Un outil en ligne comme celui de cette page compresse un PNG dans le navigateur, sans installation ni compte, et sans envoyer le fichier sur un serveur. Les logiciels de bureau lossless (OptiPNG, zopflipng) existent et sont honnêtes, mais ils s\'installent, tournent souvent en ligne de commande, et leur gain reste modeste face à la ré-indexation de palette.',
            ],
            [
                'Comment garder la transparence en réduisant un PNG sous Windows ?',
                'Enregistrez toujours en PNG, jamais en JPEG : le JPG ne gère pas la transparence et remplit les zones transparentes en blanc. Sous le Paint de Windows 11, la transparence est conservée à l\'enregistrement en PNG ; les versions plus anciennes de Paint la remplaçaient par du blanc. L\'appli Photos et l\'outil en ligne de cette page conservent la transparence.',
            ],
            [
                'Pourquoi mon PNG grossit après passage dans Paint ?',
                'Parce que Paint réécrit la compression du fichier sans l\'optimiser. Si votre PNG d\'origine avait été compressé finement par un autre outil, la version ré-enregistrée par Paint peut être un peu plus lourde, à dimensions identiques. C\'est le signe qu\'il faut un vrai compresseur, pas un simple ré-enregistrement.',
            ],
        ];

        view('seo/reduire-png-windows', compact('pageTitle', 'pageDescription', 'extraCss', 'extraJs', 'faq'));
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
        $extraJs         = ['png8-encoder.js', 'compressor.js'];

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
            '/convertir-heic-en-jpg'         => ['monthly', '0.9'],
            '/optimiser-image-web'           => ['monthly', '0.9'],
            '/compresser-image-50-ko'        => ['monthly', '0.9'],
            '/reduire-taille-png-sans-perte' => ['monthly', '0.9'],
            '/reduire-taille-png-windows'    => ['monthly', '0.9'],
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
