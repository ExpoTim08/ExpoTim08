<?php
// =========================================================
// Charger le fichier customizer.php (options du thème)
// =========================================================
require get_template_directory() . '/customizer.php';

// =========================================================
// Charger les fichiers CSS et JS du thème
// =========================================================
function expo_enqueue_assets() {
    $theme_uri = get_template_directory_uri();

    // --- CSS global du thème ---
    wp_enqueue_style('style-theme', get_stylesheet_uri());
    wp_enqueue_style('style-main', $theme_uri . '/CSS/main.css');
    wp_enqueue_style('style-header', $theme_uri . '/CSS/header.css');
    wp_enqueue_style('style-footer', $theme_uri . '/CSS/footer.css');

    // --- JS global ---
    wp_enqueue_script('menu-script', $theme_uri . '/menu.js', array('jquery'), null, true);
    wp_enqueue_script('projet-script', $theme_uri . '/projet.js', array('jquery'), null, true);
    wp_enqueue_script('accueil-js', $theme_uri . '/accueil.js', array('jquery'), null, true);

    // --- Passage des variables JS depuis WordPress ---
    wp_localize_script('accueil-js', 'themeVars', array(
        'themeUrl' => $theme_uri,
        'pageArcade' => site_url('/index.php/arcade/'),
        'pageJourTerre' => site_url('/index.php/graphismes/'),
        'pageFinissants' => site_url('/index.php/projet-des-finissants/')
    ));

    // --- CSS spécifique à la page d'accueil ---
    if (is_front_page()) wp_enqueue_style('style-accueil', $theme_uri . '/CSS/accueil.css');

    // --- CSS spécifique aux autres pages ---
    if (is_page_template('arcade.php') || is_page_template('ar.php')) wp_enqueue_style('style-arcade', $theme_uri . '/CSS/arcade.css');

    if (is_page_template('projetArcade.php')) wp_enqueue_style('style-projet-arcade', $theme_uri . '/CSS/projetArcade.css');

    if (file_exists(get_template_directory() . '/CSS/normalize.css')) wp_enqueue_style('style-normalize', $theme_uri . '/CSS/normalize.css');

    if (is_page_template('projets-des-finissants.php') || is_page_template('ar.php')) wp_enqueue_style('style-projet-finissant', $theme_uri . '/CSS/projet-finissant.css');

    if (is_page_template('graphismes.php')) wp_enqueue_style('style-graphismes', $theme_uri . '/CSS/graphismes.css');

    if (is_search()) {wp_enqueue_style('style-search', $theme_uri . '/CSS/search.css');}

    // Nouveau code (CORRIGÉ) :
    if (is_404() || is_page_template('ar.php')) {
        wp_enqueue_style('style-404', $theme_uri . '/CSS/404.css');
    }
    
    
}
add_action('wp_enqueue_scripts', 'expo_enqueue_assets');

// =========================================================
// Enregistrer le menu principal
// =========================================================
function expo_register_menus() {
    register_nav_menus(array('main-menu' => 'Menu principal'));
}
add_action('after_setup_theme', 'expo_register_menus');

// =========================================================
// Support pour les images mises en avant
// =========================================================
add_theme_support('post-thumbnails');
add_image_size('arcade-thumb', 400, 300, true);

// =========================================================
// Ajustement automatique du menu burger sur mobile
// =========================================================
function ajuster_menu_mobile() {
    ?>
    <script>
    document.addEventListener('DOMContentLoaded', () => {
        const menuPage = document.querySelector('.menu-page');
        if (!menuPage) return;
        function ajusterHauteur() {
            menuPage.style.height = window.innerHeight + 'px';
        }
        ajusterHauteur();
        window.addEventListener('resize', ajusterHauteur);
    });
    </script>
    <?php
}
add_action('wp_footer', 'ajuster_menu_mobile');

// =========================================================
// Recherche dans les projets et les étudiants associés
// =========================================================
function expo_search_simple($query) {
    if (!is_admin() && $query->is_main_query() && $query->is_search) {

        // On cible uniquement notre CPT projet
        if (isset($_GET['post_type']) && $_GET['post_type'] === 'projet') {
            $query->set('post_type', 'projet');

            // On garde la recherche WP normale sur le titre
            add_filter('the_posts', function($posts) use ($query) {
                $search = $query->get('s');

                // Filtrer les projets si le titre ne contient pas le terme de recherche
                // mais un étudiant associé contient le terme
                $filtered = [];
                foreach ($posts as $post) {
                    $etudiants = get_field('etudiants_associes', $post->ID);
                    $found = false;

                    if ($etudiants) {
                        foreach ($etudiants as $etu) {
                            $prenom = get_field('prenom', $etu->ID);
                            $nom = get_field('nom_etudiant', $etu->ID);
                            if (stripos("$prenom $nom", $search) !== false) {
                                $found = true;
                                break;
                            }
                        }
                    }

                    if ($found || stripos($post->post_title, $search) !== false) {
                        $filtered[] = $post;
                    }
                }

                return $filtered;
            });
        }
    }
}
add_action('pre_get_posts', 'expo_search_simple');

?>
