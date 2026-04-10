<?php
$pageTitle = 'Nouveau voyage — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
$d = $data ?? [];

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
            <h1 style="font-family:var(--font-title,serif); font-size:2rem; font-weight:300;">Nouveau voyage</h1>
            <a href="<?= APP_URL ?>/admin/travels" class="btn-outline">← Retour</a>
        </div>

        <?php if (!empty($error)) : ?>
            <p style="color:#dc3545; margin-bottom:1.5rem; font-family:var(--font-body,sans-serif);">
                <?= htmlspecialchars($error) ?>
            </p>
        <?php endif; ?>

        <form method="POST" action="<?= APP_URL ?>/admin/travels/store"
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

            <!-- Destination liée -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Destination liée
                    <span style="font-weight:400; color:#888;"> (facultatif — peut être ajoutée plus tard)</span>
                </label>
                <select name="id_destination"
                        style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                    <option value="">— Aucune destination —</option>
                    <?php foreach ($destinations as $dest) : ?>
                        <option value="<?= $dest['Id_DESTINATION'] ?>"
                            <?= ($d['id_destination'] ?? null) == $dest['Id_DESTINATION'] ? 'selected' : '' ?>>
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
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                        Libellé <span style="font-weight:400; color:#888;">(ex : En groupe)</span>
                    </label>
                    <input type="text" name="badge"
                           value="<?= htmlspecialchars($d['badge'] ?? '') ?>"
                           style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Couleur fond</label>
                    <select name="badge_color"
                            style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                        <?php foreach ($badge_colors as $hex => $label) : ?>
                            <option value="<?= $hex ?>" <?= ($d['badge_color'] ?? '#C58A60') === $hex ? 'selected' : '' ?>>
                                <?= $label ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Couleur texte</label>
                    <select name="badge_text"
                            style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                        <option value="#ffffff" <?= ($d['badge_text'] ?? '#ffffff') === '#ffffff' ? 'selected' : '' ?>>Blanc</option>
                        <option value="#4A3C32" <?= ($d['badge_text'] ?? '') === '#4A3C32' ? 'selected' : '' ?>>Marron foncé</option>
                    </select>
                </div>
            </div>

            <hr style="border:none; border-top:1px solid #e0d6ce;">
            <p style="font-size:0.85rem; color:#888; margin:0;">Informations pratiques</p>

            <!-- Infos pratiques -->
            <div style="display:grid; grid-template-columns:1fr 1fr 1fr; gap:1rem;">
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                        Durée <span style="font-weight:400; color:#888;">(ex : 14 jours)</span>
                    </label>
                    <input type="text" name="duration"
                           value="<?= htmlspecialchars($d['duration'] ?? '') ?>"
                           style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                        Voyageurs <span style="font-weight:400; color:#888;">(ex : Duo ou solo)</span>
                    </label>
                    <input type="text" name="persons"
                           value="<?= htmlspecialchars($d['persons'] ?? '') ?>"
                           style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                </div>
                <div>
                    <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                        Saison <span style="font-weight:400; color:#888;">(ex : Mars – Mai)</span>
                    </label>
                    <input type="text" name="season"
                           value="<?= htmlspecialchars($d['season'] ?? '') ?>"
                           style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
                </div>
            </div>

            <!-- Prix -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Prix <span style="font-weight:400; color:#888;">(ex : 4 200 €)</span>
                </label>
                <input type="text" name="price"
                       value="<?= htmlspecialchars($d['price'] ?? '') ?>"
                       style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:inherit;">
            </div>

            <!-- Image -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Nom du fichier image
                    <span style="font-weight:400; color:#888;"> (déposé dans public/images/, ex : japon.jpg)</span>
                </label>
                <input type="text" name="cover_image"
                       value="<?= htmlspecialchars($d['cover_image'] ?? '') ?>"
                       style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:monospace;">
            </div>

            <hr style="border:none; border-top:1px solid #e0d6ce;">

            <!-- Description -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">Description</label>
                <textarea name="description" rows="3"
                          style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.95rem; font-family:inherit; resize:vertical;"><?= htmlspecialchars($d['description'] ?? '') ?></textarea>
            </div>

            <!-- Étapes de l'itinéraire -->
            <div>
                <label style="display:block; font-size:0.85rem; font-weight:600; margin-bottom:0.4rem;">
                    Étapes de l'itinéraire
                    <span style="font-weight:400; color:#888;"> (une étape par ligne, ex : Tokyo · 3 nuits)</span>
                </label>
                <textarea name="steps" rows="6" placeholder="Tokyo · 3 nuits&#10;Hakone · 2 nuits&#10;Kyoto · 4 nuits"
                          style="width:100%; padding:10px 14px; border:1.5px solid #d9cfc7; border-radius:6px; font-size:0.9rem; font-family:monospace; resize:vertical;"><?= htmlspecialchars($d['steps_raw'] ?? '') ?></textarea>
            </div>

            <!-- Publié -->
            <div style="display:flex; align-items:center; gap:0.75rem;">
                <input type="checkbox" name="is_published" id="is_published" value="1"
                       <?= !isset($d['is_published']) || $d['is_published'] ? 'checked' : '' ?>
                       style="width:18px; height:18px; cursor:pointer;">
                <label for="is_published" style="font-size:0.9rem; cursor:pointer;">
                    Publié — visible sur la page Voyages
                </label>
            </div>

            <div style="display:flex; justify-content:flex-end;">
                <button type="submit" class="btn-primary">Créer le voyage</button>
            </div>

        </form>
    </div>
</section>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
