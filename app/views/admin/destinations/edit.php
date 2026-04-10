<?php
$pageTitle = 'Modifier une destination — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
$d = $destination;
?>

<section class="section section--beige">
    <div class="container" style="max-width:760px;">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem;">
            <h1 style="font-family:var(--font-title,serif); font-size:2rem; font-weight:300;">
                Modifier — <?= htmlspecialchars($d['name']) ?>
            </h1>
            <a href="<?= APP_URL ?>/admin/destinations" class="btn-outline">← Retour</a>
        </div>

        <?php if (!empty($articlesCount)) : ?>
            <p style="font-size:0.85rem; color:#555; background:#fff8f0; border:1px solid #f0d8b8; border-radius:6px; padding:0.75rem 1rem; margin-bottom:1.5rem; font-family:var(--font-body,sans-serif);">
                <?= $articlesCount ?> article<?= $articlesCount > 1 ? 's sont liés' : ' est lié' ?> à cette destination.
                La suppression sera bloquée tant qu'ils ne sont pas désassociés.
            </p>
        <?php endif; ?>

        <?php if (!empty($error)) : ?>
            <p style="color:#dc3545; margin-bottom:1.5rem; font-family:var(--font-body,sans-serif);">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="<?= APP_URL ?>/admin/destinations/update/<?= $d['Id_DESTINATION'] ?>"
            style="font-family:var(--font-body,sans-serif); display:flex; flex-direction:column; gap:1.5rem;">

            <!-- Nom -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Nom <span style="color:#dc3545;">*</span>
                </label>
                <input type="text" name="name" required
                    value="<?= htmlspecialchars($d['name']) ?>"
                    style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:1rem; font-family:inherit;">
            </div>

            <!-- Slug -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Slug <span style="color:#dc3545;">*</span>
                </label>
                <input type="text" name="slug" required
                    value="<?= htmlspecialchars($d['slug']) ?>"
                    style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:monospace;">
            </div>

            <hr style="border:none; border-top:1px solid #e0d6ce;">
            <p style="font-size:0.85rem; color:#888; margin:0;">Champs visuels — affichés sur la page Voyages</p>

            <!-- Accroche (label) -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Accroche
                    <span style="font-weight:400; color:#888;"> (titre poétique de la card)</span>
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
                <!-- views/admin/destinations/edit.php -->
                <label for="tag_color">Couleur du tag</label>
                <select name="tag_color" id="tag_color">
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
                <!-- Aperçu live de la couleur -->
                <span id="color-preview" style="
                    display: inline-block;
                    width: 20px;
                    height: 20px;
                    border-radius: 4px;
                    margin-left: 8px;
                    vertical-align: middle;
                    background-color: <?= htmlspecialchars($destination['tag_color'] ?: '#ccc') ?>;
                "></span>

                <script>
                    document.getElementById('tag_color').addEventListener('change', function() {
                        document.getElementById('color-preview').style.backgroundColor = this.value;
                    });
                </script>
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
                    <span style="font-weight:400; color:#888;"> (déposé dans public/images/)</span>
                </label>
                <input type="text" name="cover_image"
                    value="<?= htmlspecialchars($d['cover_image'] ?? '') ?>"
                    style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:monospace;">
                <?php if (!empty($d['cover_image'])) : ?>
                    <img src="<?= APP_URL ?>/public/images/<?= htmlspecialchars($d['cover_image']) ?>"
                        alt="Aperçu"
                        style="margin-top:0.5rem; height:80px; border-radius:4px; object-fit:cover;"
                        onerror="this.style.display='none'">
                <?php endif; ?>
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
                    style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:monospace;">
            </div>

            <div style="display:flex; justify-content:space-between; align-items:center;">
                <form method="POST" action="<?= APP_URL ?>/admin/destinations/delete/<?= $d['Id_DESTINATION'] ?>"
                    onsubmit="return confirm('Supprimer définitivement cette destination ?')" style="display:inline;">
                    <button type="submit"
                        style="padding:10px 20px; background:none; border:1.5px solid #dc3545; color:#dc3545; border-radius:4px; cursor:pointer; font-family:inherit;">
                        Supprimer
                    </button>
                </form>

                <button type="submit" class="btn-primary">Enregistrer les modifications</button>
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