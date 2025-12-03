document.addEventListener("DOMContentLoaded", () => {
  const Images = [
    {
      src: `${themeVars.themeUrl}/Images/Finissants.png`,
      Titre: "FINISSANTS",
      ClassName: "finissants",
      Description: "Les finissants de la Technique d’intégration multimédia présentent le projet synthèse de leur parcours.",
      Lien: themeVars.pageFinissants
    },
    {
      src: `${themeVars.themeUrl}/Images/ExpoTim.png`,
      Titre: "ARCADE",
      ClassName: "arcade",
      Description: "L’Arcade de l’expoTIM présente les prototypes de jeux vidéo créés par les étudiants de deuxième année en Technique d’intégration multimédia.",
      Lien: themeVars.pageArcade
    },
    {
      src: `${themeVars.themeUrl}/Images/ImageGraphisme/Graphisme.png`,
      Titre: "GRAPHISME",
      ClassName: "jour-terre",
      Description: "Dans le cours Conception graphique et imagerie vectorielle, les étudiants de première année ont réalisé une recherche sur un enjeu environnemental.",
      Lien: themeVars.pageJourTerre
    }
  ];

  let CurrentIndex = 0;
  let intervalID = null;
  let hoverTimeout = null;
  const hoverListeners = [];

  const Image = document.getElementById("image-carroussel");
  const Subtitle = document.querySelector(".sous-titre-carroussel");
  const DescriptionCategorie = document.querySelector(".description");
  const ChoixElements = document.querySelectorAll(".carroussel-choix p");
  const Details = document.querySelector(".arcade-details");

  if (!Image || !Subtitle || !DescriptionCategorie || ChoixElements.length === 0) return;

  // Change l'image et met à jour le bouton actif
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

  // Démarre l'autoplay
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

  // Initialisation
  ChangeImage(CurrentIndex);
  startAuto();

  // Gestion hover uniquement desktop >1024px
  function setupHover() {
    hoverListeners.forEach(({ elm, enter, leave }) => {
      elm.removeEventListener("mouseenter", enter);
      elm.removeEventListener("mouseleave", leave);
    });
    hoverListeners.length = 0;

    if (window.innerWidth <= 1024) return;

    ChoixElements.forEach((elm, i) => {
      const enter = () => {
        stopAuto();
        CurrentIndex = i;
        ChangeImage(CurrentIndex);

        if (Details) {
          Details.style.display = 'flex';
          requestAnimationFrame(() => {
            Details.style.opacity = '1';
            Details.style.transform = 'translateY(100%)';
          });
        }

        if (hoverTimeout) {
          clearTimeout(hoverTimeout);
          hoverTimeout = null;
        }
      };

      const leave = () => {
        if (Details) {
          Details.style.opacity = '0';
          Details.style.transform = 'translateY(160%)';
        }

        if (hoverTimeout) clearTimeout(hoverTimeout);

        // Reprise immédiate : avance une image et relance l'autoplay
        hoverTimeout = setTimeout(() => {
          CurrentIndex = (CurrentIndex + 1) % Images.length;
          ChangeImage(CurrentIndex);
          startAuto();
          hoverTimeout = null;
        }, 1000); // petit délai pour laisser l'animation CSS se terminer
      };

      elm.addEventListener("mouseenter", enter);
      elm.addEventListener("mouseleave", leave);
      hoverListeners.push({ elm, enter, leave });
    });
  }

  // Click toujours actif
  ChoixElements.forEach((elm, i) => {
    elm.addEventListener("click", () => {
      window.location.href = Images[i].Lien;
    });
  });

  // Gestion responsive du bloc détails
  function handleResponsiveDetails() {
    if (!Details) return;
    if (window.innerWidth <= 1024) {
      Details.style.display = 'flex';
      Details.style.opacity = '1';
      Details.style.transform = 'none';
    } else {
      Details.style.display = 'flex';
      Details.style.opacity = '0';
      Details.style.transform = 'translateY(160%)';
    }
  }

  setupHover();
  handleResponsiveDetails();

  window.addEventListener("resize", () => {
    ChangeImage(CurrentIndex);
    setupHover();
    handleResponsiveDetails();
  });

  // Carrousel "À PROPOS"
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
