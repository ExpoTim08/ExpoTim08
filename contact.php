<?php
/*
Template Name: Contact
*/
require("global.php");
?>

<?php get_header(); ?>
<body>
    <div class="pattern-background">
        <div class="border gauche"></div>
        <div class="border droite"></div>

        <!-- ==================== Section Titre Contact ==================== -->
        <section class="contact-section">
            <h1 class="titre-contact" aria-label="contact">
                <span class="titre-contact-layer titre-contact-base">CONTACT</span>
                <span class="titre-contact-layer titre-contact-layer--1">CONTACT</span>
                <span class="titre-contact-layer titre-contact-layer--2">CONTACT</span>
                <span class="titre-contact-layer titre-contact-layer--3">CONTACT</span>
            </h1>
        </section>

        <!-- ==================== Section Formulaire de Contact ==================== -->
        <?php
        // Expéditeur configuré dans WP Mail SMTP
        $from_email = "contacttimvisionexpo@gmail.com";
        $from_name  = "Équipe TIM Vision Expo";

        // Destinataires depuis le Customizer
        $allowed_emails = array_filter([
            get_theme_mod('expoTim_contact_dest_email_1'),
            get_theme_mod('expoTim_contact_dest_email_2'),
            get_theme_mod('expoTim_contact_dest_email_3'),
            get_theme_mod('expoTim_contact_dest_email_4'),
            get_theme_mod('expoTim_contact_dest_email_5'),
            get_theme_mod('expoTim_contact_dest_email_6'),
            get_theme_mod('expoTim_contact_dest_email_7'),
            get_theme_mod('expoTim_contact_dest_email_8'),
            get_theme_mod('expoTim_contact_dest_email_9')
        ]);

        // Initialisation
        $message_sent = false;
        $error_message = '';
        $nom = $email_user = $to_email = $message = '';

        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact-form'])) {
            $nom        = wp_unslash($_POST['nom']);
            $email_user = wp_unslash($_POST['email_user']); 
            $to_email   = sanitize_email($_POST['to_email']); 
            $message    = wp_unslash($_POST['message']);

            if (!$nom || !$email_user || !$to_email || !$message) {
                $error_message = "Tous les champs sont requis.";
            } elseif (!in_array($to_email, $allowed_emails)) {
                $error_message = "Adresse du destinataire non autorisée.";
            } else {
                $subject = "Nouveau message depuis le formulaire de contact";

                $body = "
                <html>
                <body>
                    <p><strong>Nom de l'expéditeur :</strong> " . esc_html($nom) . "</p>
                    <p><strong>Email de l'expéditeur :</strong> " . esc_html($email_user) . "</p>
                    <p><strong>Message :</strong><br>" . nl2br(esc_html($message)) . "</p>
                </body>
                </html>";

                // En-têtes : From = Gmail (SMTP), Reply-To = utilisateur
                $headers = [
                    "From: $from_name <$from_email>",
                    "Reply-To: $email_user",
                    "Content-Type: text/html; charset=UTF-8"
                ];

                if (wp_mail($to_email, $subject, $body, $headers)) {
                    $message_sent = true;
                    $nom = $email_user = $to_email = $message = '';
                } else {
                    $error_message = "Erreur lors de l'envoi. Veuillez réessayer.";
                }
            }
        }
        ?>

        <section class="formulaireContact">
            <h2>Envoyez-nous un message</h2>

            <?php if ($message_sent): ?>
                <p class="success">🎉 Votre message a été envoyé avec succès !</p>
            <?php elseif ($error_message): ?>
                <p class="error">❌ <?= htmlspecialchars($error_message, ENT_QUOTES, 'UTF-8') ?></p>
            <?php endif; ?>

            <form method="POST" class="contact-form">
                <input type="hidden" name="contact-form" value="1">

                <label>Votre nom</label>
                <input type="text" name="nom" required value="<?= htmlspecialchars($nom, ENT_QUOTES, 'UTF-8') ?>">

                <label>Votre email</label>
                <input type="email" name="email_user" required value="<?= htmlspecialchars($email_user, ENT_QUOTES, 'UTF-8') ?>">

                <label>Destinataire</label>
                <select name="to_email" required>
                    <option value="" disabled <?= $to_email === '' ? 'selected' : '' ?>>-- Choisissez un destinataire --</option>
                    <?php foreach ($allowed_emails as $mail): ?>
                        <option value="<?= esc_attr($mail) ?>" <?= ($to_email === $mail) ? 'selected' : '' ?>>
                            <?= esc_html($mail) ?>
                        </option>
                    <?php endforeach; ?>
                </select>

                <label>Message</label>
                <textarea name="message" rows="5" required><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></textarea>

                <button type="submit" class="btn">Envoyer le message</button>
            </form>
        </section>

        <!-- ==================== Section Profils ==================== -->
        <section class="contactComplet">
            <div class="messagePageContact">
                <h1>Contactez les membres ainsi que les gens en charge de</h1>
                <img class="footer-logo-img" src="<?php echo get_template_directory_uri(); ?>/Images/Texte.png" alt="Logo de l'expo TIM">
            </div>

            <div class="conteneurMembres">
                <div class="profilRemy">
                    <span class="photo">
                        <img class="imgProf" src="<?php echo get_template_directory_uri(); ?>/Images/ImageSimpson/Remy.jpg" alt="Photo Rémy Roger">
                    </span>
                    <h3 class="nom">Rémy Roger</h3>
                    <p>Chef Programmation</p>
                    <p class="email">e2364643@cmaisonneuve.qc.ca</p>
                </div>

                <div class="profilLina">
                    <span class="photo">
                        <img class="imgProf" src="<?php echo get_template_directory_uri(); ?>/Images/ImageSimpson/Lina.png" alt="Photo Lîna Bensenouci">
                    </span>
                    <h3 class="nom">Lîna Bensenouci</h3>
                    <p>Chargée de Projet</p>
                    <p class="email">e2177336@cmaisonneuve.qc.ca</p>
                </div>

                <div class="profilPeterson">
                    <span class="photo">
                        <img class="imgProf" src="<?php echo get_template_directory_uri(); ?>/Images/ImageSimpson/Peterson.jpg" alt="Photo Peterson Germain">
                    </span>
                    <h3 class="nom">Peterson Germain</h3>
                    <p>CSS Designer</p>
                    <p class="email">e2124621@cmaisonneuve.qc.ca</p>
                </div>

                <div class="profilMatilda">
                    <span class="photo">
                        <img class="imgProf" src="<?php echo get_template_directory_uri(); ?>/Images/ImageSimpson/Matilda.png" alt="Photo Matilda Kang">
                    </span>
                    <h3 class="nom">Matilda Kang</h3>
                    <p>Cheffe Design</p>
                    <p class="email">e2294300@cmaisonneuve.qc.ca</p>
                </div>

                <div class="profilAlexis">
                    <span class="photo">
                        <img class="imgProf" src="<?php echo get_template_directory_uri(); ?>/Images/ImageSimpson/Alexis.webp" alt="Photo Alexis David">
                    </span>
                    <h3 class="nom">Alexis David</h3>
                    <p>Assistant Designer</p>
                    <p class="email">e1924984@cmaisonneuve.qc.ca</p>
                </div>
            </div> 

            <div class="conteneurProfils">
                <div class="profilCaroline">
                    <span class="photo">
                        <img class="imgProf" src="<?php echo get_template_directory_uri(); ?>/Images/ImagesEnseignants/PhotoCarolineReframe.png" alt="Photo Caroline Martin">
                    </span>
                    <h3 class="nom">Caroline Martin</h3>
                    <p>Enseignant cadre</p>
                    <span class="conteneurBouton">
                        <input type="button" onclick="window.open('https://teams.microsoft.com/v2/');" target="blank" value="Rejoindre par Teams">
                    </span>
                </div>

                <div class="profilStephanie">
                    <span class="photo">
                        <img class="imgProf" src="<?php echo get_template_directory_uri(); ?>/Images/ImagesEnseignants/PhotoStephanieReframe.png" alt="Photo Stéphanie Pouliot">
                    </span>
                    <h3 class="nom">Stéphanie Pouliot</h3>
                    <p>Enseignant cadre</p>
                    <span class="conteneurBouton">
                        <input type="button" onclick="window.open('https://teams.microsoft.com/v2/');" target="blank" value="Rejoindre par Teams">
                    </span>
                </div>

                <div class="profilManon">
                    <span class="photo">
                        <img class="imgProf" src="<?php echo get_template_directory_uri(); ?>/Images/ImagesEnseignants/PhotoManonReframe.png" alt="Photo Manon Bertrand">
                    </span>
                    <h3 class="nom">Manon Bertrand</h3>
                    <p>Enseignant cadre</p>
                    <span class="conteneurBouton">
                        <input type="button" onclick="window.open('https://teams.microsoft.com/v2/');" target="blank" value="Rejoindre par Teams">
                    </span>
                </div>

                <div class="profilCamille">
                    <span class="photo">
                        <img class="imgProf" src="<?php echo get_template_directory_uri(); ?>/Images/ImagesEnseignants/maisonneuve.png" alt="Photo Camille Lagace-Labonte">
                    </span>
                    <h3 class="nom">Camille Lagacé-Labonté</h3>
                    <p>Enseignant cadre</p>
                    <span class="conteneurBouton">
                        <input type="button" onclick="window.open('https://teams.microsoft.com/v2/');" target="blank" value="Rejoindre par Teams">
                    </span>
                </div>
            </div>
        </section>
    </div> <!-- /.pattern-background -->

    <?php get_footer(); // Appelle le footer ?>
</body>
</html>
