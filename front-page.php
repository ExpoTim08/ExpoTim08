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
    

<button class="intro-btn neon-pulse">
    <span>Explorer le site</span>
    <svg id="intro-arrow" fill="var(--font-color)" height="10px" width="10px" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512.005 512.005" xml:space="preserve"><g id="SVGRepo_bgCarrier" stroke-width="0"></g><g id="SVGRepo_tracerCarrier" stroke-linecap="round" stroke-linejoin="round"></g><g id="SVGRepo_iconCarrier"> <g> <g> <path d="M388.418,240.923L153.751,6.256c-8.341-8.341-21.824-8.341-30.165,0s-8.341,21.824,0,30.165L343.17,256.005 L123.586,475.589c-8.341,8.341-8.341,21.824,0,30.165c4.16,4.16,9.621,6.251,15.083,6.251c5.461,0,10.923-2.091,15.083-6.251 l234.667-234.667C396.759,262.747,396.759,249.264,388.418,240.923z"></path> </g> </g> </g></svg>
</button>

<?php get_footer(); ?>
