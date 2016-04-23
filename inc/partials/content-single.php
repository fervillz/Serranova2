<?php
/**
 * @package serranova
 */
?>

<div class="row">
		<div class="col-2-3"><div class="wrap-col test postcontent">
        
    <?php the_post_thumbnail( 'serranova-full' ); ?>
        <div id="content">


<h1 class="postcontenttitle"><?php the_title() ?></h1>
<div class="authormeta">
	 Category: <?php the_category( ', ' ) ?> / 
<?php the_tags( 'Tags: ', ', ', '<br />' ); ?> 
</div>
        
<?php
		the_content();
		wp_link_pages( array(
			'before' => '<div class="page-links">' . __( 'Pages:', 'serranova' ),
			'after'  => '</div>',
		) );
		
		edit_post_link( __( 'Edit', 'serranova' ), '<span class="edit-link">', '</span>' );
		?>
        <br>
</div>
<?php comments_template(); ?>
</div>

</div>

