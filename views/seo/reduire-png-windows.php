<section class="hero seo-hero">
    <div class="container">
        <h1>Réduire la taille d'un PNG sous Windows</h1>
        <p class="hero-sub">Paint et l'appli Photos savent redimensionner un PNG, mais pas vraiment le compresser. Voici la méthode pas-à-pas, ses limites, et l'alternative qui allège pour de bon.</p>
        <div class="hero-formats">
            <span class="format-pill">Windows 11 / 10</span>
            <span class="format-pill-sep">Paint · Photos · + encart macOS</span>
        </div>
    </div>
</section>

<section class="seo-content">
    <div class="container container-sm">

        <p><strong>En résumé :</strong> les outils préinstallés de Windows réduisent le poids d'un PNG uniquement en lui retirant des pixels (redimensionnement). Ils n'ont aucun réglage de compression : ré-enregistrer un PNG aux mêmes dimensions ne l'allège pas, et peut même l'alourdir. Pour vraiment compresser un PNG — réduire sa palette sans toucher aux dimensions — il faut un outil qui sait le faire, comme celui plus bas sur cette page. On commence par la méthode Windows, honnêtement, avec ce qu'elle donne et ce qu'elle ne donne pas.</p>

        <h2 id="paint">Méthode 1 — Paint (redimensionner)</h2>
        <p>Paint est préinstallé sur toutes les versions de Windows. Il ne compresse pas, mais il redimensionne, et sur une image trop grande c'est souvent suffisant pour faire chuter le poids.</p>
        <ol class="seo-steps">
            <li><strong>Ouvrez le PNG dans Paint.</strong> Clic droit sur le fichier → « Ouvrir avec » → Paint.</li>
            <li><strong>Cliquez sur « Redimensionner »</strong> (onglet Accueil, ou raccourci Ctrl+W).</li>
            <li><strong>Passez en « Pixels »</strong> plutôt qu'en pourcentage, et gardez « Conserver les proportions » coché.</li>
            <li><strong>Saisissez une largeur plus petite</strong> — par exemple 1000 px si l'image en fait 3000. La hauteur se calcule seule.</li>
            <li><strong>Enregistrez sous</strong> → « Image PNG ». Gardez bien le format PNG en sortie : choisir JPEG ferait disparaître la transparence.</li>
        </ol>
        <p class="pr-hint">Bon à savoir : le Paint de Windows 11 conserve la transparence des PNG. Les versions plus anciennes la remplaçaient par du blanc — si vos zones transparentes deviennent blanches, c'est que votre Paint est trop ancien.</p>

        <h2 id="photos">Méthode 2 — l'appli Photos (redimensionner)</h2>
        <p>L'application Photos de Windows 11 propose aussi un redimensionnement, un peu plus guidé que Paint.</p>
        <ol class="seo-steps">
            <li><strong>Clic droit sur le PNG</strong> → « Redimensionner l'image » (ou ouvrez-le dans Photos puis menu « … » → « Redimensionner l'image »).</li>
            <li><strong>Choisissez « Définir des dimensions personnalisées »</strong> et entrez la nouvelle largeur en pixels.</li>
            <li><strong>Le curseur « Qualité »</strong> apparaît, mais retenez ceci : sur un PNG il ne sert à rien. La qualité réglable est une notion JPEG ; le PNG étant sans perte, le curseur n'a aucun effet sur lui.</li>
            <li><strong>Enregistrez la copie redimensionnée.</strong></li>
        </ol>

        <div class="pr-warn">
            <p><strong>Le point que personne ne dit :</strong> Paint comme Photos ne <em>compressent</em> pas un PNG, ils le <em>redimensionnent</em>. Leur seul levier de poids, c'est le nombre de pixels. Si votre PNG est déjà à la bonne taille d'affichage mais trop lourd, ces outils ne peuvent rien pour vous — ré-enregistrer le fichier le laissera au même poids, voire le gonflera un peu, parce qu'ils réécrivent la compression sans l'optimiser.</p>
        </div>

        <h2 id="alternative">L'alternative qui compresse vraiment, sans rien installer</h2>
        <p>Compresser un PNG sans réduire ses dimensions, c'est réduire sa <strong>palette de couleurs</strong> : remplacer des milliers de nuances quasi identiques par 256 entrées suffisantes, chaque pixel ne stockant plus qu'un numéro. Ni Paint ni Photos ne savent le faire. L'outil ci-dessous, oui — et tout se passe dans votre navigateur, aucun fichier n'est envoyé.</p>

        <?php partial('png-tool', ['toolHeading' => 'Compresser un PNG sans logiciel']); ?>

        <p>Sur un logo ou une capture d'écran, ré-indexer en 256 couleurs fait typiquement gagner 70 à 80 % de poids <em>sans</em> réduire les dimensions — là où Paint, à dimensions égales, ne gagne rien. Le résultat reste un vrai fichier .png et la transparence est conservée. Nos mesures détaillées par palette sont sur la page <a href="<?= url('/reduire-taille-png') ?>">Réduire la taille d'un PNG</a>.</p>

        <h2 id="comparatif">Windows, macOS, en ligne : qui fait quoi</h2>
        <div class="pr-table-wrap">
            <table class="pr-table">
                <caption>Ce que chaque méthode réduit réellement, et à quel prix. « Redim. » = elle n'agit qu'en retirant des pixels ; « Palette » = elle compresse aussi à dimensions égales.</caption>
                <thead>
                    <tr>
                        <th scope="col">Méthode</th>
                        <th scope="col">Réduit le poids par</th>
                        <th scope="col">Transparence</th>
                        <th scope="col">Gratuit</th>
                        <th scope="col">Installation</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">Paint (Windows)</th>
                        <td>Redim. uniquement</td>
                        <td>Oui (Windows 11)</td>
                        <td>Oui, préinstallé</td>
                        <td>—</td>
                    </tr>
                    <tr>
                        <th scope="row">Photos (Windows)</th>
                        <td>Redim. (curseur qualité sans effet sur PNG)</td>
                        <td>Oui</td>
                        <td>Oui, préinstallé</td>
                        <td>—</td>
                    </tr>
                    <tr>
                        <th scope="row">Aperçu (macOS)</th>
                        <td>Redim. / export JPG</td>
                        <td>Oui en PNG</td>
                        <td>Oui, préinstallé</td>
                        <td>—</td>
                    </tr>
                    <tr>
                        <th scope="row">Outil en ligne (cette page)</th>
                        <td>Palette + dimensions</td>
                        <td>Oui (chunk tRNS)</td>
                        <td>Oui</td>
                        <td>Aucune</td>
                    </tr>
                    <tr>
                        <th scope="row">OptiPNG / zopflipng</th>
                        <td>Recompression lossless</td>
                        <td>Oui</td>
                        <td>Oui</td>
                        <td>Logiciel à installer</td>
                    </tr>
                </tbody>
            </table>
        </div>

        <h2 id="macos">Et sous macOS : l'équivalent avec Aperçu</h2>
        <p>Sur Mac, l'application Aperçu joue le même rôle que Paint et Photos réunis, avec les mêmes limites.</p>
        <ol class="seo-steps">
            <li><strong>Ouvrez le PNG dans Aperçu</strong> (double-clic).</li>
            <li><strong>Menu Outils → Ajuster la taille</strong> : saisissez une nouvelle largeur en pixels, « Rééchantillonner l'image » coché.</li>
            <li><strong>Fichier → Exporter</strong> : gardez le format PNG pour conserver la transparence. En PNG, il n'y a pas de curseur de qualité ; ce curseur n'apparaît que si vous exportez en JPEG (au prix de la transparence).</li>
        </ol>
        <p class="pr-hint">Comme sous Windows, Aperçu redimensionne mais ne réduit pas la palette d'un PNG. Pour compresser sans changer les dimensions, l'outil en ligne de cette page fonctionne aussi bien sur Mac que sur PC.</p>

        <h2 id="faq">Questions fréquentes</h2>
        <div class="seo-faq">
            <?php foreach ($faq as $qa): ?>
                <details class="faq-item">
                    <summary><?= e($qa[0]) ?></summary>
                    <p><?= $qa[1] ?></p>
                </details>
            <?php endforeach; ?>
        </div>

        <h2 id="autres">À lire ensuite</h2>
        <ul class="seo-related">
            <li><a href="<?= url('/reduire-taille-png') ?>">Réduire la taille d'un PNG : poids ou dimensions ?</a></li>
            <li><a href="<?= url('/reduire-taille-png-sans-perte') ?>">Réduire un PNG sans perte</a> — vrai lossless ou pas</li>
            <li><a href="<?= url('/compresser-png') ?>">Compresser un PNG</a></li>
            <li><a href="<?= url('/convertir-png-en-webp') ?>">Convertir un PNG en WebP</a></li>
        </ul>
    </div>
</section>

<script type="application/ld+json">
<?= json_encode([
    '@context' => 'https://schema.org',
    '@graph'   => [
        [
            '@type'           => 'BreadcrumbList',
            '@id'             => url('/reduire-taille-png-windows') . '#breadcrumb',
            'itemListElement' => [
                ['@type' => 'ListItem', 'position' => 1, 'name' => 'Accueil', 'item' => url('/')],
                ['@type' => 'ListItem', 'position' => 2, 'name' => 'Réduire la taille d\'un PNG', 'item' => url('/reduire-taille-png')],
                ['@type' => 'ListItem', 'position' => 3, 'name' => 'Réduire un PNG sous Windows', 'item' => url('/reduire-taille-png-windows')],
            ],
        ],
        [
            '@type'       => 'HowTo',
            '@id'         => url('/reduire-taille-png-windows') . '#howto',
            'name'        => 'Réduire la taille d\'un PNG sous Windows avec Paint',
            'description' => 'Redimensionner un PNG sous Windows avec Paint, en conservant le format PNG et la transparence.',
            'totalTime'   => 'PT2M',
            'tool'        => ['@type' => 'HowToTool', 'name' => 'Microsoft Paint (Windows)'],
            'step'        => [
                ['@type' => 'HowToStep', 'position' => 1, 'name' => 'Ouvrir dans Paint', 'text' => 'Clic droit sur le fichier PNG, Ouvrir avec, Paint.'],
                ['@type' => 'HowToStep', 'position' => 2, 'name' => 'Redimensionner', 'text' => 'Cliquez sur Redimensionner (Ctrl+W), passez en Pixels, gardez les proportions.'],
                ['@type' => 'HowToStep', 'position' => 3, 'name' => 'Choisir une largeur plus petite', 'text' => 'Saisissez une largeur réduite ; la hauteur se calcule automatiquement.'],
                ['@type' => 'HowToStep', 'position' => 4, 'name' => 'Enregistrer en PNG', 'text' => 'Enregistrer sous, Image PNG, pour conserver la transparence.'],
            ],
        ],
        [
            '@type'      => 'FAQPage',
            '@id'        => url('/reduire-taille-png-windows') . '#faq',
            'mainEntity' => array_map(fn($qa) => [
                '@type'          => 'Question',
                'name'           => $qa[0],
                'acceptedAnswer' => ['@type' => 'Answer', 'text' => strip_tags($qa[1])],
            ], $faq),
        ],
    ],
], JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_PRETTY_PRINT) ?>
</script>
