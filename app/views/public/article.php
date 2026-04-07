<?php
require_once APP_ROOT . '/app/views/layouts/header.php';
?>

<!-- =====================================================
     HERO — Photo principale + titre
     ===================================================== -->

<section class="article-hero">

    <div class="article-hero__content">

        <!-- Fil d'Ariane -->
        <nav class="article-hero__breadcrumb" aria-label="Fil d'Ariane">
            <a href="<?= APP_URL ?>/inspirations" class="article-hero__breadcrumb-link">
                 Inspirations &amp; Conseils
            </a>
            <span class="article-hero__breadcrumb-sep" aria-hidden="true"></span>
        </nav>

        <!-- Badge catégorie + destination -->
        <div class="article-hero__badges">
            <span class="card-article__tag">
                <?= htmlspecialchars($article['category_name'] ?? 'Article') ?>
            </span>

            <?php if (!empty($article['destination_name'])) : ?>
            <div class="article-hero__destination">
                <svg width="17" height="17" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" aria-hidden="true">
                    <path d="M21 10c0 7-9 13-9 13s-9-6-9-13a9 9 0 0 1 18 0z"/>
                    <circle cx="12" cy="10" r="3"/>
                </svg>
                <?= htmlspecialchars($article['destination_name']) ?>
            </div>
            <?php endif; ?>
        </div>

        <!-- Titre -->
        <h1 class="article-hero__title">
            <?= htmlspecialchars($article['title']) ?>
        </h1>

        <!-- Meta auteur + date -->
        <div class="article-hero__meta">
            <div class="article-hero__author">
                <div>
                    <span class="article-hero__author-name">Par Habibi Nora</span>
                    <span class="article-hero__author-date"> Le :
                        <?= date('d M Y', strtotime($article['publication_date'])) ?>
                    </span>
                </div>
            </div>
        </div>

    </div>

</section>

<!-- =====================================================
     CONTENU DE L'ARTICLE
     ===================================================== -->

<section class="section section--white">
    <div class="container">

        <?php
        // Image de couverture : BDD si dispo, sinon Pexels large2x, sinon placeholder
        if (!empty($cover['file_name'])) {
            $coverSrc    = APP_URL . '/public/images/' . $cover['file_name'];
            $coverSrcset = null;
        } elseif (!empty($pexelsHero)) {
            $coverSrc    = $pexelsHero['src'];
            $coverSrcset = $pexelsHero['srcset'];
        } else {
            $coverSrc    = APP_URL . '/public/images/placeholderegypt.jpg';
            $coverSrcset = null;
        }
        ?>

        <div class="article-cover">
            <img src="<?= htmlspecialchars($coverSrc) ?>"
                 <?php if ($coverSrcset) : ?>
                 srcset="<?= htmlspecialchars($coverSrcset) ?>"
                 sizes="(max-width: 768px) 100vw, 90vw"
                 <?php endif; ?>
                 alt="<?= htmlspecialchars($article['title']) ?>"
                 class="article-cover__image"
                 fetchpriority="high"
                 decoding="async">
        </div>

        <div class="article-body">

            <!-- Contenu principal -->
            <div class="article-body__text">
                <?php
                // On convertit les \n en paragraphes HTML
                $paragraphs = array_filter(
                    explode("\n\n", $article['content'] ?? ''),
                    fn($p) => trim($p) !== ''
                );
                foreach ($paragraphs as $paragraph) :
                ?>
                <p><?= nl2br(htmlspecialchars(trim($paragraph))) ?></p>
                <?php endforeach; ?>
            </div>

            <!-- Sidebar -->
            <aside class="article-body__sidebar">

                <!-- Destination liée -->
                <?php if (!empty($article['destination_name'])) : ?>
                <div class="article-sidebar__block">
                    <h3 class="article-sidebar__title">Destination</h3>
                    <p class="article-sidebar__value">
                        <?= htmlspecialchars($article['destination_name']) ?>
                    </p>
                    <p class="article-sidebar__country">
                        <?= htmlspecialchars($article['country'] ?? '') ?>
                    </p>
                </div>
                <?php endif; ?>

                <!-- CTA sidebar -->
                <div class="article-sidebar__cta">
                    <p class="article-sidebar__cta-text">
                        Ce voyage vous inspire ?
                    </p>
                    <a href="<?= APP_URL ?>/contact" class="btn-primary">
                        Créons votre voyage 
                    </a>
                </div>

                <!-- Partager -->
                <div class="article-sidebar__block">
                    <h3 class="article-sidebar__title">Partager</h3>
                    <div class="article-sidebar__share">
                        <a href="https://www.facebook.com/sharer/sharer.php?u=<?= urlencode(APP_URL . '/inspirations/show/' . $article['slug']) ?>"
                           class="article-sidebar__share-link"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="Partager sur Facebook">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                            </svg>
                            Facebook
                        </a>
                        <a href="https://www.instagram.com/"
                           class="article-sidebar__share-link"
                           target="_blank"
                           rel="noopener noreferrer"
                           aria-label="Partager sur Instagram">
                            <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                                <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                                <circle cx="12" cy="12" r="4"/>
                                <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/>
                            </svg>
                            Instagram
                        </a>
                    </div>
                </div>

            </aside>
        </div>
    </div>
</section>

<!-- =====================================================
     MOSAÏQUE DE PHOTOS — 5 photos Pexels
     ===================================================== -->

<?php if (!empty($gallery)) : ?>
<section class="section section--beige">
    <div class="container">

        <div class="section-header">
            <p class="section-header__label">Galerie</p>
            <h2 class="section-header__title">En images</h2>
        </div>

        <div class="article-gallery">
            <?php foreach ($gallery as $i => $photoUrl) : ?>
            <div class="article-gallery__item article-gallery__item--<?= $i + 1 ?>">
                <img src="<?= htmlspecialchars($photoUrl) ?>"
                     alt="Illustration de l'article : <?= htmlspecialchars($article['title']) ?>"
                     class="article-gallery__image"
                     loading="lazy">
            </div>
            <?php endforeach; ?>
        </div>

    </div>
</section>
<?php endif; ?>

<!-- =====================================================
     CTA FINAL
     ===================================================== -->

<section class="cta-final" id="contact">

    <img src="<?= APP_URL ?>/public/images/cta-aerial2.webp"
         alt="Vue aérienne île maurice entourée d'un océan turquoise"
         class="cta-final__image">

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

<?php require_once APP_ROOT . '/app/views/layouts/footer.php'; ?>