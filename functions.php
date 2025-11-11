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
    wp_enqueue_style('style-theme', get_stylesheet_uri()); // style.css
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
        'pageArcade' => site_url('/arcade/'),
        'pageJourTerre' => site_url('/jour-de-la-terre/'),
        'pageFinissants' => site_url('/projets-des-finissants/')
    ));

    // --- CSS spécifique à la page d'accueil ---
    if (is_front_page()) {
        wp_enqueue_style('style-accueil', $theme_uri . '/CSS/accueil.css');
    }

    // --- CSS spécifique à la page Arcade ---
    if (is_page_template('arcade.php') || is_page_template('ar.php')) {
        wp_enqueue_style('style-arcade', $theme_uri . '/CSS/arcade.css');
    }

    // --- CSS spécifique à la page Projet Arcade ---
    if (is_page_template('projetArcade.php')) {
        wp_enqueue_style('style-projet-arcade', $theme_uri . '/CSS/projetArcade.css');
    }

    // --- normalize.css ---
    if (file_exists(get_template_directory() . '/CSS/normalize.css')) {
        wp_enqueue_style('style-normalize', $theme_uri . '/CSS/normalize.css');
    }

    // --- CSS spécifique à la page Projet finissants ---
    if (is_page_template('projets-des-finissants.php') || is_page_template('ar.php')) {
        wp_enqueue_style('style-projet-finissant', $theme_uri . '/CSS/projet-finissant.css');
    }

    // --- CSS spécifique à la page Jour de la terre ---
    if (is_page_template('jour-terre.php') || is_page_template('ar.php')) {
        wp_enqueue_style('style-jour-terre', $theme_uri . '/CSS/jour-terre.css');
    }

}
add_action('wp_enqueue_scripts', 'expo_enqueue_assets');


// =========================================================
// Enregistrer le menu principal
// =========================================================
function expo_register_menus() {
    register_nav_menus(array(
        'main-menu' => 'Menu principal',
    ));
}
add_action('after_setup_theme', 'expo_register_menus');


// =========================================================
// Support pour les images mises en avant
// =========================================================
add_theme_support('post-thumbnails');
add_image_size('arcade-thumb', 400, 300, true); // pour les projets arcade


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
            const hauteur = window.innerHeight;
            menuPage.style.height = hauteur + 'px';
        }

        ajusterHauteur();
        window.addEventListener('resize', ajusterHauteur);
    });
    </script>
    <?php
}
add_action('wp_footer', 'ajuster_menu_mobile');
?>
