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
      <div class="ImageWrap"><img id="ImageCarroussel" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg" alt=""></div>
      <img class="ImageTitre" src="<?php echo get_template_directory_uri(); ?>/Images/Texte.png" alt="">

      <div class="ArcadeDetails">
        <p class="Sous-titre Sous-titreCarroussel">ARCADE</p>
        <p class="Description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate animi voluptate...</p>
        <a href="<?php echo get_permalink( get_page_by_path('arcade') ); ?>" class="Plus">Voir Plus</a>
      </div>

      <div class="CarrousselChoix">
        <p class="Arcade ArcadeClick" onclick="ChangeImageManuel('<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg')">ARCADE</p> 
        <p class="JourTerre" onclick="ChangeImageManuel('<?php echo get_template_directory_uri(); ?>/Images/Nature.jpeg')">JOUR DE LA TERRE</p>
        <p class="Finissants" onclick="ChangeImageManuel('<?php echo get_template_directory_uri(); ?>/Images/Finissants.jpg')">PROJETS DES FINISSANTS</p>
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
        <span class="Heure">13:00</span>
        <div class="ArcadeHoraire">
          <span class="Sous-titre">Arcade</span>
          <span>Indisponible</span>
        </div>
        <div class="JourTerreHoraire">
         <span class="Sous-titre">Jour de la Terre</span>
         <span>Indisponible</span>
        </div>
        <div class="FinissantsHoraire">
          <span class="Sous-titre">Projet de finissants</span>
          <span>Indisponible</span>
        </div> 
      </div>

      <div class="GrilleHoraire">
        <span class="HeureClick">13:00</span>
        <span>14:00</span>
        <span>15:00</span>
        <span>16:00</span>
        <span>17:00</span>
        <span>18:00</span>
        <span>19:00</span>
        <span>20:00</span>
      </div>
    </div>

    <div class="ProjetsPopulaire">
      <h1>PROJETS POPULAIRE</h1>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident minus sit exercitationem. Facere repudiandae error enim labore! Quibusdam, tempore? Necessitatibus magni illum, adipisci dicta nostrum sequi iure. Dolor, nulla dignissimos?</p>
      <div class="ProjetPopulaireArcade">
        <span class="Titre">TITRE</span>
        <span class="Bouton">>></span>
        <span class="Categorie">Catégorie</span>
        <span class="CategorieNom">ARCADE</span>
      </div>
      <img class="ImagePopulaireArcade" src="<?php echo get_template_directory_uri(); ?>/Images/EcotidienArcade.png" alt="">

      <div class="DescriptionPopulaireArcade">
        <span class="Description">Description</span>
        <span class="Moins">[-]</span>
      </div>

      <div class="ProjetPopulaireJourTerre">
        <span class="Titre">TITRE</span>
        <span class="Bouton">>></span>
        <span class="Categorie">Catégorie</span>
        <span class="CategorieNom">JOUR DE LA TERRE</span>
      </div>
      <img class="ImagePopulaireJourTerre" src="<?php echo get_template_directory_uri(); ?>/Images/EcotidienJourTerre.png" alt="">

      <div class="DescriptionPopulaireJourTerre">
        <span class="Description">Description</span>
        <span class="Moins">[-]</span>
      </div>

      <div class="ProjetPopulaireFinissant">
        <span class="Titre">TITRE</span>
        <span class="Bouton">>></span>
        <span class="Categorie">Catégorie</span>
        <span class="CategorieNom">PROJETS DES FINISSANTS</span>
      </div>
      <img class="ImagePopulaireFinissants" src="<?php echo get_template_directory_uri(); ?>/Images/FinissantsPopulaire.png" alt="">

      <div class="DescriptionPopulaireFinissants">
        <span class="Description">Description</span>
        <span class="Moins">[-]</span>
      </div>
      
    </div>
  </main>

  <!-- Script JS correctement lié depuis le dossier de thème -->
   <script>const themeUrl = "<?php echo get_template_directory_uri(); ?>";</script>
   <script src="<?php echo get_template_directory_uri(); ?>/accueil.js"></script>

  <?php wp_footer(); ?>
</body>
</html>
