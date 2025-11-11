<?php
/*
Template Name: Projet Arcade
*/
get_header();
?>

<?php
// Récupérer l'ID du projet depuis l'URL
$projet_id = isset($_GET['projet_id']) ? intval($_GET['projet_id']) : 0;

if (!$projet_id) {
    echo '<p>Aucun projet sélectionné.</p>';
    get_footer();
    exit;
}

// Champs ACF
$nom         = get_field('nom_du_projet', $projet_id);
$description = get_field('description', $projet_id);
$image       = get_field('image_du_projet', $projet_id);
$video       = get_field('lien_de_la_video', $projet_id);
$annee       = get_field('annee', $projet_id);
$numeroCours = get_field('numero_du_cours', $projet_id);
$etudiants   = get_field('etudiants_associes', $projet_id);
?>

<main class="page-arcade">
  <div class="border gauche"></div>
  <div class="border droite"></div>

  <!-- Présentation du projet -->
  <section class="presentation-arcade">

    <h1 class="titre-arcade" aria-label="<?php echo esc_attr($nom); ?>">
      <span class="titre-arcade-layer titre-arcade--base"><?php echo esc_html($nom); ?></span>
      <span class="titre-arcade-layer titre-arcade-layer--1"><?php echo esc_html($nom); ?></span>
      <span class="titre-arcade-layer titre-arcade-layer--2"><?php echo esc_html($nom); ?></span>
      <span class="titre-arcade-layer titre-arcade-layer--3"><?php echo esc_html($nom); ?></span>
    </h1>

    <!-- Bouton retour vers Arcade -->
    <p class="retour-arcade">
      <a href="http://localhost/ExpoTim/index.php/arcade/" class="lien-retour">
        &lt; Arcade
      </a>
    </p>



    <!-- Vidéo YouTube -->
    <?php if ($video): ?>
      <div class="video-projet">
        <iframe width="100%" height="500" src="<?php echo esc_url($video); ?>" frameborder="0" allowfullscreen></iframe>
      </div>
    <?php endif; ?>

    <!-- Cours et année -->
    <div class="infos-cours-annee">
      <?php if ($numeroCours): ?>
        <span class="numero-cours">Cours : <?php echo esc_html($numeroCours); ?></span>
      <?php endif; ?>
      <?php if ($annee): ?>
        <span class="annee-projet">Année : <?php echo esc_html($annee); ?></span>
      <?php endif; ?>
    </div>

    <!-- Étudiants -->
    <?php if ($etudiants): ?>
      <div class="infos-etudiants">
        <strong>Équipe :</strong>
        <?php
        $liste = [];
        foreach ($etudiants as $etudiant) {
            $prenom = get_field('prenom', $etudiant->ID);
            $nomEtu = get_field('nom_etudiant', $etudiant->ID);
            $liste[] = trim("$prenom $nomEtu");
        }
        echo esc_html(implode(', ', $liste));
        ?>
      </div>
    <?php endif; ?>

    <!-- Image du projet -->
    <?php if ($image): ?>
      <div class="image-projet">
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($nom); ?>" class="image-projet-arcade">
      </div>
    <?php endif; ?>

    <!-- Description -->
    <?php if ($description): ?>
      <div class="description-projet">
        <p><?php echo esc_html($description); ?></p>
      </div>
    <?php endif; ?>

  </section>
</main>

<?php get_footer(); ?>
