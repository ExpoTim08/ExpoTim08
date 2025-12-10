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
      <div class="manette-wrapper">
      <svg class="manette" width="159" height="138" viewBox="0 0 159 138" fill="none" xmlns="http://www.w3.org/2000/svg">
        <mask id="path-1-inside-1_1496_1350" fill="white">
          <path d="M58.4129 103.447C45.675 143.803 30.8098 134.856 29.7167 134.225C22.1961 129.886 17.4493 95.335 16.7167 75.3665L58.4129 103.447ZM136.488 43.2436C145.838 60.9034 159.002 93.1989 154.659 100.717C154.027 101.811 145.626 116.989 114.418 88.4098L136.488 43.2436ZM84.5877 13.2784C88.1538 11.2183 96.0964 8.92353 100.099 9.12208C102.335 9.23311 103.062 11.5614 103.839 12.7382C111.751 13.5429 128.223 18.95 130.816 34.1406L106.538 83.1317L62.5979 94.9357L17.077 64.6483C11.727 50.1965 23.2888 37.2779 29.7387 32.6247C29.8236 31.2169 29.2894 28.837 31.1696 27.623C34.5367 25.4497 42.5627 23.4657 46.681 23.4667C49.138 23.4674 49.5279 25.4749 50.4202 27.0831L83.1577 18.2798C83.1263 16.441 82.4603 14.5074 84.5877 13.2784ZM89.7301 56.2636C85.4472 57.4113 82.9051 61.8136 84.0523 66.0965C85.2 70.3797 89.6029 72.9217 93.8861 71.7741C98.1692 70.6263 100.71 66.2237 99.5628 61.9405C98.4148 57.6578 94.013 55.1162 89.7301 56.2636ZM61.2914 63.8818L62.6772 69.0538L57.5061 70.4394L58.8915 75.6095L64.0626 74.224L65.4477 79.3932L70.6178 78.0078L69.2327 72.8386L74.4019 71.4535L73.0166 66.2834L67.8474 67.6685L66.4615 62.4964L61.2914 63.8818ZM42.8235 46.6658C38.5408 47.8137 35.9996 52.2165 37.1469 56.4994C38.2945 60.7824 42.6967 63.3245 46.9798 62.1772C51.263 61.0295 53.805 56.6266 52.6573 52.3434C51.5094 48.0605 47.1065 45.5182 42.8235 46.6658ZM91.9423 33.5044L93.3277 38.6746L88.1585 40.0597L89.5438 45.2298L94.713 43.8448L96.0983 49.0149L101.268 47.6296L99.8832 42.4594L105.054 41.0738L103.669 35.9037L98.4978 37.2893L97.1125 32.1191L91.9423 33.5044Z"/>
        </mask>

        <path d="M58.4129 103.447C45.675 143.803 30.8098 134.856 29.7167 134.225C22.1961 129.886 17.4493 95.335 16.7167 75.3665L58.4129 103.447ZM136.488 43.2436C145.838 60.9034 159.002 93.1989 154.659 100.717C154.027 101.811 145.626 116.989 114.418 88.4098L136.488 43.2436ZM84.5877 13.2784C88.1538 11.2183 96.0964 8.92353 100.099 9.12208C102.335 9.23311 103.062 11.5614 103.839 12.7382C111.751 13.5429 128.223 18.95 130.816 34.1406L106.538 83.1317L62.5979 94.9357L17.077 64.6483C11.727 50.1965 23.2888 37.2779 29.7387 32.6247C29.8236 31.2169 29.2894 28.837 31.1696 27.623C34.5367 25.4497 42.5627 23.4657 46.681 23.4667C49.138 23.4674 49.5279 25.4749 50.4202 27.0831L83.1577 18.2798C83.1263 16.441 82.4603 14.5074 84.5877 13.2784ZM89.7301 56.2636C85.4472 57.4113 82.9051 61.8136 84.0523 66.0965C85.2 70.3797 89.6029 72.9217 93.8861 71.7741C98.1692 70.6263 100.71 66.2237 99.5628 61.9405C98.4148 57.6578 94.013 55.1162 89.7301 56.2636ZM61.2914 63.8818L62.6772 69.0538L57.5061 70.4394L58.8915 75.6095L64.0626 74.224L65.4477 79.3932L70.6178 78.0078L69.2327 72.8386L74.4019 71.4535L73.0166 66.2834L67.8474 67.6685L66.4615 62.4964L61.2914 63.8818ZM42.8235 46.6658C38.5408 47.8137 35.9996 52.2165 37.1469 56.4994C38.2945 60.7824 42.6967 63.3245 46.9798 62.1772C51.263 61.0295 53.805 56.6266 52.6573 52.3434C51.5094 48.0605 47.1065 45.5182 42.8235 46.6658ZM91.9423 33.5044L93.3277 38.6746L88.1585 40.0597L89.5438 45.2298L94.713 43.8448L96.0983 49.0149L101.268 47.6296L99.8832 42.4594L105.054 41.0738L103.669 35.9037L98.4978 37.2893L97.1125 32.1191L91.9423 33.5044Z" 
              fill="#FFFFFF" stroke-width="1"/>
      </svg>
    </div>
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
          <span class="description-titre">Description :</span>
          <span class="description"><?php echo esc_html($description); ?></span>
        </div>
      <?php endif; ?>
    </div>

  </section>
</main>

<?php get_footer(); ?>
