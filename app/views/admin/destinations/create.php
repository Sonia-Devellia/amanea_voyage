<?php
$pageTitle = 'Nouvelle destination — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
$d = $data ?? [];
?>

<section class="section section--beige">
    <div class="container" style="max-width:760px;">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem;">
            <h1 style="font-family:var(--font-title,serif); font-size:2rem; font-weight:300;">Nouvelle destination</h1>
            <a href="<?= APP_URL ?>/admin/destinations" class="btn-outline">← Retour</a>
        </div>

        <?php if (!empty($error)) : ?>
            <p style="color:#dc3545; margin-bottom:1.5rem; font-family:var(--font-body,sans-serif);">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="<?= APP_URL ?>/admin/destinations/store"
              style="font-family:var(--font-body,sans-serif); display:flex; flex-direction:column; gap:1.5rem;">

            <!-- Nom -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Nom <span style="color:#dc3545;">*</span>
                </label>
                <input type="text" name="name" required
                       value="<?= htmlspecialchars($d['name'] ?? '') ?>"
                       style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:1rem; font-family:inherit;">
            </div>

            <!-- Slug -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Slug <span style="color:#dc3545;">*</span>
                    <span style="font-weight:400; color:#888;"> (ex : japon)</span>
                </label>
                <input type="text" name="slug" required
                       value="<?= htmlspecialchars($d['slug'] ?? '') ?>"
                       style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:monospace;">
            </div>

            <hr style="border:none; border-top:1px solid #e0d6ce;">
            <p style="font-size:0.85rem; color:#888; margin:0;">Champs visuels — affichés sur la page Voyages</p>

            <!-- Accroche (label) -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Accroche
                    <span style="font-weight:400; color:#888;"> (titre poétique de la card, ex : "L'âme des cerisiers")</span>
                </label>
                <input type="text" name="label"
                       value="<?= htmlspecialchars($d['label'] ?? '') ?>"
                       style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.95rem; font-family:inherit;">
            </div>

            <!-- Badge (tag) -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Badge
                    <span style="font-weight:400; color:#888;"> (ex : "Spiritualité & Nature")</span>
                </label>
                <input type="text" name="tag"
                       value="<?= htmlspecialchars($d['tag'] ?? '') ?>"
                       style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.95rem; font-family:inherit;">
            </div>

            <!-- Couleur du badge -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Couleur du badge
                    <span style="font-weight:400; color:#888;"> (code hexadécimal, ex : #C58A60)</span>
                </label>
                <div style="display:flex; gap:0.75rem; align-items:center;">
                    <input type="color" name="tag_color"
                           value="<?= htmlspecialchars($d['tag_color'] ?? '#A39E93') ?>"
                           style="height:42px; width:60px; border:1.5px solid #d9cfc7; border-radius:6px; padding:2px; cursor:pointer;">
                    <input type="text" id="tag_color_text"
                           value="<?= htmlspecialchars($d['tag_color'] ?? '#A39E93') ?>"
                           maxlength="7" placeholder="#A39E93"
                           style="flex:1; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:monospace;"
                           oninput="document.querySelector('[name=tag_color]').value=this.value">
                </div>
            </div>

            <!-- Nom du fichier image -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Nom du fichier image
                    <span style="font-weight:400; color:#888;"> (ex : japon-traditionnel.jpg — déposé dans public/images/)</span>
                </label>
                <input type="text" name="cover_image"
                       value="<?= htmlspecialchars($d['cover_image'] ?? '') ?>"
                       style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:monospace;">
            </div>

            <hr style="border:none; border-top:1px solid #e0d6ce;">

            <!-- Description -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Description</label>
                <textarea name="description" rows="4"
                          style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.95rem; font-family:inherit; resize:vertical;"><?= htmlspecialchars($d['description'] ?? '') ?></textarea>
            </div>

            <!-- Mot-clé Pexels -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Mot-clé Pexels
                    <span style="font-weight:400; color:#888;"> (pour les articles liés à cette destination)</span>
                </label>
                <input type="text" name="pexels_keyword"
                       value="<?= htmlspecialchars($d['pexels_keyword'] ?? '') ?>"
                       placeholder="ex : japan temple nature"
                       style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:monospace;">
            </div>

            <div style="display:flex; justify-content:flex-end;">
                <button type="submit" class="btn-primary">Créer la destination</button>
            </div>

        </form>
    </div>
</section>

<script>
// Synchronise le champ texte hexadécimal avec le color picker
document.querySelector('[name=tag_color]').addEventListener('input', function() {
    document.getElementById('tag_color_text').value = this.value;
});
</script>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
