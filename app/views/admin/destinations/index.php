<?php
$pageTitle = 'Destinations — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<section class="section section--beige">
    <div class="container">

        <div class="at-page-header">
            <h1 class="at-page-title">Destinations</h1>
            <a href="<?= APP_URL ?>/admin/destinations/new" class="btn-primary">+ Ajouter une destination</a>
        </div>

        <?php if (empty($destinations)) : ?>
            <p class="at-empty">Aucune destination pour le moment.</p>
        <?php else : ?>
        <table class="at-table">
            <thead>
                <tr>
                    <th>Nom</th>
                    <th>Accroche</th>
                    <th>Badge</th>
                    <th>Image</th>
                    <th>Slug</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($destinations as $dest) : ?>
                <tr>
                    <td class="at-table__cell--title"><?= htmlspecialchars($dest['name']) ?></td>
                    <td class="at-table__cell--muted">
                        <?= $dest['label'] ? htmlspecialchars($dest['label']) : '<span class="at-dash">—</span>' ?>
                    </td>
                    <td>
                        <?php if ($dest['tag']) : ?>
                            <span class="at-badge" style="background:<?= htmlspecialchars($dest['tag_color'] ?: '#A39E93') ?>; color:#fff;">
                                <?= htmlspecialchars($dest['tag']) ?>
                            </span>
                        <?php else : ?>
                            <span class="at-dash">—</span>
                        <?php endif; ?>
                    </td>
                    <td class="at-table__cell--muted">
                        <?= $dest['cover_image'] ? htmlspecialchars($dest['cover_image']) : '<span class="at-dash">—</span>' ?>
                    </td>
                    <td class="at-table__cell--slug">
                        <?= htmlspecialchars($dest['slug']) ?>
                    </td>
                    <td>
                        <div class="at-table__actions">
                            <a href="<?= APP_URL ?>/admin/destinations/edit/<?= $dest['Id_DESTINATION'] ?>" class="btn-outline">Modifier</a>

                            <form method="POST" action="<?= APP_URL ?>/admin/destinations/delete/<?= $dest['Id_DESTINATION'] ?>"
                                  onsubmit="return confirm('Supprimer définitivement cette destination ?')" class="at-inline-form">
                                <button type="submit" class="btn-danger btn-danger--sm">Supprimer</button>
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
