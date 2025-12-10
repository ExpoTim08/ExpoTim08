document.addEventListener("DOMContentLoaded", () => {
  const titreLayersFinissant = document.querySelectorAll('.titre-finissant-layer');
  const logoFinissant = document.querySelector('.logo-finissant');
  const descriptionFinissant = document.querySelector('.conteneur-description-finissant');

  // Fonction pour split les lettres
  function splitLetters(span) {
    const text = span.textContent;
    span.textContent = '';
    span.style.visibility = 'visible'; // montrer le layer après split
    text.split('').forEach(char => {
      const letter = document.createElement('span');
      letter.classList.add('letter');
      letter.textContent = char;
      span.appendChild(letter);
    });
  }

  // Split toutes les layers
  titreLayersFinissant.forEach(layer => splitLetters(layer));

  // Animation lettres
  titreLayersFinissant.forEach(layer => {
    const letters = layer.querySelectorAll('.letter');
    letters.forEach((letter, index) => {
      setTimeout(() => letter.classList.add('active'), index * 150);
    });
  });

  // Logo et description apparaissent en même temps que le titre
  setTimeout(() => {
    logoFinissant.classList.add('active');
    descriptionFinissant.classList.add('active');
  }, 0);
});


document.addEventListener("DOMContentLoaded", () => {
  const titreLayersArcade = document.querySelectorAll('.titre-arcade-layer');
  const logoArcade = document.querySelector('.logo-arcade');
  const descriptionArcade = document.querySelector('.conteneur-description-arcade');

  // Fonction pour split les lettres
  function splitLetters(span) {
    const text = span.textContent;
    span.textContent = '';
    span.style.visibility = 'visible'; // montrer le layer après split
    text.split('').forEach(char => {
      const letter = document.createElement('span');
      letter.classList.add('letter');
      letter.textContent = char;
      span.appendChild(letter);
    });
  }

  // Split toutes les layers
  titreLayersArcade.forEach(layer => splitLetters(layer));

  // Animation lettres
  titreLayersArcade.forEach(layer => {
    const letters = layer.querySelectorAll('.letter');
    letters.forEach((letter, index) => {
      setTimeout(() => letter.classList.add('active'), index * 150);
    });
  });

  // Logo et description apparaissent en même temps que le titre
  setTimeout(() => {
    logoArcade.classList.add('active');
    descriptionArcade.classList.add('active');
  }, 0);
});
