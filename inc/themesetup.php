<?php

function serranova_load_theme_fonts()
{
	$heading = get_theme_mod( 'serranova_google_fonts_heading_font' );
	$body = get_theme_mod( 'serranova_google_fonts_body_font' );
	if ( ( !empty( $heading ) && $heading != 'none' ) || ( !empty( $body ) && $body != 'none' ) ) {
		echo '<style type="text/css">';
		$imports = array();
		$styles = array();
		if ( !empty( $heading ) && $heading != 'none' ) {
			$imports[] = '@import url(//fonts.googleapis.com/css?family=' . urlencode( $heading ) . ');';
			$styles[] = 'h1, h2, h3, h4, h5, h6 { font-family: "' . $heading . '" !important }';
		}
		if ( !empty( $body ) && $body != 'none' ) {
			$imports[] = '@import url(//fonts.googleapis.com/css?family=' . urlencode( $body ) . ');';
			$styles[] = 'body, .herotext, .herobuttons .button { font-family: "' . $body . '" !important }';
		}

		echo implode( "\r\n", $imports );
		echo implode( "\r\n", $styles );
		echo '</style>';

	}
}
add_action( 'wp_head', 'serranova_load_theme_fonts' );

// load colors
function serranova_load_theme_colors()
{

	$bodyBackgroundColor = get_theme_mod( 'serranova_body_background_color', '#ffffff;' );
	$accentColor = get_theme_mod( 'serranova_accent_color', '#bbf3cc' );
	$heroImageOverlayColor = get_theme_mod( 'serranova_hero_overlay_color', '#282d1f' );
	$heroImageOverlayOpacity = get_theme_mod( 'serranova_hero_overlay_opacity', '90' );
	$heroImageBlur = get_theme_mod( 'serranova_hero_blur_enabled', '0' );
	$hero_image_bg = get_theme_mod( 'serranova_hero_bg_image' );
	echo '<style type="text/css">';

	if ( !empty( $bodyBackgroundColor ) ) {
		$hash = '';
		if ( strpos( $bodyBackgroundColor, '#' ) === false ) {
			$hash = '#';
		}
		echo 'body { background-color: ' . $hash . $bodyBackgroundColor . '}';
	}


	if ( !empty( $accentColor ) ) {
		$hash = '';
		if ( strpos( $accentColor, '#' ) === false ) {
			$hash = '#';
		}
		echo '.blogposttitle a:hover, a,  .blogpostmeta .fa, .socialmediamenu .fa, .profile_cont .fa, .herotext a, .postcontentmeta .fa, #hero .fa, .authormeta a, .post-edit-link, #content a, #cssmenu li:hover a, .sidebarwidget ul li .faf { color: ' . $hash . $accentColor . '} ';
		echo  '#hero, #footer #bottom { border-color: ' . $hash . $accentColor . '} ';
		echo '.postmeta li a:hover, .blogpostmeta a:hover, .postcontentmeta a:hover, .sidebarwidget .fa:hover, .sidebarwidget li a:hover, #bottom a:hover {color: ' . $hash . $accentColor . '} ';
		echo '.page-links a, a.comment-reply-link, input[type="submit"], .tab_head li:hover, .blogimage .fa, .search input.submit, .tab_head li:hover, .tab_head li.active, #hero .green{background-color: ' . $hash . $accentColor . '} ';
		echo '::selection {background-color: ' .$hash.$accentColor. '}';
		echo '*::-moz-selection {background-color: ' .$hash.$accentColor. '}';
		//echo '.menu-item.has-sub a::before, .menu-item.has-sub a::after {background: ' .$hash . $accentColor. ' !important;}';
		echo 'h1.site-title, .postcontent a:hover, .footerwidget a:hover, .authormeta a:hover, .post-edit-link:hover, #hero .button.seethrough, .sidebarwidget a:hover, .tab_cont .clear, .logged-in-as a:hover {border-color: ' . $hash . $accentColor . ' } ';
		echo '.tab_head li:hover a {color: #fff !important;}';
	}
	echo '#hero .hero-overlay {background-color: '.$heroImageOverlayColor.'; opacity: '.round($heroImageOverlayOpacity / 100, 2).'}';
	echo '#hero .hero-bg {filter: blur('.$heroImageBlur.'px); -webkit-filter: blur('.$heroImageBlur.'px);}';
	echo '#hero .hero-bg { background-image: ' . ( $hero_image_bg ? 'url(' . $hero_image_bg . ')' : 'none' ) . '}';
	echo '</style>';
}

add_action( 'wp_head', 'serranova_load_theme_colors' );