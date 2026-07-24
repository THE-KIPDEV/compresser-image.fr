<section class="hero seo-hero">
    <div class="container">
        <h1>Réduire la taille d'un PNG sans perte</h1>
        <p class="hero-sub">Le PNG est déjà un format sans perte. « Réduire sans perte » veut donc dire une chose précise — et souvent l'inverse de ce que proposent les outils qui vous font passer en JPG.</p>
        <div class="hero-formats">
            <span class="format-pill">PNG</span>
            <span class="format-pill-sep">sortie PNG · transparence conservée · rien n'est envoyé sur nos serveurs</span>
        </div>
    </div>
</section>

<?php partial('png-tool', ['toolHeading' => 'Réduire votre PNG, en gardant les pixels']); ?>

<section class="seo-content">
    <div class="container container-sm">

        <p><strong>En résumé :</strong> un PNG est déjà sans perte, donc l'alléger « sans perte » ne peut pas venir de la compression classique — elle est déjà à fond. Le vrai gain sans perte vient de trois gestes précis : retirer les métadonnées, supprimer un canal de transparence inutile, et — le plus rentable — <strong>ré-indexer une image qui a 256 couleurs ou moins</strong>, ce qui ne change pas un seul pixel mais divise le poids par deux ou trois. Au-delà, tout gain se paie en qualité. Cette page fait la part des choses, chiffres à l'appui.</p>

        <h2 id="deja-sans-perte">Le PNG est déjà sans perte : ça change tout</h2>
        <p>Contrairement au JPG, le PNG ne jette jamais d'information. Il compresse ses pixels avec DEFLATE (le même algorithme que le ZIP), un compresseur <em>réversible</em> : ce qui entre ressort à l'identique. Un PNG « bien enregistré » est donc déjà compressé au maximum de ce que DEFLATE sait faire.</p>
        <p>Conséquence directe, et contre-intuitive : il n'existe pas de bouton « compresser mon PNG sans perte » qui rapporterait beaucoup. Si votre logiciel a écrit le fichier correctement, la marge sans perte restante se compte en quelques pourcents. Quand un outil vous annonce « -70 % sans perte », il ment sur un des deux mots — soit ce n'est pas 70 %, soit ce n'est pas sans perte.</p>

        <h2 id="vrai-lossless">Ce que « sans perte » recouvre vraiment</h2>
        <p>Il faut distinguer trois opérations qu'on range à tort dans le même panier :</p>
        <ul>
            <li><strong>L'optimisation lossless au sens strict.</strong> On ne touche à aucun pixel : on retire des données annexes (métadonnées) et on recompresse plus finement. Gain réel : faible.</li>
            <li><strong>La ré-indexation d'une image à faible nombre de couleurs.</strong> Un logo enregistré en PNG-24 (couleurs « vraies ») mais qui n'utilise en fait que 200 teintes peut être réécrit en PNG-8 à palette. Chaque pixel retrouve exactement sa couleur — <em>c'est sans perte</em> — mais il n'occupe plus qu'un octet au lieu de trois ou quatre. C'est le seul geste sans perte à gros gain, et il ne marche que si l'image tient dans 256 couleurs.</li>
            <li><strong>La quantification avec réduction de couleurs.</strong> On force une palette plus petite que le nombre de couleurs réelles. Là, on perd : des teintes sont fusionnées. C'est ce que font TinyPNG et compagnie sous l'étiquette « smart lossy ». Visuellement invisible souvent, mais ce n'est pas du sans perte.</li>
        </ul>
        <p>L'outil de cette page lit votre fichier avant tout traitement et vous dit dans quel cas vous êtes : s'il compte <strong>256 couleurs distinctes ou moins</strong>, le PNG produit est identique au vôtre pixel pour pixel — sans perte, pour de vrai. Au-delà, il vous prévient que réduire davantage passe par une perte, à vous de trancher.</p>

        <h2 id="tableau">Ce que chaque technique lossless fait vraiment gagner</h2>
        <p>Les gains dépendent entièrement de comment le fichier a été enregistré au départ. Voici les ordres de grandeur réalistes, technique par technique.</p>

        <div class="pr-table-wrap">
            <table class="pr-table">
                <caption>Gains sans perte selon le type de PNG et le geste appliqué. Les fourchettes correspondent à des exports courants (Photoshop, Figma, captures d'écran) avant toute optimisation.</caption>
                <thead>
                    <tr>
                        <th scope="col">Type de PNG</th>
                        <th scope="col">Geste sans perte</th>
                        <th scope="col">Gain réaliste</th>
                        <th scope="col">Pixels modifiés ?</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Export avec métadonnées<br><span class="pr-detail">profil ICC, XMP, chunks texte</span></th>
                        <td>Retrait des chunks annexes</td>
                        <td>2 à 10 %</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <th scope="row">PNG-32 sans transparence<br><span class="pr-detail">canal alpha entièrement opaque</span></th>
                        <td>Suppression du canal alpha inutile</td>
                        <td>10 à 25 %</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <th scope="row">PNG mal compressé<br><span class="pr-detail">export rapide, DEFLATE non optimal</span></th>
                        <td>Recompression optimale (type zopfli)</td>
                        <td>5 à 15 %</td>
                        <td>Non</td>
                    </tr>
                    <tr>
                        <th scope="row">Logo / icône ≤ 256 couleurs<br><span class="pr-detail">écrit à tort en PNG-24</span></th>
                        <td>Ré-indexation en PNG-8 (palette)</td>
                        <td>40 à 70 %</td>
                        <td>Non — palette exacte</td>
                    </tr>
                    <tr>
                        <th scope="row">Photo enregistrée en PNG<br><span class="pr-detail">milliers de nuances</span></th>
                        <td>Aucun geste sans perte efficace</td>
                        <td>~0 % — changer de format</td>
                        <td>—</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <p>La quatrième ligne est la seule qui offre à la fois « sans perte » et « gros gain », et elle a une condition stricte : l'image doit vraiment tenir dans 256 couleurs. Beaucoup de logos, pictos et captures d'interface sont dans ce cas sans que personne ne le leur ait dit — leur PNG-24 gaspille deux octets par pixel. La dernière ligne est le piège inverse : sur une photo, aucune technique sans perte ne rapporte, parce qu'il n'y a aucune redondance à factoriser. Le seul vrai levier y est un changement de format, donc une perte assumée.</p>

        <h2 id="garder-ou-convertir">Quand garder le PNG, quand le lâcher</h2>
        <p>Le PNG n'a que deux atouts réels : la <strong>transparence</strong> et le rendu net des <strong>aplats et bords francs</strong> (logos, textes, interfaces). Si votre image a l'un des deux, restez en PNG et ré-indexez. Sinon, elle est en PNG par accident — souvent le réglage par défaut d'un outil de capture.</p>
        <ul>
            <li><strong>Transparence nécessaire ?</strong> Oui → PNG, ou <a href="<?= url('/convertir-png-en-webp') ?>">WebP</a> qui la gère aussi et pèse moins. Non → continuez.</li>
            <li><strong>C'est une photo ?</strong> Oui → <a href="<?= url('/convertir-png-en-jpg') ?>">convertissez en JPG</a>. Le gain se compte en dizaines, pas en pourcents.</li>
            <li><strong>Logo, capture, illustration à aplats ?</strong> Restez en PNG et ré-indexez avec l'outil ci-dessus.</li>
        </ul>

        <h2 id="vs-tinypng">Face à TinyPNG et aux logiciels de bureau</h2>
        <p>Deux familles d'outils reviennent sur cette requête, et aucune ne fait exactement ce que promet le mot « sans perte ».</p>
        <p><strong>TinyPNG, Compressor.io, iLoveIMG et similaires.</strong> Leur méthode par défaut est la <em>quantification avec réduction de couleurs</em> : ils diminuent le nombre de teintes pour gagner du poids. C'est efficace et souvent invisible, mais c'est une perte, pas du sans perte — leur propre documentation parle d'ailleurs de « lossy ». Autre point : votre fichier est <strong>téléversé sur leurs serveurs</strong>, et les offres gratuites plafonnent le nombre et la taille des images. Ici, tout se passe dans votre navigateur, aucun octet ne part, et l'outil vous dit quand la réduction est réellement sans perte.</p>
        <p><strong>Les logiciels lossless (OptiPNG, pngcrush, zopflipng).</strong> Eux sont honnêtement sans perte au sens strict : ils recompressent sans toucher aux pixels. Mais ils s'installent, s'utilisent souvent en ligne de commande, et leur gain reste celui de la première et troisième ligne du tableau — quelques pourcents à 15 %. Utiles pour un pipeline de développeur ; disproportionnés pour alléger deux ou trois images.</p>

        <h2 id="faq">Questions fréquentes</h2>
        <div class="seo-faq">
            <?php foreach ($faq as $qa): ?>
                <details class="faq-item">
                    <summary><?= e($qa[0]) ?></summary>
                    <p><?= $qa[1] ?></p>
                </details>
            <?php endforeach; ?>
        </div>

        <h2 id="autres">Pour aller plus loin sur le PNG</h2>
        <ul class="seo-related">
            <li><a href="<?= url('/reduire-taille-png') ?>">Réduire la taille d'un PNG : poids ou dimensions ?</a> — les mesures détaillées par palette</li>
            <li><a href="<?= url('/reduire-taille-png-windows') ?>">Réduire un PNG sous Windows</a> — Paint, Photos et leurs limites</li>
            <li><a href="<?= url('/compresser-png') ?>">Compresser un PNG</a> — ré-encodage en WebP pour le web</li>
            <li><a href="<?= url('/convertir-png-en-webp') ?>">Convertir un PNG en WebP</a></li>
            <li><a href="<?= url('/convertir-png-en-jpg') ?>">Convertir un PNG en JPG</a></li>
        </ul>
    </div>
</section>

<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'           => 'BreadcrumbList',
            '@id'             => url('/reduire-taille-png-sans-perte') . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Accueil', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Réduire la taille d\'un PNG', 'item' => url('/reduire-taille-png')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Réduire un PNG sans perte', 'item' => url('/reduire-taille-png-sans-perte')],
            ],
        ],
        [
            '@type'               => 'WebApplication',
            '@id'                 => url('/reduire-taille-png-sans-perte') . '#app',
            'name'                => 'Réducteur PNG sans perte',
            'url'                 => url('/reduire-taille-png-sans-perte'),
            'description'         => 'Réduit un PNG dans le navigateur en gardant le format PNG et la transparence. Détecte les images à ≤256 couleurs, ré-indexées sans modifier un seul pixel.',
            'applicationCategory' => 'MultimediaApplication',
            'operatingSystem'     => 'Web',
            'browserRequirements' => 'Navigateur supportant CompressionStream (Chrome, Edge, Firefox 113+, Safari 16.4+)',
            'featureList'         => [
                'Diagnostic avant compression : couleurs distinctes, niveaux de transparence',
                'Ré-indexation PNG-8 sans perte pour les images à ≤256 couleurs',
                'Transparence (canal alpha) conservée via chunk tRNS',
                'Traitement 100 % local, aucun envoi de fichier',
            ],
            'offers'              => ['@type' => 'Offer', 'price' => '0', 'priceCurrency' => 'EUR'],
        ],
        [
            '@type'      => 'FAQPage',
            '@id'        => url('/reduire-taille-png-sans-perte') . '#faq',
            'mainEntity' => array_map(fn($qa) => [
                '@type'          => 'Question',
                'name'           => $qa[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($qa[1])],
            ], $faq),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
