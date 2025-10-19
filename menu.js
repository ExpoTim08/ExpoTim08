document.addEventListener("DOMContentLoaded", function () {
  const burger = document.querySelector(".menu-burger");
  const menu = document.querySelector(".menu-page");
  const body = document.body;
  const MenuItems = document.querySelectorAll(".menu-page .menu li");

  if (!burger || !menu) return;

  burger.addEventListener("click", () => {
    burger.classList.toggle("open");
    menu.classList.toggle("open");
    body.classList.toggle("menu-open");
  });

    //Pour chaque menu(item) contenant un sous-menu
    MenuItems.forEach(item => {
      item.addEventListener('click', function(ev) {
        item.classList.toggle('open');
    });
  });
});
