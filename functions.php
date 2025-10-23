<?php
// =========================================================
// Charger le fichier customizer.php (options du thème)
// =========================================================
require get_template_directory() . '/customizer.php';


// =========================================================
// Charger les fichiers CSS et JS du thème
// =========================================================
function expo_enqueue_assets() {

    // --- CSS global du thème ---
    wp_enqueue_style('style-theme', get_stylesheet_uri()); // style.css (obligatoire dans WordPress)
    wp_enqueue_style('style-main', get_template_directory_uri() . '/CSS/main.css'); // CSS global
    wp_enqueue_style('style-header', get_template_directory_uri() . '/CSS/header.css'); // menu burger
    wp_enqueue_style('style-footer', get_template_directory_uri() . '/CSS/footer.css'); // footer

    // --- JS global (menu burger) ---
    wp_enqueue_script('menu-script', get_template_directory_uri() . '/menu.js', array(), false, true);

    // --- CSS spécifique à la page d'accueil ---
    if (is_front_page()){
        wp_enqueue_style('style-accueil', get_template_directory_uri() . '/CSS/accueil.css');
    }

    // --- CSS spécifique à la page Arcade ---
    // S’applique seulement si la page utilise le modèle arcade.php ou ar.php
    if (is_page_template('arcade.php') || is_page_template('ar.php')) {
        wp_enqueue_style('style-arcade', get_template_directory_uri() . '/CSS/arcade.css');
    }
}
add_action('wp_enqueue_scripts', 'expo_enqueue_assets');


// =========================================================
// Enregistrer le menu principal
// =========================================================
register_nav_menus(array(
    'main-menu' => 'Menu principal',
));
