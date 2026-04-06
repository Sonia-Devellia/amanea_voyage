<?php
$pageTitle = 'Articles — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<section class="section section--beige">
    <div class="container">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem;">
            <h1 style="font-family:var(--font-title,serif); font-size:2rem; font-weight:300;">Mes articles</h1>
            <a href="<?= APP_URL ?>/admin/blog/new" class="btn-primary">+ Rédiger un article</a>
        </div>

        <?php if (empty($articles)) : ?>
            <p style="color:#888; font-family:var(--font-body,sans-serif);">Aucun article pour le moment.</p>
        <?php else : ?>
        <table style="width:100%; border-collapse:collapse; font-family:var(--font-body,sans-serif); font-size:0.9rem;">
            <thead>
                <tr style="border-bottom:2px solid #e0d6ce; text-align:left;">
                    <th style="padding:0.75rem 1rem;">Titre</th>
                    <th style="padding:0.75rem 1rem;">Statut</th>
                    <th style="padding:0.75rem 1rem;">Photo</th>
                    <th style="padding:0.75rem 1rem;">Date</th>
                    <th style="padding:0.75rem 1rem;">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($articles as $article) : ?>
                <tr style="border-bottom:1px solid #f0e9e2;">
                    <td style="padding:0.75rem 1rem; font-weight:500;"><?= htmlspecialchars($article['title']) ?></td>
                    <td style="padding:0.75rem 1rem;">
                        <span style="padding:3px 12px; border-radius:20px; font-size:0.75rem; font-weight:500;
                            background:<?= $article['status'] === 'publie' ? '#d4edda' : '#fff3cd' ?>;
                            color:<?= $article['status'] === 'publie' ? '#155724' : '#856404' ?>;">
                            <?= $article['status'] === 'publie' ? 'Publié' : 'Brouillon' ?>
                        </span>
                    </td>
                    <td style="padding:0.75rem 1rem; color:#888; font-size:0.8rem;">
                        <?php if (!empty($article['file_name'])) : ?>
                            <span style="color:#2d6a4f;">Média backoffice</span>
                        <?php elseif (!empty($article['pexels_keyword'])) : ?>
                            Pexels : <em><?= htmlspecialchars($article['pexels_keyword']) ?></em>
                        <?php else : ?>
                            <span style="color:#aaa;">Auto (catégorie)</span>
                        <?php endif; ?>
                    </td>
                    <td style="padding:0.75rem 1rem; color:#888;">
                        <?= $article['publication_date'] ? date('d/m/Y', strtotime($article['publication_date'])) : '—' ?>
                    </td>
                    <td style="padding:0.75rem 1rem;">
                        <div style="display:flex; gap:0.5rem; flex-wrap:wrap;">
                            <a href="<?= APP_URL ?>/admin/blog/edit/<?= $article['Id_ARTICLE'] ?>"
                               class="btn-outline" style="font-size:0.8rem; padding:5px 14px;">Modifier</a>

                            <?php if ($article['status'] !== 'publie') : ?>
                            <form method="POST" action="<?= APP_URL ?>/admin/blog/publish/<?= $article['Id_ARTICLE'] ?>" style="display:inline;">
                                <button type="submit" class="btn-primary" style="font-size:0.8rem; padding:5px 14px;">Publier</button>
                            </form>
                            <?php endif; ?>

                            <form method="POST" action="<?= APP_URL ?>/admin/blog/delete/<?= $article['Id_ARTICLE'] ?>"
                                  onsubmit="return confirm('Supprimer définitivement cet article ?')" style="display:inline;">
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
