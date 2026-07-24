<?php
/**
 * PNG reducer tool markup — driven by public/js/png-reducer.js (hooks #pngReducer).
 * Output stays a real PNG (palette PNG-8 + tRNS), transparency preserved, 100 % local.
 * Shared by the pages that need a genuine PNG-out compressor:
 *   /reduire-taille-png-sans-perte and /reduire-taille-png-windows.
 * $toolHeading — optional H2 label above the fork.
 */
$toolHeading = $toolHeading ?? 'Votre PNG est trop lourd, ou trop grand ?';
?>
<section class="compressor-section">
    <div class="container container-sm" id="pngReducer">

        <h2 id="votre-probleme"><?= e($toolHeading) ?></h2>
        <div class="pr-fork">
            <button type="button" class="pr-card" data-path="poids" aria-pressed="false">
                <h3>Trop lourd (Ko / Mo)</h3>
                <p>Le fichier pèse trop. On réduit son poids sans toucher aux dimensions.</p>
                <span class="pr-eg">« 4 Mo, refusé à l'envoi », « il faut moins de 500 Ko »</span>
            </button>
            <button type="button" class="pr-card" data-path="dimensions" aria-pressed="false">
                <h3>Trop grand (pixels)</h3>
                <p>L'image fait 4000 px de large. On change ses dimensions.</p>
                <span class="pr-eg">« il me faut du 1080 px », « ça déborde de la page »</span>
            </button>
        </div>

        <div id="prStepDrop" hidden>
            <div class="pr-drop" id="prDropZone" tabindex="0" role="button" aria-label="Déposer des fichiers PNG">
                <strong>Glissez vos PNG ici</strong>
                <span>ou cliquez pour choisir — 10 PNG max, 10 Mo par fichier</span>
                <input type="file" id="prFileInput" accept="image/png" multiple hidden>
            </div>

            <div id="prDiag" hidden>
                <h3 class="pr-diag-title">Ce que vos fichiers ont dans le ventre</h3>
                <div id="prDiagList"></div>
                <p class="pr-hint">Lu directement dans vos pixels, sur votre machine, avant de compresser quoi que ce soit. Rien n'est envoyé nulle part.</p>
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
