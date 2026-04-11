<?php
$pageTitle = 'Modifier l\'article — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
$a = $article ?? [];
?>

<section class="section section--beige">
    <div class="container at-form-container">

        <div class="at-page-header">
            <h1 class="at-page-title">Modifier l'article</h1>
            <a href="<?= APP_URL ?>/admin/blog" class="btn-outline">← Retour</a>
        </div>

        <?php if (!empty($error)) : ?>
            <p class="at-error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <!-- ── Formulaire principal ── -->
        <form method="POST" action="<?= APP_URL ?>/admin/blog/update/<?= $a['Id_ARTICLE'] ?>" class="at-form">

            <!-- Titre -->
            <div>
                <label class="at-label">
                    Titre <span class="at-label__required">*</span>
                </label>
                <input type="text" name="title" required
                       value="<?= htmlspecialchars($a['title'] ?? '') ?>"
                       class="at-input at-input--title">
            </div>

            <!-- Slug -->
            <div>
                <label class="at-label">
                    Slug <span class="at-label__required">*</span>
                </label>
                <input type="text" name="slug" required
                       value="<?= htmlspecialchars($a['slug'] ?? '') ?>"
                       class="at-input at-input--mono">
            </div>

            <!-- Contenu -->
            <div>
                <label class="at-label">
                    Contenu <span class="at-label__required">*</span>
                </label>
                <textarea name="content" required rows="12" class="at-textarea"><?= htmlspecialchars($a['content'] ?? '') ?></textarea>
            </div>

            <!-- Mot-clé Pexels -->
            <div>
                <label class="at-label">
                    Mot-clé Pexels
                    <span class="at-label__hint"> (utilisé si aucune couverture média n'est définie)</span>
                </label>
                <input type="text" name="pexels_keyword"
                       value="<?= htmlspecialchars($a['pexels_keyword'] ?? '') ?>"
                       placeholder="Si vide : la destination sera utilisée automatiquement"
                       class="at-input">
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
                        <?= (($a['Id_DESTINATION'] ?? '') == $dest['Id_DESTINATION']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($dest['name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <div class="at-actions at-actions--gap">
                <a href="<?= APP_URL ?>/admin/blog" class="btn-outline">Annuler</a>
                <button type="submit" class="btn-primary">Enregistrer les modifications</button>
            </div>

        </form>

        <!-- ── Médias — couverture & galerie ── -->
        <hr class="at-divider">
        <p class="at-section-hint">Médias liés à cet article</p>

        <?php if (!empty($cover)) : ?>
        <div class="at-fieldset__group">
            <p class="at-label">Couverture actuelle</p>
            <img src="<?= APP_URL ?>/public/images/<?= htmlspecialchars($cover['file_name']) ?>"
                 alt="Couverture"
                 class="at-img-preview">
            <p class="at-table__cell--muted"><?= htmlspecialchars($cover['file_name']) ?></p>
        </div>
        <?php endif; ?>

        <!-- Changer la couverture -->
        <form method="POST" action="<?= APP_URL ?>/admin/blog/cover/<?= $a['Id_ARTICLE'] ?>" class="at-form at-form--inline">
            <label class="at-label">Définir une nouvelle couverture</label>
            <div class="at-actions at-actions--gap">
                <select name="id_media" class="at-select" required>
                    <option value="">— Choisir un média —</option>
                    <?php foreach ($medias as $media) : ?>
                    <option value="<?= $media['Id_MEDIA'] ?>"
                        <?= (!empty($cover) && $cover['Id_MEDIA'] == $media['Id_MEDIA']) ? 'selected' : '' ?>>
                        <?= htmlspecialchars($media['file_name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn-primary">Définir comme couverture</button>
            </div>
        </form>

        <!-- Galerie existante -->
        <?php if (!empty($contents)) : ?>
        <div class="at-fieldset__group">
            <p class="at-label">Galerie de l'article</p>
            <table class="at-table">
                <thead>
                    <tr>
                        <th>Aperçu</th>
                        <th>Fichier</th>
                        <th>Couverture</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($contents as $m) : ?>
                    <tr>
                        <td>
                            <img src="<?= APP_URL ?>/public/images/<?= htmlspecialchars($m['file_name']) ?>"
                                 alt=""
                                 style="height:48px;width:auto;border-radius:4px;"
                                 onerror="this.style.display='none'">
                        </td>
                        <td class="at-table__cell--muted"><?= htmlspecialchars($m['file_name']) ?></td>
                        <td>
                            <?php if (!empty($cover) && $cover['Id_MEDIA'] == $m['Id_MEDIA']) : ?>
                                <span class="at-status--published">Oui</span>
                            <?php else : ?>
                                <span class="at-dash">—</span>
                            <?php endif; ?>
                        </td>
                        <td>
                            <form method="POST" action="<?= APP_URL ?>/admin/blog/remove-media/<?= $a['Id_ARTICLE'] ?>"
                                  onsubmit="return confirm('Retirer ce média de l\'article ?')"
                                  class="at-inline-form">
                                <input type="hidden" name="id_media" value="<?= $m['Id_MEDIA'] ?>">
                                <button type="submit" class="btn-danger btn-danger--sm">Retirer</button>
                            </form>
                        </td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
        <?php endif; ?>

        <!-- Ajouter un média à la galerie -->
        <form method="POST" action="<?= APP_URL ?>/admin/blog/add-media/<?= $a['Id_ARTICLE'] ?>" class="at-form at-form--inline">
            <label class="at-label">Ajouter un média à la galerie</label>
            <div class="at-actions at-actions--gap">
                <select name="id_media" class="at-select" required>
                    <option value="">— Choisir un média —</option>
                    <?php foreach ($medias as $media) : ?>
                    <option value="<?= $media['Id_MEDIA'] ?>">
                        <?= htmlspecialchars($media['file_name']) ?>
                    </option>
                    <?php endforeach; ?>
                </select>
                <button type="submit" class="btn-primary">Ajouter</button>
            </div>
        </form>

    </div>
</section>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
