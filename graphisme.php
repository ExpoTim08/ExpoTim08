<?php
/*
Template Name: Graphisme
*/
require("global.php");
?>

<?php 
get_header(); 
?>
<body> 
<div class="pattern-background">



<main class="page-graphisme">
  <div class="border gauche"></div>
  <div class="border droite"></div>

  <!-- ===================== Présentation Graphisme ===================== -->
  <section class="presentation-graphisme">
    <h1 class="titre-graphisme" aria-label="graphisme">
      <span class="titre-graphisme-layer titre-graphisme--base">GRAPHISME</span>
      <span class="titre-graphisme-layer titre-graphisme-layer--1">GRAPHISME</span>
      <span class="titre-graphisme-layer titre-graphisme-layer--2">GRAPHISME</span>
      <span class="titre-graphisme-layer titre-graphisme-layer--3">GRAPHISME</span>
    </h1>

    <svg class="logo-graphisme" width="100" height="122" viewBox="0 0 100 122" xmlns="http://www.w3.org/2000/svg">

    <!-- Outline blanc un peu épaissi pour combler les micro-coupes -->
    <path
        d="M97.0801 0.508789C102.803 39.1876 98.5018 112.756 35.5107 97.6006C41.8261 81.6158 63.3355 46.6873 77.5439 37.2148C82.2801 34.0574 72.8083 25.9666 68.6641 30.1104C55.8366 39.9774 25.6828 73.3285 12.4219 118.322C10.8512 123.65 -1.19508 119.506 1.17285 114.178L13.6055 85.1689C-6.72066 57.9359 -18.4827 2.87695 97.0801 0.508789Z"
        fill="white"
        stroke="white"
        stroke-width="2.6"
        stroke-linejoin="round"
        stroke-linecap="round"
    />

    <!-- Feuille verte (même forme exacte), bouche la pointe pour éviter l’effet coupé -->
    <path
        d="M97.0801 0.508789C102.803 39.1876 98.5018 112.756 35.5107 97.6006C41.8261 81.6158 63.3355 46.6873 77.5439 37.2148C82.2801 34.0574 72.8083 25.9666 68.6641 30.1104C55.8366 39.9774 25.6828 73.3285 12.4219 118.322C10.8512 123.65 -1.19508 119.506 1.17285 114.178L13.6055 85.1689C-6.72066 57.9359 -18.4827 2.87695 97.0801 0.508789Z"
        fill="#00978F"
    />

</svg>



    <div class="conteneur-description-graphisme">
      <p class="description-titre">Description</p>
      <p class="description-texte">
        Dans le cours <strong><em>Conception graphique et imagerie vectorielle</em></strong>,
        les étudiants de première année ont réalisé une recherche sur un enjeu environnemental.
        À partir de cette recherche, ils ont imaginé un jeu vidéo ou une application permettant
        de sensibiliser la population à cet enjeu. Ils en ont conçu l’identité visuelle et l’ont
        présentée sous forme d’affiche. Le code QR présent sur chaque affiche donne accès à une
        présentation détaillant le projet proposé.
      </p>
    </div>
  </section>

  <!-- ===================== Barre de filtre ===================== -->
  <div class="filter-bar">
    <select id="filter-select" name="filter-select" aria-label="Filtrer projets types d'option">
      <option value="all">Tous</option>
      <option value="A">Option 1</option>
      <option value="B">Option 2</option>
      <option value="C">Option 3</option>
      <option value="D">Option 4</option>
    </select>
  </div>

  <!-- ===================== Liste des projets ===================== -->
  <section class="liste-projet-graphisme">
    <?php
    $projets = new WP_Query([
      'post_type'      => 'projet-graphisme',
      'posts_per_page' => -1,
      'orderby'        => 'title',
      'order'          => 'ASC'
    ]);

    if ($projets->have_posts()) :
      while ($projets->have_posts()) :
        $projets->the_post();

        $titre       = get_the_title();
        $image       = get_field('affiche');
        $description = get_field('description');
        $etudiants   = get_field('etudiants_associes');
        $behance     = get_field('liens_behance');
      $short_desc = wp_trim_words( wp_strip_all_tags( $description ), 40, '...' );
    ?>

    <!-- ===== Carte Projet Desktop ===== -->
    <article class="carte-projet-graphisme carte-projet-graphisme--desktop">
      <?php if (!empty($image) && !empty($image['url'])) : ?>
          <img class="image-projet-graphisme"
               src="<?php echo esc_url($image['url']); ?>"
               alt="<?php echo esc_attr($image['alt'] ?: $titre); ?>">
      <?php endif; ?>

      <div class="conteneur-carte-bas">
        <h2 class="titre-projet-graphisme"><?php echo esc_html($titre); ?></h2>
        <p class="carte-graphisme-titre-description">Description</p>
        <p class="description-projet"><?php echo esc_html($short_desc); ?></p>

        <?php /*
          <?php if (!empty($etudiants)) : ?>
            <p class="etudiants-projet">
              <strong>Étudiants :</strong>
              <?php
              $liste = array_map(function ($etudiant) {
                return get_the_title($etudiant->ID);
              }, $etudiants);
              echo esc_html(implode(', ', $liste));
              ?>
            </p>
          <?php endif; ?>

          <?php if ($behance) : ?>
            <p class="behance-projet">
              <a href="<?php echo esc_url($behance); ?>" target="_blank" rel="noopener noreferrer">
                Voir sur Behance
              </a>
            </p>
          <?php endif; ?>
        */ ?>

        <button class="button-projet-graphisme"
          onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projet-graphisme')))); ?>'">
          >>
        </button>
      </div>
    </article>


    
    <!-- ===== Carte Projet Mobile ===== -->
   <article class="carte-projet-graphisme carte-projet-graphisme--mobile">
      <div class="bloc-titre">
        <h2 class="titre-projet-graphisme"><?php echo esc_html($titre); ?></h2>
        <button class="button-projet-graphisme"
            onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projet-graphisme')))); ?>'">
            &gt;&gt;
          </button>
      </div>

      <?php if ($image): ?>
        <img class="image-projet-graphisme" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($titre); ?>">
        
        <span class="conteneur-button-dropdown-graphisme">
          <p class="carte-graphisme-titre-description">Description</p>
          <button
            class="button-dropdown-graphisme"
            aria-expanded="false"
            aria-controls="<?php echo 'dropdown-'.get_the_ID(); ?>">
            +
          </button>
        </span>

        <div id="<?php echo 'dropdown-'.get_the_ID(); ?>" class="dropdown-carte-graphisme" aria-hidden="true">
          <p class="description-projet"><?php echo esc_html($short_desc); ?></p>
        </div>
        
      <?php /* ?>
        <?php if (!empty($image) && !empty($image['url'])) : ?>
            <img class="image-projet-graphisme"
                src="<?php echo esc_url($image['url']); ?>"
                alt="<?php echo esc_attr($image['alt'] ?: $titre); ?>">
        <?php endif; ?>

        <div class="conteneur-carte-bas">
          <h2 class="titre-projet-graphisme"><?php echo esc_html($titre); ?></h2>

          <?php if ($description) : ?>
          <p class="carte-graphisme-titre-description">Description</p>
          <p class="description-projet"><?php echo esc_html($description); ?></p>
          <?php endif; ?>

          <?php if (!empty($etudiants)) : ?>
            <p class="etudiants-projet">
          <strong>Étudiants :</strong>
          <?php
          $liste = array_map(function ($etudiant) {
            return get_the_title($etudiant->ID);
          }, $etudiants);
          echo esc_html(implode(', ', $liste));
          ?>
            </p>
          <?php endif; ?>

          <?php if ($behance) : ?>
            <p class="behance-projet">
          <a href="<?php echo esc_url($behance); ?>" target="_blank" rel="noopener noreferrer">
            Voir sur Behance
          </a>
            </p>
          <?php endif; ?>
        </div>
      <?php */ ?>

    </article>
    <?php endif; ?>

    <?php
      endwhile;
      wp_reset_postdata();
    else :
      echo '<p class="message-aucun-projet">Aucun projet trouvé pour le moment.</p>';
    endif;
    ?>
  </section>
</main>

  
</div>
</body>
<?php get_footer(); ?>
