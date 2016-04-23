<?php
/**
 * The template part for displaying social links on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Serranova
 */

$Serranova_display_social_links = get_theme_mod( 'Serranova_header_social_show', 'yes' );

if ( $Serranova_display_social_links === 'yes' ) :
	$Serranova_facebook_url = get_theme_mod( 'Serranova_header_social_facebook' );
	$Serranova_twitter_url = get_theme_mod( 'Serranova_header_social_twitter' );
	$Serranova_pinterest_url = get_theme_mod( 'Serranova_header_social_pinterest' );
	$Serranova_linkedin_url = get_theme_mod( 'Serranova_header_social_linkedin' );
	$Serranova_gplus_url = get_theme_mod( 'Serranova_header_social_gplus' );
	$Serranova_behance_url = get_theme_mod( 'Serranova_header_social_behance' );
	$Serranova_dribbble_url = get_theme_mod( 'Serranova_header_social_dribbble' );
	$Serranova_flickr_url = get_theme_mod( 'Serranova_header_social_flickr' );
	$Serranova_500px_url = get_theme_mod( 'Serranova_header_social_500px' );
	$Serranova_reddit_url = get_theme_mod( 'Serranova_header_social_reddit' );
	$Serranova_wordpress_url = get_theme_mod( 'Serranova_header_social_wordpress' );
	$Serranova_youtube_url = get_theme_mod( 'Serranova_header_social_youtube' );
	$Serranova_soundcloud_url = get_theme_mod( 'Serranova_header_social_soundcloud' );
	$Serranova_medium_url = get_theme_mod( 'Serranova_header_social_medium' );

	?>

		<ul class="socialmediamenu">
		<?php
		if ( !empty( $Serranova_facebook_url ) ) {
			echo '<li class="facebook"><a href="' . esc_url( $Serranova_facebook_url ) . '"><i class="fa fa-facebook"></i></a></li>';
		}
		if ( !empty( $Serranova_twitter_url ) ) {
			echo '<li class="twitter"><a href="' . esc_url( $Serranova_twitter_url ) . '"><i class="fa fa-twitter"></i></a></li>';
		}
		if ( !empty( $Serranova_pinterest_url ) ) {
			echo '<li class="pinterest"><a href="' . esc_url( $Serranova_pinterest_url ) . '"><i class="fa fa-pinterest"></i></a></li>';
		}
		if ( !empty( $Serranova_linkedin_url ) ) {
			echo '<li class="linkedin"><a href="' . esc_url( $Serranova_linkedin_url ) . '"><i class="fa fa-linkedin"></i></a></li>';
		}
		if ( !empty( $Serranova_gplus_url ) ) {
			echo '<li class="gplus"><a href="' . esc_url( $Serranova_gplus_url ) . '"><i class="fa fa-google-plus"></i></a></li>';
		}
		if ( !empty( $Serranova_behance_url ) ) {
			echo '<li class="behance"><a href="' . esc_url( $Serranova_behance_url ) . '"><i class="fa fa-behance"></i></a></li>';
		}
		if ( !empty( $Serranova_dribbble_url ) ) {
			echo '<li class="dribbble"><a href="' . esc_url( $Serranova_dribbble_url ) . '"><i class="fa fa-dribbble"></i></a></li>';
		}
		if ( !empty( $Serranova_flickr_url ) ) {
			echo '<li class="flickr"><a href="' . esc_url( $Serranova_flickr_url ) . '"><i class="fa fa-flickr"></i></a></li>';
		}
		if ( !empty( $Serranova_500px_url ) ) {
			echo '<li class="social500px"><a href="' . esc_url( $Serranova_500px_url ) . '"><i class="fa fa-500px"></i></a></li>';
		}
		if ( !empty( $Serranova_reddit_url ) ) {
			echo '<li class="reddit"><a href="' . esc_url( $Serranova_reddit_url ) . '"><i class="fa fa-reddit"></i></a></li>';
		}
		if ( !empty( $Serranova_wordpress_url ) ) {
			echo '<li class="wordpress"><a href="' . esc_url( $Serranova_wordpress_url ) . '"><i class="fa fa-wordpress"></i></a></li>';
		}
		if ( !empty( $Serranova_youtube_url ) ) {
			echo '<li class="youtube"><a href="' . esc_url( $Serranova_youtube_url ) . '"><i class="fa fa-youtube"></i></a></li>';
		}
		if ( !empty( $Serranova_soundcloud_url ) ) {
			echo '<li class="soundcloud"><a href="' . esc_url( $Serranova_soundcloud_url ) . '"><i class="fa fa-soundcloud"></i></a></li>';
		}
		if ( !empty( $Serranova_medium_url ) ) {
			echo '<li class="medium"><a href="' . esc_url( $Serranova_medium_url ) . '"><i class="fa fa-medium"></i></a></li>';
		}
		?>
	</ul>

<?php endif;