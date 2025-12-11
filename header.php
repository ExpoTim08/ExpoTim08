<?php
/* 
 * Header
 */
?>

<?php 

/*Customizer*/
$logo = get_theme_mod('expoTim_logo');

?>

<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta name="format-detection" content="telephone=no">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="header-margin"></div>

<div class="header-container">
  <header class="site-header">
  <h1 class="logo">
  <a href="<?php echo get_permalink( get_page_by_path('accueil') ); ?>">
    <img class="header-logo-img" src="<?php echo esc_url($logo); ?>" alt="Logo de l'expo TIM">
  </a>
</h1>

    <!-- menu burger -->
    <div class="menu-burger">
      <span></span><span></span><span></span>
    </div>
  </header>

  <!-- Menu principal -->
  <div class="menu-page">
    <div class="menu-content">

      <!-- Barre de recherche mobile -->
      <form role="search" method="get" class="search-form menu-search-mobile" action="<?php echo home_url('/'); ?>">
        <label for="search-mobile" class="screen-reader-text">Recherche</label>
        <input type="hidden" name="post_type" value="projet">
        <input type="search" id="search-mobile" class="search-field" placeholder="Recherche projet ou étudiant..." value="<?php echo get_search_query(); ?>" name="s">
        <button type="submit" aria-label="Rechercher">
          <svg xmlns="http://www.w3.org/2000/svg" fill="beige" width="15" height="15" viewBox="0 0 16 16">
            <path d="M13.438,15.563l-2.665-2.664 C9.684,13.598,8.388,14.002,7,14.002c-3.865,0-7-3.135-7-7c0-3.864,3.135-7,7-7c3.864,0,7,3.136,7,7 c0,1.391-0.407,2.687-1.105,3.776l2.665,2.664c0.585,0.585,0.585,1.536,0,2.121C14.974,16.148,14.024,16.148,13.438,15.563z M12,7.002c0-2.759-2.241-5-5-5c-2.76,0-5,2.241-5,5c0,2.76,2.24,5,5,5C9.759,12.002,12,9.762,12,7.002z"></path>
          </svg>
        </button>
      </form>

      <!-- Menu dynamique -->
      <?php
        wp_nav_menu(array(
          'theme_location' => 'main-menu',
          'container' => false,
          'menu_class' => 'menu',
        ));
      ?>
    </div>
  </div>

  <!-- Barre de recherche desktop -->
  <div class="menu-search-desktop">
    <form role="search" method="get" class="search-form" action="<?php echo home_url('/'); ?>">
      <label for="search-desktop" class="screen-reader-text">Recherche</label>
      <input type="hidden" name="post_type" value="projet">
      <input type="search" id="search-desktop" class="search-field" placeholder="Rechercher" value="<?php echo get_search_query(); ?>" name="s">
      <button type="submit" aria-label="Rechercher">
          <svg xmlns="http://www.w3.org/2000/svg" fill="beige" width="15" height="15" viewBox="0 0 16 16">
            <path d="M13.438,15.563l-2.665-2.664 C9.684,13.598,8.388,14.002,7,14.002c-3.865,0-7-3.135-7-7c0-3.864,3.135-7,7-7c3.864,0,7,3.136,7,7 c0,1.391-0.407,2.687-1.105,3.776l2.665,2.664c0.585,0.585,0.585,1.536,0,2.121C14.974,16.148,14.024,16.148,13.438,15.563z M12,7.002c0-2.759-2.241-5-5-5c-2.76,0-5,2.241-5,5c0,2.76,2.24,5,5,5C9.759,12.002,12,9.762,12,7.002z"></path>
          </svg>
        </button>
    </form>
  </div>
</div>
