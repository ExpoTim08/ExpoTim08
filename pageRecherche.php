<?php
get_header();

// Récupère le terme recherché
$search_term = get_search_query();

// Arguments pour WP_Query
$args = array(
    'post_type' => 'projet',
    'posts_per_page' => -1,
    'meta_query' => array(
        'relation' => 'OR',
        array(
            'key' => 'nom_du_projet',
            'value' => $search_term,
            'compare' => 'LIKE'
        ),
        array(
            'key' => 'etudiants_associes',
            'value' => $search_term,
            'compare' => 'LIKE'
        )
    )
);

$query = new WP_Query($args);
?>

<h1>Résultats de recherche pour "<?php echo esc_html($search_term); ?>"</h1>

<?php if($query->have_posts()): ?>
    <ul>
        <?php while($query->have_posts()): $query->the_post(); ?>
            <li>
                <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
                <?php
                $etudiants = get_field('etudiants_associes');
                if($etudiants):
                    echo ' - Équipe : ';
                    $liste = [];
                    foreach($etudiants as $e){
                        $liste[] = get_field('prenom', $e->ID) . ' ' . get_field('nom_etudiant', $e->ID);
                    }
                    echo implode(', ', $liste);
                endif;
                ?>
            </li>
        <?php endwhile; ?>
    </ul>
<?php else: ?>
    <p>Aucun projet trouvé.</p>
<?php endif; ?>

<?php wp_reset_postdata(); ?>
<?php get_footer(); ?>
