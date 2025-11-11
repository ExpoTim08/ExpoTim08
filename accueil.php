<?php
/* 
 * Template principal du thème ThemeExpo
 */
require("global.php");
?>

<body <?php body_class(); ?>>
  <div class="border gauche"></div>
  <div class="border droite"></div>
  <?php get_header(); ?>

  <main>
    <!----------------------------------------------- PHP Section Carroussel --------------------------------------------->
    <div class="carroussel">
      <div class="image-wrap">
        <img id="image-carroussel" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg" alt="">
      </div>
      <img class="image-titre" src="<?php echo get_template_directory_uri(); ?>/Images/Texte.png" alt="">

      <div class="arcade-details">
        <p class="sous-titre sous-titre-carroussel">ARCADE</p>
        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate animi voluptate...</p>
        <a href="<?php echo get_permalink( get_page_by_path('arcade') ); ?>" class="plus">Voir Plus</a>
      </div>

      <div class="carroussel-choix">
        <p class="arcade arcade-click" onclick="ChangeImageManuel('<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg')">ARCADE</p> 
        <p class="jour-terre" onclick="ChangeImageManuel('<?php echo get_template_directory_uri(); ?>/Images/Nature.jpeg')">JOUR DE LA TERRE</p>
        <p class="finissants" onclick="ChangeImageManuel('<?php echo get_template_directory_uri(); ?>/Images/Finissants.jpg')">PROJETS DES FINISSANTS</p>
      </div>
    </div>

    <!------------------------------------------------ PHP Section Accroche --------------------------------------------->
    <div class="accroche-conteneur">
      <p class="numeration">1234567</p>
      <div class="ligne-parallele"></div>
      <p class="accroche">Découvrez l’univers créatif des étudiants de la Technique d’intégration multimédia! </p>
    </div>

    <!------------------------------------------------ PHP Section À propos --------------------------------------------->
    <div class="a-propos-background">
      <div class="a-propos">
        <p class="sous-titre">À propos de TIMVision</p>
        <img class="image-a-propos" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg" alt="">
        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit...</p>
      </div>
    </div>

    <!------------------------------------------- PHP Section Projets Populaire ----------------------------------------->
    <div class="projets-populaire">
      <h1>PROJETS POPULAIRE</h1>
      <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Provident minus sit exercitationem. Facere repudiandae error enim labore! Quibusdam, tempore? Necessitatibus magni illum, adipisci dicta nostrum sequi iure. Dolor, nulla dignissimos?</p>
      <div class="projets">
        <div class="projet-populaire-arcade">
          <span class="titre">TITRE</span>
          <span class="bouton">>></span>
          <span class="categorie">Catégorie</span>
          <span class="categorie-nom">ARCADE</span>
          <img class="image-populaire-arcade" src="<?php echo get_template_directory_uri(); ?>/Images/EcotidienArcade.png" alt="">
        </div>

        <div class="background"></div>
        <div class="background2"></div>

        <div class="description-populaire-arcade">
          <span class="description">Description</span>
          <span class="moins">[-]</span>
        </div>
        <div class="projet-populaire-jour-terre">
          <span class="titre">TITRE</span>
          <span class="bouton">>></span>
          <span class="categorie">Catégorie</span>
          <span class="categorie-nom">JOUR DE LA TERRE</span>
          <img class="image-populaire-jour-terre" src="<?php echo get_template_directory_uri(); ?>/Images/EcotidienJourTerre.png" alt="">
        </div>
        
        <div class="description-populaire-jour-terre">
          <span class="description">Description</span>
          <span class="moins">[-]</span>
        </div>
        <div class="projet-populaire-finissant">
          <span class="titre">TITRE</span>
          <span class="bouton">>></span>
          <span class="categorie">Catégorie</span>
          <span class="categorie-nom">PROJETS DES FINISSANTS</span>
          <img class="image-populaire-finissants" src="<?php echo get_template_directory_uri(); ?>/Images/FinissantsPopulaire.png" alt="">
        </div>
        
        <div class="description-populaire-finissants">
          <span class="description">Description</span>
          <span class="moins">[-]</span>
        </div>
      </div>
    </div>

    <!--------------------------------------------- PHP Section Partenaires --------------------------------------------->
    <div class="partenaires">
      <h1>Partenaires</h1>
      <img src="<?php echo get_template_directory_uri(); ?>/Images/MaisonneuveLogo.png" alt="">
      <img src="<?php echo get_template_directory_uri(); ?>/Images/MaisonneuveLogo.png" alt="">
      <img src="<?php echo get_template_directory_uri(); ?>/Images/MaisonneuveLogo.png" alt="">
    </div>

    <!------------------------------------------------ PHP Section Équipes --------------------------------------------->
    <div class="equipe">
      <h1>L'équipe</h1>
      <div class="cartes">
        <div class="carte-equipe">
          <span class="photo"></span>
          <span class="nom">Nom</span>
          <span class="role">Role</span>
          <span class="petits-carre"></span>
        </div>
        <div class="carte-equipe-2">
          <span class="photo"></span>
          <span class="nom">Nom</span>
          <span class="role">Role</span>
          <span class="petits-carre"></span>
        </div>
        <div class="carte-equipe-3">
          <span class="photo"></span>
          <span class="nom">Nom</span>
          <span class="role">Role</span>
          <span class="petits-carre"></span>
        </div>
        <div class="carte-equipe-4">
          <span class="photo"></span>
          <span class="nom">Nom</span>
          <span class="role">Role</span>
          <span class="petits-carre"></span>
        </div>
        <div class="carte-equipe-5">
          <span class="photo"></span>
          <span class="nom">Nom</span>
          <span class="role">Role</span>
          <span class="petits-carre"></span>
        </div>
      </div>
    </div>
  </main>

  <!-- Script JS correctement lié depuis le dossier de thème -->
  <script>const themeUrl = "<?php echo get_template_directory_uri(); ?>";</script>
  <script src="<?php echo get_template_directory_uri(); ?>/accueil.js"></script>

  <?php get_footer(); ?>
</body>
</html>
