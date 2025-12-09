// Fonction principale pour ajuster la taille des titres arcade
function ajusteTitresArcade() {
  const titres = document.querySelectorAll(".titre-arcade");

  titres.forEach(titre => {
    const layers = Array.from(titre.querySelectorAll(".titre-arcade-layer"));

    // Largeur du conteneur réel (padding inclus)
    const style = window.getComputedStyle(titre);
    const containerWidth = titre.clientWidth
                         - parseFloat(style.paddingLeft)
                         - parseFloat(style.paddingRight);

    layers.forEach(layer => {
      // Reset pour prendre la taille CSS d'origine
      layer.style.fontSize = "";
      let computedFontSize = parseFloat(window.getComputedStyle(layer).fontSize);
      let textWidth = layer.scrollWidth;

      // Limites de la taille de police
      const minFontSize = 12;  // px
      const maxFontSize = 72;  // px pour desktop / titre court

      let newFontSize = computedFontSize;

      // Réduction proportionnelle si le texte dépasse le conteneur
      if(textWidth > containerWidth){
        const scaleFactor = containerWidth / textWidth;
        newFontSize = computedFontSize * scaleFactor;
      }

      // Appliquer les limites
      if(newFontSize < minFontSize) newFontSize = minFontSize;
      if(newFontSize > maxFontSize) newFontSize = maxFontSize;

      layer.style.fontSize = `${newFontSize}px`;
    });
  });
}

// Exécution au chargement normal
document.addEventListener("DOMContentLoaded", ajusteTitresArcade);

// Exécution si navigation AJAX / PJAX / Barba.js
// Décommenter les lignes suivantes si ton site utilise un de ces systèmes :
document.addEventListener("pjax:end", ajusteTitresArcade);          // PJAX
document.addEventListener("barba:afterEnter", ajusteTitresArcade);  // Barba.js

// Optionnel : réajuster les titres si la fenêtre change de taille
window.addEventListener("resize", () => {
  ajusteTitresArcade();
});
