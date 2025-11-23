<?php get_header(); ?>
<body>
    <div class="pattern-background">

        <main class="search-results">
            <div class="border gauche"></div>
            <div class="border droite"></div>

<?php
$search_query = trim(get_search_query());
$too_short = empty($search_query) || mb_strlen($search_query) < 2;
?>

    <!-- SECTION TITRE RECHERCHE -->
    <section class="recherche-section">
        <h1 class="titre-recherche" aria-label="recherche">
            <span class="titre-recherche-layer titre-recherche-base">RECHERCHE</span>
            <span class="titre-recherche-layer titre-recherche-layer--1">RECHERCHE</span>
            <span class="titre-recherche-layer titre-recherche-layer--2">RECHERCHE</span>
            <span class="titre-recherche-layer titre-recherche-layer--3">RECHERCHE</span>
        </h1>

        <p class="recherche-resultats">
            Résultats pour "<?php echo esc_html($search_query); ?>"
        </p>
    </section>

<?php if ($too_short): ?>
    <!--CAS : moins de 2 lettres -->    
    <section class="no-results">
        <p class="aucun-projet">Veuillez entrer au moins 2 lettres.</p>
    </section>

<?php else: ?>

<?php
// =========================
//     RECHERCHE PROJETS
// =========================

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
    $title = get_field('nom_du_projet', $projet_id) ?: get_the_title($projet_id);
    $normalized_title = normalize_string($title);

    // Vérifie correspondance titre
    $match = $normalized_title && mb_stripos($normalized_title, $normalized_query) !== false;

    // Étudiants associés
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

            if (!$match && mb_stripos(normalize_string($fullName), $normalized_query) !== false) {
                $match = true;
            }
        }
    }

    if ($match) {

        // Récupération image projet
        $image_field = get_field('image', $projet_id) ?: get_field('image_du_projet', $projet_id) ?: get_field('affiche', $projet_id);
        $image = '';

        if ($image_field) {
            if (is_array($image_field) && isset($image_field['url'])) {
                $image = $image_field['url'];
            } elseif (is_array($image_field) && isset($image_field[0]['url'])) {
                $image = $image_field[0]['url'];
            } elseif (is_numeric($image_field)) {
                $image = wp_get_attachment_image_url($image_field, 'medium');
            } elseif (filter_var($image_field, FILTER_VALIDATE_URL)) {
                $image = $image_field;
            }
        }

        // Fallback featured
        if (!$image) {
            $thumb_url = get_the_post_thumbnail_url($projet_id, 'medium');
            if ($thumb_url) $image = $thumb_url;
        }

        // Fallback local
        if (!$image) {
            $default_path = get_template_directory_uri() . '/assets/images/default-project.png';
            if (file_exists(get_theme_file_path('/assets/images/default-project.png'))) {
                $image = $default_path;
            }
        }

        $results_temp[] = [
            'id'        => $projet_id,
            'title'     => $title,
            'desc'      => get_field('description', $projet_id) ?: '',
            'image'     => $image,
            'etudiants' => $liste_etudiants,
            'type'      => $projet->post_type
        ];
    }
}

// Déduplication
$results = [];
$seen_titles = [];

foreach ($results_temp as $item) {
    $norm_title = normalize_string($item['title']);

    if (!isset($seen_titles[$norm_title])) {
        $results[$norm_title] = $item;
        $seen_titles[$norm_title] = true;
    } else {
        if (empty($results[$norm_title]['image']) && !empty($item['image'])) {
            $results[$norm_title]['image'] = $item['image'];
        }
    }
}

$results = array_values($results);
?>

<?php if (!empty($results)): ?>
    <?php
// Couper le texte sans couper les mots
function truncate_no_cut($text, $max_chars = 200) {
    $text = trim($text);
    if ($text === '') return '';
    if (function_exists('mb_strlen')) {
        if (mb_strlen($text) <= $max_chars) return $text;
        $trunc = mb_substr($text, 0, $max_chars);
        $last_space = mb_strrpos($trunc, ' ');
        if ($last_space !== false) {
            $trunc = mb_substr($trunc, 0, $last_space);
        }
        return rtrim($trunc) . '…';
    } else {
        if (strlen($text) <= $max_chars) return $text;
        $trunc = substr($text, 0, $max_chars);
        $last_space = strrpos($trunc, ' ');
        if ($last_space !== false) {
            $trunc = substr($trunc, 0, $last_space);
        }
        return rtrim($trunc) . '…';
    }
}
?>

    <!--Résultats -->
    <section class="results-container">
        <div class="projets-grid">

            <?php foreach ($results as $data): ?>

                <?php
                // Déterminer le lien du projet selon son type
                switch ($data['type']) {
                    case 'projet-arcade':
                        $lien_projet = add_query_arg('projet_id', $data['id'], get_permalink(get_page_by_path('projet-arcade')));
                        break;
                    case 'projet-graphisme':
                        $lien_projet = add_query_arg('projet_id', $data['id'], get_permalink(get_page_by_path('projet-graphisme')));
                        break;
                    case 'projet-finissant':
                        $lien_projet = add_query_arg('projet_id', $data['id'], get_permalink(get_page_by_path('projet-finissant')));
                        break;
                    default:
                        $lien_projet = get_permalink($data['id']);
                }
                ?>

                <article class="projet-card">

                    <?php if (!empty($data['image'])): ?>
                        <figure class="projet-figure">
                            <a href="<?php echo esc_url($lien_projet); ?>">
                                <img src="<?php echo esc_url($data['image']); ?>" alt="<?php echo esc_attr($data['title']); ?>">
                            </a>
                        </figure>

                        <!-- Actions container keeps the 'voir projet' button (navigation) -->
                        <div class="projet-actions">
                            <button class="button-voir-projet" onclick="window.location.href='<?php echo esc_url($lien_projet); ?>'">&gt;&gt;</button>
                        </div>
                    <?php endif; ?>

                    <section class="projet-section">
                        <h2 class="projet-title">
                            <a href="<?php echo esc_url($lien_projet); ?>">
                                <?php echo esc_html($data['title']); ?>
                            </a>
                        </h2>

                        <?php if (!empty($data['etudiants'])): ?>
                            <p class="projet-equipe">
                                <strong>Équipe :</strong>
                                <?php echo esc_html(implode(', ', $data['etudiants'])); ?>
                            </p>
                        <?php endif; ?>                        

                        <!-- Toggle button positioned inside the figure (bottom-right) -->
                        <div class="projet-toggle-desc">
                            <button class="button-toggle-desc" aria-expanded="false" aria-controls="desc-<?php echo $data['id']; ?>">+</button>
                        </div>
                        <?php if (!empty($data['desc'])): ?>
                        <p id="desc-<?php echo $data['id']; ?>" class="projet-description"><?php echo esc_html(truncate_no_cut($data['desc'], 200)); ?></p>
                        <?php endif; ?>
                    </section>

                </article>
            <?php endforeach; ?>

        </div>
    </section>

<?php else: ?>

    <!--Aucun projet trouvé -->
    <section class="no-results">
        <p class="aucun-projet">Aucun projet trouvé.</p>
    </section>

<?php endif; ?>

<?php endif; ?>

                </main>
        </div>


</body>
<?php get_footer(); ?>
