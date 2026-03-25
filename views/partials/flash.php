<?php $flashes = getFlashes(); ?>
<?php if (!empty($flashes)): ?>
<div class="flash-container">
    <?php foreach ($flashes as $flash): ?>
        <div class="flash flash-<?= e($flash['type']) ?>" onclick="this.remove()">
            <span class="flash-icon">
                <?php if ($flash['type'] === 'success'): ?>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M7 10L9 12L13 8M19 10C19 14.9706 14.9706 19 10 19C5.02944 19 1 14.9706 1 10C1 5.02944 5.02944 1 10 1C14.9706 1 19 5.02944 19 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <?php elseif ($flash['type'] === 'error'): ?>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 7V10M10 13H10.01M19 10C19 14.9706 14.9706 19 10 19C5.02944 19 1 14.9706 1 10C1 5.02944 5.02944 1 10 1C14.9706 1 19 5.02944 19 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <?php else: ?>
                    <svg width="20" height="20" viewBox="0 0 20 20" fill="none"><path d="M10 7V10M10 13H10.01M19 10C19 14.9706 14.9706 19 10 19C5.02944 19 1 14.9706 1 10C1 5.02944 5.02944 1 10 1C14.9706 1 19 5.02944 19 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>
                <?php endif; ?>
            </span>
            <span><?= e($flash['message']) ?></span>
            <button class="flash-close" aria-label="Fermer">&times;</button>
        </div>
    <?php endforeach; ?>
</div>
<?php endif; ?>
