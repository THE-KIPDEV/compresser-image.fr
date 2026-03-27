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

    let selectedFiles = [];
    let compressedFiles = [];
    let currentQuality = 90; // default: light
    let currentLevel = 'light';

    var hints = {
        light: 'Compression légère — Qualité quasi identique, fichier un peu plus léger.',
        recommended: 'Recommandé — Bon équilibre entre qualité et poids. Idéal pour le web.',
        strong: 'Compression forte — Fichier beaucoup plus léger, légère perte de qualité possible.',
        mega: 'Méga compression — Réduction maximale via notre serveur. Abonnement Pro requis.',
    };

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

    function handleFiles(files) {
        const validTypes = ['image/jpeg', 'image/png', 'image/webp'];
        selectedFiles = Array.from(files).filter(f => validTypes.includes(f.type));

        if (selectedFiles.length === 0) {
            showNotification('Sélectionnez des images PNG, JPEG ou WebP.', 'error');
            return;
        }

        const maxSize = 10 * 1024 * 1024;
        const tooBig = selectedFiles.filter(f => f.size > maxSize);
        if (tooBig.length > 0) {
            showNotification(tooBig.length + ' fichier(s) trop volumineux (> 10 Mo), ignorés.', 'warning');
            selectedFiles = selectedFiles.filter(f => f.size <= maxSize);
        }

        if (selectedFiles.length > 10) {
            showNotification('Max 10 images en gratuit. Les suivantes sont ignorées.', 'warning');
            selectedFiles = selectedFiles.slice(0, 10);
        }

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
                showNotification('La méga compression est réservée aux abonnés Pro.', 'info');
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
        let totalOriginal = 0;
        let totalCompressed = 0;

        for (let i = 0; i < selectedFiles.length; i++) {
            const file = selectedFiles[i];
            try {
                const result = await compressImage(file, quality);
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

    // ───── Client-side compression via Canvas ─────

    function compressImage(file, quality) {
        return new Promise((resolve, reject) => {
            const reader = new FileReader();
            reader.onload = (e) => {
                const img = new Image();
                img.onload = () => {
                    const canvas = document.createElement('canvas');
                    const ctx = canvas.getContext('2d');

                    let width = img.naturalWidth;
                    let height = img.naturalHeight;

                    if (currentLevel === 'strong' && (width > 2000 || height > 2000)) {
                        const ratio = Math.min(2000 / width, 2000 / height);
                        width = Math.round(width * ratio);
                        height = Math.round(height * ratio);
                    }

                    canvas.width = width;
                    canvas.height = height;

                    if (file.type === 'image/jpeg') {
                        ctx.fillStyle = '#ffffff';
                        ctx.fillRect(0, 0, width, height);
                    }

                    ctx.drawImage(img, 0, 0, width, height);

                    // Try multiple formats/qualities and pick the smallest that's under original size
                    var candidates = [];
                    var pending = 0;

                    function tryBlob(type, q) {
                        pending++;
                        canvas.toBlob(function (blob) {
                            if (blob) candidates.push({ blob: blob, type: type });
                            pending--;
                            if (pending === 0) pickBest();
                        }, type, q);
                    }

                    function pickBest() {
                        // Sort by size, smallest first
                        candidates.sort(function (a, b) { return a.blob.size - b.blob.size; });

                        // Pick smallest that is actually smaller than original
                        var best = null;
                        for (var c = 0; c < candidates.length; c++) {
                            if (candidates[c].blob.size < file.size) {
                                best = candidates[c];
                                break;
                            }
                        }

                        // If nothing is smaller, use original file as-is
                        if (!best) {
                            resolve({
                                name: file.name,
                                originalSize: file.size,
                                blob: file,
                                thumbUrl: e.target.result,
                                compressedUrl: URL.createObjectURL(file),
                                type: file.type,
                                unchanged: true,
                            });
                            return;
                        }

                        resolve({
                            name: file.name,
                            originalSize: file.size,
                            blob: best.blob,
                            thumbUrl: e.target.result,
                            compressedUrl: URL.createObjectURL(best.blob),
                            type: best.type,
                        });
                    }

                    // Always try WebP (best compression in browsers)
                    tryBlob('image/webp', quality);
                    tryBlob('image/webp', Math.max(0.2, quality - 0.2));

                    // Also try the original format
                    if (file.type === 'image/jpeg') {
                        tryBlob('image/jpeg', quality);
                        tryBlob('image/jpeg', Math.max(0.3, quality - 0.15));
                    } else if (file.type === 'image/png') {
                        tryBlob('image/png', undefined);
                    }
                };
                img.onerror = function () { reject(new Error('Image invalide')); };
                img.src = e.target.result;
            };
            reader.onerror = function () { reject(new Error('Erreur de lecture')); };
            reader.readAsDataURL(file);
        });
    }

    // ───── UI ─────

    function addResultItem(result, index) {
        var outExt = result.type.split('/')[1];
        var origExt = result.name.match(/\.([^.]+)$/);
        var downloadExt = outExt === 'webp' ? '.webp' : (origExt ? origExt[0] : '.jpg');
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
            '</div>' +
            '<div class="result-actions">' +
                '<button class="btn btn-primary btn-sm download-btn" data-index="' + index + '">' +
                    '<svg width="16" height="16" viewBox="0 0 18 18" fill="none"><path d="M9 2V12M9 12L5 8M9 12L13 8M2 15H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>' +
                    ' Télécharger' +
                '</button>' +
            '</div>';

        item.querySelector('.download-btn').addEventListener('click', function () {
            downloadBlob(result.blob, downloadName);
        });

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
                const ext = result.type.split('/')[1] === 'webp' ? '.webp' : '';
                const downloadName = result.name.replace(/\.[^.]+$/, '') + '-compresse' + (ext || result.name.match(/\.[^.]+$/)?.[0] || '.jpg');
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
