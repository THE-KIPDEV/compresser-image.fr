<?php
/**
 * Reusable compressor widget (drop zone + options + results).
 * Optional $widgetHint overrides the default file-type hint line.
 */
$widgetHint = $widgetHint ?? 'PNG, JPEG, WebP — Max 10 Mo par image (50 Mo en Pro)';
?>
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
                <p class="drop-zone-hint"><?= e($widgetHint) ?></p>
                <input type="file" id="fileInput" multiple accept="image/png,image/jpeg,image/webp" hidden>
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
