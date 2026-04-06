<?php
$pageTitle = 'Rédiger un article — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
$d = $data ?? [];
?>

<section class="section section--beige">
    <div class="container" style="max-width:760px;">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem;">
            <h1 style="font-family:var(--font-title,serif); font-size:2rem; font-weight:300;">Rédiger un article</h1>
            <a href="<?= APP_URL ?>/admin/blog" class="btn-outline">← Retour</a>
        </div>

        <?php if (!empty($error)) : ?>
            <p style="color:#dc3545; margin-bottom:1.5rem; font-family:var(--font-body,sans-serif);">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="<?= APP_URL ?>/admin/blog/store"
              style="font-family:var(--font-body,sans-serif); display:flex; flex-direction:column; gap:1.5rem;">

            <!-- Titre -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Titre <span style="color:#dc3545;">*</span>
                </label>
                <input type="text" name="title" required
                       value="<?= htmlspecialchars($d['title'] ?? '') ?>"
                       style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:1rem; font-family:inherit;">
            </div>

            <!-- Slug -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Slug <span style="color:#dc3545;">*</span>
                    <span style="font-weight:400; color:#888;"> (ex : mon-article-de-voyage)</span>
                </label>
                <input type="text" name="slug" required
                       value="<?= htmlspecialchars($d['slug'] ?? '') ?>"
                       style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:monospace;">
            </div>

            <!-- Catégorie -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Catégorie</label>
                <select name="id_category"
                        style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                    <option value="">— Aucune catégorie —</option>
                    <?php foreach ($categories as $cat) : ?>
                    <option value="<?= $cat['Id_CATEGORY'] ?>"
                        <?= (($d['id_category'] ?? '') == $cat['Id_CATEGORY']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($cat['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Contenu -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Contenu <span style="color:#dc3545;">*</span>
                </label>
                <textarea name="content" required rows="12"
                          style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit; resize:vertical; line-height:1.6;"><?= htmlspecialchars($d['content'] ?? '') ?></textarea>
            </div>

            <!-- Photo de couverture -->
            <fieldset style="border:1.5px solid #d9cfc7; border-radius:8px; padding:1.25rem;">
                <legend style="font-size:0.85rem; font-weight:600; padding:0 0.5rem;">Photo de couverture</legend>

                <!-- Option 1 : Média backoffice -->
                <div style="margin-bottom:1rem;">
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.4rem; color:#4a3c32;">
                        Utiliser un média du backoffice
                    </label>
                    <select name="id_media"
                            style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                        <option value="">— Aucun média sélectionné —</option>
                        <?php foreach ($medias as $media) : ?>
                        <option value="<?= $media['Id_MEDIA'] ?>"
                            <?= (($d['id_media'] ?? '') == $media['Id_MEDIA']) ? 'selected' : '' ?>>
                            <?= htmlspecialchars($media['file_name']) ?>
                        </option>
                        <?php endforeach; ?>
                    </select>
                </div>

                <!-- Séparateur -->
                <div style="display:flex; align-items:center; gap:1rem; margin:1rem 0; color:#aaa; font-size:0.8rem;">
                    <hr style="flex:1; border:none; border-top:1px solid #e0d6ce;">
                    OU
                    <hr style="flex:1; border:none; border-top:1px solid #e0d6ce;">
                </div>

                <!-- Option 2 : Mot-clé Pexels -->
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:500; margin-bottom:0.4rem; color:#4a3c32;">
                        Mot-clé Pexels
                        <span style="font-weight:400; color:#888;"> (ex : Lisbonne, coucher de soleil, sac à dos)</span>
                    </label>
                    <input type="text" name="pexels_keyword"
                           value="<?= htmlspecialchars($d['pexels_keyword'] ?? '') ?>"
                           placeholder="Si vide : la catégorie + « voyage » sera utilisée automatiquement"
                           style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                    <p style="font-size:0.78rem; color:#aaa; margin-top:0.4rem;">
                        Ignoré si un média backoffice est sélectionné ci-dessus.
                    </p>
                </div>
            </fieldset>

            <!-- Destination (catégorie destination uniquement) -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Destination liée
                    <span style="font-weight:400; color:#888;"> (uniquement pour les articles Destination)</span>
                </label>
                <select name="id_destination"
                        style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                    <option value="">— Aucune destination —</option>
                    <?php foreach ($destinations as $dest) : ?>
                    <option value="<?= $dest['Id_DESTINATION'] ?>"
                        <?= (($d['id_destination'] ?? '') == $dest['Id_DESTINATION']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dest['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div style="display:flex; gap:1rem; justify-content:flex-end; padding-top:0.5rem;">
                <a href="<?= APP_URL ?>/admin/blog" class="btn-outline">Annuler</a>
                <button type="submit" class="btn-primary">Enregistrer en brouillon</button>
            </div>

        </form>
    </div>
</section>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
