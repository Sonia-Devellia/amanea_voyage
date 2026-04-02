<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' — Amanéa Voyage' : 'Amanéa Voyage' ?></title>
    <meta name="description" content="<?= isset($metaDescription) ? htmlspecialchars($metaDescription) : 'Amanéa Voyage — Création de voyage éthique et sur mesure par Habibi Nora.' ?>">
    <link rel="stylesheet" href="<?= APP_URL ?>/public/css/main.css">
    <link rel="canonical" href="<?= APP_URL . strtok($_SERVER['REQUEST_URI'], '?') ?>">
    <link rel="icon" href="<?= APP_URL ?>/public/images/favicon.ico">
    <link rel="apple-touch-icon" href="<?= APP_URL ?>/public/images/apple-touch-icon.png">
    <!-- Open Graph -->
    <meta property="og:type"        content="website">
    <meta property="og:locale"      content="fr_FR">
    <meta property="og:site_name"   content="Amanéa Voyage">
    <meta property="og:title"       content="<?= isset($pageTitle) ? htmlspecialchars($pageTitle) . ' — Amanéa Voyage' : 'Amanéa Voyage' ?>">
    <meta property="og:description" content="<?= isset($metaDescription) ? htmlspecialchars($metaDescription) : 'Amanéa Voyage — Création de voyage éthique et sur mesure par Habibi Nora.' ?>">
    <meta property="og:url"         content="<?= APP_URL . strtok($_SERVER['REQUEST_URI'], '?') ?>">
    <meta property="og:image"       content="<?= APP_URL ?>/public/images/og-default.jpg">
    <meta name="theme-color"        content="#4A3C32">
</head>
<body>


<!-- =====================================================
     HEADER
     - Transparent sur le hero
     - Fond blanc au scroll (.header--scrolled via JS)
     ===================================================== -->

<header class="header" id="header">

    <!-- Zone gauche : burger + MENU -->
    <div class="header__left">
        <button class="header__burger" id="burgerBtn"
                aria-label="Ouvrir le menu"
                aria-expanded="false"
                aria-controls="drawer">
            <span class="header__burger-line"></span>
            <span class="header__burger-line"></span>
            <span class="header__burger-line"></span>
        </button>
        <span class="header__burger-label" aria-hidden="true">Menu</span>
    </div>

    <!-- Zone centre : 2 liens nav -->
    <nav class="header__nav" aria-label="Navigation principale">
        <a href="<?= APP_URL ?>/home" class="header__nav-link">Accueil</a>
        <a href="<?= APP_URL ?>/voyages" class="header__nav-link">Voyages &amp; Expériences</a>
    </nav>

    <!-- Zone droite : espace client + CTA -->
    <div class="header__right">
        <a href="<?= APP_URL ?>/client/login" class="header__client">
            <div class="header__client-icon">
                <svg width="13" height="13" fill="none" viewBox="0 0 24 24" stroke="#C58A60" stroke-width="1.5">
                    <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"/>
                    <circle cx="12" cy="7" r="4"/>
                </svg>
            </div>
            <span>Espace client</span>
        </a>
        <a href="<?= APP_URL ?>/contact" class="header__cta">Créons votre voyage</a>
    </div>

</header>

<!-- =====================================================
     DRAWER — panneau slide depuis la gauche
     ===================================================== -->

<!-- Overlay sombre derrière le drawer -->
<div class="drawer__overlay" id="drawerOverlay"></div>

<!-- Panneau drawer -->
<div class="drawer" id="drawer"
     role="dialog"
     aria-modal="true"
     aria-labelledby="drawer-title"
     aria-hidden="true">

    <!-- Bouton fermeture -->
    <button class="drawer__close" id="drawerClose" aria-label="Fermer le menu">
        <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="#EADFC9" stroke-width="1.5">
            <line x1="18" y1="6" x2="6" y2="18"/>
            <line x1="6" y1="6" x2="18" y2="18"/>
        </svg>
    </button>

    <!-- Titre accessible (visible + id pour aria-labelledby) -->
    <span class="drawer__nav-label" id="drawer-title">Navigation</span>

    <!-- Liens principaux -->
    <nav class="drawer__nav" aria-label="Menu du site">

        <a href="<?= APP_URL ?>/home" class="drawer__nav-link">Accueil</a>

        <a href="<?= APP_URL ?>/a-propos" class="drawer__nav-link">L'Histoire d'Amanéa</a>

        <!-- Voyages avec sous-liens -->
        <a href="<?= APP_URL ?>/voyages" class="drawer__nav-link">Voyages &amp; Expériences</a>
        <div class="drawer__sub-nav">
            <div class="drawer__sub-item">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="#A39E93" stroke-width="1.5" aria-hidden="true" focusable="false">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
                <a href="<?= APP_URL ?>/voyages/groupe" class="drawer__sub-link">Voyages en groupe</a>
            </div>
            <div class="drawer__sub-item">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="#A39E93" stroke-width="1.5" aria-hidden="true" focusable="false">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
                <a href="<?= APP_URL ?>/voyages/feminin" class="drawer__sub-link">Voyages au féminin</a>
            </div>
            <div class="drawer__sub-item">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="#A39E93" stroke-width="1.5" aria-hidden="true" focusable="false">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
                <a href="<?= APP_URL ?>/voyages/noces" class="drawer__sub-link">Voyages de noces</a>
            </div>
            <div class="drawer__sub-item">
                <svg width="12" height="12" fill="none" viewBox="0 0 24 24" stroke="#A39E93" stroke-width="1.5" aria-hidden="true" focusable="false">
                    <polyline points="9 18 15 12 9 6"/>
                </svg>
                <a href="<?= APP_URL ?>/voyages/personnalises" class="drawer__sub-link">Voyages sur mesure</a>
            </div>
        </div>

        <a href="<?= APP_URL ?>/inspirations" class="drawer__nav-link">Inspirations &amp; Conseils</a>

        <a href="<?= APP_URL ?>/contact" class="drawer__nav-link">Créons votre voyage</a>

    </nav>

    <!-- Bas du drawer : contact + baseline -->
    <div class="drawer__footer">
        <a href="mailto:contact@amaneavoyage.fr" class="drawer__email">contact@amaneavoyage.fr</a>
        <span class="drawer__baseline">Création de voyages éthiques &amp; authentique sur mesure</span>
    </div>

</div>

<!-- =====================================================
     JAVASCRIPT — scroll + drawer
     ===================================================== -->
<script>
    // Gestion du scroll → header--scrolled
    const header = document.getElementById('header');
    window.addEventListener('scroll', function() {
        if (window.scrollY > 60) {
            header.classList.add('header--scrolled');
        } else {
            header.classList.remove('header--scrolled');
        }
    }, { passive: true });

    // Gestion du drawer
    const drawer        = document.getElementById('drawer');
    const drawerOverlay = document.getElementById('drawerOverlay');
    const burgerBtn     = document.getElementById('burgerBtn');
    const drawerClose   = document.getElementById('drawerClose');

    const FOCUSABLE = 'a[href], button:not([disabled]), [tabindex]:not([tabindex="-1"])';

    function openDrawer() {
        drawer.classList.add('drawer--open');
        drawerOverlay.classList.add('drawer__overlay--visible');
        document.body.style.overflow = 'hidden';
        burgerBtn.setAttribute('aria-expanded', 'true');
        burgerBtn.setAttribute('aria-label', 'Fermer le menu');
        drawer.removeAttribute('aria-hidden');
        drawerClose.focus();
    }

    function closeDrawer() {
        drawer.classList.remove('drawer--open');
        drawerOverlay.classList.remove('drawer__overlay--visible');
        document.body.style.overflow = '';
        burgerBtn.setAttribute('aria-expanded', 'false');
        burgerBtn.setAttribute('aria-label', 'Ouvrir le menu');
        drawer.setAttribute('aria-hidden', 'true');
        burgerBtn.focus();
    }

    // Focus trap + Escape
    drawer.addEventListener('keydown', function(e) {
        if (e.key === 'Escape') { closeDrawer(); return; }
        if (e.key !== 'Tab') return;
        const focusable = Array.from(drawer.querySelectorAll(FOCUSABLE));
        const first = focusable[0];
        const last  = focusable[focusable.length - 1];
        if (e.shiftKey) {
            if (document.activeElement === first) { e.preventDefault(); last.focus(); }
        } else {
            if (document.activeElement === last)  { e.preventDefault(); first.focus(); }
        }
    });

    burgerBtn.addEventListener('click', openDrawer);
    drawerClose.addEventListener('click', closeDrawer);
    drawerOverlay.addEventListener('click', closeDrawer);
</script>