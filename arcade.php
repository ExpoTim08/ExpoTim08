<?php
/*
Template Name: Arcade
*/
get_header();
?>

<main class="page-arcade">
  <div class="border gauche"></div>
  <div class="border droite"></div>

  <!-- Présentation Arcade -->
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
        L’Arcade de l’expoTIM présente les prototypes de jeux vidéo créés par les étudiants de deuxième année en Technique d’intégration multimédia. 
        Réalisés dans le cadre du cours Création de jeu en équipe, ces projets sont le fruit d’un processus complet : de la conception à la programmation, jusqu’au produit fini.
      </p>
    </div>
  </section>

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
    ?>

    <!-- Carte Projet Desktop -->
    <div class="carte-projet-arcade--desktop">
      <?php if ($image): ?>
        <img class="image-projet-arcade" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($nom); ?>">
      <?php endif; ?>

      <div class="conteneur-carte-bas">
        <h2 class="titre-projet-arcade"><?php echo esc_html($nom); ?></h2>
        <p class="carte-arcade-titre-description">Description</p>
        <p class="description-projet"><?php echo esc_html($description); ?></p>

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
      <?php endif; ?>
    </div>

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
