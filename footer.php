<?php 
//Image
$serranova_footer_image = get_theme_mod( 'serranova_footer_image', get_template_directory_uri() . '/images/laptop.png' ); 
//Titles
$serranova_footer_title_l = get_theme_mod( 'serranova_footer_title_l' );
$serranova_footer_title_r = get_theme_mod( 'serranova_footer_title_r' );
//Sub Texts
$serranova_footer_text_l = get_theme_mod( 'serranova_footer_text_l' );
$serranova_footer_text_r = get_theme_mod( 'serranova_footer_text_r' );
?>



<div id="footer">	
	<div class="top">
		<div class="wrapper">
			<div class="row">
				<div class="col-1-1">
					<div class="wrap-col footer-feature ">
						<div class="footer-feature-1">
							<h3>
								<?php echo $serranova_footer_title_l; ?>
							</h3>
							<div class="desc">
								<p><?php echo $serranova_footer_text_l; ?></p>
							</div><!-- .desc -->
						</div><!-- .footer-feature -->
						<div class="footer-feature-2">
							<img src="<?php echo $serranova_footer_image ?>" alt="" />
						</div><!-- .footer-feature -->	
						<div class="footer-feature-3">
							<h3>
								<?php echo $serranova_footer_title_r; ?>
							</h3>
							<div class="desc">
								<p><?php echo $serranova_footer_text_r; ?></p>
							</div><!-- .desc -->
						</div><!-- .footer-feature -->	
					</div><!-- .wrap-col -->
				</div>
			</div>
		</div>
	</div><!-- .top -->
	
<div id="bottom">
	<div class="wrapper">
	<div class="col-1-4">
				<div class="wrap-col">
		<?php
		$serranova_display_footer_logo = get_theme_mod( 'serranova_footer_logo_show', 'no' );
		if ( $serranova_display_footer_logo === 'yes' ) {
			echo '<a href="' . home_url() . '"><img src="' . esc_url( get_theme_mod( 'serranova_footer_logo_image' ) ) . '" class="bottomlogo"></a>';
			echo '<span class="bottomlogo" style="display: none;">&nbsp;</span>';
		} else {
			echo '<a href="' . home_url() . '" style="display: none;"><img src="' . esc_url( get_theme_mod( 'serranova_footer_logo_image' ) ) . '" class="bottomlogo"></a>';
			echo '<span class="bottomlogo">&nbsp;</span>';
		}
		?>
		<p class="bottomtext">
			Copyright &copy; 2011 - <?php echo date( 'Y' ); ?> <?php bloginfo( 'name' ); ?> <?php printf( __( 'Theme %1$s %2$s.', 'serranova' ), '<br>', '<a href="http://wplift.com" rel="designer">Kooc Media Ltd</a>' ); ?> All rights reserved.
		</p>
		</div>
			</div>

		<?php
			global $wp_customize;
			if ( !empty( $wp_customize ) && $wp_customize->is_preview() && !get_theme_mod( 'serranova_content_set', false ) ) {

				the_widget(
					'WP_Widget_Text', array(
						'title' => 'TEXT WIDGET',
						'text'  => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' ),
					array(
						'before_widget' => '<div class="col-1-4"><div class="wrap-col"><div class="footerwidget">',
						'after_widget'  => '</div></div></div>',
						'before_title'  => '<h6 class="widget-title">',
						'after_title'   => '</h6>',
					) );
				the_widget(
					'WP_Widget_Text', array(
						'title' => 'TEXT WIDGET',
						'text'  => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' ),
					array(
						'before_widget' => '<div class="col-1-4"><div class="wrap-col"><div class="footerwidget">',
						'after_widget'  => '</div></div></div>',
						'before_title'  => '<h6 class="widget-title">',
						'after_title'   => '</h6>',
					) );

				the_widget(
					'WP_Widget_Text', array(
						'title' => 'TEXT WIDGET',
						'text'  => 'Lorem ipsum dolor sit amet, <a href="#">consectetur adipiscing elit</a>. Etiam aliquam, risus non vehicula vestibulum, purus tortor tempor mauris, consectetur semper tortor dolor sed mauris. Morbi nunc ipsum' ),
					array(
						'before_widget' => '<div class="col-1-4"><div class="wrap-col"><div class="footerwidget">',
						'after_widget'  => '</div></div></div>',
						'before_title'  => '<h6 class="widget-title">',
						'after_title'   => '</h6>',
					) );
			} else if ( is_active_sidebar( 'serranova-footer' ) ) {
				dynamic_sidebar( 'serranova-footer' );
			}
			?>
	</div>
	<!-- End wrapper -->
</div>
</div>
<?php wp_footer(); ?>
</body>
</html>