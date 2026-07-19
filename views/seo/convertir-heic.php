<section class="hero seo-hero">
    <div class="container">
        <h1>Convertir HEIC en JPG</h1>
        <p class="hero-sub">Vos photos iPhone en JPG lisible partout — sans les envoyer sur un serveur, et allégées au passage.</p>
        <div class="hero-formats">
            <span class="format-pill">HEIC</span>
            <span class="format-pill">HEIF</span>
            <span class="format-pill-sep">→ JPG · 100 % dans votre navigateur · rien n'est uploadé</span>
        </div>
    </div>
</section>

<?php partial('compressor', [
    'widgetHint'   => 'Glissez vos photos HEIC (iPhone) — jusqu\'à 10, converties en JPG dans votre navigateur',
    'widgetConfig' => [
        'mode'    => 'convert',
        'output'  => 'image/jpeg',
        'toLabel' => 'JPG',
        'accept'  => 'image/heic,image/heif,.heic,.heif,image/jpeg,image/png,image/webp',
    ],
]); ?>

<section class="seo-content">
    <div class="container container-sm">

        <p><strong>En résumé :</strong> le HEIC est le format des photos iPhone depuis iOS 11. Windows, Android et la plupart des sites ne l'ouvrent pas. Cette page le décode dans votre navigateur et le ré-enregistre en JPG, sans rien envoyer sur Internet, et supprime au passage les données GPS que vos photos transportent.</p>

        <h2 id="pourquoi-heic">Pourquoi votre iPhone fait du HEIC (et pourquoi Windows ne l'ouvre pas)</h2>
        <p>Depuis iOS 11, sorti en 2017, l'appareil photo de l'iPhone n'enregistre plus en JPEG par défaut mais en <strong>HEIC</strong> — High Efficiency Image Container. Sous le capot, l'image est compressée avec HEVC, aussi appelé H.265, le même codec que la vidéo 4K. Le gain est réel : à qualité identique, une photo HEIC pèse environ moitié moins qu'un JPEG. Sur les 128 ou 256 Go d'un téléphone, ça finit par compter.</p>
        <p>Le problème arrive dès que la photo quitte l'univers Apple. HEVC est un codec breveté, et son décodage n'est pas embarqué partout : Windows 10 réclame une extension payante depuis le Store, beaucoup d'Android l'ignorent, et un site de petites annonces ou un formulaire administratif refuse tout simplement le fichier. Vous vous retrouvez avec une photo que vous voyez très bien sur votre iPhone mais que personne d'autre n'arrive à ouvrir.</p>
        <p>À l'inverse, le <strong>JPG</strong> (JPEG) est normalisé depuis 1992 sous la référence ISO/IEC 10918-1. Il n'existe pas un seul appareil, système ou site qui ne sache pas le lire. Il est moins efficace que le HEIC — une même photo y pèse à peu près le double — mais c'est le prix de la compatibilité universelle. Quand vous devez <em>envoyer</em> une photo ailleurs que sur un autre appareil Apple, le JPG est le bon format.</p>

        <div class="pr-warn">
            <p><strong>Astuce en amont :</strong> pour que l'iPhone photographie directement en JPG, allez dans Réglages → Appareil photo → Formats → « Le plus compatible ». Attention, ça ne convertit pas les photos déjà prises — c'est là que cette page sert.</p>
        </div>

        <h2 id="local">La vraie différence : vos photos ne quittent jamais votre appareil</h2>
        <p>Les convertisseurs HEIC les plus connus — Convertio, iLoveIMG, heictojpg — fonctionnent tous de la même façon : vous téléversez vos photos sur leurs serveurs, ils les convertissent là-bas, vous récupérez le résultat, et vos fichiers restent stockés chez eux un certain temps (24 heures chez Convertio, par exemple). Or un HEIC n'est pas un fichier anodin. C'est une photo prise avec votre téléphone, qui embarque la date, le modèle d'appareil, et le plus souvent les coordonnées GPS exactes de l'endroit où vous étiez.</p>
        <p>Ici, rien de tout ça. Le décodage HEIC tourne dans votre navigateur grâce à la bibliothèque <code>libheif</code> compilée en WebAssembly (le décodeur, environ 1,4 Mo, ne se charge qu'au premier fichier déposé). Aucun octet de vos photos ne part sur Internet. Vous voulez vous en assurer&nbsp;? Chargez cette page, coupez votre Wi-Fi ou vos données, puis déposez vos HEIC : la conversion marche toujours. Un service qui uploade sur un serveur en serait incapable.</p>

        <div class="pr-table-wrap">
            <table class="pr-table">
                <caption>Comment chaque outil traite vos photos iPhone.</caption>
                <thead>
                    <tr>
                        <th scope="col">&nbsp;</th>
                        <th scope="col">Cette page</th>
                        <th scope="col">Convertio / iLoveIMG / heictojpg</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Où se fait la conversion</th>
                        <td>Dans votre navigateur</td>
                        <td>Sur leurs serveurs</td>
                    </tr>
                    <tr>
                        <th scope="row">Vos photos sont téléversées</th>
                        <td>Non, jamais</td>
                        <td>Oui</td>
                    </tr>
                    <tr>
                        <th scope="row">Coordonnées GPS de la photo</th>
                        <td>Supprimées</td>
                        <td>Transmises au serveur</td>
                    </tr>
                    <tr>
                        <th scope="row">Fonctionne hors ligne</th>
                        <td>Oui, après chargement</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <th scope="row">Compte / installation</th>
                        <td>Rien</td>
                        <td>Variable, souvent limité</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2 id="exif">Le HEIC de votre iPhone connaît votre adresse. Le JPG produit, non.</h2>
        <p>C'est le point qu'on ne vous dit jamais. Une photo prise avec la géolocalisation activée contient, dans ses métadonnées EXIF, la latitude et la longitude au mètre près. Une photo de votre salon publiée telle quelle sur une petite annonce, c'est votre adresse offerte à qui sait lire un fichier.</p>
        <p>Notre conversion passe par un <code>canvas</code>, qui ne recopie que les pixels de l'image. Résultat : le JPG obtenu ne contient plus aucune métadonnée — ni GPS, ni date, ni modèle d'appareil. Vous partagez l'image, pas l'endroit où vous l'avez prise. Si vous teniez à conserver ces informations (pour un usage personnel, un catalogue photo), sachez que cette page ne le permet pas : elle nettoie, c'est un choix assumé.</p>

        <h2 id="qualite">La qualité, le poids, et ce à quoi il faut s'attendre</h2>
        <p>On décode le HEIC à sa résolution d'origine — une photo d'iPhone récent tourne autour de 4032 × 3024 px, soit 12 mégapixels — puis on ré-encode en JPG à une qualité de 90 %. À l'œil, aucune différence visible avec la photo de départ.</p>
        <p>Le poids, lui, augmente, et c'est normal : un JPG est environ deux fois plus lourd qu'un HEIC à qualité égale. Un exemple mesuré sur notre propre fichier de test : un HEIC de 748 Ko en 3840 × 2160 ressort à 1,11 Mo une fois converti en JPG qualité 90 %. Ce n'est pas un défaut de l'outil, c'est la nature du format. Si ce poids vous gêne pour un envoi, la section suivante est faite pour vous.</p>

        <h2 id="compresser">Convertir <em>et</em> alléger, en une fois</h2>
        <p>La plupart des convertisseurs s'arrêtent à la conversion : ils vous rendent un JPG énorme et se débrouillent avec. Souvent, ce n'est pas ce dont vous avez besoin. Si vous convertissez une photo iPhone, c'est en général pour l'<em>envoyer</em> quelque part — un mail, un formulaire qui plafonne à 2 Mo, un site de petites annonces qui compresse mal. Un JPG de 4 Mo va être refusé ou massacré.</p>
        <p>La bonne séquence est donc en deux temps : convertissez ici, puis passez le JPG obtenu dans un outil de poids cible.</p>
        <ol class="seo-steps">
            <li><strong>Convertissez</strong> vos HEIC en JPG avec l'outil en haut de cette page.</li>
            <li><strong>Visez un poids précis</strong> avec la page <a href="<?= url('/compresser-image-100-ko') ?>">compresser une image en 100 Ko</a> ou <a href="<?= url('/reduire-poids-image') ?>">réduire le poids d'une image</a> : elles ajustent la qualité (et au besoin les dimensions) jusqu'à passer sous le seuil que vous demandez.</li>
        </ol>
        <p>En pratique, une photo iPhone de 12 Mpx qui pèse 4 Mo en JPG plein format tient sous 500 Ko une fois redimensionnée à 1600 px de large, sans que ça se voie sur un écran. C'est largement suffisant pour un mail ou une annonce.</p>

        <h2 id="comment">Comment convertir vos HEIC, étape par étape</h2>
        <ol class="seo-steps">
            <li><strong>Déposez vos photos.</strong> Glissez un ou plusieurs fichiers .heic dans la zone en haut de page, ou cliquez pour les choisir. Jusqu'à 10 d'un coup.</li>
            <li><strong>Le décodage se lance.</strong> Au premier fichier, le décodeur HEIC se charge (une fois), puis chaque photo est convertie en JPG dans votre navigateur.</li>
            <li><strong>Téléchargez.</strong> Récupérez chaque JPG, ou cliquez sur « Tout télécharger » pour le lot entier.</li>
        </ol>
        <p class="pr-hint">Sur iPhone et sur Mac (Safari), le HEIC s'affiche nativement, donc l'aperçu apparaît tout de suite. Sur Windows et Android, l'aperçu se construit une fois le décodage terminé — c'est exactement le moment où les autres outils, eux, auraient envoyé votre photo sur un serveur.</p>

        <h2 id="faq">Questions fréquentes</h2>
        <div class="seo-faq">
            <?php foreach ($faq as $qa): ?>
                <details class="faq-item">
                    <summary><?= e($qa[0]) ?></summary>
                    <p><?= $qa[1] ?></p>
                </details>
            <?php endforeach; ?>
        </div>

        <h2 id="liees">Conversions et outils liés</h2>
        <p>Le même moteur, 100 % local, couvre les autres formats courants :</p>
        <ul class="seo-related">
            <li><a href="<?= url('/convertir-png-en-jpg') ?>">Convertir un PNG en JPG</a></li>
            <li><a href="<?= url('/convertir-webp-en-jpg') ?>">Convertir un WebP en JPG</a></li>
            <li><a href="<?= url('/convertir-jpg-en-webp') ?>">Convertir un JPG en WebP</a></li>
            <li><a href="<?= url('/compresser-photo') ?>">Compresser une photo</a></li>
            <li><a href="<?= url('/reduire-taille-photo') ?>">Réduire la taille d'une photo</a></li>
            <li><a href="<?= url('/compresser-image-pour-mail') ?>">Compresser une image pour un e-mail</a></li>
        </ul>

    </div>
</section>

<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'           => 'BreadcrumbList',
            '@id'             => url('/convertir-heic-en-jpg') . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Accueil', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Convertir HEIC en JPG', 'item' => url('/convertir-heic-en-jpg')],
            ],
        ],
        [
            '@type'               => 'WebApplication',
            '@id'                 => url('/convertir-heic-en-jpg') . '#app',
            'name'                => 'Convertisseur HEIC en JPG',
            'url'                 => url('/convertir-heic-en-jpg'),
            'description'         => 'Convertit les photos iPhone HEIC/HEIF en JPG entièrement dans le navigateur, sans upload, en supprimant les métadonnées EXIF et GPS.',
            'applicationCategory' => 'MultimediaApplication',
            'operatingSystem'     => 'Web',
            'browserRequirements' => 'Navigateur supportant WebAssembly (Chrome, Edge, Firefox, Safari, Android)',
            'featureList'         => [
                'Décodage HEIC/HEIF côté client (libheif WebAssembly)',
                'Conversion en JPG sans téléverser les fichiers',
                'Suppression des métadonnées EXIF et de la géolocalisation GPS',
                'Traitement par lot jusqu\'à 10 photos + tout télécharger',
                'Fonctionne hors ligne une fois la page chargée',
            ],
            'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'EUR'],
        ],
        [
            '@type'      => 'FAQPage',
            '@id'        => url('/convertir-heic-en-jpg') . '#faq',
            'mainEntity' => array_map(fn($qa) => [
                '@type'          => 'Question',
                'name'           => $qa[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($qa[1])],
            ], $faq),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
