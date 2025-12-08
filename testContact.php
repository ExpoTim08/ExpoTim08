<?php
/*
Template Name: Test Contact
*/
get_header();

// Compte expéditeur Gmail configuré dans WP Mail SMTP
$from_email = "contacttimvisionexpo@gmail.com";
$from_name  = "Équipe TIM Vision Expo";

// Liste des destinataires autorisés
$allowed_emails = [
    'e2364643@cmaisonneuve.qc.ca',
    'lina.bensenouci@hotmail.com'
];

// Traitement du formulaire
$message_sent = false;
$error_message = '';

// Initialisation des variables pour garder les champs remplis
$nom = $email_user = $to_email = $message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['contact-form'])) {

    // Récupération et nettoyage des données
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

        // Corps du mail en texte simple (pas HTML)
        $body  = "Nom de l'expéditeur : " . sanitize_text_field($nom) . "\n";
        $body .= "Email de l'expéditeur : " . sanitize_text_field($email_user) . "\n\n";
        $body .= "Message :\n" . sanitize_textarea_field($message);

        // Headers simples
        $headers = [
            "From: $from_name <$from_email>",
            "Reply-To: " . sanitize_email($email_user)
        ];

        if (wp_mail($to_email, $subject, $body, $headers)) {
            $message_sent = true;

            // Réinitialiser les champs après envoi
            $nom = $email_user = $to_email = $message = '';
        } else {
            $error_message = "Erreur lors de l'envoi. Veuillez réessayer.";
        }
    }
}
?>

<main class="contact-page">
    <h1>Contact</h1>

    <?php if ($message_sent): ?>
        <p class="success">🎉 Votre message a été envoyé avec succès !</p>
    <?php elseif ($error_message): ?>
        <p class="error"><?= esc_html($error_message) ?></p>
    <?php endif; ?>

    <form method="POST" class="contact-form">
        <input type="hidden" name="contact-form" value="1">

        <label>Votre nom</label>
        <input type="text" name="nom" required value="<?= esc_attr($nom) ?>">

        <label>Votre email</label>
        <input type="text" name="email_user" required value="<?= esc_attr($email_user) ?>">

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
        <textarea name="message" rows="5" required><?= esc_textarea($message) ?></textarea>

        <button type="submit" class="btn">Envoyer le message</button>
    </form>

    <div class="contact-options">
        <!-- Bouton Teams vers le premier destinataire -->
        <a class="btn teams" href="https://teams.microsoft.com/l/chat/0/0?users=<?= esc_attr($allowed_emails[0]) ?>" target="_blank">
            💬 Contacter via Teams
        </a>
    </div>
</main>

<?php get_footer(); ?>
