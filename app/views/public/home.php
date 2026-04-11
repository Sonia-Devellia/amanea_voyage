<?php
$pageTitle       = 'Travel Planner Éthique & Sur Mesure';
$metaDescription = 'Amanéa Voyage — Habibi Nora, travel planner éthique et créatrice de voyages sur mesure. Voyages de noces, au féminin, en groupe ou personnalisés. Île Maurice et partout dans le monde.';
$headExtra       = '<link rel="preload" as="image" href="' . APP_URL . '/public/images/hero-home.webp" fetchpriority="high">';
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<!-- =====================================================
     SECTION 1 — HERO
     ===================================================== -->

<section class="hero">

    <!-- Fallback image — toujours chargée, visible si la vidéo est absente ou désactivée -->
    <!-- alt="" + aria-hidden : image purement décorative, le contenu est dans hero__content -->
    <img src="<?= APP_URL ?>/public/images/hero-home.webp"
         alt=""
         class="hero__image"
         aria-hidden="true"
         fetchpriority="high"
         width="7360" height="4912">

    <!--
        Vidéo de fond — positionnée par-dessus l'image.
        poster  = même URL que l'image → servie depuis le cache navigateur, aucun octet supplémentaire.
        preload = none → éco-conception : rien chargé avant que l'autoplay démarre. (sauf sur 02switch trop lent)
        Le JS du footer cache .hero__video (classe is-hidden) si : réseau lent / saveData /
        prefers-reduced-motion / erreur de chargement → l'image fallback apparaît automatiquement.
    -->
    <video class="hero__video"
           autoplay
           muted
           playsinline
           preload="auto"
           poster="<?= APP_URL ?>/public/images/hero-home.webp"
           aria-hidden="true">
        <source src="<?= APP_URL ?>/public/videos/hero-home.webm" type="video/webm">
    </video>

    <!-- Overlay gradient -->
    <div class="hero__overlay"></div>

    <!-- Contenu -->
    <div class="hero__content">

        <p class="hero__label">Travel Planning · Éthique &amp; Sur Mesure</p>

        <h1 class="hero__title">
            <span class="hero__title--white">Voyagez autrement.</span>
            <span class="hero__title--terra">Voyagez Amanéa.</span>
        </h1>

        <div class="divider"></div>

        <p class="hero__subtitle">
            Créons des voyages sur mesure qui vous ressemblent: authentiques, responsables et inoubliables.
        </p>

        <a href="<?= APP_URL ?>/contact" class="btn-primary btn-lg">
            Créons votre voyage ensemble
        </a>

    </div>

    <!-- Indicateur scroll -->
    <div class="hero__scroll-indicator" aria-hidden="true">
        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="white" stroke-width="1.5" opacity="0.7">
            <polyline points="6 9 12 15 18 9" />
        </svg>
    </div>

</section>

<!-- =====================================================
     SECTION 2 — TRAVEL PLANNER
     ===================================================== -->

<section class="section section--beige" id="travel-planner">
    <div class="container">
        <div class="grid-2 grid-2--align-center">

            <!-- Texte gauche -->
            <div class="travel-planner__text">

                <p class="travel-planner__surtitle">La différence qui change tout</p>

                <h2 class="travel-planner__title">
                    Un travel planner,<br>c'est quoi exactement ?
                </h2>

                <div class="divider"></div>

                <p class="travel-planner__body">
                    Contrairement à une agence de voyage classique, un travel planner ne vend pas de catalogues. Habibi Nora écoute, comprend et co-crée avec vous un voyage unique, pensé dans les moindres détails autour de vos envies, votre rythme et vos valeurs.
                </p>

                <p class="travel-planner__body">
                    De la première conversation jusqu'au retour, vous êtes accompagné(e) à chaque étape. Aucun modèle standard, aucun voyage copié-collé — seulement votre voyage.
                </p>

                <blockquote class="travel-planner__quote">
                    « Je ne vends pas des destinations. Je crée des expériences qui vous appartiennent. »
                </blockquote>

                <a href="<?= APP_URL ?>/a-propos" class="travel-planner__link">
                    Découvrir la méthode Amanéa →
                </a>

            </div>

            <!-- Photo droite avec cadre arche -->
            <div class="travel-planner__photo-wrap">
                <div class="travel-planner__arch">
                    <img src="<?= APP_URL ?>/public/images/nora-portrait.webp"
                        alt="Habibi Nora, fondatrice d'Amanéa Voyage, souriante face à l'horizon"
                        class="travel-planner__photo"
                        loading="lazy"
                        width="942" height="2040">
                </div>
                <!-- Badge flottant -->
                <div class="travel-planner__badge">
                    <span>15 ans de voyages · Île Maurice · 3 continents visités</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =====================================================
     SECTION 3 — VALEURS
     ===================================================== -->

<section class="section section--white" id="valeurs">
    <div class="container">

        <h2 class="values__title">Ce qui nous différencie</h2>

        <div class="grid-5 values__grid">

            <!-- Valeur 1 -->
            <div class="card-value">
                <div class="card-value__icon" aria-hidden="true">
                    <svg width="40" height="40" fill="none" viewBox="0 0 40 40" stroke="#C58A60" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 6 C10 6, 6 12, 6 20 L6 34 L34 34 L34 20 C34 12, 30 6, 20 6 Z" />
                        <path d="M14 34 L14 24 C14 21.8 16.8 20 20 20 C23.2 20 26 21.8 26 24 L26 34" />
                        <circle cx="20" cy="15" r="3" />
                    </svg>
                </div>
                <h3 class="card-value__title">Sur-mesure intégral</h3>
                <p class="card-value__text">Chaque voyage est unique, construit autour de vous, jamais dupliqué</p>
            </div>

            <!-- Valeur 2 -->
            <div class="card-value">
                <div class="card-value__icon" aria-hidden="true">
                    <svg width="40" height="40" fill="none" viewBox="0 0 40 40" stroke="#C58A60" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <circle cx="20" cy="20" r="13" />
                        <path d="M20 11 L20 20 L26 23" />
                    </svg>
                </div>
                <h3 class="card-value__title">Accompagnement total</h3>
                <p class="card-value__text">De l'idée au retour, Nora reste disponible à chaque instant</p>
            </div>

            <!-- Valeur 3 -->
            <div class="card-value">
                <div class="card-value__icon" aria-hidden="true">
                    <svg width="40" height="40" fill="none" viewBox="0 0 40 40" stroke="#C58A60" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M20 7 L7 13 L7 22 C7 29 13 35 20 37 C27 35 33 29 33 22 L33 13 Z" />
                        <path d="M14 20 L18 24 L26 16" />
                    </svg>
                </div>
                <h3 class="card-value__title">Engagement éthique</h3>
                <p class="card-value__text">Tourisme responsable, partenaires locaux, respect des cultures</p>
            </div>

            <!-- Valeur 4 -->
            <div class="card-value">
                <div class="card-value__icon" aria-hidden="true">
                    <svg width="40" height="40" fill="none" viewBox="0 0 40 40" stroke="#C58A60" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <path d="M6 30 L14 18 L20 24 L26 14 L34 30" />
                        <path d="M6 34 L34 34" />
                    </svg>
                </div>
                <h3 class="card-value__title">Expertise terrain</h3>
                <p class="card-value__text">Une connaissance intime des destinations, validée sur le terrain</p>
            </div>

            <!-- Valeur 5 -->
            <div class="card-value">
                <div class="card-value__icon" aria-hidden="true">
                    <svg width="40" height="40" fill="none" viewBox="0 0 40 40" stroke="#C58A60" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round">
                        <rect x="5" y="13" width="30" height="20" rx="3" />
                        <path d="M5 19 L35 19" />
                        <rect x="24" y="22" width="8" height="7" rx="2" />
                        <circle cx="28" cy="25.5" r="1.2" fill="#C58A60" stroke="none" />
                        <path d="M10 24 L20 24" />
                        <path d="M10 28 L17 28" />
                    </svg>
                </div>
                <h3 class="card-value__title">Budget maîtrisé</h3>
                <p class="card-value__text">Nous concevons ensemble votre voyage en fonction de votre budget, sans surprise</p>
            </div>

        </div>
    </div>
</section>

<!-- =====================================================
     SECTION 4 — VOYAGES & EXPÉRIENCES
     ===================================================== -->

<section class="section section--beige" id="voyages">
    <div class="container">

        <!-- En-tête -->
        <div class="voyages__header">
            <p class="label">Votre voyage à votre façon</p>
            <h2 class="voyages__title">Voyages &amp; Expériences</h2>
            <p class="voyages__subtitle">
                Quatre façons de voyager avec Amanéa, chacune pensée pour un moment de vie particulier.
            </p>
        </div>

        <!-- Grille de cards -->
        <div class="grid-voyages">

            <?php foreach ($types as $type) : ?>
                <?php
                $badgeClass = match (true) {
                    str_contains($type['slug'], 'groupe')       => 'card-voyage__badge--groupe',
                    str_contains($type['slug'], 'feminin')      => 'card-voyage__badge--feminin',
                    str_contains($type['slug'], 'noces')        => 'card-voyage__badge--noces',
                    str_contains($type['slug'], 'personnalise') => 'card-voyage__badge--perso',
                    default                                     => 'card-voyage__badge--groupe',
                };
                ?>
                <article class="card-voyage">
                    <img src="<?= APP_URL ?>/public/images/<?= htmlspecialchars($type['file_name']) ?>"
                        alt="<?= htmlspecialchars($type['caption']) ?>"
                        class="card-voyage__image"
                        loading="lazy"
                        width="800" height="480">
                    <div class="card-voyage__overlay"></div>
                    <div class="card-voyage__content">
                        <span class="card-voyage__badge <?= $badgeClass ?>">
                            <?= htmlspecialchars($type['title']) ?>
                        </span>
                        <h3 class="card-voyage__title"><?= htmlspecialchars($type['title']) ?></h3>
                        <p class="card-voyage__text"><?= htmlspecialchars($type['description']) ?></p>
                        <a href="<?= APP_URL ?>/formules/show/<?= htmlspecialchars($type['slug']) ?>"
                            class="card-voyage__link"
                            aria-label="Explorer — <?= htmlspecialchars($type['title']) ?>">Explorer →</a>
                    </div>
                </article>
            <?php endforeach; ?>

        </div>

        <!-- CTA -->
        <div class="voyages__cta">
            <a href="<?= APP_URL ?>/voyages" class="btn-outline">Voir tous nos voyages</a>
        </div>

    </div>
</section>

<!-- =====================================================
     SECTION 5 — PROCESSUS
     ===================================================== -->

<section class="section section--dark" id="processus">
    <div class="container">

        <!-- Titre -->
        <div class="process__header">
            <h2 class="process__title">De l'idée à l'aventure</h2>
            <p class="process__subtitle">Un processus simple et rassurant, pensé pour vous</p>
        </div>

        <!-- Étapes -->
        <div class="process__grid">

            <div class="process__step">
                <span class="process__number">01</span>
                <h3 class="process__step-title">Nous imaginons votre voyage</h3>
                <p class="process__step-text">C’est souvent le moment que je préfère.
                    Vous me racontez ce qui vous fait rêver : paysages, cultures, rencontres, rythme du voyage… Nous évoquons aussi la durée et le budget afin de construire un projet cohérent.
                    À partir de là, je commence déjà à imaginer votre itinéraire.</p>
            </div>

            <div class="process__step">
                <span class="process__number">02</span>
                <h3 class="process__step-title"> Je conçois votre itinéraire</h3>
                <p class="process__step-text">Pendant plusieurs jours, je travaille sur votre voyage : je recherche, compare, sélectionne les hébergements et imagine les expériences qui donneront du sens à votre parcours.
                    Chaque étape est pensée pour créer un voyage fluide et équilibré.</p>
            </div>

            <div class="process__step">
                <span class="process__number">03</span>
                <h3 class="process__step-title">Nous affinons chaque détail</h3>
                <p class="process__step-text">Je vous présente l’itinéraire en détail.
                    Nous échangeons sur chaque étape et ajustons si nécessaire : modifier une étape, ajouter une expérience ou adapter le rythme du voyage.
                    Le projet se construit toujours en collaboration.</p>
            </div>

            <div class="process__step">
                <span class="process__number">04</span>
                <h3 class="process__step-title"> Votre voyage prend vie, Vous partez serein(e)</h3>
                <p class="process__step-text">Vous recevez votre carnet de voyage personnalisé et un accès à votre espace client avec toutes les informations nécessaires pour préparer votre départ sereinement : itinéraire détaillé, hébergements, conseils et liens utiles.</p>
            </div>

        </div>

        <!-- CTA -->
        <div class="process__cta">
            <a href="<?= APP_URL ?>/contact" class="btn-primary btn-lg">Créons votre voyage</a>
        </div>

    </div>
</section>

<!-- =====================================================
     SECTION 6 — INSPIRATIONS & CONSEILS
     ===================================================== -->

<section class="section section--white" id="blog">
    <div class="container">

        <!-- En-tête -->
        <div class="blog__header">
            <div class="blog__header-text">
                <h2 class="blog__title">Inspirations &amp; Conseils</h2>
                <p class="blog__subtitle">Les carnets de voyage de Nora : Découvrez les destinations, conseils, actualités, inspirations et coups de cœur de votre créatrice de voyage</p>
            </div>
            <a href="<?= APP_URL ?>/inspirations" class="blog__link">Voir tous les articles →</a>
        </div>

        <!-- Cards articles -->
        <div class="grid-3">

            <?php if (!empty($articles)) : ?>
                <?php foreach ($articles as $article) : ?>
                    <article class="card-article">
                        <div class="card-article__image-wrap">
                            <?php if (!empty($article['file_name'])) : ?>
                                <img src="<?= APP_URL . '/public/images/articles/' . htmlspecialchars($article['file_name']) ?>"
                                    alt="<?= htmlspecialchars($article['title']) ?>"
                                    class="card-article__image"
                                    loading="lazy"
                                    width="800" height="240">
                            <?php else : ?>
                                <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                                    alt=""
                                    class="card-article__image card-article__image--loading"
                                    data-pexels-keyword="<?= htmlspecialchars(
                                        !empty($article['article_pexels_keyword'])      ? $article['article_pexels_keyword']
                                        : (!empty($article['destination_pexels_keyword']) ? $article['destination_pexels_keyword']
                                        : trim(($article['category_name'] ?? 'voyage') . ' voyage'))
                                    ) ?>"
                                    data-article-id="<?= (int)$article['Id_ARTICLE'] ?>"
                                    width="800" height="240">
                            <?php endif; ?>
                        </div>
                        <div class="card-article__content">
                            <?php
                            $tagClass = match (true) {
                                str_contains($article['category_slug'] ?? '', 'destination')  => 'card-article__tag--destination',
                                str_contains($article['category_slug'] ?? '', 'inspiration')  => 'card-article__tag--inspiration',
                                str_contains($article['category_slug'] ?? '', 'conseil')      => 'card-article__tag--conseil',
                                str_contains($article['category_slug'] ?? '', 'coup')         => 'card-article__tag--coup-de-coeur',
                                str_contains($article['category_slug'] ?? '', 'actualite')    => 'card-article__tag--actualite',
                                str_contains($article['category_slug'] ?? '', 'experience')   => 'card-article__tag--experience',
                                default                                                        => '',
                            };
                            ?>
                            <span class="card-article__tag <?= $tagClass ?>"><?= htmlspecialchars($article['category_name'] ?? 'Article') ?></span>
                            <h3 class="card-article__title"><?= htmlspecialchars($article['title']) ?></h3>
                            <p class="card-article__excerpt"><?= htmlspecialchars(substr($article['content'] ?? '', 0, 200)) ?>…</p>
                            <a href="<?= APP_URL ?>/inspirations/show/<?= htmlspecialchars($article['slug']) ?>"
                                class="card-article__link"
                                aria-label="Lire l'article : <?= htmlspecialchars($article['title']) ?>">Lire l'article →</a>
                        </div>
                    </article>
                <?php endforeach; ?>
            <?php else : ?>
                <p class="blog__empty">Les articles arrivent bientôt.</p>
            <?php endif; ?>

        </div>

    </div>
</section>

<!-- =====================================================
     SECTION 7 — FAQ
     ===================================================== -->

<section class="section section--beige" id="faq">
    <div class="container">
        <div class="faq__wrap">

            <h2 class="faq__title">Questions fréquentes</h2>
            <p class="faq__subtitle">Tout ce que vous voulez savoir avant de nous écrire</p>

            <div class="faq__list">

                <div class="faq__item">
                    <button class="faq__question" aria-expanded="false" aria-controls="faq-answer-1">
                        <span>Quelle est la différence entre un travel planner et une agence de voyage ?</span>
                        <svg class="faq__chevron" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#C58A60" stroke-width="1.5" aria-hidden="true">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>
                    <div class="faq__answer" id="faq-answer-1">
                        <p>Une agence de voyage vend directement des prestations touristiques comme des vols, des hôtels ou des circuits organisés.
                            Le travel planner accompagne le voyageur dans la conception de son itinéraire. Son rôle est d’écouter les envies, de comprendre le budget, de proposer un parcours cohérent et de partager son expertise pour construire un voyage véritablement sur mesure.
                            Le voyage devient ainsi une expérience pensée dans les moindres détails, adaptée au rythme et aux attentes de chacun.
                        </p>
                    </div>
                </div>

                <div class="faq__item">
                    <button class="faq__question" aria-expanded="false" aria-controls="faq-answer-2">
                        <span>Pourquoi faire appel à un travel planner communément appelée créatrice de voyage ?</span>
                        <svg class="faq__chevron" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#C58A60" stroke-width="1.5" aria-hidden="true">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>
                    <div class="faq__answer" id="faq-answer-2">
                        <p>Aujourd’hui, organiser un voyage peut rapidement devenir complexe. Les informations disponibles en ligne sont nombreuses, parfois contradictoires, et il est souvent difficile d’évaluer la fiabilité des recommandations.
                            Le travel planner permet de transformer cette phase de recherche en un accompagnement structuré. Grâce à son expérience et à son réseau de partenaires locaux, il construit un itinéraire cohérent, adapté aux saisons, aux distances et aux expériences que le voyageur souhaite vivre.
                            L’objectif est simple : permettre aux voyageurs de se concentrer sur l’essentiel, l’expérience du voyage.
                        </p>
                    </div>
                </div>

                <div class="faq__item">
                    <button class="faq__question" aria-expanded="false" aria-controls="faq-answer-3">
                        <span>Combien coûte un travel planner ?</span>
                        <svg class="faq__chevron" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#C58A60" stroke-width="1.5" aria-hidden="true">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>
                    <div class="faq__answer" id="faq-answer-3">
                        <p>Le coût d’un travel planner dépend généralement du niveau d’accompagnement proposé et de la complexité du voyage.
                            Chez Amanéa, l’approche est volontairement simple et transparente. Plutôt que de proposer des forfaits standardisés, chaque projet de voyage commence par une discussion approfondie afin de définir les envies, les priorités et surtout un budget réaliste.
                            À partir de ces éléments, l’itinéraire est construit de manière cohérente afin que chaque expérience s’inscrive naturellement dans l’enveloppe prévue.
                            Dans le devis global du voyage, une ligne dédiée à la planification du voyage apparaît clairement. Elle correspond au travail de conception, de recherche et de coordination nécessaire pour créer un itinéraire sur mesure.
                            Cette approche permet d’intégrer la planification directement dans le budget global du voyage, sans générer de surcoût inattendu pour le voyageur.
                        </p>
                    </div>
                </div>

                <div class="faq__item">
                    <button class="faq__question" aria-expanded="false" aria-controls="faq-answer-4">
                        <span>Est-ce que faire appel à un travel planner coûte plus cher qu’une agence de voyage ?</span>
                        <svg class="faq__chevron" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#C58A60" stroke-width="1.5" aria-hidden="true">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>
                    <div class="faq__answer" id="faq-answer-4">
                        <p>Un voyage sur mesure n’est pas une question de prix, mais d’expérience.
                            Lorsque l’on imagine un itinéraire avec un travel planner, l’objectif n’est pas de choisir un catalogue d’offres toutes faites. Il s’agit plutôt de construire un voyage qui correspond réellement à une envie, à un moment de vie, à une manière particulière de découvrir le monde.
                            Certaines personnes rêvent de naviguer doucement sur le Nil à bord d’une dahabieh traditionnelle, d’autres d’explorer les paysages sauvages de Madagascar ou de s’éveiller au lever du soleil face à une réserve africaine.
                            Le rôle du travel planner est justement de transformer ces envies en un voyage cohérent et profondément personnel.
                            Parce qu’un voyage sur mesure n’est pas un produit standard : c’est une expérience qui se construit autour de ceux qui la vivent.
                        </p>
                    </div>
                </div>

                <div class="faq__item">
                    <button class="faq__question" aria-expanded="false" aria-controls="faq-answer-5">
                        <span>Pour quels types de voyages faire appel à une créatrice de voyage ?</span>
                        <svg class="faq__chevron" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#C58A60" stroke-width="1.5" aria-hidden="true">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>
                    <div class="faq__answer" id="faq-answer-5">
                        <p>Le travel planner est particulièrement pertinent lorsque les voyageurs souhaitent créer une expérience personnalisée : un voyage de noces, un itinéraire immersif, un circuit sur plusieurs pays ou régions ou encore la découverte de destinations moins connues.
                            Dans ces situations, l’expertise d’un professionnel permet de construire un parcours équilibré et de révéler des expériences souvent difficiles à identifier seul.
                        </p>
                    </div>
                </div>

                <div class="faq__item">
                    <button class="faq__question" aria-expanded="false" aria-controls="faq-answer-6">
                        <span>Puis-je modifier mon voyage une fois la conception lancée ?</span>
                        <svg class="faq__chevron" width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="#C58A60" stroke-width="1.5" aria-hidden="true">
                            <polyline points="6 9 12 15 18 9" />
                        </svg>
                    </button>
                    <div class="faq__answer" id="faq-answer-6">
                        <p>Absolument. La validation se fait en plusieurs allers-retours jusqu’à 2 afin vous soyez totalement satisfait(e).</p>
                    </div>
                </div>

            </div>
        </div>
    </div>
</section>

<!-- =====================================================
     SECTION 8 — CTA FINAL
     ===================================================== -->

<section class="cta-final" id="contact">

    <img src="<?= APP_URL ?>/public/images/cta-aerial.webp"
        alt="Vue aérienne d'une île tropicale entourée d'un océan turquoise"
        class="cta-final__image"
        loading="lazy"
        width="4020" height="3015">

    <div class="cta-final__overlay"></div>

    <div class="cta-final__content">
        <p class="cta-final__label">Votre voyage commence ici</p>
        <h2 class="cta-final__title">Parlons de votre projet</h2>
        <p class="cta-final__text">
            Un échange découverte gratuit, sans engagement. 30 minutes pour co-créer quelque chose d'unique.
        </p>
        <div class="cta-final__buttons">
            <a href="<?= APP_URL ?>/contact" class="btn-primary btn-lg">Créons votre voyage</a>
            <a href="<?= APP_URL ?>/voyages" class="btn-ghost btn-lg">Découvrir nos voyages</a>
        </div>
    </div>

</section>

<!-- JavaScript FAQ accordéon -->
<script>
    document.querySelectorAll('.faq__question').forEach(function(btn) {
        btn.addEventListener('click', function() {
            const item = this.closest('.faq__item');
            const answer = item.querySelector('.faq__answer');
            const isOpen = item.classList.contains('faq__item--open');

            // Ferme tous les items
            document.querySelectorAll('.faq__item').forEach(function(el) {
                el.classList.remove('faq__item--open');
                el.querySelector('.faq__question').setAttribute('aria-expanded', 'false');
            });

            // Ouvre le courant si fermé
            if (!isOpen) {
                item.classList.add('faq__item--open');
                this.setAttribute('aria-expanded', 'true');
            }
        });
    });

    // Chargement asynchrone des images Pexels
    document.querySelectorAll('img[data-pexels-keyword]').forEach(function (img) {
        var keyword = img.dataset.pexelsKeyword;
        var seed    = img.dataset.articleId || '0';
        fetch('<?= APP_URL ?>/api/pexels-photo?keyword=' + encodeURIComponent(keyword) + '&seed=' + encodeURIComponent(seed))
            .then(function (res) { return res.json(); })
            .then(function (data) {
                if (data.url) {
                    img.src = data.url;
                    img.classList.remove('card-article__image--loading');
                }
            })
            .catch(function () { /* silencieux si l'API est indisponible */ });
    });
</script>

<!-- Schema.org JSON-LD — TravelAgency + FAQPage -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "TravelAgency",
            "name": "Amanéa Voyage",
            "description": "Travel planner éthique et créatrice de voyages sur mesure. Voyages de noces, au féminin, en groupe ou personnalisés.",
            "url": "<?= APP_URL ?>",
            "email": "contact@amaneavoyage.fr",
            "founder": {
                "@type": "Person",
                "name": "Habibi Nora"
            },
            "areaServed": "World",
            "sameAs": [
                "https://www.instagram.com/amanea_voyage/",
                "https://www.facebook.com/Amanea.voyage"
            ]
        },
        {
            "@type": "FAQPage",
            "mainEntity": [
                {
                    "@type": "Question",
                    "name": "Quelle est la différence entre un travel planner et une agence de voyage ?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Une agence de voyage vend directement des prestations touristiques comme des vols, des hôtels ou des circuits organisés. Le travel planner accompagne le voyageur dans la conception de son itinéraire, en écoutant les envies, comprenant le budget et proposant un parcours sur mesure adapté au rythme et aux attentes de chacun."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Pourquoi faire appel à un travel planner communément appelée créatrice de voyage ?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Le travel planner transforme la phase de recherche en un accompagnement structuré. Grâce à son expérience et à son réseau de partenaires locaux, il construit un itinéraire cohérent, adapté aux saisons, aux distances et aux expériences souhaitées. L'objectif : permettre aux voyageurs de se concentrer sur l'essentiel — l'expérience du voyage."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Combien coûte un travel planner ?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Chez Amanéa, l'approche est simple et transparente. Chaque projet commence par une discussion approfondie sur les envies, priorités et budget. Une ligne dédiée à la planification apparaît clairement dans le devis global du voyage, sans surcoût inattendu."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Est-ce que faire appel à un travel planner coûte plus cher qu'une agence de voyage ?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Un voyage sur mesure n'est pas une question de prix, mais d'expérience. Le travel planner construit un voyage qui correspond réellement à une envie, à un moment de vie, de manière cohérente et profondément personnelle."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Pour quels types de voyages faire appel à une créatrice de voyage ?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Le travel planner est particulièrement pertinent pour les voyages de noces, itinéraires immersifs, circuits sur plusieurs pays ou la découverte de destinations moins connues. L'expertise d'un professionnel permet de construire un parcours équilibré et de révéler des expériences difficiles à identifier seul."
                    }
                },
                {
                    "@type": "Question",
                    "name": "Puis-je modifier mon voyage une fois la conception lancée ?",
                    "acceptedAnswer": {
                        "@type": "Answer",
                        "text": "Absolument. La validation se fait en plusieurs allers-retours jusqu'à 2 afin que vous soyez totalement satisfait(e)."
                    }
                }
            ]
        }
    ]
}
</script>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>