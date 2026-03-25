/**
 * compressor.js — Client-side image compression engine + UI
 */

(function () {
    'use strict';

    // Elements
    const dropZone = document.getElementById('dropZone');
    const fileInput = document.getElementById('fileInput');
    const compressOptions = document.getElementById('compressOptions');
    const qualitySlider = document.getElementById('qualitySlider');
    const qualityValue = document.getElementById('qualityValue');
    const compressBtn = document.getElementById('compressBtn');
    const resultsContainer = document.getElementById('resultsContainer');
    const resultsSummary = document.getElementById('resultsSummary');
    const resultsList = document.getElementById('resultsList');
    const downloadAllBtn = document.getElementById('downloadAllBtn');
    const newCompressionBtn = document.getElementById('newCompressionBtn');
    const beforeAfterSection = document.getElementById('beforeAfterSection');

    if (!dropZone) return;

    let selectedFiles = [];
    let compressedFiles = [];
    let currentMode = 'smart';

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
            showNotification('Veuillez sélectionner des images PNG, JPEG ou WebP.', 'error');
            return;
        }

        const maxSize = 10 * 1024 * 1024; // 10 MB
        const tooBig = selectedFiles.filter(f => f.size > maxSize);
        if (tooBig.length > 0) {
            showNotification(`${tooBig.length} fichier(s) dépassent 10 Mo et seront ignorés.`, 'warning');
            selectedFiles = selectedFiles.filter(f => f.size <= maxSize);
        }

        if (selectedFiles.length > 10) {
            showNotification('Maximum 10 images en mode gratuit. Passez en Pro pour 100.', 'warning');
            selectedFiles = selectedFiles.slice(0, 10);
        }

        // Show options
        compressOptions.style.display = '';
        resultsContainer.style.display = 'none';
        beforeAfterSection.style.display = 'none';

        // Update drop zone text
        dropZone.querySelector('.drop-zone-text').innerHTML =
            `<strong>${selectedFiles.length} image${selectedFiles.length > 1 ? 's' : ''} sélectionnée${selectedFiles.length > 1 ? 's' : ''}</strong>`;
    }

    // ───── Quality Slider ─────

    if (qualitySlider) {
        qualitySlider.addEventListener('input', () => {
            qualityValue.textContent = qualitySlider.value + '%';
        });
    }

    // ───── Mode Toggle ─────

    document.querySelectorAll('.toggle-btn').forEach(btn => {
        btn.addEventListener('click', () => {
            const mode = btn.dataset.mode;

            // Check Pro requirement
            if (mode === 'mega' && !btn.classList.contains('pro-only-unlocked')) {
                showNotification('La méga compression nécessite un abonnement Pro.', 'info');
                return;
            }

            document.querySelectorAll('.toggle-btn').forEach(b => b.classList.remove('active'));
            btn.classList.add('active');
            currentMode = mode;

            // Adjust quality for mode
            if (mode === 'smart') {
                qualitySlider.value = 80;
            } else if (mode === 'max') {
                qualitySlider.value = 50;
            } else {
                qualitySlider.value = 30;
            }
            qualityValue.textContent = qualitySlider.value + '%';
        });
    });

    // ───── Compress ─────

    if (compressBtn) {
        compressBtn.addEventListener('click', compressAll);
    }

    async function compressAll() {
        if (selectedFiles.length === 0) return;

        compressBtn.disabled = true;
        compressBtn.innerHTML = '<span class="spinner"></span> Compression en cours...';

        compressedFiles = [];
        resultsList.innerHTML = '';

        const quality = parseInt(qualitySlider.value) / 100;

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
                console.error('Compression error:', err);
                addErrorItem(file.name, err.message);
            }
        }

        // Summary
        resultsSummary.innerHTML = `
            <div class="summary-stat">
                <span class="stat-label">Images</span>
                <span class="stat-value">${compressedFiles.length}</span>
            </div>
            <div class="summary-stat">
                <span class="stat-label">Taille originale</span>
                <span class="stat-value">${formatSize(totalOriginal)}</span>
            </div>
            <div class="summary-stat">
                <span class="stat-label">Taille compressée</span>
                <span class="stat-value">${formatSize(totalCompressed)}</span>
            </div>
            <div class="summary-stat">
                <span class="stat-label">Économisé</span>
                <span class="stat-value" style="color:var(--success)">${formatPercent(totalOriginal, totalCompressed)}</span>
            </div>
        `;

        resultsContainer.style.display = '';
        compressBtn.disabled = false;
        compressBtn.innerHTML = `
            <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M4 8L10 2L16 8M4 12L10 18L16 12" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
            Compresser les images
        `;

        // Show before/after for first image
        if (compressedFiles.length > 0) {
            showBeforeAfter(compressedFiles[0]);
        }

        // Scroll to results
        resultsContainer.scrollIntoView({ behavior: 'smooth', block: 'start' });
    }

    // ───── Client-side compression using Canvas ─────

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

                    // For max mode, limit dimensions
                    if (currentMode === 'max' && (width > 2000 || height > 2000)) {
                        const ratio = Math.min(2000 / width, 2000 / height);
                        width = Math.round(width * ratio);
                        height = Math.round(height * ratio);
                    }

                    canvas.width = width;
                    canvas.height = height;

                    // White background for JPEG (no alpha)
                    if (file.type === 'image/jpeg') {
                        ctx.fillStyle = '#ffffff';
                        ctx.fillRect(0, 0, width, height);
                    }

                    ctx.drawImage(img, 0, 0, width, height);

                    // Determine output type
                    let outputType = file.type;
                    let outputQuality = quality;

                    // For PNG, convert to webp or use PNG compression
                    if (file.type === 'image/png') {
                        // Keep PNG but at reduced quality if WebP is supported
                        outputType = 'image/png';
                        // Canvas PNG doesn't have quality param, so we convert to WebP for better compression
                        if (currentMode !== 'smart' || quality < 0.7) {
                            outputType = 'image/webp';
                            outputQuality = quality;
                        }
                    }

                    canvas.toBlob(
                        (blob) => {
                            if (!blob) {
                                reject(new Error('Échec de la compression'));
                                return;
                            }

                            // If compressed is larger than original, use original quality settings
                            if (blob.size >= file.size && quality > 0.5) {
                                canvas.toBlob(
                                    (blob2) => {
                                        resolve({
                                            name: file.name,
                                            originalSize: file.size,
                                            blob: blob2 && blob2.size < file.size ? blob2 : blob,
                                            originalUrl: e.target.result,
                                            compressedUrl: URL.createObjectURL(blob2 && blob2.size < file.size ? blob2 : blob),
                                            type: outputType,
                                        });
                                    },
                                    outputType,
                                    Math.max(0.3, quality - 0.2)
                                );
                                return;
                            }

                            resolve({
                                name: file.name,
                                originalSize: file.size,
                                blob: blob,
                                originalUrl: e.target.result,
                                compressedUrl: URL.createObjectURL(blob),
                                type: outputType,
                            });
                        },
                        outputType,
                        outputQuality
                    );
                };
                img.onerror = () => reject(new Error('Image invalide'));
                img.src = e.target.result;
            };
            reader.onerror = () => reject(new Error('Erreur de lecture'));
            reader.readAsDataURL(file);
        });
    }

    // ───── UI Helpers ─────

    function addResultItem(result, index) {
        const savings = formatPercent(result.originalSize, result.blob.size);
        const ext = result.type.split('/')[1] === 'webp' ? '.webp' : '';
        const downloadName = result.name.replace(/\.[^.]+$/, '') + '-compresse' + (ext || result.name.match(/\.[^.]+$/)?.[0] || '.jpg');

        const item = document.createElement('div');
        item.className = 'result-item';
        item.innerHTML = `
            <img src="${result.compressedUrl}" alt="" class="result-thumb">
            <div class="result-info">
                <div class="result-name">${escapeHtml(result.name)}</div>
                <div class="result-meta">
                    <span>${formatSize(result.originalSize)} → ${formatSize(result.blob.size)}</span>
                    <span class="result-savings">-${savings}</span>
                </div>
            </div>
            <div class="result-actions">
                <button class="result-btn" title="Comparer avant/après" data-index="${index}">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M9 2V16M2 9H16" stroke="currentColor" stroke-width="2" stroke-linecap="round"/></svg>
                </button>
                <button class="result-btn download-btn" title="Télécharger" data-index="${index}">
                    <svg width="18" height="18" viewBox="0 0 18 18" fill="none"><path d="M9 2V12M9 12L5 8M9 12L13 8M2 15H16" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                </button>
            </div>
        `;

        // Compare button
        item.querySelector('[title="Comparer avant/après"]').addEventListener('click', () => {
            showBeforeAfter(result);
            beforeAfterSection.scrollIntoView({ behavior: 'smooth' });
        });

        // Download button
        item.querySelector('.download-btn').addEventListener('click', () => {
            downloadBlob(result.blob, downloadName);
        });

        resultsList.appendChild(item);
    }

    function addErrorItem(name, error) {
        const item = document.createElement('div');
        item.className = 'result-item';
        item.style.borderColor = 'var(--error-light)';
        item.innerHTML = `
            <div class="result-info">
                <div class="result-name">${escapeHtml(name)}</div>
                <div class="result-meta" style="color:var(--error)">${escapeHtml(error)}</div>
            </div>
        `;
        resultsList.appendChild(item);
    }

    function showBeforeAfter(result) {
        const baOriginal = document.getElementById('baOriginal');
        const baCompressed = document.getElementById('baCompressed');

        baOriginal.src = result.originalUrl;
        baCompressed.src = result.compressedUrl;

        beforeAfterSection.style.display = '';

        // Re-init the slider
        if (typeof initBeforeAfter === 'function') {
            // Wait for images to load
            baOriginal.onload = () => initBeforeAfter();
        }
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

    // ───── New Compression ─────

    if (newCompressionBtn) {
        newCompressionBtn.addEventListener('click', () => {
            selectedFiles = [];
            compressedFiles = [];
            resultsList.innerHTML = '';
            resultsContainer.style.display = 'none';
            compressOptions.style.display = 'none';
            beforeAfterSection.style.display = 'none';
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

    function showNotification(message, type = 'info') {
        const container = document.querySelector('.flash-container') || createFlashContainer();
        const flash = document.createElement('div');
        flash.className = `flash flash-${type}`;
        flash.innerHTML = `<span>${escapeHtml(message)}</span><button class="flash-close" onclick="this.parentElement.remove()">&times;</button>`;
        container.appendChild(flash);
        setTimeout(() => {
            flash.style.opacity = '0';
            flash.style.transform = 'translateX(20px)';
            setTimeout(() => flash.remove(), 300);
        }, 4000);
    }

    function createFlashContainer() {
        const container = document.createElement('div');
        container.className = 'flash-container';
        document.body.appendChild(container);
        return container;
    }
})();
