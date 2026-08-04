/**
 * compressor.js — Client-side image compression engine + UI
 */

(function () {
    'use strict';

    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const previewGrid = document.getElementById('previewGrid');
    const compressOptions = document.getElementById('compressOptions');
    const compressionHint = document.getElementById('compressionHint');
    const compressBtn = document.getElementById('compressBtn');
    const resultsContainer = document.getElementById('resultsContainer');
    const resultsSummary = document.getElementById('resultsSummary');
    const resultsList = document.getElementById('resultsList');
    const downloadAllBtn = document.getElementById('downloadAllBtn');
    const newCompressionBtn = document.getElementById('newCompressionBtn');

    if (!dropZone) return;

    const dropTextEl = dropZone.querySelector('.drop-zone-text');
    const dropTextDefault = dropTextEl ? dropTextEl.innerHTML : '';
    function setDropText(html) { if (dropTextEl) dropTextEl.innerHTML = html; }

    let selectedFiles = [];
    let compressedFiles = [];
    let currentQuality = 90; // default: light
    let currentLevel = 'light';

    // Per-page widget config (set inline by SEO landing pages).
    // mode: 'compress' (default) | 'convert' | 'target' | 'resize'
    var CONFIG = window.COMPRESSOR_CONFIG || {};
    var MODE = CONFIG.mode || 'compress';
    var FORCE_OUTPUT = CONFIG.output || null; // e.g. 'image/jpeg' for conversion pages
    var targetInput = document.getElementById('targetSizeInput');
    var resizeW = document.getElementById('resizeWidth');
    var resizeH = document.getElementById('resizeHeight');
    var resizeLock = document.getElementById('resizeLock');

    // Pro state + limits (exposed by the layout in window.APP). Pro subscribers get
    // the server-side méga compression, 50 Mo per image and 100 images per batch —
    // the perks they actually pay for.
    var APP = window.APP || {};
    var IS_PRO = !!APP.pro;
    var COMPRESS_URL = APP.compressUrl || '/api/compress';
    var MAX_FILE_SIZE = IS_PRO ? 50 * 1024 * 1024 : 10 * 1024 * 1024;
    var MAX_BATCH = IS_PRO ? 100 : 10;

    var hints = {
        light: 'Compression légère — Qualité quasi identique, fichier un peu plus léger.',
        recommended: 'Recommandé — Bon équilibre entre qualité et poids. Idéal pour le web.',
        strong: 'Compression forte — Fichier beaucoup plus léger, légère perte de qualité possible.',
        mega: IS_PRO
            ? 'Méga compression — Réduction maximale via notre serveur (jusqu\'à -90%). Traitée sur nos serveurs sécurisés.'
            : 'Méga compression — Réduction maximale via notre serveur. Abonnement Pro requis.',
    };

    // Unlock the Méga level for Pro subscribers so the button they paid for works.
    (function unlockMega() {
        if (!IS_PRO) return;
        document.querySelectorAll('.level-btn.pro-only').forEach(function (btn) {
            btn.classList.add('pro-only-unlocked');
            var tag = btn.querySelector('.pro-tag');
            if (tag) tag.remove();
        });
    })();

    // ───── Drop Zone ─────

    dropZone.addEventListener('click', () => fileInput.click());
    fileInput.addEventListener('change', (e) => handleFiles(e.target.files));

    dropZone.addEventListener('dragover', (e) => {
        e.preventDefault();
        dropZone.classList.add('dragging');
    });

    dropZone.addEventListener('dragleave', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragging');
    });

    dropZone.addEventListener('drop', (e) => {
        e.preventDefault();
        dropZone.classList.remove('dragging');
        handleFiles(e.dataTransfer.files);
    });

    async function handleFiles(files) {
        const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
        const maxSize = MAX_FILE_SIZE;
        const incoming = Array.from(files);

        let standard = incoming.filter(f => validTypes.includes(f.type));

        // HEIC (photos iPhone) : décodés en amont vers un PNG puis traités comme
        // n'importe quelle image. Uniquement si la page a chargé le décodeur
        // (heic-decode.js) — les autres pages gardent le comportement d'origine.
        const heicList = window.HEIC
            ? incoming.filter(f => window.HEIC.isHeic(f) && !validTypes.includes(f.type))
            : [];

        if (standard.length === 0 && heicList.length === 0) {
            const heicRejected = !window.HEIC && incoming.some(f => /\.(heic|heif)$/i.test(f.name || ''));
            showNotification(
                heicRejected
                    ? 'Les HEIC ne se convertissent que depuis la page « Convertir HEIC en JPG ».'
                    : 'Sélectionnez des images PNG, JPEG ou WebP.',
                'error'
            );
            return;
        }

        // Cap de taille : sur les fichiers standards ET les HEIC d'origine (petits).
        // Le PNG décodé depuis un HEIC est exempté : un HEIC de 2 Mo se décompresse
        // en plusieurs Mo de pixels bruts, c'est normal, pas un fichier « trop lourd ».
        var maxLabel = IS_PRO ? '50 Mo' : '10 Mo';
        const tooBig = standard.filter(f => f.size > maxSize);
        if (tooBig.length > 0) {
            showNotification(tooBig.length + ' fichier(s) trop volumineux (> ' + maxLabel + '), ignorés.', 'warning');
            standard = standard.filter(f => f.size <= maxSize);
        }
        let heicOk = heicList.filter(f => f.size <= maxSize);
        if (heicOk.length < heicList.length) {
            showNotification((heicList.length - heicOk.length) + ' HEIC trop volumineux (> ' + maxLabel + '), ignorés.', 'warning');
        }

        // Décodage HEIC → PNG, entièrement dans l'onglet (rien n'est envoyé).
        if (heicOk.length > 0) {
            setDropText('<strong>Décodage HEIC…</strong> vos photos restent sur votre appareil');
            for (let i = 0; i < heicOk.length; i++) {
                try {
                    standard.push(await window.HEIC.toPng(heicOk[i]));
                } catch (err) {
                    showNotification('« ' + heicOk[i].name +' » : ' + (err && err.message ? err.message : 'décodage HEIC impossible'), 'error');
                }
            }
            setDropText(dropTextDefault);
        }

        if (standard.length === 0) {
            showNotification('Aucune image exploitable.', 'error');
            return;
        }

        if (standard.length > MAX_BATCH) {
            showNotification(
                IS_PRO
                    ? 'Max ' + MAX_BATCH + ' images par lot. Les suivantes sont ignorées.'
                    : 'Max ' + MAX_BATCH + ' images en gratuit. Les suivantes sont ignorées.',
                'warning'
            );
            standard = standard.slice(0, MAX_BATCH);
        }

        selectedFiles = standard;

        // Show previews
        showPreviews();

        // Show options, hide results
        compressOptions.style.display = '';
        resultsContainer.style.display = 'none';
    }

    // ───── Previews ─────

    function showPreviews() {
        previewGrid.innerHTML = '';
        previewGrid.style.display = '';

        selectedFiles.forEach((file, i) => {
            const card = document.createElement('div');
            card.className = 'preview-card';

            const img = document.createElement('img');
            img.className = 'preview-img';
            img.alt = file.name;

            const reader = new FileReader();
            reader.onload = (e) => { img.src = e.target.result; };
            reader.readAsDataURL(file);

            const info = document.createElement('div');
            info.className = 'preview-info';

            const name = document.createElement('span');
            name.className = 'preview-name';
            name.textContent = file.name;

            const size = document.createElement('span');
            size.className = 'preview-size';
            size.textContent = formatSize(file.size);

            const removeBtn = document.createElement('button');
            removeBtn.className = 'preview-remove';
            removeBtn.innerHTML = '&times;';
            removeBtn.title = 'Retirer';
            removeBtn.addEventListener('click', (e) => {
                e.stopPropagation();
                selectedFiles.splice(i, 1);
                if (selectedFiles.length === 0) {
                    previewGrid.style.display = 'none';
                    compressOptions.style.display = 'none';
                } else {
                    showPreviews();
                }
            });

            info.appendChild(name);
            info.appendChild(size);
            card.appendChild(removeBtn);
            card.appendChild(img);
            card.appendChild(info);
            previewGrid.appendChild(card);
        });
    }

    // ───── Compression Levels ─────

    document.querySelectorAll('.level-btn').forEach(function (btn) {
        btn.addEventListener('click', function () {
            var level = btn.dataset.level;

            if (level === 'mega' && !btn.classList.contains('pro-only-unlocked')) {
                showNotification('La méga compression (-90%) est réservée aux abonnés Pro.', 'info');
                if (APP.pricingUrl) setTimeout(function () { window.location.href = APP.pricingUrl; }, 900);
                return;
            }

            document.querySelectorAll('.level-btn').forEach(function (b) { b.classList.remove('active'); });
            btn.classList.add('active');
            currentQuality = parseInt(btn.dataset.quality);
            currentLevel = level;
            if (compressionHint) compressionHint.textContent = hints[level] || '';
        });
    });

    // ───── Compress ─────

    if (compressBtn) {
        compressBtn.addEventListener('click', compressAll);
    }

    async function compressAll() {
        if (selectedFiles.length === 0) return;

        compressBtn.disabled = true;
        compressBtn.innerHTML = '<span class="spinner"></span> Compression...';

        compressedFiles = [];
        resultsList.innerHTML = '';

        const quality = currentQuality / 100;
        const isMega = currentLevel === 'mega' && IS_PRO;
        let totalOriginal = 0;
        let totalCompressed = 0;

        for (let i = 0; i < selectedFiles.length; i++) {
            const file = selectedFiles[i];
            try {
                const result = isMega
                    ? await megaCompressServer(file, currentQuality)
                    : await compressImage(file, quality);
                compressedFiles.push(result);
                totalOriginal += file.size;
                totalCompressed += result.blob.size;
                addResultItem(result, i);
            } catch (err) {
                addErrorItem(file.name, err.message);
            }
        }

        // Summary
        var savedPct = formatPercent(totalOriginal, totalCompressed);
        var savedColor = totalCompressed < totalOriginal ? 'var(--success)' : 'var(--text-muted)';
        var savedText = totalCompressed < totalOriginal ? ('-' + savedPct) : 'Déjà optimisé';
        resultsSummary.innerHTML =
            '<div class="summary-stat"><span class="stat-label">Images</span><span class="stat-value">' + compressedFiles.length + '</span></div>' +
            '<div class="summary-stat"><span class="stat-label">Avant</span><span class="stat-value">' + formatSize(totalOriginal) + '</span></div>' +
            '<div class="summary-stat"><span class="stat-label">Après</span><span class="stat-value">' + formatSize(totalCompressed) + '</span></div>' +
            '<div class="summary-stat"><span class="stat-label">Gagné</span><span class="stat-value" style="color:' + savedColor + '">' + savedText + '</span></div>';

        resultsContainer.style.display = '';
        previewGrid.style.display = 'none';
        compressOptions.style.display = 'none';

        compressBtn.disabled = false;
        compressBtn.innerHTML = '<svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 8L10 2L16 8M4 12L10 18L16 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg> Compresser';

        resultsContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // ───── Server-side méga compression (Pro) ─────
    // The real Pro deliverable: files go to /api/compress, which runs pngquant
    // (palette quantization, the TinyPNG technique) and aggressive re-encode for
    // reductions the in-browser canvas can't match. We pull the result back once
    // and keep it in memory (the server deletes it on download), so the result
    // card and its download button reuse the exact same UI as the free path.
    async function megaCompressServer(file, qualityPct) {
        var fd = new FormData();
        fd.append('image', file, file.name);
        fd.append('quality', String(qualityPct || 30));
        fd.append('mega', '1');

        var resp = await fetch(COMPRESS_URL, { method: 'POST', body: fd });
        var data = null;
        try { data = await resp.json(); } catch (e) { /* non-JSON error page */ }
        if (!resp.ok || !data || !data.success) {
            throw new Error((data && data.error) ? data.error : 'Méga compression indisponible, réessayez.');
        }

        var blobResp = await fetch(data.download_url);
        if (!blobResp.ok) throw new Error('Téléchargement du résultat impossible.');
        var blob = await blobResp.blob();

        return {
            name: file.name,
            originalSize: file.size,
            blob: blob,
            type: blob.type || file.type,
            thumbUrl: URL.createObjectURL(file),
            compressedUrl: URL.createObjectURL(blob),
            unchanged: blob.size >= file.size,
            converted: false,
        };
    }

    // ───── Client-side compression via Canvas ─────

    function canvasEncode(canvas, type, q) {
        return new Promise(function (resolve) {
            canvas.toBlob(function (b) { resolve(b); }, type, q);
        });
    }

    function targetBytes() {
        if (!targetInput) return 0;
        var v = parseFloat(targetInput.value);
        if (!v || v <= 0) return 0;
        var unit = document.getElementById('targetSizeUnit');
        var mult = (unit && unit.value === 'mb') ? 1048576 : 1024;
        return Math.round(v * mult);
    }

    // Draw the source image into a fresh canvas at `scale` of the target dimensions.
    // Transparency is flattened onto white when the output is JPEG.
    function renderAt(img, w, h, scale, type) {
        var canvas = document.createElement('canvas');
        canvas.width = Math.max(1, Math.round(w * scale));
        canvas.height = Math.max(1, Math.round(h * scale));
        var ctx = canvas.getContext('2d');
        if (type === 'image/jpeg') {
            ctx.fillStyle = '#ffffff';
            ctx.fillRect(0, 0, canvas.width, canvas.height);
        }
        ctx.drawImage(img, 0, 0, canvas.width, canvas.height);
        return canvas;
    }

    // Binary-search the quality: keep the highest one that still fits under `target`.
    // Returns null when even quality 0.05 stays above the target at these dimensions.
    async function searchQuality(canvas, type, target) {
        var lo = 0.05, hi = 0.95, best = null;
        for (var i = 0; i < 8; i++) {
            var mid = (lo + hi) / 2;
            var b = await canvasEncode(canvas, type, mid);
            if (!b) break;
            if (b.size <= target) { best = b; lo = mid; } else { hi = mid; }
        }
        return best;
    }

    // Target mode. Quality alone can't reach a low target on a big photo — below
    // ~30 Ko the pixels are the lever, not the quality. So when the search fails at
    // full size, step the dimensions down and search again, instead of returning a
    // quality-5 file that busts the target anyway.
    // Returns { blob, target, width, height, scaled, over }.
    async function encodeToTarget(img, w, h, type) {
        var target = targetBytes();
        if (!target) {
            return { blob: await canvasEncode(renderAt(img, w, h, 1, type), type, 0.8), target: 0, width: w, height: h };
        }

        var SCALES = [1, 0.75, 0.55, 0.4, 0.28, 0.2];
        var fallback = null, fw = w, fh = h;

        for (var s = 0; s < SCALES.length; s++) {
            var cw = Math.max(1, Math.round(w * SCALES[s]));
            var ch = Math.max(1, Math.round(h * SCALES[s]));
            // Under 200 px a downscale destroys more than it saves — stop there.
            if (s > 0 && (cw < 200 || ch < 200)) break;

            var canvas = renderAt(img, w, h, SCALES[s], type);
            var best = await searchQuality(canvas, type, target);
            if (best) {
                return { blob: best, target: target, width: cw, height: ch, scaled: SCALES[s] < 1 };
            }
            fallback = await canvasEncode(canvas, type, 0.05);
            fw = cw; fh = ch;
        }

        // Target genuinely out of reach: return the smallest we produced and say so.
        return { blob: fallback, target: target, width: fw, height: fh, scaled: fw < w, over: true };
    }

    // Read an image's pixels back out of a canvas, alpha preserved (never flattened
    // to white — that only happens for JPEG output). Used to feed the PNG-8 encoder.
    function pixelsOf(img, w, h) {
        var canvas = renderAt(img, w, h, 1, 'image/png');
        var ctx = canvas.getContext('2d');
        return { canvas: canvas, rgba: ctx.getImageData(0, 0, canvas.width, canvas.height).data };
    }

    // Plain "compress this PNG" case. The old behaviour swapped PNG → WebP silently,
    // which changes the extension and breaks admin/desktop uploads that still refuse
    // .webp. Now we give back a REAL PNG (256-colour palette, via png8-encoder.js) and
    // offer WebP as the explicit lighter alternative. On a photo/gradient the palette
    // makes the file bigger — there we recommend WebP and keep the untouched PNG as the
    // fallback, instead of pretending a quantised PNG helped.
    async function encodePngWithChoice(img, w, h, file, quality, thumbUrl) {
        var px = pixelsOf(img, w, h);
        var png = await window.PNG8.encode(px.rgba, px.canvas.width, px.canvas.height, 256);

        var webpQ = (currentLevel === 'light' || currentLevel === 'recommended')
            ? Math.max(quality, 0.85) : quality;
        var webpBlob = await canvasEncode(px.canvas, 'image/webp', webpQ);

        var pngHelped  = png.blob.size < file.size;
        var webpHelped = webpBlob && webpBlob.size < file.size;

        var pngOpt  = { blob: pngHelped ? png.blob : file, type: 'image/png', unchanged: !pngHelped };
        var webpOpt = webpHelped ? { blob: webpBlob, type: 'image/webp', unchanged: false } : null;

        // Recommend PNG when the palette genuinely compressed it (logo/screenshot);
        // otherwise it's a photo/gradient and WebP is the honest win.
        var recommendPng = pngHelped || !webpOpt;
        var primary = recommendPng ? pngOpt : webpOpt;
        var alt     = recommendPng ? webpOpt : pngOpt;

        // Nothing beat the original: hand back the untouched PNG, no second option.
        if (primary.unchanged && (!alt || alt.unchanged)) {
            return {
                name: file.name, originalSize: file.size, blob: file,
                thumbUrl: thumbUrl, compressedUrl: URL.createObjectURL(file),
                type: 'image/png', unchanged: true,
            };
        }

        return {
            name: file.name, originalSize: file.size,
            blob: primary.blob, type: primary.type,
            thumbUrl: thumbUrl, compressedUrl: URL.createObjectURL(primary.blob),
            converted: primary.type !== file.type,
            alt: alt,
        };
    }

    function compressImage(file, quality) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.onload = async () => {
                    let width = img.naturalWidth;
                    let height = img.naturalHeight;

                    if (MODE === 'resize') {
                        var tw = parseInt(resizeW && resizeW.value) || 0;
                        var th = parseInt(resizeH && resizeH.value) || 0;
                        var lock = !resizeLock || resizeLock.checked;
                        if (tw && !th)        { th = lock ? Math.round(height * tw / width) : height; }
                        else if (th && !tw)   { tw = lock ? Math.round(width * th / height) : width; }
                        else if (tw && th && lock) {
                            var rr = Math.min(tw / width, th / height);
                            tw = Math.round(width * rr); th = Math.round(height * rr);
                        }
                        if (tw && th) { width = tw; height = th; }
                    } else if (currentLevel === 'strong' && (width > 2000 || height > 2000)) {
                        const ratio = Math.min(2000 / width, 2000 / height);
                        width = Math.round(width * ratio);
                        height = Math.round(height * ratio);
                    }

                    // Decide output format
                    var outputType = file.type;
                    var outputQuality = quality;
                    if (FORCE_OUTPUT) {
                        outputType = FORCE_OUTPUT; // conversion pages
                    } else if (MODE === 'target' && file.type !== 'image/jpeg') {
                        // Aiming at a byte budget needs a quality knob, so PNG can't stay PNG.
                        // JPEG rather than WebP: these pages are used for admin uploads
                        // (ANTS, dossiers), and a .webp gets refused by most of those forms.
                        outputType = 'image/jpeg';
                    } else if (MODE === 'resize') {
                        // Resize keeps the original format at high quality (intent = dimensions, not format)
                        outputQuality = 0.92;
                    } else if (file.type === 'image/png') {
                        // Canvas can't set PNG quality, so PNG is compressed as WebP
                        outputType = 'image/webp';
                        if (currentLevel !== 'strong' && currentLevel !== 'mega') {
                            outputQuality = Math.max(quality, 0.85);
                        }
                    }

                    try {
                        // Plain PNG compression: keep it a PNG, offer WebP explicitly.
                        // (Falls through to the generic WebP path if the browser has no
                        // CompressionStream, so png8-encoder.js never defined window.PNG8.)
                        if (MODE === 'compress' && !FORCE_OUTPUT && file.type === 'image/png' && window.PNG8) {
                            resolve(await encodePngWithChoice(img, width, height, file, quality, e.target.result));
                            return;
                        }

                        var blob, fit = null;
                        if (MODE === 'target') {
                            fit = await encodeToTarget(img, width, height, outputType);
                            blob = fit.blob;
                        } else {
                            blob = await canvasEncode(renderAt(img, width, height, 1, outputType), outputType, outputQuality);
                        }
                        if (!blob) { reject(new Error('Erreur de compression')); return; }

                        // Already under the requested budget and re-encoding gains nothing:
                        // hand back the untouched original rather than a heavier "compressed" file.
                        var alreadyFits = MODE === 'target' && fit && fit.target
                            && file.size <= fit.target && blob.size >= file.size;

                        // Plain compression must never return a bigger file.
                        // (Conversion mode always returns the produced file.)
                        if (alreadyFits || (MODE === 'compress' && !FORCE_OUTPUT && blob.size >= file.size)) {
                            resolve({
                                name: file.name, originalSize: file.size, blob: file,
                                thumbUrl: e.target.result, compressedUrl: URL.createObjectURL(file),
                                type: file.type, unchanged: true,
                                fit: alreadyFits ? { target: fit.target, width: width, height: height } : null,
                            });
                            return;
                        }
                        resolve({
                            name: file.name, originalSize: file.size, blob: blob,
                            thumbUrl: e.target.result, compressedUrl: URL.createObjectURL(blob),
                            type: outputType,
                            fit: fit,
                            converted: outputType !== file.type,
                        });
                    } catch (err) { reject(err); }
                };
                img.onerror = function () { reject(new Error('Image invalide')); };
                img.src = e.target.result;
            };
            reader.onerror = function () { reject(new Error('Erreur de lecture')); };
            reader.readAsDataURL(file);
        });
    }

    // ───── UI ─────

    var EXT_BY_TYPE = { 'image/jpeg': '.jpg', 'image/png': '.png', 'image/webp': '.webp' };
    var LABEL_BY_TYPE = { 'image/jpeg': 'JPG', 'image/png': 'PNG', 'image/webp': 'WebP' };

    // Target mode: say plainly whether the file respects the requested budget,
    // and what had to change to get there (dimensions, format).
    function verdictHtml(result) {
        var fit = result.fit;
        if (!fit || !fit.target) return '';

        var got = formatSize(result.blob.size);
        var aim = formatSize(fit.target);
        var notes = [];
        if (fit.scaled) notes.push('redimensionnée en ' + fit.width + ' × ' + fit.height + ' px');
        if (result.converted) notes.push('convertie en ' + (LABEL_BY_TYPE[result.type] || 'JPG'));
        var noteHtml = notes.length
            ? '<div class="result-verdict-note">' + escapeHtml(notes.join(' · ')) + '</div>'
            : '';

        if (fit.over) {
            return '<div class="result-verdict result-verdict-over">' +
                   '<strong>' + got + '</strong> — au-dessus de la cible de ' + aim +
                   '</div>' +
                   '<div class="result-verdict-note">Même à la qualité minimale et en ' + fit.width + ' × ' + fit.height + ' px, cette image ne descend pas sous ' + aim + '. Recadrez-la ou visez un poids un peu plus haut.</div>';
        }
        return '<div class="result-verdict result-verdict-ok">' +
               '<strong>' + got + '</strong> / cible ' + aim + ' ✓' +
               '</div>' + noteHtml;
    }

    // For PNG-compress results that carry both a PNG and a WebP: a short note saying
    // which format is recommended and why, plus a button to grab the other one.
    function formatChoiceHtml(result) {
        if (!result.alt) return '';
        var note = result.type === 'image/png'
            ? 'PNG conservé — extension <code>.png</code> préservée, transparence incluse.'
            : 'Converti en WebP, plus léger. Le PNG d\'origine reste dispo ci-dessous.';
        var a = result.alt;
        var altLabel = a.type === 'image/webp'
            ? 'Convertir en WebP'
            : (a.unchanged ? 'Garder le PNG d\'origine' : 'Garder en PNG');
        var altSize = formatSize(a.blob.size);
        return '<div class="result-format-note">' + note + '</div>' +
               '<button class="btn btn-ghost btn-sm alt-download-btn">' +
                   escapeHtml(altLabel) + ' · ' + altSize +
               '</button>';
    }

    function addResultItem(result, index) {
        var downloadExt = EXT_BY_TYPE[result.type] || '.jpg';
        var downloadName = result.name.replace(/\.[^.]+$/, '') + '-compresse' + downloadExt;

        var savings = formatPercent(result.originalSize, result.blob.size);
        var savingsNum = result.originalSize > 0 ? Math.round((1 - result.blob.size / result.originalSize) * 100) : 0;

        var savingsHtml;
        if (result.unchanged) {
            savingsHtml = '<span class="result-savings result-savings-neutral">Déjà optimisé</span>';
        } else {
            savingsHtml = '<span class="result-savings">-' + savings + '</span>';
        }

        var sizeText = result.unchanged
            ? formatSize(result.originalSize)
            : formatSize(result.originalSize) + ' &rarr; ' + formatSize(result.blob.size);

        // Dual-format results (PNG kept + WebP offered) get a clearer primary label.
        var primaryLabel = result.alt
            ? (result.type === 'image/png' ? ' Télécharger le PNG' : ' Télécharger le WebP')
            : ' Télécharger';

        var item = document.createElement('div');
        item.className = 'result-item';
        item.innerHTML =
            '<img src="' + result.thumbUrl + '" alt="" class="result-thumb">' +
            '<div class="result-info">' +
                '<div class="result-name">' + escapeHtml(result.name) + '</div>' +
                '<div class="result-meta">' +
                    '<span>' + sizeText + '</span>' +
                    savingsHtml +
                '</div>' +
                verdictHtml(result) +
                formatChoiceHtml(result) +
            '</div>' +
            '<div class="result-actions">' +
                '<button class="btn btn-primary btn-sm download-btn" data-index="' + index + '">' +
                    '<svg width="16" height="16" viewBox="0 0 18 18" fill="none"><path d="M9 2V12M9 12L5 8M9 12L13 8M2 15H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>' +
                    primaryLabel +
                '</button>' +
            '</div>';

        item.querySelector('.download-btn').addEventListener('click', function () {
            downloadBlob(result.blob, downloadName);
        });

        var altBtn = item.querySelector('.alt-download-btn');
        if (altBtn) {
            altBtn.addEventListener('click', function () {
                var ext = EXT_BY_TYPE[result.alt.type] || '.webp';
                downloadBlob(result.alt.blob, result.name.replace(/\.[^.]+$/, '') + '-compresse' + ext);
            });
        }

        resultsList.appendChild(item);
    }

    function addErrorItem(name, error) {
        const item = document.createElement('div');
        item.className = 'result-item result-item-error';
        item.innerHTML =
            '<div class="result-info">' +
                '<div class="result-name">' + escapeHtml(name) + '</div>' +
                '<div class="result-meta" style="color:var(--error)">' + escapeHtml(error) + '</div>' +
            '</div>';
        resultsList.appendChild(item);
    }

    // ───── Download ─────

    function downloadBlob(blob, filename) {
        const url = URL.createObjectURL(blob);
        const a = document.createElement('a');
        a.href = url;
        a.download = filename;
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
        setTimeout(() => URL.revokeObjectURL(url), 100);
    }

    if (downloadAllBtn) {
        downloadAllBtn.addEventListener('click', () => {
            compressedFiles.forEach((result) => {
                const downloadName = result.name.replace(/\.[^.]+$/, '') + '-compresse' + (EXT_BY_TYPE[result.type] || '.jpg');
                downloadBlob(result.blob, downloadName);
            });
        });
    }

    // ───── Reset ─────

    if (newCompressionBtn) {
        newCompressionBtn.addEventListener('click', () => {
            selectedFiles = [];
            compressedFiles = [];
            resultsList.innerHTML = '';
            resultsContainer.style.display = 'none';
            compressOptions.style.display = 'none';
            previewGrid.style.display = 'none';
            previewGrid.innerHTML = '';
            fileInput.value = '';

            dropZone.querySelector('.drop-zone-text').innerHTML =
                '<strong>Glissez vos images ici</strong> ou cliquez pour sélectionner';

            dropZone.scrollIntoView({ behavior: 'smooth' });
        });
    }

    // ───── Utils ─────

    function formatSize(bytes) {
        if (bytes >= 1048576) return (bytes / 1048576).toFixed(2) + ' Mo';
        if (bytes >= 1024) return (bytes / 1024).toFixed(1) + ' Ko';
        return bytes + ' o';
    }

    function formatPercent(original, compressed) {
        if (original === 0) return '0%';
        return Math.round((1 - compressed / original) * 100) + '%';
    }

    function escapeHtml(str) {
        const div = document.createElement('div');
        div.textContent = str;
        return div.innerHTML;
    }

    function showNotification(message, type) {
        const container = document.querySelector('.flash-container') || (() => {
            const c = document.createElement('div');
            c.className = 'flash-container';
            document.body.appendChild(c);
            return c;
        })();
        const flash = document.createElement('div');
        flash.className = 'flash flash-' + (type || 'info');
        flash.innerHTML = '<span>' + escapeHtml(message) + '</span><button class="flash-close" onclick="this.parentElement.remove()">&times;</button>';
        container.appendChild(flash);
        setTimeout(() => {
            flash.style.opacity = '0';
            flash.style.transform = 'translateX(20px)';
            setTimeout(() => flash.remove(), 300);
        }, 4000);
    }
})();
