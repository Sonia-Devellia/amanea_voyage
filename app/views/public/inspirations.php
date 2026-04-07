<?php
$pageTitle       = 'Blog Voyage : Destinations, Conseils & Carnets de Nora';
$metaDescription = 'Explorez les carnets de voyage de Habibi Nora : destinations éthiques, conseils pratiques et coups de cœur pour préparer votre voyage sur mesure — Île Maurice, Afrique et partout dans le monde.';
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<!-- =====================================================
     HERO — Fond sombre avec stats
     ===================================================== -->

<section class="inspi-hero">

    <div class="container">
        <div class="inspi-hero__content">

            <p class="inspi-hero__label">Les petits carnets de Nora</p>

            <h1 class="inspi-hero__title">
                <span class="inspi-hero__title--white">Inspirations</span>
                <span class="inspi-hero__title--terra">&amp; Conseils</span>
            </h1>

            <div class="inspi-hero__intro">
                <div class="divider" aria-hidden="true"></div>
                <p class="inspi-hero__subtitle">
                    Destinations, récits de voyage, conseils pratiques - Les carnets de voyage de Nora pour vous inspirer et vous guider dans votre future destination.
                </p>
            </div>

            <!-- Stats -->
            <div class="inspi-hero__stats">
                <div class="inspi-hero__stat">
                    <span class="inspi-hero__stat-value"><?= ($totalItems ?? count($articles)) + 1 ?></span>
                    <span class="inspi-hero__stat-label">Articles</span>
                </div>
                <div class="inspi-hero__stat">
                    <span class="inspi-hero__stat-value"><?= count($categories) ?></span>
                    <span class="inspi-hero__stat-label">Catégories</span>
                </div>
                <div class="inspi-hero__stat">
                    <span class="inspi-hero__stat-value"><?= count($destinations) ?>+</span>
                    <span class="inspi-hero__stat-label">Destinations à découvrir</span>
                </div>
            </div>

        </div>
    </div>
</section>

<!-- =====================================================
     ARTICLE À LA UNE
     ===================================================== -->

<?php if (!empty($featured)) : ?>
<section class="section section--white">
    <div class="container">
        <article class="inspi-featured">

            <div class="inspi-featured__image-wrap">
                <?php if (!empty($featured['file_name'])) : ?>
                    <img src="<?= APP_URL . '/public/images/articles/' . htmlspecialchars($featured['file_name']) ?>"
                         alt="<?= htmlspecialchars($featured['title']) ?>"
                         class="inspi-featured__image"
                         fetchpriority="high"
                         width="800" height="480">
                <?php else : ?>
                    <img src="data:image/gif;base64,R0lGODlhAQABAIAAAAAAAP///yH5BAEAAAAALAAAAAABAAEAAAIBRAA7"
                         alt=""
                         class="inspi-featured__image card-article__image--loading"
                         data-pexels-keyword="<?= htmlspecialchars(
                             !empty($featured['article_pexels_keyword'])      ? $featured['article_pexels_keyword']
                             : (!empty($featured['destination_pexels_keyword']) ? $featured['destination_pexels_keyword']
                             : trim(($featured['category_name'] ?? 'voyage') . ' voyage'))
                         ) ?>"
                         data-article-id="<?= (int)$featured['Id_ARTICLE'] ?>"
                         width="800" height="480">
                <?php endif; ?>
            </div>

            <div class="inspi-featured__content">

                <div class="inspi-featured__meta-top">
                    <span class="inspi-featured__label">Article à la une</span>
                    <span class="inspi-featured__line" aria-hidden="true"></span>
                </div>

                <?php
                $featuredTagClass = match(true) {
                    str_contains($featured['category_slug'] ?? '', 'destination')  => 'card-article__tag--destination',
                    str_contains($featured['category_slug'] ?? '', 'inspiration')  => 'card-article__tag--inspiration',
                    str_contains($featured['category_slug'] ?? '', 'conseil')      => 'card-article__tag--conseil',
                    str_contains($featured['category_slug'] ?? '', 'coup')         => 'card-article__tag--coup-de-coeur',
                    str_contains($featured['category_slug'] ?? '', 'actualite')    => 'card-article__tag--actualite',
                    str_contains($featured['category_slug'] ?? '', 'experience')   => 'card-article__tag--experience',
                    default => '',
                };
                ?>
                <span class="card-article__tag <?= $featuredTagClass ?>"><?= htmlspecialchars($featured['category_name'] ?? 'Article') ?></span>

                <h2 class="inspi-featured__title">
                    <?= htmlspecialchars($featured['title']) ?>
                </h2>

                <p class="inspi-featured__excerpt">
                    <?= htmlspecialchars(substr($featured['content'] ?? '', 0, 300)) ?>…
                </p>

                <div class="inspi-featured__author">
                    <div class="inspi-featured__author-icon" aria-hidden="true">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="#C58A60" stroke-width="1.5">
                            <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                            <circle cx="12" cy="7" r="4"/>
                        </svg>
                    </div>
                    <div class="inspi-featured__author-info">
                        <span class="inspi-featured__author-name">Habibi Nora</span>
                        <span class="inspi-featured__author-date">
                            <?= date('d M Y', strtotime($featured['publication_date'])) ?>
                        </span>
                    </div>
                </div>

                <a href="<?= APP_URL ?>/inspirations/show/<?= htmlspecialchars($featured['slug']) ?>"
                   class="btn-primary btn-lg"
                   aria-label="Lire l'article : <?= htmlspecialchars($featured['title']) ?>">
                    Lire l'article →
                </a>

            </div>
        </article>
    </div>
</section>
<?php endif; ?>

<!-- =====================================================
     FILTRES + GRILLE D'ARTICLES
     ===================================================== -->

<section class="section section--beige" id="articles">
    <div class="container">

        <div class="inspi-grid__header">
            <div class="inspi-grid__header-text">
                <p class="label">Tous les articles</p>
                <h2 class="inspi-grid__title">Explorer par catégorie</h2>
            </div>

            <nav class="inspi-filters" aria-label="Filtrer par catégorie">
                <a href="<?= APP_URL ?>/inspirations"
                   class="inspi-filter <?= empty($currentCategory) ? 'inspi-filter--active' : '' ?>"
                   <?= empty($currentCategory) ? 'aria-current="page"' : '' ?>>
                    Tous
                </a>
                <?php foreach ($categories as $cat) : ?>
                <a href="<?= APP_URL ?>/inspirations/category/<?= htmlspecialchars($cat['slug']) ?>"
                   class="inspi-filter inspi-filter--<?= htmlspecialchars($cat['slug']) ?> <?= ($currentCategory === $cat['slug']) ? 'inspi-filter--active' : '' ?>"
                   <?= ($currentCategory === $cat['slug']) ? 'aria-current="page"' : '' ?>>
                    <?= htmlspecialchars($cat['name']) ?>
                </a>
                <?php endforeach; ?>
            </nav>
        </div>

        <?php if (!empty($articles)) : ?>
        <div class="grid-3">
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
                    <div class="card-article__meta">
                        <?php
                        $tagClass = match(true) {
                            str_contains($article['category_slug'] ?? '', 'destination')  => 'card-article__tag--destination',
                            str_contains($article['category_slug'] ?? '', 'inspiration')  => 'card-article__tag--inspiration',
                            str_contains($article['category_slug'] ?? '', 'conseil')      => 'card-article__tag--conseil',
                            str_contains($article['category_slug'] ?? '', 'coup')          => 'card-article__tag--coup-de-coeur',
                            str_contains($article['category_slug'] ?? '', 'actualite')    => 'card-article__tag--actualite',
                            str_contains($article['category_slug'] ?? '', 'experience')   => 'card-article__tag--experience',
                            default => '',
                        };
                        ?>
                        <span class="card-article__tag <?= $tagClass ?>"><?= htmlspecialchars($article['category_name'] ?? 'Article') ?></span>
                        <span class="card-article__date">
                            <?= date('d M Y', strtotime($article['publication_date'])) ?>
                        </span>
                    </div>
                    <h3 class="card-article__title"><?= htmlspecialchars($article['title']) ?></h3>
                    <p class="card-article__excerpt">
                        <?= htmlspecialchars(substr($article['content'] ?? '', 0, 120)) ?>…
                    </p>
                    <a href="<?= APP_URL ?>/inspirations/show/<?= htmlspecialchars($article['slug']) ?>"
                       class="card-article__link"
                       aria-label="Lire l'article : <?= htmlspecialchars($article['title']) ?>">Lire l'article →</a>
                </div>
            </article>
            <?php endforeach; ?>
        </div>
        <?php else : ?>
        <div class="inspi-empty">
            <p>Aucun article dans cette catégorie pour le moment.</p>
        </div>
        <?php endif; ?>

        <!-- Pagination -->
        <?php if ($totalPages > 1) : ?>
        <nav class="pagination" aria-label="Navigation des articles">

            <!-- Précédent -->
            <?php if ($currentPage > 1) : ?>
            <a href="<?= APP_URL ?>/inspirations?page=<?= $currentPage - 1 ?>#articles"
               class="pagination__btn pagination__btn--prev"
               aria-label="Page précédente">
                ← Précédent
            </a>
            <?php endif; ?>

            <!-- Numéros de pages -->
            <div class="pagination__pages">
                <?php for ($i = 1; $i <= $totalPages; $i++) : ?>
                <a href="<?= APP_URL ?>/inspirations?page=<?= $i ?>#articles"
                   class="pagination__page <?= $i === $currentPage ? 'pagination__page--active' : '' ?>"
                   aria-label="Page <?= $i ?>"
                   <?= $i === $currentPage ? 'aria-current="page"' : '' ?>>
                    <?= $i ?>
                </a>
                <?php endfor; ?>
            </div>

            <!-- Suivant -->
            <?php if ($currentPage < $totalPages) : ?>
            <a href="<?= APP_URL ?>/inspirations?page=<?= $currentPage + 1 ?>#articles"
               class="pagination__btn pagination__btn--next"
               aria-label="Page suivante">
                Suivant →
            </a>
            <?php endif; ?>

        </nav>
        <?php endif; ?>

    </div>
</section>

<!-- =====================================================
     NEWSLETTER
     ===================================================== -->

<section class="inspi-newsletter">

    <div class="container">
        <div class="inspi-newsletter__content">

            <p class="inspi-newsletter__label">La lettre de Nora</p>
            <h2 class="inspi-newsletter__title">Ne manquez aucune inspiration</h2>
            <p class="inspi-newsletter__text">
                Chaque mois, les meilleures adresses, les destinations à découvrir et les conseils de Nora. Directement dans votre boîte mail.
            </p>

            <form class="inspi-newsletter__form" method="POST" action="<?= APP_URL ?>/contact/send">
                <input type="hidden" name="type" value="newsletter">
                <input type="email"
                       name="email"
                       class="inspi-newsletter__input"
                       placeholder="  indiquez-votre@email.fr  "
                       aria-label="Votre adresse email"
                       required>
                <button type="submit" class="btn-primary">S'abonner</button>
            </form>

            <p class="inspi-newsletter__mention">Pas de spam. Désinscription possible à tout moment.</p>

        </div>
    </div>
</section>

<!-- =====================================================
     CTA FINAL
     ===================================================== -->

<section class="section section--beige">
    <div class="container">
        <div class="inspi-cta">
            <h3 class="inspi-cta__title">Prêt(e) à vivre votre propre aventure ?</h3>
            <p class="inspi-cta__text">
                Toutes ces destinations n'attendent que vous. Parlons de votre prochain voyage.
            </p>
            <div class="inspi-cta__buttons">
                <a href="<?= APP_URL ?>/contact" class="btn-primary btn-lg">Créons votre voyage</a>
                <a href="<?= APP_URL ?>/voyages" class="btn-outline btn-lg">Voir nos voyages</a>
            </div>
        </div>
    </div>
</section>

<script>
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

<!-- Schema.org JSON-LD — Blog + BreadcrumbList -->
<script type="application/ld+json">
{
    "@context": "https://schema.org",
    "@graph": [
        {
            "@type": "Blog",
            "name": "Inspirations & Conseils — Les carnets de Nora",
            "description": "Destinations éthiques, conseils pratiques et coups de cœur pour préparer un voyage sur mesure — par Habibi Nora, travel planner.",
            "url": "<?= APP_URL ?>/inspirations",
            "inLanguage": "fr-FR",
            "author": {
                "@type": "Person",
                "name": "Habibi Nora"
            },
            "publisher": {
                "@type": "Organization",
                "name": "Amanéa Voyage",
                "url": "<?= APP_URL ?>"
            }
        },
        {
            "@type": "BreadcrumbList",
            "itemListElement": [
                {
                    "@type": "ListItem",
                    "position": 1,
                    "name": "Accueil",
                    "item": "<?= APP_URL ?>"
                },
                {
                    "@type": "ListItem",
                    "position": 2,
                    "name": "Inspirations & Conseils",
                    "item": "<?= APP_URL ?>/inspirations"
                }
            ]
        }
    ]
}
</script>

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>