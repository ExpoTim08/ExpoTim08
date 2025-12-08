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

    <section class="contactComplet">
        <div class="messagePageContact">
            <h1>Contactez les gens en charge de</h1>
            <img class="footer-logo-img" src="<?php echo get_template_directory_uri(); ?>/Images/Texte.png" alt="Logo de l'expo TIM">
        </div>

        <div class="conteneurProfils">
            <div class="profilCaroline">
                <span class="photo">
                    <img class="img-personne" src="<?php echo get_template_directory_uri(); ?>/Images/Caroline.png" alt="Photo Caroline Martin">
                </span>
                <h3 class="nom">Caroline Martin</h3>
                <span class="conteneurBouton">
                    <input type="button" onclick="window.open('https://teams.microsoft.com/v2/');" target="blank" value="Rejoindre">
                </span>
            </div>

            <div class="profilStephanie">
                <span class="photo">
                    <img class="img-personne" src="<?php echo get_template_directory_uri(); ?>/Images/Stéphanie.png" alt="Photo Stéphanie Pouliot">
                </span>
                <h3 class="nom">Stéphanie Pouliot</h3>
                <span class="conteneurBouton">
                    <input type="button" onclick="window.open('https://teams.microsoft.com/v2/');" target="blank" value="Rejoindre">
                </span>
            </div>

            <div class="profilManon">
                <span class="photo">
                    <img class="img-personne" src="<?php echo get_template_directory_uri(); ?>/Images/Manon.png" alt="Photo Manon Bertrand">
                </span>
                <h3 class="nom">Manon Bertrand</h3>
                <span class="conteneurBouton">
                    <input type="button" onclick="window.open('https://teams.microsoft.com/v2/');" target="blank" value="Rejoindre">
                </span>
            </div>
        </div>
        

    </section>

    <!--<div class="forumContact">
        <form action="https://formsubmit.co/alexis.david.111@gmail.com" method="POST">

             Champ prénom
            <label for="prenom" class="screen-reader-text">Votre prénom</label>
            <input type="text" id="prenom" class="prenom" placeholder="Votre prénom" required>

             Champ nom 
            <label for="nom" class="screen-reader-text">Votre nom</label>
            <input type="text" id="nom" class="nom" placeholder="Votre nom" required>

             Champ mobile 
            <label for="emailUser" class="screen-reader-text">Votre mobile</label>
            <input type="email" id="emailUser" class="emailUser" placeholder="Email" required>

             Champ email 
            <label for="emailContact" class="screen-reader-text">Personne à joindre</label>
            <input type="email" id="emailContact" class="emailContact" placeholder="Qui voudriez-vous rejoindre?" required>

            <h4>Votre message.</h4>

             Message 
            <label for="message" class="screen-reader-text">Votre message</label>
            <textarea id="message" required></textarea>

            <input type="submit" value="Envoyer" id="bouton">
        </form>
    </div> --!>
    
    <?php get_footer(); //appelle le footer ?>
</body>
</html>
