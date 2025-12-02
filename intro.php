<?php
/*
Template Name: Page intro
*/

// Inclure le header global
get_header();

// Charger le CSS spécifique à l’intro
function enqueue_intro_style() {
    wp_enqueue_style('style-intro', get_stylesheet_directory_uri() . '/CSS/intro.css');
}
add_action('wp_enqueue_scripts', 'enqueue_intro_style');
?>

<div class="intro-container" id="intro">
    ExpoTim
</div>

<div class="rideau gauche"></div>
<div class="rideau droite"></div>

<script>
    // Animation + redirection après 5 secondes
    setTimeout(() => {
        document.body.classList.add("open");

        setTimeout(() => {
            // Redirection vers la page "Accueil"
            window.location.href = "<?php echo esc_url(get_permalink(get_page_by_path('accueil'))); ?>";
        }, 1000); // attend la fin de l’animation
    }, 5000);
</script>

<?php get_footer(); ?>
