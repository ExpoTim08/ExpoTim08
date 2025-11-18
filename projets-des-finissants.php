<?php
/*
Template Name: Projet finissants
*/
get_header();
?>
<main>
    <section>
        <h1>Projets des finissants</h1>
    </section>

    <section class="liste-projet-finissants">
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
                $nom         = get_field('nom_du_projet');
                $description = get_field('description');
                $image       = get_field('image'); // Champ 'Image'
                $liens       = get_field('liens'); // Champ 'Liens' (URL)

                // Pour un affichage court de la description (similaire au code Arcade)
                $short_desc = wp_trim_words(wp_strip_all_tags($description), 40, '...');
        ?>

        <article class="carte-projet-finissant">
            
            <section class="contenu-projet">
                <h2><?php echo esc_html($nom); ?></h2>
                
                <?php if ($image): 
                    // Assurez-vous que le champ 'image' est de type Image et retourne un tableau
                ?>
                    <img class="image-projet-finissant" 
                         src="<?php echo esc_url($image['url']); ?>" 
                         alt="<?php echo esc_attr($nom); ?>">
                <?php endif; ?>

                <h3>Description</h3>
                <p class="description-projet-courte"><?php echo esc_html($short_desc); ?></p>
                
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
                */
                ?>

                <?php if ($liens): ?>
                    <p class="liens-projet">
                        <a href="<?php echo esc_url($liens); ?>" target="_blank">
                            Liens
                        </a>
                    </p>
                <?php endif; ?>
            </section>
            
            <button class="button-projet-finissant"
                onclick="window.location.href='<?php echo esc_url(get_permalink()); ?>'">
                En savoir plus >>
            </button>

        </article>

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