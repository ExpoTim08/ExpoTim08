document.addEventListener("DOMContentLoaded", () => {

  const refreshBtn = document.querySelector('.boutonRefresh');
  const container = document.getElementById('projets-container');

  // helper responsive
  function isMobileOrTablet() {
    return window.innerWidth <= 1366;
  }

  if (!container) return; // rien à faire si pas de section projets

  // animation utilitaire : applique la classe .projet-visible en cascade
  function animateElementsStagger(elements, stagger = 150) {
    elements.forEach((el, i) => {
      // reset before anim
      el.classList.remove('projet-visible');
      // force reflow pour s'assurer que la classe retirée est prise en compte
      // eslint-disable-next-line no-unused-expressions
      el.offsetHeight;
      setTimeout(() => el.classList.add('projet-visible'), i * stagger);
    });
  }

  // IntersectionObserver pour déclencher l'animation quand la section entre en vue
  let observer = null;
  function initObserver() {
    // déconnecter ancien observer si existant
    if (observer) observer.disconnect();

    const threshold = isMobileOrTablet() ? 0.1 : 0.2;
    observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (!entry.target || entry.target !== container) return;
        const enfants = Array.from(container.children);
        if (entry.isIntersecting) {
          // si la section est visible -> animer les projets (cascade)
          animateElementsStagger(enfants, 150);
        } else {
          // si on sort de la vue et qu'on est sur grand écran, on retire la classe pour pouvoir ré-animer au scroll
          if (!isMobileOrTablet()) {
            enfants.forEach(el => el.classList.remove('projet-visible'));
          }
        }
      });
    }, { threshold });

    // observer le container (on observe le conteneur, pas chaque enfant)
    observer.observe(container);
  }

  // Vérification initiale : si la section est déjà visible au chargement, on lance l'animation
  function runInitialCheck() {
    const rect = container.getBoundingClientRect();
    const viewportH = window.innerHeight || document.documentElement.clientHeight;
    const inView = rect.top < viewportH * (isMobileOrTablet() ? 0.95 : 0.9) && rect.bottom > viewportH * 0.05;
    const enfants = Array.from(container.children);
    if (inView) {
      animateElementsStagger(enfants, 150);
    } else {
      // si non visible, on laisse l'observer déclencher plus tard
      enfants.forEach(el => el.classList.remove('projet-visible'));
    }
  }

  // initialisation observer + check
  initObserver();
  // petit timeout pour laisser le DOM se stabiliser (images, styles) -> améliore fiabilité sur vieux ordis
  setTimeout(runInitialCheck, 60);

  // rattacher au resize pour recalculer seuils / observer
  let resizeTO = null;
  window.addEventListener('resize', () => {
    if (resizeTO) clearTimeout(resizeTO);
    resizeTO = setTimeout(() => {
      initObserver();
      runInitialCheck();
    }, 200);
  });

  // === Refresh button logic (conserve ton fetch d'origine, ajoute animation après insertion) ===
  if (refreshBtn) {
    let isRefreshing = false;

    refreshBtn.addEventListener('click', (e) => {
      e.stopImmediatePropagation(); // empêche double déclenchement
      if (refreshBtn.classList.contains('loading')) return;

      isRefreshing = true;
      refreshBtn.classList.add('loading');

      fetch(`${themeVars.ajaxUrl}?action=refresh_projects&t=${Date.now()}`)
        .then(res => res.json())
        .then(response => {
          if (!response.success) throw new Error('No projects found');

          const { arcade, graphisme, finissant } = response.data;

          // Mettre à jour le DOM (exactement comme tu avais)
          container.innerHTML = `
            <div class="projet-populaire-finissant">
              <span class="titre">${finissant.title}</span>
              <span class="bouton">
                <a href="${themeVars.pageFinissants}?projet_id=${finissant.id}">>></a>
              </span>
              <span class="categorie">Catégorie</span>
              <span class="categorie-nom">FINISSANTS</span>
              <img class="image-populaire-finissants" src="${finissant.url}" alt="${finissant.title}">
            </div>

            <div class="projet-populaire-arcade">
              <span class="titre">${arcade.title}</span>
              <span class="bouton">
                <a href="${themeVars.pageArcade}?projet_id=${arcade.id}">>></a>
              </span>
              <span class="categorie">Catégorie</span>
              <span class="categorie-nom">ARCADE</span>
              <img class="image-populaire-arcade" src="${arcade.url}" alt="${arcade.title}">
            </div>

            <div class="projet-populaire-jour-terre">
              <span class="titre">${graphisme.title}</span>
              <span class="bouton">
                <a href="${themeVars.pageJourTerre}?projet_id=${graphisme.id}">>></a>
              </span>
              <span class="categorie">Catégorie</span>
              <span class="categorie-nom">GRAPHISME</span>
              <img class="image-populaire-jour-terre" src="${graphisme.url}" alt="${graphisme.title}">
            </div>
          `;

          // --- important : réinitialiser observer & lancer animation sur les nouveaux éléments ---
          initObserver();

          // petit délai pour laisser le navigateur insérer les images/éléments -> plus fiable sur PC lents
          setTimeout(() => {
            // animation en cascade identique à l'accueil
            const enfants = Array.from(container.children);
            animateElementsStagger(enfants, 150);
          }, 60);

        })
        .catch(err => {
          console.error(err);
        })
        .finally(() => {
          isRefreshing = false;
          refreshBtn.classList.remove('loading');
        });
    });
  }

});
