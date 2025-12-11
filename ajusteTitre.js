function ajusteTousLesTitres() {
  // Tous les conteneurs de titres : titre-arcade, titre-graphisme, etc.
  const titres = document.querySelectorAll("[class^='titre-']:not(.titre-arcade-layer):not(.titre-graphisme-layer)");

  titres.forEach(titre => {
    // Tous les layers internes (la logique est la même partout)
    const layers = titre.querySelectorAll("[class*='layer']");

    const style = window.getComputedStyle(titre);
    const containerWidth =
      titre.clientWidth -
      parseFloat(style.paddingLeft) -
      parseFloat(style.paddingRight);

    layers.forEach(layer => {
      // Reset
      layer.style.fontSize = "";

      // Clone invisible pour mesurer la vraie largeur du texte
      const clone = document.createElement("span");
      clone.style.position = "absolute";
      clone.style.visibility = "hidden";
      clone.style.whiteSpace = "nowrap";
      clone.style.fontSize = window.getComputedStyle(layer).fontSize;
      clone.style.fontFamily = window.getComputedStyle(layer).fontFamily;
      clone.style.fontWeight = window.getComputedStyle(layer).fontWeight;
      clone.style.letterSpacing = window.getComputedStyle(layer).letterSpacing;
      clone.textContent = layer.textContent;
      document.body.appendChild(clone);

      let fontSize = parseFloat(window.getComputedStyle(layer).fontSize);
      const minFont = 10;
      const maxFont = 90;

      // Largeur réelle du texte
      let textWidth = clone.getBoundingClientRect().width;

      // Si ça dépasse, on réduit proportionnellement
      if (textWidth > containerWidth) {
        const ratio = containerWidth / textWidth;
        fontSize *= ratio;
      }

      // Petite réduction préventive (anti-2-lignes)
      fontSize *= 0.92;

      // Limites
      if (fontSize < minFont) fontSize = minFont;
      if (fontSize > maxFont) fontSize = maxFont;

      layer.style.fontSize = fontSize + "px";

      clone.remove();
    });
  });
}

// Événements
document.addEventListener("DOMContentLoaded", ajusteTousLesTitres);
window.addEventListener("resize", ajusteTousLesTitres);

// Pour navigation AJAX / Barba (si tu l’utilises)
document.addEventListener("pjax:end", ajusteTousLesTitres);
document.addEventListener("barba:afterEnter", ajusteTousLesTitres);