<section class="hero seo-hero">
    <div class="container">
        <h1>Réduire la taille d'un PNG</h1>
        <p class="hero-sub">En français, « taille » veut dire deux choses. Commencez par choisir laquelle vous pose problème : le poids du fichier, ou ses dimensions en pixels.</p>
        <div class="hero-formats">
            <span class="format-pill">PNG</span>
            <span class="format-pill-sep">sortie PNG · transparence conservée · rien n'est envoyé sur nos serveurs</span>
        </div>
    </div>
</section>

<section class="compressor-section">
    <div class="container container-sm" id="pngReducer">

        <!-- Étape 1 : désambiguïsation -->
        <h2 id="votre-probleme">Votre PNG est trop lourd, ou trop grand ?</h2>
        <div class="pr-fork">
            <button type="button" class="pr-card" data-path="poids" aria-pressed="false">
                <h3>Trop lourd (Ko / Mo)</h3>
                <p>Le fichier pèse trop. On réduit son poids sans toucher aux pixels.</p>
                <span class="pr-eg">« 4 Mo, refusé à l'envoi », « il faut moins de 500 Ko »</span>
            </button>
            <button type="button" class="pr-card" data-path="dimensions" aria-pressed="false">
                <h3>Trop grand (pixels)</h3>
                <p>L'image fait 4000 px de large. On change ses dimensions.</p>
                <span class="pr-eg">« il me faut du 1080 px », « ça déborde de la page »</span>
            </button>
        </div>

        <!-- Étape 2 : dépôt + options -->
        <div id="prStepDrop" hidden>
            <div class="pr-drop" id="prDropZone" tabindex="0" role="button" aria-label="Déposer des fichiers PNG">
                <strong>Glissez vos PNG ici</strong>
                <span>ou cliquez pour choisir — 10 PNG max, 10 Mo par fichier</span>
                <input type="file" id="prFileInput" accept="image/png" multiple hidden>
            </div>

            <div class="pr-options" id="prOptWeight" hidden>
                <fieldset class="pr-modes">
                    <legend>Comment réduire le poids ?</legend>
                    <label><input type="radio" name="prWeightMode" value="palette" checked> Choisir le nombre de couleurs</label>
                    <label><input type="radio" name="prWeightMode" value="cible"> Viser un poids maximal</label>
                </fieldset>

                <div id="prColorsRow" class="pr-row-field">
                    <label for="prColors">Palette&nbsp;:</label>
                    <select id="prColors">
                        <option value="256" selected>256 couleurs — le réglage sûr</option>
                        <option value="128">128 couleurs — logos et aplats</option>
                        <option value="64">64 couleurs — captures d'écran</option>
                        <option value="32">32 couleurs — icônes simples</option>
                        <option value="16">16 couleurs — le minimum utilisable</option>
                    </select>
                </div>

                <div id="prTargetRow" class="pr-row-field" hidden>
                    <label for="prTargetValue">Je veux un PNG sous&nbsp;:</label>
                    <input type="number" id="prTargetValue" value="500" min="1" step="1">
                    <select id="prTargetUnit">
                        <option value="kb" selected>Ko</option>
                        <option value="mb">Mo</option>
                    </select>
                </div>
                <p class="pr-hint">Le mode « poids maximal » descend la palette par paliers (256 → 128 → 64…) et s'arrête au premier qui passe sous votre seuil. Si même 2 couleurs ne suffisent pas, on vous le dit au lieu de vous rendre un fichier hors limite.</p>
            </div>

            <div class="pr-options" id="prOptDims" hidden>
                <label>Nouvelles dimensions (en pixels)</label>
                <div class="pr-row-field" style="margin-top:.6rem">
                    <input type="number" id="prResizeW" placeholder="Largeur" value="1080" min="1">
                    <span aria-hidden="true">×</span>
                    <input type="number" id="prResizeH" placeholder="Hauteur" min="1">
                    <label style="font-weight:400;font-size:.9rem"><input type="checkbox" id="prResizeLock" checked> garder les proportions</label>
                </div>
                <p class="pr-hint">Laissez la hauteur vide : elle se calcule toute seule. Redimensionner fait presque toujours plus baisser le poids que la compression. Un PNG en 4000 px réduit à 1080 px perd environ 93 % de ses pixels.</p>
            </div>

            <p class="pr-status" id="prStatus" role="status" aria-live="polite"></p>
            <button class="btn btn-primary btn-lg" id="prRunBtn" hidden>Réduire mes PNG</button>
        </div>

        <!-- Résultats -->
        <div id="prResults" hidden>
            <div class="results-header">
                <h2>Résultat</h2>
                <button class="btn btn-ghost" id="prResetBtn">Recommencer</button>
            </div>
            <div class="pr-summary" id="prSummary"></div>
            <div id="prResultsList"></div>
            <p class="pr-hint">Le fond en damier montre les zones transparentes : elles sont conservées telles quelles. Toujours trop lourd ? Descendez d'un cran de palette, réduisez les dimensions, ou lisez plus bas pourquoi le PNG n'est peut-être pas le bon format.</p>
        </div>
    </div>
</section>

<section class="seo-content">
    <div class="container container-sm">

        <p><strong>En résumé :</strong> pour alléger un PNG, on réduit le nombre de couleurs de sa palette. Sur un logo ou une capture d'écran, passer à 256 couleurs fait gagner environ 73 % de poids sans différence visible. Sur une photo ou un dégradé, ça ne marche pas, et le bon réflexe est de changer de format.</p>

        <h2 id="pourquoi-lourd">Pourquoi votre PNG est si lourd</h2>
        <p>Un PNG stocke chaque pixel sur 32 bits : 8 pour le rouge, 8 pour le vert, 8 pour le bleu, 8 pour la transparence. Une image de 1280 × 800 px, c'est donc près de 4 Mo de données brutes avant compression. Le PNG les compresse sans rien perdre (algorithme DEFLATE, le même que le ZIP), mais un compresseur sans perte ne peut pas faire de miracle : il ne supprime que la <em>redondance</em>.</p>
        <p>D'où le vrai problème. Un PNG est lourd quand il contient beaucoup de couleurs légèrement différentes : des milliers de nuances quasi identiques qu'aucun œil ne distingue. DEFLATE, lui, les voit toutes comme des valeurs distinctes et n'a rien à factoriser.</p>
        <p>Trois autres causes reviennent souvent :</p>
        <ul>
            <li><strong>Des dimensions surdimensionnées.</strong> Un logo affiché en 200 px mais exporté en 2000 px contient 100 fois trop de pixels.</li>
            <li><strong>Un canal alpha inutile.</strong> Si l'image n'a aucune zone transparente, ces 8 bits par pixel sont payés pour rien.</li>
            <li><strong>Des métadonnées.</strong> Profils colorimétriques et données d'export ajoutent quelques Ko. Marginal, mais gratuit à supprimer.</li>
        </ul>

        <h2 id="png-nest-pas-jpeg">PNG et JPEG ne se compressent pas du tout pareil</h2>
        <p>C'est la confusion la plus courante, et elle explique pourquoi le curseur « qualité 80 % » que vous connaissez n'existe pas ici.</p>
        <p>Le <strong>JPEG</strong> découpe l'image en blocs de 8 × 8 pixels et jette les détails fins que l'œil remarque peu. Vous réglez l'agressivité avec un curseur de qualité. Le résultat est flou par endroits, mais il garde des millions de couleurs.</p>
        <p>Le <strong>PNG</strong> n'a pas de curseur de qualité, parce qu'il est sans perte par construction. Le seul levier, c'est de réduire le <em>nombre de couleurs</em> : on remplace les milliers de nuances par une palette de 256 entrées maximum, et chaque pixel ne stocke plus qu'un numéro dans cette palette au lieu de 4 octets. C'est ce qu'on appelle la quantification. L'image reste nette, aucun flou, mais son vocabulaire de couleurs rétrécit.</p>
        <p>Conséquence directe : la quantification est excellente sur ce qui a peu de couleurs franches (logos, icônes, captures d'interface, illustrations à aplats) et mauvaise sur ce qui vit de nuances continues (photos, dégradés).</p>

        <h2 id="tableau">Ce que chaque palette fait vraiment gagner</h2>
        <p>Les chiffres qui circulent sur le sujet (« 16 couleurs = 90 % de gain ») ne veulent rien dire sans le fichier de départ. Voici donc nos propres mesures, sur trois PNG réels passés dans l'encodeur de cette page.</p>

        <div class="pr-table-wrap">
            <table class="pr-table">
                <caption>Mesures réalisées le 16 juillet 2026 avec l'encodeur PNG-8 de cette page (median cut RGBA, filtre None, zlib niveau 6 — le niveau qu'utilise le navigateur). Poids en Ko réels du fichier produit. Vous pouvez refaire le test : les deux fichiers du dégradé sont téléchargeables plus bas.</caption>
                <thead>
                    <tr>
                        <th scope="col">Fichier de départ</th>
                        <th scope="col">Origine</th>
                        <th scope="col">256 c.</th>
                        <th scope="col">128 c.</th>
                        <th scope="col">64 c.</th>
                        <th scope="col">32 c.</th>
                        <th scope="col">16 c.</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Logo 512 × 512, transparent<br><span class="pr-detail">notre favicon, 267 teintes</span></th>
                        <td>28,7 Ko</td>
                        <td>7,9 Ko<br><span class="pr-win">-73 %</span></td>
                        <td>5,5 Ko<br><span class="pr-win">-81 %</span></td>
                        <td>4,6 Ko<br><span class="pr-win">-84 %</span></td>
                        <td>4,2 Ko<br><span class="pr-win">-85 %</span></td>
                        <td>3,7 Ko<br><span class="pr-win">-87 %</span></td>
                    </tr>
                    <tr>
                        <th scope="row">Capture d'interface 1280 × 800<br><span class="pr-detail">notre page d'accueil</span></th>
                        <td>86,6 Ko</td>
                        <td>23,5 Ko<br><span class="pr-win">-73 %</span></td>
                        <td>20,1 Ko<br><span class="pr-win">-77 %</span></td>
                        <td>17,2 Ko<br><span class="pr-win">-80 %</span></td>
                        <td>16,2 Ko<br><span class="pr-win">-81 %</span></td>
                        <td>14,6 Ko<br><span class="pr-win">-83 %</span></td>
                    </tr>
                    <tr>
                        <th scope="row">Dégradé lisse 800 × 500<br><span class="pr-detail">le cas défavorable</span></th>
                        <td>9,3 Ko</td>
                        <td>13,8 Ko<br><span class="pr-lose">+49 %</span></td>
                        <td>11,1 Ko<br><span class="pr-lose">+19 %</span></td>
                        <td>8,2 Ko<br><span class="pr-win">-12 %</span></td>
                        <td>5,9 Ko<br><span class="pr-win">-36 %</span></td>
                        <td>3,5 Ko<br><span class="pr-win">-62 %</span></td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p>Trois choses à retenir de ce tableau, dont deux qu'on ne lit nulle part ailleurs.</p>

        <p><strong>1. L'essentiel du gain est déjà pris à 256 couleurs.</strong> Sur le logo, on passe de 28,7 à 7,9 Ko sans rien voir. Descendre jusqu'à 16 couleurs ne rapporte que 4,2 Ko de plus, pour un résultat nettement dégradé. Le rapport gain/risque s'effondre après 128.</p>

        <p><strong>2. Sur un logo, ce ne sont pas les couleurs qui lâchent en premier, ce sont les bords.</strong> Notre favicon ne contient que 267 teintes réelles mais 210 niveaux de transparence, tous consacrés à l'antialiasing des contours. En dessous de 64 entrées, la palette n'a plus de place pour ces demi-transparences : l'écart maximal d'alpha passe de 6/255 à 128 couleurs, à 107/255 à 16 couleurs. Concrètement, les contours deviennent crénelés bien avant que les couleurs ne posent problème. C'est pour ça que le conseil habituel « mettez 16 couleurs sur un logo » est un mauvais conseil.</p>

        <p><strong>3. Sur un dégradé, quantifier fait <em>grossir</em> le fichier.</strong> Contre-intuitif, mais logique : un dégradé lisse est le meilleur ami des filtres PNG, qui n'ont qu'à encoder « +1 par rapport au pixel de gauche » sur toute la ligne. En passant à une palette, on remplace cette régularité parfaite par des index qui sautent d'une valeur à l'autre à chaque frontière de bande, et DEFLATE compresse moins bien. Notre dégradé de 9,3 Ko ressort à 13,8 Ko en 256 couleurs. C'est pourquoi l'outil de cette page refuse de vous rendre un fichier plus lourd que l'original : dans ce cas, il vous rend l'original intact et vous le dit.</p>

        <h2 id="banding">L'avertissement que personne ne vous donne : le banding</h2>
        <p>Réduire la palette d'un dégradé casse la progression continue en bandes visibles. Les deux images ci-dessous sont le même dégradé, à gauche l'original, à droite le même fichier réduit à 16 couleurs par l'outil de cette page.</p>

        <div class="pr-compare">
            <figure>
                <img src="<?= asset('images/samples/degrade-original.png') ?>" width="800" height="500" alt="Dégradé bleu-violet original, progression lisse et continue" loading="lazy">
                <figcaption><strong>Original</strong> — 9,3 Ko, progression continue.</figcaption>
            </figure>
            <figure>
                <img src="<?= asset('images/samples/degrade-16-couleurs.png') ?>" width="800" height="500" alt="Le même dégradé réduit à 16 couleurs : des bandes diagonales franches remplacent la progression lisse" loading="lazy">
                <figcaption><strong>16 couleurs</strong> — 3,5 Ko (-62 %), mais les bandes sautent aux yeux.</figcaption>
            </figure>
        </div>

        <p>Le piège, c'est que les mesures automatiques ne voient pas ce défaut. L'écart moyen entre ces deux images est de 1,97 sur 255, soit moins de 1 % : n'importe quel indicateur chiffré conclurait « quasi identique ». Votre œil, lui, voit immédiatement les bandes, parce qu'il est très sensible aux frontières nettes dans une zone qui devrait être lisse. Une moyenne ne peut pas capturer ça. C'est la limite de la quantification, et aucun réglage ne la contourne sur ce type d'image.</p>

        <div class="pr-warn">
            <p><strong>Donc, honnêtement :</strong> si votre PNG est une photo ou contient de grands dégradés, arrêtez-vous là. La quantification vous donnera soit un fichier plus lourd, soit du banding. Le problème n'est pas la compression, c'est le format.</p>
        </div>

        <h2 id="pas-de-png">Le meilleur moyen de réduire un PNG : ne pas rester en PNG</h2>
        <p>Ça dessert notre propre outil de l'écrire, mais c'est vrai dans un cas sur deux, alors autant le dire. Le PNG n'a qu'un seul avantage réel : la transparence, et le rendu net des aplats. Si votre image n'a pas de transparence et n'est pas un dessin à couleurs franches, elle est en PNG par accident, souvent parce que c'était le réglage par défaut d'un export ou d'un outil de capture.</p>
        <p>La règle de décision tient en trois lignes :</p>
        <ol class="seo-steps">
            <li><strong>Transparence nécessaire ?</strong> Oui → restez en PNG (ou passez en WebP, qui gère aussi la transparence). Non → continuez.</li>
            <li><strong>C'est une photo ?</strong> Oui → <a href="<?= url('/convertir-png-en-jpg') ?>">convertissez le PNG en JPG</a>. Le gain se compte en dizaines, pas en pourcents : le JPEG est fait pour les nuances continues, le PNG non.</li>
            <li><strong>C'est un logo, une capture, une illustration ?</strong> Restez en PNG et quantifiez avec l'outil ci-dessus — ou passez en <a href="<?= url('/convertir-png-en-webp') ?>">WebP</a> si vos visiteurs sont sur des navigateurs récents (tous le sont depuis 2020).</li>
        </ol>
        <p>Un mot sur le WebP, puisque c'est l'option qu'on vous cache généralement : à qualité visuelle égale, il bat le PNG sur à peu près tout, transparence comprise. Le seul cas où le PNG reste préférable, c'est quand le fichier doit être ouvert par un vieux logiciel de bureau ou déposé sur une plateforme qui refuse le WebP. Ça arrive encore sur des formulaires administratifs.</p>
        <p class="pr-hint">À noter : notre compresseur générique, sur la page d'accueil et sur <a href="<?= url('/compresser-png') ?>">Compresser PNG</a>, ré-encode les PNG en WebP : c'est ce qui donne les meilleurs gains, mais le fichier change d'extension. La page où vous êtes fait l'inverse : elle garde du PNG en sortie, parce que quand on cherche à réduire un PNG, c'est souvent qu'on a besoin que ça reste un PNG.</p>

        <h2 id="dimensions">L'autre moitié de la question : réduire les dimensions</h2>
        <p>Si votre problème est un PNG qui fait 4000 px de large, la compression n'est pas la réponse. Le poids d'une image varie avec sa surface : diviser la largeur par deux divise le nombre de pixels par quatre. Aucune quantification n'approche ce résultat.</p>
        <p>La bonne séquence quand le fichier est vraiment trop lourd :</p>
        <ol class="seo-steps">
            <li><strong>Redimensionnez d'abord</strong> à la taille d'affichage réelle. Une image affichée dans une colonne de 800 px n'a besoin que de 1600 px de large, même sur écran haute densité.</li>
            <li><strong>Quantifiez ensuite</strong>, en 256 couleurs pour commencer.</li>
            <li><strong>Vérifiez le résultat</strong> avant de valider. Si le gain est décevant, c'est le signal qu'il faut changer de format.</li>
        </ol>
        <p>Dans cet ordre, jamais l'inverse : quantifier puis redimensionner gâche le travail de la palette, puisque le rééchantillonnage recrée des couleurs intermédiaires.</p>

        <h2 id="confidentialite">Où passent vos fichiers</h2>
        <p>Nulle part. L'encodeur PNG de cette page tourne entièrement dans votre navigateur : lecture du fichier, quantification, écriture des chunks PNG, compression zlib. Aucun octet de votre image ne quitte votre appareil, il n'y a pas d'upload à annuler ni de fichier à supprimer d'un serveur. Vous pouvez couper votre connexion après le chargement de la page, l'outil continue de fonctionner.</p>
        <p>C'est aussi pour ça que la limite est à 10 Mo et 10 fichiers : c'est la mémoire de votre onglet qui travaille, pas la nôtre.</p>

        <h2 id="faq">Questions fréquentes</h2>
        <div class="seo-faq">
            <?php foreach ($faq as $qa): ?>
                <details class="faq-item">
                    <summary><?= e($qa[0]) ?></summary>
                    <p><?= $qa[1] ?></p>
                </details>
            <?php endforeach; ?>
        </div>

        <h2 id="cas-usage">Votre PNG doit passer une limite précise ?</h2>
        <p>Ces pages partent d'une contrainte chiffrée plutôt que d'un format :</p>
        <ul class="seo-related">
            <li><a href="<?= url('/compresser-image-pour-mail') ?>">Compresser une image pour un e-mail</a></li>
            <li><a href="<?= url('/compresser-image-pour-wordpress') ?>">Compresser une image pour WordPress</a></li>
            <li><a href="<?= url('/compresser-image-pour-cv') ?>">Compresser une image pour un CV</a></li>
            <li><a href="<?= url('/compresser-image-1-mo') ?>">Compresser une image en 1 Mo</a></li>
            <li><a href="<?= url('/reduire-image-en-ko') ?>">Réduire une image en Ko</a></li>
            <li><a href="<?= url('/redimensionner-image-en-pixels') ?>">Redimensionner une image en pixels</a></li>
        </ul>
    </div>
</section>

<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'           => 'BreadcrumbList',
            '@id'             => url('/reduire-taille-png') . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Accueil', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Compresser PNG', 'item' => url('/compresser-png')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Réduire la taille d\'un PNG', 'item' => url('/reduire-taille-png')],
            ],
        ],
        [
            '@type'               => 'WebApplication',
            '@id'                 => url('/reduire-taille-png') . '#app',
            'name'                => 'Réducteur de PNG',
            'url'                 => url('/reduire-taille-png'),
            'description'         => 'Réduit le poids ou les dimensions d\'un fichier PNG dans le navigateur, avec une sortie qui reste au format PNG et conserve la transparence.',
            'applicationCategory' => 'MultimediaApplication',
            'operatingSystem'     => 'Web',
            'browserRequirements' => 'Navigateur supportant CompressionStream (Chrome, Edge, Firefox 113+, Safari 16.4+)',
            'featureList'         => [
                'Quantification de palette de 16 à 256 couleurs',
                'Mode poids maximal (Ko ou Mo)',
                'Redimensionnement en pixels',
                'Transparence (canal alpha) conservée via chunk tRNS',
                'Traitement 100 % local, aucun envoi de fichier',
            ],
            'offers' => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'EUR'],
        ],
        [
            '@type'      => 'FAQPage',
            '@id'        => url('/reduire-taille-png') . '#faq',
            'mainEntity' => array_map(fn($qa) => [
                '@type'          => 'Question',
                'name'           => $qa[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($qa[1])],
            ], $faq),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
