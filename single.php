<?php
/**
 * The single post template file.
 *
 * @package serranova
 */


while ( have_posts() ) :
	the_post();
	get_header('inside');
endwhile;
?>
<div class="insideposts">

<div class="wrapper">
<?php
				while ( have_posts() ) :
					the_post();
					get_template_part( 'inc/partials/content', 'single' );
				endwhile;
			?>

			<?php get_sidebar(); ?>
</div>
<?php get_footer();