  document.addEventListener("DOMContentLoaded", () => {
  
  const refreshBtn = document.querySelector('.boutonRefresh');
  const container = document.getElementById('projets-container');

  if (refreshBtn && container) {
    let isRefreshing = false;

    refreshBtn.addEventListener('click', (e) => {
      e.stopImmediatePropagation();       // 🔥 empêche tout double listener
      if (refreshBtn.classList.contains('loading')) return; // 🔥 bloque double appel réel

      isRefreshing = true;
      refreshBtn.classList.add('loading');

      fetch(`${themeVars.ajaxUrl}?action=refresh_projects&t=${Date.now()}`)
        .then(res => res.json())
        .then(response => {
          if (!response.success) throw new Error('No projects found');

          const { arcade, graphisme, finissant } = response.data;

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
        })
        .catch(console.error)
        .finally(() => {
          isRefreshing = false;
          refreshBtn.classList.remove('loading');
        });
    });
  }
});