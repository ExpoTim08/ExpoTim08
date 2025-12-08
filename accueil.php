<?php
/* 
 Template Name: Page accueil
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
    <img id="image-carroussel" src="<?php echo get_template_directory_uri(); ?>/Images/Finissants.png" alt="">
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
      <p class="accroche"><?php echo esc_html(get_theme_mod('expoTim_home_hook')); ?></p>
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
        <p class="description"><?php echo wp_kses_post(get_theme_mod('expoTim_home_about')); ?></p>
        <div class="infos-a-propos">
          <p id="date">Date: <?php echo esc_html(get_theme_mod('expoTim_home_date')); ?></p>
          <p id="heure">Heure: <?php echo esc_html(get_theme_mod('expoTim_home_time')); ?> </p>
          <p id="lieu">Lieu: <?php echo esc_html(get_theme_mod('expoTim_home_place')); ?></p>
        </div>
      </div>
    </div>

<!-------------------------------- Projets Découvertes -------------------------------->
<div class="projets-populaire">
  <h1>Voici des projets à découvrir</h1>
  <div class="boutonRefresh">
    <img class="refresh" src="<?php echo get_template_directory_uri(); ?>/Images/Refresh.svg" alt="">
    <span>Raffraichis les projets</span>
  </div>
  <div class="projets" id="projets-container">

  <?php
  // Get 1 random UNIQUE arcade projects
  $arcade_query = new WP_Query([
    'post_type'      => 'projet-arcade',
    'posts_per_page' => 1,      // two posts
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
          'url'   => $image['url'],
          'id'    => get_the_ID()
        ];
      }

    endwhile;
  endif;

  wp_reset_postdata();
  ?>

  <?php
  // Get 1 random UNIQUE graphisme projects
  $graphisme_query = new WP_Query([
    'post_type'      => 'projet-graphisme',
    'posts_per_page' => 1,      // pick two
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
          'id'    => get_the_ID()
        ];
      }

    endwhile;
  endif;

  wp_reset_postdata();
  ?>

  <?php
  // Get 1 random UNIQUE finissant projects
  $finissants_query = new WP_Query([
    'post_type'      => 'projet-finissant',
    'posts_per_page' => 1,      // pick two
    'orderby'        => 'rand', // random order
  ]);

  $finissantItems = [];

  if ($finissants_query->have_posts()) :
    while ($finissants_query->have_posts()) : $finissants_query->the_post();

    // ACF fields
    $titre = get_field('nom_du_projet');
    $image = get_field('image'); // ACF Image field

    if ($image) {
      $finissantItems[] = [
        'title' => $titre,
        'url'   => $image['url'],
        'id'    => get_the_ID()
      ];
    }

  endwhile;
  endif;

  wp_reset_postdata();
  ?>

    <!-- Projet Finissants -->
    <div class="projet-populaire-finissant">
      <span class="titre"><?php echo $finissantItems[0]['title']; ?></span>
      <span class="bouton">
        <a href="<?php echo site_url('/index.php/projet-finissant/?projet_id=' . $finissantItems[0]['id']); ?>">>></a>
      </span>
      <span class="categorie">Catégorie</span>
      <span class="categorie-nom">FINISSANTS</span>
      <img class="image-populaire-finissants" src="<?php echo $finissantItems[0]['url']; ?>" alt="">
    </div>

    <!-- Exemple projet Arcade -->
    <div class="projet-populaire-arcade">
      <span class="titre"><?php echo $arcadeItems[0]['title']; ?></span>
      <span class="bouton">
        <a href="<?php echo site_url('/index.php/projet-arcade/?projet_id=' . $arcadeItems[0]['id']); ?>">>></a>
      </span>
      <span class="categorie">Catégorie</span>
      <span class="categorie-nom">ARCADE</span>
      <img class="image-populaire-arcade" src="<?php echo $arcadeItems[0]['url']; ?>" alt="">
    </div>

    <!-- Projet Jour de la Terre -->
    <div class="projet-populaire-jour-terre">
      <span class="titre"><?php echo $graphismeItems[0]['title']; ?></span>
      <span class="bouton">
        <a href="<?php echo site_url('/index.php/projet-graphisme/?projet_id=' . $graphismeItems[0]['id']); ?>">>></a>
      </span>
      <span class="categorie">Catégorie</span>
      <span class="categorie-nom">GRAPHISME</span>
      <img class="image-populaire-jour-terre" src="<?php echo $graphismeItems[0]['url']; ?>" alt="">
    </div>
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
            <img class="img-personne" src="<?php echo esc_url( get_theme_mod('expoTim_home_credit_img_1') ); ?>" alt="Photo de Lîna Bensenouci">
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
            <img class="img-personne" src="<?php echo esc_url( get_theme_mod('expoTim_home_credit_img_2') ); ?>" alt="Photo de Peterson Germain">
          </span>
        </div>
        <div class="carte-equipe-3">
          <span class="photo">
            <img class="img-personne" src="<?php echo esc_url( get_theme_mod('expoTim_home_credit_img_3') ); ?>" alt="Photo de Matilda Kang">
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
            <img class="img-personne" src="<?php echo esc_url( get_theme_mod('expoTim_home_credit_img_4') ); ?>" alt="Photo de Rémy Roger">
          </span>
        </div>
        <div class="carte-equipe-5">
          <span class="photo">
            <img class="img-personne" src="<?php echo esc_url( get_theme_mod('expoTim_home_credit_img_5') ); ?>" alt="Photo de Alexis David">
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
  <script>
    var themeVars = themeVars || {};
    themeVars.ajaxUrl = "<?php echo admin_url('admin-ajax.php'); ?>";
  </script>

<?php get_footer(); ?>
</body>
</html>
