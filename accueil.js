//Script interne pour le carrousel
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

// Click manuels
window.ChangeImageManuel = function(NewSrc)  {
  const FoundIndex = Images.findIndex(img => img.src === NewSrc);
  if (FoundIndex !== -1) {
    CurrentIndex = FoundIndex;
    ChangeImageAutomatique(CurrentIndex);
  }
}

//Fonction pour alterner entre les images automatiquement
function ChangeImageAutomatique(index) {
  const Image = document.getElementById('image-carroussel');
  const subtitle = document.querySelector('.sous-titre-carroussel');

  const { src, Titre, ClassName } = Images[index];

  // Change image and text
  Image.src = src;
  subtitle.innerText = Titre;

  // Update class states
  document.querySelectorAll('.carroussel-choix p').forEach(elm => {
    elm.classList.remove('arcade-click', 'jour-terre-click', 'finissants-click');
  });

  document.querySelector(`.${ClassName}`).classList.add(`${ClassName}click`);
}

// ✅ Change image every 3 seconds
setInterval(() => {
  CurrentIndex = (CurrentIndex + 1) % Images.length;
  ChangeImageAutomatique(CurrentIndex);
}, 5000);