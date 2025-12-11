document.addEventListener("DOMContentLoaded", () => {

  function animateSection(titreSelector, logoSelector = null, descSelector = null, retourSelector = null) {
    const titreLayers = document.querySelectorAll(titreSelector);
    const logo = logoSelector ? document.querySelector(logoSelector) : null;
    const description = descSelector ? document.querySelector(descSelector) : null;
    const retour = retourSelector ? document.querySelector(retourSelector) : null;

    if (!titreLayers.length) return;

    // Split lettres en spans en conservant les espaces (non animés)
    function splitLetters(span) {
      const text = span.textContent;
      span.textContent = '';
      span.style.visibility = 'visible';

      let animIndex = 0; // index d'animation seulement pour les caractères non-espace

      for (const char of text) {
        const letter = document.createElement('span');
        letter.classList.add('letter');

        if (char === ' ') {
          // espace : utiliser un espace insécable pour conserver la largeur
          letter.classList.add('space');
          letter.textContent = '\u00A0';
          // ne pas assigner d'index d'animation
        } else {
          // caractère normal
          letter.textContent = char;
          // stocke l'index d'animation pour ordonner correctement les setTimeout
          letter.dataset.animIndex = animIndex;
          animIndex++;
        }

        span.appendChild(letter);
      }

      // retourne le nombre de caractères animables (sans les espaces)
      return animIndex;
    }

    // on split chaque layer et on récupère le plus grand nombre de lettres animables (utile pour le delay global)
    let maxAnimLetters = 0;
    titreLayers.forEach(layer => {
      const count = splitLetters(layer);
      if (count > maxAnimLetters) maxAnimLetters = count;
    });

    const letterSpeed = 80; // vitesse d'animation par lettre en ms

    // Animation lettres : uniquement les .letter qui ont data-anim-index
    titreLayers.forEach(layer => {
      const letters = layer.querySelectorAll('.letter');
      letters.forEach(letter => {
        const idx = letter.dataset.animIndex;
        if (typeof idx !== 'undefined') {
          // parseInt pour être sûr
          const n = parseInt(idx, 10);
          setTimeout(() => letter.classList.add('active'), n * letterSpeed);
        }
        // les .space restent invisibles/occupent la place mais ne s'animent pas
      });
    });

    // Calcul du délai avant animation logo / description / bouton
    const delay = maxAnimLetters * letterSpeed + 200;

    setTimeout(() => {
      if (logo) logo.classList.add('active');         // Logo / manette / student glisse
      if (description) description.classList.add('active'); // Description ou message
      if (retour) retour.classList.add('active');     // Bouton retour
    }, delay);
  }

  // --- Page Graphisme ---
  animateSection('.titre-graphisme-layer', '.logo-graphisme', '.conteneur-description-graphisme');

  // --- Page Projet Graphisme ---
  animateSection('.titre-graphisme-layer', '.tree-wrapper', '.conteneur-description-graphisme', '.retour-graphisme');

  // --- Page Projet Arcade ---
  animateSection('.titre-arcade-layer', '.manette-wrapper', '.conteneur-description-arcade', '.retour-arcade');

  // --- Page Étudiant ---
  animateSection('.titre-graphisme-layer', '.student-wrapper', '.conteneur-description-graphisme', '.retour-graphisme');

  // --- Page Projet Finissant ---
  animateSection('.titre-graphisme-layer', '.tree-wrapper', '.conteneur-description-graphisme', '.retour-finissant');

  // --- Page Finissants ---
  animateSection('.titre-finissant-layer', '.logo-finissant', '.conteneur-description-finissant');

  // --- Logo Arcade ---
  animateSection('.titre-arcade-layer', '.logo-arcade', '.conteneur-description-arcade');

  // --- Page Contact ---
  animateSection('.titre-contact-layer');

  // --- Page Erreur 404 ---
  animateSection('.titre-erreur-layer', null, '.message');

  // --- Page Recherche ---
  animateSection('.titre-recherche-layer', null, '.recherche-resultats');

});
