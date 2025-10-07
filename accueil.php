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
      <img id="ImageCarroussel" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg" alt="">
      <img class="ImageTitre" src="<?php echo get_template_directory_uri(); ?>/Images/Texte.png" alt="">

      <div class="ArcadeDetails">
        <p class="Sous-titre Sous-titreCarroussel">ARCADE</p>
        <p class="Description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate animi voluptate...</p>
        <p class="Plus">Voir plus</p>
      </div>

      <div class="CarrousselChoix">
        <p class="Arcade ArcadeClick" onclick="changeImage('<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg')">ARCADE</p> 
        <p class="JourTerre" onclick="changeImage('<?php echo get_template_directory_uri(); ?>/Images/Nature.jpeg')">JOUR DE LA TERRE</p>
        <p class="PF" onclick="changeImage('<?php echo get_template_directory_uri(); ?>/Images/Finissants.jpg')">PROJETS DES FINISSANTS</p>
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
  <script src="<?php echo get_template_directory_uri(); ?>/accueil.js"></script>

  <!-- Script interne pour le carrousel -->
  <script>
    function changeImage(newSrc) {
      document.getElementById('ImageCarroussel').src = newSrc;

      if(newSrc.includes('Arcade')) {
        document.querySelector('.Sous-titreCarroussel').innerText = "ARCADE";
        document.querySelector('.Arcade').classList.add('ArcadeClick');
        document.querySelector('.JourTerre').classList.remove('JourTerreClick');
        document.querySelector('.PF').classList.remove('PFClick');
      }

      else if(newSrc.includes('Nature')) {
        document.querySelector('.Sous-titreCarroussel').innerText = "JOUR DE LA TERRE";
        document.querySelector('.JourTerre').classList.add('JourTerreClick');
        document.querySelector('.Arcade').classList.remove('ArcadeClick');
        document.querySelector('.PF').classList.remove('PFClick');
      }

      else if(newSrc.includes('Finissants')) {
        document.querySelector('.Sous-titreCarroussel').innerText = "PROJETS DES FINISSANTS";
        document.querySelector('.PF').classList.add('PFClick');
        document.querySelector('.JourTerre').classList.remove('JourTerreClick');
        document.querySelector('.Arcade').classList.remove('ArcadeClick');
      }
    }
  </script>

  <?php wp_footer(); ?>
</body>
</html>
