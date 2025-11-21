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

// Champs ACF
$nom        = get_field('nom_du_projet', $projet_id) ?: get_the_title($projet_id);
$description = get_field('description', $projet_id);
$video       = get_field('video_du_projet', $projet_id);
$image       = get_field('image', $projet_id);   // ACF correct pour finissants
$affiche     = get_field('affiche', $projet_id);
$etudiants   = get_field('etudiants_associes', $projet_id);

// Fallback image si image principale manquante
if (!$image && $affiche) $image = $affiche;
if (is_array($image) && isset($image['url'])) $image = $image['url'];
?>

<main class="page-finissant">

    <div class="border gauche"></div>
    <div class="border droite"></div>

    <!-- Titre dynamique -->
    <section class="titre-projet-finissant">
        <h1 class="titre-graphisme" aria-label="<?php echo esc_attr($nom); ?>">
            <span class="titre-graphisme-layer titre-graphisme--base"><?php echo esc_html($nom); ?></span>
            <span class="titre-graphisme-layer titre-graphisme-layer--1"><?php echo esc_html($nom); ?></span>
            <span class="titre-graphisme-layer titre-graphisme-layer--2"><?php echo esc_html($nom); ?></span>
            <span class="titre-graphisme-layer titre-graphisme-layer--3"><?php echo esc_html($nom); ?></span>
        </h1>

        <!-- Bouton retour -->
        <p class="retour-graphisme">
            <a href="<?php echo esc_url(get_permalink(get_page_by_path('projets-finissants'))); ?>" class="lien-retour">
                &lt; Finissants
            </a>
        </p>
    </section>

    <section class="contenu-projet">

        <?php
        // ============================
        // ⚡ CAS 1 : VIDÉO disponible
        // ============================
        if ($video):
            
            // URL externe (YouTube/Vimeo)
            if (filter_var($video, FILTER_VALIDATE_URL)): ?>
                <div class="video-container">
                    <iframe src="<?php echo esc_url($video); ?>" frameborder="0" allowfullscreen></iframe>
                </div>

            <?php 
            // Upload mp4
            else: ?>
                <video class="video-projet" controls>
                    <source src="<?php echo esc_url($video); ?>" type="video/mp4">
                </video>
            <?php endif; ?>

        <?php
        // ============================
        // ⚡ CAS 2 : PAS DE VIDÉO → IMAGE
        // ============================
        elseif ($image): ?>
            <figure class="image-projet">
                <img src="<?php echo esc_url($image); ?>" alt="<?php echo esc_attr($nom); ?>">
            </figure>

        <?php
        // ============================
        // ⚡ CAS 3 : PAS DE VIDÉO, PAS D'IMAGE → fallback
        // ============================
        else: ?>
            <p class="aucun-media">Aucun média disponible pour ce projet.</p>
        <?php endif; ?>

        <!-- Description -->
        <?php if ($description): ?>
            <div class="description-projet">
                <p><?php echo esc_html($description); ?></p>
            </div>
        <?php endif; ?>

        <!-- Équipe -->
        <?php if ($etudiants && is_array($etudiants)): ?>
            <div class="equipe-projet">
                <h3>Équipe</h3>
                <ul>
                    <?php foreach ($etudiants as $etu): 
                        $etu_id = is_object($etu) ? $etu->ID : $etu;
                        $prenom = get_field('prenom', $etu_id);
                        $nom_e = get_field('nom_etudiant', $etu_id);
                    ?>
                        <li><?php echo esc_html("$prenom $nom_e"); ?></li>
                    <?php endforeach; ?>
                </ul>
            </div>
        <?php endif; ?>

    </section>

</main>

<?php get_footer(); ?>
