// --- JS pour la description déroulante ---

document.addEventListener('click', function (e) {
    const btn = e.target.closest('.button-dropdown-arcade, .conteneur-button-dropdown-arcade, .button-dropdown-graphisme, .conteneur-button-dropdown-graphisme, .button-dropdown-finissant, .conteneur-button-dropdown-finissant');
    if (!btn) return;
    const card = btn.closest('.carte-projet-arcade, .carte-projet-graphisme--mobile, .carte-projet-finissant--mobile');
    if (!card) return;
    card.classList.toggle('open-desc');
});
// --- Fin JS pour la description déroulante ---
