<?php
$pageTitle = 'Destinations — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<section class="section section--beige">
    <div class="container">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem;">
            <h1 style="font-family:var(--font-title,serif); font-size:2rem; font-weight:300;">Destinations</h1>
            <a href="<?= APP_URL ?>/admin/destinations/new" class="btn-primary">+ Ajouter une destination</a>
        </div>

        <?php if (empty($destinations)) : ?>
            <p style="color:#888; font-family:var(--font-body,sans-serif);">Aucune destination pour le moment.</p>
        <?php else : ?>
        <table style="width:100%; border-collapse:collapse; font-family:var(--font-body,sans-serif); font-size:0.9rem;">
            <thead>
                <tr style="border-bottom:2px solid #e0d6ce; text-align:left;">
                    <th style="padding:0.75rem 1rem;">Nom</th>
                    <th style="padding:0.75rem 1rem;">Accroche</th>
                    <th style="padding:0.75rem 1rem;">Badge</th>
                    <th style="padding:0.75rem 1rem;">Image</th>
                    <th style="padding:0.75rem 1rem;">Slug</th>
                    <th style="padding:0.75rem 1rem;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($destinations as $dest) : ?>
                <tr style="border-bottom:1px solid #f0e9e2;">
                    <td style="padding:0.75rem 1rem; font-weight:500;"><?= htmlspecialchars($dest['name']) ?></td>
                    <td style="padding:0.75rem 1rem; color:#888; font-size:0.85rem;">
                        <?= $dest['label'] ? htmlspecialchars($dest['label']) : '<span style="color:#ccc;">—</span>' ?>
                    </td>
                    <td style="padding:0.75rem 1rem;">
                        <?php if ($dest['tag']) : ?>
                            <span style="padding:3px 10px; border-radius:20px; font-size:0.75rem; font-weight:500;
                                background:<?= htmlspecialchars($dest['tag_color'] ?: '#A39E93') ?>; color:#fff;">
                                <?= htmlspecialchars($dest['tag']) ?>
                            </span>
                        <?php else : ?>
                            <span style="color:#ccc;">—</span>
                        <?php endif; ?>
                    </td>
                    <td style="padding:0.75rem 1rem; color:#888; font-size:0.85rem;">
                        <?= $dest['cover_image'] ? htmlspecialchars($dest['cover_image']) : '<span style="color:#ccc;">—</span>' ?>
                    </td>
                    <td style="padding:0.75rem 1rem; color:#888; font-size:0.85rem; font-style:italic;">
                        <?= htmlspecialchars($dest['slug']) ?>
                    </td>
                    <td style="padding:0.75rem 1rem;">
                        <div style="display:flex; gap:0.5rem;">
                            <a href="<?= APP_URL ?>/admin/destinations/edit/<?= $dest['Id_DESTINATION'] ?>"
                               class="btn-outline" style="font-size:0.8rem; padding:5px 14px;">Modifier</a>

                            <form method="POST" action="<?= APP_URL ?>/admin/destinations/delete/<?= $dest['Id_DESTINATION'] ?>"
                                  onsubmit="return confirm('Supprimer définitivement cette destination ?')" style="display:inline;">
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
