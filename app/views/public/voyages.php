<?php
$pageTitle       = 'Voyages & Expériences';
$metaDescription = 'Voyages en groupe, au féminin, de noces ou sur mesure — Amanéa Voyage compose pour vous un itinéraire unique. Découvrez les 4 formules de voyage créées par Habibi Nora.';
$ogImage         = APP_URL . '/public/images/voyages-hero.webp';
$headExtra       = '<link rel="preload" as="image" href="' . APP_URL . '/public/images/voyages-hero.webp" fetchpriority="high">';
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<!-- =====================================================
     HERO — 90vh
     ===================================================== -->

<section class="voyages-hero" aria-label="Présentation des formules de voyage Amanéa">

    <img src="<?= APP_URL ?>/public/images/voyages-hero.webp"
         alt="Paysage de voyage épuré — Voyages & Expériences Amanéa"
         class="voyages-hero__image"
         fetchpriority="high"
         decoding="async">

    <div class="voyages-hero__overlay" aria-hidden="true"></div>

    <div class="voyages-hero__content">
        <div class="container">

            <p class="voyages-hero__label">Votre voyage · Votre façon</p>

            <h1 class="voyages-hero__title">
                <span class="voyages-hero__title--white">Voyages &amp;</span>
                <span class="voyages-hero__title--terra">Expériences</span>
            </h1>

            <div class="divider" aria-hidden="true"></div>

            <p class="voyages-hero__subtitle">
                Quatre façons de voyager avec Amanéa — chacune pensée pour un moment de vie, une envie particulière, une façon d'être au monde.
            </p>

            <!-- Pills catégories -->
            <nav class="voyages-hero__pills" aria-label="Accès rapide aux formules">
                <a href="#cat-groupe"  class="voyages-pill">En groupe</a>
                <a href="#cat-feminin" class="voyages-pill">Au féminin</a>
                <a href="#cat-noces"   class="voyages-pill">De noces</a>
                <a href="#cat-mesure"  class="voyages-pill">Sur mesure</a>
            </nav>

        </div>
    </div>

</section>

<!-- =====================================================
     STICKY TABS NAV
     ===================================================== -->

<div class="voyages-tabs" id="voyagesTabs" role="tablist" aria-label="Formules de voyage">
    <div class="container">
        <div class="voyages-tabs__inner">
            <button class="voyages-tab voyages-tab--active" data-target="cat-groupe" role="tab" aria-selected="true">Voyages en groupe</button>
            <button class="voyages-tab" data-target="cat-feminin" role="tab" aria-selected="false">Voyages au féminin</button>
            <button class="voyages-tab" data-target="cat-noces" role="tab" aria-selected="false">Voyages de noces</button>
            <button class="voyages-tab" data-target="cat-mesure" role="tab" aria-selected="false">Voyages sur mesure</button>
        </div>
    </div>
</div>

<!-- =====================================================
     CATÉGORIE 1 — EN GROUPE
     ===================================================== -->

<section class="section section--beige voyages-cat" id="cat-groupe" aria-labelledby="title-groupe">
    <div class="container">
        <div class="voyages-cat__grid">

            <div class="voyages-cat__image-wrap">
                <div class="voyages-cat__image-frame">
                    <img src="<?= APP_URL ?>/public/images/voyage-groupe.webp"
                         alt="Groupe d'amis en aventure — voyage en groupe Amanéa"
                         class="voyages-cat__image"
                         loading="lazy"
                         decoding="async">
                    <div class="voyages-cat__mood-tag" aria-hidden="true">Aventure · Culture · Rencontres</div>
                </div>
                <div class="voyages-cat__badge" style="background-color:#A4B3A1; color:#4A3C32;">En groupe</div>
            </div>

            <div class="voyages-cat__text">
                <p class="label">L'aventure partagée</p>
                <h2 class="voyages-cat__title" id="title-groupe">Voyages en groupe</h2>
                <div class="divider" style="background-color:#A4B3A1;" aria-hidden="true"></div>
                <p class="voyages-cat__body">
                    Voyager en groupe, c'est multiplier les émotions. Amanéa compose des groupes soudés autour de valeurs communes : curiosité, bienveillance, ouverture au monde. Chaque départ réunit entre 8 et 12 voyageurs sélectionnés avec soin pour une dynamique humaine irremplaçable.
                </p>

                <div class="voyages-cat__details">
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>8 à 12 voyageurs max</span></div>
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Destinations nouvelles chaque saison</span></div>
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Hébergements authentiques &amp; locaux</span></div>
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Départs fixes — calendrier annuel</span></div>
                </div>

                <div class="voyages-cat__accordion">
                    <button class="voyages-cat__accordion-btn" aria-expanded="false" aria-controls="included-groupe">
                        <span>Ce qui est inclus</span>
                        <span class="voyages-cat__accordion-icon" style="color:#A4B3A1;" aria-hidden="true">+</span>
                    </button>
                    <ul class="voyages-cat__included" id="included-groupe">
                        <li><div class="voyages-cat__dot" style="background-color:#A4B3A1;" aria-hidden="true"></div><span>Guide local dédié</span></li>
                        <li><div class="voyages-cat__dot" style="background-color:#A4B3A1;" aria-hidden="true"></div><span>Transport privé</span></li>
                        <li><div class="voyages-cat__dot" style="background-color:#A4B3A1;" aria-hidden="true"></div><span>Hébergement sélectionné</span></li>
                        <li><div class="voyages-cat__dot" style="background-color:#A4B3A1;" aria-hidden="true"></div><span>Activités &amp; visites</span></li>
                        <li><div class="voyages-cat__dot" style="background-color:#A4B3A1;" aria-hidden="true"></div><span>Support 24h/24</span></li>
                    </ul>
                </div>

                <div class="voyages-cat__footer">
                    <div class="voyages-cat__price">
                        <span class="voyages-cat__price-label">Tarif</span>
                        <span class="voyages-cat__price-value">Variable en fonction de la destination / pers.</span>
                    </div>
                    <a href="<?= APP_URL ?>/contact" class="btn-primary" style="background-color:#A4B3A1; color:#4A3C32;">Créer mon voyage</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     CATÉGORIE 2 — AU FÉMININ
     ===================================================== -->

<section class="section section--white voyages-cat" id="cat-feminin" aria-labelledby="title-feminin">
    <div class="container">
        <div class="voyages-cat__grid voyages-cat__grid--reverse">

            <div class="voyages-cat__image-wrap">
                <div class="voyages-cat__image-frame">
                    <img src="<?= APP_URL ?>/public/images/voyage-feminin.webp"
                         alt="Femmes riant sur une terrasse méditerranéenne — voyage au féminin Amanéa"
                         class="voyages-cat__image"
                         loading="lazy"
                         decoding="async">
                    <div class="voyages-cat__mood-tag" aria-hidden="true">Bien-être · Sororité · Liberté</div>
                </div>
                <div class="voyages-cat__badge voyages-cat__badge--left" style="background-color:#C3998A; color:#ffffff;">Au féminin</div>
            </div>

            <div class="voyages-cat__text">
                <p class="label">Entre sœurs, sans compromis</p>
                <h2 class="voyages-cat__title" id="title-feminin">Voyages au féminin</h2>
                <div class="divider" style="background-color:#C3998A;" aria-hidden="true"></div>
                <p class="voyages-cat__body">
                    Des escapades pensées par une femme, pour les femmes. Que vous voyagiez en duo, entre amies ou en solo, Amanéa crée un espace de liberté et de bienveillance. Bien-être, culture, découverte de soi — chaque voyage au féminin est une parenthèse précieuse.
                </p>

                <div class="voyages-cat__details">
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Groupes exclusivement féminins</span></div>
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Bien-être intégré à l'itinéraire</span></div>
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Rencontres avec femmes entrepreneures locales</span></div>
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Destinations safe &amp; accompagnées</span></div>
                </div>

                <div class="voyages-cat__accordion">
                    <button class="voyages-cat__accordion-btn" aria-expanded="false" aria-controls="included-feminin">
                        <span>Ce qui est inclus</span>
                        <span class="voyages-cat__accordion-icon" style="color:#C3998A;" aria-hidden="true">+</span>
                    </button>
                    <ul class="voyages-cat__included" id="included-feminin">
                        <li><div class="voyages-cat__dot" style="background-color:#C3998A;" aria-hidden="true"></div><span>Hébergements triés sur le volet</span></li>
                        <li><div class="voyages-cat__dot" style="background-color:#C3998A;" aria-hidden="true"></div><span>Ateliers bien-être</span></li>
                        <li><div class="voyages-cat__dot" style="background-color:#C3998A;" aria-hidden="true"></div><span>Rencontres authentiques</span></li>
                        <li><div class="voyages-cat__dot" style="background-color:#C3998A;" aria-hidden="true"></div><span>Repas gastronomiques locaux</span></li>
                        <li><div class="voyages-cat__dot" style="background-color:#C3998A;" aria-hidden="true"></div><span>Carnet de voyage numérique</span></li>
                    </ul>
                </div>

                <div class="voyages-cat__footer">
                    <div class="voyages-cat__price">
                        <span class="voyages-cat__price-label">Tarif</span>
                        <span class="voyages-cat__price-value">Variable en fonction de la destination / pers.</span>
                    </div>
                    <a href="<?= APP_URL ?>/contact" class="btn-primary" style="background-color:#C3998A;">Créer mon voyage</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     CATÉGORIE 3 — DE NOCES
     ===================================================== -->

<section class="section section--beige voyages-cat" id="cat-noces" aria-labelledby="title-noces">
    <div class="container">
        <div class="voyages-cat__grid">

            <div class="voyages-cat__image-wrap">
                <div class="voyages-cat__image-frame">
                    <img src="<?= APP_URL ?>/public/images/voyage-noces.webp"
                         alt="Couple romantique au coucher du soleil — voyage de noces Amanéa"
                         class="voyages-cat__image"
                         loading="lazy"
                         decoding="async">
                    <div class="voyages-cat__mood-tag" aria-hidden="true">Romance · Intimité · Magie</div>
                </div>
                <div class="voyages-cat__badge" style="background-color:#EADFC9; color:#4A3C32;">De noces</div>
            </div>

            <div class="voyages-cat__text">
                <p class="label">Le voyage de votre vie</p>
                <h2 class="voyages-cat__title" id="title-noces">Voyages de noces</h2>
                <div class="divider" aria-hidden="true"></div>
                <p class="voyages-cat__body">
                    Votre lune de miel mérite une attention absolue. Nora crée pour vous deux un voyage sur mesure qui dépasse vos attentes — villas privées, tables étoilées, expériences secrètes. Chaque instant est pensé pour marquer le début de votre vie à deux avec une intensité rare.
                </p>

                <div class="voyages-cat__details">
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Conciergerie dédiée aux mariés</span></div>
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Surprises romantiques à chaque étape</span></div>
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Villas &amp; suites haut de gamme</span></div>
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Transferts premium &amp; vols sélectionnés</span></div>
                </div>

                <div class="voyages-cat__accordion">
                    <button class="voyages-cat__accordion-btn" aria-expanded="false" aria-controls="included-noces">
                        <span>Ce qui est inclus</span>
                        <span class="voyages-cat__accordion-icon" aria-hidden="true">+</span>
                    </button>
                    <ul class="voyages-cat__included" id="included-noces">
                        <li><div class="voyages-cat__dot" aria-hidden="true"></div><span>Villa ou suite privée</span></li>
                        <li><div class="voyages-cat__dot" aria-hidden="true"></div><span>Dîner romantique privé</span></li>
                        <li><div class="voyages-cat__dot" aria-hidden="true"></div><span>Spa &amp; soins en duo</span></li>
                        <li><div class="voyages-cat__dot" aria-hidden="true"></div><span>Excursions exclusives</span></li>
                        <li><div class="voyages-cat__dot" aria-hidden="true"></div><span>Assistance 24h/24</span></li>
                    </ul>
                </div>

                <div class="voyages-cat__footer">
                    <div class="voyages-cat__price">
                        <span class="voyages-cat__price-label">Tarif</span>
                        <span class="voyages-cat__price-value">Sur devis — budget adapté à vos rêves</span>
                    </div>
                    <a href="<?= APP_URL ?>/contact" class="btn-primary">Créer mon voyage</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     CATÉGORIE 4 — SUR MESURE
     ===================================================== -->

<section class="section section--white voyages-cat" id="cat-mesure" aria-labelledby="title-mesure">
    <div class="container">
        <div class="voyages-cat__grid voyages-cat__grid--reverse">

            <div class="voyages-cat__image-wrap">
                <div class="voyages-cat__image-frame">
                    <img src="<?= APP_URL ?>/public/images/voyage-personnalise.webp"
                         alt="Voyageur face à un paysage authentique — voyage sur mesure Amanéa"
                         class="voyages-cat__image"
                         loading="lazy"
                         decoding="async">
                    <div class="voyages-cat__mood-tag" aria-hidden="true">Liberté · Authenticité · Excellence</div>
                </div>
                <div class="voyages-cat__badge voyages-cat__badge--left" style="background-color:#C58A60; color:#ffffff;">Sur mesure</div>
            </div>

            <div class="voyages-cat__text">
                <p class="label">Votre voyage, votre règle</p>
                <h2 class="voyages-cat__title" id="title-mesure">Voyages sur mesure</h2>
                <div class="divider" aria-hidden="true"></div>
                <p class="voyages-cat__body">
                    Famille, duo, solo ou groupe d'amis — le voyage sur mesure est la forme la plus pure du voyage avec Amanéa. Vous choisissez tout : le rythme, le niveau de confort, les escales, les expériences. Nora construit votre itinéraire de A à Z, avec une liberté totale et une expertise incomparable.
                </p>

                <div class="voyages-cat__details">
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Itinéraire 100% unique et personnalisé</span></div>
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Durée : de 5 à 30 jours</span></div>
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Toutes destinations, tous continents</span></div>
                    <div class="voyages-cat__detail"><div class="voyages-cat__dot" aria-hidden="true"></div><span>Solo, duo, famille, amis</span></div>
                </div>

                <div class="voyages-cat__accordion">
                    <button class="voyages-cat__accordion-btn" aria-expanded="false" aria-controls="included-mesure">
                        <span>Ce qui est inclus</span>
                        <span class="voyages-cat__accordion-icon" aria-hidden="true">+</span>
                    </button>
                    <ul class="voyages-cat__included" id="included-mesure">
                        <li><div class="voyages-cat__dot" aria-hidden="true"></div><span>Consultation approfondie</span></li>
                        <li><div class="voyages-cat__dot" aria-hidden="true"></div><span>Proposition détaillée</span></li>
                        <li><div class="voyages-cat__dot" aria-hidden="true"></div><span>Réservations complètes</span></li>
                        <li><div class="voyages-cat__dot" aria-hidden="true"></div><span>Carnet de voyage</span></li>
                        <li><div class="voyages-cat__dot" aria-hidden="true"></div><span>Assistance dédiée</span></li>
                    </ul>
                </div>

                <div class="voyages-cat__footer">
                    <div class="voyages-cat__price">
                        <span class="voyages-cat__price-label">Tarif</span>
                        <span class="voyages-cat__price-value">Sur devis — budget libre &amp; personnalisé</span>
                    </div>
                    <a href="<?= APP_URL ?>/contact" class="btn-primary">Créer mon voyage →</a>
                </div>
            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     DESTINATIONS PHARES
     ===================================================== -->

<section class="section section--dark" aria-labelledby="title-destinations">
    <div class="container">

        <div class="section-header">
            <p class="section-header__label" style="color:#A39E93;">Nos terrains de jeu</p>
            <h2 class="voyages-destinations__title" id="title-destinations">Destinations phares</h2>
            <p class="voyages-destinations__subtitle">
                Des destinations choisies pour leur richesse humaine, culturelle et naturelle. Amanéa les connaît intimement.
            </p>
        </div>

        <div class="grid-3">
            <?php foreach ($destinations as $dest) : ?>
            <?php if (empty($dest['cover_image'])) continue; ?>
            <article class="voyages-dest-card">
                <img src="<?= APP_URL ?>/public/images/<?= htmlspecialchars($dest['cover_image']) ?>"
                     alt="<?= htmlspecialchars($dest['name']) ?> — destination voyage Amanéa"
                     class="voyages-dest-card__image"
                     loading="lazy"
                     decoding="async">
                <div class="voyages-dest-card__overlay" aria-hidden="true"></div>
                <div class="voyages-dest-card__content">
                    <?php if (!empty($dest['tag'])) : ?>
                    <span class="voyages-dest-card__tag" style="background-color:<?= htmlspecialchars($dest['tag_color'] ?: '#A39E93') ?>">
                        <?= htmlspecialchars($dest['tag']) ?>
                    </span>
                    <?php endif; ?>
                    <p class="voyages-dest-card__country"><?= htmlspecialchars($dest['name']) ?></p>
                    <h3 class="voyages-dest-card__name"><?= htmlspecialchars($dest['label'] ?: $dest['name']) ?></h3>
                    <span class="voyages-dest-card__link" aria-hidden="true">Découvrir →</span>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- =====================================================
     EXEMPLES D'ITINÉRAIRES
     ===================================================== -->

<section class="section section--beige" aria-labelledby="title-itineraires">
    <div class="container">

        <div class="voyages-itineraires__header">
            <div>
                <p class="label">Exemples concrets</p>
                <h2 class="voyages-itineraires__title" id="title-itineraires">Idées d'itinéraires</h2>
            </div>
            <p class="voyages-itineraires__subtitle">
                Ces voyages vous inspirent ? Nora peut les adapter entièrement à vos envies.
            </p>
        </div>

        <?php
        // Helpers pour afficher durée, personnes, saison à partir des champs numériques
        $monthNames = ['Jan','Fév','Mar','Avr','Mai','Juin','Juil','Août','Sep','Oct','Nov','Déc'];
        ?>
        <div class="grid-3">
            <?php foreach ($travels as $iti) : ?>
            <?php
                $durationLabel = $iti['duration_days'] ? $iti['duration_days'] . ' jours' : null;
                $personsLabel  = null;
                if ($iti['min_persons'] && $iti['max_persons']) {
                    $personsLabel = $iti['min_persons'] === $iti['max_persons']
                        ? $iti['min_persons'] . ' pers.'
                        : $iti['min_persons'] . '–' . $iti['max_persons'] . ' pers.';
                } elseif ($iti['min_persons']) {
                    $personsLabel = 'Dès ' . $iti['min_persons'] . ' pers.';
                }
                $seasonLabel = null;
                if ($iti['season_start'] && $iti['season_end']) {
                    $seasonLabel = $monthNames[$iti['season_start'] - 1] . ' – ' . $monthNames[$iti['season_end'] - 1];
                }
            ?>
            <article class="voyages-iti-card">
                <div class="voyages-iti-card__image-wrap">
                    <?php if (!empty($iti['file_name'])) : ?>
                    <img src="<?= APP_URL ?>/public/images/<?= htmlspecialchars($iti['file_name']) ?>"
                         alt="<?= htmlspecialchars($iti['title']) ?> — itinéraire Amanéa Voyage"
                         class="voyages-iti-card__image"
                         loading="lazy"
                         decoding="async">
                    <?php endif; ?>
                    <div class="voyages-iti-card__overlay" aria-hidden="true"></div>
                    <?php if (!empty($iti['type_title'])) : ?>
                    <span class="voyages-iti-card__badge">
                        <?= htmlspecialchars($iti['type_title']) ?>
                    </span>
                    <?php endif; ?>
                </div>

                <div class="voyages-iti-card__content">
                    <div class="voyages-iti-card__meta">
                        <?php if ($durationLabel) : ?><span><?= htmlspecialchars($durationLabel) ?></span><?php endif; ?>
                        <?php if ($personsLabel)  : ?><span><?= htmlspecialchars($personsLabel)  ?></span><?php endif; ?>
                        <?php if ($seasonLabel)   : ?><span><?= htmlspecialchars($seasonLabel)   ?></span><?php endif; ?>
                    </div>

                    <h3 class="voyages-iti-card__title"><?= htmlspecialchars($iti['title']) ?></h3>
                    <?php if ($iti['description']) : ?>
                    <p class="voyages-iti-card__desc"><?= htmlspecialchars($iti['description']) ?></p>
                    <?php endif; ?>

                    <?php if (!empty($iti['steps'])) : ?>
                    <div class="voyages-iti-card__accordion">
                        <button class="voyages-iti-card__accordion-btn" aria-expanded="false" aria-controls="steps-<?= $iti['Id_TRAVEL'] ?>">
                            <span>Voir l'itinéraire</span>
                            <span class="voyages-iti-card__accordion-arrow" aria-hidden="true">↓</span>
                        </button>
                        <ol class="voyages-iti-card__steps" id="steps-<?= $iti['Id_TRAVEL'] ?>">
                            <?php foreach ($iti['steps'] as $j => $step) : ?>
                            <li class="voyages-iti-card__step">
                                <div class="voyages-iti-card__step-num" aria-hidden="true"><?= $j + 1 ?></div>
                                <span><?= htmlspecialchars($step['city']) ?><?= $step['nights'] ? ' · ' . $step['nights'] . ' nuits' : '' ?></span>
                            </li>
                            <?php endforeach; ?>
                        </ol>
                    </div>
                    <?php endif; ?>

                    <div class="voyages-iti-card__footer">
                        <div class="voyages-iti-card__price">
                            <span class="voyages-iti-card__price-label">À partir de</span>
                            <span class="voyages-iti-card__price-value"><?= $iti['price'] ? number_format((float)$iti['price'], 0, ',', ' ') . ' €' : '—' ?> <em>/ pers.</em></span>
                        </div>
                        <a href="<?= APP_URL ?>/contact" class="btn-primary btn-sm">Voyagez</a>
                    </div>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
    </div>
</section>

<!-- =====================================================
     CTA FINAL
     ===================================================== -->

<section class="section section--white voyages-cta-section">
    <div class="container">
        <div class="voyages-cta">
            <p class="label">Et maintenant ?</p>
            <h2 class="voyages-cta__title">
                Votre voyage rêvé
                <span class="voyages-cta__title--italic">prend forme ici.</span>
            </h2>
            <div class="divider divider--center" aria-hidden="true"></div>
            <p class="voyages-cta__text">
                Un appel découverte gratuit de 30 minutes avec Nora pour transformer vos envies en itinéraire d'exception.
            </p>
            <div class="voyages-cta__buttons">
                <a href="<?= APP_URL ?>/contact" class="btn-primary btn-lg">Planifions votre voyage</a>
                <a href="<?= APP_URL ?>/a-propos" class="btn-outline btn-lg">Notre histoire</a>
            </div>
        </div>
    </div>
</section>

<!-- Schema.org JSON-LD — CollectionPage + 4 services voyages -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "CollectionPage",
            "name": "Voyages & Expériences — Amanéa Voyage",
            "description": "Voyages en groupe, au féminin, de noces ou sur mesure — Amanéa Voyage compose pour vous un itinéraire unique créé par Habibi Nora.",
            "url": "<?= APP_URL ?>/voyages",
            "image": "<?= APP_URL ?>/public/images/voyages-hero.webp",
            "inLanguage": "fr-FR",
            "isPartOf": {
                "@type": "WebSite",
                "name": "Amanéa Voyage",
                "url": "<?= APP_URL ?>"
            },
            "breadcrumb": {
                "@type": "BreadcrumbList",
                "itemListElement": [
                    { "@type": "ListItem", "position": 1, "name": "Accueil", "item": "<?= APP_URL ?>/home" },
                    { "@type": "ListItem", "position": 2, "name": "Voyages & Expériences", "item": "<?= APP_URL ?>/voyages" }
                ]
            }
        },
        {
            "@type": "ItemList",
            "name": "Formules de voyage Amanéa",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "item": {
                        "@type": "TouristTrip",
                        "name": "Voyages en groupe",
                        "description": "Voyages en groupe de 8 à 12 personnes, composés autour de valeurs communes : curiosité, bienveillance, ouverture au monde.",
                        "provider": { "@type": "TravelAgency", "name": "Amanéa Voyage", "url": "<?= APP_URL ?>" }
                    }
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "item": {
                        "@type": "TouristTrip",
                        "name": "Voyages au féminin",
                        "description": "Escapades pensées par une femme pour les femmes — bien-être, culture et découverte de soi en groupes exclusivement féminins.",
                        "provider": { "@type": "TravelAgency", "name": "Amanéa Voyage", "url": "<?= APP_URL ?>" }
                    }
                },
                {
                    "@type": "ListItem",
                    "position": 3,
                    "item": {
                        "@type": "TouristTrip",
                        "name": "Voyages de noces",
                        "description": "Lune de miel sur mesure avec villas privées, tables étoilées et expériences exclusives pour marquer le début de votre vie à deux.",
                        "provider": { "@type": "TravelAgency", "name": "Amanéa Voyage", "url": "<?= APP_URL ?>" }
                    }
                },
                {
                    "@type": "ListItem",
                    "position": 4,
                    "item": {
                        "@type": "TouristTrip",
                        "name": "Voyages sur mesure",
                        "description": "Itinéraire 100% unique et personnalisé — rythme, confort, escales et expériences choisis par le voyageur, conçus par Nora.",
                        "provider": { "@type": "TravelAgency", "name": "Amanéa Voyage", "url": "<?= APP_URL ?>" }
                    }
                }
            ]
        }
    ]
}
</script>

<!-- JS — Sticky tabs + accordéons -->
<script>
(function() {
    const tabs     = document.querySelectorAll('.voyages-tab');
    const tabsBar  = document.getElementById('voyagesTabs');
    const sections = ['cat-groupe', 'cat-feminin', 'cat-noces', 'cat-mesure'];

    // Clic tab → scroll section
    tabs.forEach(function(tab) {
        tab.addEventListener('click', function() {
            const el = document.getElementById(this.dataset.target);
            if (el) el.scrollIntoView({ behavior: 'smooth', block: 'start' });
        });
    });

    // Scroll spy — tab actif + sticky shadow
    window.addEventListener('scroll', function() {
        if (tabsBar) {
            const stuck = tabsBar.getBoundingClientRect().top <= 80;
            tabsBar.classList.toggle('voyages-tabs--stuck', stuck);
        }

        sections.forEach(function(id) {
            const el = document.getElementById(id);
            if (!el) return;
            const rect = el.getBoundingClientRect();
            if (rect.top <= 200 && rect.bottom > 200) {
                tabs.forEach(function(t) {
                    t.classList.remove('voyages-tab--active');
                    t.setAttribute('aria-selected', 'false');
                });
                const active = document.querySelector('[data-target="' + id + '"]');
                if (active) {
                    active.classList.add('voyages-tab--active');
                    active.setAttribute('aria-selected', 'true');
                }
            }
        });
    }, { passive: true });

    // Accordéons catégories
    document.querySelectorAll('.voyages-cat__accordion-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const open = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', String(!open));
            this.classList.toggle('is-open');
        });
    });

    // Accordéons itinéraires
    document.querySelectorAll('.voyages-iti-card__accordion-btn').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const open = this.getAttribute('aria-expanded') === 'true';
            this.setAttribute('aria-expanded', String(!open));
            this.classList.toggle('is-open');
        });
    });
})();
</script>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>
