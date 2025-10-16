<?php
// Charger les fichiers CSS globaux et le menu burger
function expo_enqueue_assets() {
    // CSS principal du thème
    wp_enqueue_style('style-theme', get_stylesheet_uri());

    // CSS main.css global
    wp_enqueue_style('style-main', get_template_directory_uri() . '/CSS/main.css');

    // CSS header.css (menu burger)
    wp_enqueue_style('style-header', get_template_directory_uri() . '/CSS/header.css');

    // Script du menu burger
    wp_enqueue_script('menu-script', get_template_directory_uri() . '/menu.js', array(), false, true);
}
add_action('wp_enqueue_scripts', 'expo_enqueue_assets');

// Charger un CSS spécifique à la page arcade
function charger_styles_arcade() {
    if (is_page_template('arcade.php')) {
        wp_enqueue_style('style-arcade', get_template_directory_uri() . '/CSS/arcade.css');
    }
}
add_action('wp_enqueue_scripts', 'charger_styles_arcade');

// Enregistrer le menu principal
register_nav_menus(array(
    'main-menu' => 'Menu principal',
));
