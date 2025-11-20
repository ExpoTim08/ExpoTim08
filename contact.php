<?php
/*
Template Name: Contact
*/
?>

<body>
    <?php get_header(); //appelle le header ?>

    <div class="forumContact">
        <form>
            <div class="messagePageContact">
                <h1>Contactez un des membres de</h1>
                <img class="footer-logo-img" src="<?php echo get_template_directory_uri(); ?>/Images/Texte.png" alt="Logo de l'expo TIM">
            </div>
        
            <input type="text" class="prenom" placeholder="Votre prénom">
            <input type="text" class="nom" placeholder="Votre nom">
            <input type="text" class="numeroMobile" placeholder="Votre mobile">
            <input type="email" class="emailContact" placeholder="Qui voudriez-vous rejoindre?">
            <h4>Votre message.</h4>
            <textarea required></textarea>
            <input type="submit" value="Envoyer" id="bouton">
        </form>
    </div>
    
    <?php get_footer(); //appelle le footer ?>
</body>
</html>