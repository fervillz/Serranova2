<?php
/**
 * serranova Theme Customizer
 *
 * @package serranova
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function serranova_customize_register( $wp_customize )
{
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	function serranova_sanitize_textarea( $text )
	{
		return strip_tags( $text, '<p><a><i><br><strong><b><em><ul><li><ol><span><h1><h2><h3><h4>' );
	}

	function serranova_sanitize_integer( $text )
	{
		return ( int )$text;
	}
}

add_action( 'customize_register', 'serranova_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function serranova_customize_preview_js()
{
	wp_enqueue_script( 'serranova_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130515', true );
}

add_action( 'customize_preview_init', 'serranova_customize_preview_js' );

function serranova_sanitize_color_hex( $value )
{
	if ( !preg_match( '/\#[a-fA-F0-9]{6}/', $value ) ) {
		$value = '#ffffff';
	}

	return $value;
}

function serranova_sanitize_int( $value )
{
	return (int)$value;
}

function serranova_customizer( $wp_customize )
{

	$wp_customize->add_panel( 'serranova_homepage', array(
		'title'    => __( 'Homepage Setup', 'serranova' ),
		'priority' => 10,
	) );

	$wp_customize->add_panel( 'serranova_site_identity', array(
		'title'    => __( 'Site Identity', 'serranova' ),
		'priority' => 10,
	) );

	// move "site identity" to a panel first
	$wp_customize->add_section( 'title_tagline', array(
		'title'    => __( 'Title and Tagline', 'serranova' ),
		'priority' => 50,
		'panel'    => 'serranova_site_identity',
	) );

	// header logo
	$wp_customize->add_section( 'serranova_header_logo', array(
		'title'    => __( 'Header logo', 'serranova' ),
		'priority' => 50,
		'panel'    => 'serranova_site_identity',
	) );

	$wp_customize->add_setting( 'serranova_header_logo_show', array(
		'default'           => 'logo',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'serranova_header_logo_show', array(
		'label'    => __( 'Show header logo or text', 'serranova' ),
		'section'  => 'serranova_header_logo',
		'settings' => 'serranova_header_logo_show',
		'type'     => 'select',
		'choices'  => array( 'logo' => __( 'Logo', 'serranova' ), 'text' => __( 'Text', 'serranova' ) ),
	) );

	$wp_customize->add_setting( 'serranova_header_logo_image', array(
		'default'           => get_template_directory_uri() . '/images/logo.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'serranova_header_logo_image', array(
		'label'    => __( 'Header logo image', 'serranova' ),
		'section'  => 'serranova_header_logo',
		'settings' => 'serranova_header_logo_image',
	) ) );
	// end header logo

	// hero banner
	$wp_customize->add_section( 'serranova_hero', array(
		'title'       => __( 'Hero Banner', 'serranova' ),
		'priority'    => 50,
		'description' => __( 'Right image banner section on the front page', 'serranova' ),
		'panel'       => 'serranova_homepage',
	) );



	$wp_customize->add_setting( 'serranova_hero_image', array(
		'default'           => get_template_directory_uri() . '/images/mobile.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'serranova_hero_image', array(
		'label'    => __( 'Background image', 'serranova' ),
		'section'  => 'serranova_hero',
		'settings' => 'serranova_hero_image',
	) ) );

	$wp_customize->add_setting( 'serranova_hero_title', array(
		'default'           => __( 'serranova is a beautiful, clean and light WordPress theme, perfect for apps, landing pages and business sites.', 'serranova' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'serranova_hero_title', array(
		'label'   => __( 'Title', 'serranova' ),
		'section' => 'serranova_hero',
	) );

	$wp_customize->add_setting( 'serranova_hero_text', array(
		'default'           => 'Clean code, WordPress standards and no bloating, guaranteed.',
		'sanitize_callback' => 'serranova_sanitize_textarea',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'serranova_hero_text', array(
		'label'    => __( 'Main text', 'serranova' ),
		'section'  => 'serranova_hero',
		'settings' => 'serranova_hero_text',
		'type'     => 'textarea',
	) );

	$wp_customize->add_setting( 'serranova_hero_button1_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'serranova_hero_button1_show', array(
		'label'    => __( 'Show button 1', 'serranova' ),
		'section'  => 'serranova_hero',
		'settings' => 'serranova_hero_button1_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'serranova' ), 'no' => __( 'No', 'serranova' ) ),
	) );

	$wp_customize->add_setting( 'serranova_hero_button1_text', array(
		'default'           => __( 'Learn More', 'serranova' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'serranova_hero_button1_text', array(
		'label'    => __( 'Button 1 text', 'serranova' ),
		'section'  => 'serranova_hero',
		'settings' => 'serranova_hero_button1_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'serranova_hero_button1_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'serranova_hero_button1_link', array(
		'label'    => __( 'Button 1 link', 'serranova' ),
		'section'  => 'serranova_hero',
		'settings' => 'serranova_hero_button1_link',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'serranova_hero_button2_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'serranova_hero_button2_show', array(
		'label'    => __( 'Show button 2', 'serranova' ),
		'section'  => 'serranova_hero',
		'settings' => 'serranova_hero_button2_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'serranova' ), 'no' => __( 'No', 'serranova' ) ),
	) );

	$wp_customize->add_setting( 'serranova_hero_button2_text', array(
		'default'           => __( 'Contact', 'serranova' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'serranova_hero_button2_text', array(
		'label'    => __( 'Button 2 text', 'serranova' ),
		'section'  => 'serranova_hero',
		'settings' => 'serranova_hero_button2_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'serranova_hero_button2_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'serranova_hero_button2_link', array(
		'label'    => __( 'Button 2 link', 'serranova' ),
		'section'  => 'serranova_hero',
		'settings' => 'serranova_hero_button2_link',
		'type'     => 'text',
	) );
	// end hero banner

	// footer logo
	$wp_customize->add_section( 'serranova_footer_logo', array(
		'title'    => __( 'Footer logo', 'serranova' ),
		'priority' => 50,
		'panel'    => 'serranova_site_identity',
	) );

	$wp_customize->add_setting( 'serranova_footer_logo_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'serranova_footer_logo_show', array(
		'label'    => __( 'Show footer logo', 'serranova' ),
		'section'  => 'serranova_footer_logo',
		'settings' => 'serranova_footer_logo_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'serranova' ), 'no' => __( 'No', 'serranova' ) ),
	) );

	$wp_customize->add_setting( 'serranova_footer_logo_image', array(
		'default'           => get_template_directory_uri() . '/images/logo-footer.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'serranova_footer_logo_image', array(
		'label'    => __( 'Footer logo image', 'serranova' ),
		'section'  => 'serranova_footer_logo',
		'settings' => 'serranova_footer_logo_image',
	) ) );
	// end footer logo

	// google fonts
	require_once( dirname( __FILE__ ) . '/google-fonts/fonts.php' );


	$wp_customize->add_section( 'serranova_google_fonts', array(
		'title'    => __( 'Fonts', 'serranova' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'serranova_google_fonts_heading_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'serranova_google_fonts_heading_font', array(
		'label'    => __( 'Header Font', 'serranova' ),
		'section'  => 'serranova_google_fonts',
		'settings' => 'serranova_google_fonts_heading_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );

	$wp_customize->add_setting( 'serranova_google_fonts_body_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'serranova_google_fonts_body_font', array(
		'label'    => __( 'Body Font', 'serranova' ),
		'section'  => 'serranova_google_fonts',
		'settings' => 'serranova_google_fonts_body_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );
	// end google fonts

	// colors

	$wp_customize->add_setting( 'serranova_accent_color', array(
		'default'           => '#bbf3cc',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'serranova_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent', array(
		'label'    => __( 'Accent color', 'serranova' ),
		'section'  => 'colors',
		'settings' => 'serranova_accent_color',
	) ) );

	// end colors

}

add_action( 'customize_register', 'serranova_customizer', 11 );