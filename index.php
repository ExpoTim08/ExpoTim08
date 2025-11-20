<?php
get_header();
?>

<main>
    <?php
    if ( have_posts() ) :
        while ( have_posts() ) : the_post();
            the_content();
        endwhile;
    else :
        // Si WordPress décide que c’est une 404, il va automatiquement charger 404.php
        get_template_part( '404' );
    endif;
    ?>
</main>

<?php
get_footer();
