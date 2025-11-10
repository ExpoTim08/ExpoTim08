<?php
/*
Template Name: Arcade
*/
require("global.php");
?>
<body <?php body_class(); ?>>
    <h1>Contact</h1>
    <?php get_footer(); //appelle le footer ?>

    <!-- Scripts JS -->
    <script>const themeUrl = "<?php echo get_template_directory_uri(); ?>";</script>
    <script src="<?php echo get_template_directory_uri(); ?>/menu.js"></script>
    <?php get_footer(); ?>
</body>
</html>