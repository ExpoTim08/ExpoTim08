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
    wp_enqueue_script('404-js', $theme_uri . '/404.js', array('jquery'), null, true);

    // --- Passage des variables JS depuis WordPress ---
    // wp_localize_script('accueil-js', 'themeVars', array(
    //     'themeUrl' => $theme_uri,
    //     'pageArcade' => site_url('/index.php/arcade/'),
    //     'pageJourTerre' => site_url('/index.php/graphisme/'),
    //     'pageFinissants' => site_url('/index.php/finissants/')
    // ));

    // --- Passage des variables JS depuis WordPress ---
    wp_localize_script('accueil-js', 'themeVars', array(
    'themeUrl' => $theme_uri,
    'pageArcade' => site_url('/index.php/arcade/'),
    'pageJourTerre' => site_url('/index.php/graphisme/'),
    'pageFinissants' => site_url('/index.php/finissants/'),
    'ajaxUrl' => admin_url('admin-ajax.php')
    ));

    wp_localize_script('404-js', 'themeVars', array(
    'themeUrl' => $theme_uri,
    'pageArcade' => site_url('/index.php/arcade/'),
    'pageJourTerre' => site_url('/index.php/graphisme/'),
    'pageFinissants' => site_url('/index.php/finissants/'),
    'ajaxUrl' => admin_url('admin-ajax.php')
    ));

    // --- CSS front-page ---
    if (is_front_page()) {
        wp_enqueue_style('style-intro', $theme_uri . '/CSS/intro.css');
        wp_enqueue_script('intro-js', $theme_uri . '/intro.js', array(), null, true);
    }

    if (is_page('accueil') || is_front_page()) {
        wp_enqueue_style('style-accueil', $theme_uri . '/CSS/accueil.css', array(), null);
    }

    // --- CSS normalize ---
    if (file_exists(get_template_directory() . '/CSS/normalize.css')) {
        wp_enqueue_style('style-normalize', $theme_uri . '/CSS/normalize.css');
    }

    // --- CSS pages spécifiques ---
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

    // --- Script tri.js pour AJAX ---
    wp_enqueue_script('tri-script', $theme_uri . '/tri.js', array('jquery'), null, true);
    wp_localize_script('tri-script', 'TriAjax', array(
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('tri_nonce')
    ));
}
add_action('wp_enqueue_scripts', 'expo_enqueue_assets');

// =========================================================
// Menu principal
// =========================================================
function expo_register_menus() {
    register_nav_menus(array('main-menu' => 'Menu principal'));
}
add_action('after_setup_theme', 'expo_register_menus');

// =========================================================
// Support images mises en avant
// =========================================================
add_theme_support('post-thumbnails');
add_image_size('arcade-thumb', 400, 300, true);

// =========================================================
// Ajustement menu burger mobile
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
// Normalisation chaînes pour recherche
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
// Support <title>
// =========================================================
function expo_theme_support() {
    add_theme_support('title-tag');
}
add_action('after_setup_theme', 'expo_theme_support');

// =========================================================
// ================= Gestionnaires AJAX ===================
// =========================================================

// --- Helper pour tri.js ---
function enqueue_tri_script() {
    wp_enqueue_script('tri-script', get_stylesheet_directory_uri() . '/tri.js', ['jquery'], null, true);
    wp_localize_script('tri-script', 'TriAjax', [
        'ajaxurl' => admin_url('admin-ajax.php'),
        'nonce'   => wp_create_nonce('tri_nonce')
    ]);
}
add_action('wp_enqueue_scripts', 'enqueue_tri_script');

// =========================================================
// Gestionnaire AJAX Arcade
// =========================================================
function handle_arcade_tri() {
    check_ajax_referer('tri_nonce', 'nonce');

    $tri = isset($_POST['tri']) ? sanitize_text_field($_POST['tri']) : 'random';
    $orderby = $tri === 'asc' ? 'title' : ($tri === 'desc' ? 'title' : 'rand');
    $order = $tri === 'desc' ? 'DESC' : 'ASC';

    $projets = new WP_Query([
        'post_type' => 'projet-arcade',
        'posts_per_page' => -1,
        'orderby' => $orderby,
        'order' => $order
    ]);

    if ($tri === 'random') {
        $posts = $projets->posts;
        shuffle($posts);
        $projets->posts = $posts;
    }

    ob_start();
    if ($projets->have_posts()):
        while ($projets->have_posts()): $projets->the_post();
            $nom = get_field('nom_du_projet');
            $desc = get_field('description');
            $img = get_field('image_du_projet');
            $short_desc = wp_trim_words(strip_tags($desc), 40, '...');
            ?>
            <article class="carte-projet-arcade">
                <?php if ($img): ?>
                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($nom); ?>">
                <?php endif; ?>
                <h2><?php echo esc_html($nom); ?></h2>
                <p><?php echo esc_html($short_desc); ?></p>
            </article>
            <?php
        endwhile;
        wp_reset_postdata();
    else:
        echo '<p>Aucun projet arcade pour le moment.</p>';
    endif;

    wp_send_json_success(ob_get_clean());
}
add_action('wp_ajax_arcade_tri', 'handle_arcade_tri');
add_action('wp_ajax_nopriv_arcade_tri', 'handle_arcade_tri');

// =========================================================
// Gestionnaire AJAX Graphisme
// =========================================================
function handle_graphisme_tri() {
    check_ajax_referer('tri_nonce', 'nonce');

    $tri = isset($_POST['tri']) ? sanitize_text_field($_POST['tri']) : 'random';
    $orderby = $tri === 'asc' ? 'title' : ($tri === 'desc' ? 'title' : 'rand');
    $order = $tri === 'desc' ? 'DESC' : 'ASC';

    $projets = new WP_Query([
        'post_type' => 'projet-graphisme',
        'posts_per_page' => -1,
        'orderby' => $orderby,
        'order' => $order
    ]);

    if ($tri === 'random') {
        $posts = $projets->posts;
        shuffle($posts);
        $projets->posts = $posts;
    }

    ob_start();
    if ($projets->have_posts()):
        while ($projets->have_posts()): $projets->the_post();
            $titre = get_the_title();
            $img = get_field('affiche');
            $desc = get_field('description');
            $short_desc = wp_trim_words(strip_tags($desc), 40, '...');
            ?>
            <article class="carte-projet-graphisme">
                <?php if ($img): ?>
                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($titre); ?>">
                <?php endif; ?>
                <h2><?php echo esc_html($titre); ?></h2>
                <p><?php echo esc_html($short_desc); ?></p>
            </article>
            <?php
        endwhile;
        wp_reset_postdata();
    else:
        echo '<p>Aucun projet graphisme pour le moment.</p>';
    endif;

    wp_send_json_success(ob_get_clean());
}
add_action('wp_ajax_graphisme_tri', 'handle_graphisme_tri');
add_action('wp_ajax_nopriv_graphisme_tri', 'handle_graphisme_tri');

// =========================================================
// Gestionnaire AJAX Finissants
// =========================================================
function handle_finissants_tri() {
    check_ajax_referer('tri_nonce', 'nonce');

    $tri = isset($_POST['tri']) ? sanitize_text_field($_POST['tri']) : 'random';
    $cat = isset($_POST['cat']) ? intval($_POST['cat']) : 0;

    $orderby = $tri === 'asc' ? 'title' : ($tri === 'desc' ? 'title' : 'rand');
    $order = $tri === 'desc' ? 'DESC' : 'ASC';

    $args = [
        'post_type' => 'projet-finissant',
        'posts_per_page' => -1,
        'orderby' => $orderby,
        'order' => $order
    ];
    if ($cat) $args['cat'] = $cat;

    $projets = new WP_Query($args);

    if ($tri === 'random') {
        $posts = $projets->posts;
        shuffle($posts);
        $projets->posts = $posts;
    }

    ob_start();
    if ($projets->have_posts()):
        while ($projets->have_posts()): $projets->the_post();
            $titre = get_field('nom_du_projet');
            $desc = get_field('description');
            $img = get_field('image');
            $short_desc = wp_trim_words(strip_tags($desc), 40, '...');
            ?>
            <article class="carte-projet-finissant">
                <?php if ($img): ?>
                <img src="<?php echo esc_url($img['url']); ?>" alt="<?php echo esc_attr($titre); ?>">
                <?php endif; ?>
                <h2><?php echo esc_html($titre); ?></h2>
                <p><?php echo esc_html($short_desc); ?></p>
            </article>
            <?php
        endwhile;
        wp_reset_postdata();
    else:
        echo '<p>Aucun projet finissants pour le moment.</p>';
    endif;

    wp_send_json_success(ob_get_clean());
}
add_action('wp_ajax_finissants_tri', 'handle_finissants_tri');
add_action('wp_ajax_nopriv_finissants_tri', 'handle_finissants_tri');

// =========================================================
// Gestionnaire AJAX Projets aléatoire
// =========================================================
// add_action('wp_ajax_refresh_projects', 'refresh_home_projects');
// add_action('wp_ajax_nopriv_refresh_projects', 'refresh_home_projects');

function refresh_home_projects() {

  // Helper to fetch 1 random post of a given post type
  function get_random_project($post_type, $acf_image_field, $acf_title_field = null) {
      $query = new WP_Query([
          'post_type'      => $post_type,
          'posts_per_page' => 1,
          'orderby'        => 'rand'
      ]);
      if ($query->have_posts()) {
          $query->the_post();
          $img = get_field($acf_image_field);
          $title = $acf_title_field ? get_field($acf_title_field) : get_the_title();
          if ($img) {
              $item = [
                  'id'    => get_the_ID(),
                  'title' => $title,
                  'url'   => $img['url']
              ];
              wp_reset_postdata();
              return $item;
          }
      }
      wp_reset_postdata();
      return null;
  }

  $arcadeItem = get_random_project('projet-arcade', 'image_du_projet', 'nom_du_projet');
  $graphismeItem = get_random_project('projet-graphisme', 'affiche');
  $finissantItem = get_random_project('projet-finissant', 'image', 'nom_du_projet');

  if (!$arcadeItem || !$graphismeItem || !$finissantItem) {
      wp_send_json_error('Not enough projects');
  }

  wp_send_json_success([
      'arcade' => $arcadeItem,
      'graphisme' => $graphismeItem,
      'finissant' => $finissantItem
  ]);
}
add_action('wp_ajax_refresh_projects', 'refresh_home_projects');
add_action('wp_ajax_nopriv_refresh_projects', 'refresh_home_projects');



