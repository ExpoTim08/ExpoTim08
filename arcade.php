<?php
/*
Template Name: Arcade
*/
require("global.php");
?>
<body <?php body_class(); ?>>

  <?php get_header(); ?>

  <main class="page-arcade">
    <section>
      <h1 class="titre-arcade">Arcade</h1>
      <p class="description-titre">Description</p>
      <p class="description-arcade">Lorem ipsum dolor sit amet, consectetur adipisicing elit. Non fugit exercitationem praesentium deleniti accusamus dicta, sapiente perspiciatis facilis repudiandae, omnis veniam. Quidem omnis doloribus numquam, neque praesentium unde porro eaque!</p>
    </section>

    <p class="filtre">Filtrer</p>

    <section>
      <h2 class="titre-projet-arcade">Nom du projet</h2>
      <img class="image-projet-arcade" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg" alt="">
      <p class="description-projet">Ce projet illustre la fusion entre art visuel et interactivité numérique. Il invite les visiteurs à explorer un univers inspiré des jeux rétro modernisés.</p>
    </section>
  </main>

  <?php //get_footer(); //appelle le footer ?>

  <!-- Scripts JS -->
  <script>const themeUrl = "<?php echo get_template_directory_uri(); ?>";</script>
  <script src="<?php echo get_template_directory_uri(); ?>/menu.js"></script>
  <?php get_footer(); ?>
</body>
</html>
