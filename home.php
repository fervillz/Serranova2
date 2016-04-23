<?php
/**
 * Template name: Homepage
 *
 * The main template file.
 *
 * @package Serranova
 */

get_header();

get_template_part( 'inc/partials/content', 'home-features' );
get_template_part( 'inc/partials/content', 'home-posts' );

get_footer();