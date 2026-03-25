<section class="hero seo-hero">
    <div class="container">
        <h1>Optimiser vos images<br><span class="gradient-text">pour le web</span></h1>
        <p class="hero-sub">Améliorez la performance de votre site web en optimisant vos images. Compression intelligente pour un chargement rapide.</p>
    </div>
</section>

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
                <p class="drop-zone-text"><strong>Glissez vos images ici</strong> ou cliquez pour sélectionner</p>
                <p class="drop-zone-hint">PNG, JPEG, WebP — Max 10 Mo par image</p>
                <input type="file" id="fileInput" multiple accept="image/png,image/jpeg,image/webp" hidden>
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
            <button class="btn btn-primary btn-lg" id="compressBtn">Optimiser</button>
        </div>

        <div class="results-container" id="resultsContainer" style="display:none">
            <div class="results-header">
                <h2>Résultats</h2>
                <div class="results-actions">
                    <button class="btn btn-primary" id="downloadAllBtn">Tout télécharger</button>
                    <button class="btn btn-ghost" id="newCompressionBtn">Nouvelle optimisation</button>
                </div>
            </div>
            <div class="results-summary" id="resultsSummary"></div>
            <div class="results-list" id="resultsList"></div>
        </div>

        <div class="before-after-section" id="beforeAfterSection" style="display:none">
            <h2>Comparaison avant / après</h2>
            <div class="before-after-container" id="beforeAfterContainer">
                <div class="ba-image-wrapper">
                    <img id="baOriginal" alt="Image originale">
                    <div class="ba-overlay" id="baOverlay"><img id="baCompressed" alt="Image optimisée"></div>
                    <div class="ba-slider" id="baSlider">
                        <div class="ba-handle"><svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M8 4L4 12L8 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><path d="M16 4L20 12L16 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg></div>
                    </div>
                    <div class="ba-label ba-label-left">Avant</div>
                    <div class="ba-label ba-label-right">Après</div>
                </div>
            </div>
        </div>
    </div>
</section>

<section class="seo-content">
    <div class="container container-sm">
        <h2>Pourquoi optimiser vos images pour le web ?</h2>
        <p>L'optimisation des images est l'un des leviers les plus efficaces pour améliorer la vitesse de chargement d'un site web. Google considère la vitesse comme un facteur de classement important.</p>
        <h3>Impact sur le SEO</h3>
        <ul>
            <li><strong>Core Web Vitals</strong> : LCP (Largest Contentful Paint) est directement impacté par la taille des images</li>
            <li><strong>Taux de rebond</strong> : Un site lent fait fuir les visiteurs. 53% quittent après 3 secondes</li>
            <li><strong>Mobile-First</strong> : Google indexe la version mobile. Des images légères sont essentielles</li>
            <li><strong>PageSpeed Score</strong> : L'optimisation des images améliore significativement votre score</li>
        </ul>
        <h3>Bonnes pratiques</h3>
        <ul>
            <li>Utilisez le format WebP quand possible (30% plus léger que JPEG)</li>
            <li>Compressez toutes vos images avant de les mettre en ligne</li>
            <li>Utilisez des dimensions adaptées (pas d'image 4000px pour un affichage 800px)</li>
            <li>Ajoutez des attributs width/height pour éviter le layout shift</li>
        </ul>
    </div>
</section>
