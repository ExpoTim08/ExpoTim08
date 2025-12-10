<?php
function expoTim_customize_register($wp_customize) {

    // SECTION HEADER
    $wp_customize->add_section('expoTim_header_section', array(
        'title'       => __('Header', 'expoTim'),
        'priority'    => 30,
        'description' => __('Paramètres du header du site', 'expoTim'),
    ));

    // SETTING : Logo
    $wp_customize->add_setting('expoTim_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    // CONTROL : Image de logo
    $wp_customize->add_control(new WP_Customize_Image_Control($wp_customize, 'expoTim_logo_control', array(
        'label'    => __('Logo du site', 'expoTim'),
        'section'  => 'expoTim_header_section',
        'settings' => 'expoTim_logo',
    )));

    /* -----------------------------
       SECTION ACCUEIL
    ------------------------------ */
    $wp_customize->add_section('expoTim_home_section', array(
        'title'       => __('Accueil', 'expoTim'),
        'priority'    => 40,
        'description' => __('Contenu de la page d’accueil', 'expoTim'),
    ));

    /* --- Texte d’accroche --- */
    $wp_customize->add_setting('expoTim_home_hook', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('expoTim_home_hook_control', array(
        'label'    => __('Texte d’accroche', 'expoTim'),
        'section'  => 'expoTim_home_section',
        'settings' => 'expoTim_home_hook',
        'type'     => 'text',
    ));
    /* --- Titre À propos --- */
    $wp_customize->add_setting('expoTim_home_about_title', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('expoTim_home_about_title_control', array(
        'label'    => __('Titre "À propos"', 'expoTim'),
        'section'  => 'expoTim_home_section',
        'settings' => 'expoTim_home_about_title',
        'type'     => 'text',
    ));

    /* --- Texte À propos --- */
    $wp_customize->add_setting('expoTim_home_about', array(
        'default'           => '',
        'sanitize_callback' => 'wp_kses_post',
    ));

    $wp_customize->add_control('expoTim_home_about_control', array(
        'label'    => __('Texte "À propos"', 'expoTim'),
        'section'  => 'expoTim_home_section',
        'settings' => 'expoTim_home_about',
        'type'     => 'textarea',
    ));

    /* --- Date --- */
    $wp_customize->add_setting('expoTim_home_date', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('expoTim_home_date_control', array(
        'label'    => __('Date', 'expoTim'),
        'section'  => 'expoTim_home_section',
        'settings' => 'expoTim_home_date',
        'type'     => 'text',
    ));

    /* --- Heure --- */
    $wp_customize->add_setting('expoTim_home_time', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('expoTim_home_time_control', array(
        'label'    => __('Heure', 'expoTim'),
        'section'  => 'expoTim_home_section',
        'settings' => 'expoTim_home_time',
        'type'     => 'text',
    ));

    /* --- Lieu --- */
    $wp_customize->add_setting('expoTim_home_place', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('expoTim_home_place_control', array(
        'label'    => __('Lieu', 'expoTim'),
        'section'  => 'expoTim_home_section',
        'settings' => 'expoTim_home_place',
        'type'     => 'text',
    ));
    /* --- Projet aléatoire --- */
    $wp_customize->add_setting('expoTim_home_random_project', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('expoTim_home_random_project_control', array(
        'label'    => __('Projet aléatoire', 'expoTim'),
        'section'  => 'expoTim_home_section',
        'settings' => 'expoTim_home_random_project',
        'type'     => 'text',
    ));
    /* --- Crédits --- */
    $wp_customize->add_setting('expoTim_home_credits', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('expoTim_home_credits_control', array(
        'label'    => __('Crédits', 'expoTim'),
        'section'  => 'expoTim_home_section',
        'settings' => 'expoTim_home_credits',
        'type'     => 'text',
    ));




    /* -----------------------------
    SECTION FOOTER
    ------------------------------ */
    $wp_customize->add_section('expoTim_footer_section', array(
        'title'       => __('Footer', 'expoTim'),
        'priority'    => 50,
        'description' => __('Paramètres du pied de page', 'expoTim'),
    ));

    /* --- Logo Footer --- */
    $wp_customize->add_setting('expoTim_footer_logo', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'expoTim_footer_logo_control',
        array(
            'label'    => __('Logo du footer', 'expoTim'),
            'section'  => 'expoTim_footer_section',
            'settings' => 'expoTim_footer_logo',
        )
    ));


    /* --- Second Logo Footer --- */
    $wp_customize->add_setting('expoTim_footer_logo_2', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'expoTim_footer_logo_2_control',
        array(
            'label'    => __('Logo TIM', 'expoTim'),
            'section'  => 'expoTim_footer_section',
            'settings' => 'expoTim_footer_logo_2',
        )
    ));


    /* --- Adresse --- */
    $wp_customize->add_setting('expoTim_footer_address', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('expoTim_footer_address_control', array(
        'label'    => __('Adresse', 'expoTim'),
        'section'  => 'expoTim_footer_section',
        'settings' => 'expoTim_footer_address',
        'type'     => 'text',
    ));


    /* --- Numéro de téléphone --- */
    $wp_customize->add_setting('expoTim_footer_phone', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));

    $wp_customize->add_control('expoTim_footer_phone_control', array(
        'label'    => __('Numéro de téléphone', 'expoTim'),
        'section'  => 'expoTim_footer_section',
        'settings' => 'expoTim_footer_phone',
        'type'     => 'text',
    ));


    /* --- Réseaux sociaux : 3 champs différents --- */

    // Réseau social 1
    $wp_customize->add_setting('expoTim_footer_social_1', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('expoTim_footer_social_1_control', array(
        'label'    => __('Réseau social Youtube (URL)', 'expoTim'),
        'section'  => 'expoTim_footer_section',
        'settings' => 'expoTim_footer_social_1',
        'type'     => 'url',
    ));

    // Réseau social 2
    $wp_customize->add_setting('expoTim_footer_social_2', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('expoTim_footer_social_2_control', array(
        'label'    => __('Réseau social Instagram (URL)', 'expoTim'),
        'section'  => 'expoTim_footer_section',
        'settings' => 'expoTim_footer_social_2',
        'type'     => 'url',
    ));

    // Réseau social 3
    $wp_customize->add_setting('expoTim_footer_social_3', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control('expoTim_footer_social_3_control', array(
        'label'    => __('Réseau social Facebook (URL)', 'expoTim'),
        'section'  => 'expoTim_footer_section',
        'settings' => 'expoTim_footer_social_3',
        'type'     => 'url',
    ));
    /* Image réseau social 1 */
    $wp_customize->add_setting('expoTim_footer_social_img_1', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

     /* -----------------------------
    SECTION FINISSANTS
------------------------------ */

$wp_customize->add_section('expoTim_finissants_section', array(
    'title'       => __('Finissants', 'expoTim'),
    'priority'    => 140,
    'description' => __('Section pour afficher la description des finissants.', 'expoTim'),
));

/* --- Champ : Description --- */
$wp_customize->add_setting('expoTim_finissants_description', array(
    'default'           => '',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control('expoTim_finissants_description_control', array(
    'label'       => __('Description', 'expoTim'),
    'section'     => 'expoTim_finissants_section',
    'settings'    => 'expoTim_finissants_description',
    'type'        => 'textarea',
));

/* --- Champ : Titre unique --- */
$wp_customize->add_setting('expoTim_finissants_title', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('expoTim_finissants_title_control', array(
    'label'       => __('Titre', 'expoTim'),
    'section'     => 'expoTim_finissants_section',
    'settings'    => 'expoTim_finissants_title',
    'type'        => 'text',
));



  /* -----------------------------
    SECTION ARCADE
------------------------------ */

$wp_customize->add_section('expoTim_arcade_section', array(
    'title'       => __('Arcade', 'expoTim'),
    'priority'    => 150,
    'description' => __('Section pour la partie Arcade du site.', 'expoTim'),
));

/* --- Champ : Description --- */
$wp_customize->add_setting('expoTim_arcade_description', array(
    'default'           => '',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control('expoTim_arcade_description_control', array(
    'label'       => __('Description', 'expoTim'),
    'section'     => 'expoTim_arcade_section',
    'settings'    => 'expoTim_arcade_description',
    'type'        => 'textarea',
));

/* --- Champ : Titre unique --- */
$wp_customize->add_setting('expoTim_arcade_title', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('expoTim_arcade_title_control', array(
    'label'       => __('Titre', 'expoTim'),
    'section'     => 'expoTim_arcade_section',
    'settings'    => 'expoTim_arcade_title',
    'type'        => 'text',
));


  /* -----------------------------
    SECTION GRAPHISME
------------------------------ */

$wp_customize->add_section('expoTim_graphisme_section', array(
    'title'       => __('Graphisme', 'expoTim'),
    'priority'    => 160,
    'description' => __('Section dédiée au département de graphisme.', 'expoTim'),
));

/* --- Champ : Description --- */
$wp_customize->add_setting('expoTim_graphisme_description', array(
    'default'           => '',
    'sanitize_callback' => 'wp_kses_post',
));

$wp_customize->add_control('expoTim_graphisme_description_control', array(
    'label'       => __('Description', 'expoTim'),
    'section'     => 'expoTim_graphisme_section',
    'settings'    => 'expoTim_graphisme_description',
    'type'        => 'textarea',
));

/* --- Champ : Titre unique --- */
$wp_customize->add_setting('expoTim_graphisme_title', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('expoTim_graphisme_title_control', array(
    'label'       => __('Titre', 'expoTim'),
    'section'     => 'expoTim_graphisme_section',
    'settings'    => 'expoTim_graphisme_title',
    'type'        => 'text',
));


    /* -----------------------------
    SECTION CONTACT – Emails autorisés
    ------------------------------ */

    $wp_customize->add_section('expoTim_contact_destinataires_section', array(
        'title'       => __('Contact', 'expoTim'),
        'priority'    => 180,
        'description' => __('Emails autorisés pour recevoir le formulaire de contact.', 'expoTim'),
    ));

    /* Email 1 */
    $wp_customize->add_setting('expoTim_contact_dest_email_1', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('expoTim_contact_dest_email_1_control', array(
        'label'    => __('Adresse courriel 1', 'expoTim'),
        'section'  => 'expoTim_contact_destinataires_section',
        'settings' => 'expoTim_contact_dest_email_1',
        'type'     => 'text',
    ));

    /* Email 2 */
    $wp_customize->add_setting('expoTim_contact_dest_email_2', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('expoTim_contact_dest_email_2_control', array(
        'label'    => __('Adresse courriel 2', 'expoTim'),
        'section'  => 'expoTim_contact_destinataires_section',
        'settings' => 'expoTim_contact_dest_email_2',
        'type'     => 'text',
    ));

    /* Email 3 */
    $wp_customize->add_setting('expoTim_contact_dest_email_3', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('expoTim_contact_dest_email_3_control', array(
        'label'    => __('Adresse courriel 3', 'expoTim'),
        'section'  => 'expoTim_contact_destinataires_section',
        'settings' => 'expoTim_contact_dest_email_3',
        'type'     => 'text',
    ));

    /* Email 4 */
    $wp_customize->add_setting('expoTim_contact_dest_email_4', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('expoTim_contact_dest_email_4_control', array(
        'label'    => __('Adresse courriel 4', 'expoTim'),
        'section'  => 'expoTim_contact_destinataires_section',
        'settings' => 'expoTim_contact_dest_email_4',
        'type'     => 'text',
    ));

    /* Email 5 */
    $wp_customize->add_setting('expoTim_contact_dest_email_5', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('expoTim_contact_dest_email_5_control', array(
        'label'    => __('Adresse courriel 5', 'expoTim'),
        'section'  => 'expoTim_contact_destinataires_section',
        'settings' => 'expoTim_contact_dest_email_5',
        'type'     => 'text',
    ));

    /* Email 6 */
    $wp_customize->add_setting('expoTim_contact_dest_email_6', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('expoTim_contact_dest_email_6_control', array(
        'label'    => __('Adresse courriel 6', 'expoTim'),
        'section'  => 'expoTim_contact_destinataires_section',
        'settings' => 'expoTim_contact_dest_email_6',
        'type'     => 'text',
    ));

    /* Email 7 */
    $wp_customize->add_setting('expoTim_contact_dest_email_7', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('expoTim_contact_dest_email_7_control', array(
        'label'    => __('Adresse courriel 7', 'expoTim'),
        'section'  => 'expoTim_contact_destinataires_section',
        'settings' => 'expoTim_contact_dest_email_7',
        'type'     => 'text',
    ));

    /* Email 8 */
    $wp_customize->add_setting('expoTim_contact_dest_email_8', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('expoTim_contact_dest_email_8_control', array(
        'label'    => __('Adresse courriel 8', 'expoTim'),
        'section'  => 'expoTim_contact_destinataires_section',
        'settings' => 'expoTim_contact_dest_email_8',
        'type'     => 'text',
    ));

    /* Email 9 */
    $wp_customize->add_setting('expoTim_contact_dest_email_9', array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_email',
    ));
    $wp_customize->add_control('expoTim_contact_dest_email_9_control', array(
        'label'    => __('Adresse courriel 9', 'expoTim'),
        'section'  => 'expoTim_contact_destinataires_section',
        'settings' => 'expoTim_contact_dest_email_9',
        'type'     => 'text',
    ));

   $wp_customize->add_section('expoTim_carrousel_section', array(
    'title'       => __('Carrousel', 'expotim'),
    'priority'    => 30,
    'description' => __('Ajoutez les 3 images du carrousel et leurs descriptions.', 'expotim'),
    ));

    for ($i = 1; $i <= 3; $i++) {

    // =======================
    // IMAGE
    // =======================
    $image_setting = "expotim_carrousel_image_$i";

    $wp_customize->add_setting($image_setting, array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        $image_setting,
        array(
            'label'    => sprintf(__('Image %d', 'expotim'), $i),
            'section'  => 'expoTim_carrousel_section',
            'settings' => $image_setting,
        )
    ));

    // =======================
    // DESCRIPTION
    // =======================
    $desc_setting = "expotim_carrousel_description_$i";

    $wp_customize->add_setting($desc_setting, array(
        'default'           => '',
        'sanitize_callback' => 'sanitize_textarea_field',
    ));

    $wp_customize->add_control($desc_setting, array(
        'label'    => sprintf(__('Description %d', 'expotim'), $i),
        'section'  => 'expoTim_carrousel_section',
        'type'     => 'textarea',
    ));
    /* =======================
   TITRE FINISSANTS
======================= */
$wp_customize->add_setting('expotim_carrousel_title_finissants', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('expotim_carrousel_title_finissants_control', array(
    'label'    => __('Titre Finissants', 'expotim'),
    'section'  => 'expoTim_carrousel_section',
    'settings' => 'expotim_carrousel_title_finissants',
    'type'     => 'text',
));


/* =======================
   TITRE ARCADE
======================= */
$wp_customize->add_setting('expotim_carrousel_title_arcade', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('expotim_carrousel_title_arcade_control', array(
    'label'    => __('Titre Arcade', 'expotim'),
    'section'  => 'expoTim_carrousel_section',
    'settings' => 'expotim_carrousel_title_arcade',
    'type'     => 'text',
));


/* =======================
   TITRE GRAPHISME
======================= */
$wp_customize->add_setting('expotim_carrousel_title_graphisme', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('expotim_carrousel_title_graphisme_control', array(
    'label'    => __('Titre Graphisme', 'expotim'),
    'section'  => 'expoTim_carrousel_section',
    'settings' => 'expotim_carrousel_title_graphisme',
    'type'     => 'text',
));

}

/* =======================
   TITRE FINISSANTS
======================= */
$wp_customize->add_setting('expotim_carrousel_title_finissants', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('expotim_carrousel_title_finissants_control', array(
    'label'    => __('Titre Finissants', 'expotim'),
    'section'  => 'expoTim_carrousel_section',
    'settings' => 'expotim_carrousel_title_finissants',
    'type'     => 'text',
));


/* =======================
   TITRE ARCADE
======================= */
$wp_customize->add_setting('expotim_carrousel_title_arcade', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('expotim_carrousel_title_arcade_control', array(
    'label'    => __('Titre Arcade', 'expotim'),
    'section'  => 'expoTim_carrousel_section',
    'settings' => 'expotim_carrousel_title_arcade',
    'type'     => 'text',
));


/* =======================
   TITRE GRAPHISME
======================= */
$wp_customize->add_setting('expotim_carrousel_title_graphisme', array(
    'default'           => '',
    'sanitize_callback' => 'sanitize_text_field',
));

$wp_customize->add_control('expotim_carrousel_title_graphisme_control', array(
    'label'    => __('Titre Graphisme', 'expotim'),
    'section'  => 'expoTim_carrousel_section',
    'settings' => 'expotim_carrousel_title_graphisme',
    'type'     => 'text',
));

    /* -----------------------------
        SECTION CRÉDITS
    ------------------------------ */

    $wp_customize->add_section('expoTim_credits_section', array(
        'title'       => __('Crédits', 'expoTim'),
        'priority'    => 200,
        'description' => __('Section pour afficher les crédits du site.', 'expoTim'),
    ));

    /* ----------- MEMBRE 1 ----------- */

    // Rôle
    $wp_customize->add_setting('expoTim_credit1_role', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('expoTim_credit1_role_control', array(
        'label'    => __('Rôle Lina', 'expoTim'),
        'section'  => 'expoTim_credits_section',
        'settings' => 'expoTim_credit1_role',
        'type'     => 'text',
    ));

    // Image
    $wp_customize->add_setting('expoTim_credit1_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'expoTim_credit1_image_control',
            array(
                'label'    => __('Image Lina', 'expoTim'),
                'section'  => 'expoTim_credits_section',
                'settings' => 'expoTim_credit1_image',
            )
        )
    );


    /* ----------- MEMBRE 2 ----------- */

    $wp_customize->add_setting('expoTim_credit2_role', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('expoTim_credit2_role_control', array(
        'label'    => __('Rôle Peterson', 'expoTim'),
        'section'  => 'expoTim_credits_section',
        'settings' => 'expoTim_credit2_role',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('expoTim_credit2_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'expoTim_credit2_image_control',
            array(
                'label'    => __('Image Peterson', 'expoTim'),
                'section'  => 'expoTim_credits_section',
                'settings' => 'expoTim_credit2_image',
            )
        )
    );


    /* ----------- MEMBRE 3 ----------- */

    $wp_customize->add_setting('expoTim_credit3_role', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('expoTim_credit3_role_control', array(
        'label'    => __('Rôle Matilda', 'expoTim'),
        'section'  => 'expoTim_credits_section',
        'settings' => 'expoTim_credit3_role',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('expoTim_credit3_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'expoTim_credit3_image_control',
            array(
                'label'    => __('Image Matilda', 'expoTim'),
                'section'  => 'expoTim_credits_section',
                'settings' => 'expoTim_credit3_image',
            )
        )
    );


    /* ----------- MEMBRE 4 ----------- */

    $wp_customize->add_setting('expoTim_credit4_role', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('expoTim_credit4_role_control', array(
        'label'    => __('Rôle Remy', 'expoTim'),
        'section'  => 'expoTim_credits_section',
        'settings' => 'expoTim_credit4_role',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('expoTim_credit4_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'expoTim_credit4_image_control',
            array(
                'label'    => __('Image Remy', 'expoTim'),
                'section'  => 'expoTim_credits_section',
                'settings' => 'expoTim_credit4_image',
            )
        )
    );


    /* ----------- MEMBRE 5 ----------- */

    $wp_customize->add_setting('expoTim_credit5_role', array(
        'default' => '',
        'sanitize_callback' => 'sanitize_text_field',
    ));
    $wp_customize->add_control('expoTim_credit5_role_control', array(
        'label'    => __('Rôle Alexis', 'expoTim'),
        'section'  => 'expoTim_credits_section',
        'settings' => 'expoTim_credit5_role',
        'type'     => 'text',
    ));

    $wp_customize->add_setting('expoTim_credit5_image', array(
        'default' => '',
        'sanitize_callback' => 'esc_url_raw',
    ));
    $wp_customize->add_control(
        new WP_Customize_Image_Control(
            $wp_customize,
            'expoTim_credit5_image_control',
            array(
                'label'    => __('Image Alexis', 'expoTim'),
                'section'  => 'expoTim_credits_section',
                'settings' => 'expoTim_credit5_image',
            )
        )
    );



}
add_action('customize_register', 'expoTim_customize_register');


