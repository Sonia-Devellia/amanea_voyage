<?php
$pageTitle       = "L'Histoire d'Amanéa";
$metaDescription = "Découvrez l'histoire de Habibi Nora, fondatrice d'Amanéa Voyage — travel planning éthique et sur mesure depuis l'Île Maurice.";
$ogImage         = APP_URL . '/public/images/apropos-hero.webp';
$headExtra       = '<link rel="preload" as="image" href="' . APP_URL . '/public/images/apropos-hero.webp" fetchpriority="high">';
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<!-- =====================================================
     HERO — Plein écran centré
     ===================================================== -->

<section class="apropos-hero">

    <img src="<?= APP_URL ?>/public/images/apropos-hero.webp"
        alt="Dunes dorées au coucher du soleil — Amanéa Voyage"
        class="apropos-hero__image"
        fetchpriority="high"
        decoding="async">

    <div class="apropos-hero__overlay"></div>

    <!-- Indicateur scroll -->
    <div class="apropos-hero__scroll" aria-hidden="true">
        <div class="apropos-hero__scroll-line"></div>
    </div>

    <div class="apropos-hero__content">

        <p class="apropos-hero__label">Mon histoire · Mes valeurs</p>

        <h1 class="apropos-hero__title">
            <span class="apropos-hero__title--italic">L'Histoire</span>
            <span class="apropos-hero__title--terra">d'Amanéa</span>
        </h1>

        <div class="divider divider--center" aria-hidden="true"></div>

        <p class="apropos-hero__subtitle">
            Du rêve à la réalité: l'aventure d'une femme, d'une vision, née pour révéler le monde autrement.
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
                    <img src="<?= APP_URL ?>/public/images/nora-portrait2.webp"
                        alt="Habibi Nora, fondatrice d'Amanéa Voyage"
                        class="apropos-nora__photo"
                        loading="lazy"
                        decoding="async">
                </div>
                <!-- Badge flottant -->
                <div class="apropos-nora__badge">
                    <span class="apropos-nora__badge-year">2020</span>
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
                    Tout commence avec une passion dévorante : le voyage comme langage universel. Nora a passé plus d'une décennie à sillonner le monde, des souks animés du Caire aux ruelles parfumées de Valence, des îles éparpillées du Cap-Vert aux plages de l'île Maurice, en quête d'expériences qui laissent une empreinte.
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
                <div class="apropos-timeline__line-bot"></div>
            </div>

            <!-- Image paysage droite -->
            <div class="apropos-timeline__image-wrap">
                <img src="<?= APP_URL ?>/public/images/louxor.webp"
                    alt="Egypt Louxor — inspiration fondatrice d'Amanéa Voyage"
                    class="apropos-timeline__image"
                    loading="lazy"
                    decoding="async">
            </div>

            <!-- Image nora gauche -->
            <div class="apropos-timeline__image-wrap apropos-timeline__image-wrap--right">
                <img src="<?= APP_URL ?>/public/images/portrait-nora3.webp"
                    alt="Nora en Voyage en Egypt"
                    class="apropos-timeline__image"
                    loading="lazy"
                    decoding="async">
            </div>

            <!-- Ligne centrale 2 -->
            <div class="apropos-timeline__line" aria-hidden="true">
                <div class="apropos-timeline__line-top"></div>
                <div class="apropos-timeline__dot apropos-timeline__dot--sage"></div>
                <div class="apropos-timeline__line-bot"></div>
            </div>

            <!-- Étape 02 — droite -->
            <div class="apropos-timeline__item apropos-timeline__item--right">
                <span class="apropos-timeline__number">02</span>
                <h3 class="apropos-timeline__step-title">Amanéa est née</h3>
                <p class="apropos-timeline__step-text">
                    Fin 2024, après des années à perfectionner son approche, Nora crée officiellement Amanéa Voyage. Le nom vient de l'arabe <em>أمانة</em> (amāna) : l'honnêteté, la confiance, la fidélité. Une promesse au cœur de chaque voyage créé. Depuis, elle accompagne des voyageurs du monde entier, toujours avec la même exigence et la même chaleur humaine.
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
            <p class="section-header__label" style="color: <?= '#C58A60' ?>">Ce en quoi nous croyons</p>
            <h2 class="apropos-engagements__title">Nos engagements</h2>
        </div>

        <div class="grid-5">

            <!-- Engagement 1 -->
            <div class="apropos-engagement">
                <div class="apropos-engagement__icon" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="#9B6030" stroke-width="1.5">
                        <path d="M20 5L8 11V22C8 28.6 13.3 34.6 20 36C26.7 34.6 32 28.6 32 22V11L20 5Z" />
                        <path d="M14 20L18 24L26 16" />
                    </svg>
                </div>
                <h3 class="apropos-engagement__title">Voyages éthiques</h3>
                <p class="apropos-engagement__text">Chaque itinéraire est construit en respect des communautés locales, des écosystèmes et des cultures visitées. Nous sélectionnons uniquement des partenaires partageant nos valeurs.</p>
            </div>

            <!-- Engagement 2 -->
            <div class="apropos-engagement">
                <div class="apropos-engagement__icon" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="#9B6030" stroke-width="1.5">
                        <circle cx="20" cy="20" r="13" />
                        <path d="M7 20H33" stroke-dasharray="2 3" />
                        <path d="M20 7C20 7 14 13 14 20C14 27 20 33 20 33" />
                        <path d="M20 7C20 7 26 13 26 20C26 27 20 33 20 33" />
                    </svg>
                </div>
                <h3 class="apropos-engagement__title">Sur mesure absolu</h3>
                <p class="apropos-engagement__text">Aucun voyage ne ressemble à un autre. Chaque détail — du rythme aux hébergements, des expériences aux temps libres — est pensé pour vous, et uniquement pour vous.</p>
            </div>

            <!-- Engagement 3 -->
            <div class="apropos-engagement">
                <div class="apropos-engagement__icon" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="#9B6030" stroke-width="1.5">
                        <circle cx="20" cy="13" r="6" />
                        <path d="M8 34C8 27.4 13.4 22 20 22C26.6 22 32 27.4 32 34" />
                        <path d="M26 18C28.5 19.5 30 22.5 30 26" stroke-dasharray="2 2" />
                    </svg>
                </div>
                <h3 class="apropos-engagement__title">Accompagnement humain</h3>
                <p class="apropos-engagement__text">De la première conversation au retour de voyage, Nora est présente à chaque étape. Une disponibilité 24h/24 pendant le séjour, un suivi personnalisé et une relation de confiance durable.</p>
            </div>

            <!-- Engagement 4 -->
            <div class="apropos-engagement">
                <div class="apropos-engagement__icon" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="#9B6030" stroke-width="1.5">
                        <path d="M20 7L22.5 15H31L24.5 20L27 28L20 23L13 28L15.5 20L9 15H17.5L20 7Z" />
                        <path d="M8 33H32" />
                    </svg>
                </div>
                <h3 class="apropos-engagement__title">Excellence &amp; authenticité</h3>
                <p class="apropos-engagement__text">Nous ne promettons pas le luxe pour le luxe. Nous promettons l'extraordinaire : des moments qui transforment, des rencontres qui marquent, des lieux qui émerveillent — vrais et singuliers.</p>
            </div>

            <!-- Engagement 5 -->
            <div class="apropos-engagement">
                <div class="apropos-engagement__icon" aria-hidden="true">
                    <svg width="40" height="40" viewBox="0 0 40 40" fill="none" stroke="#9B6030" stroke-width="1.5">
                        <path d="M10 20H18" />
                        <path d="M22 20H30" />
                        <circle cx="20" cy="20" r="3" fill="#9B6030" stroke="none" />
                        <path d="M10 14C10 14 8 20 10 26" />
                        <path d="M30 14C30 14 32 20 30 26" />
                        <path d="M14 10C14 10 20 8 26 10" />
                        <path d="M14 30C14 30 20 32 26 30" />
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

    <img src="<?= APP_URL ?>/public/images/egypt.webp"
        alt="Paysage vue du ciel du désert Egyptien — philosophie Amanéa Voyage"
        class="apropos-philosophie__image"
        loading="lazy"
        decoding="async">

    <div class="apropos-philosophie__overlay"></div>

    <div class="apropos-philosophie__content">
        <div class="container">

            <p class="apropos-philosophie__label">Ma philosophie</p>

            <h2 class="apropos-philosophie__title">
                Voyagez autrement,<br>en conscience.
            </h2>

            <div class="divider" aria-hidden="true"></div>

            <p class="apropos-philosophie__text">
                Voyager avec Amanéa, ce n’est pas simplement partir.
                C’est choisir une expérience pensée avec soin, où chaque détail trouve sa place dans un ensemble fluide et cohérent.
                Je conçois des voyages sur mesure, guidés par l’intuition, l’expertise et une attention particulière portée à l’humain et aux lieux.
            </p>

            <p class="apropos-philosophie__text">
                Mon rôle est de vous accompagner, structurer et orchestrer.
                Le vôtre… de vivre pleinement le voyage.
                Ici, tout est réfléchi, pour que vous puissiez avancer avec sérénité.
                Parce que les plus beaux voyages ne se résument pas à ce que l’on voit, mais à ce que l’on ressent.
            </p>


            <div class="philosophie-cta__buttons">
                <button class="btn-ghost btn-charte">Consultez la charte Amanéa</button>
            </div>
        </div>

    </div>

</section>



<!-- =====================================================
     MODALE CHARTE AMANÉA
     Déclenchée par : class="btn-charte"
     ===================================================== -->

<div class="modal" id="charteModal" role="dialog" aria-modal="true" aria-labelledby="charteModalTitle">

    <!-- Overlay -->
    <div class="modal__overlay" id="charteModalOverlay"></div>

    <!-- Contenu -->
    <div class="modal__container">

        <!-- Header -->
        <div class="modal__header">
            <div>
                <p class="modal__label">Amanéa Voyage</p>
                <h2 class="modal__title" id="charteModalTitle">Notre Charte</h2>
            </div>
            <button class="modal__close" id="charteModalClose" aria-label="Fermer la charte">
                <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5">
                    <line x1="18" y1="6" x2="6" y2="18"/>
                    <line x1="6" y1="6" x2="18" y2="18"/>
                </svg>
            </button>
        </div>

        <!-- Corps scrollable -->
        <div class="modal__body">

            <p class="modal__intro">Voyager autrement</p>

            <p class="modal__text">Chez Amanéa, chaque voyage commence bien avant le départ. C'est une intention. Une respiration. Un pas de côté. Je conçois des voyages pour celles et ceux qui ne cherchent pas simplement à "voir", mais à ressentir, comprendre, se reconnecter.</p>

            <h3 class="modal__block-title">Une relation basée sur la confiance</h3>
            <p class="modal__text">Choisir Amanéa, c'est faire le choix d'un accompagnement sur mesure. C'est accepter de ne pas tout maîtriser, pour mieux se laisser guider. Je m'appuie sur mon expérience du terrain, des partenaires locaux sélectionnés avec exigence, et une vision globale du voyage.</p>

            <h3 class="modal__block-title">Une approche experte et engagée</h3>
            <p class="modal__text">Chaque itinéraire est pensé dans son ensemble : cohérence des étapes, qualité des expériences, rythme du voyage, équilibre entre découverte et respiration. Rien n'est laissé au hasard, mais tout n'a pas vocation à être contrôlé ligne par ligne.</p>

            <h3 class="modal__block-title">Lâcher prise… sans jamais perdre le contrôle</h3>
            <p class="modal__text">Voyager avec Amanéa, ce n'est pas renoncer à comprendre. C'est faire le choix de faire confiance à un regard expert. L'essence même de mon accompagnement repose sur un équilibre : vous impliquer sans vous surcharger, vous guider sans vous imposer, vous rassurer sans vous noyer dans les détails.</p>

            <h3 class="modal__block-title">Une expérience avant tout</h3>
            <blockquote class="modal__quote">
                Je ne vends pas un enchaînement de prestations. Je conçois des expériences. Des moments. Des atmosphères. Des souvenirs durables.
            </blockquote>
            <p class="modal__text">Et c'est souvent dans ce qui ne se mesure pas que réside la valeur du voyage.</p>

            <h3 class="modal__block-title">Une vision responsable</h3>
            <p class="modal__text">Amanéa s'inscrit dans une démarche consciente : privilégier des partenaires engagés, éviter le tourisme de masse, respecter les cultures locales et favoriser des expériences authentiques. Voyager, oui. Mais avec sens.</p>

            <h3 class="modal__block-title">Ce que cela implique pour vous</h3>
            <p class="modal__text">Travailler ensemble, c'est accepter une part de confiance, accueillir une vision différente du voyage, s'ouvrir à une expérience pensée pour vous.</p>

            <p class="modal__final">Et surtout, se laisser porter.</p>

        </div>

        <!-- Footer -->
        <div class="modal__footer">
            <a href="<?= APP_URL ?>/contact" class="btn-primary">On créer votre prochain souvenir ?</a>
            <button class="btn-outline" id="charteModalCloseBtn">Fermer</button>
        </div>

    </div>
</div>

<!-- JavaScript modale -->
<script>
(function() {
    const modal   = document.getElementById('charteModal');
    const overlay = document.getElementById('charteModalOverlay');
    const btnOpen = document.querySelector('.btn-charte');
    const btnClose  = document.getElementById('charteModalClose');
    const btnCloseFooter = document.getElementById('charteModalCloseBtn');

    function openModal() {
        modal.classList.add('modal--open');
        document.body.style.overflow = 'hidden';
        btnClose.focus();
    }

    function closeModal() {
        modal.classList.remove('modal--open');
        document.body.style.overflow = '';
        if (btnOpen) btnOpen.focus();
    }

    if (btnOpen)         btnOpen.addEventListener('click', openModal);
    if (btnClose)        btnClose.addEventListener('click', closeModal);
    if (btnCloseFooter)  btnCloseFooter.addEventListener('click', closeModal);
    if (overlay)         overlay.addEventListener('click', closeModal);

    // Fermeture avec la touche Échap
    document.addEventListener('keydown', function(e) {
        if (e.key === 'Escape' && modal.classList.contains('modal--open')) {
            closeModal();
        }
    });
})();
</script>


<!-- =====================================================
     EN COULISSES — Le bureau de Nora
     ===================================================== -->

<section class="section section--beige">
    <div class="container">
        <div class="apropos-coulisses">

            <!-- Texte gauche -->
            <div class="apropos-coulisses__text">

                <p class="label">En coulisses</p>

                <h2 class="apropos-coulisses__title">
                    Comment prend vie
                    <span class="apropos-coulisses__title--italic">votre voyage ?</span>
                </h2>

                <div class="divider" aria-hidden="true"></div>

                <p class="apropos-coulisses__body">
                    Chaque voyage commence par une conversation — une vraie. Nora prend le temps de vous comprendre : vos envies profondes, vos peurs éventuelles, vos rêves inavoués. Elle puise dans ses carnets de route, ses réseaux de partenaires de confiance et ses voyages de reconnaissance pour concevoir votre itinéraire.
                </p>

                <p class="apropos-coulisses__body">
                    Aucun logiciel automatisé. Aucun formulaire standardisé. Chaque proposition est rédigée à la main, pensée pour vous,avec soin, expertise et une bonne dose de passion.
                </p>

                <!-- Checklist -->
                <ul class="apropos-checklist">
                    <li class="apropos-checklist__item">
                        <div class="apropos-checklist__icon" aria-hidden="true">
                            <svg width="9" height="9" viewBox="0 0 10 8" fill="none">
                                <path d="M1 4l3 3 5-6" stroke="#C58A60" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span>Rendez-vous découverte gratuit (30 min)</span>
                    </li>
                    <li class="apropos-checklist__item">
                        <div class="apropos-checklist__icon" aria-hidden="true">
                            <svg width="9" height="9" viewBox="0 0 10 8" fill="none">
                                <path d="M1 4l3 3 5-6" stroke="#C58A60" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span>Proposition d'un itinéraire de voyage personnalisé </span>
                    </li>
                    <li class="apropos-checklist__item">
                        <div class="apropos-checklist__icon" aria-hidden="true">
                            <svg width="9" height="9" viewBox="0 0 10 8" fill="none">
                                <path d="M1 4l3 3 5-6" stroke="#C58A60" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span>Partenaires locaux vérifiés sur place</span>
                    </li>
                    <li class="apropos-checklist__item">
                        <div class="apropos-checklist__icon" aria-hidden="true">
                            <svg width="9" height="9" viewBox="0 0 10 8" fill="none">
                                <path d="M1 4l3 3 5-6" stroke="#C58A60" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span>Carnet de voyage numérique inclus</span>
                    </li>
                    <li class="apropos-checklist__item">
                        <div class="apropos-checklist__icon" aria-hidden="true">
                            <svg width="9" height="9" viewBox="0 0 10 8" fill="none">
                                <path d="M1 4l3 3 5-6" stroke="#C58A60" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round" />
                            </svg>
                        </div>
                        <span>Disponibilité 24h/24 pendant le séjour</span>
                    </li>
                </ul>

            </div>

            <!-- Photo droite -->
            <div class="apropos-coulisses__photo-wrap">

                <!-- Quote flottante -->
                <div class="apropos-coulisses__quote-card">
                    <p class="apropos-coulisses__quote-text">
                        «Vous êtes unique, votre voyage l'est aussi. »
                    </p>
                    <span class="apropos-coulisses__quote-author">— Nora</span>
                </div>

                <div class="apropos-coulisses__photo-frame">
                    <img src="<?= APP_URL ?>/public/images/carnet-de-voyage.webp"
                        alt="Bureau de Habibi Nora — planification de voyages sur mesure"
                        class="apropos-coulisses__photo"
                        loading="lazy"
                        decoding="async">
                </div>

            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     CTA FINAL — Fond white 
     ===================================================== -->

<section class="section section--white" style="text-align: center;">
    <div class="container">
        <div class="apropos-cta">

            <p class="label">Votre histoire commence ici</p>

            <h2 class="apropos-cta__title">
                Prêt(e) à vivre
                <span class="apropos-cta__title--italic">votre voyage Amanéa ?</span>
            </h2>

            <p class="apropos-cta__text">
                Un échange découverte gratuit, sans engagement, pour co-créer ensemble l'aventure qui vous ressemble.
            </p>

            <div class="apropos-cta__buttons">
                <a href="<?= APP_URL ?>/contact" class="btn-primary btn-lg">Planifions votre voyage</a>
                <a href="<?= APP_URL ?>/voyages" class="btn-outline btn-lg">Découvrir nos voyages</a>
            </div>

        </div>
    </div>
</section>

<!-- Schema.org JSON-LD — AboutPage + Person (Habibi Nora) -->
<script type="application/ld+json">
    {
        "@context": "https://schema.org",
        "@graph": [{
                "@type": "AboutPage",
                "name": "L'Histoire d'Amanéa",
                "description": "Découvrez l'histoire de Habibi Nora, fondatrice d'Amanéa Voyage — travel planning éthique et sur mesure depuis l'Île Maurice.",
                "url": "<?= APP_URL ?>/a-propos",
                "image": "<?= APP_URL ?>/public/images/apropos-hero.webp",
                "inLanguage": "fr-FR",
                "isPartOf": {
                    "@type": "WebSite",
                    "name": "Amanéa Voyage",
                    "url": "<?= APP_URL ?>"
                }
            },
            {
                "@type": "Person",
                "name": "Habibi Nora",
                "jobTitle": "Travel planner & créatrice de voyages sur mesure",
                "description": "Fondatrice d'Amanéa Voyage, Habibi Nora conçoit des voyages éthiques et sur mesure depuis l'Île Maurice — voyages de noces, au féminin, en groupe et personnalisés.",
                "url": "<?= APP_URL ?>/a-propos",
                "image": "<?= APP_URL ?>/public/images/nora-portrait2.webp",
                "worksFor": {
                    "@type": "TravelAgency",
                    "name": "Amanéa Voyage",
                    "url": "<?= APP_URL ?>",
                    "sameAs": [
                        "https://www.instagram.com/amanea_voyage/",
                        "https://www.facebook.com/Amanea.voyage"
                    ]
                },
                "knowsAbout": [
                    "Voyages sur mesure",
                    "Travel planning éthique",
                    "Île Maurice",
                    "Voyages de noces",
                    "Tourisme responsable"
                ]
            }
        ]
    }
</script>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>