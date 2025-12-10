document.addEventListener("DOMContentLoaded", () => {

  function animateSection(titreSelector, logoSelector = null, descSelector = null, retourSelector = null) {
    const titreLayers = document.querySelectorAll(titreSelector);
    const logo = logoSelector ? document.querySelector(logoSelector) : null;
    const description = descSelector ? document.querySelector(descSelector) : null;
    const retour = retourSelector ? document.querySelector(retourSelector) : null;

    if (!titreLayers.length) return;

    // Split lettres en spans
    function splitLetters(span) {
      const text = span.textContent;
      span.textContent = '';
      span.style.visibility = 'visible';
      text.split('').forEach(char => {
        const letter = document.createElement('span');
        letter.classList.add('letter');
        letter.textContent = char;
        span.appendChild(letter);
      });
    }

    titreLayers.forEach(layer => splitLetters(layer));

    // Animation lettres de gauche à droite
    titreLayers.forEach(layer => {
      const letters = layer.querySelectorAll('.letter');
      letters.forEach((letter, index) => {
        setTimeout(() => letter.classList.add('active'), index * 150);
      });
    });

    // Calcul du délai avant animation logo / description / bouton
    const delay = titreLayers[0].textContent.length * 150 + 200;

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
