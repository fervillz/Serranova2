<?php
/**
 * The template part for displaying post in certain category.
 *
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package serranova
 */

// WP_Query arguments
$args = array (
	'post_type'              => array( 'post' ),
	'post_status'            => array( 'publish' ),
	'posts_per_page'         => '100',
	'ignore_sticky_posts'    => true,
);

// The Query
$query_serranova = new WP_Query( $args );

?>
<div id="blogposts">
<div class="wrapper">
<div class="row home-posts" style="display: flex; flex-wrap: wrap;">
	
	<?php 

	if ( $query_serranova->have_posts() ) {
		while ( $query_serranova->have_posts() ) {
			$query_serranova->the_post(); ?>
				 

		<div class="col-1-3">
			<div class="wrap-col">
				<div class="blogpost">
					<div class="blogimage">
						<a href="<?php the_permalink();?>" class="blogimagelink">
						<?php if ( has_post_thumbnail() ) {
							the_post_thumbnail( 'serranova-blog-thumb', array( 'class' => 'serranova-featured-image' ) );
								} else { ?>
								<img src="<?php echo esc_url( get_template_directory_uri() ); ?>/images/default.gif" alt="<?php the_title(); ?>" />
						<?php } ?>
						</a>
					</div>
					<!-- Blogimage -->
					<h3 class="blogposttitle"><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h3>
					<div class="blogposttext">
							<?php echo wp_trim_words( get_the_content(), 8, '' ); ?>
					</div>
				</div>
				<!-- Blogpost -->
			</div>
					<!-- end wrap-col -->
			</div>
			<!-- end col-1-3 -->
				<?php }
				}
			 ?>
</div>
<!-- end row -->

<?php wp_reset_postdata(); ?>
</div>
<!-- End Wrapper -->
</div>
<!-- End Wrapper -->
</div>
<!-- End blogposts -->
