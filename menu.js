document.addEventListener("DOMContentLoaded", function () {
  const burger = document.querySelector(".menu-burger");
  const menu = document.querySelector(".menu-page");
  const body = document.body;

  // Ouvrir/fermer le menu
  burger.addEventListener("click", () => {
    burger.classList.toggle("open");
    menu.classList.toggle("open");
    body.classList.toggle("menu-open");
  });

  // Sous-menu toggle mobile
  const menuItems = document.querySelectorAll(".menu-page .menu li");
  menuItems.forEach(item => {
    const subMenu = item.querySelector('.sub-menu');
    if(subMenu){
      const link = item.querySelector('a');
      link.addEventListener('click', function(e){
        e.preventDefault(); // bloque navigation
        item.classList.toggle('open'); // ouvre/ferme sous-menu
      });
    }
  });
});
