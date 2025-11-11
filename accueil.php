<?php
/* 
 * Template principal du thème ThemeExpo
 */
require("global.php");
get_header();
?>

<body <?php body_class(); ?>>
  <div class="border gauche"></div>
  <div class="border droite"></div>

  <main>
    <!-------------------------------- Carroussel -------------------------------->
    <div class="carroussel">
      <div class="image-wrap">
        <img id="image-carroussel" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg" alt="">
      </div>
      <img class="image-titre" src="<?php echo get_template_directory_uri(); ?>/Images/Texte.png" alt="">

      <div class="arcade-details">
        <p class="sous-titre sous-titre-carroussel">ARCADE</p>
        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate animi voluptate...</p>
        <a href="<?php echo get_permalink(get_page_by_path('arcade')); ?>" class="plus">Voir Plus</a>
      </div>

      <div class="carroussel-choix">
        <p class="arcade arcade-click" onclick="ChangeImageManuel('<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg')">ARCADE</p> 
        <p class="jour-terre" onclick="ChangeImageManuel('<?php echo get_template_directory_uri(); ?>/Images/Nature.jpeg')">JOUR DE LA TERRE</p>
        <p class="finissants" onclick="ChangeImageManuel('<?php echo get_template_directory_uri(); ?>/Images/Finissants.jpg')">PROJETS DES FINISSANTS</p>
      </div>
    </div>

    <!-------------------------------- Accroche -------------------------------->
    <div class="accroche-conteneur">
      <p class="numeration">1234567</p>
      <div class="ligne-parallele"></div>
      <p class="accroche">Découvrez l’univers créatif des étudiants de la Technique d’intégration multimédia!</p>
    </div>

    <!-------------------------------- À propos -------------------------------->
    <div class="a-propos-background">
      <div class="a-propos">
        <p class="sous-titre">À propos de TIMVision</p>
        <img class="image-a-propos" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade.jpg" alt="">
        <p class="description">Lorem ipsum dolor sit amet consectetur adipisicing elit...</p>
      </div>
    </div>

    <!-------------------------------- Projets Populaire -------------------------------->
    <div class="projets-populaire">
      <h1>PROJETS POPULAIRES</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident minus sit exercitationem...</p>
      <div class="projets">
        <!-- Exemple projet Arcade -->
        <div class="projet-populaire-arcade">
          <span class="titre">TITRE</span>
          <span class="bouton">>></span>
          <span class="categorie">Catégorie</span>
          <span class="categorie-nom">ARCADE</span>
          <img class="image-populaire-arcade" src="<?php echo get_template_directory_uri(); ?>/Images/EcotidienArcade.png" alt="">
        </div>

        <!-- Projet Jour de la Terre -->
        <div class="projet-populaire-jour-terre">
          <span class="titre">TITRE</span>
          <span class="bouton">>></span>
          <span class="categorie">Catégorie</span>
          <span class="categorie-nom">JOUR DE LA TERRE</span>
          <img class="image-populaire-jour-terre" src="<?php echo get_template_directory_uri(); ?>/Images/EcotidienJourTerre.png" alt="">
        </div>

        <!-- Projet Finissants -->
        <div class="projet-populaire-finissant">
          <span class="titre">TITRE</span>
          <span class="bouton">>></span>
          <span class="categorie">Catégorie</span>
          <span class="categorie-nom">PROJETS DES FINISSANTS</span>
          <img class="image-populaire-finissants" src="<?php echo get_template_directory_uri(); ?>/Images/FinissantsPopulaire.png" alt="">
        </div>
      </div>
    </div>

    <!-------------------------------- Partenaires -------------------------------->
    <div class="partenaires">
      <h1>Partenaires</h1>
      <img src="<?php echo get_template_directory_uri(); ?>/Images/MaisonneuveLogo.png" alt="">
      <img src="<?php echo get_template_directory_uri(); ?>/Images/MaisonneuveLogo.png" alt="">
      <img src="<?php echo get_template_directory_uri(); ?>/Images/MaisonneuveLogo.png" alt="">
    </div>

    <!-------------------------------- Équipe -------------------------------->
    <div class="equipe">
      <h1>L'équipe</h1>
      <div class="cartes">
        <div class="carte-equipe">
          <span class="photo"></span>
          <span class="nom">Nom</span>
          <span class="role">Rôle</span>
          <span class="petits-carre"></span>
        </div>
        <div class="carte-equipe-2">
          <span class="photo"></span>
          <span class="nom">Nom</span>
          <span class="role">Rôle</span>
          <span class="petits-carre"></span>
        </div>
        <div class="carte-equipe-3">
          <span class="photo"></span>
          <span class="nom">Nom</span>
          <span class="role">Rôle</span>
          <span class="petits-carre"></span>
        </div>
        <div class="carte-equipe-4">
          <span class="photo"></span>
          <span class="nom">Nom</span>
          <span class="role">Rôle</span>
          <span class="petits-carre"></span>
        </div>
        <div class="carte-equipe-5">
          <span class="photo"></span>
          <span class="nom">Nom</span>
          <span class="role">Rôle</span>
          <span class="petits-carre"></span>
        </div>
      </div>
    </div>
  </main>

  <!-- Déclaration themeVars une seule fois -->
  <script>
    var themeVars = themeVars || {};
    themeVars.themeUrl = "<?php echo get_template_directory_uri(); ?>";
    themeVars.pageArcade = "<?php echo get_permalink(get_page_by_path('arcade')); ?>";
    themeVars.pageJourTerre = "<?php echo get_permalink(get_page_by_path('jour-de-la-terre')); ?>";
    themeVars.pageFinissants = "<?php echo get_permalink(get_page_by_path('projet-des-finissants')); ?>";
  </script>

  <!-- JS du carroussel -->
  <script src="<?php echo get_template_directory_uri(); ?>/accueil.js"></script>

<?php get_footer(); ?>
</body>
</html>
