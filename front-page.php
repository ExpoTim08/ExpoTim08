<?php
/*
Template Name: Front Page
*/
get_header();
?>

<!-- Contenu de la page Accueil chargé directement -->
<div id="accueil-content">
    <?php
    // Inclure la page d'accueil complète (accueil.php)
    include(get_template_directory() . '/accueil.php');
    ?>
</div>

<!-- Rideaux -->
<div class="rideau gauche"></div>
<div class="rideau droite"></div>

<!-- Texte Intro -->
<div class="intro-text">ExpoTim</div>

<?php get_footer(); ?>
