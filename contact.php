<?php
/*
Template Name: Contact
*/
require("global.php");
?>

<?php get_header(); //appelle le header ?>
<body>
    

    <div class="pattern-background">
    <div class="border gauche"></div>
    <div class="border droite"></div>

    <section class="contact-section">
        <h1 class="titre-contact" aria-label="contact">
            <span class="titre-contact-layer titre-contact-base">CONTACT</span>
            <span class="titre-contact-layer titre-contact-layer--1">CONTACT</span>
            <span class="titre-contact-layer titre-contact-layer--2">CONTACT</span>
            <span class="titre-contact-layer titre-contact-layer--3">CONTACT</span>
        </h1>
    </section>

    <div class="forumContact">
        <form action="https://formsubmit.co/alexis.david.111@gmail.com" method="POST">

            <div class="messagePageContact">
                <h1>Contactez les gens en charge de</h1>
                <img class="footer-logo-img" src="<?php echo get_template_directory_uri(); ?>/Images/Texte.png" alt="Logo de l'expo TIM">
            </div>

            <!-- Champ prénom -->
            <label for="prenom" class="screen-reader-text">Votre prénom</label>
            <input type="text" id="prenom" class="prenom" placeholder="Votre prénom" required>

            <!-- Champ nom -->
            <label for="nom" class="screen-reader-text">Votre nom</label>
            <input type="text" id="nom" class="nom" placeholder="Votre nom" required>

            <!-- Champ mobile -->
            <label for="emailUser" class="screen-reader-text">Votre mobile</label>
            <input type="email" id="emailUser" class="emailUser" placeholder="Email" required>

            <!-- Champ email -->
            <label for="emailContact" class="screen-reader-text">Personne à joindre</label>
            <input type="email" id="emailContact" class="emailContact" placeholder="Qui voudriez-vous rejoindre?" required>

            <h4>Votre message.</h4>

            <!-- Message -->
            <label for="message" class="screen-reader-text">Votre message</label>
            <textarea id="message" required></textarea>

            <input type="submit" value="Envoyer" id="bouton">
        </form>
    </div>

    <?php get_footer(); //appelle le footer ?>
</body>
</html>
