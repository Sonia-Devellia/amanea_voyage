<?php
$pageTitle = 'Nouveau voyage — Administration';
require_once APP_ROOT . '/app/views/layouts/header.php';
$d = $data ?? [];

$months = [
    1 => 'Janvier', 2 => 'Février', 3 => 'Mars', 4 => 'Avril',
    5 => 'Mai', 6 => 'Juin', 7 => 'Juillet', 8 => 'Août',
    9 => 'Septembre', 10 => 'Octobre', 11 => 'Novembre', 12 => 'Décembre',
];
?>

<section class="section section--beige">
    <div class="container at-form-container">

        <div class="at-page-header">
            <h1 class="at-page-title">Nouveau voyage</h1>
            <a href="<?= APP_URL ?>/admin/travels" class="btn-outline">← Retour</a>
        </div>

        <?php if (!empty($error)) : ?>
            <p class="at-error"><?= htmlspecialchars($error) ?></p>
        <?php endif; ?>

        <form method="POST" action="<?= APP_URL ?>/admin/travels/store" class="at-form">

            <!-- Titre -->
            <div>
                <label class="at-label">
                    Titre <span class="at-label__required">*</span>
                </label>
                <input type="text" name="title" required
                       value="<?= htmlspecialchars($d['title'] ?? '') ?>"
                       class="at-input at-input--title">
            </div>

            <!-- Destination liée -->
            <div>
                <label class="at-label">
                    Destination liée
                    <span class="at-label__hint"> (facultatif)</span>
                </label>
                <select name="id_destination" class="at-select">
                    <option value="">— Aucune destination —</option>
                    <?php foreach ($destinations as $dest) : ?>
                        <option value="<?= $dest['Id_DESTINATION'] ?>"
                            <?= ($d['id_destination'] ?? null) == $dest['Id_DESTINATION'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($dest['name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Formule de voyage (TYPE) -->
            <div>
                <label class="at-label">
                    Formule de voyage
                    <span class="at-label__hint"> (En groupe, Au féminin, De noces, Sur mesure)</span>
                </label>
                <select name="id_type" class="at-select">
                    <option value="">— Aucune formule —</option>
                    <?php foreach ($types as $type) : ?>
                        <option value="<?= $type['Id_TYPE'] ?>"
                            <?= ($d['id_type'] ?? null) == $type['Id_TYPE'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($type['title']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <!-- Image de couverture (MEDIA) -->
            <div>
                <label class="at-label">
                    Image de couverture
                    <span class="at-label__hint"> (média du backoffice)</span>
                </label>
                <select name="id_media" class="at-select">
                    <option value="">— Aucune image —</option>
                    <?php foreach ($medias as $media) : ?>
                        <option value="<?= $media['Id_MEDIA'] ?>"
                            <?= ($d['id_media'] ?? null) == $media['Id_MEDIA'] ? 'selected' : '' ?>>
                            <?= htmlspecialchars($media['file_name']) ?>
                        </option>
                    <?php endforeach; ?>
                </select>
            </div>

            <hr class="at-divider">
            <p class="at-section-hint">Informations pratiques</p>

            <!-- Durée + Voyageurs -->
            <div class="at-grid-3">
                <div>
                    <label class="at-label">
                        Durée (jours)
                    </label>
                    <input type="number" name="duration_days" min="1" max="365"
                           value="<?= htmlspecialchars($d['duration_days'] ?? '') ?>"
                           class="at-input">
                </div>
                <div>
                    <label class="at-label">
                        Voyageurs min
                    </label>
                    <input type="number" name="min_persons" min="1" max="99"
                           value="<?= htmlspecialchars($d['min_persons'] ?? '') ?>"
                           class="at-input">
                </div>
                <div>
                    <label class="at-label">
                        Voyageurs max
                    </label>
                    <input type="number" name="max_persons" min="1" max="99"
                           value="<?= htmlspecialchars($d['max_persons'] ?? '') ?>"
                           class="at-input">
                </div>
            </div>

            <!-- Saison -->
            <div class="at-grid-3">
                <div>
                    <label class="at-label">Saison — mois de début</label>
                    <select name="season_start" class="at-select">
                        <option value="">—</option>
                        <?php foreach ($months as $num => $label) : ?>
                            <option value="<?= $num ?>" <?= ($d['season_start'] ?? null) == $num ? 'selected' : '' ?>>
                                <?= $label ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="at-label">Saison — mois de fin</label>
                    <select name="season_end" class="at-select">
                        <option value="">—</option>
                        <?php foreach ($months as $num => $label) : ?>
                            <option value="<?= $num ?>" <?= ($d['season_end'] ?? null) == $num ? 'selected' : '' ?>>
                                <?= $label ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div>
                    <label class="at-label">
                        Prix <span class="at-label__hint">(ex : 4 200 €)</span>
                    </label>
                    <input type="text" name="price"
                           value="<?= htmlspecialchars($d['price'] ?? '') ?>"
                           class="at-input">
                </div>
            </div>

            <hr class="at-divider">

            <!-- Description -->
            <div>
                <label class="at-label">Description</label>
                <textarea name="description" rows="3" class="at-textarea"><?= htmlspecialchars($d['description'] ?? '') ?></textarea>
            </div>

            <!-- Étapes de l'itinéraire -->
            <div>
                <label class="at-label">
                    Étapes de l'itinéraire
                    <span class="at-label__hint"> (une étape par ligne, format : Ville · Nuits — ex : Tokyo · 3)</span>
                </label>
                <textarea name="steps" rows="6"
                          placeholder="Tokyo · 3&#10;Hakone · 2&#10;Kyoto · 4"
                          class="at-textarea at-textarea--mono"><?= htmlspecialchars($d['steps_raw'] ?? '') ?></textarea>
            </div>

            <!-- Publié -->
            <div class="at-checkbox">
                <input type="checkbox" name="is_published" id="is_published" value="1"
                       <?= !isset($d['is_published']) || $d['is_published'] ? 'checked' : '' ?>>
                <label for="is_published">Publié — visible sur la page Voyages</label>
            </div>

            <div class="at-actions">
                <button type="submit" class="btn-primary">Créer le voyage</button>
            </div>

        </form>
    </div>
</section>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
