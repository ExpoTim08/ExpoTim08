document.addEventListener("DOMContentLoaded", () => {
  const Images = [
    {
      src: `${themeVars.themeUrl}/Images/Finissants.jpg`,
      Titre: "FINISSANTS",
      ClassName: "finissants",
      Description: "À la fin du programme des Techniques d'Intégration en Multimédia, les élèves créent des projets en approfondissant une technologie ou en explorant une nouvelle.",
      Lien: themeVars.pageFinissants
    },
    {
      src: `${themeVars.themeUrl}/Images/Affiche-Arcade/Arcade-404.jpg`,
      Titre: "ARCADE",
      ClassName: "arcade",
      Description: "L’Arcade de l’expoTIM présente tous les prototypes de jeux vidéo réalisés par les étudiants, avec explications détaillées et images, sans aucune limitation de texte dans la description.",
      Lien: themeVars.pageArcade
    },
    {
      src: `${themeVars.themeUrl}/Images/EcotidienArcade.png`,
      Titre: "GRAPHISME",
      ClassName: "jour-terre",
      Description: "Dans le cours Conception graphique et imagerie vectorielle, les étudiants réalisent une recherche et créent un projet complet, avec toutes les informations affichées dans la description.",
      Lien: themeVars.pageJourTerre
    }
  ];

  let CurrentIndex = 0;
  let intervalID = null;
  let hoverTimeout = null;
  const Image = document.getElementById("image-carroussel");
  const Subtitle = document.querySelector(".sous-titre-carroussel");
  const DescriptionCategorie = document.querySelector(".description");
  const ChoixElements = document.querySelectorAll(".carroussel-choix p");
  const Details = document.querySelector(".arcade-details");

  if (!Image || !Subtitle || !DescriptionCategorie || ChoixElements.length === 0) return;

  function ChangeImage(index) {
    const { src, Titre, ClassName, Description } = Images[index];
    Image.src = src;
    Subtitle.innerText = Titre;
    DescriptionCategorie.innerText = Description; // aucune limite de texte

    ChoixElements.forEach(elm => {
      elm.classList.remove("arcade-click", "jour-terre-click", "finissants-click");
    });
    const currentChoice = document.querySelector(`.${ClassName}`);
    if (currentChoice) currentChoice.classList.add(`${ClassName}-click`);
  }

  function startAuto() {
    if (intervalID !== null) clearInterval(intervalID);
    intervalID = setInterval(() => {
      CurrentIndex = (CurrentIndex + 1) % Images.length;
      ChangeImage(CurrentIndex);
    }, 4000);
  }

  function stopAuto() {
    if (intervalID !== null) clearInterval(intervalID);
  }

  // Initialisation
  ChangeImage(CurrentIndex);
  startAuto();

  // Hover et clic
  ChoixElements.forEach((elm, i) => {
    elm.addEventListener("mouseenter", () => {
      stopAuto();
      CurrentIndex = i;
      if (hoverTimeout) { clearTimeout(hoverTimeout); hoverTimeout = null; }
      ChangeImage(CurrentIndex);

      if (Details) {
        Details.style.display = 'flex';
        // fondu + slide
        requestAnimationFrame(() => {
          Details.style.opacity = '1';
          Details.style.transform = 'translateY(130%)';
        });
      }
    });

    elm.addEventListener("mouseleave", () => {
      if (Details) {
        Details.style.opacity = '0';
        Details.style.transform = 'translateY(160%)';
      }

      hoverTimeout = setTimeout(() => {
        CurrentIndex = (CurrentIndex + 1) % Images.length;
        ChangeImage(CurrentIndex);
        startAuto();
        hoverTimeout = null;
      }, 2000);
    });

    elm.addEventListener("click", () => {
      window.location.href = Images[i].Lien;
    });
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
