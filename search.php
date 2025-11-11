<?php get_header(); ?>

<?php
$search_query = trim(get_search_query());

if (empty($search_query)) {
    echo '<p>Aucune recherche effectuée.</p>';
} else {
    $project_types = ['projet-arcade', 'projet-finissant', 'projet-graphisme'];
    $results = [];

    // Boucle pour trouver les projets correspondants
    foreach ($project_types as $ptype) {
        $projets = get_posts([
            'post_type' => $ptype,
            'posts_per_page' => -1
        ]);

        foreach ($projets as $projet) {
            $projet_id = is_object($projet) ? $projet->ID : $projet;

            // Vérifier titre du projet
            $project_title_field = get_field('nom_du_projet', $projet_id) ?: get_field('nom_projet', $projet_id);
            if ($project_title_field && stripos($project_title_field, $search_query) !== false) {
                $results[] = $projet_id;
                continue;
            }

            // Vérifier étudiants associés
            $etudiants = get_field('etudiants_associes', $projet_id);
            if ($etudiants && is_array($etudiants)) {
                foreach ($etudiants as $etu) {
                    $etu_id = is_object($etu) ? $etu->ID : $etu;
                    if (!$etu_id) continue;

                    $prenom = get_field('prenom', $etu_id);
                    $nom = get_field('nom_etudiant', $etu_id);
                    $fullName = trim("$prenom $nom");

                    if (stripos($fullName, $search_query) !== false) {
                        $results[] = $projet_id;
                        break;
                    }
                }
            }
        }
    }
    ?>

    <h1>Résultats pour "<?php echo esc_html($search_query); ?>"</h1>

    <?php if (!empty($results)): ?>
        <div class="projets-grid">
            <?php foreach ($results as $projet_id): ?>
                <?php
                // Récupération des champs
                $project_title = get_field('nom_du_projet', $projet_id) ?: get_field('nom_projet', $projet_id) ?: get_the_title($projet_id);
                $project_desc = get_field('description', $projet_id) ?: '';
                $project_image_field = get_field('image_du_projet', $projet_id);

                // Gestion ACF image
                if ($project_image_field) {
                    if (is_array($project_image_field) && isset($project_image_field['url'])) {
                        $project_image = $project_image_field['url'];
                    } elseif (is_numeric($project_image_field)) {
                        $project_image = wp_get_attachment_image_url($project_image_field, 'medium');
                    } else {
                        $project_image = $project_image_field;
                    }
                } else {
                    $project_image = get_the_post_thumbnail_url($projet_id, 'medium');
                }

                // Équipe
                $etudiants = get_field('etudiants_associes', $projet_id);
                $liste_etudiants = [];

                if ($etudiants && is_array($etudiants)) {
                    foreach ($etudiants as $e) {
                        $e_id = is_object($e) ? $e->ID : $e;
                        if (!$e_id) continue;
                        $liste_etudiants[] = trim(get_field('prenom', $e_id) . ' ' . get_field('nom_etudiant', $e_id));
                    }
                }
                ?>
                <div class="projet-card">
                    <?php if ($project_image): ?>
                        <a href="<?php echo get_permalink($projet_id); ?>">
                            <img src="<?php echo esc_url($project_image); ?>" alt="<?php echo esc_attr($project_title); ?>">
                        </a>
                    <?php endif; ?>

                    <h2>
                        <a href="<?php echo get_permalink($projet_id); ?>">
                            <?php echo esc_html($project_title); ?>
                        </a>
                    </h2>

                    <?php if (!empty($project_desc)): ?>
                        <p><?php echo esc_html($project_desc); ?></p>
                    <?php endif; ?>

                    <?php if (!empty($liste_etudiants)): ?>
                        <p class="equipe">Équipe : <?php echo esc_html(implode(', ', $liste_etudiants)); ?></p>
                    <?php endif; ?>
                </div>
            <?php endforeach; ?>
        </div>
    <?php else: ?>
        <p>Aucun projet trouvé.</p>
    <?php endif; ?>

<?php } ?>

<?php get_footer(); ?>
