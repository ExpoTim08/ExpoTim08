<?php
/*
Template Name: Arcade
*/
?>

<body>
<div class="pattern-background">
<?php
get_header();
?>

<main class="page-arcade">
  <div class="border gauche"></div>
  <div class="border droite"></div>

  <!-- Présentation Arcade -->
  <section class="presentation-arcade">
    <!--<p>< Arcade</p>-->
    <h1 class="titre-arcade" aria-label="arcade">
      <span class="titre-arcade-layer titre-arcade--base">ARCADE</span>
      <span class="titre-arcade-layer titre-arcade-layer--1">ARCADE</span>
      <span class="titre-arcade-layer titre-arcade-layer--2">ARCADE</span>
      <span class="titre-arcade-layer titre-arcade-layer--3">ARCADE</span>
    </h1>

    <div class="conteneur-description-arcade">
      <p class="description-titre">Description</p>
      <p class="description-texte">
        L’Arcade de l’expoTIM présente les prototypes de jeux vidéo créés par les étudiants de deuxième année en Technique d’intégration multimédia. 
        Réalisés dans le cadre du cours Création de jeu en équipe, ces projets sont le fruit d’un processus complet : de la conception à la programmation, jusqu’au produit fini.
      </p>
    </div>
  </section>

      <div class="conteneur-arcade-filtre">
          <svg fill="#f1e2cc" height="20px" width="20px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="-179.59 -179.59 831.80 831.80" xml:space="preserve" stroke="#f1e2cc" stroke-width="0.00472615" transform="matrix(1, 0, 0, 1, 0, 0)rotate(0)"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round" stroke="#CCCCCC" stroke-width="1.8904600000000003"></g><g id="SVGRepo_iconCarrier"> <g> <g> <polygon points="472.615,12.908 0,12.908 180.081,202.629 180.066,459.708 292.55,401.525 292.534,202.629 "></polygon> </g> </g> </g></svg>
          <p class="filtre">Filtrer</p>
          <!--<span> ></span>-->
      </div>

  <!-- Liste des projets -->
  <section class="liste-projet-arcade">

    <?php
    $projets = new WP_Query([
      'post_type' => 'projet-arcade',
      'posts_per_page' => -1,
      'orderby' => 'title',
      'order' => 'ASC'
    ]);

    if ($projets->have_posts()) :
      while ($projets->have_posts()) : $projets->the_post();
        $nom         = get_field('nom_du_projet');
        $description = get_field('description');
        $image       = get_field('image_du_projet');
        $annee       = get_field('annee');
        $etudiants   = get_field('etudiants_associes');
        $video       = get_field('lien_de_la_video');
        $short_desc = wp_trim_words( wp_strip_all_tags( $description ), 40, '...' );
    ?>

    <!-- Carte Projet Desktop -->
    <div class="carte-projet-arcade--desktop">
      <?php if ($image): ?>
        <img class="image-projet-arcade" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($nom); ?>">
      <?php endif; ?>

      <div class="conteneur-carte-bas">
        <h2 class="titre-projet-arcade"><?php echo esc_html($nom); ?></h2>
        <p class="carte-arcade-titre-description">Description</p>
        <p class="description-projet"><?php echo esc_html($short_desc); ?></p>

<?php
/*
        <?php if ($annee): ?>
          <p class="annee-projet">Année : <?php echo esc_html($annee); ?></p>
        <?php endif; ?>

        <?php if ($etudiants): ?>
          <p class="etudiants-projet">
            Étudiants : 
            <?php
            $liste = [];
            foreach ($etudiants as $etudiant) {
              $prenom = get_field('prenom', $etudiant->ID);
              $nomEtu = get_field('nom_etudiant', $etudiant->ID);
              $liste[] = trim("$prenom $nomEtu");
            }
            echo esc_html(implode(', ', $liste));
            ?>
          </p>
        <?php endif; ?>

        <?php if ($video): ?>
          <p class="video-projet"><a href="<?php echo esc_url($video); ?>" target="_blank">Voir la vidéo</a></p>
        <?php endif; ?>
*/
?>


        <button class="button-projet-arcade"
          onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projet-arcade')))); ?>'">
          >>
        </button>
      </div>
    </div>

    <!-- Carte Projet Mobile -->
    <div class="carte-projet-arcade">
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
        <button
          class="button-dropdown-arcade"
          aria-expanded="false"
          aria-controls="<?php echo 'dropdown-'.get_the_ID(); ?>">
          +
        </button>
      </span>

      <div id="<?php echo 'dropdown-'.get_the_ID(); ?>" class="dropdown-carte-arcade" aria-hidden="true">
        <p class="description-projet"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $description ), 40, '...' ) ); ?></p>
      </div>
    </div>
    <?php endif; ?>

    <?php
      endwhile;
      wp_reset_postdata();
    else:
      echo '<p>Aucun projet d’arcade pour le moment.</p>';
    endif;
    ?>
  </section>
</main>

<?php get_footer(); ?>
</div>
</body>