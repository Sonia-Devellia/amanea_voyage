<?php
$pageTitle       = "L'Histoire d'Amanéa";
$metaDescription = "Découvrez l'histoire de Habibi Nora, fondatrice d'Amanéa Voyage — travel planning éthique et sur mesure depuis l'Île Maurice.";
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<!-- =====================================================
     HERO — Plein écran centré
     ===================================================== -->

<section class="apropos-hero">

    <img src="<?= APP_URL ?>/public/images/apropos-hero.jpg"
         alt="Dunes dorées au coucher du soleil — Amanéa Voyage"
         class="apropos-hero__image">

    <div class="apropos-hero__overlay"></div>

    <!-- Indicateur scroll -->
    <div class="apropos-hero__scroll" aria-hidden="true">
        <div class="apropos-hero__scroll-line"></div>
    </div>

    <div class="apropos-hero__content">

        <p class="apropos-hero__label">Notre histoire · Nos valeurs</p>

        <h1 class="apropos-hero__title">
            <span class="apropos-hero__title--italic">L'Histoire</span>
            <span class="apropos-hero__title--terra">d'Amanéa</span>
        </h1>

        <div class="divider divider--center" aria-hidden="true"></div>

        <p class="apropos-hero__subtitle">
            Du rêve à la réalité — l'aventure d'une femme, d'une vision, née pour révéler le monde autrement.
        </p>

    </div>

</section>

<!-- =====================================================
     INTRO NORA — Photo arche + texte
     ===================================================== -->

<section class="section section--beige">
    <div class="container">
        <div class="apropos-nora">

            <!-- Photo arche gauche -->
            <div class="apropos-nora__photo-wrap">
                <div class="apropos-nora__arch">
                    <img src="<?= APP_URL ?>/public/images/nora-portrait2.jpg"
                         alt="Habibi Nora, fondatrice d'Amanéa Voyage"
                         class="apropos-nora__photo">
                </div>
                <!-- Badge flottant -->
                <div class="apropos-nora__badge">
                    <span class="apropos-nora__badge-year">2012</span>
                    <span class="apropos-nora__badge-label">Première aventure</span>
                </div>
            </div>

            <!-- Texte droite -->
            <div class="apropos-nora__text">

                <p class="label">La femme derrière Amanéa</p>

                <h2 class="apropos-nora__title">
                    Rencontrez Nora,
                    <span class="apropos-nora__title--italic">votre travel planner.</span>
                </h2>

                <div class="divider" aria-hidden="true"></div>

                <p class="apropos-nora__body">
                    Tout commence avec une passion dévorante : le voyage comme langage universel. Nora a passé plus d'une décennie à sillonner le monde — des médinas de Marrakech aux temples du Japon, des îles grecques oubliées aux savanes tanzaniennes — en quête d'expériences qui laissent une empreinte.
                </p>

                <p class="apropos-nora__body">
                    Forte d'une formation en tourisme responsable et de ses années d'exploration personnelle, elle comprend ce que les voyageurs cherchent vraiment : non pas une destination, mais une <em>transformation</em>. Un contact authentique avec le monde. Des instants qui comptent.
                </p>

                <blockquote class="apropos-nora__quote">
                    <p>« Le voyage n'est pas une fuite. C'est un retour à soi, dans un monde plus grand. »</p>
                    <footer class="apropos-nora__quote-footer">— Habibi Nora, fondatrice</footer>
                </blockquote>

            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     LA NAISSANCE D'AMANÉA — Timeline
     ===================================================== -->

<section class="section section--white">
    <div class="container">

        <div class="section-header">
            <p class="section-header__label">Les origines</p>
            <h2 class="section-header__title">La naissance d'Amanéa</h2>
            <div class="divider divider--center" aria-hidden="true"></div>
        </div>

        <div class="apropos-timeline">

            <!-- Étape 01 — gauche -->
            <div class="apropos-timeline__item">
                <span class="apropos-timeline__number">01</span>
                <h3 class="apropos-timeline__step-title">Un déclic au Maroc</h3>
                <p class="apropos-timeline__step-text">
                    C'est lors d'un voyage solitaire dans les montagnes de l'Atlas que tout bascule. Nora réalise que les voyages qui touchent vraiment sont ceux conçus avec intention — pas ceux achetés dans un catalogue. Elle commence alors à conseiller ses proches, gratuitement, par pur amour du partage.
                </p>
            </div>

            <!-- Ligne centrale -->
            <div class="apropos-timeline__line" aria-hidden="true">
                <div class="apropos-timeline__line-top"></div>
                <div class="apropos-timeline__dot apropos-timeline__dot--terra"></div>
                <div class="apropos-timeline__line-mid"></div>
                <div class="apropos-timeline__dot apropos-timeline__dot--sage"></div>
                <div class="apropos-timeline__line-bot"></div>
            </div>

            <!-- Image paysage droite -->
            <div class="apropos-timeline__image-wrap">
                <img src="<?= APP_URL ?>/public/images/louxor.jpg"
                     alt="Egypt Louxor — inspiration fondatrice d'Amanéa Voyage"
                     class="apropos-timeline__image">
            </div>

            <!-- Image nora gauche -->
            <div class="apropos-timeline__image-wrap apropos-timeline__image-wrap--right">
                <img src="<?= APP_URL ?>/public/images/portrait-nora3.jpg"
                     alt="Carnet de voyage et planification sur mesure"
                     class="apropos-timeline__image">
            </div>

            <!-- Ligne centrale 2 -->
            <div class="apropos-timeline__line" aria-hidden="true"></div>

            <!-- Étape 02 — droite -->
            <div class="apropos-timeline__item apropos-timeline__item--right">
                <span class="apropos-timeline__number">02</span>
                <h3 class="apropos-timeline__step-title">Amanéa est née</h3>
                <p class="apropos-timeline__step-text">
                    En 2018, après des années à perfectionner son approche, Nora crée officiellement Amanéa Voyage. Le nom vient de l'arabe <em>أمانة</em> (amāna) — la confiance, la fidélité. Une promesse au cœur de chaque voyage créé. Depuis, l'agence accompagne des voyageurs du monde entier, toujours avec la même exigence et la même chaleur humaine.
                </p>
            </div>

        </div>
    </div>
</section>

<!-- =====================================================
     ENGAGEMENTS — Fond sombre, 5 colonnes
     ===================================================== -->

<section class="section section--dark">
    <div class="container">

        <div class="section-header">
            <p class="section-header__label" style="color: <?= '#A39E93' ?>">Ce en quoi nous croyons</p>
            <h2 class="apropos-engagements__title">Nos engagements</h2>
        </div>

        <div class="grid-5">

            <!-- Engagement 1 -->
            <div class="apropos-engagement">
                <div class="apropos-engagement__icon" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="#C58A60" stroke-width="1.5">
                        <path d="M20 5L8 11V22C8 28.6 13.3 34.6 20 36C26.7 34.6 32 28.6 32 22V11L20 5Z"/>
                        <path d="M14 20L18 24L26 16"/>
                    </svg>
                </div>
                <h3 class="apropos-engagement__title">Voyages éthiques</h3>
                <p class="apropos-engagement__text">Chaque itinéraire est construit en respect des communautés locales, des écosystèmes et des cultures visitées. Nous sélectionnons uniquement des partenaires partageant nos valeurs.</p>
            </div>

            <!-- Engagement 2 -->
            <div class="apropos-engagement">
                <div class="apropos-engagement__icon" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="#C58A60" stroke-width="1.5">
                        <circle cx="20" cy="20" r="13"/>
                        <path d="M7 20H33" stroke-dasharray="2 3"/>
                        <path d="M20 7C20 7 14 13 14 20C14 27 20 33 20 33"/>
                        <path d="M20 7C20 7 26 13 26 20C26 27 20 33 20 33"/>
                    </svg>
                </div>
                <h3 class="apropos-engagement__title">Sur mesure absolu</h3>
                <p class="apropos-engagement__text">Aucun voyage ne ressemble à un autre. Chaque détail — du rythme aux hébergements, des expériences aux temps libres — est pensé pour vous, et uniquement pour vous.</p>
            </div>

            <!-- Engagement 3 -->
            <div class="apropos-engagement">
                <div class="apropos-engagement__icon" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="#C58A60" stroke-width="1.5">
                        <circle cx="20" cy="13" r="6"/>
                        <path d="M8 34C8 27.4 13.4 22 20 22C26.6 22 32 27.4 32 34"/>
                        <path d="M26 18C28.5 19.5 30 22.5 30 26" stroke-dasharray="2 2"/>
                    </svg>
                </div>
                <h3 class="apropos-engagement__title">Accompagnement humain</h3>
                <p class="apropos-engagement__text">De la première conversation au retour de voyage, Nora est présente à chaque étape. Une disponibilité 24h/24 pendant le séjour, un suivi personnalisé et une relation de confiance durable.</p>
            </div>

            <!-- Engagement 4 -->
            <div class="apropos-engagement">
                <div class="apropos-engagement__icon" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="#C58A60" stroke-width="1.5">
                        <path d="M20 7L22.5 15H31L24.5 20L27 28L20 23L13 28L15.5 20L9 15H17.5L20 7Z"/>
                        <path d="M8 33H32"/>
                    </svg>
                </div>
                <h3 class="apropos-engagement__title">Excellence &amp; authenticité</h3>
                <p class="apropos-engagement__text">Nous ne promettons pas le luxe pour le luxe. Nous promettons l'extraordinaire : des moments qui transforment, des rencontres qui marquent, des lieux qui émerveillent — vrais et singuliers.</p>
            </div>

            <!-- Engagement 5 -->
            <div class="apropos-engagement">
                <div class="apropos-engagement__icon" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="#C58A60" stroke-width="1.5">
                        <path d="M10 20H18"/>
                        <path d="M22 20H30"/>
                        <circle cx="20" cy="20" r="3" fill="#C58A60" stroke="none"/>
                        <path d="M10 14C10 14 8 20 10 26"/>
                        <path d="M30 14C30 14 32 20 30 26"/>
                        <path d="M14 10C14 10 20 8 26 10"/>
                        <path d="M14 30C14 30 20 32 26 30"/>
                    </svg>
                </div>
                <h3 class="apropos-engagement__title">Pas une agence, une alliée</h3>
                <p class="apropos-engagement__text">Ici, pas de catalogue, pas de commission cachée, pas d'intermédiaire anonyme. Nora travaille en direct avec vous — une relation privilégiée, un regard expert, une passion authentique.</p>
            </div>

        </div>
    </div>
</section>

<!-- =====================================================
     PHILOSOPHIE — Photo plein largeur + texte overlay
     ===================================================== -->

<section class="apropos-philosophie">

    <img src="<?= APP_URL ?>/public/images/egypt.jpg"
         alt="Femme en randonnée dans un paysage montagneux — philosophie Amanéa Voyage"
         class="apropos-philosophie__image">

    <div class="apropos-philosophie__overlay"></div>

    <div class="apropos-philosophie__content">
        <div class="container">

            <p class="apropos-philosophie__label">Notre philosophie</p>

            <h2 class="apropos-philosophie__title">
                Voyager moins,<br>voyager mieux.
            </h2>

            <div class="divider" aria-hidden="true"></div>

            <p class="apropos-philosophie__text">
                Dans un monde saturé de tourisme de masse, Amanéa choisit le chemin contraire. Nous croyons que chaque voyage devrait être une expérience rare — conçue pour durer dans la mémoire, pas seulement dans le carnet de bord.
            </p>

            <p class="apropos-philosophie__text">
                Partir moins souvent, mais vivre davantage. Comprendre avant de traverser. Respecter avant de découvrir. C'est cette conviction qui guide chaque voyage que nous imaginons.
            </p>

        </div>
    </div>

</section>

<!-- =====================================================
     CHIFFRES CLÉS — Fond terracotta
     ===================================================== -->

<section class="apropos-chiffres">
    <div class="container">
        <div class="apropos-chiffres__grid">

            <div class="apropos-chiffres__item">
                <span class="apropos-chiffres__number">12+</span>
                <span class="apropos-chiffres__label">Années de passion voyage</span>
            </div>

            <div class="apropos-chiffres__item">
                <span class="apropos-chiffres__number">38</span>
                <span class="apropos-chiffres__label">Destinations maîtrisées</span>
            </div>

            <div class="apropos-chiffres__item">
                <span class="apropos-chiffres__number">200+</span>
                <span class="apropos-chiffres__label">Voyageurs accompagnés</span>
            </div>

            <div class="apropos-chiffres__item">
                <span class="apropos-chiffres__number">100%</span>
                <span class="apropos-chiffres__label">Sur mesure, toujours</span>
            </div>

        </div>
    </div>
</section>

<!-- =====================================================
     CTA FINAL — Fond beige + SVG arche
     ===================================================== -->

<section class="section section--beige" style="text-align: center;">
    <div class="container">
        <div class="apropos-cta">

            <!-- SVG arche décoratif -->
            <div class="apropos-cta__arch" aria-hidden="true">
                <svg width="48" height="56" viewBox="0 0 48 56" fill="none">
                    <path d="M24 4 C10 4, 4 18, 4 28 L4 52 L44 52 L44 28 C44 18, 38 4, 24 4 Z"
                          fill="none" stroke="#C58A60" stroke-width="1.5"/>
                    <path d="M24 4 C10 4, 4 18, 4 28 L4 52"
                          fill="none" stroke="#C58A60" stroke-width="3" opacity="0.9"/>
                    <path d="M24 4 C38 4, 44 18, 44 28 L44 52"
                          fill="none" stroke="#A4B3A1" stroke-width="3" opacity="0.9"/>
                </svg>
            </div>

            <p class="label">Votre histoire commence ici</p>

            <h2 class="apropos-cta__title">
                Prêt(e) à vivre
                <span class="apropos-cta__title--italic">votre voyage Amanéa ?</span>
            </h2>

            <p class="apropos-cta__text">
                Un échange découverte gratuit, sans engagement — pour co-créer ensemble l'aventure qui vous ressemble.
            </p>

            <div class="apropos-cta__buttons">
                <a href="<?= APP_URL ?>/contact" class="btn-primary btn-lg">Planifions votre voyage →</a>
                <a href="<?= APP_URL ?>/home" class="btn-outline btn-lg">Retour à l'accueil</a>
            </div>

        </div>
    </div>
</section>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>