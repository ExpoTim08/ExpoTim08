document.addEventListener("DOMContentLoaded", () => {
  const rideauG = document.querySelector('.rideau.gauche');
  const rideauD = document.querySelector('.rideau.droite');
  const introText = document.querySelector('.intro-text');
  const accueil = document.getElementById('accueil-content');

  // Démarrer l'animation
  setTimeout(() => {
      rideauG.classList.add('open');
      rideauD.classList.add('open');
      introText.classList.add('fade-out');
      accueil.style.opacity = 1; // révèle progressivement le contenu
  }, 3000);
});
