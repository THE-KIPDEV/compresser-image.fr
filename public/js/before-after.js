/**
 * before-after.js — Interactive before/after slider with touch support
 */

function initBeforeAfter() {
    const wrapper = document.querySelector('.ba-image-wrapper');
    const overlay = document.getElementById('baOverlay');
    const slider = document.getElementById('baSlider');

    if (!wrapper || !overlay || !slider) return;

    let isDragging = false;
    let wrapperRect = null;

    function updatePosition(clientX) {
        if (!wrapperRect) wrapperRect = wrapper.getBoundingClientRect();

        let x = clientX - wrapperRect.left;
        x = Math.max(0, Math.min(x, wrapperRect.width));
        const percent = (x / wrapperRect.width) * 100;

        overlay.style.width = percent + '%';
        slider.style.left = percent + '%';
    }

    function onStart(e) {
        isDragging = true;
        wrapperRect = wrapper.getBoundingClientRect();
        wrapper.style.cursor = 'ew-resize';

        const clientX = e.touches ? e.touches[0].clientX : e.clientX;
        updatePosition(clientX);
    }

    function onMove(e) {
        if (!isDragging) return;
        e.preventDefault();

        const clientX = e.touches ? e.touches[0].clientX : e.clientX;
        updatePosition(clientX);
    }

    function onEnd() {
        isDragging = false;
        wrapper.style.cursor = '';
        wrapperRect = null;
    }

    // Remove old listeners (in case of re-init)
    wrapper.replaceWith(wrapper.cloneNode(true));
    const newWrapper = document.querySelector('.ba-image-wrapper');
    const newOverlay = document.getElementById('baOverlay');
    const newSlider = document.getElementById('baSlider');

    // Mouse events
    newWrapper.addEventListener('mousedown', onStart);
    document.addEventListener('mousemove', onMove);
    document.addEventListener('mouseup', onEnd);

    // Touch events
    newWrapper.addEventListener('touchstart', onStart, { passive: true });
    document.addEventListener('touchmove', onMove, { passive: false });
    document.addEventListener('touchend', onEnd);

    // Click to jump
    newWrapper.addEventListener('click', (e) => {
        const rect = newWrapper.getBoundingClientRect();
        const x = e.clientX - rect.left;
        const percent = (x / rect.width) * 100;
        newOverlay.style.width = percent + '%';
        newSlider.style.left = percent + '%';
    });

    // Resize observer
    const resizeObserver = new ResizeObserver(() => {
        wrapperRect = null;
    });
    resizeObserver.observe(newWrapper);

    // Reset to 50%
    newOverlay.style.width = '50%';
    newSlider.style.left = '50%';

    // Fix overlay image width to match wrapper
    const overlayImg = newOverlay.querySelector('img');
    if (overlayImg) {
        const syncWidth = () => {
            overlayImg.style.width = newWrapper.offsetWidth + 'px';
        };
        syncWidth();
        new ResizeObserver(syncWidth).observe(newWrapper);
    }
}

// Auto-init if images are already present
document.addEventListener('DOMContentLoaded', () => {
    const baOriginal = document.getElementById('baOriginal');
    if (baOriginal && baOriginal.src) {
        baOriginal.addEventListener('load', initBeforeAfter);
    }
});
