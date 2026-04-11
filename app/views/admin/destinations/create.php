<?php
$pageTitle = 'Nouvelle destination — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
$d = $data ?? [];
?>

<section class="section section--beige">
    <div class="container at-form-container">

        <div class="at-page-header">
            <h1 class="at-page-title">Nouvelle destination</h1>
            <a href="<?= APP_URL ?>/admin/destinations" class="btn-outline">← Retour</a>
        </div>

        <?php if (!empty($error)) : ?>
            <p class="at-error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="<?= APP_URL ?>/admin/destinations/store" class="at-form">

            <!-- Nom -->
            <div>
                <label class="at-label">
                    Nom <span class="at-label__required">*</span>
                </label>
                <input type="text" name="name" required
                       value="<?= htmlspecialchars($d['name'] ?? '') ?>"
                       class="at-input at-input--title">
            </div>

            <!-- Slug -->
            <div>
                <label class="at-label">
                    Slug <span class="at-label__required">*</span>
                    <span class="at-label__hint"> (ex : japon)</span>
                </label>
                <input type="text" name="slug" required
                       value="<?= htmlspecialchars($d['slug'] ?? '') ?>"
                       class="at-input at-input--mono">
            </div>

            <hr class="at-divider">
            <p class="at-section-hint">Champs visuels — affichés sur la page Voyages</p>

            <!-- Accroche -->
            <div>
                <label class="at-label">
                    Accroche
                    <span class="at-label__hint"> (titre poétique de la card, ex : "L'âme des cerisiers")</span>
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
                <label class="at-label">
                    Couleur du badge
                    <span class="at-label__hint"> (code hexadécimal, ex : #C58A60)</span>
                </label>
                <div class="at-color-picker">
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
                    <span class="at-label__hint"> (ex : japon-traditionnel.webp — déposé dans public/images/)</span>
                </label>
                <input type="text" name="cover_image"
                       value="<?= htmlspecialchars($d['cover_image'] ?? '') ?>"
                       class="at-input at-input--mono">
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
                       placeholder="ex : japan temple nature"
                       class="at-input at-input--mono">
            </div>

            <div class="at-actions">
                <button type="submit" class="btn-primary">Créer la destination</button>
            </div>

        </form>
    </div>
</section>

<script>
document.querySelector('[name=tag_color]').addEventListener('input', function() {
    document.getElementById('tag_color_text').value = this.value;
});
</script>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
