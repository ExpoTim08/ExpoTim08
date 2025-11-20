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

// Conversion automatique du lien YouTube en embed
$embed_url = '';
if ($video) {
    if (strpos($video, 'youtube.com/watch?v=') !== false) {
        $video_id = explode('v=', $video)[1];
        $ampersand_position = strpos($video_id, '&');
        if ($ampersand_position !== false) {
            $video_id = substr($video_id, 0, $ampersand_position);
        }
        $embed_url = "https://www.youtube.com/embed/" . $video_id;
    } else {
        $embed_url = $video; // si déjà un lien embed
    }
}
?>
  <div class="border gauche"></div>
  <div class="border droite"></div>

<main class="page-arcade">
  <div class="border gauche"></div>
  <div class="border droite"></div>

  <!-- Présentation du projet -->
  <section class="presentation-arcade">

    <!-- Titre du projet -->
    <h1 class="titre-arcade" aria-label="<?php echo esc_attr($nom); ?>">
      <span class="titre-arcade-layer titre-arcade-base"><?php echo esc_html($nom); ?></span>
      <span class="titre-arcade-layer titre-arcade-layer1"><?php echo esc_html($nom); ?></span>
      <span class="titre-arcade-layer titre-arcade-layer2"><?php echo esc_html($nom); ?></span>
      <span class="titre-arcade-layer titre-arcade-layer3"><?php echo esc_html($nom); ?></span>
      <!-- Bouton retour vers Arcade -->
      <p class="retour-arcade">
      <a href="<?php echo esc_url(get_permalink(get_page_by_path('arcade'))); ?>" class="lien-retour">
        &lt; Arcade
      </a>
      </p>
      <img class="manette" src="<?php echo get_template_directory_uri(); ?>/Images/Manette.svg" alt="">
    </h1>

    <!-- Vidéo YouTube -->
    <?php if ($embed_url): ?>
      <div class="video-projet">
        <iframe width="100%" height="500" src="<?php echo esc_url($embed_url); ?>" frameborder="0" allowfullscreen></iframe>
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

    <!-- Image du projet -->
    <div class="description-image">
      <?php if ($image): ?>
        <div class="image-projet">
          <span>Affiche</span>
          <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($nom); ?>" class="image-projet-arcade">
        </div>
      <?php endif; ?>

      <!-- Étudiants -->
      <?php if ($etudiants): ?>
      <div class="infos-etudiants">
        <strong class="titre-equipe">Équipe :</strong>
        <?php
        $liste = [];
        foreach ($etudiants as $etudiant) {
          $prenom = get_field('prenom', $etudiant->ID);
          $nomEtu = get_field('nom_etudiant', $etudiant->ID);
          $fullName = trim("$prenom $nomEtu");

          $liste[] = '<span class="nom-etudiant">' . esc_html($fullName) . '</span>';
        }
        echo implode(' ', $liste);
        ?>
      </div>
      <?php endif; ?>

      <!-- Description -->
      <?php if ($description): ?>
        <div class="description-projet">
          <span class="description-titre">Description</span>
          <span class="description"><?php echo esc_html($description); ?></span>
        </div>
      <?php endif; ?>
    </div>

  </section>
</main>

<?php get_footer(); ?>
