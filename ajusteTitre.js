function ajusteTousLesTitres() {
  const titres = document.querySelectorAll("[class^='titre-']:not(.titre-arcade-layer):not(.titre-graphisme-layer)");

  titres.forEach(titre => {
    const layers = titre.querySelectorAll("[class*='layer']");
    if (!layers.length) return;

    const style = window.getComputedStyle(titre);
    const containerWidth = titre.clientWidth - parseFloat(style.paddingLeft) - parseFloat(style.paddingRight);

    layers.forEach(layer => {
      // On supprime toute taille inline pour repartir du clamp CSS
      layer.style.fontSize = "";

      // Taille calculée par clamp
      const computedStyle = window.getComputedStyle(layer);
      const fontSize = parseFloat(computedStyle.fontSize);

      // Clone invisible pour mesurer
      const clone = document.createElement("span");
      clone.style.position = "absolute";
      clone.style.visibility = "hidden";
      clone.style.whiteSpace = "nowrap";
      clone.style.fontSize = fontSize + "px";
      clone.style.fontFamily = computedStyle.fontFamily;
      clone.style.fontWeight = computedStyle.fontWeight;
      clone.style.letterSpacing = computedStyle.letterSpacing;
      clone.textContent = layer.textContent;
      document.body.appendChild(clone);

      const textWidth = clone.getBoundingClientRect().width;

      if (textWidth > containerWidth) {
        // Réduction seulement si ça dépasse
        let newFontSize = fontSize * (containerWidth / textWidth) * 0.92;
        const minFont = 10;
        if (newFontSize < minFont) newFontSize = minFont;
        layer.style.fontSize = newFontSize + "px";
      } else {
        // Si le texte tient, supprimer l'inline pour que clamp reprenne
        layer.style.fontSize = "";
      }

      clone.remove();
    });
  });
}

// Déclenchement sur toutes les pages
document.addEventListener("DOMContentLoaded", ajusteTousLesTitres);
window.addEventListener("resize", ajusteTousLesTitres);
document.addEventListener("pjax:end", ajusteTousLesTitres);
document.addEventListener("barba:afterEnter", ajusteTousLesTitres);

// Page 404 spécifique si nécessaire
if (document.body.classList.contains('page-404')) {
  ajusteTousLesTitres();
}
