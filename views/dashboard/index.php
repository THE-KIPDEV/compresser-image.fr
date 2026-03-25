<section class="dashboard-section">
    <div class="container">
        <div class="dashboard-header">
            <div>
                <h1>Tableau de bord</h1>
                <p>Bienvenue, <?= e($user['email']) ?> <?php if (isPro()): ?><span class="badge-pro">PRO</span><?php endif; ?></p>
            </div>
            <a href="<?= url('/tableau-de-bord/compte') ?>" class="btn btn-ghost">Mon compte</a>
        </div>

        <!-- Stats -->
        <div class="stats-grid">
            <div class="stat-card">
                <div class="stat-value"><?= number_format($stats['total_compressions']) ?></div>
                <div class="stat-label">Compressions</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= formatSize($stats['total_original']) ?></div>
                <div class="stat-label">Volume traité</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= formatSize($stats['total_saved']) ?></div>
                <div class="stat-label">Espace économisé</div>
            </div>
            <div class="stat-card">
                <div class="stat-value"><?= $stats['total_original'] > 0 ? formatPercent($stats['total_original'], $stats['total_compressed']) : '0%' ?></div>
                <div class="stat-label">Réduction moyenne</div>
            </div>
        </div>

        <?php if (!isPro()): ?>
        <div class="upgrade-banner">
            <div>
                <h3>Passez en Pro</h3>
                <p>Méga compression serveur, batch de 100, fichiers jusqu'à 50 Mo.</p>
            </div>
            <a href="<?= url('/tarifs') ?>" class="btn btn-primary">4,90€/mois</a>
        </div>
        <?php endif; ?>

        <!-- Recent compressions -->
        <div class="recent-section">
            <h2>Compressions récentes</h2>
            <?php if (empty($recent)): ?>
                <div class="empty-state">
                    <p>Aucune compression pour le moment.</p>
                    <a href="<?= url('/') ?>" class="btn btn-primary">Compresser des images</a>
                </div>
            <?php else: ?>
                <div class="compressions-table">
                    <table>
                        <thead>
                            <tr>
                                <th>Fichier</th>
                                <th>Format</th>
                                <th>Original</th>
                                <th>Compressé</th>
                                <th>Réduction</th>
                                <th>Mode</th>
                                <th>Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($recent as $item): ?>
                            <tr>
                                <td class="td-filename"><?= e($item['original_name']) ?></td>
                                <td><span class="format-badge"><?= strtoupper(e($item['format'])) ?></span></td>
                                <td><?= formatSize($item['original_size']) ?></td>
                                <td><?= formatSize($item['compressed_size']) ?></td>
                                <td class="td-reduction"><?= formatPercent($item['original_size'], $item['compressed_size']) ?></td>
                                <td><?= $item['mega'] ? '<span class="badge-pro">MÉGA</span>' : 'Standard' ?></td>
                                <td><?= date('d/m/Y H:i', strtotime($item['created_at'])) ?></td>
                            </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>
