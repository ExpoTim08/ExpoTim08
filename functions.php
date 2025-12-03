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
        'pageFinissants' => site_url('/index.php/finissants/')
    ));

    // --- CSS spécifique à la front-page (Intro) ---
    if (is_front_page()) {
        wp_enqueue_style('style-intro', $theme_uri . '/CSS/intro.css');
        // intro.js dans le thème à la racine, pas dans un dossier
        wp_enqueue_script('intro-js', $theme_uri . '/intro.js', array(), null, true);
    }

    // --- CSS spécifique à la page Accueil ---
    // Chargé si la page est 'accueil' ou si c'est la front-page (où on affiche Accueil derrière l'intro)
    if (is_page('accueil') || is_front_page()) {
        wp_enqueue_style('style-accueil', $theme_uri . '/CSS/accueil.css', array(), null);
    }

    // --- CSS normalize ---
    if (file_exists(get_template_directory() . '/CSS/normalize.css')) {
        wp_enqueue_style('style-normalize', $theme_uri . '/CSS/normalize.css');
    }

    // --- CSS spécifiques aux autres pages (finissant, arcade, graphisme, etc.) ---
    if (is_page_template('finissants.php') || is_page_template('ar.php')) {
        wp_enqueue_style('style-finissant', $theme_uri . '/CSS/finissant.css');
    }
    if (is_page_template('projetFinissant.php')) {
        wp_enqueue_style('style-projet-finissant', $theme_uri . '/CSS/projetFinissant.css');
    }
    if (is_page_template('arcade.php') || is_page_template('ar.php')) {
        wp_enqueue_style('style-arcade', $theme_uri . '/CSS/arcade.css');
    }
    if (is_page_template('projetArcade.php')) {
        wp_enqueue_style('style-projet-arcade', $theme_uri . '/CSS/projetArcade.css');
    }
    if (is_page_template('graphisme.php')) {
        wp_enqueue_style('style-graphisme', $theme_uri . '/CSS/graphisme.css');
    }
    if (is_page_template('projetGraphisme.php')) {
        wp_enqueue_style('style-projet-graphisme', $theme_uri . '/CSS/projetGraphisme.css');
    }
    if (is_search()) wp_enqueue_style('style-search', $theme_uri . '/CSS/search.css');
    if (is_page_template('contact.php') || is_page_template('ar.php')) wp_enqueue_style('style-contact', $theme_uri . '/CSS/contact.css');
    if (is_404() || is_page_template('ar.php')) wp_enqueue_style('style-404', $theme_uri . '/CSS/404.css');

    // --- Script tri.js spécifique à l'arcade ---
    wp_enqueue_script('projets-arcade-js', $theme_uri . '/tri.js', array(), false, true);
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
// Normalisation des chaînes pour la recherche
// =========================================================
if (!function_exists('normalize_string')) {
    function normalize_string($str) {
        if (is_array($str)) {
            if (isset($str[0]) && is_string($str[0])) $str = $str[0];
            else return '';
        }
        if (!$str || !is_string($str)) return '';

        $str = mb_strtolower($str, 'UTF-8');
        $accents = [
            'à'=>'a','â'=>'a','ä'=>'a','á'=>'a','ã'=>'a','å'=>'a',
            'ç'=>'c','è'=>'e','é'=>'e','ê'=>'e','ë'=>'e',
            'ì'=>'i','í'=>'i','î'=>'i','ï'=>'i','ñ'=>'n',
            'ò'=>'o','ó'=>'o','ô'=>'o','ö'=>'o','õ'=>'o',
            'ù'=>'u','ú'=>'u','û'=>'u','ü'=>'u','ý'=>'y','ÿ'=>'y',
            'œ'=>'oe','æ'=>'ae','ß'=>'ss'
        ];
        $str = strtr($str, $accents);
        $str = preg_replace('/[^a-z0-9 ]+/u', '', $str);
        $str = preg_replace('/\s+/', ' ', $str);
        return trim($str);
    }
}

// =========================================================
// Support pour le <title>
function expo_theme_support() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'expo_theme_support');

// =========================================================
// AJAX Handlers pour le tri asynchrone des projets
// =========================================================

/**
 * Fonction helper pour afficher les cartes projet arcade
 */

function enqueue_tri_script() {
    wp_enqueue_script('tri-script', get_stylesheet_directory_uri() . '/js/tri.js', [], false, true);

    wp_localize_script('tri-script', 'TriAjax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('tri_nonce')
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_tri_script');

function render_arcade_projects($tri = 'random') {
    $orderby = 'rand';
    $order   = 'ASC';
    
    switch ($tri) {
        case 'asc':
            $orderby = 'title';
            $order   = 'ASC';
            break;
        case 'desc':
            $orderby = 'title';
            $order   = 'DESC';
            break;
        default:
            $orderby = 'rand';
            $order   = 'ASC';
            break;
    }
    
   $projets = new WP_Query([
    'post_type'      => 'projet-arcade',
    'posts_per_page' => -1,
    'orderby'        => $orderby,
    'order'          => $order
]);

// 🔥 Mélange manuel pour garantir un vrai ordre aléatoire
if ($tri === 'random') {
    $posts = $projets->posts;
    shuffle($posts);
    $projets->posts = $posts;
}

    
    if ($projets->have_posts()) :
        while ($projets->have_posts()) : $projets->the_post();
            $nom         = get_field('nom_du_projet');
            $description = get_field('description');
            $image       = get_field('image_du_projet');
            $short_desc = wp_trim_words( wp_strip_all_tags( $description ), 40, '...' );
            
            $filtre = get_field('projet-arcade');
            if (!$filtre) {
                $filtre = 'none';
            }
            ?>
    <!--================== Carte Projet Desktop ======================-->
    <article class="carte-projet-arcade--desktop"
         data-nom="<?php echo esc_attr($nom); ?>"
         data-filtre="<?php echo esc_attr($filtre); ?>">
      <?php if ($image): ?>
        <img class="image-projet-arcade" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($nom); ?>">
      <?php endif; ?>

      <div class="conteneur-carte-bas">
        <h2 class="titre-projet-arcade"><?php echo esc_html($nom); ?></h2>
        <p class="carte-arcade-titre-description">Description</p>
        <p class="description-projet"><?php echo esc_html($short_desc); ?></p>

        <button class="button-projet-arcade"
          onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projet-arcade')))); ?>'">
          >>
        </button>
      </div>
    </article>

    <!--================== Carte Projet Mobile =================-->
    <article class="carte-projet-arcade">
      <div class="conteneur-carte-haut">
        <h2 class="titre-projet-arcade"><?php echo esc_html($nom); ?></h2>
        <button class="button-projet-arcade"
          onclick="window.location.href='<?php echo esc_url(add_query_arg('projet_id', get_the_ID(), get_permalink(get_page_by_path('projet-arcade')))); ?>'">
          >>
        </button>
      </div>
        
      <?php if ($image): ?>
      <img class="image-projet-arcade" src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($nom); ?>">
      
      <span class="conteneur-button-dropdown-arcade">
        <p class="carte-arcade-titre-description">Description</p>
        <button
          class="button-dropdown-arcade"
          aria-expanded="false"
          aria-controls="<?php echo 'dropdown-'.get_the_ID(); ?>">
          +
        </button>
      </span>

      <div id="<?php echo 'dropdown-'.get_the_ID(); ?>" class="dropdown-carte-arcade" aria-hidden="true">
        <p class="description-projet"><?php echo esc_html( wp_trim_words( wp_strip_all_tags( $description ), 40, '...' ) ); ?></p>
      </div>
      </article>
    <?php endif; ?>

    <?php
        endwhile;
        wp_reset_postdata();
    else:
        echo '<p>Aucun projet d\'arcade pour le moment.</p>';
    endif;
}

/**
 * Gestionnaire AJAX pour le tri arcade
 */
function handle_arcade_tri() {
    check_ajax_referer('tri_nonce', 'nonce');

    $tri = isset($_POST['tri']) ? sanitize_text_field($_POST['tri']) : 'random';

    ob_start();
    render_arcade_projects($tri);
    $html = ob_get_clean();

    wp_send_json_success($html);
}
add_action('wp_ajax_arcade_tri', 'handle_arcade_tri');
add_action('wp_ajax_nopriv_arcade_tri', 'handle_arcade_tri');

// Note: Les handlers pour graphisme et finissants peuvent être ajoutés de la même façon
// si ces pages utilisent aussi le tri asynchrone
