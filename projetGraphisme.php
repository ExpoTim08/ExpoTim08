<?php
/*
Template Name: Projet Graphisme
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
$image       = get_field('affiche', $projet_id);
$etudiants   = get_field('etudiants_associes', $projet_id);
$annee       = get_field('annee', $projet_id);
$numeroCours = get_field('numero_du_cours', $projet_id);
$behance     = get_field('liens_behance', $projet_id);

// Sécurité : si $nom est vide
$nom_affiche = $nom ?: 'Projet Graphisme';
?>

<main class="page-graphisme">
  <div class="border gauche"></div>
  <div class="border droite"></div>

  <!-- Présentation du projet -->
  <section class="presentation-graphisme">

    <!-- Titre du projet (avec style Graphisme) -->
    <h1 class="titre-graphisme" aria-label="<?php echo esc_attr($nom_affiche); ?>">
      <span class="titre-graphisme-layer titre-graphisme--base"><?php echo esc_html($nom_affiche); ?></span>
      <span class="titre-graphisme-layer titre-graphisme-layer-1"><?php echo esc_html($nom_affiche); ?></span>
      <span class="titre-graphisme-layer titre-graphisme-layer-2"><?php echo esc_html($nom_affiche); ?></span>
      <span class="titre-graphisme-layer titre-graphisme-layer-3"><?php echo esc_html($nom_affiche); ?></span>
      <!-- Bouton retour vers la page Graphisme -->
      <p class="retour-graphisme">
        <a href="<?php echo esc_url(get_permalink(get_page_by_path('graphisme'))); ?>" class="lien-retour">
          &lt; Graphisme
        </a>
      </p>
      <img class="tree" src="<?php echo get_template_directory_uri(); ?>/Images/Tree.svg" alt="">
    </h1>

    <!-- Description -->
    <div class="description-projet">

    <!-- Image du projet -->
    <?php if ($image && !empty($image['url'])): ?>
      <div class="image-projet">
        <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($nom_affiche); ?>" class="image-projet-graphisme">
      </div>
    <?php endif; ?>

    <!-- Étudiants -->
    <?php if ($etudiants): ?>
      <div class="infos-etudiants">
        <strong>Équipe :</strong>
        <?php
        $liste = [];
        foreach ($etudiants as $etudiant) {
          $prenom = get_field('prenom', $etudiant->ID);
          $nomEtu = get_field('nom_etudiant', $etudiant->ID);
          $fullName = trim("$prenom $nomEtu");

          $liste[] = '<span class="nom-etudiant">' . esc_html($fullName) . '</span>';
        }
        echo implode(', ', $liste);
        ?>
      </div>
    <?php endif; ?>

    <?php if ($description): ?>
      <div class="conteneur-description">
        <p class="description-titre">Description</p>
        <p class="description-texte"><?php echo esc_html($description); ?></p>
      </div>
    <?php endif; ?>
    </div>

    <!-- Infos cours / année -->
    <div class="infos-cours-annee">
      <?php if ($numeroCours): ?>
        <span class="numero-cours">Cours : <?php echo esc_html($numeroCours); ?></span>
      <?php endif; ?>
      <?php if ($annee): ?>
        <span class="annee-projet">Année : <?php echo esc_html($annee); ?></span>
      <?php endif; ?>
    </div>

    <!-- Lien Behance -->
    <?php if ($behance): ?>
      <p class="behance-projet">
        <a href="<?php echo esc_url($behance); ?>" target="_blank" rel="noopener noreferrer">
          Voir sur Behance
        </a>
      </p>
    <?php endif; ?>

  </section>
</main>

<?php get_footer(); ?>
