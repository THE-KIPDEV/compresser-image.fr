<!-- Hero -->
<section class="hero">
    <div class="container">
        <h1>Compressez vos images<br>sans perdre en qualité</h1>
        <p class="hero-sub">Déposez vos fichiers, choisissez le niveau de compression, téléchargez. C'est tout.<br>Gratuit, sans inscription, tout se passe dans votre navigateur.</p>
        <div class="hero-formats">
            <span class="format-pill">PNG</span>
            <span class="format-pill">JPEG</span>
            <span class="format-pill">WebP</span>
            <span class="format-pill-sep">jusqu'à -80%</span>
        </div>
    </div>
</section>

<!-- Compressor -->
<section class="compressor-section" id="compressor">
    <div class="container">
        <!-- Drop Zone -->
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

        <!-- Preview des images sélectionnées -->
        <div class="preview-grid" id="previewGrid" style="display:none"></div>

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
                    <label>Mode</label>
                    <div class="toggle-group">
                        <button class="toggle-btn active" data-mode="smart">Intelligent</button>
                        <button class="toggle-btn" data-mode="max">Maximum</button>
                        <button class="toggle-btn pro-only" data-mode="mega" title="Méga compression — Pro uniquement">
                            Méga
                            <span class="pro-tag">PRO</span>
                        </button>
                    </div>
                </div>
            </div>
            <button class="btn btn-primary btn-lg" id="compressBtn">
                <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 8L10 2L16 8M4 12L10 18L16 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                Compresser
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
                    <button class="btn btn-ghost" id="newCompressionBtn">Recommencer</button>
                </div>
            </div>
            <div class="results-summary" id="resultsSummary"></div>
            <div class="results-list" id="resultsList"></div>
        </div>
    </div>
</section>

<!-- Reassurance -->
<section class="reassurance">
    <div class="container">
        <div class="reassurance-grid">
            <div class="reassurance-item">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M12 22C17.5228 22 22 17.5228 22 12C22 6.47715 17.5228 2 12 2C6.47715 2 2 6.47715 2 12C2 17.5228 6.47715 22 12 22Z" stroke="currentColor" stroke-width="2"/><path d="M8 12L11 15L16 9" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <div>
                    <strong>Rien ne quitte votre navigateur</strong>
                    <p>Vos images sont compressées localement. Aucun fichier n'est envoyé sur un serveur.</p>
                </div>
            </div>
            <div class="reassurance-item">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M13 2L3 14H12L11 22L21 10H12L13 2Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <div>
                    <strong>Compression instantanée</strong>
                    <p>Pas d'upload, pas de file d'attente. Le résultat est immédiat.</p>
                </div>
            </div>
            <div class="reassurance-item">
                <svg width="24" height="24" viewBox="0 0 24 24" fill="none"><path d="M20 7L12 3L4 7M20 7V17L12 21M20 7L12 11M12 21L4 17V7M12 21V11M4 7L12 11" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <div>
                    <strong>PNG, JPEG, WebP</strong>
                    <p>Les 3 formats les plus courants sur le web, chacun optimisé différemment.</p>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- How it works -->
<section class="how-it-works">
    <div class="container">
        <h2 class="section-title">3 étapes, c'est tout</h2>
        <div class="steps-grid">
            <div class="step">
                <div class="step-number">1</div>
                <h3>Déposez</h3>
                <p>Glissez vos images ou cliquez pour les sélectionner. Jusqu'à 10 à la fois.</p>
            </div>
            <div class="step-arrow">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M8 16H24M24 16L18 10M24 16L18 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div class="step">
                <div class="step-number">2</div>
                <h3>Réglez</h3>
                <p>Ajustez le curseur de qualité selon vos besoins : léger ou maximal.</p>
            </div>
            <div class="step-arrow">
                <svg width="32" height="32" viewBox="0 0 32 32" fill="none"><path d="M8 16H24M24 16L18 10M24 16L18 22" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            </div>
            <div class="step">
                <div class="step-number">3</div>
                <h3>Téléchargez</h3>
                <p>Récupérez vos images allégées en un clic. Individuellement ou par lot.</p>
            </div>
        </div>
    </div>
</section>

<!-- CTA Pro -->
<section class="cta-section">
    <div class="container">
        <div class="cta-card">
            <div class="cta-content">
                <h2>Besoin de plus ?</h2>
                <p>Méga compression serveur, lots de 100 images, fichiers jusqu'à 50 Mo.</p>
                <div class="cta-price">
                    <span class="price">4,90€</span>
                    <span class="price-period">/mois</span>
                </div>
                <a href="<?= url('/tarifs') ?>" class="btn btn-primary btn-lg">Voir l'offre Pro</a>
            </div>
            <div class="cta-features">
                <div class="cta-feature">
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M5 10L8.5 13.5L15 7" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                    Compression serveur avancée (jusqu'à -90%)
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
                    Historique + tableau de bord
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
                <summary>C'est vraiment gratuit ?</summary>
                <p>Oui. La compression standard se fait dans votre navigateur, sans limite et sans inscription. L'offre Pro est là pour ceux qui ont besoin de compresser en masse ou avec une qualité serveur.</p>
            </details>
            <details class="faq-item">
                <summary>Mes images restent-elles privées ?</summary>
                <p>En mode gratuit, tout se passe dans votre navigateur. Aucun fichier n'est envoyé nulle part. En mode Pro, les images passent par notre serveur le temps de la compression, puis sont supprimées immédiatement.</p>
            </details>
            <details class="faq-item">
                <summary>C'est quoi la différence entre Intelligent et Maximum ?</summary>
                <p><strong>Intelligent</strong> trouve le bon équilibre entre qualité et poids — c'est le mode recommandé. <strong>Maximum</strong> pousse la compression plus loin, avec parfois une légère perte visible. <strong>Méga</strong> (Pro) passe par le serveur pour aller encore plus loin.</p>
            </details>
            <details class="faq-item">
                <summary>Quels formats sont supportés ?</summary>
                <p>PNG, JPEG et WebP. Ce sont les trois formats d'image les plus utilisés sur le web.</p>
            </details>
            <details class="faq-item">
                <summary>Combien d'images en même temps ?</summary>
                <p>10 en gratuit, 100 en Pro. Toutes les images sont traitées en parallèle.</p>
            </details>
        </div>
    </div>
</section>
