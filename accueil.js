document.addEventListener("DOMContentLoaded", () => {
  const Images = [
    {
      src: `${themeVars.themeUrl}/Images/Affiche-Arcade/Arcade-404.jpg`,
      Titre: "ARCADE",
      ClassName: "arcade",
      Description: "L’Arcade de l’expoTIM présente les prototypes de jeux vidéo créés par les étudiants de deuxième année en Technique d’intégration multimédia.Réalisés dans le cadre du cours Création de jeu en équipe, ces projets sont le fruit d’un processus complet : de la conception à la programmation, jusqu’au produit fini.",
      Lien: themeVars.pageArcade
    },
    {
      src: `${themeVars.themeUrl}/Images/EcotidienArcade.png`,
      Titre: "GRAPHISME",
      ClassName: "jour-terre",
      Description: "Dans le cours Conception graphique et imagerie vectorielle, les étudiants de première année ont réalisé une recherche sur un enjeu environnemental. À partir de cette recherche, ils ont imaginé un jeu vidéo ou une application permettant de sensibiliser la population à cet enjeu. Ils en ont conçu l’identité visuelle et l’ont présentée sous forme d’affiche.",
      Lien: themeVars.pageJourTerre
    },
    {
      src: `${themeVars.themeUrl}/Images/Finissants.jpg`,
      Titre: "FINISSANTS",
      ClassName: "finissants",
      Description: "À la fin du programme des Techniques d'Intégration en Multimédia, les élèves étaient chargé de créer un projet en utilisant une technologie qui n'a pas été vu durant les 3 ans de la technique ou d'approfondir encore plus une technologie déjà appris.",
      Lien: themeVars.pageFinissants
    }
  ];

  let CurrentIndex = 0;
  const Image = document.getElementById("image-carroussel");
  const Subtitle = document.querySelector(".sous-titre-carroussel");
  const BoutonVoirPlus = document.querySelector(".plus");
  const DescriptionCategorie = document.querySelector(".description")
  const ChoixElements = document.querySelectorAll(".carroussel-choix p");

  if (!Image || !Subtitle || !BoutonVoirPlus || !DescriptionCategorie || ChoixElements.length === 0) return;

  // --- Fonction de changement d’image ---
  function ChangeImageAutomatique(index) {
    const { src, Titre, ClassName, Description, Lien } = Images[index];

    Image.src = src;
    Subtitle.innerText = Titre;
    DescriptionCategorie.innerText = Description;

    ChoixElements.forEach(elm => {
      elm.classList.remove("arcade-click", "jour-terre-click", "finissants-click");
    });
    const currentChoice = document.querySelector(`.${ClassName}`);
    if (currentChoice) currentChoice.classList.add(`${ClassName}-click`);

    BoutonVoirPlus.setAttribute("href", Lien);
  }

  // --- Gestion du timer ---
  let intervalID = null;

  function startAutoChange() {
    if (intervalID !== null) clearInterval(intervalID);
    intervalID = setInterval(() => {
      CurrentIndex = (CurrentIndex + 1) % Images.length;
      ChangeImageAutomatique(CurrentIndex);
    }, 5000);
  }

  // --- Initialisation ---
  ChangeImageAutomatique(CurrentIndex);
  startAutoChange();

  // --- Bouton "Voir Plus" ---
  BoutonVoirPlus.addEventListener("click", (e) => {
    e.preventDefault();
    window.location.href = Images[CurrentIndex].Lien;
  });

  // --- Clics manuels ---
  ChoixElements.forEach((elm, i) => {
    elm.addEventListener("click", () => {
      CurrentIndex = i;
      ChangeImageAutomatique(CurrentIndex);
      startAutoChange(); // remet à zéro le timer
    });
  });
});

// ------------------------------------------------------
//  CARROUSSEL "À PROPOS" MODE 3 IMAGES (CENTRE + CÔTÉS)
// ------------------------------------------------------
document.addEventListener("DOMContentLoaded", () => {
  const images = document.querySelectorAll('.carroussel-apropos img');
  let index = 0;

  function updateFocus() {
    // Remove all actives
    images.forEach(img => img.classList.remove("active"));
  
    // Apply active to current
    images[index].classList.add("active");

    // Go to next
    index = (index + 1) % images.length;
  }

  // First activation
  updateFocus();

  // Change every 3 seconds
  setInterval(updateFocus, 3000);


});

