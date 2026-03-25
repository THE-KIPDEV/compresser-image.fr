<!-- Hero -->
<section class="hero">
    <div class="container">
        <div class="hero-badge">Gratuit &bull; Sans inscription &bull; 100% sécurisé</div>
        <h1>Compressez vos images<br><span class="gradient-text">en quelques secondes</span></h1>
        <p class="hero-sub">Réduisez jusqu'à 80% la taille de vos fichiers PNG, JPEG et WebP sans perte de qualité visible. Comparez avant/après avec notre slider interactif.</p>
    </div>
</section>

<!-- Compressor -->
<section class="compressor-section" id="compressor">
    <div class="container">
        <!-- Drop Zone -->
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
                <p class="drop-zone-hint">PNG, JPEG, WebP — Max 10 Mo par image (50 Mo en Pro)</p>
                <input type="file" id="fileInput" multiple accept="image/png,image/jpeg,image/webp" hidden>
            </div>
            <div class="drop-zone-hover">
                <svg width="48" height="48" viewBox="0 0 48 48" fill="none">
                    <path d="M24 8V40M8 24H40" stroke="currentColor" stroke-width="3" stroke-linecap="round"/>
                </svg>
                <p>Déposez vos images</p>
            </div>
        </div>

        <!-- Options bar -->
        <div class="compress-options" id="compressOptions" style="display:none">
            <div class="options-row">
                <div class="option-group">
                    <label for="qualitySlider">Qualité de compression</label>
                    <div class="quality-control">
                        <input type="range" id="qualitySlider" min="10" max="95" value="80" class="range-slider">
                        <span class="quality-value" id="qualityValue">80%</span>
                    </div>
                    <div class="quality-labels">
                        <span>Plus léger</span>
                        <span>Plus net</span>
                    </div>
                </div>
                <div class="option-group">
                    <label>Mode de compression</label>
                    <div class="toggle-group">
                        <button class="toggle-btn active" data-mode="smart">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 1L10 5.5L15 6.5L11.5 10L12.5 15L8 12.5L3.5 15L4.5 10L1 6.5L6 5.5L8 1Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                            Intelligent
                        </button>
                        <button class="toggle-btn" data-mode="max">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M2 14L8 2L14 14H2Z" stroke="currentColor" stroke-width="1.5" stroke-linejoin="round"/></svg>
                            Maximum
                        </button>
                        <button class="toggle-btn pro-only" data-mode="mega" title="Méga compression — Pro uniquement">
                            <svg width="16" height="16" viewBox="0 0 16 16" fill="none"><path d="M8 1V15M1 8H15M3 3L13 13M13 3L3 13" stroke="currentColor" stroke-width="1.5" stroke-linecap="round"/></svg>
                            Méga
                            <span class="pro-tag">PRO</span>
                        </button>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-lg" id="compressBtn">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 8L10 2L16 8M4 12L10 18L16 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Compresser les images
            </button>
        </div>

        <!-- Results -->
        <div class="results-container" id="resultsContainer" style="display:none">
            <div class="results-header">
                <h2>Résultats</h2>
                <div class="results-actions">
                    <button class="btn btn-primary" id="downloadAllBtn">
                        <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M9 2V12M9 12L5 8M9 12L13 8M2 15H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                        Tout télécharger
                    </button>
                    <button class="btn btn-ghost" id="newCompressionBtn">Nouvelle compression</button>
                </div>
            </div>
            <div class="results-summary" id="resultsSummary"></div>
            <div class="results-list" id="resultsList"></div>
        </div>

        <!-- Before/After area (shown for single image) -->
        <div class="before-after-section" id="beforeAfterSection" style="display:none">
            <h2>Comparaison avant / après</h2>
            <div class="before-after-container" id="beforeAfterContainer">
                <div class="ba-image-wrapper">
                    <img id="baOriginal" alt="Image originale">
                    <div class="ba-overlay" id="baOverlay">
                        <img id="baCompressed" alt="Image compressée">
                    </div>
                    <div class="ba-slider" id="baSlider">
                        <div class="ba-handle">
                            <svg width="24" height="24" viewBox="0 0 24 24" fill="none">
                                <path d="M8 4L4 12L8 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                                <path d="M16 4L20 12L16 20" stroke="white" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/>
                            </svg>
                        </div>
                    </div>
                    <div class="ba-label ba-label-left">Avant</div>
                    <div class="ba-label ba-label-right">Après</div>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- Features -->
<section class="features">
    <div class="container">
        <h2 class="section-title">Pourquoi utiliser <span class="gradient-text">Compresser Image</span> ?</h2>
        <div class="features-grid">
            <div class="feature-card">
                <div class="feature-icon" style="--accent: #6366f1">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><path d="M14 3L17.5 10L25 11L19.5 16.5L21 24L14 20L7 24L8.5 16.5L3 11L10.5 10L14 3Z" stroke="currentColor" stroke-width="2" stroke-linejoin="round"/></svg>
                </div>
                <h3>100% Gratuit</h3>
                <p>Compressez autant d'images que vous voulez, sans inscription, sans limite cachée. La compression se fait dans votre navigateur.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="--accent: #ec4899">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><path d="M14 4V14L20 18" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/><circle cx="14" cy="14" r="11" stroke="currentColor" stroke-width="2"/></svg>
                </div>
                <h3>Ultra rapide</h3>
                <p>Compression instantanée directement dans votre navigateur. Pas d'upload vers un serveur, pas d'attente.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="--accent: #10b981">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><path d="M9 14L12.5 17.5L19 11" stroke="currentColor" stroke-width="2.5" stroke-linecap="round" stroke-linejoin="round"/><rect x="3" y="3" width="22" height="22" rx="6" stroke="currentColor" stroke-width="2"/></svg>
                </div>
                <h3>Qualité préservée</h3>
                <p>Notre algorithme intelligent réduit le poids sans perte visible. Comparez avec le slider avant/après pour vérifier.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="--accent: #f59e0b">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><path d="M14 3V7M14 21V25M3 14H7M21 14H25M6.2 6.2L9 9M19 19L21.8 21.8M21.8 6.2L19 9M9 19L6.2 21.8" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </div>
                <h3>Tous formats</h3>
                <p>PNG, JPEG, WebP — tous les formats populaires sont supportés. Choisissez votre niveau de compression.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="--accent: #8b5cf6">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><path d="M14 3C7.925 3 3 7.925 3 14s4.925 11 11 11 11-4.925 11-11S20.075 3 14 3Z" stroke="currentColor" stroke-width="2"/><path d="M10 13L14 9L18 13M14 9V19" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <h3>Slider avant/après</h3>
                <p>Comparez visuellement la qualité avant et après compression avec notre slider interactif tactile.</p>
            </div>
            <div class="feature-card">
                <div class="feature-icon" style="--accent: #06b6d4">
                    <svg width="28" height="28" viewBox="0 0 28 28" fill="none"><path d="M5 14H10L13 7L17 21L20 14H23" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </div>
                <h3>Traitement par lot</h3>
                <p>Compressez jusqu'à 10 images simultanément (100 en Pro). Téléchargez tout en un clic.</p>
            </div>
        </div>
    </div>
</section>

<!-- How it works -->
<section class="how-it-works">
    <div class="container">
        <h2 class="section-title">Comment ça marche ?</h2>
        <div class="steps-grid">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Déposez vos images</h3>
                <p>Glissez-déposez ou sélectionnez vos fichiers PNG, JPEG ou WebP.</p>
            </div>
            <div class="step-arrow">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M8 16H24M24 16L18 10M24 16L18 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <h3>Ajustez la qualité</h3>
                <p>Choisissez le niveau de compression : intelligent, maximum ou méga (Pro).</p>
            </div>
            <div class="step-arrow">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M8 16H24M24 16L18 10M24 16L18 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <h3>Téléchargez</h3>
                <p>Comparez avec le slider, puis téléchargez vos images compressées.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA -->
<section class="cta-section">
    <div class="container">
        <div class="cta-card">
            <div class="cta-content">
                <h2>Passez en <span class="gradient-text">Pro</span> pour aller encore plus loin</h2>
                <p>Méga compression serveur, batch de 100 images, fichiers jusqu'à 50 Mo, sans pub.</p>
                <div class="cta-price">
                    <span class="price">4,90€</span>
                    <span class="price-period">/mois</span>
                </div>
                <a href="<?= url('/tarifs') ?>" class="btn btn-primary btn-lg">Découvrir l'offre Pro</a>
            </div>
            <div class="cta-features">
                <div class="cta-feature">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 10L8.5 13.5L15 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Méga compression (jusqu'à -90%)
                </div>
                <div class="cta-feature">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 10L8.5 13.5L15 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    100 images par lot
                </div>
                <div class="cta-feature">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 10L8.5 13.5L15 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Fichiers jusqu'à 50 Mo
                </div>
                <div class="cta-feature">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 10L8.5 13.5L15 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Historique de compressions
                </div>
                <div class="cta-feature">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 10L8.5 13.5L15 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Sans publicité
                </div>
            </div>
        </div>
    </div>
</section>

<!-- FAQ -->
<section class="faq-section">
    <div class="container">
        <h2 class="section-title">Questions fréquentes</h2>
        <div class="faq-list">
            <details class="faq-item">
                <summary>Est-ce vraiment gratuit ?</summary>
                <p>Oui, la compression standard est 100% gratuite et illimitée. La compression se fait directement dans votre navigateur, sans envoyer vos images sur un serveur. L'offre Pro ajoute la méga compression serveur et les fonctionnalités avancées.</p>
            </details>
            <details class="faq-item">
                <summary>Mes images sont-elles sécurisées ?</summary>
                <p>Absolument. En mode gratuit, vos images ne quittent jamais votre navigateur — tout est traité localement. En mode Pro (compression serveur), les images sont supprimées immédiatement après le téléchargement.</p>
            </details>
            <details class="faq-item">
                <summary>Quelle est la différence entre les modes de compression ?</summary>
                <p><strong>Intelligent :</strong> Le meilleur équilibre qualité/taille (recommandé). <strong>Maximum :</strong> Compression plus agressive, légère perte de qualité possible. <strong>Méga (Pro) :</strong> Compression serveur avancée avec redimensionnement intelligent, jusqu'à 90% de réduction.</p>
            </details>
            <details class="faq-item">
                <summary>Quels formats sont supportés ?</summary>
                <p>PNG, JPEG (JPG) et WebP. Ce sont les formats les plus utilisés sur le web. Chaque format est optimisé avec l'algorithme le plus adapté.</p>
            </details>
            <details class="faq-item">
                <summary>Puis-je compresser plusieurs images à la fois ?</summary>
                <p>Oui ! Vous pouvez compresser jusqu'à 10 images simultanément en gratuit, et jusqu'à 100 en Pro. Toutes les images sont traitées en parallèle pour un résultat instantané.</p>
            </details>
            <details class="faq-item">
                <summary>Comment fonctionne le slider avant/après ?</summary>
                <p>Après compression, un slider interactif vous permet de comparer visuellement l'image originale et l'image compressée. Faites glisser le curseur (ou touchez sur mobile) pour voir la différence en temps réel.</p>
            </details>
        </div>
    </div>
</section>
