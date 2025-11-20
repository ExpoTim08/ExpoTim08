<?php
/*
Template Name: Projets finissants
*/
require("global.php");
?>

<body> 
<div class="pattern-background">

<?php
get_header();
?>
<main class="page-finissant">
  <div class="border gauche"></div>
  <div class="border droite"></div>

  <!-- ===================== Présentation Finissant ===================== -->
  <section class="presentation-finissant">
    <h1 class="titre-finissant" aria-label="finissant">
      <span class="titre-finissant-layer titre-finissant--base">FINISSANTS</span>
      <span class="titre-finissant-layer titre-finissant-layer--1">FINISSANTS</span>
      <span class="titre-finissant-layer titre-finissant-layer--2">FINISSANTS</span>
      <span class="titre-finissant-layer titre-finissant-layer--3">FINISSANTS</span>
    </h1>

    <svg class="logo-finissant" width="181" height="177" viewBox="0 0 181 177" fill="none" xmlns="http://www.w3.org/2000/svg">
    <path d="M46.5964 85.63L62.7584 60.4906C63.1226 59.9241 63.9314 59.8723 64.3649 60.3879L92.0953 93.3678C92.2211 93.5174 92.388 93.6269 92.5753 93.6827L136.603 106.793C137.242 106.983 137.519 107.732 137.159 108.292L120.982 133.455C120.754 133.81 120.336 133.985 119.926 133.89C110.38 131.675 87.4595 125.733 74.3417 122.094C74.1321 122.036 73.9513 121.91 73.8191 121.737C62.7023 107.203 54.7246 97.2567 46.6457 86.7811C46.3876 86.4465 46.3679 85.9854 46.5964 85.63Z" fill="#D09308" stroke="#D7C9B6"/>
    <path d="M96.626 85.6456L47.4627 26.3521C46.2169 24.8497 47.6405 22.6353 49.5245 23.1449L123.794 43.2366C124.601 43.4547 125.318 43.9199 125.847 44.5668L175.496 105.33C176.592 106.671 176.7 108.566 175.763 110.024L148.898 151.812C148.773 152.006 148.721 152.243 148.742 152.473C149.934 165.213 136.501 170.061 128.703 171.052C128.149 171.122 127.662 170.691 127.627 170.133C126.336 149.338 134.173 145.442 138.907 146.127C139.334 146.188 139.77 146.023 140.003 145.66L164.073 108.221C164.431 107.663 164.157 106.917 163.523 106.724L98.5391 86.9187C97.7906 86.6905 97.1255 86.2479 96.626 85.6456Z" fill="#D09308" stroke="#D7C9B6"/>
    </svg>

    <div class="conteneur-description-finissant">
      <p class="description-titre">Description</p>
      <p class="description-texte">
        Les finissants de la Technique d’intégration multimédia présentent le projet synthèse de leur parcours. Après avoir exploré toutes les dimensions du multimédia – Jeu, web, design, programmation, création de médias, interactivité et plus encore – chaque étudiant a choisi le sujet qui le passionne le plus et a développé un projet original qui reflète son expertise et sa créativité. 
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
    <section class="liste-projet-finissant">
        <?php
        // 1. Définir le type de publication pour les projets finissants.
        // Assurez-vous que 'projet-finissants' correspond à votre Post Type dans WordPress.
        $projets_finissants = new WP_Query([
            'post_type' => 'projet-finissant', // **À AJUSTER** si votre CPT a un slug différent
            'posts_per_page' => -1,
            'orderby' => 'title',
            'order' => 'ASC'
        ]);

        if ($projets_finissants->have_posts()) :
            while ($projets_finissants->have_posts()) : $projets_finissants->the_post();
                // 2. Récupérer les champs ACF selon la configuration dans l'image.
                $titre       = get_field('nom_du_projet');
                $description = get_field('description');
                $image       = get_field('image'); // Champ 'Image'
                $liens       = get_field('liens'); // Champ 'Liens' (URL)

                // Pour un affichage court de la description (similaire au code Arcade)
                $short_desc = wp_trim_words(wp_strip_all_tags($description), 40, '...');
        ?>


       <!-- ===== Carte Projet Desktop ===== -->
        <article class="carte-projet-finissant carte-projet-finissant--desktop">
            <?php if (!empty($image) && !empty($image['url'])) : ?>
            <img class="image-projet-finissant"
                src="<?php echo esc_url($image['url']); ?>"
                alt="<?php echo esc_attr($image['alt'] ?: $titre); ?>">
            <?php endif; ?>

            <div class="conteneur-carte-bas">
                <h2 class="titre-projet-finissant"><?php echo esc_html($titre); ?></h2>
                <p class="carte-finissant-titre-description">Description</p>
                <p class="description-projet"><?php echo esc_html($short_desc); ?></p>
                    
                <?php 
                // Champ d'étudiants associés (non présent dans l'image mais utile)
                // Si vous avez un champ 'etudiants_associes' (similaire à Arcade), vous pouvez le réintégrer ici.
                /*
                if (have_rows('etudiants_associes')) {
                    echo '<p>Étudiants associés :</p><ul>';
                    while (have_rows('etudiants_associes')) {
                        the_row();
                        $prenom = get_sub_field('prenom_etudiant');
                        $nomEtu = get_sub_field('nom_etudiant');
                        echo '<li>' . esc_html(trim("$prenom $nomEtu")) . '</li>';
                    }
                    echo '</ul>';
                }


                <?php if ($liens): ?>
                    <p class="liens-projet">
                        <a href="<?php echo esc_url($liens); ?>" target="_blank">
                            Liens
                        </a>
                    </p>
                <?php endif; ?>
                */
                ?>
            
            <button class="button-projet-finissant"
                onclick="window.location.href='<?php echo esc_url(get_permalink()); ?>'">
                <!--En savoir plus--> >>
            </button>
        </article>

        <!-- ===== Carte Projet Mobile ===== -->
        <article class="carte-projet-finissant carte-projet-finissant--mobile">
            <div class="bloc-titre">
                <h2 class="titre-projet-finissant"><?php echo esc_html($titre); ?></h2>
                <button class="button-projet-finissant"
                    onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projets-finissants')))); ?>'">
                    &gt;&gt;
                </button>
            </div>

            <?php if ($image): ?>
                <img class="image-projet-finissant" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($titre); ?>">
                
                <span class="conteneur-button-dropdown-finissant">
                <p class="carte-finissant-titre-description">Description</p>
                <button
                    class="button-dropdown-finissant"
                    aria-expanded="false"
                    aria-controls="<?php echo 'dropdown-'.get_the_ID(); ?>">
                    +
                </button>
                </span>

                <div id="<?php echo 'dropdown-'.get_the_ID(); ?>" class="dropdown-carte-finissant" aria-hidden="true">
                <p class="description-projet"><?php echo esc_html($short_desc); ?></p>
                </div>
            </article>
            <?php endif; ?>
        <?php
            endwhile;
            wp_reset_postdata();
        else:
            echo '<p>Aucun projet de finissants pour le moment.</p>';
        endif;
        ?>
    </section>

</main>

<?php 
get_footer();
?>

</div>
</body>