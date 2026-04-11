<?php
$pageTitle       = 'Créons votre voyage';
$metaDescription = 'Contactez Habibi Nora pour créer votre voyage sur mesure. Échange découverte gratuit, sans engagement.';
$ogImage         = APP_URL . '/public/images/cta-aerial.webp';
$headExtra       = '<link rel="preload" as="image" href="' . APP_URL . '/public/images/cta-aerial.webp" fetchpriority="high">';
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<!-- =====================================================
     HERO — 60vh, fond sombre
     ===================================================== -->

<section class="contact-hero">

    <img src="<?= APP_URL ?>/public/images/cta-aerial3.webp"
        alt="Vue aérienne d'une île tropicale — Créons votre voyage Amanéa"
        class="contact-hero__image"
        fetchpriority="high"
        decoding="async">

    <div class="contact-hero__overlay"></div>

    <div class="contact-hero__content">
        <div class="container">
            <p class="contact-hero__label">Parlons de votre projet</p>
            <h1 class="contact-hero__title">
                <span class="contact-hero__title--white">Créons votre</span>
                <span class="contact-hero__title--terra">voyage ensemble</span>
            </h1>
            <div class="divider" aria-hidden="true"></div>
        </div>
    </div>

</section>

<!-- =====================================================
     INTRO + FORMULAIRE
     ===================================================== -->

<section class="section section--beige">
    <div class="container">
        <div class="contact-grid">

            <!-- Colonne gauche — intro + contact -->
            <div class="contact-intro">

                <p class="contact-intro__hook">
                    Un appel découverte gratuit de 30 minutes pour co-créer quelque chose d'unique.
                </p>

                <p class="contact-intro__text">
                    Remplissez ce formulaire et Nora vous contactera dans les 48h pour un échange sans engagement. Ensemble, vous poserez les bases de votre voyage idéal.
                </p>

                <!-- Promesses -->
                <ul class="contact-promises">
                    <li class="contact-promises__item">
                        <span class="contact-promises__icon">✦</span>
                        <span>Réponse personnalisée sous 48h</span>
                    </li>
                    <li class="contact-promises__item">
                        <span class="contact-promises__icon">✦</span>
                        <span>Appel découverte gratuit, sans engagement</span>
                    </li>
                    <li class="contact-promises__item">
                        <span class="contact-promises__icon">✦</span>
                        <span>Devis détaillé et transparent à partir de votre budget</span>
                    </li>
                    <li class="contact-promises__item">
                        <span class="contact-promises__icon">✦</span>
                        <span>Accompagnement de A à Z et disponibilité 24/24h</span>
                    </li>
                </ul>

                <!-- Contact direct -->
                <div class="contact-direct">
                    <p class="contact-direct__label">Ou contactez-moi directement</p>
                    <a href="mailto:contact@amaneavoyage.fr" class="contact-direct__email">
                        amaneavoyages@gmail.com
                    </a>
                    <a href="tel:+33600000000" class="contact-direct__phone">
                        +33 6 00 00 00 00
                    </a> 06 24 74 57 38
                </div>

            </div>

            <!-- Colonne droite — formulaire -->
            <div class="contact-form-wrap">

                <?php if (isset($success)) : ?>
                    <!-- Message de succès -->
                    <div class="contact-success">
                        <div class="contact-success__icon" aria-hidden="true">
                            <svg width="28" height="28" viewBox="0 0 28 28" fill="none">
                                <path d="M5 14L11 20L23 8" stroke="#C58A60" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <h3 class="contact-success__title">Message bien reçu !</h3>
                        <p class="contact-success__text">
                            Nora prendra contact avec vous dans les 48h pour un échange découverte gratuit et sans engagement.
                        </p>
                        <a href="<?= APP_URL ?>/home" class="btn-primary">Retour à l'accueil</a>
                    </div>

                <?php else : ?>
                    <!-- Formulaire -->
                    <form class="contact-form" method="POST" action="<?= APP_URL ?>/contact/send" novalidate>

                        <?php if (isset($error)) : ?>
                            <div class="form-error" role="alert">
                                <?= htmlspecialchars($error) ?>
                            </div>
                        <?php endif; ?>

                        <!-- Prénom + Nom -->
                        <div class="form__row">
                            <div class="form-group">
                                <label class="form-label" for="prenom">Prénom *</label>
                                <input type="text"
                                    id="prenom"
                                    name="prenom"
                                    class="form-input"
                                    placeholder="Votre prénom"
                                    value="<?= htmlspecialchars($_POST['prenom'] ?? '') ?>"
                                    required
                                    autocomplete="given-name">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="nom">Nom *</label>
                                <input type="text"
                                    id="nom"
                                    name="nom"
                                    class="form-input"
                                    placeholder="Votre nom"
                                    value="<?= htmlspecialchars($_POST['nom'] ?? '') ?>"
                                    required
                                    autocomplete="family-name">
                            </div>
                        </div>

                        <!-- Email + Téléphone -->
                        <div class="form__row">
                            <div class="form-group">
                                <label class="form-label" for="email">Email *</label>
                                <input type="email"
                                    id="email"
                                    name="email"
                                    class="form-input"
                                    placeholder="votre@email.fr"
                                    value="<?= htmlspecialchars($_POST['email'] ?? '') ?>"
                                    required
                                    autocomplete="email">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="telephone">Téléphone</label>
                                <input type="tel"
                                    id="telephone"
                                    name="telephone"
                                    class="form-input"
                                    placeholder="+33 6 00 00 00 00"
                                    value="<?= htmlspecialchars($_POST['telephone'] ?? '') ?>"
                                    autocomplete="tel">
                            </div>
                        </div>

                        <!-- Type de voyage -->
                        <div class="form-group">
                            <label class="form-label" for="type_voyage">Type de voyage *</label>
                            <select id="type_voyage" name="type_voyage" class="form-select" required>
                                <option value="" disabled <?= empty($_POST['type_voyage']) ? 'selected' : '' ?>>
                                    Choisissez un type de voyage
                                </option>
                                <option value="groupe" <?= ($_POST['type_voyage'] ?? '') === 'groupe'       ? 'selected' : '' ?>>Voyage en groupe</option>
                                <option value="feminin" <?= ($_POST['type_voyage'] ?? '') === 'feminin'      ? 'selected' : '' ?>>Voyage au féminin</option>
                                <option value="noces" <?= ($_POST['type_voyage'] ?? '') === 'noces'        ? 'selected' : '' ?>>Voyage de noces / Lune de miel</option>
                                <option value="personnalise" <?= ($_POST['type_voyage'] ?? '') === 'personnalise' ? 'selected' : '' ?>>Voyage sur mesure</option>
                                <option value="inconnu" <?= ($_POST['type_voyage'] ?? '') === 'inconnu'      ? 'selected' : '' ?>>Je ne sais pas encore</option>
                            </select>
                        </div>

                        <!-- Destination + Durée -->
                        <div class="form__row">
                            <div class="form-group">
                                <label class="form-label" for="destination">Destination(s)</label>
                                <input type="text"
                                    id="destination"
                                    name="destination"
                                    class="form-input"
                                    placeholder="Maroc, Japon, Bali…"
                                    value="<?= htmlspecialchars($_POST['destination'] ?? '') ?>">
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="duree">Durée</label>
                                <select id="duree" name="duree" class="form-select">
                                    <option value="">Sélectionner</option>
                                    <option value="1semaine" <?= ($_POST['duree'] ?? '') === '1semaine'  ? 'selected' : '' ?>>Une semaine</option>
                                    <option value="10jours" <?= ($_POST['duree'] ?? '') === '10jours'   ? 'selected' : '' ?>>10 jours</option>
                                    <option value="2semaines" <?= ($_POST['duree'] ?? '') === '2semaines' ? 'selected' : '' ?>>2 semaines</option>
                                    <option value="3semaines" <?= ($_POST['duree'] ?? '') === '3semaines' ? 'selected' : '' ?>>3 semaines</option>
                                    <option value="1mois" <?= ($_POST['duree'] ?? '') === '1mois'     ? 'selected' : '' ?>>1 mois ou plus</option>
                                    <option value="flexible" <?= ($_POST['duree'] ?? '') === 'flexible'  ? 'selected' : '' ?>>Flexible</option>
                                </select>
                            </div>
                        </div>

                        <!-- Budget + Nb voyageurs -->
                        <div class="form__row">
                            <div class="form-group">
                                <label class="form-label" for="budget">Budget</label>
                                <select id="budget" name="budget" class="form-select">
                                    <option value="">Sélectionner</option>
                                    <option value="moins2000" <?= ($_POST['budget'] ?? '') === 'moins2000'   ? 'selected' : '' ?>>Moins de 2 000 € / pers.</option>
                                    <option value="2000-4000" <?= ($_POST['budget'] ?? '') === '2000-4000'   ? 'selected' : '' ?>>2 000 – 4 000 € / pers.</option>
                                    <option value="4000-7000" <?= ($_POST['budget'] ?? '') === '4000-7000'   ? 'selected' : '' ?>>4 000 – 7 000 € / pers.</option>
                                    <option value="7000-10000" <?= ($_POST['budget'] ?? '') === '7000-10000'  ? 'selected' : '' ?>>7 000 – 10 000 € / pers.</option>
                                    <option value="plus10000" <?= ($_POST['budget'] ?? '') === 'plus10000'   ? 'selected' : '' ?>>Plus de 10 000 € / pers.</option>
                                    <option value="adefinir" <?= ($_POST['budget'] ?? '') === 'adefinir'    ? 'selected' : '' ?>>À définir ensemble</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label class="form-label" for="nb_voyageurs">Nombre de voyageurs</label>
                                <input type="number"
                                    id="nb_voyageurs"
                                    name="nb_voyageurs"
                                    class="form-input"
                                    placeholder="Ex : 2"
                                    min="1"
                                    value="<?= htmlspecialchars($_POST['nb_voyageurs'] ?? '') ?>">
                            </div>
                        </div>

                        <!-- Date de départ -->
                        <div class="form-group">
                            <label class="form-label" for="date_depart">Date de départ souhaitée</label>
                            <input type="text"
                                id="date_depart"
                                name="date_depart"
                                class="form-input"
                                placeholder="Ex : Octobre 2025, flexible…"
                                value="<?= htmlspecialchars($_POST['date_depart'] ?? '') ?>">
                        </div>

                        <!-- Message -->
                        <div class="form-group">
                            <label class="form-label" for="message">Votre projet en quelques mots *</label>
                            <textarea id="message"
                                name="message"
                                class="form-textarea"
                                rows="4"
                                placeholder="Décrivez vos envies, vos rêves, ce qui vous inspire pour ce voyage…"
                                required><?= htmlspecialchars($_POST['message'] ?? '') ?></textarea>
                        </div>

                        <!-- RGPD -->
                        <label class="form-checkbox">
                            <input type="checkbox"
                                id="rgpd"
                                name="rgpd"
                                required>
                            <div class="form-checkbox__box">
                                <svg width="12" height="12" viewBox="0 0 12 12" fill="none">
                                    <path d="M2 6l3 3 5-5" stroke="white" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                                </svg>
                            </div>
                            <span class="form-checkbox__label">
                                J'accepte que mes données soient utilisées pour traiter ma demande de voyage.
                                Aucune donnée ne sera partagée avec des tiers.
                                <a href="<?= APP_URL ?>/mentions-legales">Mentions légales</a>
                            </span>
                        </label>

                        <!-- Submit -->
                        <div class="contact-form__footer">
                            <button type="submit" class="btn-primary btn-lg">
                                Envoyer ma demande
                            </button>
                            <p class="contact-form__mention">
                                * Champs obligatoires. Vos données sont confidentielles et ne seront jamais partagées.
                            </p>
                        </div>

                    </form>
                <?php endif; ?>

            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     GARANTIES — 3 colonnes
     ===================================================== -->

<section class="section section--beige">
    <div class="container">
        <div class="contact-garanties">

            <div class="contact-garantie">
                <div class="contact-garantie__icon" aria-hidden="true">
                    <svg width="36" height="36" fill="none" viewBox="0 0 36 36" stroke="#C58A60" stroke-width="1.5" stroke-linecap="round">
                        <circle cx="18" cy="18" r="14" />
                        <path d="M12 18l4 4 8-8" />
                    </svg>
                </div>
                <h4 class="contact-garantie__title">Sans engagement</h4>
                <p class="contact-garantie__text">Le premier échange est gratuit. Aucune obligation de suite.</p>
            </div>

            <div class="contact-garantie">
                <div class="contact-garantie__icon" aria-hidden="true">
                    <svg width="36" height="36" fill="none" viewBox="0 0 36 36" stroke="#C58A60" stroke-width="1.5" stroke-linecap="round">
                        <path d="M18 4 L22 14 L33 14 L24 21 L27 32 L18 26 L9 32 L12 21 L3 14 L14 14 Z" />
                    </svg>
                </div>
                <h4 class="contact-garantie__title">100% personnalisé</h4>
                <p class="contact-garantie__text">Chaque voyage est unique, construit autour de vos envies et votre budget.</p>
            </div>

            <div class="contact-garantie">
                <div class="contact-garantie__icon" aria-hidden="true">
                    <svg width="36" height="36" fill="none" viewBox="0 0 36 36" stroke="#C58A60" stroke-width="1.5" stroke-linecap="round">
                        <rect x="4" y="10" width="28" height="22" rx="3" />
                        <path d="M4 17 L32 17" />
                        <circle cx="12" cy="24" r="2" fill="#C58A60" stroke="none" />
                        <path d="M18 24 L26 24" />
                    </svg>
                </div>
                <h4 class="contact-garantie__title">Budget maîtrisé</h4>
                <p class="contact-garantie__text">Devis clair et transparent à partir de votre budget, sans frais cachés ni mauvaise surprise.</p>
            </div>

        </div>
    </div>
</section>

<!-- Schema.org JSON-LD — ContactPage -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@type": "ContactPage",
    "name": "Créons votre voyage — Contact Amanéa",
    "description": "Contactez Habibi Nora pour créer votre voyage sur mesure. Échange découverte gratuit, sans engagement.",
    "url": "<?= APP_URL ?>/contact",
    "image": "<?= APP_URL ?>/public/images/cta-aerial.webp",
    "inLanguage": "fr-FR",
    "isPartOf": {
        "@type": "WebSite",
        "name": "Amanéa Voyage",
        "url": "<?= APP_URL ?>"
    },
    "mainEntity": {
        "@type": "TravelAgency",
        "name": "Amanéa Voyage",
        "url": "<?= APP_URL ?>",
        "email": "amaneavoyages@gmail.com",
        "founder": {
            "@type": "Person",
            "name": "Habibi Nora"
        },
        "sameAs": [
            "https://www.instagram.com/amanea_voyage/",
            "https://www.facebook.com/Amanea.voyage"
        ]
    }
}
</script>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>