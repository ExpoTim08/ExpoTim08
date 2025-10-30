// --- JS pour la description déroulante ---

document.addEventListener('click', function (e) {
    const btn = e.target.closest('.button-dropdown-arcade, .conteneur-button-dropdown-arcade');
    if (!btn) return;
    const card = btn.closest('.carte-projet-arcade');
    if (!card) return;
    card.classList.toggle('open-desc');
});