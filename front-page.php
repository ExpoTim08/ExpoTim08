<?php
/*
Template Name: Front Page
*/
get_header();
?>

<!-- Contenu de la page Accueil chargé directement -->
<div id="accueil-content">
    <div>
    <?php
    // Inclure la page d'accueil complète (accueil.php)
    include(get_template_directory() . '/accueil.php');
    ?>
    </div>
</div>

<div class="bordure-top"></div>
<div class="bordure-bottom"></div>
<div class="bordure-left"></div>
<div class="bordure-right"></div>


<!-- Rideaux -->
<!--<div class="rideau gauche"></div>
<div class="rideau droite"></div>-->
<div class="intro-gradient-bg">
    <div class="intro-bg"></div>
    <span class="couleur-blob-1"></span>
    <span class="couleur-blob-2"></span>
    <span class="couleur-blob-3"></span>
</div>

<div></div>
<!-- Texte Intro -->
<div class="intro-text">
    <p></p>

    <!--<p>Bievenue à</p>
    <p>l'ExpoTim</p>
    <p>2025</p>-->
</div>
    

<button class="intro-btn">
    Explorer
</button>

<?php get_footer(); ?>
