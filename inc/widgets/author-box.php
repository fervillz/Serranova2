<?php

/**
 * Adds Serranova_Team_Member_Widget widget.
 */
class Serranova_Author_Box_Widget extends WP_Widget
{

	public function __construct()
	{
		parent::__construct(
			'Serranova-author-box-widget',
			__( 'Author Box Widget', 'Serranova' ),
			array(
				'description' => __( 'Author box widget for the sidebar', 'Serranova' ),
			)
		);
	}

	private function showSocialIfSet( $instance, $authorId, $property )
	{
		return !empty( $instance['social_' . $property . '-' . $authorId] ) ? '<li><a href="' . esc_url( $instance['social_' . $property . '-' . $authorId] ) . '"><i class="fa fa-' . $property . '"></i></a></li>' : '';
	}

	/**
	 * Front-end display of widget.
	 *
	 * @see WP_Widget::widget()
	 *
	 * @param array $args Widget arguments.
	 * @param array $instance Saved values from database.
	 */
	public function widget( $args, $instance )
	{
		global $post;
		if ( empty( $post ) ) return;
		if ( is_single() || is_page() ) {
			$authorId = $post->post_author;

		} else {
			$authorId = get_user_by( 'email', get_bloginfo( 'admin_email' ) )->ID;
		}

		echo '<div class="authorwidget sidebarwidget">';
		echo '<span><img src="' . esc_url( ( !empty( $instance['image_url-' . $authorId] ) ) ? $instance['image_url-' . $authorId] : get_template_directory_uri() . '/images/author_profile.png' ) . '"  width="371" height="267" class="authorphoto" alt="author"></span>';
		echo $args['before_title'] . esc_html( ( !empty( $instance['title-' . $authorId] ) ) ? $instance['title-' . $authorId] : '' ) . $args['after_title'];
		echo '<p>' . strip_tags( ( ( !empty( $instance['textbox-' . $authorId] ) ) ? $instance['textbox-' . $authorId] : '' ), '<a><span><i><em><strong><b><ul><ol><li><br>' ) . '</p>';

		echo '<ul>';
		echo $this->showSocialIfSet( $instance, $authorId, 'facebook' );
		echo $this->showSocialIfSet( $instance, $authorId, 'twitter' );
		echo $this->showSocialIfSet( $instance, $authorId, 'pinterest' );
		echo $this->showSocialIfSet( $instance, $authorId, 'linkedin' );
		echo $this->showSocialIfSet( $instance, $authorId, 'drupal' );
		echo $this->showSocialIfSet( $instance, $authorId, 'wordpress' );
		echo $this->showSocialIfSet( $instance, $authorId, 'y-combinator' );
		echo $this->showSocialIfSet( $instance, $authorId, 'google-plus' );
		echo $this->showSocialIfSet( $instance, $authorId, 'behance' );
		echo $this->showSocialIfSet( $instance, $authorId, 'dribbble' );
		echo $this->showSocialIfSet( $instance, $authorId, 'flickr' );
		echo $this->showSocialIfSet( $instance, $authorId, '500px' );
		echo $this->showSocialIfSet( $instance, $authorId, 'reddit' );
		echo $this->showSocialIfSet( $instance, $authorId, 'youtube' );
		echo $this->showSocialIfSet( $instance, $authorId, 'soundcloud' );
		echo $this->showSocialIfSet( $instance, $authorId, 'medium' );
		echo '</ul>';

		echo '</div>';

	}

	/**
	 * Sanitize widget form values as they are saved.
	 *
	 * @see WP_Widget::update()
	 *
	 * @param array $new_instance Values just sent to be saved.
	 * @param array $old_instance Previously saved values from database.
	 *
	 * @return array Updated safe values to be saved.
	 */
	public function update( $new_instance, $old_instance )
	{
		$userId = (int)$new_instance['author'];
		$instance = array();
		$fields = array(
			'title'               => 'sanitize_text_field',
			'textbox'             => 'strip_tags',
			'image_url'           => 'esc_url',
			'social_twitter'      => 'esc_url',
			'social_facebook'     => 'esc_url',
			'social_dribbble'     => 'esc_url',
			'social_pinterest'    => 'esc_url',
			'social_linkedin'     => 'esc_url',
			'social_drupal'       => 'esc_url',
			'social_wordpress'    => 'esc_url',
			'social_y-combinator' => 'esc_url',
			'social_google-plus'  => 'esc_url',
			'social_behance'      => 'esc_url',
			'social_flickr'       => 'esc_url',
			'social_500px'        => 'esc_url',
			'social_reddit'       => 'esc_url',
			'social_youtube'      => 'esc_url',
			'social_soundcloud'   => 'esc_url',
			'social_medium'       => 'esc_url',
		);
		foreach ( $fields as $field => $sanitization ) {
			$field .= '-' . $userId;
			if ( $sanitization === 'strip_tags' ) {
				$instance[$field] = $sanitization( $new_instance[$field], '<a><span><i><em><strong><b><ul><ol><li><br>' );
			} else {
				$instance[$field] = $sanitization( $new_instance[$field] );
			}
		};

		return array_merge( $new_instance, $instance );
	}

	/**
	 * Back-end widget form.
	 *
	 * @see WP_Widget::form()
	 *
	 * @param array $instance Previously saved values from database.
	 */
	public function form( $instance )
	{
		echo '<div class="Serranova-author-box-widget-container">';
		echo '<label for="author">' . __( 'Settings for author: ', 'Serranova' ) . '</label>';
		// show only admin user - author box widget will always display admin info
		$admin = get_user_by( 'email', get_option( 'admin_email' ) );
		wp_dropdown_users( array( 'name' => 'author', 'include' => $admin->ID ) );
		$users = get_users();
		$i = 0;
		$showUserId = 0;
		foreach ( $users as $user ):
			if ( $i === 0 ) {
				$showUserId = $user->ID;
				$i++;
			}
			$title = ( isset( $instance['title-' . $user->ID] ) ) ? $instance['title-' . $user->ID] : __( 'AUTHOR PROFILE', 'Serranova' );
			$textbox = ( isset( $instance['textbox-' . $user->ID] ) ) ? $instance['textbox-' . $user->ID] : __( 'About the author text', 'Serranova' );
			$image_url = ( isset ( $instance['image_url-' . $user->ID] ) ) ? $instance['image_url-' . $user->ID] : get_template_directory_uri() . '/images/author_profile.png';
			$social_twitter = ( isset ( $instance['social_twitter-' . $user->ID] ) ) ? $instance['social_twitter-' . $user->ID] : '';
			$social_facebook = ( isset ( $instance['social_facebook-' . $user->ID] ) ) ? $instance['social_facebook-' . $user->ID] : '';
			$social_dribbble = ( isset ( $instance['social_dribbble-' . $user->ID] ) ) ? $instance['social_dribbble-' . $user->ID] : '';
			$social_pinterest = ( isset ( $instance['social_pinterest-' . $user->ID] ) ) ? $instance['social_pinterest-' . $user->ID] : '';
			$social_linkedin = ( isset ( $instance['social_linkedin-' . $user->ID] ) ) ? $instance['social_linkedin-' . $user->ID] : '';
			$social_drupal = ( isset ( $instance['social_drupal-' . $user->ID] ) ) ? $instance['social_drupal-' . $user->ID] : '';
			$social_wordpress = ( isset ( $instance['social_wordpress-' . $user->ID] ) ) ? $instance['social_wordpress-' . $user->ID] : '';
			$social_ycombinator = ( isset ( $instance['social_y-combinator-' . $user->ID] ) ) ? $instance['social_y-combinator-' . $user->ID] : '';
			$social_gplus = ( isset ( $instance['social_google-plus-' . $user->ID] ) ) ? $instance['social_google-plus-' . $user->ID] : '';
			$social_behance = ( isset ( $instance['social_behance-' . $user->ID] ) ) ? $instance['social_behance-' . $user->ID] : '';
			$social_500px = ( isset ( $instance['social_500px-' . $user->ID] ) ) ? $instance['social_500px-' . $user->ID] : '';
			$social_flickr = ( isset ( $instance['social_flickr-' . $user->ID] ) ) ? $instance['social_flickr-' . $user->ID] : '';
			$social_reddit = ( isset ( $instance['social_reddit-' . $user->ID] ) ) ? $instance['social_reddit-' . $user->ID] : '';
			$social_youtube = ( isset ( $instance['social_youtube-' . $user->ID] ) ) ? $instance['social_youtube-' . $user->ID] : '';
			$social_soundcloud = ( isset ( $instance['social_soundcloud-' . $user->ID] ) ) ? $instance['social_soundcloud-' . $user->ID] : '';
			$social_medium = ( isset ( $instance['social_medium-' . $user->ID] ) ) ? $instance['social_medium-' . $user->ID] : '';
			?>
			<div id="Serranova-author-box-settings-<?php echo $user->ID; ?>" class="hidden"
				 style="<?php if ( $showUserId === $user->ID ): ?>display: block;<?php endif; ?>">

				<p>
					<label
						for="<?php echo $this->get_field_id( 'title-' . $user->ID ); ?>"><?php _e( 'Title', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'title-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'title-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $title ); ?>"/>
				</p>

				<p>
					<label
						for="<?php echo $this->get_field_id( 'textbox-' . $user->ID ); ?>"><?php _e( 'About:', 'Serranova' ); ?></label>
					<textarea class="widefat" id="<?php echo $this->get_field_id( 'textbox-' . $user->ID ); ?>"
							  name="<?php echo $this->get_field_name( 'textbox-' . $user->ID ); ?>"><?php echo esc_attr( $textbox ); ?></textarea>
				</p>

				<p>
					<label
						for="<?php echo $this->get_field_id( 'social_twitter-' . $user->ID ); ?>"><?php _e( 'Twitter url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_twitter-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_twitter-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_twitter ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_facebook-' . $user->ID ); ?>"><?php _e( 'Facebook url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_facebook-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_facebook-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_facebook ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_dribbble-' . $user->ID ); ?>"><?php _e( 'Dribbble url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_dribbble-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_dribbble-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_dribbble ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_pinterest-' . $user->ID ); ?>"><?php _e( 'Pinterest url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_pinterest-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_pinterest-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_pinterest ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_linkedin-' . $user->ID ); ?>"><?php _e( 'Linkedin url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_linkedin-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_linkedin-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_linkedin ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_drupal-' . $user->ID ); ?>"><?php _e( 'Drupal url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_drupal-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_drupal-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_drupal ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_wordpress-' . $user->ID ); ?>"><?php _e( 'Wordpress url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_wordpress-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_wordpress-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_wordpress ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_y-combinator-' . $user->ID ); ?>"><?php _e( 'Y-combinator url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_y-combinator-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_y-combinator-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_ycombinator ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_google-plus-' . $user->ID ); ?>"><?php _e( 'Google+ url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_google-plus-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_google-plus-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_gplus ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_behance-' . $user->ID ); ?>"><?php _e( 'Behance url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_behance-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_behance-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_behance ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_500px-' . $user->ID ); ?>"><?php _e( '500px url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_500px-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_500px-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_500px ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_flickr-' . $user->ID ); ?>"><?php _e( 'Flickr url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_flickr-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_flickr-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_flickr ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_reddit-' . $user->ID ); ?>"><?php _e( 'Reddit url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_reddit-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_reddit-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_reddit ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_youtube-' . $user->ID ); ?>"><?php _e( 'Youtube url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_youtube-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_youtube-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_youtube ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_soundcloud-' . $user->ID ); ?>"><?php _e( 'Soundcloud url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_soundcloud-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_soundcloud-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_soundcloud ); ?>"/>

					<label
						for="<?php echo $this->get_field_id( 'social_medium-' . $user->ID ); ?>"><?php _e( 'Medium url', 'Serranova' ); ?></label>
					<input class="widefat" id="<?php echo $this->get_field_id( 'social_medium-' . $user->ID ); ?>"
						   name="<?php echo $this->get_field_name( 'social_medium-' . $user->ID ); ?>" type="text"
						   value="<?php echo esc_attr( $social_medium ); ?>"/>
				</p>

				<p>
					<label
						for="<?php echo $this->get_field_id( 'image_url-' . $user->ID ); ?>"><?php _e( 'Image:', 'Serranova' ); ?></label><br/>
					<input type="text" class="img"
						   name="<?php echo $this->get_field_name( 'image_url-' . $user->ID ); ?>"
						   id="<?php echo $this->get_field_id( 'image_url-' . $user->ID ); ?>"
						   value="<?php echo esc_attr( $image_url ); ?>"/>
					<input type="button" class="Serranova-select-img"
						   value="<?php _e( 'Select Image', 'Serranova' ); ?>"/>
				</p>
			</div>
		<?php
		endforeach;
		echo '<input type="hidden" id="Serranova-current-author" name="' . $this->get_field_name( 'author' ) . '" value="' . $users[0]->ID . '">';
		echo '</div>';
	}


}

// init the widget
function Serranova_register_author_box_widget()
{
	register_widget( 'Serranova_Author_Box_Widget' );
}

add_action( 'widgets_init', 'Serranova_register_author_box_widget' );

// queue up the necessary js
function Serranova_author_box_widget_script_enqueue()
{
	wp_enqueue_style( 'thickbox' );
	wp_enqueue_script( 'media-upload' );
	wp_enqueue_script( 'thickbox' );
	wp_enqueue_script( 'Serranova_author_box_widget_js', get_template_directory_uri() . '/inc/js/widget-author-box.js', null, null, true );
}

add_action( 'admin_enqueue_scripts', 'Serranova_author_box_widget_script_enqueue' );