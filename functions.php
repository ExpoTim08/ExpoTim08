<?php 
//permet de charger un fichier css pour toute les pages
function charger_styles_globaux() {
    //charger le fichier css du theme
    wp_enqueue_style('style-theme', get_stylesheet_uri());

    //charger le fichier main.css
    wp_enqueue_style('style-main', get_template_directory_uri() . '/CSS/main.css');
}
add_action('wp_enqueue_scripts', 'charger_styles_globaux');

//charge le css pour la page arcade
function charger_styles_arcade() {
    if (is_page_template('arcade.php')) {
        wp_enqueue_style('style-arcade', get_template_directory_uri() . '/CSS/arcade.css');
    }
}
add_action('wp_enqueue_scripts', 'charger_styles_arcade');

 ?>

