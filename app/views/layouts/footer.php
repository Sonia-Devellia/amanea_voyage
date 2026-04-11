</main>

<!-- =====================================================
     FOOTER
     4 colonnes desktop / 1 colonne mobile
     Fond : #4A3C32 (marron foncé)
     ===================================================== -->

<footer class="footer">
    <div class="container">

        <!-- Grille 4 colonnes -->
        <div class="footer__grid">

            <!-- Col 1 — Brand -->
            <div class="footer__brand">
                <a href="<?= APP_URL ?>/home">
                    <img src="<?= APP_URL ?>/public/images/LOGO_AMANEA.webp"
                         alt="Amanéa Voyage — Création de voyage éthique et sur mesure"
                         class="footer__logo">
                </a>
                <p class="footer__baseline">Voyages éthiques et authentiques</p>
                <span class="footer__location">Habibi Nora · Île Maurice et France </span>
            </div>

            <!-- Col 2 — Navigation -->
            <div class="footer__col">
                <h3 class="footer__col-title">Le site</h3>
                <a href="<?= APP_URL ?>/home" class="footer__link">Accueil</a>
                <a href="<?= APP_URL ?>/a-propos" class="footer__link">L'Histoire d'Amanéa</a>
                <a href="<?= APP_URL ?>/voyages" class="footer__link">Voyages &amp; Expériences</a>
                <a href="<?= APP_URL ?>/inspirations" class="footer__link">Inspirations &amp; Conseils</a>
                <a href="<?= APP_URL ?>/contact" class="footer__link">Créons votre voyage</a>
            </div>

            <!-- Col 3 — Contact -->
            <div class="footer__col">
                <h3 class="footer__col-title">Contact</h3>
                <a href="mailto:contact@amaneavoyage.fr" class="footer__link">
                    amaneavoyages@gmail.com
                </a>

                <!-- Réseaux sociaux -->
                <div class="footer__social">

                    <!-- Instagram -->
                    <a href="https://www.instagram.com/amanea_voyage/"
                       class="footer__social-link"
                       aria-label="Suivre Amanéa Voyage sur Instagram"
                       target="_blank"
                       rel="noopener noreferrer">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <rect x="2" y="2" width="20" height="20" rx="5" ry="5"/>
                            <circle cx="12" cy="12" r="4"/>
                            <circle cx="17.5" cy="6.5" r="0.5" fill="currentColor" stroke="none"/>
                        </svg>
                    </a>

                    <!-- Facebook -->
                    <a href="https://www.facebook.com/Amanea.voyage"
                       class="footer__social-link"
                       aria-label="Suivre Amanéa Voyage sur Facebook"
                       target="_blank"
                       rel="noopener noreferrer">
                        <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5" aria-hidden="true">
                            <path d="M18 2h-3a5 5 0 0 0-5 5v3H7v4h3v8h4v-8h3l1-4h-4V7a1 1 0 0 1 1-1h3z"/>
                        </svg>
                    </a>

                </div>
            </div>

            <!-- Col 4 — Mentions légales -->
            <div class="footer__col">
                <h3 class="footer__col-title">Légal</h3>
                <a href="#" class="footer__link">Mentions légales</a>
                <a href="#" class="footer__link">Politique de confidentialité</a>
                <a href="#" class="footer__link">Politique cookies</a>
            </div>

        </div>

        <!-- Barre bas — copyright -->
        <div class="footer__bottom">
            <p class="footer__copyright">
                &copy; <?= date('Y') ?> Amanéa Voyage · Habibi Nora · Tous droits réservés
            </p>
        </div>

    </div>
</footer>


<script>
(function () {
    var video = document.querySelector('.hero__video');
    if (!video) return;

    // --- Fallback : cache la vidéo, révèle l'image en dessous ---
    function hideVideo() {
        video.removeAttribute('autoplay');
        video.pause();
        video.classList.add('is-hidden');
    }

    var reducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    var conn          = navigator.connection || navigator.mozConnection || navigator.webkitConnection;
    var slowConn      = conn && (conn.saveData || conn.effectiveType === 'slow-2g' || conn.effectiveType === '2g');

    if (reducedMotion || slowConn) { hideVideo(); return; }
    video.addEventListener('error', hideVideo);

    // --- Fondu d'entrée : révèle la vidéo quand elle peut jouer ---
    video.addEventListener('canplay', function onCanPlay() {
        video.classList.add('is-playing');
        video.removeEventListener('canplay', onCanPlay);
    });

    // --- Fin de vidéo : figée sur la dernière frame, repart au rechargement de page ---
    video.addEventListener('ended', function () {
        video.pause();
    });
})();
</script>
</body>
</html>