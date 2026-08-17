<?php
/**
 * KIPDEV maillage — grappe thématique (généré par automation/maillage-grappes.py, NE PAS ÉDITER À LA MAIN).
 * Bloc footer « Nos autres outils image & vidéo » : uniquement des sites du même thème.
 */
if (!function_exists('kipdev_network_links')) {
    function kipdev_network_sites(): array {
        return [
            ['domain' => 'ma-petite-affiche.fr', 'label' => 'Ma Petite Affiche', 'desc' => 'Affiches personnalisées'],
            ['domain' => 'make-autocut.com', 'label' => 'Make AutoCut', 'desc' => 'Montage vidéo automatique'],
            ['domain' => 'make-blur.com', 'label' => 'Make Blur', 'desc' => 'Floutage vidéo automatique'],
            ['domain' => 'make-vertical.com', 'label' => 'Make Vertical', 'desc' => 'Vidéo verticale 9:16'],
            ['domain' => 'supprimer-fond-image.fr', 'label' => 'Supprimer le fond', 'desc' => 'Détourage d\'image en 1 clic'],
        ];
    }
    function kipdev_network_links(string $currentDomain, int $limit = 6): array {
        $out = array_values(array_filter(kipdev_network_sites(), fn($s) => $s['domain'] !== $currentDomain));
        return array_slice($out, 0, $limit);
    }
}

$__host = preg_replace('/^www\./', '', strtolower($_SERVER['HTTP_HOST'] ?? ''));
$__network = kipdev_network_links($__host, 6);
if (!empty($__network)):
?>
<section style="border-top:1px solid rgba(0,0,0,.08);margin-top:2.5rem;padding-top:2rem">
  <div style="max-width:1100px;margin:0 auto;padding:0 1.25rem">
    <div style="font-weight:600;margin-bottom:1rem;font-size:.95rem"><?= htmlspecialchars('Nos autres outils image & vidéo') ?></div>
    <div style="display:grid;grid-template-columns:repeat(auto-fill,minmax(220px,1fr));gap:.6rem">
      <?php foreach ($__network as $s): ?>
      <a href="https://<?= htmlspecialchars($s['domain']) ?>" target="_blank" rel="noopener"
         style="display:flex;align-items:flex-start;gap:.5rem;border:1px solid rgba(0,0,0,.1);border-radius:.75rem;background:#fff;padding:.7rem .85rem;text-decoration:none;transition:border-color .15s"
         onmouseover="this.style.borderColor='rgba(0,0,0,.28)'" onmouseout="this.style.borderColor='rgba(0,0,0,.1)'">
        <span style="flex:1;min-width:0">
          <span style="display:block;font-size:.875rem;font-weight:600;color:#1a1a1a;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= htmlspecialchars($s['label']) ?></span>
          <span style="display:block;font-size:.75rem;color:#6b6b6b;white-space:nowrap;overflow:hidden;text-overflow:ellipsis"><?= htmlspecialchars($s['desc']) ?></span>
        </span>
        <svg width="16" height="16" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" style="color:#bbb;flex-shrink:0;margin-top:2px"><path d="M7 7h10v10"/><path d="M7 17 17 7"/></svg>
      </a>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>
