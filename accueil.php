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
    <img id="image-carroussel" src="<?php echo get_template_directory_uri(); ?>/Images/Finissants.jpg" alt="">
  </div>

  <div class="carroussel-choix">
    <div class="bouton-finissants">
      <p class="finissants">FINISSANTS</p>
      <img class="student" src="<?php echo get_template_directory_uri(); ?>/Images/Student.svg" alt="">
    </div>

    <div class="bouton-arcade">
      <p class="arcade arcade-click">ARCADE</p>
      <img class="manette" src="<?php echo get_template_directory_uri(); ?>/Images/Manette.svg" alt="">
    </div>

    <div class="bouton-graphisme">
      <p class="jour-terre">GRAPHISME</p>
      <img class="tree" src="<?php echo get_template_directory_uri(); ?>/Images/Tree.svg" alt="">
    </div>
  </div> <!-- fin carroussel-choix -->

  <div class="arcade-details">
    <p class="sous-titre sous-titre-carroussel">ARCADE</p>
    <p class="description">
      Lorem ipsum dolor sit amet consectetur adipisicing elit. Cupiditate animi voluptate...
    </p>
  </div>
</div>


    <!-------------------------------- Accroche -------------------------------->
    <div class="accroche-conteneur">
      <p class="numeration">1234567</p>
      <p class="numeration-short">123</p>
      <div class="ligne-parallele"></div>
      <p class="accroche">Découvrez l’univers créatif des étudiants de la Technique d’intégration multimédia!</p>
    </div>

    <!-------------------------------- À propos -------------------------------->
    <div class="a-propos-background">
      <div class="a-propos">
        <p class="sous-titre">À propos de TIMVision</p>
        <div class="carroussel-apropos">
          <img class="image-a-propos" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade-404.png" alt="">
          <img class="image-a-propos2" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade-404-2.png" alt="">
          <img class="image-a-propos3" src="<?php echo get_template_directory_uri(); ?>/Images/Arcade-404-3.png" alt="">
        </div>
        <p class="description">« TimVision », c’est la grande célébration annuelle qui met en lumière la diversité et la qualité des projets réalisés par les étudiants. De la première à la troisième année, une exposition unique vous attend : jeux vidéo, sites web, expériences interactives, concepts visuels et bien plus encore. Venez à la rencontre du talent, de l’audace et de l’innovation de la relève. </p>
        <div class="infos-a-propos">
          <p id="date">Date:</p>
          <p id="heure">Heure:</p>
          <p id="lieu">Lieu:</p>
        </div>
      </div>
    </div>

    <!-------------------------------- Projets Découvertes -------------------------------->
    <div class="projets-populaire">
      <h1>PROJETS Découvertes</h1>
      <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Provident minus sit exercitationem...</p>
      <div class="projets">

      <?php
      // Get 2 random UNIQUE arcade projects
      $arcade_query = new WP_Query([
      'post_type'      => 'projet-arcade',
      'posts_per_page' => 2,      // two posts
      'orderby'        => 'rand', // random order
      ]);

      $arcadeItems = [];

      if ($arcade_query->have_posts()) :
      while ($arcade_query->have_posts()) : $arcade_query->the_post();

      $nom   = get_field('nom_du_projet');
      $image = get_field('image_du_projet');

      if ($image) {
        $arcadeItems[] = [
          'title' => $nom,
          'url'   => $image['url']
        ];
      }

      endwhile;
      endif;

      wp_reset_postdata();
      ?>

      <?php
      // Get 2 random UNIQUE graphisme projects
      $graphisme_query = new WP_Query([
      'post_type'      => 'projet-graphisme',
      'posts_per_page' => 2,      // pick two
      'orderby'        => 'rand', // random order
      ]);

      $graphismeItems = [];

      if ($graphisme_query->have_posts()) :
      while ($graphisme_query->have_posts()) : $graphisme_query->the_post();

      $titre       = get_the_title();
      $image       = get_field('affiche'); // ACF field

      if ($image) {
      $graphismeItems[] = [
        'title' => $titre,
        'url'   => $image['url'],
      ];
      }

      endwhile;
      endif;

      wp_reset_postdata();
      ?>

        <!-- Exemple projet Arcade -->
        <div class="projet-populaire-arcade">
          <span class="titre"><?php echo $arcadeItems[0]['title']; ?></span>
          <span class="bouton">>></span>
          <span class="categorie">Catégorie</span>
          <span class="categorie-nom">ARCADE</span>
          <img class="image-populaire-arcade" src="<?php echo $arcadeItems[0]['url']; ?>" alt="">
        </div>

        <!-- Projet Jour de la Terre -->
        <div class="projet-populaire-jour-terre">
          <span class="titre"><?php echo $graphismeItems[0]['title']; ?></span>
          <span class="bouton">>></span>
          <span class="categorie">Catégorie</span>
          <span class="categorie-nom">JOUR DE LA TERRE</span>
          <img class="image-populaire-jour-terre" src="<?php echo $graphismeItems[0]['url']; ?>" alt="">
        </div>

        <div class="projet-populaire-arcade">
          <span class="titre"><?php echo $arcadeItems[1]['title']; ?></span>
          <span class="bouton">>></span>
          <span class="categorie">Catégorie</span>
          <span class="categorie-nom">ARCADE</span>
          <img class="image-populaire-arcade" src="<?php echo $arcadeItems[1]['url']; ?>" alt="">
        </div>

        <div class="projet-populaire-jour-terre">
          <span class="titre"><?php echo $graphismeItems[1]['title']; ?></span>
          <span class="bouton">>></span>
          <span class="categorie">Catégorie</span>
          <span class="categorie-nom">JOUR DE LA TERRE</span>
          <img class="image-populaire-jour-terre" src="<?php echo $graphismeItems[1]['url']; ?>" alt="">
        </div>

        <!-- Projet Finissants
        <div class="projet-populaire-finissant">
          <span class="titre">TITRE</span>
          <span class="bouton">>></span>
          <span class="categorie">Catégorie</span>
          <span class="categorie-nom">PROJETS DES FINISSANTS</span>
          <img class="image-populaire-finissants" src="<?php echo get_template_directory_uri(); ?>/Images/FinissantsPopulaire.png" alt="">
        </div> -->
      </div>
    </div>

    <!-------------------------------- Partenaires -------------------------------->
    <!-- <div class="partenaires">
      <h1>Partenaires</h1>
      <img src="<?php echo get_template_directory_uri(); ?>/Images/MaisonneuveLogo.png" alt="">
      <img src="<?php echo get_template_directory_uri(); ?>/Images/MaisonneuveLogo.png" alt="">
      <img src="<?php echo get_template_directory_uri(); ?>/Images/MaisonneuveLogo.png" alt="">
    </div> -->

    <!-------------------------------- Équipe -------------------------------->
    <div class="equipe">
      <h1>Crédits</h1>
      <div class="cartes">
        <div class="carte-equipe">
          <span class="photo">
            <img class="img-personne" src="<?php echo get_template_directory_uri(); ?>/Images/PlaceholderPersonne.png" alt="Photo de Lîna Bensenouci">
          </span>
          <span class="nom">Lîna Bensenouci</span>
          <span class="role">Rôle</span>
          <span class="petits-carre"></span>
        </div>
        <div class="carte-equipe-2">
          <span class="photo"></span>
          <span class="nom">Peterson Germain</span>
          <span class="role">Rôle</span>
          <span class="petits-carre">
            <img class="img-personne" src="<?php echo get_template_directory_uri(); ?>/Images/PlaceholderPersonne.png" alt="Photo de Peterson Germain">
          </span>
        </div>
        <div class="carte-equipe-3">
          <span class="photo">
            <img class="img-personne" src="<?php echo get_template_directory_uri(); ?>/Images/PlaceholderPersonne.png" alt="Photo de Matilda Kang">
          </span>
          <span class="nom">Matilda Kang</span>
          <span class="role">Rôle</span>
          <span class="petits-carre"></span>
        </div>
        <div class="carte-equipe-4">
          <span class="photo"></span>
          <span class="nom">Rémy Roger</span>
          <span class="role">Rôle</span>
          <span class="petits-carre">
            <img class="img-personne" src="<?php echo get_template_directory_uri(); ?>/Images/PlaceholderPersonne.png" alt="Photo de Rémy Roger">
          </span>
        </div>
        <div class="carte-equipe-5">
          <span class="photo">
            <img class="img-personne" src="<?php echo get_template_directory_uri(); ?>/Images/PlaceholderPersonne.png" alt="Photo de Alexis David">
          </span>
          <span class="nom">Alexis David</span>
          <span class="role">Rôle</span>
          <span class="petits-carre"></span>
        </div>
      </div>
    </div>
  </main>

  <!-- Variables globales JS -->
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
