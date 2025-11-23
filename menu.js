document.addEventListener("DOMContentLoaded", function () {
  const burger = document.querySelector(".menu-burger");
  const menu = document.querySelector(".menu-page");
  const body = document.body;

  // Ouvrir / fermer le menu principal
  burger.addEventListener("click", () => {
    burger.classList.toggle("open");
    menu.classList.toggle("open");
    body.classList.toggle("menu-open");
  });

  // Basculer les sous-menus sur mobile
  const menuItems = document.querySelectorAll(".menu-page .menu li");
  menuItems.forEach(item => {
    const subMenu = item.querySelector('.sub-menu');
    if (subMenu) {
      const link = item.querySelector('a');
      link.addEventListener('click', function (e) {
        e.preventDefault(); // Empêche la navigation pour ouvrir le sous-menu
        item.classList.toggle('open'); // Ouvre / ferme le sous-menu
      });
    }
  });

  // --- Recherche extensible (premier clic développe, se referme au dé-focalisation) ---
  (function expandingSearchBarTablet() {
    var forms = document.querySelectorAll('.menu-search-desktop .search-form');
    if (!forms || forms.length === 0) return;

    forms.forEach(function (form) {
      var input = form.querySelector('.search-field');
      var btn = form.querySelector('button[type="submit"]');

      form.classList.add('collapsed');

      function expand() {
        form.classList.remove('collapsed');
        form.classList.add('expanded');
        setTimeout(function () { input && input.focus(); }, 10);
      }

      function collapse() {
        form.classList.remove('expanded');
        form.classList.add('collapsed');
      }

      if (btn) {
        var submitIfFocused = false;
        btn.addEventListener('pointerdown', function () {
          // Si l'utilisateur appuie sur le bouton alors que le champ est focalisé,
          // on doit autoriser la soumission au relâchement.
          submitIfFocused = (form.classList.contains('expanded') && input && document.activeElement === input);
        });

        btn.addEventListener('click', function (e) {
          if (submitIfFocused) { submitIfFocused = false; return; } // autorise la soumission
          if (!form.classList.contains('expanded')) { e.preventDefault(); expand(); return; }
          if (document.activeElement !== input) { e.preventDefault(); input && input.focus(); return; }
          // sinon laisser la soumission se produire
        });
      }

      // Clic dans le formulaire : l'ouvre si elle est réduite
      form.addEventListener('click', function () { if (!form.classList.contains('expanded')) expand(); });
      // Perte de focus : refermer si le focus n'est plus dans le formulaire
      form.addEventListener('focusout', function () { setTimeout(function () { if (!form.contains(document.activeElement)) collapse(); }, 0); });
    });
  })();
});
