<?php
/**
 * Template Name: Crowdfunding
 */
get_header();

	if ( have_posts() ) the_post();

		the_content();

		if ( comments_open() && ot_get_option( 'rb_allow_page_comments', 'false' ) == 'true') {
			comments_template( '', true );
		}

get_footer(); ?>