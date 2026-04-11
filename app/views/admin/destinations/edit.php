<?php
$pageTitle = 'Modifier une destination — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
$d = $destination;
?>

<section class="section section--beige">
    <div class="container at-form-container">

        <div class="at-page-header">
            <h1 class="at-page-title">
                Modifier — <?= htmlspecialchars($d['name']) ?>
            </h1>
            <a href="<?= APP_URL ?>/admin/destinations" class="btn-outline">← Retour</a>
        </div>

        <?php if (!empty($articlesCount)) : ?>
            <p class="at-info-notice">
                <?= $articlesCount ?> article<?= $articlesCount > 1 ? 's sont liés' : ' est lié' ?> à cette destination.
                La suppression sera bloquée tant qu'ils ne sont pas désassociés.
            </p>
        <?php endif; ?>

        <?php if (!empty($error)) : ?>
            <p class="at-error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="<?= APP_URL ?>/admin/destinations/update/<?= $d['Id_DESTINATION'] ?>" class="at-form">

            <!-- Nom -->
            <div>
                <label class="at-label">
                    Nom <span class="at-label__required">*</span>
                </label>
                <input type="text" name="name" required
                    value="<?= htmlspecialchars($d['name']) ?>"
                    class="at-input at-input--title">
            </div>

            <!-- Slug -->
            <div>
                <label class="at-label">
                    Slug <span class="at-label__required">*</span>
                </label>
                <input type="text" name="slug" required
                    value="<?= htmlspecialchars($d['slug']) ?>"
                    class="at-input at-input--mono">
            </div>

            <hr class="at-divider">
            <p class="at-section-hint">Champs visuels — affichés sur la page Voyages</p>

            <!-- Accroche -->
            <div>
                <label class="at-label">
                    Accroche
                    <span class="at-label__hint"> (titre poétique de la card)</span>
                </label>
                <input type="text" name="label"
                    value="<?= htmlspecialchars($d['label'] ?? '') ?>"
                    class="at-input">
            </div>

            <!-- Badge -->
            <div>
                <label class="at-label">
                    Badge
                    <span class="at-label__hint"> (ex : "Spiritualité & Nature")</span>
                </label>
                <input type="text" name="tag"
                    value="<?= htmlspecialchars($d['tag'] ?? '') ?>"
                    class="at-input">
            </div>

            <!-- Couleur du badge -->
            <div>
                <label for="tag_color" class="at-label">Couleur du tag</label>
                <select name="tag_color" id="tag_color" class="at-select">
                    <option value="">-- Choisir une couleur --</option>
                    <option value="#C58A60" <?= ($destination['tag_color'] === '#C58A60') ? 'selected' : '' ?>>Terracotta</option>
                    <option value="#9B6030" <?= ($destination['tag_color'] === '#9B6030') ? 'selected' : '' ?>>Terracotta foncé</option>
                    <option value="#FEF6ED" <?= ($destination['tag_color'] === '#FEF6ED') ? 'selected' : '' ?>>Beige clair</option>
                    <option value="#4A3C32" <?= ($destination['tag_color'] === '#4A3C32') ? 'selected' : '' ?>>Marron foncé</option>
                    <option value="#6C7E8F" <?= ($destination['tag_color'] === '#6C7E8F') ? 'selected' : '' ?>>Bleu-gris</option>
                    <option value="#A4B3A1" <?= ($destination['tag_color'] === '#A4B3A1') ? 'selected' : '' ?>>Vert sauge</option>
                    <option value="#C3998A" <?= ($destination['tag_color'] === '#C3998A') ? 'selected' : '' ?>>Rose/Brun</option>
                    <option value="#EADFC9" <?= ($destination['tag_color'] === '#EADFC9') ? 'selected' : '' ?>>Beige crème</option>
                </select>
                <span id="color-preview" class="at-color-preview"
                      style="background-color:<?= htmlspecialchars($destination['tag_color'] ?: '#ccc') ?>;"></span>

                <div class="at-color-picker at-color-picker--mt">
                    <input type="color" name="tag_color"
                        value="<?= htmlspecialchars($d['tag_color'] ?? '#A39E93') ?>"
                        class="at-color-input">
                    <input type="text" id="tag_color_text"
                        value="<?= htmlspecialchars($d['tag_color'] ?? '#A39E93') ?>"
                        maxlength="7" placeholder="#A39E93"
                        class="at-input at-input--mono"
                        oninput="document.querySelector('[name=tag_color]').value=this.value">
                </div>
            </div>

            <!-- Image -->
            <div>
                <label class="at-label">
                    Nom du fichier image
                    <span class="at-label__hint"> (déposé dans public/images/)</span>
                </label>
                <input type="text" name="cover_image"
                    value="<?= htmlspecialchars($d['cover_image'] ?? '') ?>"
                    class="at-input at-input--mono">
                <?php if (!empty($d['cover_image'])) : ?>
                    <img src="<?= APP_URL ?>/public/images/<?= htmlspecialchars($d['cover_image']) ?>"
                        alt="Aperçu"
                        class="at-img-preview"
                        onerror="this.style.display='none'">
                <?php endif; ?>
            </div>

            <!-- Destination phare -->
            <div class="at-checkbox">
                <input type="checkbox" name="is_featured" id="is_featured" value="1"
                       <?= !empty($d['is_featured']) ? 'checked' : '' ?>>
                <label for="is_featured">Destination phare — affichée sur la page Voyages</label>
            </div>

            <hr class="at-divider">

            <!-- Description -->
            <div>
                <label class="at-label">Description</label>
                <textarea name="description" rows="4" class="at-textarea"><?= htmlspecialchars($d['description'] ?? '') ?></textarea>
            </div>

            <!-- Mot-clé Pexels -->
            <div>
                <label class="at-label">
                    Mot-clé Pexels
                    <span class="at-label__hint"> (pour les articles liés à cette destination)</span>
                </label>
                <input type="text" name="pexels_keyword"
                    value="<?= htmlspecialchars($d['pexels_keyword'] ?? '') ?>"
                    class="at-input at-input--mono">
            </div>

            <div class="at-actions at-actions--between">
                <form method="POST" action="<?= APP_URL ?>/admin/destinations/delete/<?= $d['Id_DESTINATION'] ?>"
                    onsubmit="return confirm('Supprimer définitivement cette destination ?')" class="at-inline-form">
                    <button type="submit" class="btn-danger">Supprimer</button>
                </form>

                <button type="submit" class="btn-primary">Enregistrer les modifications</button>
            </div>

        </form>
    </div>
</section>

<script>
document.getElementById('tag_color').addEventListener('change', function() {
    document.getElementById('color-preview').style.backgroundColor = this.value;
});
document.querySelector('[name=tag_color]').addEventListener('input', function() {
    document.getElementById('tag_color_text').value = this.value;
});
</script>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
