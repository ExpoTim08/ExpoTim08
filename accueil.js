document.addEventListener("DOMContentLoaded", () => {
  // --- Tableau des images avec titre, classe et lien WordPress ---
  const Images = [
    {
      src: `${themeVars.themeUrl}/Images/Affiche-Arcade/Affiche-Hachiman.jpg`,
      Titre: "ARCADE",
      ClassName: "arcade",
      Lien: themeVars.pageArcade
    },
    {
      src: `${themeVars.themeUrl}/Images/EcotidienArcade.png`,
      Titre: "JOUR DE LA TERRE",
      ClassName: "jour-terre",
      Lien: themeVars.pageJourTerre
    },
    {
      src: `${themeVars.themeUrl}/Images/Finissants.jpg`,
      Titre: "PROJETS DES FINISSANTS",
      ClassName: "finissants",
      Lien: themeVars.pageFinissants
    }
  ];

  // --- Index de l'image actuellement affichée ---
  let CurrentIndex = 0;

  // --- Sélecteurs principaux ---
  const Image = document.getElementById("image-carroussel");
  const Subtitle = document.querySelector(".sous-titre-carroussel");
  const BoutonVoirPlus = document.querySelector(".plus");
  const ChoixElements = document.querySelectorAll(".carroussel-choix p");

  // --- Vérifie que tous les éléments existent ---
  if (!Image || !Subtitle || !BoutonVoirPlus || ChoixElements.length === 0) return;

  // --- Fonction principale pour changer l'image et les informations ---
  function ChangeImageAutomatique(index) {
    const { src, Titre, ClassName, Lien } = Images[index];

    // --- Change l'image et le sous-titre ---
    Image.src = src;
    Subtitle.innerText = Titre;

    // --- Met à jour les classes visuelles des boutons ---
    ChoixElements.forEach(elm => {
      elm.classList.remove("arcade-click", "jour-terre-click", "finissants-click");
    });
    const currentChoice = document.querySelector(`.${ClassName}`);
    if (currentChoice) currentChoice.classList.add(`${ClassName}-click`);

    // --- Met à jour le lien du bouton "Voir Plus" ---
    BoutonVoirPlus.setAttribute("href", Lien);
  }

  // --- Fonction pour changer l'image manuellement via clic ---
  window.ChangeImageManuel = function (NewSrc) {
    const FoundIndex = Images.findIndex(img => img.src === NewSrc);
    if (FoundIndex !== -1) {
      CurrentIndex = FoundIndex;
      ChangeImageAutomatique(CurrentIndex);
    }
  };

  // --- Affiche la première image au chargement ---
  ChangeImageAutomatique(CurrentIndex);

  // --- Changement automatique toutes les 5 secondes ---
  setInterval(() => {
    CurrentIndex = (CurrentIndex + 1) % Images.length;
    ChangeImageAutomatique(CurrentIndex);
  }, 5000);

  // --- Clique sur le bouton "Voir Plus" ---
  BoutonVoirPlus.addEventListener("click", (e) => {
    e.preventDefault();
    window.location.href = Images[CurrentIndex].Lien;
  });

  // --- Clique sur les boutons de catégorie ---
  ChoixElements.forEach((elm, i) => {
    elm.addEventListener("click", () => {
      CurrentIndex = i;
      ChangeImageAutomatique(CurrentIndex);
      // --- Plus de redirection ici ---
    });
  });
});
