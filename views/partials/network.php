<?php
/**
 * KIPDEV inter-site network — "Nos autres outils" maillage block.
 * Self-contained drop-in: data + selector + render with inline styles
 * (robust across any site's stylesheet). Excludes the current host.
 * Source of truth: automation/kipdev-network.json
 */
if (!function_exists('kipdev_network_links')) {
    function kipdev_network_sites(): array {
        return [
            ['domain' => 'quelle-ia-choisir.fr', 'label' => 'Quelle IA choisir', 'desc' => "Comparateur d'outils IA", 'category' => 'ia', 'flagship' => true],
            ['domain' => 'meilleure-formation-ia.fr', 'label' => 'Meilleure formation IA', 'desc' => 'Comparateur de formations IA', 'category' => 'ia'],
            ['domain' => 'metiers-ia.fr', 'label' => "Métiers de l'IA", 'desc' => "Annuaire des métiers de l'IA", 'category' => 'ia'],
            ['domain' => 'ia-debutant.fr', 'label' => 'IA Débutant', 'desc' => 'Formation IA pour débutants', 'category' => 'ia'],
            ['domain' => 'ia-restaurant.fr', 'label' => 'IA Restaurant', 'desc' => 'Outils IA pour restaurateurs', 'category' => 'ia'],
            ['domain' => 'generateur-image-ia.fr', 'label' => "Générateur d'images IA", 'desc' => 'Créez des images par IA', 'category' => 'ia', 'flagship' => true],
            ['domain' => 'generateur-logo-ia.fr', 'label' => 'Générateur de logos IA', 'desc' => 'Créez un logo par IA', 'category' => 'ia'],
            ['domain' => 'coloriage-ia.fr', 'label' => 'Coloriage IA', 'desc' => 'Coloriages générés par IA', 'category' => 'ia'],
            ['domain' => 'kipagent.com', 'label' => 'KipAgent', 'desc' => 'Chatbot IA pour votre site', 'category' => 'ia'],
            ['domain' => 'fiche-haccp.fr', 'label' => 'Fiche HACCP', 'desc' => 'Générateur de fiches HACCP', 'category' => 'restaurant', 'flagship' => true],
            ['domain' => 'pack-hygiene-restaurant.fr', 'label' => 'Pack Hygiène Restaurant', 'desc' => 'Logiciel hygiène & HACCP', 'category' => 'restaurant'],
            ['domain' => 'tableau-allergenes.fr', 'label' => 'Tableau des allergènes', 'desc' => 'Affichage allergènes obligatoire', 'category' => 'restaurant'],
            ['domain' => 'origine-viande.fr', 'label' => 'Origine des viandes', 'desc' => 'Affichage origine viandes', 'category' => 'restaurant'],
            ['domain' => 'creer-menu-restaurant.fr', 'label' => 'Créer un menu', 'desc' => 'Éditeur de menus restaurant', 'category' => 'restaurant'],
            ['domain' => 'my-food-truck.com', 'label' => 'My Food Truck', 'desc' => 'Site & commandes food truck', 'category' => 'restaurant'],
            ['domain' => 'legal-site.fr', 'label' => 'Legal Site', 'desc' => 'Mentions légales & CGV/CGU', 'category' => 'documents', 'flagship' => true],
            ['domain' => 'reglement-interieur-entreprise.fr', 'label' => 'Règlement intérieur', 'desc' => 'Règlement intérieur entreprise', 'category' => 'documents'],
            ['domain' => 'le-registre-unique-personnel.fr', 'label' => 'Registre du personnel', 'desc' => 'Registre unique du personnel', 'category' => 'documents'],
            ['domain' => 'registre-dasri.fr', 'label' => 'Registre DASRI', 'desc' => 'Registre déchets de soins', 'category' => 'documents'],
            ['domain' => 'gestion-notes-de-frais.fr', 'label' => 'Notes de frais', 'desc' => 'Générateur de notes de frais', 'category' => 'documents'],
            ['domain' => 'facture-auto-entrepreneur.fr', 'label' => 'Factures auto-entrepreneur', 'desc' => 'Facturation auto-entrepreneur', 'category' => 'documents', 'flagship' => true],
            ['domain' => 'succession-simulateur.fr', 'label' => 'Simulateur succession', 'desc' => 'Droits de succession', 'category' => 'documents'],
            ['domain' => 'fiche-ronde-maintenance.fr', 'label' => 'Fiches de ronde', 'desc' => 'Fiches de ronde maintenance', 'category' => 'documents'],
            ['domain' => 'woofacture.com', 'label' => 'WooFacture', 'desc' => 'Facturation Factur-X WooCommerce', 'category' => 'documents'],
            ['domain' => 'supprimer-fond-image.fr', 'label' => 'Supprimer le fond', 'desc' => "Détourage d'image en 1 clic", 'category' => 'image-video', 'flagship' => true],
            ['domain' => 'compresser-image.fr', 'label' => 'Compresser une image', 'desc' => "Compression d'images", 'category' => 'image-video'],
            ['domain' => 'ma-petite-affiche.fr', 'label' => 'Ma Petite Affiche', 'desc' => 'Affiches personnalisées', 'category' => 'image-video'],
            ['domain' => 'make-autocut.com', 'label' => 'Make AutoCut', 'desc' => 'Montage vidéo automatique', 'category' => 'image-video'],
            ['domain' => 'make-blur.com', 'label' => 'Make Blur', 'desc' => 'Floutage vidéo automatique', 'category' => 'image-video'],
            ['domain' => 'make-vertical.com', 'label' => 'Make Vertical', 'desc' => 'Vidéo verticale 9:16', 'category' => 'image-video'],
            ['domain' => 'mon-budget-mariage.fr', 'label' => 'Mon Budget Mariage', 'desc' => 'Simulateur de budget mariage', 'category' => 'mariage', 'flagship' => true],
            ['domain' => 'plan-de-tables.fr', 'label' => 'Plan de Tables', 'desc' => 'Plan de table de mariage', 'category' => 'mariage'],
            ['domain' => 'creer-faire-part.com', 'label' => 'Créer un faire-part', 'desc' => 'Faire-part personnalisés', 'category' => 'mariage'],
            ['domain' => 'galerie-mariage.fr', 'label' => 'Galerie Mariage', 'desc' => 'Galerie photo de mariage', 'category' => 'mariage'],
            ['domain' => 'galerie-photographe.fr', 'label' => 'Galerie Photographe', 'desc' => 'Galeries photo pour pros', 'category' => 'mariage'],
            ['domain' => 'webhook-toolkit.com', 'label' => 'Webhook Toolkit', 'desc' => 'Boîte à outils webhooks', 'category' => 'dev', 'flagship' => true],
            ['domain' => 'cron-ping.com', 'label' => 'Cron Ping', 'desc' => 'Monitoring de tâches cron', 'category' => 'dev'],
            ['domain' => 'saas-starter.com', 'label' => 'SaaS Starter', 'desc' => 'Boilerplate SaaS Next.js', 'category' => 'dev'],
            ['domain' => 'schema-org-generateur.fr', 'label' => 'Générateur Schema.org', 'desc' => 'Données structurées SEO', 'category' => 'dev'],
            ['domain' => 'woodashai.com', 'label' => 'WooDashAI', 'desc' => 'Dashboard WooCommerce + IA', 'category' => 'dev'],
            ['domain' => 'creer-qrcode.fr', 'label' => 'Créer un QR Code', 'desc' => 'QR codes dynamiques', 'category' => 'dev'],
            ['domain' => 'signature-email-pro.com', 'label' => 'Signature Email Pro', 'desc' => 'Signatures email pro', 'category' => 'dev'],
            ['domain' => 'convertir-fichier.fr', 'label' => 'Convertir un fichier', 'desc' => 'Conversion de fichiers', 'category' => 'dev'],
            ['domain' => 'lequel-choisir.com', 'label' => 'Lequel choisir', 'desc' => "Comparatifs 'A ou B' calculés", 'category' => 'conso', 'flagship' => true],
        ];
    }

    function kipdev_network_links(string $currentDomain, int $limit = 6): array {
        $sites = kipdev_network_sites();
        $me = null;
        foreach ($sites as $s) { if ($s['domain'] === $currentDomain) { $me = $s; break; } }
        $others = array_filter($sites, fn($s) => $s['domain'] !== $currentDomain);
        $siblings = $me ? array_filter($others, fn($s) => $s['category'] === $me['category']) : [];
        $flagships = array_filter($others, fn($s) => !empty($s['flagship']) && (!$me || $s['category'] !== $me['category']));
        $out = []; $seen = [];
        foreach (array_merge(array_values($siblings), array_values($flagships)) as $s) {
            if (isset($seen[$s['domain']])) continue;
            $seen[$s['domain']] = true;
            $out[] = $s;
            if (count($out) >= $limit) break;
        }
        if ($currentDomain !== 'lequel-choisir.com') {
            $promoted = null;
            foreach ($sites as $s) { if ($s['domain'] === 'lequel-choisir.com') { $promoted = $s; break; } }
            if ($promoted) {
                $out = array_values(array_filter($out, fn($s) => $s['domain'] !== 'lequel-choisir.com'));
                array_unshift($out, $promoted);
                $out = array_slice($out, 0, $limit);
            }
        }
        return $out;
    }
}

$__host = preg_replace('/^www\./', '', strtolower($_SERVER['HTTP_HOST'] ?? ''));
$__network = kipdev_network_links($__host, 6);
if (!empty($__network)):
?>
<section style="border-top:1px solid rgba(0,0,0,.08);margin-top:2.5rem;padding-top:2rem">
  <div style="max-width:1100px;margin:0 auto;padding:0 1.25rem">
    <div style="font-weight:600;margin-bottom:1rem;font-size:.95rem">Nos autres outils</div>
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
