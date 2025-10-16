//Script interne pour le carrousel
  const Images = [
  {
    src: `${themeUrl}/Images/Arcade.jpg`,
    Titre: "ARCADE",
    ClassName: "Arcade"
  },
  {
    src: `${themeUrl}/Images/Nature.jpeg`,
    Titre: "JOUR DE LA TERRE",
    ClassName: "JourTerre"
  },
  {
    src: `${themeUrl}/Images/Finissants.jpg`,
    Titre: "PROJETS DES FINISSANTS",
    ClassName: "Finissants"
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
  const Image = document.getElementById('ImageCarroussel');
  const subtitle = document.querySelector('.Sous-titreCarroussel');

  const { src, Titre, ClassName } = Images[index];

  // Change image and text
  Image.src = src;
  subtitle.innerText = Titre;

  // Update class states
  document.querySelectorAll('.CarrousselChoix p').forEach(elm => {
    elm.classList.remove('ArcadeClick', 'JourTerreClick', 'FinissantsClick');
  });

  document.querySelector(`.${ClassName}`).classList.add(`${ClassName}Click`);
}

// ✅ Change image every 3 seconds
setInterval(() => {
  CurrentIndex = (CurrentIndex + 1) % Images.length;
  ChangeImageAutomatique(CurrentIndex);
}, 5000);