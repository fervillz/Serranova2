<?php
/**
 * Serranova functions and definitions
 *
 * @package Serranova
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( !isset( $content_width ) ) {
	$content_width = 740; /* pixels */
}

if ( !function_exists( 'Serranova_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function Serranova_setup()
	{

		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Serranova, use a find and replace
		 * to change 'Serranova' to the name of your theme in all the template files
		 */
		load_theme_textdomain( 'Serranova', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support( 'html5', array(
			'search-form', 'comment-form', 'comment-list', 'gallery', 'caption',
		) );

		// enable featured images
		add_theme_support( 'post-thumbnails' );

		// Set up the WordPress core custom background feature.
		add_theme_support( 'custom-background', apply_filters( 'Serranova_custom_background_args', array(
			'default-color' => 'f6f6f6',
			'default-image' => '',
			'panel'         => 'Serranova_colors',
		) ) );

		add_image_size( 'Serranova-full', 740, 415, true );
		add_image_size( 'Serranova-blog-thumb', 690, 390, true );
	}
endif;
add_action( 'after_setup_theme', 'Serranova_setup' );


// WooCommerce Support
add_action( 'after_setup_theme', 'woocommerce_support' );
function woocommerce_support() {
    add_theme_support( 'woocommerce' );
}

// This theme uses wp_nav_menu() in one location.
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'Serranova' ),
) );
function Serranova_set_sample_content()
{


	// Add default items to primary menu
	$primary_menu_items = wp_get_nav_menu_items( 'primary' );
	if ( empty( $primary_menu_items ) ) {
		$name = 'primary';
		$menu_id = wp_create_nav_menu( $name );
		$menu = get_term_by( 'name', $name, 'nav_menu' );

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Home', 'Serranova' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Pricing', 'Serranova' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Blog', 'Serranova' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Contact', 'Serranova' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Members', 'Serranova' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		wp_update_nav_menu_item( $menu->term_id, 0, array(
				'menu-item-title'  => __( 'Sign up', 'Serranova' ),
				'menu-item-url'    => home_url( '/' ),
				'menu-item-status' => 'publish' )
		);

		$locations = get_theme_mod( 'nav_menu_locations' );
		$locations['primary'] = $menu->term_id;
		set_theme_mod( 'nav_menu_locations', $locations );
	}

	// set sample content - text, images, titles, team members
	if ( !get_theme_mod( 'Serranova_content_set', false ) ) {
		// set up default widgets
		$active_sidebars = get_option( 'sidebars_widgets' );
		$search_widget = get_option( 'widget_search' );
		$search_widget[1] = array( 'title' => __( 'Search', 'Serranova' ) );

		$admin = get_user_by( 'email', get_option( 'admin_email' ) );
		$userId = $admin->ID;
		$author_box_widget = get_option( 'widget_Serranova-author-box-widget' );
		$author_box_widget[1] = array(
			'title-' . $userId               => __( 'AUTHOR PROFILE', 'Serranova' ),
			'textbox-' . $userId             => 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aenean dapibus erat eget rhoncus facilisis. Duis et lacus ut tellus fermentum ultricies quis sit amet mauris. Nullam molestie, mauris ac ultrices tincidunt, sapien turpis rhoncus tellus, sed sagittis dui felis molestie risus.',
			'image_url-' . $userId           => get_template_directory_uri() . '/images/author_profile.png',
			'social_twitter-' . $userId      => 'http://twitter.com',
			'social_facebook-' . $userId     => 'https://facebook.com',
			'social_linkedin-' . $userId     => 'https://linkedin.com',
			'social_pinterest-' . $userId    => 'https://pinterest.com',
			'social_dribbble-' . $userId     => 'https://dribbble.com',
			'social_drupal-' . $userId       => 'https://drupal.com',
			'social_wordpress-' . $userId    => 'https://wordpress.com',
			'social_y-combinator-' . $userId => 'https://ycombinator.com',
			'social_gplus-' . $userId        => 'https://plus.google.com',
		);


		$popular_recent_posts_widget = get_option( 'widget_Serranova-recent-popular-posts-widget' );
		$popular_recent_posts_widget[1] = array( 'title-popular' => 'Popular', 'title-recent' => 'Recent', 'timeframe' => 'week', 'limit' => 3 );

		$text_widget = get_option( 'widget_text' );
		$text_widget[1] = array( 'title' => __( 'Text Widget', 'Serranova' ), 'text' => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' );
		$text_widget[2] = array( 'title' => __( 'Text Widget', 'Serranova' ), 'text' => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' );
		$text_widget[3] = array( 'title' => __( 'Text Widget', 'Serranova' ), 'text' => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' );
		$text_widget[4] = array( 'title' => __( 'Text Widget', 'Serranova' ), 'text' => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' );


		$active_sidebars['Serranova-footer'] = array( 'text-1', 'text-2', 'text-3', 'text-4' );
		update_option( 'widget_Serranova-author-box-widget', $author_box_widget );
		update_option( 'widget_Serranova-recent-popular-posts-widget', $popular_recent_posts_widget );
		update_option( 'sidebars_widgets', $active_sidebars );

		$active_sidebars['sidebar-1'] = array( 'Serranova-author-box-widget-1', 'text-4', 'search-1', 'Serranova-recent-popular-posts-widget-1' );
		update_option( 'widget_search', $search_widget );
		update_option( 'widget_text', $text_widget );
		update_option( 'sidebars_widgets', $active_sidebars );


		$feature_widget = get_option( 'widget_Serranova-feature-widget' );
		$feature_widget[1] = array(
			'title'   => __( 'Modern Design', 'Serranova' ),
			'textbox' => 'Serranova has a nice homepage with a hero header area so you can write some into text with call to action buttons and links to your social media profiles.',
			'url'     => get_home_url(),
			'icon'    => 'fa-desktop',

		);
		$feature_widget[2] = array(
			'title'   => __( 'eCommerce Ready', 'Serranova' ),
			'textbox' => 'Use Serranova with the <a href="http://www.woothemes.com/woocommerce/">WooCommerce plugin</a> and you can create your own online store to sell digital or tangible products with no fuss.',
			'url'     => get_home_url(),
			'icon'    => ' fa-shopping-basket',

		);
		$feature_widget[3] = array(
			'title'   => __( 'Live Customize', 'Serranova' ),
			'textbox' => 'Using the built-in WordPress Customizer you can change colors, fonts, text, buttons and upload your own logo for the footer and the header area.',
			'url'     => get_home_url(),
			'icon'    => 'fa-gears',

		);
		$feature_widget[4] = array(
			'title'   => __( 'Coded With Care', 'Serranova' ),
			'textbox' => 'We have coded the Serranova theme to be fast loading, with no bloated extras and it complies with all the latest WordPress theme requirements.',
			'url'     => get_home_url(),
			'icon'    => 'fa-file-code-o',

		);
		$active_sidebars['Serranova-features'] = array( 'Serranova-feature-widget-1', 'Serranova-feature-widget-2', 'Serranova-feature-widget-3', 'Serranova-feature-widget-4' );
		update_option( 'widget_Serranova-feature-widget', $feature_widget );
		update_option( 'sidebars_widgets', $active_sidebars );

		// set customizer options
		set_theme_mod( 'Serranova_header_logo_image', get_template_directory_uri() . '/images/logo.png' );
		set_theme_mod( 'Serranova_header_logo_show', 'logo' );
		set_theme_mod( 'Serranova_footer_logo_image', get_template_directory_uri() . '/images/logo-footer.png' );
		set_theme_mod( 'Serranova_footer_logo_show', 'yes' );
		set_theme_mod( 'Serranova_header_logo_text', get_bloginfo( 'name' ) );
		set_theme_mod( 'Serranova_hero_show', 'yes' );
		set_theme_mod( 'Serranova_hero_bg_image', get_template_directory_uri() . '/images/header.jpg' );
		set_theme_mod( 'Serranova_hero_title', 'Serranova WORDPRESS THEME' );
		set_theme_mod( 'Serranova_hero_text', 'Serranova is a nice modern looking WordPress theme which is suitable for business sites, personal blogs and you can also use it with the <a href="http://www.woothemes.com/woocommerce/">Free WooCommerce plugin</a> to create your own eCommerce site. It is super simple to setup with some nice options controlled using the Live Customizer.' );
		set_theme_mod( 'Serranova_hero_overlay_enabled', 'yes' );
		set_theme_mod( 'Serranova_hero_overlay_opacity', 90 );

		set_theme_mod( 'Serranova_hero_button1_text', __( 'About us', 'Serranova' ) );
		set_theme_mod( 'Serranova_hero_button2_text', __( 'Contact us', 'Serranova' ) );

		set_theme_mod( 'Serranova_content_set', true );
	}
}

add_action( 'after_switch_theme', 'Serranova_set_sample_content', 100 );

// Style the Tag Cloud
function Serranova_tag_cloud_widget( $args )
{
	$args['largest'] = 12; //largest tag
	$args['smallest'] = 12; //smallest tag
	$args['unit'] = 'px'; //tag font unit
	$args['number'] = '8'; //number of tags
	return $args;
}

add_filter( 'widget_tag_cloud_args', 'Serranova_tag_cloud_widget' );


// add custom class to tags
function Serranova_add_class_the_tags( $html )
{
	$postid = get_the_ID();
	$html = str_replace( '<a', '<a class="button seethrough small"', $html );

	return $html;
}

add_filter( 'the_tags', 'Serranova_add_class_the_tags' );

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function Serranova_widgets_init()
{
	register_sidebar( array(
		'name'          => __( 'Sidebar', 'Serranova' ),
		'id'            => 'sidebar-1',
		'description'   => '',
		'before_widget' => '<div class="sidebarwidget">',
		'after_widget'  => '</div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => __( 'Footer', 'Serranova' ),
		'id'            => 'Serranova-footer',
		'before_widget' => '<div class="col-1-4"><div class="wrap-col"><div class="footerwidget">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<h6 class="widget-title">',
		'after_title'   => '</h6>',
	) );

	register_sidebar( array(
		'name'          => __( 'Features', 'Serranova' ),
		'id'            => 'Serranova-features',
		'before_widget' => '<div class="col-1-4"><div class="wrap-col"><div class="featurewidget">',
		'after_widget'  => '</div></div></div>',
		'before_title'  => '<h2 class="featurewidgettitle">',
		'after_title'   => '</h2>',
	) );

}

add_action( 'widgets_init', 'Serranova_widgets_init' );

// Load Roboto Font
function Serranova_fonts_url()
{
	$fonts_url = '';
	$font_families = array();

	// default fonts - Roboto and Arimo
	$roboto = _x( 'on', 'Roboto font: on or off', 'Serranova' );
	$arimo = _x( 'on', 'Arimo font: on or off', 'Serranova' );
	$heading_font_family = get_theme_mod( 'Serranova_google_fonts_heading_font', null );
	$body_font_family = get_theme_mod( 'Serranova_google_fonts_body_font', null );

	if ( 'off' !== $roboto ) {
		$font_families[] = 'Roboto:100,100italic,300,300italic,400,400italic,500,500italic,700,700italic,900,900italic';
	}

	if ( 'off' !== $arimo ) {
		$font_families[] = 'Arimo:400,400italic,700,700italic';
	}

	if ( !empty( $heading_font_family ) && $heading_font_family !== 'none' ) {
		$heading_font = _x( 'on', $heading_font_family . ' font: on or off', 'Serranova' );
		if ( 'off' !== $heading_font ) {
			$font_families[] = $heading_font_family;
		}
	}

	if ( !empty( $body_font_family ) && $body_font_family !== 'none' && $body_font_family !== $heading_font_family ) {
		$body_font = _x( 'on', $body_font_family . ' font: on or off', 'Serranova' );
		if ( 'off' !== $body_font ) {
			$font_families[] = $body_font_family;
		}
	}


	// if both body and heading fonts are set in customizer,
	// don't include default Roboto and Arimo fonts
	if ( count( $font_families ) === 4 ) {
		array_slice( $font_families, 2 );
	}

	if ( !empty( $font_families ) ) {
		$query_args = array(
			'family' => urlencode( implode( '|', $font_families ) ),
			'subset' => urlencode( 'latin,latin-ext' ),
		);

		$fonts_url = add_query_arg( $query_args, '//fonts.googleapis.com/css' );
	}

	return $fonts_url;
}

/**
 * Enqueue scripts and styles.
 */
function Serranova_scripts()
{
	wp_enqueue_style( 'Serranova-style', get_stylesheet_uri() );
	wp_enqueue_style( 'Serranova-font-awesome', get_template_directory_uri() . '/inc/css/font-awesome.min.css' );
	wp_enqueue_style( 'Serranova-fonts', Serranova_fonts_url(), array(), null );
	wp_enqueue_script( 'Serranova-footer-scripts', get_template_directory_uri() . '/inc/js/script.js', array( 'jquery' ), '20151107', true );
	wp_enqueue_script( 'Serranova-widget-author-box', get_template_directory_uri() . '/inc/js/widget-author-box.js', array( 'jquery' ), '20151107', true );
	wp_enqueue_script( 'Serranova-widget-popular-recent', get_template_directory_uri() . '/inc/js/popular-recent.js', array( 'jquery' ), '20151107', true );

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}

add_action( 'wp_enqueue_scripts', 'Serranova_scripts' );

/**
 * Replaces "[...]" (appended to automatically generated excerpts) with an ellipsis) and sets character length to 35
 */
/**
 * Filter the except length to 20 characters.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function Serranova_custom_excerpt_length( $length )
{
	return 20;
}

add_filter( 'excerpt_length', 'Serranova_custom_excerpt_length', 999 );

/**
 * Filter the excerpt "read more" string.
 *
 * @param string $more "Read more" excerpt string.
 * @return string (Maybe) modified "read more" excerpt string.
 */
function Serranova_excerpt_more( $more )
{
	return '';
}

add_filter( 'excerpt_more', 'Serranova_excerpt_more' );

function Serranova_esc_html( $text )
{
	return strip_tags( $text, '<p><a><i><br><strong><b><em><ul><li><ol><span><h1><h2><h3><h4>' );
}

function Serranova_pagination( $wp_query_object = null )
{
	global $wp_query;
	$query_object = !empty( $wp_query_object ) ? $wp_query_object : $wp_query;
	if ( !is_page() && $query_object->max_num_pages < 2 ) {
		return;
	}
	$big = 999999999; // need an unlikely integer
	echo '<div class="pagination">';
	echo paginate_links( array(
		'base'    => str_replace( $big, '%#%', esc_url( get_pagenum_link( $big ) ) ),
		'format'  => '?paged=%#%',
		'current' => max( 1, get_query_var( 'paged' ) ),
		'total'   => $query_object->max_num_pages
	) );
	echo '</div>';
}


require get_template_directory() . '/inc/template-tags.php';
require get_template_directory() . '/inc/themesetup.php';
require get_template_directory() . '/inc/widgets/author-box.php';
require get_template_directory() . '/inc/widgets/feature-widget.php';
require get_template_directory() . '/inc/widgets/recent-popular.php';
require get_template_directory() . '/inc/customizer.php';