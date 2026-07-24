<section class="hero seo-hero">
    <div class="container">
        <h1>Compresser une image en 50 Ko</h1>
        <p class="hero-sub">Une cible basse et précise, pour les formulaires et les photos de profil qui plafonnent à 50 Ko. L'outil est déjà réglé sur cette limite.</p>
        <div class="hero-formats">
            <span class="format-pill">JPG en sortie</span>
            <span class="format-pill-sep">cible 50 Ko pré-réglée · gratuit · rien n'est envoyé sur un serveur</span>
        </div>
    </div>
</section>

<?php partial('compressor', [
    'widgetHint'   => 'Déposez votre image — la cible est pré-réglée sur 50 Ko, modifiable',
    'widgetConfig' => ['mode' => 'target', 'default' => 50, 'unit' => 'kb'],
]); ?>

<section class="seo-content">
    <div class="container container-sm">

        <p><strong>En résumé :</strong> l'outil ci-dessus vise 50 Ko en ajustant d'abord la qualité JPG, puis les dimensions si le poids l'exige. Une photo déjà cadrée (avatar, photo d'identité de 413 × 531 px) tient sous 50 Ko sans rien perdre de visible. Une photo de smartphone en pleine définition, non : il faut la réduire en pixels, et cette page explique jusqu'où.</p>

        <h2 id="pourquoi-50">Pourquoi 50 Ko, et pas 100 ni 20</h2>
        <p>La série de nos pages à poids cible existe déjà pour <a href="<?= url('/compresser-image-20-ko') ?>">20 Ko</a>, <a href="<?= url('/compresser-image-100-ko') ?>">100 Ko</a> et <a href="<?= url('/compresser-image-1-mo') ?>">1 Mo</a>. Les 50 Ko manquaient, et ce n'est pas un seuil au hasard : il revient chaque fois que le système qui reçoit l'image doit la <em>stocker au plus juste</em>, pas seulement la transporter.</p>
        <p>Trois familles de cas produisent une limite à 50 Ko :</p>
        <ul>
            <li><strong>Les avatars de forum.</strong> Un phpBB, un vieux vBulletin ou un forum associatif stocke souvent l'avatar en base et le sert sur chaque message d'un fil. L'administrateur cale volontairement la limite bas — 50 Ko, parfois 6 Ko à l'installation par défaut de phpBB — pour ne pas gonfler la page ni la base.</li>
            <li><strong>Les photos d'identité numériques.</strong> Certains téléservices et portails (inscriptions, badges, cartes d'accès) exigent une photo sous un poids serré. La photo d'identité numérique française fait 35 × 45 mm, soit <strong>413 × 531 px à 300 dpi</strong> : à cette taille, un JPG de qualité correcte pèse justement autour de 40 Ko, d'où la limite.</li>
            <li><strong>Les formulaires qui gardent le fichier en base.</strong> Quand une image est enregistrée dans une colonne <code>BLOB</code> plutôt que sur un disque, le développeur borne sa taille pour protéger la base. 50 Ko est une valeur courante pour une pièce jointe « légère » (signature scannée, logo, justificatif miniature).</li>
        </ul>
        <p>Le point commun : ces plafonds sont fixés côté serveur et non négociables. Vous ne pouvez pas « demander une dérogation » — il faut faire tenir l'image dessous.</p>

        <h2 id="tableau">D'où vous partez, où vous arrivez</h2>
        <p>La question n'est pas « est-ce que ça descend à 50 Ko » — presque tout descend à 50 Ko si on l'abîme assez. La vraie question est : <em>que reste-t-il de l'image à 50 Ko selon d'où elle part ?</em> Voici les cas typiques.</p>

        <div class="pr-table-wrap">
            <table class="pr-table">
                <caption>Poids de départ observés sur des fichiers courants, et ce qu'impose la cible de 50 Ko. « Redim. » = réduction des dimensions en pixels, que l'outil applique automatiquement quand la seule baisse de qualité ne suffit pas.</caption>
                <thead>
                    <tr>
                        <th scope="col">Image de départ</th>
                        <th scope="col">Poids typique</th>
                        <th scope="col">Pour tenir sous 50 Ko</th>
                        <th scope="col">Perte attendue</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Photo smartphone 12 Mpx<br><span class="pr-detail">4032 × 3024, JPG</span></th>
                        <td>3 à 8 Mo</td>
                        <td>Redim. obligatoire vers ~600–800 px + qualité ~70</td>
                        <td>Détails fins perdus, reste net à taille réduite</td>
                    </tr>
                    <tr>
                        <th scope="row">Capture d'écran Full HD<br><span class="pr-detail">1920 × 1080, PNG</span></th>
                        <td>200 Ko à 2 Mo</td>
                        <td>Passage en JPG + réduction vers ~1000 px</td>
                        <td>Texte fin légèrement adouci</td>
                    </tr>
                    <tr>
                        <th scope="row">Scan de document A4<br><span class="pr-detail">300 dpi</span></th>
                        <td>1 à 5 Mo</td>
                        <td>JPG qualité ~60 + réduction vers ~1000 px de large</td>
                        <td>Petits caractères à relire avant l'envoi</td>
                    </tr>
                    <tr>
                        <th scope="row">Photo d'identité déjà cadrée<br><span class="pr-detail">413 × 531 px</span></th>
                        <td>100 à 300 Ko</td>
                        <td>Qualité ~75, aucun redimensionnement nécessaire</td>
                        <td>Aucune visible</td>
                    </tr>
                    <tr>
                        <th scope="row">Avatar / vignette<br><span class="pr-detail">512 × 512 px</span></th>
                        <td>100 à 500 Ko</td>
                        <td>Qualité ~80</td>
                        <td>Aucune visible</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p>La ligne à retenir est la première. Une photo de smartphone contient plus de 12 millions de pixels ; 50 Ko, c'est environ 400 000 bits une fois compressé, soit à peine plus d'un tiers de bit par pixel d'origine. Aucun réglage de qualité ne tient à ce débit sans devenir une bouillie. La seule issue est de <strong>jeter des pixels</strong> — c'est-à-dire réduire les dimensions — avant de compresser. C'est ce que fait l'outil quand la qualité seule échoue, et c'est la clé de la section suivante.</p>

        <h2 id="methode">Comment descendre vraiment sous 50 Ko</h2>
        <p>Trois leviers, dans cet ordre d'efficacité :</p>
        <ol class="seo-steps">
            <li><strong>Baisser la qualité JPG.</strong> Le premier réflexe, et le seul que la plupart des gens connaissent. Il suffit pour une image déjà petite (avatar, photo d'identité cadrée). Sur une grande photo, il s'épuise vite : sous une certaine qualité, le fichier ne descend plus, il se couvre juste d'artefacts.</li>
            <li><strong>Réduire les dimensions en pixels.</strong> Le levier que l'on oublie, et de loin le plus puissant. Le poids d'une image varie avec sa <em>surface</em> : passer de 4000 à 1000 px de large divise le nombre de pixels par 16. Pour une cible aussi basse que 50 Ko sur une photo, ce levier n'est pas optionnel, il est premier. L'outil de cette page le déclenche tout seul quand la qualité ne suffit pas, et vous indique les dimensions retenues.</li>
            <li><strong>Choisir le bon format.</strong> Pour un poids réglable et accepté partout, c'est le JPG — d'où la sortie de cet outil. Le WebP serait 25 à 35 % plus léger à qualité égale, mais il est encore refusé par beaucoup de formulaires administratifs, donc risqué pour un dépôt officiel. Le PNG, lui, est le pire choix pour une photo : à 50 Ko il n'a quasiment aucune chance sur une image en nuances continues.</li>
        </ol>

        <div class="pr-warn">
            <p><strong>« Exactement 50 Ko » n'existe pas, et c'est voulu.</strong> Une limite écrite « 50 Ko maximum » refuse un fichier de 50,0 Ko pile. L'outil vise donc juste en dessous — typiquement 47 à 49 Ko — et affiche le poids réellement obtenu avec un verdict. Si la cible reste hors d'atteinte, il vous le dit noir sur blanc au lieu de vous livrer un fichier trop lourd sans prévenir.</p>
        </div>

        <h2 id="faq">Questions fréquentes</h2>
        <div class="seo-faq">
            <?php foreach ($faq as $qa): ?>
                <details class="faq-item">
                    <summary><?= e($qa[0]) ?></summary>
                    <p><?= $qa[1] ?></p>
                </details>
            <?php endforeach; ?>
        </div>

        <h2 id="autres">Une autre limite à respecter ?</h2>
        <ul class="seo-related">
            <li><a href="<?= url('/compresser-image-20-ko') ?>">Compresser une image en 20 Ko</a></li>
            <li><a href="<?= url('/compresser-image-100-ko') ?>">Compresser une image en 100 Ko</a></li>
            <li><a href="<?= url('/compresser-image-1-mo') ?>">Compresser une image en 1 Mo</a></li>
            <li><a href="<?= url('/reduire-image-en-ko') ?>">Réduire une image à un poids en Ko au choix</a></li>
            <li><a href="<?= url('/reduire-taille-photo-identite') ?>">Réduire la taille d'une photo d'identité</a></li>
            <li><a href="<?= url('/') ?>">Compresseur d'image (page principale)</a></li>
        </ul>
    </div>
</section>

<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'           => 'BreadcrumbList',
            '@id'             => url('/compresser-image-50-ko') . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Accueil', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Réduire une image en Ko', 'item' => url('/reduire-image-en-ko')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Compresser une image en 50 Ko', 'item' => url('/compresser-image-50-ko')],
            ],
        ],
        [
            '@type'            => 'HowTo',
            '@id'              => url('/compresser-image-50-ko') . '#howto',
            'name'             => 'Compresser une image en 50 Ko',
            'description'      => 'Faire tenir une image sous 50 Ko en ajustant la qualité JPG puis les dimensions en pixels.',
            'totalTime'        => 'PT1M',
            'tool'             => ['@type' => 'HowToTool', 'name' => 'Compresseur d\'image en ligne (sortie JPG)'],
            'step'             => [
                ['@type' => 'HowToStep', 'position' => 1, 'name' => 'Déposer l\'image', 'text' => 'Glissez votre image dans l\'outil : la cible est déjà réglée sur 50 Ko.'],
                ['@type' => 'HowToStep', 'position' => 2, 'name' => 'Laisser ajuster la qualité', 'text' => 'L\'outil cherche par dichotomie la meilleure qualité JPG qui tient sous 50 Ko.'],
                ['@type' => 'HowToStep', 'position' => 3, 'name' => 'Réduire les dimensions si nécessaire', 'text' => 'Si la qualité seule ne suffit pas, l\'outil réduit les dimensions en pixels et affiche la taille retenue.'],
                ['@type' => 'HowToStep', 'position' => 4, 'name' => 'Télécharger', 'text' => 'Récupérez le JPG obtenu ; son poids final et un verdict par rapport aux 50 Ko sont affichés.'],
            ],
        ],
        [
            '@type'               => 'WebApplication',
            '@id'                 => url('/compresser-image-50-ko') . '#app',
            'name'                => 'Compresseur d\'image à 50 Ko',
            'url'                 => url('/compresser-image-50-ko'),
            'description'         => 'Compresse une image sous 50 Ko dans le navigateur : qualité JPG ajustée automatiquement, puis dimensions si le poids l\'exige. Sortie JPG, EXIF supprimés.',
            'applicationCategory' => 'MultimediaApplication',
            'operatingSystem'     => 'Web',
            'offers'              => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'EUR'],
        ],
        [
            '@type'      => 'FAQPage',
            '@id'        => url('/compresser-image-50-ko') . '#faq',
            'mainEntity' => array_map(fn($qa) => [
                '@type'          => 'Question',
                'name'           => $qa[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($qa[1])],
            ], $faq),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
