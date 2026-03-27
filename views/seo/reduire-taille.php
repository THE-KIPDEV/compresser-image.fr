<section class="hero seo-hero">
    <div class="container">
        <h1>Réduire la taille d'une image en ligne</h1>
        <p class="hero-sub">PNG, JPEG, WebP — réduisez le poids de vos images en quelques secondes. Gratuit, sans inscription.</p>
    </div>
</section>

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
                <p class="drop-zone-text"><strong>Glissez vos images ici</strong> ou cliquez pour sélectionner</p>
                <p class="drop-zone-hint">PNG, JPEG, WebP — Max 10 Mo par image</p>
                <input type="file" id="fileInput" multiple accept="image/png,image/jpeg,image/webp" hidden>
            </div>
            <div class="drop-zone-hover">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none"><path d="M24 8V40M8 24H40" stroke="currentColor" stroke-width="3" stroke-linecap="round"/></svg>
                <p>Déposez vos images</p>
            </div>
        </div>

        <div class="preview-grid" id="previewGrid" style="display:none"></div>

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

<section class="seo-content">
    <div class="container container-sm">
        <h2>Pourquoi réduire la taille de vos images ?</h2>
        <p>Les images representent souvent plus de 50% du poids d'une page web. Reduire leur taille ameliore les temps de chargement, l'experience utilisateur et le referencement.</p>
        <h3>Les avantages</h3>
        <ul>
            <li><strong>Vitesse</strong> : Pages web plus rapides</li>
            <li><strong>SEO</strong> : Google favorise les sites rapides</li>
            <li><strong>Stockage</strong> : Moins d'espace sur votre serveur</li>
            <li><strong>Bande passante</strong> : Couts d'hebergement reduits</li>
            <li><strong>Mobile</strong> : Chargement plus rapide sur reseau mobile</li>
        </ul>
    </div>
</section>
