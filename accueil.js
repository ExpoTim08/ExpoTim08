document.addEventListener("DOMContentLoaded", () => {
  // ================= Carrousel Images =================
  const Images = themeVars.carrouselImages.map((src, index) => {
    const Titles = themeVars.carrouselTitles;
    const Classes = ["finissants", "arcade", "jour-terre"];
    const Descriptions = themeVars.carrouselDescriptions;
    const Links = [
      themeVars.pageFinissants,
      themeVars.pageArcade,
      themeVars.pageJourTerre
    ];

    return {
      src: src,
      Titre: Titles[index],
      ClassName: Classes[index],
      Description: Descriptions[index] || "",
      Lien: Links[index]
    };
  });

  let CurrentIndex = 0;
  let intervalID = null;
  let hoverTimeout = null;

  const Image = document.getElementById("image-carroussel");
  const ImageWrap = document.querySelector('.image-wrap');
  const Subtitle = document.querySelector(".sous-titre-carroussel");
  const DescriptionCategorie = document.querySelector(".description");
  const ChoixElements = document.querySelectorAll(".carroussel-choix p");
  const Details = document.querySelector(".arcade-details");

  const container = document.getElementById('projets-container');
  const refreshBtn = document.querySelector('.boutonRefresh');

  if (!Image || !Subtitle || !DescriptionCategorie || ChoixElements.length === 0 || !container) return;

  // ================= Helper filter =================
  function updateImageWrapFilter() {
    if (!ImageWrap) return;
    if (window.innerWidth <= 1366) {
      ImageWrap.style.filter = '';
      return;
    }

    const active = Images[CurrentIndex].ClassName;
    let filter = '';
    if (active === 'arcade') {
      filter = 'drop-shadow(15px -15px 0 rgba(75, 51, 235, 0.9)) drop-shadow(15px -15px 0 rgba(0, 151, 143, 0.8)) drop-shadow(15px -15px 0 rgba(194, 135, 8, 0.8))';
    } else if (active === 'jour-terre') {
      filter = 'drop-shadow(15px -15px 0 rgba(49, 37, 219, 0.8)) drop-shadow(15px -15px 0 rgba(27, 176, 169, 1)) drop-shadow(15px -15px 0 rgba(194, 135, 8, 0.8))';
    } else if (active === 'finissants') {
      filter = 'drop-shadow(15px -15px 0 rgba(49, 37, 219, 0.8)) drop-shadow(15px -15px 0 rgba(0, 151, 143, 0.8)) drop-shadow(15px -15px 0 rgba(255, 173, 32, 1))';
    }
    ImageWrap.style.filter = filter;
  }

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

    ChoixElements.forEach((pElm, i) => {
      if (!pElm.dataset.original) pElm.dataset.original = pElm.innerText;
      pElm.innerText = i === index ? 'voir plus' : pElm.dataset.original;
    });

    if (Details) {
      Details.classList.remove('bg-arcade','bg-graphisme','bg-finissants');
      if (ClassName === 'arcade') {
        Details.classList.add('bg-arcade');
        Details.style.background = 'linear-gradient(1deg, #462ae3ff 15%, #210d90ff 35%, transparent 90%)';
      } else if (ClassName === 'jour-terre') {
        Details.classList.add('bg-graphisme');
        Details.style.background = 'linear-gradient(1deg, #05beb5ff 15%, #0a847eff 35%, transparent 90%)';
      } else if (ClassName === 'finissants') {
        Details.classList.add('bg-finissants');
        Details.style.background = 'linear-gradient(1deg, #e5a009ff 15%, #a77408ff 35%, transparent 90%)';
      } else {
        Details.style.background = '';
      }

      const voirPlus = Details.querySelector('.plus, .Plus');
      if (voirPlus) voirPlus.innerText = `Voir plus — ${Titre}`;
    }

    updateImageWrapFilter();
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

  // ================= Hover & Click =================
  ChoixElements.forEach((elm, i) => {

    // Hover uniquement sur desktop
    if (window.innerWidth > 1366) {
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
      
    }

    // Click fonctionne partout
    elm.addEventListener("click", () => {
      stopAuto();
      CurrentIndex = i;
      ChangeImage(CurrentIndex);
      window.location.href = Images[i].Lien; // toujours rediriger
    });

  });

  // ================= Responsiveness arcade-details =================
  function handleResponsiveDetails() {
    if (!Details) return;
    if (window.innerWidth <= 1366) {
      Details.classList.remove('show'); // ne bloque pas les boutons
    }
    updateImageWrapFilter();
  }

  handleResponsiveDetails();
  window.addEventListener("resize", handleResponsiveDetails);

  // ================= Animation PCA Projets =================
  function isMobileOrTablet() { return window.innerWidth <= 1366; }

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
  if (refreshBtn) {
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
  }

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
});
