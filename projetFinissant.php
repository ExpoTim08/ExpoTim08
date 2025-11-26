<?php
/*
Template Name: Projet Finissant
*/
get_header();

// Récupérer l'ID du projet depuis l'URL
$projet_id = isset($_GET['projet_id']) ? intval($_GET['projet_id']) : 0;

if (!$projet_id) {
    echo '<p>Aucun projet sélectionné.</p>';
    get_footer();
    exit;
}

// Vérifier que le projet existe
if (get_post_status($projet_id) === false) {
    echo '<p>Projet introuvable.</p>';
    get_footer();
    exit;
}

// Champs ACF
$nom         = get_field('nom_du_projet', $projet_id) ?: get_the_title($projet_id);
$description = get_field('description', $projet_id);
$video       = get_field('video_du_projet', $projet_id);
$image       = get_field('image', $projet_id);
$affiche     = get_field('affiche', $projet_id);
$etudiants   = get_field('etudiants_associes', $projet_id);

// Fallback image
if (!$image && $affiche) $image = $affiche;
if (is_array($image) && isset($image['url'])) $image = $image['url'];
?>

<main class="page-graphisme">
  <div class="border gauche"></div>
  <div class="border droite"></div>

  <!-- Présentation du projet -->
  <section class="presentation-graphisme">

    <!-- Titre du projet -->
    <h1 class="titre-graphisme" aria-label="<?php echo esc_attr($nom); ?>">
      <span class="titre-graphisme-layer titre-graphisme--base"><?php echo esc_html($nom); ?></span>
      <span class="titre-graphisme-layer titre-graphisme-layer-1"><?php echo esc_html($nom); ?></span>
      <span class="titre-graphisme-layer titre-graphisme-layer-2"><?php echo esc_html($nom); ?></span>
      <span class="titre-graphisme-layer titre-graphisme-layer-3"><?php echo esc_html($nom); ?></span>

      <!-- Bouton retour Finissants -->
      <p class="retour-finissant">
        <a href="<?php echo esc_url(get_permalink(get_page_by_path('finissants'))); ?>" class="lien-retour">
          &lt; Finissants
        </a>
      </p>

      <img class="student" src="<?php echo get_template_directory_uri(); ?>/Images/Student.svg" alt="">
    </h1>

    <!-- Description globale -->
    <div class="description-projet">

      <!-- ⚡ Média principal (LOGIQUE FINISSANTS) -->
      <?php if ($video): ?>

        <?php if (filter_var($video, FILTER_VALIDATE_URL)): ?>
          <div class="video-container">
            <iframe src="<?php echo esc_url($video); ?>" frameborder="0" allowfullscreen></iframe>
          </div>
        <?php else: ?>
          <video class="video-projet" controls>
            <source src="<?php echo esc_url($video); ?>" type="video/mp4">
          </video>
        <?php endif; ?>

      <?php elseif ($image): ?>
        <div class="image-projet">
          <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($nom); ?>" class="image-projet-graphisme">
        </div>

      <?php else: ?>
        <p class="aucun-media">Aucun média disponible pour ce projet.</p>
      <?php endif; ?>

      <!-- Équipe -->
      <?php if ($etudiants && is_array($etudiants)): ?>
        <div class="infos-etudiants">
          <strong>Équipe :</strong>
          <?php
          $list = [];
          foreach ($etudiants as $etu) {
              $id = is_object($etu) ? $etu->ID : $etu;
              $prenom = get_field('prenom', $id);
              $nomEtu = get_field('nom_etudiant', $id);
              $list[] = '<span class="nom-etudiant">' . esc_html(trim("$prenom $nomEtu")) . '</span>';
          }
          echo implode($list);
          ?>
        </div>
      <?php endif; ?>

      <!-- Description -->
      <?php if ($description): ?>
        <div class="conteneur-description">
          <p class="description-titre">Description :</p>
          <p class="description-texte"><?php echo esc_html($description); ?></p>
        </div>
      <?php endif; ?>

    </div>

  </section>
</main>

<?php get_footer(); ?>