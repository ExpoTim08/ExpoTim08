<?php
/*
Template Name: Contact
*/

?>

<body>
    <?php get_header(); //appelle le header ?>

    <div class="forumContact">
        <h1>Contactez un des membres de TimVision</h1>
        <input type="text" class="prenom" placeholder="Votre prénom">
        <input type="text" class="nom" placeholder="Votre nom">
        <input type="email" class="emailContact" placeholder="Qui voudriez-vous rejoindre?">
        <input type="text" class="numeroMobile" placeholder="Votre mobile">
        <textarea required></textarea>
        <input type="submit" value="send" id="bouton">
        <span class="message"></span>
    </div>
    
    <?php get_footer(); //appelle le footer ?>
</body>
</html>