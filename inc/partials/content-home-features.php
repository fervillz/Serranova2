<?php
/**
 * The template part for displaying sub features section on the front page.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package Serranova
 */

?>
<div class="wrapper featurearea">
<div class="row">


		<?php
		if ( is_active_sidebar( 'Serranova-features' ) ) {
			dynamic_sidebar( 'Serranova-features' );
		}
		?>
 </div><!-- End featurearea -->
</div><!-- End featurearea -->
