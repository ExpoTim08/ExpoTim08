document.addEventListener("DOMContentLoaded", () => {
  // ================= Carrousel Images =================
  // carrouselImages = ["url1", "url2", "url3"] venant du WP Customizer
  const Images = carrouselImages.map((src, index) => {
    const Titles = ["FINISSANTS", "ARCADE", "GRAPHISME"];
    const Classes = ["finissants", "arcade", "jour-terre"];
    const Descriptions = [
      "Les finissants de la Technique d’intégration multimédia présentent le projet synthèse de leur parcours.",
      "L’Arcade de l’expoTIM présente les prototypes de jeux vidéo créés par les étudiants de deuxième année en Technique d’intégration multimédia.",
      "Dans le cours Conception graphique et imagerie vectorielle, les étudiants de première année ont réalisé une recherche sur un enjeu environnemental."
    ];
    const Links = [
      themeVars.pageFinissants,
      themeVars.pageArcade,
      themeVars.pageJourTerre
    ];

    return {
      src: src,                     // image du customizer
      Titre: Titles[index],         // titres déjà existants
      ClassName: Classes[index],    // classes existantes
      Description: Descriptions[index],
      Lien: Links[index]
    };
  });

  let CurrentIndex = 0;
  let intervalID = null;
  let hoverTimeout = null;

  const Image = document.getElementById("image-carroussel");
  const Subtitle = document.querySelector(".sous-titre-carroussel");
  const DescriptionCategorie = document.querySelector(".description");
  const ChoixElements = document.querySelectorAll(".carroussel-choix p");
  const Details = document.querySelector(".arcade-details");

  const container = document.getElementById('projets-container');
  const refreshBtn = document.querySelector('.boutonRefresh');

  if (!Image || !Subtitle || !DescriptionCategorie || ChoixElements.length === 0 || !container) return;

  // ================= Fonction pour changer l'image =================
  function ChangeImage(index) {
    const { src, Titre, ClassName, Description } = Images[index];
    Image.src = src;
    Subtitle.innerText = Titre;
    DescriptionCategorie.innerText = Description;

    ChoixElements.forEach(elm => {
      elm.classList.remove("arcade-click", "jour-terre-click", "finissants-click");
    });

    const currentChoice = document.querySelector(`.${ClassName}`);
    if (currentChoice) currentChoice.classList.add(`${ClassName}-click`);
  }

  // ================= Auto rotation =================
  function startAuto() {
    clearInterval(intervalID);
    intervalID = setInterval(() => {
      CurrentIndex = (CurrentIndex + 1) % Images.length;
      ChangeImage(CurrentIndex);
    }, 4000);
  }

  function stopAuto() {
    clearInterval(intervalID);
  }

  ChangeImage(CurrentIndex);
  startAuto();

  // ================= Hover & Click arcade-details =================
  ChoixElements.forEach((elm, i) => {
    const enter = () => {
      stopAuto();
      CurrentIndex = i;
      ChangeImage(CurrentIndex);
      if (Details) Details.classList.add('show');
      if (hoverTimeout) { clearTimeout(hoverTimeout); hoverTimeout = null; }
    };

    const leave = () => {
      if (Details) Details.classList.remove('show');
      if (hoverTimeout) clearTimeout(hoverTimeout);
      hoverTimeout = setTimeout(() => {
        CurrentIndex = (CurrentIndex + 1) % Images.length;
        ChangeImage(CurrentIndex);
        startAuto();
        hoverTimeout = null;
      }, 1000);
    };

    elm.addEventListener("mouseenter", enter);
    elm.addEventListener("mouseleave", leave);

    elm.addEventListener("click", () => {
      window.location.href = Images[i].Lien;
    });
  });

  // ================= Responsiveness arcade-details =================
  function handleResponsiveDetails() {
    if (!Details) return;
    if (window.innerWidth <= 1366) {
      Details.classList.add('show');
    } else {
      Details.classList.remove('show');
    }
  }

  handleResponsiveDetails();
  window.addEventListener("resize", handleResponsiveDetails);

  // ================= Animation PCA Projets =================
  function isMobileOrTablet() {
    return window.innerWidth <= 1366;
  }

  let observer;
  function animateProjets() {
    const projets = container.querySelectorAll(":scope > div");
    if(observer) observer.disconnect();

    observer = new IntersectionObserver(entries => {
      entries.forEach(entry => {
        if(entry.isIntersecting){
          projets.forEach((projet, i) => {
            setTimeout(() => projet.classList.add("projet-visible"), i * 150);
          });
        } else if (!isMobileOrTablet()) {
          projets.forEach(projet => projet.classList.remove("projet-visible"));
        }
      });
    }, { threshold: isMobileOrTablet() ? 0.1 : 0.2 });

    projets.forEach(projet => observer.observe(projet));
  }

  animateProjets();

  // ================= Bouton Rafraîchir =================
  refreshBtn.addEventListener("click", (e) => {
    e.stopImmediatePropagation();
    if (refreshBtn.classList.contains('loading')) return;

    refreshBtn.classList.add('loading');

    fetch(`${themeVars.ajaxUrl}?action=refresh_projects&t=${Date.now()}`)
      .then(res => res.json())
      .then(response => {
        if (!response.success) throw new Error('No projects found');
        const { arcade, graphisme, finissant } = response.data;

        container.innerHTML = `
          <div class="projet-populaire-finissant">
            <span class="titre">${finissant.title}</span>
            <span class="bouton"><a href="${themeVars.pageFinissants}?projet_id=${finissant.id}">>></a></span>
            <span class="categorie">Catégorie</span>
            <span class="categorie-nom">FINISSANTS</span>
            <img class="image-populaire-finissants" src="${finissant.url}" alt="${finissant.title}">
          </div>
          <div class="projet-populaire-arcade">
            <span class="titre">${arcade.title}</span>
            <span class="bouton"><a href="${themeVars.pageArcade}?projet_id=${arcade.id}">>></a></span>
            <span class="categorie">Catégorie</span>
            <span class="categorie-nom">ARCADE</span>
            <img class="image-populaire-arcade" src="${arcade.url}" alt="${arcade.title}">
          </div>
          <div class="projet-populaire-jour-terre">
            <span class="titre">${graphisme.title}</span>
            <span class="bouton"><a href="${themeVars.pageJourTerre}?projet_id=${graphisme.id}">>></a></span>
            <span class="categorie">Catégorie</span>
            <span class="categorie-nom">GRAPHISME</span>
            <img class="image-populaire-jour-terre" src="${graphisme.url}" alt="${graphisme.title}">
          </div>
        `;

        requestAnimationFrame(animateProjets);
      })
      .catch(console.error)
      .finally(() => refreshBtn.classList.remove('loading'));
  });

  // ================= Carroussel Apropos =================
  const aproposImages = document.querySelectorAll('.carroussel-apropos img');
  if (aproposImages.length > 0) {
    let index = 0;
    function updateFocus() {
      aproposImages.forEach(img => img.classList.remove("active"));
      if (!aproposImages[index]) return;
      aproposImages[index].classList.add("active");
      index = (index + 1) % aproposImages.length;
    }
    updateFocus();
    setInterval(updateFocus, 3000);
  }

  function equalizeProjectHeights() {
    const cards = document.querySelectorAll('.projet-populaire');
    let maxHeight = 0;

    cards.forEach(card => {
      card.style.height = 'auto';
    });

    cards.forEach(card => {
      const height = card.offsetHeight;
      if (height > maxHeight) {
        maxHeight = height;
      }
    });

    cards.forEach(card => {
      card.style.height = maxHeight + 'px';
    });
  }

  window.addEventListener('load', equalizeProjectHeights);
  window.addEventListener('resize', equalizeProjectHeights);

});
