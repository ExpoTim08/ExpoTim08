<?php
/*
Template Name: Arcade
*/
require("global.php");
get_header();
?>

<body>
<div class="pattern-background">

<main class="page-arcade">
  <div class="border gauche"></div>
  <div class="border droite"></div>

  <!-- ===================== Présentation Arcade ===================== -->
  <section class="presentation-arcade">
    <h1 class="titre-arcade" aria-label="arcade">
      <span class="titre-arcade-layer titre-arcade--base">ARCADE</span>
      <span class="titre-arcade-layer titre-arcade-layer--1">ARCADE</span>
      <span class="titre-arcade-layer titre-arcade-layer--2">ARCADE</span>
      <span class="titre-arcade-layer titre-arcade-layer--3">ARCADE</span>
    </h1>
  
    <svg class="logo-arcade" width="159" height="138" viewBox="0 0 159 138" fill="none" xmlns="http://www.w3.org/2000/svg">
      <mask id="path-1-inside-1_1496_1350" fill="white">
        <path d="M58.4129 103.447C45.675 143.803 30.8098 134.856 29.7167 134.225C22.1961 129.886 17.4493 95.335 16.7167 75.3665L58.4129 103.447ZM136.488 43.2436C145.838 60.9034 159.002 93.1989 154.659 100.717C154.027 101.811 145.626 116.989 114.418 88.4098L136.488 43.2436ZM84.5877 13.2784C88.1538 11.2183 96.0964 8.92353 100.099 9.12208C102.335 9.23311 103.062 11.5614 103.839 12.7382C111.751 13.5429 128.223 18.95 130.816 34.1406L106.538 83.1317L62.5979 94.9357L17.077 64.6483C11.727 50.1965 23.2888 37.2779 29.7387 32.6247C29.8236 31.2169 29.2894 28.837 31.1696 27.623C34.5367 25.4497 42.5627 23.4657 46.681 23.4667C49.138 23.4674 49.5279 25.4749 50.4202 27.0831L83.1577 18.2798C83.1263 16.441 82.4603 14.5074 84.5877 13.2784ZM89.7301 56.2636C85.4472 57.4113 82.9051 61.8136 84.0523 66.0965C85.2 70.3797 89.6029 72.9217 93.8861 71.7741C98.1692 70.6263 100.71 66.2237 99.5628 61.9405C98.4148 57.6578 94.013 55.1162 89.7301 56.2636ZM61.2914 63.8818L62.6772 69.0538L57.5061 70.4394L58.8915 75.6095L64.0626 74.224L65.4477 79.3932L70.6178 78.0078L69.2327 72.8386L74.4019 71.4535L73.0166 66.2834L67.8474 67.6685L66.4615 62.4964L61.2914 63.8818ZM42.8235 46.6658C38.5408 47.8137 35.9996 52.2165 37.1469 56.4994C38.2945 60.7824 42.6967 63.3245 46.9798 62.1772C51.263 61.0295 53.805 56.6266 52.6573 52.3434C51.5094 48.0605 47.1065 45.5182 42.8235 46.6658ZM91.9423 33.5044L93.3277 38.6746L88.1585 40.0597L89.5438 45.2298L94.713 43.8448L96.0983 49.0149L101.268 47.6296L99.8832 42.4594L105.054 41.0738L103.669 35.9037L98.4978 37.2893L97.1125 32.1191L91.9423 33.5044Z"/>
      </mask>

      <path d="M58.4129 103.447C45.675 143.803 30.8098 134.856 29.7167 134.225C22.1961 129.886 17.4493 95.335 16.7167 75.3665L58.4129 103.447ZM136.488 43.2436C145.838 60.9034 159.002 93.1989 154.659 100.717C154.027 101.811 145.626 116.989 114.418 88.4098L136.488 43.2436ZM84.5877 13.2784C88.1538 11.2183 96.0964 8.92353 100.099 9.12208C102.335 9.23311 103.062 11.5614 103.839 12.7382C111.751 13.5429 128.223 18.95 130.816 34.1406L106.538 83.1317L62.5979 94.9357L17.077 64.6483C11.727 50.1965 23.2888 37.2779 29.7387 32.6247C29.8236 31.2169 29.2894 28.837 31.1696 27.623C34.5367 25.4497 42.5627 23.4657 46.681 23.4667C49.138 23.4674 49.5279 25.4749 50.4202 27.0831L83.1577 18.2798C83.1263 16.441 82.4603 14.5074 84.5877 13.2784ZM89.7301 56.2636C85.4472 57.4113 82.9051 61.8136 84.0523 66.0965C85.2 70.3797 89.6029 72.9217 93.8861 71.7741C98.1692 70.6263 100.71 66.2237 99.5628 61.9405C98.4148 57.6578 94.013 55.1162 89.7301 56.2636ZM61.2914 63.8818L62.6772 69.0538L57.5061 70.4394L58.8915 75.6095L64.0626 74.224L65.4477 79.3932L70.6178 78.0078L69.2327 72.8386L74.4019 71.4535L73.0166 66.2834L67.8474 67.6685L66.4615 62.4964L61.2914 63.8818ZM42.8235 46.6658C38.5408 47.8137 35.9996 52.2165 37.1469 56.4994C38.2945 60.7824 42.6967 63.3245 46.9798 62.1772C51.263 61.0295 53.805 56.6266 52.6573 52.3434C51.5094 48.0605 47.1065 45.5182 42.8235 46.6658ZM91.9423 33.5044L93.3277 38.6746L88.1585 40.0597L89.5438 45.2298L94.713 43.8448L96.0983 49.0149L101.268 47.6296L99.8832 42.4594L105.054 41.0738L103.669 35.9037L98.4978 37.2893L97.1125 32.1191L91.9423 33.5044Z" 
            fill="#3F32FF" stroke="#FFFFFF" stroke-width="1"/>
    </svg>



    <div class="conteneur-description-arcade">
      <p class="description-titre">Description</p>
      <p class="description-texte">
        L’Arcade de l’expoTIM présente les prototypes de jeux vidéo créés par les étudiants de deuxième année en Technique d’intégration multimédia. Réalisés dans le cadre du cours <strong>Création de jeu en équipe</strong>, ces projets sont le fruit d’un processus de production complet : de la conception et la planification à la création des médias, de la programmation aux tests de qualité jusqu’au produit fini. 
      </p>
    </div>
  </section>

  <!-- ===================== Barre de tri ===================== -->
  <div class="tri-bar">
    <select id="tri-select" name="tri-select" aria-label="Trier projets">
      <option value="random" <?php selected(isset($_GET['tri']) ? sanitize_text_field($_GET['tri']) : 'random', 'random'); ?>>Tri (Aléatoire)</option>
      <option value="asc" <?php selected(isset($_GET['tri']) ? sanitize_text_field($_GET['tri']) : '', 'asc'); ?>>A à Z</option>
      <option value="desc" <?php selected(isset($_GET['tri']) ? sanitize_text_field($_GET['tri']) : '', 'desc'); ?>>Z à A</option>
    </select>
  </div>

  <!-- ===================== Liste des projets ===================== -->
  <section class="liste-projet-arcade" id="liste-projet-arcade">
    <?php
    $tri = isset($_GET['tri']) ? sanitize_text_field($_GET['tri']) : 'random';
    $orderby = 'rand';
    $order   = 'ASC';

    switch ($tri) {
        case 'asc':
            $orderby = 'title';
            $order   = 'ASC';
            break;
        case 'desc':
            $orderby = 'title';
            $order   = 'DESC';
            break;
    }

    $projets = new WP_Query([
        'post_type'      => 'projet-arcade',
        'posts_per_page' => -1,
        'orderby'        => $orderby,
        'order'          => $order
    ]);

    // Shuffle si random
    if ($tri === 'random') {
        $posts = $projets->posts;
        shuffle($posts);
        $projets->posts = $posts;
    }

    if ($projets->have_posts()) :
        while ($projets->have_posts()) : $projets->the_post();
            $nom         = get_field('nom_du_projet');
            $description = get_field('description');
            $short_desc  = wp_trim_words(wp_strip_all_tags($description), 40, '...');
            $image       = get_field('image_du_projet');
        ?>

        <!-- ===== Carte Projet Desktop ===== -->
        <article class="carte-projet-arcade carte-projet-arcade--desktop"
        onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projet-arcade')))); ?>'">
          <?php if ($image): ?>
            <img class="image-projet-arcade" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($nom); ?>">
          <?php endif; ?>
          <div class="conteneur-carte-bas">
            <h2 class="titre-projet-arcade"><?php echo esc_html($nom); ?></h2>
            <p class="carte-arcade-titre-description">Description</p>
            <p class="description-projet"><?php echo esc_html($short_desc); ?></p>
            <button class="button-projet-arcade"
              onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projet-arcade')))); ?>'">
              ➜
            </button>
          </div>
        </article>

        <!-- ===== Carte Projet Mobile ===== -->
        <article class="carte-projet-arcade carte-projet-arcade--mobile">
          <div class="bloc-titre">
            <h2 class="titre-projet-arcade"><?php echo esc_html($nom); ?></h2>
            <button class="button-projet-arcade"
              onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projet-arcade')))); ?>'">
              ➜
            </button>
          </div>
          <?php if ($image): ?>
            <img class="image-projet-arcade" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($nom); ?>">

            <span class="conteneur-button-dropdown-arcade">
              <p class="carte-arcade-titre-description">Description</p>
              <button class="button-dropdown-arcade" aria-expanded="false" aria-controls="<?php echo 'dropdown-'.get_the_ID(); ?>">+</button>
            </span>

            <div id="<?php echo 'dropdown-'.get_the_ID(); ?>" class="dropdown-carte-arcade" aria-hidden="true">
              <p class="description-projet"><?php echo esc_html($short_desc); ?></p>
            </div>
          <?php endif; ?>
        </article>

    <?php endwhile; wp_reset_postdata(); else: ?>
        <p>Aucun projet Arcade pour le moment.</p>
    <?php endif; ?>
  </section>
</main>

</div>
</body>
<?php get_footer(); ?>
