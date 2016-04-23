<?php
/**
 * Serranova Theme Customizer
 *
 * @package Serranova
 */

/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
function Serranova_customize_register( $wp_customize )
{
	$wp_customize->get_setting( 'blogname' )->transport = 'postMessage';
	$wp_customize->get_setting( 'blogdescription' )->transport = 'postMessage';
	$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

	function Serranova_sanitize_textarea( $text )
	{
		return strip_tags( $text, '<p><a><i><br><strong><b><em><ul><li><ol><span><h1><h2><h3><h4>' );
	}

	function Serranova_sanitize_integer( $text )
	{
		return ( int )$text;
	}
}

add_action( 'customize_register', 'Serranova_customize_register' );

/**
 * Binds JS handlers to make Theme Customizer preview reload changes asynchronously.
 */
function Serranova_customize_preview_js()
{
	wp_enqueue_script( 'Serranova_customizer', get_template_directory_uri() . '/inc/js/customizer.js', array( 'customize-preview' ), '20130515', true );
}

add_action( 'customize_preview_init', 'Serranova_customize_preview_js' );

function Serranova_sanitize_color_hex( $value )
{
	if ( !preg_match( '/\#[a-fA-F0-9]{6}/', $value ) ) {
		$value = '#ffffff';
	}

	return $value;
}

function Serranova_sanitize_int( $value )
{
	return (int)$value;
}

function Serranova_customizer( $wp_customize )
{

	$wp_customize->add_panel( 'Serranova_homepage', array(
		'title'    => __( 'Homepage Setup', 'Serranova' ),
		'priority' => 10,
	) );

	$wp_customize->add_panel( 'Serranova_site_identity', array(
		'title'    => __( 'Site Identity', 'Serranova' ),
		'priority' => 10,
	) );

	// move "site identity" to a panel first
	$wp_customize->add_section( 'title_tagline', array(
		'title'    => __( 'Title and Tagline', 'Serranova' ),
		'priority' => 50,
		'panel'    => 'Serranova_site_identity',
	) );

	// header logo
	$wp_customize->add_section( 'Serranova_header_logo', array(
		'title'    => __( 'Header logo', 'Serranova' ),
		'priority' => 50,
		'panel'    => 'Serranova_site_identity',
	) );

	$wp_customize->add_setting( 'Serranova_header_logo_show', array(
		'default'           => 'logo',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'Serranova_header_logo_show', array(
		'label'    => __( 'Show header logo or text', 'Serranova' ),
		'section'  => 'Serranova_header_logo',
		'settings' => 'Serranova_header_logo_show',
		'type'     => 'select',
		'choices'  => array( 'logo' => __( 'Logo', 'Serranova' ), 'text' => __( 'Text', 'Serranova' ) ),
	) );

	$wp_customize->add_setting( 'Serranova_header_logo_image', array(
		'default'           => get_template_directory_uri() . '/images/logo.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'Serranova_header_logo_image', array(
		'label'    => __( 'Header logo image', 'Serranova' ),
		'section'  => 'Serranova_header_logo',
		'settings' => 'Serranova_header_logo_image',
	) ) );
	// end header logo

	// hero banner
	$wp_customize->add_section( 'Serranova_hero', array(
		'title'       => __( 'Hero Banner', 'Serranova' ),
		'priority'    => 50,
		'description' => __( 'Big banner section on the front page - background image', 'Serranova' ),
		'panel'       => 'Serranova_homepage',
	) );



	$wp_customize->add_setting( 'Serranova_hero_bg_image', array(
		'default'           => get_template_directory_uri() . '/images/header.jpg',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'Serranova_hero_bg_image', array(
		'label'    => __( 'Background image', 'Serranova' ),
		'section'  => 'Serranova_hero',
		'settings' => 'Serranova_hero_bg_image',
	) ) );

	$wp_customize->add_setting( 'Serranova_hero_title', array(
		'default'           => __( 'Serranova is a beautiful, clean and light WordPress theme, perfect for apps, landing pages and business sites.', 'Serranova' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );
	$wp_customize->add_control( 'Serranova_hero_title', array(
		'label'   => __( 'Title', 'Serranova' ),
		'section' => 'Serranova_hero',
	) );

	$wp_customize->add_setting( 'Serranova_hero_text', array(
		'default'           => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut tempor leo eu magna varius accumsan. Aliquam in dapibus massa, eget vestibulum turpis. <a href="#">Aliquam erat volutpat</a>. Pellentesque rhoncus pretium turpis faucibus placerat. Suspendisse eu sem quis enim posuere tristique.
<a href="#" class="button green large">About us</a>
<a href="#" class="button seethrough large">Contact us</a>',
		'sanitize_callback' => 'Serranova_sanitize_textarea',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'Serranova_hero_text', array(
		'label'    => __( 'Main text', 'Serranova' ),
		'section'  => 'Serranova_hero',
		'settings' => 'Serranova_hero_text',
		'type'     => 'textarea',
	) );

	$wp_customize->add_setting( 'Serranova_hero_button1_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'Serranova_hero_button1_show', array(
		'label'    => __( 'Show button 1', 'Serranova' ),
		'section'  => 'Serranova_hero',
		'settings' => 'Serranova_hero_button1_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'Serranova' ), 'no' => __( 'No', 'Serranova' ) ),
	) );

	$wp_customize->add_setting( 'Serranova_hero_button1_text', array(
		'default'           => __( 'About us', 'Serranova' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'Serranova_hero_button1_text', array(
		'label'    => __( 'Button 1 text', 'Serranova' ),
		'section'  => 'Serranova_hero',
		'settings' => 'Serranova_hero_button1_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'Serranova_hero_button1_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'Serranova_hero_button1_link', array(
		'label'    => __( 'Button 1 link', 'Serranova' ),
		'section'  => 'Serranova_hero',
		'settings' => 'Serranova_hero_button1_link',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'Serranova_hero_button2_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'Serranova_hero_button2_show', array(
		'label'    => __( 'Show button 2', 'Serranova' ),
		'section'  => 'Serranova_hero',
		'settings' => 'Serranova_hero_button2_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'Serranova' ), 'no' => __( 'No', 'Serranova' ) ),
	) );

	$wp_customize->add_setting( 'Serranova_hero_button2_text', array(
		'default'           => __( 'Contact', 'Serranova' ),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'Serranova_hero_button2_text', array(
		'label'    => __( 'Button 2 text', 'Serranova' ),
		'section'  => 'Serranova_hero',
		'settings' => 'Serranova_hero_button2_text',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'Serranova_hero_button2_link', array(
		'default'           => home_url(),
		'sanitize_callback' => 'sanitize_text_field',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'Serranova_hero_button2_link', array(
		'label'    => __( 'Button 2 link', 'Serranova' ),
		'section'  => 'Serranova_hero',
		'settings' => 'Serranova_hero_button2_link',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'Serranova_hero_blur_enabled', array(
		'default'           => 0,
		'sanitize_callback' => 'Serranova_sanitize_int',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'Serranova_hero_blur_enabled', array(
		'label'    => __( 'Blur amount (pixels)', 'Serranova' ),
		'section'  => 'Serranova_hero',
		'settings' => 'Serranova_hero_blur_enabled',
		'type'     => 'text',
	) );

	$wp_customize->add_setting( 'Serranova_hero_overlay_enabled', array(
		'default'           => 'no',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'Serranova_hero_overlay_enabled', array(
		'label'    => __( 'Overlay the image with color', 'Serranova' ),
		'section'  => 'Serranova_hero',
		'settings' => 'Serranova_hero_overlay_enabled',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'Serranova' ), 'no' => __( 'No', 'Serranova' ) ),
	) );

	$wp_customize->add_setting( 'Serranova_hero_overlay_color', array(
		'default'           => '#1f242d',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'Serranova_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'hero_overlay', array(
		'label'    => __( 'Hero image overlay color', 'Serranova' ),
		'section'  => 'Serranova_hero',
		'settings' => 'Serranova_hero_overlay_color',
	) ) );


	$wp_customize->add_setting( 'Serranova_hero_overlay_opacity', array(
		'default'           => '90',
		'sanitize_callback' => 'Serranova_sanitize_int',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
	) );

	$wp_customize->add_control( 'Serranova_hero_overlay_opacity', array(
		'label'    => __( 'Overlay opacity (between 0 and 100)', 'Serranova' ),
		'section'  => 'Serranova_hero',
		'settings' => 'Serranova_hero_overlay_opacity',
		'type'     => 'text',
	) );

	// end hero banner

	// footer logo
	$wp_customize->add_section( 'Serranova_footer_logo', array(
		'title'    => __( 'Footer logo', 'Serranova' ),
		'priority' => 50,
		'panel'    => 'Serranova_site_identity',
	) );

	$wp_customize->add_setting( 'Serranova_footer_logo_show', array(
		'default'           => 'yes',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'Serranova_footer_logo_show', array(
		'label'    => __( 'Show footer logo', 'Serranova' ),
		'section'  => 'Serranova_footer_logo',
		'settings' => 'Serranova_footer_logo_show',
		'type'     => 'select',
		'choices'  => array( 'yes' => __( 'Yes', 'Serranova' ), 'no' => __( 'No', 'Serranova' ) ),
	) );

	$wp_customize->add_setting( 'Serranova_footer_logo_image', array(
		'default'           => get_template_directory_uri() . '/images/logo-footer.png',
		'type'              => 'theme_mod',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'esc_url_raw',
	) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'Serranova_footer_logo_image', array(
		'label'    => __( 'Footer logo image', 'Serranova' ),
		'section'  => 'Serranova_footer_logo',
		'settings' => 'Serranova_footer_logo_image',
	) ) );
	// end footer logo

	// google fonts
	require_once( dirname( __FILE__ ) . '/google-fonts/fonts.php' );


	$wp_customize->add_section( 'Serranova_google_fonts', array(
		'title'    => __( 'Fonts', 'Serranova' ),
		'priority' => 50,
	) );

	$wp_customize->add_setting( 'Serranova_google_fonts_heading_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'Serranova_google_fonts_heading_font', array(
		'label'    => __( 'Header Font', 'Serranova' ),
		'section'  => 'Serranova_google_fonts',
		'settings' => 'Serranova_google_fonts_heading_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );

	$wp_customize->add_setting( 'Serranova_google_fonts_body_font', array(
		'default'           => 'none',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'sanitize_text_field',
	) );

	$wp_customize->add_control( 'Serranova_google_fonts_body_font', array(
		'label'    => __( 'Body Font', 'Serranova' ),
		'section'  => 'Serranova_google_fonts',
		'settings' => 'Serranova_google_fonts_body_font',
		'type'     => 'select',
		'choices'  => $font_choices,
	) );
	// end google fonts

	// colors

	$wp_customize->add_setting( 'Serranova_accent_color', array(
		'default'           => '#bbf3cc',
		'type'              => 'theme_mod',
		'capability'        => 'edit_theme_options',
		'transport'         => 'postMessage',
		'sanitize_callback' => 'Serranova_sanitize_color_hex',
	) );

	$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, 'accent', array(
		'label'    => __( 'Accent color', 'Serranova' ),
		'section'  => 'colors',
		'settings' => 'Serranova_accent_color',
	) ) );

	// end colors

}

add_action( 'customize_register', 'Serranova_customizer', 11 );