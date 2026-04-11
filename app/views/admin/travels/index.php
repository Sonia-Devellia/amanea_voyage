<?php
$pageTitle = 'Voyages — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<section class="section section--beige">
    <div class="container">

        <div class="at-page-header">
            <h1 class="at-page-title">Catalogue voyages</h1>
            <a href="<?= APP_URL ?>/admin/travels/new" class="btn-primary">+ Ajouter un voyage</a>
        </div>

        <?php if (empty($travels)) : ?>
            <p class="at-empty">Aucun voyage pour le moment.</p>
        <?php else : ?>
        <table class="at-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Destination</th>
                    <th>Formule</th>
                    <th>Durée</th>
                    <th>Prix</th>
                    <th>Statut</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($travels as $t) : ?>
                <tr>
                    <td class="at-table__cell--title"><?= htmlspecialchars($t['title']) ?></td>
                    <td class="at-table__cell--muted">
                        <?= $t['destination_name'] ? htmlspecialchars($t['destination_name']) : '<span class="at-dash">—</span>' ?>
                    </td>
                    <td class="at-table__cell--muted">
                        <?= $t['type_title'] ? htmlspecialchars($t['type_title']) : '<span class="at-dash">—</span>' ?>
                    </td>
                    <td><?= $t['duration_days'] ? htmlspecialchars($t['duration_days']) . ' j' : '<span class="at-dash">—</span>' ?></td>
                    <td class="at-table__cell--title"><?= $t['price'] ? htmlspecialchars($t['price']) : '<span class="at-dash">—</span>' ?></td>
                    <td>
                        <?php if ($t['is_published']) : ?>
                            <span class="at-status--published">Publié</span>
                        <?php else : ?>
                            <span class="at-status--hidden">Masqué</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <div class="at-table__actions">
                            <a href="<?= APP_URL ?>/admin/travels/edit/<?= $t['Id_TRAVEL'] ?>" class="btn-outline">Modifier</a>

                            <form method="POST" action="<?= APP_URL ?>/admin/travels/delete/<?= $t['Id_TRAVEL'] ?>"
                                  onsubmit="return confirm('Supprimer définitivement ce voyage ?')" class="at-inline-form">
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
