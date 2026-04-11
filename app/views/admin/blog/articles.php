<?php
$pageTitle = 'Articles — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<section class="section section--beige">
    <div class="container">

        <div class="at-page-header">
            <h1 class="at-page-title">Mes articles</h1>
            <a href="<?= APP_URL ?>/admin/blog/new" class="btn-primary">+ Rédiger un article</a>
        </div>

        <?php if (empty($articles)) : ?>
            <p class="at-empty">Aucun article pour le moment.</p>
        <?php else : ?>
        <table class="at-table">
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Statut</th>
                    <th>Photo</th>
                    <th>Date</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article) : ?>
                <tr>
                    <td class="at-table__cell--title"><?= htmlspecialchars($article['title']) ?></td>
                    <td>
                        <span class="at-badge" style="background:<?= $article['status'] === 'publie' ? '#d4edda' : '#fff3cd' ?>; color:<?= $article['status'] === 'publie' ? '#155724' : '#856404' ?>;">
                            <?= $article['status'] === 'publie' ? 'Publié' : 'Brouillon' ?>
                        </span>
                    </td>
                    <td class="at-table__cell--muted">
                        <?php if (!empty($article['file_name'])) : ?>
                            <span class="at-source--media">Média backoffice</span>
                        <?php elseif (!empty($article['pexels_keyword'])) : ?>
                            Pexels : <em><?= htmlspecialchars($article['pexels_keyword']) ?></em>
                        <?php else : ?>
                            <span class="at-source--auto">Auto (catégorie)</span>
                        <?php endif; ?>
                    </td>
                    <td class="at-table__cell--muted">
                        <?= $article['publication_date'] ? date('d/m/Y', strtotime($article['publication_date'])) : '—' ?>
                    </td>
                    <td>
                        <div class="at-table__actions">
                            <a href="<?= APP_URL ?>/admin/blog/edit/<?= $article['Id_ARTICLE'] ?>" class="btn-outline">Modifier</a>

                            <?php if ($article['status'] !== 'publie') : ?>
                            <form method="POST" action="<?= APP_URL ?>/admin/blog/publish/<?= $article['Id_ARTICLE'] ?>" class="at-inline-form">
                                <button type="submit" class="btn-primary">Publier</button>
                            </form>
                            <?php endif; ?>

                            <form method="POST" action="<?= APP_URL ?>/admin/blog/delete/<?= $article['Id_ARTICLE'] ?>"
                                  onsubmit="return confirm('Supprimer définitivement cet article ?')" class="at-inline-form">
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
