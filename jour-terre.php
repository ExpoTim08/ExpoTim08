<?php
/*
Template Name: Jour de la Terre
*/
get_header();
?>

<main class="page-graphisme">
  <div class="border gauche"></div>
  <div class="border droite"></div>

  <!-- Présentation Graphisme -->
  <section class="presentation-graphisme">
    <h1 class="titre-graphisme" aria-label="graphisme">
      <span class="titre-graphisme-layer titre-graphisme--base">GRAPHISME</span>
      <span class="titre-graphisme-layer titre-graphisme-layer--1">GRAPHISME</span>
      <span class="titre-graphisme-layer titre-graphisme-layer--2">GRAPHISME</span>
      <span class="titre-graphisme-layer titre-graphisme-layer--3">GRAPHISME</span>
    </h1>

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

  <!-- Liste des projets -->
  <section class="liste-projet-graphisme">
    <?php
    $projets = new WP_Query([
      'post_type' => 'projet-graphisme',
      'posts_per_page' => -1,
      'orderby' => 'title',
      'order' => 'ASC'
    ]);

    if ($projets->have_posts()) :
      while ($projets->have_posts()) : $projets->the_post();

        $titre       = get_the_title();
        $image       = get_field('affiche');
        $description = get_field('description');
        $etudiants   = get_field('etudiants_associes');
        $behance     = get_field('liens_behance');
    ?>

    <!-- Carte Projet Desktop -->
    <div class="carte-projet-graphisme--desktop">
      <?php if ($image): ?>
        <img class="image-projet-graphisme" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($titre); ?>">
      <?php endif; ?>

      <div class="conteneur-carte-bas">
        <h2 class="titre-projet-graphisme"><?php echo esc_html($titre); ?></h2>

        <?php if ($description): ?>
          <p class="carte-graphisme-titre-description">Description</p>
          <p class="description-projet"><?php echo esc_html($description); ?></p>
        <?php endif; ?>

        <?php if ($etudiants): ?>
          <p class="etudiants-projet">
            Étudiants :
            <?php
            $liste = [];
            foreach ($etudiants as $etudiant) {
              $liste[] = get_the_title($etudiant->ID);
            }
            echo esc_html(implode(', ', $liste));
            ?>
          </p>
        <?php endif; ?>

        <?php if ($behance): ?>
          <p class="behance-projet"><a href="<?php echo esc_url($behance); ?>" target="_blank">Voir sur Behance</a></p>
        <?php endif; ?>
      </div>
    </div>

    <!-- Carte Projet Mobile -->
    <div class="carte-projet-graphisme carte-projet-graphisme--mobile">
      <?php if ($image): ?>
        <img class="image-projet-graphisme" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($titre); ?>">
      <?php endif; ?>

      <!-- Si tu veux, tu peux afficher juste le titre ici, mais petit -->
      <!-- <h3 class="titre-projet-mobile"><?php echo esc_html($titre); ?></h3> -->
    </div>

    <?php
      endwhile;
      wp_reset_postdata();
    else:
      echo '<p>Aucun projet trouvé pour le moment.</p>';
    endif;
    ?>
  </section>
</main>

<?php get_footer(); ?>
