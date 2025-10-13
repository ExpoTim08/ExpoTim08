<?php
/* 
 * Template principal du thème ThemeExpo
 */
?>

<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title><?php bloginfo('name'); ?></title>

    <!-- Appeler tes autres fichiers CSS -->
    <link rel="stylesheet" href="<?php echo get_template_directory_uri(); ?>/CSS/accueil.css">
  
  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
  <div class="Border Gauche"></div>
  <div class="Border Droite"></div>
  <header>     
  </header>

  <main>
    <div class="Carroussel">
      <img id="ImageCarroussel" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg" alt="">
      <img class="ImageTitre" src="<?php echo get_template_directory_uri(); ?>/Images/Texte.png" alt="">

      <div class="ArcadeDetails">
        <p class="Sous-titre Sous-titreCarroussel">ARCADE</p>
        <p class="Description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate animi voluptate...</p>
        <a href="<?php echo get_permalink( get_page_by_path('arcade') ); ?>" class="Plus">Voir Plus</a>

      </div>

      <div class="CarrousselChoix">
        <p class="Arcade ArcadeClick" onclick="ChangeImageManuel('<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg')">ARCADE</p> 
        <p class="JourTerre" onclick="ChangeImageManuel('<?php echo get_template_directory_uri(); ?>/Images/Nature.jpeg')">JOUR DE LA TERRE</p>
        <p class="PF" onclick="ChangeImageManuel('<?php echo get_template_directory_uri(); ?>/Images/Finissants.jpg')">PROJETS DES FINISSANTS</p>
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
      <div class="JourTerreHoraire">
        <p>Jour de la Terre</p>
        <p>XX:XX</p>
      </div>
      <div class="PFHoraire">
        <p>Projet de finissants</p>
        <p>XX:XX</p>
      </div>
    </div>
  </main>

  <!-- ✅ Script JS correctement lié depuis ton dossier de thème -->
   <script>
    const themeUrl = "<?php echo get_template_directory_uri(); ?>";
    </script>

  <script src="<?php echo get_template_directory_uri(); ?>/accueil.js"></script>

  <?php wp_footer(); ?>
</body>
</html>
