document.addEventListener("DOMContentLoaded", () => {
  // --- Tableau des images avec titre, classe et lien WordPress ---
  const Images = [
    {
      src: `${themeUrl}/Images/Arcade.jpg`,
      Titre: "ARCADE",
      ClassName: "arcade",
      Lien: pageArcade
    },
    {
      src: `${themeUrl}/Images/Nature.jpeg`,
      Titre: "JOUR DE LA TERRE",
      ClassName: "jour-terre",
      Lien: pageJourTerre
    },
    {
      src: `${themeUrl}/Images/Finissants.jpg`,
      Titre: "PROJETS DES FINISSANTS",
      ClassName: "finissants",
      Lien: pageFinissants
    }
  ];

  let CurrentIndex = 0;

  // --- Sélecteurs principaux ---
  const Image = document.getElementById("image-carroussel");
  const Subtitle = document.querySelector(".sous-titre-carroussel");
  const BoutonVoirPlus = document.querySelector(".plus");
  const ChoixElements = document.querySelectorAll(".carroussel-choix p");

  if (!Image || !Subtitle || !BoutonVoirPlus || ChoixElements.length === 0) return;

  // --- Fonction principale : change l'image et le titre ---
  function ChangeImageAutomatique(index) {
    const { src, Titre, ClassName, Lien } = Images[index];

    // Change image et sous-titre
    Image.src = src;
    Subtitle.innerText = Titre;

    // Met à jour les classes visuelles
    ChoixElements.forEach(elm => {
      elm.classList.remove("arcade-click", "jour-terre-click", "finissants-click");
    });
    const currentChoice = document.querySelector(`.${ClassName}`);
    if (currentChoice) currentChoice.classList.add(`${ClassName}-click`);

    // Met à jour le lien du bouton Voir Plus
    BoutonVoirPlus.setAttribute("href", Lien);
  }

  // --- Clique manuel sur une catégorie ---
  window.ChangeImageManuel = function (NewSrc) {
    const FoundIndex = Images.findIndex(img => img.src === NewSrc);
    if (FoundIndex !== -1) {
      CurrentIndex = FoundIndex;
      ChangeImageAutomatique(CurrentIndex);
    }
  };

  // --- Première image au chargement ---
  ChangeImageAutomatique(CurrentIndex);

  // --- Change automatiquement toutes les 5 secondes ---
  setInterval(() => {
    CurrentIndex = (CurrentIndex + 1) % Images.length;
    ChangeImageAutomatique(CurrentIndex);
  }, 5000);

  // --- Clique sur le bouton Voir Plus ---
  BoutonVoirPlus.addEventListener("click", (e) => {
    e.preventDefault();
    window.location.href = Images[CurrentIndex].Lien;
  });

  // --- Clique sur les boutons de catégorie (sans redirection) ---
  ChoixElements.forEach((elm, i) => {
    elm.addEventListener("click", () => {
      CurrentIndex = i;
      ChangeImageAutomatique(CurrentIndex);
      //plus de redirection ici
    });
  });
});
