<?php
/*
Template Name: Jour de la terre
*/
get_header();
?>

<main>
    <section class="section-graphisme">
        <h1>Graphismes</h1>
        <p class="description-graphisme">
            Dans le cours <strong><em>Conception graphique et imagerie vectorielle</em></strong>,
            les étudiants de première année ont réalisé une recherche sur un enjeu environnemental.
            À partir de cette recherche, ils ont imaginé un jeu vidéo ou une application permettant
            de sensibiliser la population à cet enjeu. Ils en ont conçu l’identité visuelle et l’ont
            présentée sous forme d’affiche. Le code QR présent sur chaque affiche donne accès à une
            présentation détaillant le projet proposé.
        </p>
    </section>

    <section class="projets">
        <?php
        // Requête pour tous les projets graphismes
        $projets = new WP_Query(array(
            'post_type'      => 'projet-graphisme',
            'posts_per_page' => -1,
            'orderby'        => 'title',
            'order'          => 'ASC'
        ));

        if ($projets->have_posts()) :
            while ($projets->have_posts()) : $projets->the_post();
                ?>
                <article class="projet">
                    <h2><?php the_title(); ?></h2>

                    <?php 
                    // Champ image (affiche)
                    $image = get_field('affiche'); 
                    if ($image): ?>
                        <img class="image-graphisme" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>">
                    <?php endif; ?>

                    <?php 
                    // Description du projet
                    if ($description = get_field('description')): ?>
                        <p><?php echo esc_html($description); ?></p>
                    <?php endif; ?>

                    <?php 
                    // Étudiants associés (champ relation)
                    $etudiants = get_field('etudiants_associes');
                    if ($etudiants): ?>
                        <p class="etudiants-associes">
                            <strong>Étudiants :</strong>
                            <?php
                            $noms = array();
                            foreach ($etudiants as $etudiant) {
                                $noms[] = get_the_title($etudiant->ID);
                            }
                            echo esc_html(implode(', ', $noms));
                            ?>
                        </p>
                    <?php endif; ?>

                    <?php 
                    // Lien Behance
                    if ($behance = get_field('liens_behance')): ?>
                        <p><a href="<?php echo esc_url($behance); ?>" target="_blank">Voir sur Behance</a></p>
                    <?php endif; ?>
                </article>
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
