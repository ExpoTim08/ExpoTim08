// --- JS pour la description déroulante ---

document.addEventListener('click', function (e) {
    const btn = e.target.closest('.button-dropdown-arcade, .conteneur-button-dropdown-arcade, .button-dropdown-graphisme, .conteneur-button-dropdown-graphisme');
    if (!btn) return;
    const card = btn.closest('.carte-projet-arcade, .carte-projet-graphisme--mobile');
    if (!card) return;
    card.classList.toggle('open-desc');
});

