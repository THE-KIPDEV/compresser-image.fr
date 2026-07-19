/**
 * heic-decode.js — décodage HEIC/HEIF 100 % côté navigateur.
 *
 * Les photos iPhone sont en HEIC (codec HEVC) depuis iOS 11. Chrome, Firefox,
 * Edge et Android ne savent pas les afficher : seul Safari le fait. Pour que la
 * conversion marche sur l'appareil de TOUT le monde (et surtout Windows/Android,
 * ceux qui en ont vraiment besoin), on décode le HEIC nous-mêmes avec libheif
 * compilé en WebAssembly. Rien n'est envoyé sur un serveur.
 *
 * Le décodeur pèse ~1,4 Mo : on ne le charge qu'au premier HEIC déposé, jamais
 * à l'ouverture de la page. Expose window.HEIC = { isHeic, toPng }.
 */
(function () {
    'use strict';

    // URL du bundle, dérivée de l'emplacement de CE script (robuste à un préfixe
    // de chemin ou à un autre domaine d'assets).
    var LIB_URL = (function () {
        var here = document.currentScript && document.currentScript.src;
        if (here) return here.replace(/heic-decode\.js(\?.*)?$/, 'libheif-bundle.js');
        return '/public/js/libheif-bundle.js';
    })();

    var libPromise = null;

    function loadLib() {
        if (window.libheif && window.libheif.HeifDecoder) return Promise.resolve(window.libheif);
        if (libPromise) return libPromise;
        libPromise = new Promise(function (resolve, reject) {
            var s = document.createElement('script');
            s.src = LIB_URL;
            s.async = true;
            s.onload = function () {
                if (window.libheif && window.libheif.HeifDecoder) resolve(window.libheif);
                else reject(new Error('Décodeur HEIC indisponible'));
            };
            s.onerror = function () { reject(new Error('Décodeur HEIC introuvable (vérifiez votre connexion)')); };
            document.head.appendChild(s);
        });
        return libPromise;
    }

    function isHeic(file) {
        var t = (file.type || '').toLowerCase();
        if (t === 'image/heic' || t === 'image/heif' || t === 'image/heic-sequence') return true;
        // Sur Windows/Android, File.type est souvent vide pour un .heic : on retombe
        // sur l'extension du nom de fichier.
        return /\.(heic|heif)$/i.test(file.name || '');
    }

    // Décode un HEIC et rend un File PNG (même nom de base) prêt à passer dans le
    // pipeline de compression/conversion existant. Tout se fait dans l'onglet.
    function toPng(file) {
        return loadLib().then(function (lib) {
            return file.arrayBuffer().then(function (buf) {
                var decoder = new lib.HeifDecoder();
                var images = decoder.decode(new Uint8Array(buf));
                if (!images || !images.length) {
                    throw new Error('Fichier HEIC illisible ou vide');
                }
                var image = images[0];
                var w = image.get_width();
                var h = image.get_height();
                if (!w || !h) throw new Error('Dimensions HEIC invalides');

                var canvas = document.createElement('canvas');
                canvas.width = w;
                canvas.height = h;
                var ctx = canvas.getContext('2d');
                var imageData = ctx.createImageData(w, h);

                return new Promise(function (resolve, reject) {
                    image.display(imageData, function (displayData) {
                        if (!displayData) { reject(new Error('Échec du décodage HEIC')); return; }
                        try {
                            ctx.putImageData(imageData, 0, 0);
                            if (typeof image.free === 'function') { try { image.free(); } catch (e) {} }
                            canvas.toBlob(function (blob) {
                                if (!blob) { reject(new Error('Conversion HEIC impossible')); return; }
                                var base = (file.name || 'photo').replace(/\.(heic|heif)$/i, '') || 'photo';
                                resolve(new File([blob], base + '.png', { type: 'image/png' }));
                            }, 'image/png');
                        } catch (err) { reject(err); }
                    });
                });
            });
        });
    }

    window.HEIC = { isHeic: isHeic, toPng: toPng };
})();
