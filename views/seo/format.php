<!-- Hero SEO -->
<section class="hero seo-hero">
    <div class="container">
        <h1>Compresser <?= e($seoFormat) ?> en ligne, gratuitement</h1>
        <p class="hero-sub">Réduisez la taille de vos fichiers <?= e($seoFormat) ?> sans perte de qualité visible. Compression instantanée dans votre navigateur.</p>
    </div>
</section>

<!-- Compressor -->
<section class="compressor-section" id="compressor">
    <div class="container">
        <div class="drop-zone" id="dropZone">
            <div class="drop-zone-content">
                <div class="drop-zone-icon">
                    <svg width="56" height="56" viewBox="0 0 64 64" fill="none">
                        <rect x="4" y="12" width="56" height="44" rx="8" stroke="currentColor" stroke-width="2.5" stroke-dasharray="6 4"/>
                        <path d="M24 36L30 28L34 33L38 27L42 36" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                        <circle cx="26" cy="24" r="3" stroke="currentColor" stroke-width="2"/>
                        <path d="M32 8V18M32 8L27 13M32 8L37 13" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/>
                    </svg>
                </div>
                <p class="drop-zone-text"><strong>Glissez vos images <?= e($seoFormat) ?> ici</strong> ou cliquez pour sélectionner</p>
                <p class="drop-zone-hint"><?= e($seoFormat) ?> — Max 10 Mo (50 Mo en Pro)</p>
                <input type="file" id="fileInput" multiple accept="image/<?= strtolower($seoFormat === 'JPEG' ? 'jpeg' : $seoFormat) ?>" hidden>
            </div>
            <div class="drop-zone-hover">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><path d="M24 8V40M8 24H40" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                <p>Déposez vos images</p>
            </div>
        </div>

        <div class="preview-grid" id="previewGrid" style="display:none"></div>

        <div class="compress-options" id="compressOptions" style="display:none">
            <div class="compression-slider-wrap">
                <label>Niveau de compression</label>
                <div class="compression-levels">
                    <button class="level-btn active" data-level="light" data-quality="90">Léger</button>
                    <button class="level-btn" data-level="recommended" data-quality="75">Recommandé</button>
                    <button class="level-btn" data-level="strong" data-quality="50">Fort</button>
                    <button class="level-btn pro-only" data-level="mega" data-quality="30">Méga <span class="pro-tag">PRO</span></button>
                </div>
                <p class="compression-hint" id="compressionHint">Compression légère — Qualité quasi identique, fichier un peu plus léger.</p>
            </div>
            <button class="btn btn-primary btn-lg" id="compressBtn">Compresser</button>
        </div>

        <div class="results-container" id="resultsContainer" style="display:none">
            <div class="results-header">
                <h2>Résultats</h2>
                <div class="results-actions">
                    <button class="btn btn-primary" id="downloadAllBtn">Tout télécharger</button>
                    <button class="btn btn-ghost" id="newCompressionBtn">Recommencer</button>
                </div>
            </div>
            <div class="results-summary" id="resultsSummary"></div>
            <div class="results-list" id="resultsList"></div>
        </div>
    </div>
</section>

<!-- SEO Content -->
<section class="seo-content">
    <div class="container container-sm">
        <?php if ($seoFormat === 'PNG'): ?>
            <h2>Comment compresser un fichier PNG ?</h2>
            <p>Le format PNG est ideal pour les images avec de la transparence, les logos, les captures d'ecran et les illustrations. Cependant, les fichiers PNG peuvent etre volumineux.</p>
            <p>Notre outil utilise des algorithmes de quantification des couleurs et d'optimisation pour reduire la taille de vos fichiers PNG tout en preservant la transparence et la qualite visuelle.</p>
            <h3>Quand utiliser le PNG ?</h3>
            <ul>
                <li>Images avec transparence (logos, icones)</li>
                <li>Captures d'ecran et interfaces</li>
                <li>Illustrations avec des aplats de couleur</li>
                <li>Images necessitant une qualite sans perte</li>
            </ul>
        <?php elseif ($seoFormat === 'JPEG'): ?>
            <h2>Comment compresser un fichier JPEG ?</h2>
            <p>Le format JPEG est le plus utilise pour les photographies sur le web. Il offre un bon rapport qualite/taille grace a sa compression avec perte.</p>
            <p>Notre compresseur JPEG ajuste le taux de compression pour reduire la taille tout en maintenant une qualite visuelle correcte.</p>
            <h3>Quand utiliser le JPEG ?</h3>
            <ul>
                <li>Photographies et images realistes</li>
                <li>Images de fond pour sites web</li>
                <li>Photos de produits e-commerce</li>
                <li>Images de blog et articles</li>
            </ul>
        <?php elseif ($seoFormat === 'WebP'): ?>
            <h2>Comment compresser un fichier WebP ?</h2>
            <p>Le format WebP, developpe par Google, offre la meilleure compression pour le web. Il combine les avantages du JPEG et du PNG dans un seul format.</p>
            <p>Notre outil optimise vos fichiers WebP pour une taille encore plus reduite, parfait pour ameliorer les performances de votre site.</p>
            <h3>Pourquoi utiliser le WebP ?</h3>
            <ul>
                <li>Meilleure compression que JPEG et PNG</li>
                <li>Supporte la transparence</li>
                <li>Recommande par Google pour le web</li>
                <li>Ameliore le score PageSpeed Insights</li>
            </ul>
        <?php endif; ?>
    </div>
</section>
