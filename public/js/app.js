/**
 * app.js — Global utilities
 */

// Auto-dismiss flash messages
document.addEventListener('DOMContentLoaded', () => {
    document.querySelectorAll('.flash').forEach(flash => {
        setTimeout(() => {
            flash.style.opacity = '0';
            flash.style.transform = 'translateX(20px)';
            setTimeout(() => flash.remove(), 300);
        }, 5000);
    });

    // Close menu on nav-mobile link click
    document.querySelectorAll('.nav-mobile a').forEach(link => {
        link.addEventListener('click', () => {
            document.body.classList.remove('menu-open');
        });
    });

    // Smooth scroll to #compressor if hash
    if (window.location.hash === '#compressor') {
        const el = document.getElementById('compressor');
        if (el) el.scrollIntoView({ behavior: 'smooth' });
    }
});
