<!-- Hero SEO -->
<section class="hero seo-hero">
    <div class="container">
        <h1>Compresser <?= e($seoFormat) ?> en ligne<br><span class="gradient-text">gratuitement</span></h1>
        <p class="hero-sub">Réduisez la taille de vos fichiers <?= e($seoFormat) ?> sans perte de qualité visible. Compression instantanée dans votre navigateur.</p>
    </div>
</section>

<!-- Compressor (same as home) -->
<section class="compressor-section" id="compressor">
    <div class="container">
        <div class="drop-zone" id="dropZone">
            <div class="drop-zone-content">
                <div class="drop-zone-icon">
                    <svg width="64" height="64" viewBox="0 0 64 64" fill="none">
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

        <div class="compress-options" id="compressOptions" style="display:none">
            <div class="options-row">
                <div class="option-group">
                    <label for="qualitySlider">Qualité</label>
                    <div class="quality-control">
                        <input type="range" id="qualitySlider" min="10" max="95" value="80" class="range-slider">
                        <span class="quality-value" id="qualityValue">80%</span>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-lg" id="compressBtn">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 8L10 2L16 8M4 12L10 18L16 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Compresser
            </button>
        </div>

        <div class="results-container" id="resultsContainer" style="display:none">
            <div class="results-header">
                <h2>Résultats</h2>
                <div class="results-actions">
                    <button class="btn btn-primary" id="downloadAllBtn">Tout télécharger</button>
                    <button class="btn btn-ghost" id="newCompressionBtn">Nouvelle compression</button>
                </div>
            </div>
            <div class="results-summary" id="resultsSummary"></div>
            <div class="results-list" id="resultsList"></div>
        </div>

        <div class="before-after-section" id="beforeAfterSection" style="display:none">
            <h2>Comparaison avant / après</h2>
            <div class="before-after-container" id="beforeAfterContainer">
                <div class="ba-image-wrapper">
                    <img id="baOriginal" alt="Image originale <?= e($seoFormat) ?>">
                    <div class="ba-overlay" id="baOverlay">
                        <img id="baCompressed" alt="Image compressée <?= e($seoFormat) ?>">
                    </div>
                    <div class="ba-slider" id="baSlider">
                        <div class="ba-handle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M8 4L4 12L8 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 4L20 12L16 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        </div>
                    </div>
                    <div class="ba-label ba-label-left">Avant</div>
                    <div class="ba-label ba-label-right">Après</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- SEO Content -->
<section class="seo-content">
    <div class="container container-sm">
        <?php if ($seoFormat === 'PNG'): ?>
            <h2>Comment compresser un fichier PNG ?</h2>
            <p>Le format PNG (Portable Network Graphics) est idéal pour les images avec de la transparence, les logos, les captures d'écran et les illustrations. Cependant, les fichiers PNG peuvent être assez volumineux.</p>
            <p>Notre outil de compression PNG utilise des algorithmes de quantification des couleurs et d'optimisation sans perte pour réduire significativement la taille de vos fichiers PNG tout en préservant la transparence et la qualité visuelle.</p>
            <h3>Quand utiliser le PNG ?</h3>
            <ul>
                <li>Images avec transparence (logos, icônes)</li>
                <li>Captures d'écran et interfaces</li>
                <li>Illustrations et graphiques avec des aplats de couleur</li>
                <li>Images nécessitant une qualité sans perte</li>
            </ul>
        <?php elseif ($seoFormat === 'JPEG'): ?>
            <h2>Comment compresser un fichier JPEG ?</h2>
            <p>Le format JPEG (Joint Photographic Experts Group) est le format le plus utilisé pour les photographies sur le web. Il offre un excellent rapport qualité/taille grâce à sa compression avec perte.</p>
            <p>Notre compresseur JPEG ajuste intelligemment le taux de compression pour réduire la taille du fichier tout en maintenant une qualité visuelle optimale. Le slider avant/après vous permet de vérifier le résultat.</p>
            <h3>Quand utiliser le JPEG ?</h3>
            <ul>
                <li>Photographies et images réalistes</li>
                <li>Images de fond pour sites web</li>
                <li>Photos de produits e-commerce</li>
                <li>Images de blog et articles</li>
            </ul>
        <?php elseif ($seoFormat === 'WebP'): ?>
            <h2>Comment compresser un fichier WebP ?</h2>
            <p>Le format WebP, développé par Google, offre la meilleure compression pour le web. Il combine les avantages du JPEG (compression efficace) et du PNG (transparence) dans un seul format.</p>
            <p>Notre outil optimise vos fichiers WebP pour une taille encore plus réduite, parfait pour améliorer les performances de votre site web et votre score Google PageSpeed.</p>
            <h3>Pourquoi utiliser le WebP ?</h3>
            <ul>
                <li>Meilleure compression que JPEG et PNG</li>
                <li>Supporte la transparence</li>
                <li>Recommandé par Google pour le web</li>
                <li>Améliore le score PageSpeed Insights</li>
            </ul>
        <?php endif; ?>
    </div>
</section>
