/**
 * png8-encoder.js — Encodeur PNG-8 à palette, partagé.
 *
 * Écrit un VRAI PNG (color type 3 + tRNS) à la main :
 *   median cut RGBA -> indexation -> scanlines filtre 0 -> CompressionStream
 *   ('deflate' = flux zlib, exactement ce qu'attend un chunk IDAT).
 *
 * C'est le même algorithme que /reduire-taille-png (public/js/png-reducer.js).
 * Il est isolé ici pour que le compresseur générique (compressor.js) puisse
 * rendre un PNG en sortie plutôt qu'un WebP clandestin, sans dupliquer l'encodeur
 * dans deux comportements d'UI. (png-reducer.js garde sa propre copie tant que sa
 * page est déployée telle quelle ; à fusionner au prochain passage sur ce fichier.)
 *
 * Tout est local : aucun octet n'est envoyé au serveur.
 *
 * Expose window.PNG8.encode(rgba, w, h, maxColors) -> Promise<{ blob, colors, palette }>
 * Non défini si le navigateur n'a pas CompressionStream (l'appelant retombe alors
 * sur son comportement WebP).
 */
(function () {
    'use strict';

    if (typeof CompressionStream === 'undefined') return;

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
            return n * s;
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

    /** Filtre 0 (None) partout : sur une image à palette, filtrer fait grossir. */
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
            parts.push(chunk('tRNS', trns));
        }
        parts.push(chunk('IDAT', await deflate(raw)));
        parts.push(chunk('IEND', new Uint8Array(0)));

        return { blob: new Blob(parts, { type: 'image/png' }), colors: palette.length, palette: palette };
    }

    window.PNG8 = { encode: encodePng8 };
})();
