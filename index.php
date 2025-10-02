<?php
/* 
 * Template principal du thème 
 */
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?></title>

  <!-- Appeler automatiquement le style.css du thème -->
  <link rel="stylesheet" href="<?php echo get_stylesheet_uri(); ?>">

  <!-- Appeler tes autres fichiers CSS -->
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/CSS/accueil.css">
  <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/CSS/main.css">
  
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <header>     
  </header>

  <main>
    <div class="Carroussel">
      <img class="ImageArcadeCarroussel" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg" alt="">
      <img class="ImageTitre" src="<?php echo get_template_directory_uri(); ?>/Images/Texte.png" alt="">

      <div class="ArcadeDetails">
        <p class="Sous-titre">ARCADE</p>
        <p class="Description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate animi voluptate...</p>
        <p class="Plus">Voir plus</p>
      </div>

      <div class="CarrousselChoix">
        <p class="Arcade">ARCADE</p>
        <p class="JT">JOUR DE LA TERRE</p>
        <p class="PF">PROJETS DES FINISSANTS</p>
      </div>
    </div>

    <div class="APropos">
      <p class="Sous-titre">À propos de l'expo TIM</p>
      <img class="ImageAPropos" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg" alt="">
      <p class="Description">Lorem ipsum dolor sit amet consectetur adipisicing elit...</p>
    </div>

    <div class="Horaire">
      <p class="Sous-titre">HORAIRE</p>
      <div class="HoraireExposition">
        <p>Exposition</p>
        <p>Heures</p>
      </div>
      <div class="ArcadeHoraire">
        <p>Arcade</p>
        <p>XX:XX</p>
      </div>
      <div class="JTHoraire">
        <p>Jour de la Terre</p>
        <p>XX:XX</p>
      </div>
      <div class="PFHoraire">
        <p>Projet de finissants</p>
        <p>XX:XX</p>
      </div>
    </div>
  </main>

  <?php wp_footer(); ?>
</body>
</html>
