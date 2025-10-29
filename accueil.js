document.addEventListener("DOMContentLoaded", () => {
  //Tableau des images avec leurs titres et leurs classes.
  const Images = [
    {
      src: `${themeUrl}/Images/Arcade.jpg`,
      Titre: "ARCADE",
      ClassName: "arcade"
    },
    {
      src: `${themeUrl}/Images/Nature.jpeg`,
      Titre: "JOUR DE LA TERRE",
      ClassName: "jour-terre"
    },
    {
      src: `${themeUrl}/Images/Finissants.jpg`,
      Titre: "PROJETS DES FINISSANTS",
      ClassName: "finissants"
    }
  ];

  let CurrentIndex = 0;

  // Cliques manuel
  window.ChangeImageManuel = function (NewSrc) {
    const FoundIndex = Images.findIndex(img => img.src === NewSrc);
    if (FoundIndex !== -1) {
      CurrentIndex = FoundIndex;
      ChangeImageAutomatique(CurrentIndex);
    }
  };

  // Fonction pour alterner entre les images automatiquement
  function ChangeImageAutomatique(index) {
    const Image = document.getElementById('image-carroussel');
    const subtitle = document.querySelector('.sous-titre-carroussel');

    if (!Image || !subtitle) return;

    const { src, Titre, ClassName } = Images[index];

    Image.src = src;
    subtitle.innerText = Titre;

    document.querySelectorAll('.carroussel-choix p').forEach(elm => {
      elm.classList.remove('arcade-click', 'jour-terre-click', 'finissants-click');
    });

    const currentChoice = document.querySelector(`.${ClassName}`);
    if (currentChoice) currentChoice.classList.add(`${ClassName}-click`);
  }

  // Première image au chargement
  ChangeImageAutomatique(CurrentIndex);

  // Change image toutes les 5 secondes
  setInterval(() => {
    CurrentIndex = (CurrentIndex + 1) % Images.length;
    ChangeImageAutomatique(CurrentIndex);
  }, 5000);
});
