<?php
$pageTitle = 'Rédiger un article — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
$d = $data ?? [];
?>

<section class="section section--beige">
    <div class="container at-form-container">

        <div class="at-page-header">
            <h1 class="at-page-title">Rédiger un article</h1>
            <a href="<?= APP_URL ?>/admin/blog" class="btn-outline">← Retour</a>
        </div>

        <?php if (!empty($error)) : ?>
            <p class="at-error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="<?= APP_URL ?>/admin/blog/store" class="at-form">

            <!-- Titre -->
            <div>
                <label class="at-label">
                    Titre <span class="at-label__required">*</span>
                </label>
                <input type="text" name="title" required
                       value="<?= htmlspecialchars($d['title'] ?? '') ?>"
                       class="at-input at-input--title">
            </div>

            <!-- Slug -->
            <div>
                <label class="at-label">
                    Slug <span class="at-label__required">*</span>
                    <span class="at-label__hint"> (ex : mon-article-de-voyage)</span>
                </label>
                <input type="text" name="slug" required
                       value="<?= htmlspecialchars($d['slug'] ?? '') ?>"
                       class="at-input at-input--mono">
            </div>

            <!-- Contenu -->
            <div>
                <label class="at-label">
                    Contenu <span class="at-label__required">*</span>
                </label>
                <textarea name="content" required rows="12" class="at-textarea"><?= htmlspecialchars($d['content'] ?? '') ?></textarea>
            </div>

            <!-- Mot-clé Pexels (couverture assignable après création) -->
            <div>
                <label class="at-label">
                    Mot-clé Pexels
                    <span class="at-label__hint"> (ex : Lisbonne, coucher de soleil, sac à dos)</span>
                </label>
                <input type="text" name="pexels_keyword"
                       value="<?= htmlspecialchars($d['pexels_keyword'] ?? '') ?>"
                       placeholder="Si vide : la destination sera utilisée automatiquement"
                       class="at-input">
                <p class="at-hint">La couverture est assignée via la médiathèque après création de l'article.</p>
            </div>

            <!-- Destination -->
            <div>
                <label class="at-label">
                    Destination liée
                    <span class="at-label__hint"> (uniquement pour les articles Destination)</span>
                </label>
                <select name="id_destination" class="at-select">
                    <option value="">— Aucune destination —</option>
                    <?php foreach ($destinations as $dest) : ?>
                    <option value="<?= $dest['Id_DESTINATION'] ?>"
                        <?= (($d['id_destination'] ?? '') == $dest['Id_DESTINATION']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dest['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="at-actions at-actions--gap">
                <a href="<?= APP_URL ?>/admin/blog" class="btn-outline">Annuler</a>
                <button type="submit" class="btn-primary">Enregistrer en brouillon</button>
            </div>

        </form>
    </div>
</section>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
