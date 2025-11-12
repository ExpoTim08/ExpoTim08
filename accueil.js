document.addEventListener("DOMContentLoaded", () => {
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

  let CurrentIndex = 0;
  const Image = document.getElementById("image-carroussel");
  const Subtitle = document.querySelector(".sous-titre-carroussel");
  const BoutonVoirPlus = document.querySelector(".plus");
  const ChoixElements = document.querySelectorAll(".carroussel-choix p");

  if (!Image || !Subtitle || !BoutonVoirPlus || ChoixElements.length === 0) return;

  function ChangeImageAutomatique(index) {
    const { src, Titre, ClassName, Lien } = Images[index];

    // --- Change image et texte ---
    Image.src = src;
    Subtitle.innerText = Titre;

    // --- Met à jour les classes visuelles ---
    ChoixElements.forEach(elm => {
      elm.classList.remove("arcade-click", "jour-terre-click", "finissants-click");
    });
    const currentChoice = document.querySelector(`.${ClassName}`);
    if (currentChoice) currentChoice.classList.add(`${ClassName}-click`);

    // --- Lien du bouton ---
    BoutonVoirPlus.setAttribute("href", Lien);
  }

  // --- Gestion du timer unique ---
  let intervalID = null;

  function startAutoChange() {
    // Empêche plusieurs timers simultanés
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
      startAutoChange(); // réinitialise proprement le timer
    });
  });
});
