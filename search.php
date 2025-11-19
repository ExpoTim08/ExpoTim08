<?php get_header(); ?>

<?php
$search_query = trim(get_search_query());

if (empty($search_query) || mb_strlen($search_query) < 2) {
    echo '<p>Aucune recherche effectuée. Veuillez entrer au moins 2 lettres.</p>';
} else {
    $project_types = ['projet-arcade', 'projet-finissant', 'projet-graphisme'];
    $normalized_query = normalize_string($search_query);

    // Récupérer tous les projets
    $all_projects = get_posts([
        'post_type'      => $project_types,
        'posts_per_page' => -1,
        'post_status'    => 'publish',
    ]);

    $results_temp = [];

    foreach ($all_projects as $projet) {
        $projet_id = $projet->ID;

        // Titre
        $title = get_field('nom_du_projet', $projet_id) ?: get_field('nom_projet', $projet_id) ?: get_the_title($projet_id);
        $normalized_title = normalize_string($title);

        // Vérifie correspondance titre
        $match = $normalized_title && mb_stripos($normalized_title, $normalized_query) !== false;

        // Liste étudiants
        $liste_etudiants = [];
        $etudiants = get_field('etudiants_associes', $projet_id);
        if ($etudiants && is_array($etudiants)) {
            foreach ($etudiants as $etu) {
                $etu_id = is_object($etu) ? $etu->ID : $etu;
                if (!$etu_id) continue;
                $prenom = get_field('prenom', $etu_id);
                $nom = get_field('nom_etudiant', $etu_id);
                $fullName = trim("$prenom $nom");
                if ($fullName) $liste_etudiants[] = $fullName;

                // Vérifie correspondance étudiants
                if (!$match && mb_stripos(normalize_string($fullName), $normalized_query) !== false) {
                    $match = true;
                }
            }
        }

        if ($match) {
            // Récupération de l'image (ACF / featured / fallback)
            $image_field = get_field('image_du_projet', $projet_id);
            $image = '';

            if ($image_field) {
                if (is_array($image_field) && isset($image_field['url'])) {
                    $image = $image_field['url'];
                } elseif (is_array($image_field) && isset($image_field[0]['url'])) {
                    // Si c'est une galerie ou répétiteur
                    $image = $image_field[0]['url'];
                } elseif (is_numeric($image_field)) {
                    $image = wp_get_attachment_image_url($image_field, 'medium');
                } elseif (filter_var($image_field, FILTER_VALIDATE_URL)) {
                    $image = $image_field;
                }
            }

            // fallback sur featured image
            if (!$image) {
                $thumb_url = get_the_post_thumbnail_url($projet_id, 'medium');
                if ($thumb_url) {
                    $image = $thumb_url;
                }
            }

            // fallback sur image locale par défaut
            if (!$image) {
                $default_image_path = get_template_directory_uri() . '/assets/images/default-project.png';
                if (file_exists(get_theme_file_path('/assets/images/default-project.png'))) {
                    $image = $default_image_path;
                } else {
                    $image = ''; // tu peux mettre un placeholder local si tu veux
                }
            }

            // Stockage temporaire
            $results_temp[] = [
                'id' => $projet_id,
                'title' => $title,
                'desc' => get_field('description', $projet_id) ?: '',
                'image' => $image,
                'etudiants' => $liste_etudiants
            ];
        }
    }

    // Déduplication intelligente par titre : on privilégie la version avec image
    $results = [];
    $seen_titles = [];

    foreach ($results_temp as $item) {
        $norm_title = normalize_string($item['title']);

        if (!isset($seen_titles[$norm_title])) {
            $results[$norm_title] = $item;
            $seen_titles[$norm_title] = $item['image'];
        } else {
            // Si le projet existant n'a pas d'image mais celui-ci en a une, on remplace
            if (empty($results[$norm_title]['image']) && !empty($item['image'])) {
                $results[$norm_title]['image'] = $item['image'];
            }
        }
    }

    // Transformer en tableau simple pour foreach
    $results = array_values($results);
?>

<h1>Résultats pour "<?php echo esc_html($search_query); ?>"</h1>

<?php if (!empty($results)): ?>
    <div class="projets-grid">
        <?php foreach ($results as $data): ?>
            <div class="projet-card">
                <?php if (!empty($data['image'])): ?>
                    <a href="<?php echo get_permalink($data['id']); ?>">
                        <img src="<?php echo esc_url($data['image']); ?>" alt="<?php echo esc_attr($data['title']); ?>">
                    </a>
                <?php endif; ?>

                <h2>
                    <a href="<?php echo get_permalink($data['id']); ?>">
                        <?php echo esc_html($data['title']); ?>
                    </a>
                </h2>

                <?php if (!empty($data['desc'])): ?>
                    <p><?php echo esc_html($data['desc']); ?></p>
                <?php endif; ?>

                <?php if (!empty($data['etudiants'])): ?>
                    <p class="equipe">Équipe : <?php echo esc_html(implode(', ', $data['etudiants'])); ?></p>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>
<?php else: ?>
    <p>Aucun projet trouvé.</p>
<?php endif; ?>

<?php } ?>

<?php get_footer(); ?>
