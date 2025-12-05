<?php
/*
Template Name: Arcade
*/
require("global.php");
?>

<?php get_header(); ?>
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

    <div class="conteneur-description-arcade">
      <p class="description-titre">Description</p>
      <p class="description-texte">
        Les projets Arcade présentent les créations interactives des étudiants. Chaque projet illustre
        un savoir-faire en programmation, game design et créativité numérique.
      </p>
    </div>
  </section>

  <!-- ===================== Barre de tri ===================== -->
  <div class="tri-bar">
    <select id="tri-select" name="tri-select" aria-label="Filtrer projets par type">
      <option value="random">Trier (Tous)</option>
      <option value="asc">A à Z</option>
      <option value="desc">Z à A</option>
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

        <!-- ===== Carte Desktop ===== -->
        <article class="carte-projet-arcade carte-projet-arcade--desktop">
          <?php if ($image): ?>
            <img class="image-projet-arcade" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($nom); ?>">
          <?php endif; ?>
          <div class="conteneur-carte-bas">
            <h2 class="titre-projet-arcade"><?php echo esc_html($nom); ?></h2>
            <p class="carte-arcade-titre-description">Description</p>
            <p class="description-projet"><?php echo esc_html($short_desc); ?></p>
            <button class="button-projet-arcade"
              onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projet-arcade')))); ?>'">
              >>
            </button>
          </div>
        </article>

        <!-- ===== Carte Mobile ===== -->
        <article class="carte-projet-arcade carte-projet-arcade--mobile">
          <div class="conteneur-carte-haut">
            <h2 class="titre-projet-arcade"><?php echo esc_html($nom); ?></h2>
            <button class="button-projet-arcade"
              onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projet-arcade')))); ?>'">
              >>
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
