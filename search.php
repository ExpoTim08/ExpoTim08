<?php get_header(); ?>

<?php
$search_query = trim(get_search_query());
$project_types = ['projet-arcade', 'projet-finissant', 'projet-graphisme'];
$results = [];

function normalize_string($str) {
    $str = mb_strtolower($str, 'UTF-8');
    $accents = [
        'à'=>'a','â'=>'a','ä'=>'a','á'=>'a','ã'=>'a','å'=>'a',
        'ç'=>'c',
        'è'=>'e','é'=>'e','ê'=>'e','ë'=>'e',
        'ì'=>'i','í'=>'i','î'=>'i','ï'=>'i',
        'ñ'=>'n',
        'ò'=>'o','ó'=>'o','ô'=>'o','ö'=>'o','õ'=>'o',
        'ù'=>'u','ú'=>'u','û'=>'u','ü'=>'u',
        'ý'=>'y','ÿ'=>'y',
        'œ'=>'oe','æ'=>'ae'
    ];
    return strtr($str, $accents);
}

if (!empty($search_query) && mb_strlen($search_query) >= 2) {
    $normalized_query = normalize_string($search_query);

    foreach ($project_types as $ptype) {
        $projets = get_posts([
            'post_type' => $ptype,
            'posts_per_page' => -1
        ]);

        foreach ($projets as $projet) {
            $projet_id = is_object($projet) ? $projet->ID : $projet;

            $project_title_field = get_field('nom_du_projet', $projet_id) ?: get_field('nom_projet', $projet_id);
            if ($project_title_field) {
                if (mb_stripos(normalize_string($project_title_field), $normalized_query) !== false) {
                    $results[] = $projet_id;
                    continue;
                }
            }

            $etudiants = get_field('etudiants_associes', $projet_id);
            if ($etudiants && is_array($etudiants)) {
                foreach ($etudiants as $etu) {
                    $etu_id = is_object($etu) ? $etu->ID : $etu;
                    $prenom = get_field('prenom', $etu_id);
                    $nom = get_field('nom_etudiant', $etu_id);
                    $fullName = trim("$prenom $nom");

                    if (mb_stripos(normalize_string($fullName), $normalized_query) !== false) {
                        $results[] = $projet_id;
                        break;
                    }
                }
            }
        }
    }
}
?>

<div class="pattern-background">
    <main>
        <div class="border gauche"></div>
        <div class="border droite"></div>

        <?php if (empty($search_query) || mb_strlen($search_query) < 2): ?>
            <section class="section-resultats">
                <p>Aucune recherche effectuée. Veuillez entrer au moins 2 lettres.</p>
            </section>
        <?php else: ?>

            <section class="section-resultats">
                <h1 class="resultat">Résultats pour "<?php echo esc_html($search_query); ?>"</h1>

                <?php if (!empty($results)): ?>
                    <div class="projets-grid">
                        <?php foreach ($results as $projet_id): ?>
                            <?php
                            $project_title = get_field('nom_du_projet', $projet_id)
                                ?: get_field('nom_projet', $projet_id)
                                ?: get_the_title($projet_id);

                            $project_desc = get_field('description', $projet_id) ?: '';

                            $project_image_field = get_field('image_du_projet', $projet_id);
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

                            $etudiants = get_field('etudiants_associes', $projet_id);
                            $liste_etudiants = [];

                            if ($etudiants && is_array($etudiants)) {
                                foreach ($etudiants as $e) {
                                    $e_id = is_object($e) ? $e->ID : $e;
                                    $liste_etudiants[] = trim(get_field('prenom', $e_id) . ' ' . get_field('nom_etudiant', $e_id));
                                }
                            }
                            ?>

                            <article class="projet-card">
                                <?php if ($project_image): ?>
                                    <a href="<?php echo get_permalink($projet_id); ?>">
                                        <img src="<?php echo esc_url($project_image); ?>" alt="<?php echo esc_attr($project_title); ?>">
                                    </a>
                                <?php endif; ?>

                                <h2 class="titre-projet">
                                    <a href="<?php echo get_permalink($projet_id); ?>">
                                        <?php echo esc_html($project_title); ?>
                                    </a>
                                </h2>

                                <?php if (!empty($project_desc)): ?>
                                    <p class="description-projet"><?php echo esc_html($project_desc); ?></p>
                                <?php endif; ?>

                                <?php if (!empty($liste_etudiants)): ?>
                                    <p class="equipe">Équipe : <?php echo esc_html(implode(', ', $liste_etudiants)); ?></p>
                                <?php endif; ?>
                            </article>
                        <?php endforeach; ?>
                    </div>

                <?php else: ?>
                    <p class="aucun-projet">Aucun projet trouvé.</p>
                <?php endif; ?>

            </section>

        <?php endif; ?>
    </main>
</div>

<?php get_footer(); ?>
