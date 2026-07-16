/**
 * png-reducer.js — Réducteur PNG de /reduire-taille-png
 *
 * Différence avec compressor.js : ici la sortie reste un VRAI PNG.
 * Le compresseur générique ré-encode les PNG en WebP (le canvas n'a pas de
 * réglage de qualité pour le PNG), ce qui change l'extension du fichier.
 * Cette page écrit un PNG-8 à palette (color type 3 + tRNS) à la main :
 * median cut RGBA -> indexation -> scanlines filtre 0 -> CompressionStream
 * ('deflate' = flux zlib, exactement ce qu'attend un chunk IDAT).
 *
 * Tout est local : aucun octet n'est envoyé au serveur.
 */
(function () {
    'use strict';

    var root = document.getElementById('pngReducer');
    if (!root) return;

    var MAX_FILES = 10;                 // aligné sur le reste du site (offre gratuite)
    var MAX_BYTES = 10 * 1024 * 1024;

    // ─────────────────────────── Encodeur PNG-8 ───────────────────────────

    var CRC_TABLE = (function () {
        var t = new Int32Array(256);
        for (var n = 0; n < 256; n++) {
            var c = n;
            for (var k = 0; k < 8; k++) c = (c & 1) ? (0xedb88320 ^ (c >>> 1)) : (c >>> 1);
            t[n] = c;
        }
        return t;
    })();

    function crc32(bytes) {
        var c = -1;
        for (var i = 0; i < bytes.length; i++) c = CRC_TABLE[(c ^ bytes[i]) & 255] ^ (c >>> 8);
        return (c ^ -1) >>> 0;
    }

    function chunk(type, data) {
        var out = new Uint8Array(12 + data.length);
        var dv = new DataView(out.buffer);
        dv.setUint32(0, data.length);
        for (var i = 0; i < 4; i++) out[4 + i] = type.charCodeAt(i);
        out.set(data, 8);
        dv.setUint32(8 + data.length, crc32(out.subarray(4, 8 + data.length)));
        return out;
    }

    /** Median cut dans l'espace RGBA (l'alpha est une dimension à part entière). */
    function buildPalette(rgba, maxColors) {
        var counts = new Map();
        for (var i = 0; i < rgba.length; i += 4) {
            var a = rgba[i + 3];
            // tous les pixels 100 % transparents partagent la même entrée
            var key = a === 0 ? 0 : (((rgba[i] << 24) | (rgba[i + 1] << 16) | (rgba[i + 2] << 8) | a) >>> 0);
            counts.set(key, (counts.get(key) || 0) + 1);
        }
        var colors = [];
        counts.forEach(function (n, key) {
            colors.push(key === 0
                ? { r: 0, g: 0, b: 0, a: 0, n: n }
                : { r: (key >>> 24) & 255, g: (key >>> 16) & 255, b: (key >>> 8) & 255, a: key & 255, n: n });
        });
        if (colors.length <= maxColors) {
            return colors.map(function (c) { return [c.r, c.g, c.b, c.a]; });
        }

        var CH = ['r', 'g', 'b', 'a'];
        function extent(box, ch) {
            var lo = 255, hi = 0;
            for (var i = 0; i < box.length; i++) {
                var v = box[i][ch];
                if (v < lo) lo = v;
                if (v > hi) hi = v;
            }
            return hi - lo;
        }
        function widest(box) {
            var best = 'r', bs = -1;
            for (var i = 0; i < 4; i++) {
                var e = extent(box, CH[i]);
                if (e > bs) { bs = e; best = CH[i]; }
            }
            return best;
        }
        function weight(box) {
            var n = 0, s = 0;
            for (var i = 0; i < box.length; i++) n += box[i].n;
            for (var j = 0; j < 4; j++) s = Math.max(s, extent(box, CH[j]));
            return n * s;   // masse de pixels x étalement : on coupe là où ça se voit
        }

        var boxes = [colors];
        while (boxes.length < maxColors) {
            var bi = -1, bw = -1;
            for (var b = 0; b < boxes.length; b++) {
                if (boxes[b].length < 2) continue;
                var w = weight(boxes[b]);
                if (w > bw) { bw = w; bi = b; }
            }
            if (bi < 0) break;
            var box = boxes[bi];
            var ch = widest(box);
            box.sort(function (x, y) { return x[ch] - y[ch]; });
            var half = 0;
            for (var h = 0; h < box.length; h++) half += box[h].n;
            half /= 2;
            var acc = 0, cut = 1;
            for (var m = 0; m < box.length - 1; m++) {
                acc += box[m].n;
                if (acc >= half) { cut = m + 1; break; }
            }
            boxes.splice(bi, 1, box.slice(0, cut), box.slice(cut));
        }

        return boxes.map(function (box) {
            var r = 0, g = 0, bl = 0, al = 0, n = 0;
            for (var i = 0; i < box.length; i++) {
                var c = box[i];
                r += c.r * c.n; g += c.g * c.n; bl += c.b * c.n; al += c.a * c.n; n += c.n;
            }
            return [Math.round(r / n), Math.round(g / n), Math.round(bl / n), Math.round(al / n)];
        });
    }

    function indexPixels(rgba, palette) {
        var cache = new Map();
        var out = new Uint8Array(rgba.length / 4);
        for (var i = 0, p = 0; i < rgba.length; i += 4, p++) {
            var a = rgba[i + 3];
            var key = a === 0 ? 0 : (((rgba[i] << 24) | (rgba[i + 1] << 16) | (rgba[i + 2] << 8) | a) >>> 0);
            var idx = cache.get(key);
            if (idx === undefined) {
                var bd = Infinity;
                for (var k = 0; k < palette.length; k++) {
                    var dr = rgba[i] - palette[k][0],
                        dg = rgba[i + 1] - palette[k][1],
                        db = rgba[i + 2] - palette[k][2],
                        da = a - palette[k][3];
                    // l'alpha est sur-pondéré : une erreur de transparence se voit
                    // beaucoup plus qu'une erreur de teinte
                    var d = dr * dr + dg * dg + db * db + da * da * 3;
                    if (d < bd) { bd = d; idx = k; }
                }
                cache.set(key, idx);
            }
            out[p] = idx;
        }
        return out;
    }

    function bitDepthFor(n) { return n <= 2 ? 1 : n <= 4 ? 2 : n <= 16 ? 4 : 8; }

    async function deflate(bytes) {
        var cs = new CompressionStream('deflate');   // 'deflate' = zlib, format des IDAT
        var stream = new Blob([bytes]).stream().pipeThrough(cs);
        return new Uint8Array(await new Response(stream).arrayBuffer());
    }

    /**
     * Filtre 0 (None) sur toutes les lignes : sur une image à palette, les
     * index ne sont pas des valeurs continues, filtrer les fait grossir.
     * (Vérifié sur nos trois fichiers de test : Sub/Up/Paeth donnent
     * systématiquement un PNG plus gros que le filtre None.)
     */
    async function encodePng8(rgba, w, h, maxColors) {
        var palette = buildPalette(rgba, maxColors);
        var idx = indexPixels(rgba, palette);
        var depth = bitDepthFor(palette.length);
        var ppb = 8 / depth;
        var rowBytes = Math.ceil(w / ppb);
        var raw = new Uint8Array((rowBytes + 1) * h);
        var o = 0;
        for (var y = 0; y < h; y++) {
            raw[o++] = 0;
            if (depth === 8) {
                for (var x = 0; x < w; x++) raw[o++] = idx[y * w + x];
            } else {
                var acc = 0, bits = 0;
                for (var x2 = 0; x2 < w; x2++) {
                    acc = (acc << depth) | idx[y * w + x2];
                    bits += depth;
                    if (bits === 8) { raw[o++] = acc; acc = 0; bits = 0; }
                }
                if (bits) raw[o++] = acc << (8 - bits);
            }
        }

        var ihdr = new Uint8Array(13);
        var dv = new DataView(ihdr.buffer);
        dv.setUint32(0, w); dv.setUint32(4, h);
        ihdr[8] = depth; ihdr[9] = 3;             // color type 3 = palette

        var plte = new Uint8Array(palette.length * 3);
        for (var i = 0; i < palette.length; i++) {
            plte[i * 3] = palette[i][0]; plte[i * 3 + 1] = palette[i][1]; plte[i * 3 + 2] = palette[i][2];
        }
        var trnsLen = 0;
        for (var j = 0; j < palette.length; j++) if (palette[j][3] < 255) trnsLen = j + 1;

        var parts = [
            new Uint8Array([137, 80, 78, 71, 13, 10, 26, 10]),
            chunk('IHDR', ihdr),
            chunk('PLTE', plte)
        ];
        if (trnsLen) {
            var trns = new Uint8Array(trnsLen);
            for (var t = 0; t < trnsLen; t++) trns[t] = palette[t][3];
            parts.push(chunk('tRNS', trns));       // la transparence, entrée par entrée
        }
        parts.push(chunk('IDAT', await deflate(raw)));
        parts.push(chunk('IEND', new Uint8Array(0)));

        return { blob: new Blob(parts, { type: 'image/png' }), colors: palette.length };
    }

    // ─────────────────────────── Utilitaires ───────────────────────────

    function fmt(bytes) {
        if (bytes >= 1048576) return (bytes / 1048576).toFixed(2).replace('.', ',') + ' Mo';
        if (bytes >= 1024) return (bytes / 1024).toFixed(1).replace('.', ',') + ' Ko';
        return bytes + ' o';
    }

    function loadImage(file) {
        return new Promise(function (resolve, reject) {
            var url = URL.createObjectURL(file);
            var img = new Image();
            img.onload = function () { resolve(img); };
            img.onerror = function () { URL.revokeObjectURL(url); reject(new Error('PNG illisible')); };
            img.src = url;
        });
    }

    function pixelsOf(img, w, h) {
        var c = document.createElement('canvas');
        c.width = w; c.height = h;
        var ctx = c.getContext('2d', { willReadFrequently: true });
        ctx.clearRect(0, 0, w, h);
        ctx.drawImage(img, 0, 0, w, h);
        return ctx.getImageData(0, 0, w, h).data;
    }

    // ─────────────────────────── État + UI ───────────────────────────

    var files = [];
    var results = [];
    var pathChoice = null;   // 'poids' | 'dimensions'

    var $ = function (id) { return document.getElementById(id); };
    var pathCards   = root.querySelectorAll('[data-path]');
    var stepDrop    = $('prStepDrop');
    var dropZone    = $('prDropZone');
    var fileInput   = $('prFileInput');
    var optWeight   = $('prOptWeight');
    var optDims     = $('prOptDims');
    var runBtn      = $('prRunBtn');
    var resultsBox  = $('prResults');
    var resultsList = $('prResultsList');
    var summary     = $('prSummary');
    var resetBtn    = $('prResetBtn');
    var status      = $('prStatus');
    var modeRadios  = root.querySelectorAll('input[name="prWeightMode"]');
    var colorsSel   = $('prColors');
    var targetVal   = $('prTargetValue');
    var targetUnit  = $('prTargetUnit');
    var resizeW     = $('prResizeW');
    var resizeH     = $('prResizeH');
    var resizeLock  = $('prResizeLock');

    if (typeof CompressionStream === 'undefined') {
        status.textContent = 'Votre navigateur ne sait pas écrire de PNG compressé localement (CompressionStream manquant). Utilisez Chrome, Edge, Firefox 113+ ou Safari 16.4+.';
        status.className = 'pr-status pr-status-error';
        return;
    }

    Array.prototype.forEach.call(pathCards, function (card) {
        card.addEventListener('click', function () {
            pathChoice = card.dataset.path;
            Array.prototype.forEach.call(pathCards, function (c) {
                c.classList.toggle('active', c === card);
                c.setAttribute('aria-pressed', c === card ? 'true' : 'false');
            });
            stepDrop.hidden = false;
            optWeight.hidden = pathChoice !== 'poids';
            optDims.hidden = pathChoice !== 'dimensions';
            runBtn.textContent = pathChoice === 'dimensions' ? 'Redimensionner mes PNG' : 'Réduire mes PNG';
            stepDrop.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });
    });

    function syncWeightMode() {
        var mode = root.querySelector('input[name="prWeightMode"]:checked').value;
        $('prColorsRow').hidden = mode !== 'palette';
        $('prTargetRow').hidden = mode !== 'cible';
    }
    Array.prototype.forEach.call(modeRadios, function (r) { r.addEventListener('change', syncWeightMode); });
    syncWeightMode();

    dropZone.addEventListener('click', function () { fileInput.click(); });
    dropZone.addEventListener('keydown', function (e) {
        if (e.key === 'Enter' || e.key === ' ') { e.preventDefault(); fileInput.click(); }
    });
    fileInput.addEventListener('change', function (e) { accept(e.target.files); });
    ['dragover', 'dragenter'].forEach(function (ev) {
        dropZone.addEventListener(ev, function (e) { e.preventDefault(); dropZone.classList.add('dragging'); });
    });
    ['dragleave', 'drop'].forEach(function (ev) {
        dropZone.addEventListener(ev, function (e) { e.preventDefault(); dropZone.classList.remove('dragging'); });
    });
    dropZone.addEventListener('drop', function (e) { accept(e.dataTransfer.files); });

    function accept(list) {
        var all = Array.prototype.slice.call(list);
        var pngs = all.filter(function (f) { return f.type === 'image/png'; });
        var notes = [];

        if (pngs.length < all.length) {
            notes.push('Cette page ne traite que les PNG. ' + (all.length - pngs.length) + ' fichier(s) ignoré(s) — pour du JPG, utilisez la page Compresser JPEG.');
        }
        var big = pngs.filter(function (f) { return f.size > MAX_BYTES; });
        if (big.length) {
            notes.push(big.length + ' fichier(s) au-dessus de 10 Mo, ignoré(s).');
            pngs = pngs.filter(function (f) { return f.size <= MAX_BYTES; });
        }
        if (pngs.length > MAX_FILES) {
            notes.push('Maximum ' + MAX_FILES + ' PNG à la fois : les suivants sont ignorés.');
            pngs = pngs.slice(0, MAX_FILES);
        }
        if (!pngs.length) {
            show(notes.join(' ') || 'Aucun PNG valide dans votre sélection.', 'error');
            return;
        }

        files = pngs;
        show(notes.join(' ') || (pngs.length + ' PNG prêt(s) — ' + fmt(pngs.reduce(function (s, f) { return s + f.size; }, 0)) + ' au total.'),
             notes.length ? 'warn' : 'ok');
        runBtn.hidden = false;
        resultsBox.hidden = true;
    }

    function show(msg, kind) {
        status.textContent = msg;
        status.className = 'pr-status' + (kind ? ' pr-status-' + kind : '');
    }

    runBtn.addEventListener('click', run);
    resetBtn.addEventListener('click', function () {
        files = []; results = [];
        fileInput.value = '';
        resultsBox.hidden = true;
        runBtn.hidden = true;
        show('');
    });

    /** Cible de poids : on descend la palette par paliers jusqu'à passer sous le seuil. */
    async function toTarget(rgba, w, h, targetBytes) {
        var ladder = [256, 128, 64, 32, 16, 8, 4, 2];
        var last = null;
        for (var i = 0; i < ladder.length; i++) {
            var r = await encodePng8(rgba, w, h, ladder[i]);
            last = { blob: r.blob, colors: r.colors };
            if (r.blob.size <= targetBytes) return { hit: true, blob: r.blob, colors: r.colors };
        }
        return { hit: false, blob: last.blob, colors: last.colors };
    }

    async function run() {
        if (!files.length) return;
        runBtn.disabled = true;
        results = [];
        resultsList.innerHTML = '';

        var mode = root.querySelector('input[name="prWeightMode"]:checked').value;
        var target = 0;
        if (pathChoice === 'poids' && mode === 'cible') {
            var v = parseFloat(String(targetVal.value).replace(',', '.'));
            if (!v || v <= 0) { show('Indiquez un poids cible valide.', 'error'); runBtn.disabled = false; return; }
            target = Math.round(v * (targetUnit.value === 'mb' ? 1048576 : 1024));
        }

        var totalIn = 0, totalOut = 0;

        for (var i = 0; i < files.length; i++) {
            var file = files[i];
            runBtn.textContent = 'Traitement ' + (i + 1) + '/' + files.length + '…';
            try {
                var img = await loadImage(file);
                var w = img.naturalWidth, h = img.naturalHeight;

                if (pathChoice === 'dimensions') {
                    var tw = parseInt(resizeW.value, 10) || 0;
                    var th = parseInt(resizeH.value, 10) || 0;
                    var lock = resizeLock.checked;
                    if (tw && !th) th = lock ? Math.round(h * tw / w) : h;
                    else if (th && !tw) tw = lock ? Math.round(w * th / h) : w;
                    else if (tw && th && lock) {
                        var ratio = Math.min(tw / w, th / h);
                        tw = Math.round(w * ratio); th = Math.round(h * ratio);
                    }
                    if (!tw || !th) throw new Error('Indiquez au moins une dimension.');
                    w = Math.max(1, tw); h = Math.max(1, th);
                }

                var rgba = pixelsOf(img, w, h);
                var out;

                if (pathChoice === 'dimensions') {
                    // Intention = les pixels, pas la palette : on garde 256 couleurs.
                    out = await encodePng8(rgba, w, h, 256);
                    out.hit = true;
                } else if (mode === 'cible') {
                    out = await toTarget(rgba, w, h, target);
                } else {
                    out = await encodePng8(rgba, w, h, parseInt(colorsSel.value, 10));
                    out.hit = true;
                }

                // Un PNG déjà optimisé peut ressortir plus gros (cas typique : dégradé).
                // On ne rend jamais un fichier plus lourd que celui reçu.
                var bigger = out.blob.size >= file.size && pathChoice === 'poids';
                var final = bigger ? file : out.blob;

                results.push({
                    name: file.name, before: file.size, after: final.size,
                    colors: out.colors, url: URL.createObjectURL(final),
                    w: w, h: h, bigger: bigger, missed: out.hit === false
                });
                totalIn += file.size; totalOut += final.size;
                renderRow(results[results.length - 1]);
            } catch (err) {
                var row = document.createElement('div');
                row.className = 'pr-row pr-row-error';
                row.textContent = file.name + ' — ' + err.message;
                resultsList.appendChild(row);
            }
        }

        var pct = totalIn ? Math.round((1 - totalOut / totalIn) * 100) : 0;
        summary.innerHTML =
            '<div><span>Avant</span><strong>' + fmt(totalIn) + '</strong></div>' +
            '<div><span>Après</span><strong>' + fmt(totalOut) + '</strong></div>' +
            '<div><span>Gain</span><strong class="' + (pct > 0 ? 'pr-gain' : '') + '">' +
                (pct > 0 ? '-' + pct + '%' : 'déjà optimisé') + '</strong></div>' +
            '<div><span>Format</span><strong>PNG (inchangé)</strong></div>';

        resultsBox.hidden = false;
        runBtn.disabled = false;
        runBtn.textContent = pathChoice === 'dimensions' ? 'Redimensionner mes PNG' : 'Réduire mes PNG';
        show('');
        resultsBox.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
    }

    function renderRow(r) {
        var pct = Math.round((1 - r.after / r.before) * 100);
        var row = document.createElement('div');
        row.className = 'pr-row';

        var thumb = document.createElement('div');
        thumb.className = 'pr-thumb';              // damier CSS = transparence visible
        var im = document.createElement('img');
        im.src = r.url; im.alt = 'Aperçu de ' + r.name + ' après réduction';
        im.loading = 'lazy';
        thumb.appendChild(im);

        var meta = document.createElement('div');
        meta.className = 'pr-meta';
        var note = '';
        if (r.bigger) note = '<em>Ce PNG était déjà optimisé : la quantification le rendait plus lourd, on vous rend l\'original intact.</em>';
        else if (r.missed) note = '<em>Cible non atteignable même à 2 couleurs. Réduisez d\'abord les dimensions.</em>';

        // Quand on rend l'original, ne pas lui attribuer la palette de la
        // tentative écartée : le fichier téléchargé est le fichier d'origine.
        var detail = r.bigger
            ? r.w + ' × ' + r.h + ' px · fichier d\'origine, inchangé'
            : r.w + ' × ' + r.h + ' px · palette de ' + r.colors + ' couleurs · transparence conservée';

        meta.innerHTML =
            '<p class="pr-name">' + r.name.replace(/[<>&]/g, '') + '</p>' +
            '<p class="pr-sizes"><span>' + fmt(r.before) + '</span> → <strong>' + fmt(r.after) + '</strong>' +
            (pct > 0 ? ' <span class="pr-badge">-' + pct + '%</span>' : '') + '</p>' +
            '<p class="pr-detail">' + detail + '</p>' +
            (note ? '<p class="pr-detail">' + note + '</p>' : '');

        var a = document.createElement('a');
        a.className = 'btn btn-primary pr-dl';
        a.href = r.url;
        a.download = r.name.replace(/\.png$/i, '') + '-reduit.png';
        a.textContent = 'Télécharger';

        row.appendChild(thumb); row.appendChild(meta); row.appendChild(a);
        resultsList.appendChild(row);
    }
})();
