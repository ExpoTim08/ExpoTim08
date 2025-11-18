<?php
/* 
 * Header
 */
?>
<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
  <meta charset="<?php bloginfo('charset'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>

<div class="header-margin">
  <!-- Espace en haut de la page pour mobile -->
</div>

<div class="header-container">
  <header class="site-header">
    <h1 class="logo">
      <a href="<?php echo home_url(); ?>"><?php bloginfo('name'); ?></a>
    </h1>

    <!-- menu burger -->
    <div class="menu-burger">
      <span></span>
      <span></span>
      <span></span>
    </div>
  </header>

  <!-- Menu principal -->
  <div class="menu-page">
    <div class="menu-content">

      <!-- Barre de recherche mobile -->
      <form role="search" method="get" class="search-form menu-search-mobile" action="<?php echo home_url('/'); ?>">
    <input type="hidden" name="post_type" value="projet">
    <input type="search" class="search-field" placeholder="Recherche projet ou étudiant..." value="<?php echo get_search_query(); ?>" name="s">
    <button type="submit">Rechercher</button>
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
        <input type="hidden" name="post_type" value="projet">
        <input type="search" class="search-field" placeholder="Rechercher" value="<?php echo get_search_query(); ?>" name="s">
        <button type="submit"></button>
    </form>
  </div>
</div>
