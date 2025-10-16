document.addEventListener("DOMContentLoaded", function () {
  const burger = document.querySelector(".menu-burger");
  const menu = document.querySelector(".menu-page");
  const body = document.body;

  if (!burger || !menu) return;

  burger.addEventListener("click", () => {
    burger.classList.toggle("open");
    menu.classList.toggle("open");
    body.classList.toggle("menu-open");
  });
});
