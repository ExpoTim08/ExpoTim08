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
}
add_action('customize_register', 'expoTim_customize_register');
