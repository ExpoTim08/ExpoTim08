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
        'pageJourTerre' => site_url('/index.php/graphisme/'),
        'pageFinissants' => site_url('/index.php/projets-finissants/')
    ));

    // --- CSS spécifique à la page d'accueil ---
    if (is_front_page()) wp_enqueue_style('style-accueil', $theme_uri . '/CSS/accueil.css');

    // --- CSS spécifique aux autres pages ---
    if (is_page_template('arcade.php') || is_page_template('ar.php')) wp_enqueue_style('style-arcade', $theme_uri . '/CSS/arcade.css');
    if (is_page_template('projetArcade.php')) wp_enqueue_style('style-projet-arcade', $theme_uri . '/CSS/projetArcade.css');
    if (file_exists(get_template_directory() . '/CSS/normalize.css')) wp_enqueue_style('style-normalize', $theme_uri . '/CSS/normalize.css');
    if (is_page_template('projets-des-finissants.php') || is_page_template('ar.php')) wp_enqueue_style('style-projet-finissant', $theme_uri . '/CSS/projet-finissant.css');
    if (is_page_template('graphisme.php')) wp_enqueue_style('style-graphisme', $theme_uri . '/CSS/graphisme.css');

    // --- CSS spécifique à un projet individuel de graphisme ---
    if (is_page_template('projetGraphisme.php')) wp_enqueue_style('style-projet-graphisme', $theme_uri . '/CSS/projetGraphisme.css');

    if (is_search()) wp_enqueue_style('style-search', $theme_uri . '/CSS/search.css');
    if (is_page_template('contact.php') || is_page_template('ar.php')) wp_enqueue_style('style-contact', $theme_uri . '/CSS/contact.css');
    if (is_404() || is_page_template('ar.php')) wp_enqueue_style('style-404', $theme_uri . '/CSS/404.css');
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
// Normalisation des chaînes pour la recherche (accents, minuscules, espaces)
// =========================================================
if (!function_exists('normalize_string')) {
    function normalize_string($str) {
        if (!$str) return '';
        $str = mb_strtolower($str, 'UTF-8'); // minuscules
        $accents = [
            'à'=>'a','â'=>'a','ä'=>'a','á'=>'a','ã'=>'a','å'=>'a',
            'ç'=>'c',
            'è'=>'e','é'=>'e','ê'=>'e','ë'=>'e',
            'ì'=>'i','í'=>'i','î'=>'i','ï'=>'i',
            'ñ'=>'n',
            'ò'=>'o','ó'=>'o','ô'=>'o','ö'=>'o','õ'=>'o',
            'ù'=>'u','ú'=>'u','û'=>'u','ü'=>'u',
            'ý'=>'y','ÿ'=>'y',
            'œ'=>'oe','æ'=>'ae',
            'ß'=>'ss'
        ];

        // Remplacement des accents
        $str = strtr($str, $accents);

        // Enlever tout caractère non alphanumérique (sauf espace)
        $str = preg_replace('/[^a-z0-9 ]+/u', '', $str);

        // Espaces multiples → un seul
        $str = preg_replace('/\s+/', ' ', $str);

        return trim($str);
    }
}

function random_image_from($subfolder) {
    $directory = get_template_directory() . "/Images/$subfolder/";
    $webpath   = get_template_directory_uri() . "/Images/$subfolder/";

    // Find any JPG/PNG/SVG/etc
    $images = glob($directory . "*.{jpg,jpeg,png,svg,webp}", GLOB_BRACE);

    if (!$images) return ""; // no image found

    // Pick one random file
    $random_file = basename($images[array_rand($images)]);

    return $webpath . $random_file;
}
?>
