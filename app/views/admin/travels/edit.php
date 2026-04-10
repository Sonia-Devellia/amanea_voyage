<?php
$pageTitle = 'Modifier un voyage — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
$t         = $travel;
$steps_raw = $steps_raw ?? '';

$badge_colors = [
    '#C58A60' => 'Terracotta',
    '#9B6030' => 'Terracotta foncé',
    '#4A3C32' => 'Marron foncé',
    '#6C7E8F' => 'Bleu-gris',
    '#A4B3A1' => 'Vert sauge',
    '#C3998A' => 'Rose/Brun',
    '#EADFC9' => 'Beige crème',
];
?>

<section class="section section--beige">
    <div class="container" style="max-width:760px;">

        <div style="display:flex; justify-content:space-between; align-items:center; margin-bottom:2rem;">
            <h1 style="font-family:var(--font-title,serif); font-size:2rem; font-weight:300;">
                Modifier — <?= htmlspecialchars($t['title']) ?>
            </h1>
            <a href="<?= APP_URL ?>/admin/travels" class="btn-outline">← Retour</a>
        </div>

        <?php if (!empty($error)) : ?>
            <p style="color:#dc3545; margin-bottom:1.5rem; font-family:var(--font-body,sans-serif);">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="<?= APP_URL ?>/admin/travels/update/<?= $t['Id_TRAVEL'] ?>"
              style="font-family:var(--font-body,sans-serif); display:flex; flex-direction:column; gap:1.5rem;">

            <!-- Titre -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Titre <span style="color:#dc3545;">*</span>
                </label>
                <input type="text" name="title" required
                       value="<?= htmlspecialchars($t['title']) ?>"
                       style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:1rem; font-family:inherit;">
            </div>

            <!-- Destination liée -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Destination liée
                    <span style="font-weight:400; color:#888;"> (facultatif)</span>
                </label>
                <select name="id_destination"
                        style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                    <option value="">— Aucune destination —</option>
                    <?php foreach ($destinations as $dest) : ?>
                        <option value="<?= $dest['Id_DESTINATION'] ?>"
                            <?= ($t['id_destination'] ?? null) == $dest['Id_DESTINATION'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dest['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <hr style="border:none; border-top:1px solid #e0d6ce;">
            <p style="font-size:0.85rem; color:#888; margin:0;">Badge — type de voyage</p>

            <!-- Badge -->
            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Libellé</label>
                    <input type="text" name="badge"
                           value="<?= htmlspecialchars($t['badge'] ?? '') ?>"
                           style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Couleur fond</label>
                    <select name="badge_color"
                            style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                        <?php foreach ($badge_colors as $hex => $label) : ?>
                            <option value="<?= $hex ?>" <?= ($t['badge_color'] ?? '#C58A60') === $hex ? 'selected' : '' ?>>
                                <?= $label ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Couleur texte</label>
                    <select name="badge_text"
                            style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                        <option value="#ffffff" <?= ($t['badge_text'] ?? '#ffffff') === '#ffffff' ? 'selected' : '' ?>>Blanc</option>
                        <option value="#4A3C32" <?= ($t['badge_text'] ?? '') === '#4A3C32' ? 'selected' : '' ?>>Marron foncé</option>
                    </select>
                </div>
            </div>

            <hr style="border:none; border-top:1px solid #e0d6ce;">
            <p style="font-size:0.85rem; color:#888; margin:0;">Informations pratiques</p>

            <!-- Infos pratiques -->
            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Durée</label>
                    <input type="text" name="duration"
                           value="<?= htmlspecialchars($t['duration'] ?? '') ?>"
                           style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Voyageurs</label>
                    <input type="text" name="persons"
                           value="<?= htmlspecialchars($t['persons'] ?? '') ?>"
                           style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Saison</label>
                    <input type="text" name="season"
                           value="<?= htmlspecialchars($t['season'] ?? '') ?>"
                           style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                </div>
            </div>

            <!-- Prix -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Prix</label>
                <input type="text" name="price"
                       value="<?= htmlspecialchars($t['price'] ?? '') ?>"
                       style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
            </div>

            <!-- Image -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Nom du fichier image
                    <span style="font-weight:400; color:#888;"> (déposé dans public/images/)</span>
                </label>
                <input type="text" name="cover_image"
                       value="<?= htmlspecialchars($t['cover_image'] ?? '') ?>"
                       style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:monospace;">
                <?php if (!empty($t['cover_image'])) : ?>
                    <img src="<?= APP_URL ?>/public/images/<?= htmlspecialchars($t['cover_image']) ?>"
                         alt="Aperçu"
                         style="margin-top:0.5rem; height:80px; border-radius:4px; object-fit:cover;"
                         onerror="this.style.display='none'">
                <?php endif; ?>
            </div>

            <hr style="border:none; border-top:1px solid #e0d6ce;">

            <!-- Description -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Description</label>
                <textarea name="description" rows="3"
                          style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.95rem; font-family:inherit; resize:vertical;"><?= htmlspecialchars($t['description'] ?? '') ?></textarea>
            </div>

            <!-- Étapes -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Étapes de l'itinéraire
                    <span style="font-weight:400; color:#888;"> (une étape par ligne)</span>
                </label>
                <textarea name="steps" rows="6"
                          style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:monospace; resize:vertical;"><?= htmlspecialchars($steps_raw) ?></textarea>
            </div>

            <!-- Publié -->
            <div style="display:flex; align-items:center; gap:0.75rem;">
                <input type="checkbox" name="is_published" id="is_published" value="1"
                       <?= $t['is_published'] ? 'checked' : '' ?>
                       style="width:18px; height:18px; cursor:pointer;">
                <label for="is_published" style="font-size:0.9rem; cursor:pointer;">
                    Publié — visible sur la page Voyages
                </label>
            </div>

            <div style="display:flex; justify-content:space-between; align-items:center;">
                <form method="POST" action="<?= APP_URL ?>/admin/travels/delete/<?= $t['Id_TRAVEL'] ?>"
                      onsubmit="return confirm('Supprimer définitivement ce voyage ?')" style="display:inline;">
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

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
