<?php
$pageTitle = 'Voyages — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<section class="section section--beige">
    <div class="container">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem;">
            <h1 style="font-family:var(--font-title,serif); font-size:2rem; font-weight:300;">Catalogue voyages</h1>
            <a href="<?= APP_URL ?>/admin/travels/new" class="btn-primary">+ Ajouter un voyage</a>
        </div>

        <?php if (empty($travels)) : ?>
            <p style="color:#888; font-family:var(--font-body,sans-serif);">Aucun voyage pour le moment.</p>
        <?php else : ?>
        <table style="width:100%; border-collapse:collapse; font-family:var(--font-body,sans-serif); font-size:0.9rem;">
            <thead>
                <tr style="border-bottom:2px solid #e0d6ce; text-align:left;">
                    <th style="padding:0.75rem 1rem;">Titre</th>
                    <th style="padding:0.75rem 1rem;">Destination</th>
                    <th style="padding:0.75rem 1rem;">Badge</th>
                    <th style="padding:0.75rem 1rem;">Durée</th>
                    <th style="padding:0.75rem 1rem;">Prix</th>
                    <th style="padding:0.75rem 1rem;">Statut</th>
                    <th style="padding:0.75rem 1rem;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($travels as $t) : ?>
                <tr style="border-bottom:1px solid #f0e9e2;">
                    <td style="padding:0.75rem 1rem; font-weight:500;"><?= htmlspecialchars($t['title']) ?></td>
                    <td style="padding:0.75rem 1rem; color:#888; font-size:0.85rem;">
                        <?= $t['destination_name'] ? htmlspecialchars($t['destination_name']) : '<span style="color:#ccc;">—</span>' ?>
                    </td>
                    <td style="padding:0.75rem 1rem;">
                        <?php if ($t['badge']) : ?>
                            <span style="padding:3px 10px; border-radius:20px; font-size:0.75rem; font-weight:500;
                                background:<?= htmlspecialchars($t['badge_color'] ?: '#C58A60') ?>;
                                color:<?= htmlspecialchars($t['badge_text'] ?: '#ffffff') ?>;">
                                <?= htmlspecialchars($t['badge']) ?>
                            </span>
                        <?php else : ?>
                            <span style="color:#ccc;">—</span>
                        <?php endif; ?>
                    </td>
                    <td style="padding:0.75rem 1rem; color:#888;"><?= $t['duration'] ? htmlspecialchars($t['duration']) : '—' ?></td>
                    <td style="padding:0.75rem 1rem; font-weight:500;"><?= $t['price'] ? htmlspecialchars($t['price']) : '—' ?></td>
                    <td style="padding:0.75rem 1rem;">
                        <?php if ($t['is_published']) : ?>
                            <span style="color:#28a745; font-size:0.8rem; font-weight:500;">Publié</span>
                        <?php else : ?>
                            <span style="color:#888; font-size:0.8rem;">Masqué</span>
                        <?php endif; ?>
                    </td>
                    <td style="padding:0.75rem 1rem;">
                        <div style="display:flex; gap:0.5rem;">
                            <a href="<?= APP_URL ?>/admin/travels/edit/<?= $t['Id_TRAVEL'] ?>"
                               class="btn-outline" style="font-size:0.8rem; padding:5px 14px;">Modifier</a>

                            <form method="POST" action="<?= APP_URL ?>/admin/travels/delete/<?= $t['Id_TRAVEL'] ?>"
                                  onsubmit="return confirm('Supprimer définitivement ce voyage ?')" style="display:inline;">
                                <button type="submit"
                                        style="font-size:0.8rem; padding:5px 14px; background:none; border:1.5px solid #dc3545; color:#dc3545; border-radius:4px; cursor:pointer;">
                                    Supprimer
                                </button>
                            </form>
                        </div>
                    </td>
                </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <?php endif; ?>

    </div>
</section>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
