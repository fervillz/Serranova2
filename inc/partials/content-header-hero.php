<?php
/**
 * The template part for displaying a hero banner on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package serranova
 */

$serranova_display_hero_banner = get_theme_mod( 'serranova_hero_show', 'yes' );
$serranova_display_hero_button1 = get_theme_mod( 'serranova_hero_button1_show', 'yes' );
$serranova_display_hero_button2 = get_theme_mod( 'serranova_hero_button2_show', 'yes' );

if ( $serranova_display_hero_banner === 'yes' ) :
	?>

	<h2><?php echo esc_html( get_theme_mod( 'serranova_hero_title' ) ); ?></h2>

	<?php

	echo '<p class="herotext">' . serranova_esc_html( get_theme_mod( 'serranova_hero_text' ) ) . '</p>';

	echo '<div class="herobuttons">';

	if ( $serranova_display_hero_button1 === 'yes' ) {
		echo '<a href="' . esc_url( get_theme_mod( 'serranova_hero_button1_link', '#' ) ) . '" class="button medium-x">' . esc_html( get_theme_mod( 'serranova_hero_button1_text' ) ) . '</a>';
	}
	if ( $serranova_display_hero_button2 === 'yes' ) {
		echo '<a href="' . esc_url( get_theme_mod( 'serranova_hero_button2_link', '#' ) ) . '" class="button green medium-x">' . esc_html( get_theme_mod( 'serranova_hero_button2_text' ) ) . '</a>';
	}
echo '</div>';
	?>

<?php endif;

?>

<?php
	$serranova_hero_image = get_theme_mod( 'serranova_hero_image', get_template_directory_uri() . '/images/mobile.png' );
?>
<div class="hero-image col-1-3">
	<img src="<?php echo $serranova_hero_image ?>" alt="" />
</div><!-- .hero-image -->