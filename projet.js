// --- JS pour la description déroulante ---

document.addEventListener('click', function (e) {
    const btn = e.target.closest('.button-dropdown-arcade, .conteneur-button-dropdown-arcade, .button-dropdown-graphisme, .conteneur-button-dropdown-graphisme, .button-dropdown-finissant, .conteneur-button-dropdown-finissant');
    if (!btn) return;
    const card = btn.closest('.carte-projet-arcade, .carte-projet-graphisme--mobile, .carte-projet-finissant--mobile');
    if (!card) return;
    card.classList.toggle('open-desc');
});
// --- Fin JS pour la description déroulante ---

// --- Toggle description for search mobile cards ---
document.addEventListener('click', function (e) {
    const btn = e.target.closest('.button-toggle-desc');
    if (!btn) return;

    // Only active on mobile breakpoint
    if (!window.matchMedia('(max-width: 576px)').matches) return;

    const article = btn.closest('.projet-card');
    if (!article) return;

    const descId = btn.getAttribute('aria-controls');
    const desc = descId ? document.getElementById(descId) : article.querySelector('.projet-description');
    if (!desc) return;

    const open = article.classList.toggle('desc-open');
    btn.setAttribute('aria-expanded', open ? 'true' : 'false');

    if (open) {
        setTimeout(function () {
            desc.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        }, 120);
    }
});
// --- End toggle description handler ---
