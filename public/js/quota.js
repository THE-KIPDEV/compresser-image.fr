(function () {
    'use strict';
    var app = window.APP || {};
    var status = null;
    var notice = document.createElement('p');
    notice.className = 'compression-quota';
    notice.setAttribute('role', 'status');
    notice.style.cssText = 'text-align:center;margin:12px 0;font-size:14px;color:var(--gray-600);line-height:1.6';
    var tool = document.getElementById('dropZone') || document.querySelector('.pr-drop');
    if (tool) tool.insertAdjacentElement('afterend', notice);
    function paint() {
        if (!status) return;
        notice.textContent = status.pro ? 'Pro · compressions illimitées' : status.remaining + ' image(s) gratuite(s) restante(s) aujourd’hui sur ce navigateur.';
        if (!status.pro && status.remaining === 0 && app.pricingUrl) {
            var a = document.createElement('a');
            a.href = app.pricingUrl;
            a.textContent = ' Passer en Pro';
            notice.appendChild(a);
        }
    }
    async function request(consume) {
        var response = await fetch(app.quotaUrl || '/api/quota', {
            method: consume ? 'POST' : 'GET', credentials: 'same-origin', cache: 'no-store',
            headers: consume ? {'X-CSRF-Token': app.csrf || ''} : {}
        });
        var data = await response.json();
        if (!response.ok) {
            if (consume && response.status === 403 && window.self !== window.top) {
                var message = 'Votre navigateur bloque le compteur intégré. Ouvrez le compresseur pour utiliser vos images gratuites.';
                notice.textContent = message + ' ';
                var open = document.createElement('a');
                open.href = 'https://compresser-image.fr/';
                open.target = '_blank';
                open.rel = 'noopener';
                open.textContent = 'Ouvrir le compresseur';
                notice.appendChild(open);
                throw new Error(message);
            }
            if (data.quota) { status = data.quota; paint(); }
            throw new Error(data.error || 'Le quota est momentanément indisponible. Réessayez.');
        }
        status = data; paint(); return data;
    }
    window.CompressionQuota = {
        check: async function (count) {
            var q = await request(false);
            if (!q.pro && count > q.remaining) throw new Error(q.remaining
                ? 'Il vous reste ' + q.remaining + ' image(s) aujourd’hui. Retirez les images en trop ou passez en Pro.'
                : 'Vos 3 images gratuites du jour ont été utilisées. Revenez demain ou passez en Pro.');
        },
        consume: function () { return request(true); }
    };
    if (tool) request(false).catch(function () { notice.textContent = '3 images gratuites par jour · Pro illimité'; });
})();
