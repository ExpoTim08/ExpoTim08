<?php
/*
Template Name: Arcade
*/
require("global.php");
?>
<body <?php body_class(); ?>>
  <div class="border gauche"></div>
  <div class="border droite"></div>

  <?php get_header(); ?>

  <main class="page-arcade">

    <section class="presentation-arcade">
      <h1 class="titre-arcade" aria-label="arcade">
        <span class="titre-arcade-layer titre-arcade--base">ARCADE</span>
        <span class="titre-arcade-layer titre-arcade-layer--1">ARCADE</span>
        <span class="titre-arcade-layer titre-arcade-layer--2">ARCADE</span>
        <span class="titre-arcade-layer titre-arcade-layer--3">ARCADE</span>
      </h1>

      <span class="conteneur-description-arcade">
        <p class="description-titre">Description</p>
        <p class="description-texte">L’Arcade de l’expoTIM présente les prototypes de jeux vidéo créés par les étudiants de deuxième année en Technique d’intégration multimédia. Réalisés dans le cadre du cours Création de jeu en équipe, ces projets sont le fruit d’un processus de production complet : de la conception et la planification à la création des médias, de la programmation aux tests de qualité jusqu’au produit fini. </p>
      </span>
    </section>

    <span class="conteneur-section-arcade-bas">
      <div class="conteneur-arcade-filtre">
        <p class="filtre">Filtrer</p>
      </div>

      <section class="liste-projet-arcade">
        <div class="carte-projet-arcade">
          <span class="conteneur-carte-haut">
            <h2 class="titre-projet-arcade">Nom du projet</h2>
            <button class="button-projet-arcade">>></button>
          </span>
          <img class="image-projet-arcade" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg" alt="">

          <div class="conteneur-carte-bas">
            <span class="conteneur-button-dropdown-arcade">
              <p class="carte-arcade-titre-description">Description</p>
              <button class="button-dropdown-arcade">+</button>
            </span>
            <div class="dropdown-carte-arcade">
              <p class="description-projet">Ce projet illustre la fusion entre art visuel et interactivité numérique. Il invite les visiteurs à explorer un univers inspiré des jeux rétro modernisés.</p>
          </div>
          </div>
      </section>
    </span>
  </main>

  <?php get_footer(); //appelle le footer ?>

  <!-- Scripts JS -->
  <script>const themeUrl = "<?php echo get_template_directory_uri(); ?>";</script>
  <script src="<?php echo get_template_directory_uri(); ?>/menu.js"></script>
  <?php get_footer(); ?>
</body>
</html>
