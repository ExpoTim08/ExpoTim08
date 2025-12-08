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

    /* --- Images Crédits (5 images) --- */
   /* --- Image Crédit 1 --- */
    $wp_customize->add_setting('expoTim_home_credit_img_1', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'expoTim_home_credit_img_1_control',
        array(
            'label'    => __('Image crédit 1', 'expoTim'),
            'section'  => 'expoTim_home_section',
            'settings' => 'expoTim_home_credit_img_1',
        )
    ));

    /* --- Image Crédit 2 --- */
    $wp_customize->add_setting('expoTim_home_credit_img_2', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'expoTim_home_credit_img_2_control',
        array(
            'label'    => __('Image crédit 2', 'expoTim'),
            'section'  => 'expoTim_home_section',
            'settings' => 'expoTim_home_credit_img_2',
        )
    ));

    /* --- Image Crédit 3 --- */
    $wp_customize->add_setting('expoTim_home_credit_img_3', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'expoTim_home_credit_img_3_control',
        array(
            'label'    => __('Image crédit 3', 'expoTim'),
            'section'  => 'expoTim_home_section',
            'settings' => 'expoTim_home_credit_img_3',
        )
    ));

    /* --- Image Crédit 4 --- */
    $wp_customize->add_setting('expoTim_home_credit_img_4', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'expoTim_home_credit_img_4_control',
        array(
            'label'    => __('Image crédit 4', 'expoTim'),
            'section'  => 'expoTim_home_section',
            'settings' => 'expoTim_home_credit_img_4',
        )
    ));

    /* --- Image Crédit 5 --- */
    $wp_customize->add_setting('expoTim_home_credit_img_5', array(
        'default'           => '',
        'sanitize_callback' => 'esc_url_raw',
    ));

    $wp_customize->add_control(new WP_Customize_Image_Control(
        $wp_customize,
        'expoTim_home_credit_img_5_control',
        array(
            'label'    => __('Image crédit 5', 'expoTim'),
            'section'  => 'expoTim_home_section',
            'settings' => 'expoTim_home_credit_img_5',
        )

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



}
add_action('customize_register', 'expoTim_customize_register');
