<?php
/**
 * This file has the purpose to help the transitions from an older version of the theme to a new one (specifically to 1.5 from all prior versions).
 */

function krown_update_setup(){

	// When i moved most stlying options out of OptionTree into the WP Theme Customizer i had to redefine all of them. Here's an array of the old OT options which will get into the WP options array on first theme init.

	$old_new_options = array(
		'rb_def_p_page' => 'krown_portfolio_page',
		'rb_modern_blog_ppp' => 'krown_modern_blog_ppp',
		'rb_favicon' => 'krown_fav',
		'rb_404' => 'krown_404_page',
		'rb_logo' => 'krown_logo',
		'rb_logo_x2' => 'krown_logo_x2',
		'rb_logo_width_cc' => 'krown_logo_width',
		'rb_search_sidebars' => 'krown_search_layout',
		'rb_modern_blog_p' => 'krown_modern_blog_p',
		'rb_shop_sidebars' => 'krown_shop_layout',
		'rb_blog_sidebars' => 'krown_blog_layout'
	);

	foreach ( $old_new_options as $old_option => $new_option ) {
		
		if ( ot_get_option( $old_option ) != '' && ! get_option( $new_option ) ) {
			add_option( $new_option, ot_get_option( $old_option ) );
		}

	}

	// Fix all media

	$args = array( 
		'posts_per_page' => -1, 
		'offset'=> 0,
		'post_type' => array( 'portfolio', 'gallery', 'post', 'page' ),
	);

	$all_posts = new WP_Query( $args );
	$i = 0;
	while( $all_posts->have_posts() ) : $all_posts->the_post();
		global $post;
		krown_change_content( $post->ID );
		krown_change_gallery( $post->ID );
	endwhile;
	
}

//add_action( 'init', 'krown_update_setup' );
function krown_change_content( $post_id ) {

	$post = get_post( $post_id );
	$post_content = $post->post_content;

	$new_post_content = str_replace(
		array( 
			'rb_section_title',
			'rb_accordion',
			'ac_section',
			'rb_alert',
			'rb_blank_divider',
			'rb_button',
			'rb_form',
			'rb_flickr',
			'rb_projects',
			'rb_posts',
			'rb_box',
			'rb_custom_posts',
			'rb_lightbox',
			'rb_line',
			'rb_tabs',
			'tb_section',
			'rb_team',
			'rb_testimonial',
			'rb_twitter',
			'rb_divider',
			'rb_cinfo',
			'rb_text_icon',
			'rb_video',
			'rb_stats type="bars"',
			'rb_stats type="pie"',
			'rb_stats',
			'rb_tagline'
		), 
		array( 
			'vc_text_separator',
			'vc_accordion',
			'vc_accordion_tab',
			'vc_message',
			'vc_separator',
			'vc_button',
			'vc_contact_form',
			'vc_flickr',
			'vc_portfolio_grid',
			'vc_posts_grid',
			'vc_promo_box',
			'vc_custom_posts',
			'vc_lightbox',
			'vc_promo_line',
			'vc_tabs',
			'vc_tab',
			'vc_team',
			'vc_testimonial',
			'vc_twitter',
			'vc_separator show_border="yes_boder"',
			'vc_contact_info',
			'vc_icon_text',
			'video',
			'vc_progress_bar',
			'vc_pie',
			'vc_progress_bar',
			'vc_tagline'
		), 
	$post_content );

	return wp_update_post( array( 
		'ID' => $post_id,
		'post_content' => $new_post_content )
	, true);

}

function krown_change_gallery( $post_id ) {

	if ( get_post_meta( $post_id, 'pp_gallery_slider', true ) == '' && ! get_post_meta( $post_id, 'krown_fixed_fgal', true ) == 'fixed' ) {

		$new_gallery_string = '';

		$slider_images = get_post_meta( $post_id, 'rb_folio_slider', true );

		if ( isset( $slider_images ) && ! empty( $slider_images ) ) {

			foreach ( $slider_images as $image ) {

				if ( $image['rb_slide_video_code'] != '' ) {

					// Write about old videos

					add_post_meta( $post_id, 'old_video', 'You had an embedded video in this project.<br><code>' . $image['rb_slide_video_code'] . '</code>' );

				} else if ( $image['rb_slide_video_1'] != '' ) {

					add_post_meta( $post_id, 'old_video', 'You had a self hosted video in this project.<br><code>' . $image['rb_slide_video_1'] . '</code>' );

				} else {

					$attachment_id = pn_get_attachment_id_from_url($image['rb_slide_image']);

					if ( $attachment_id != false ) {
						$new_gallery_string .= $attachment_id . ',';
					}

				}

			}

		}

    	update_post_meta( $post_id, 'pp_gallery_slider', substr( $new_gallery_string, 0, -1 ) );
    	update_post_meta( $post_id, 'krown_fixed_fgal', 'fixed' );

    }

}

// Display update notice if required

add_action( 'admin_notices', 'krown_update_notice' );

function krown_update_notice() {

	if ( get_option( 'krown_updated_20' ) != 'yes' ) {

        echo '<div class="updated">
        	<h3>You have just updated to version 2.0! Please read this carefully before doing anything else!</h3>
        	<ol>
        		<li>Make sure that you read the guide before doing anything else. <a target="_blank" href="http://demo.krownthemes.com/help/goodwork/goodwork-update.pdf">Click here!</a></li>
        		<li>Make sure that you update the Revolution Slider & Visual Composer plugins and also install the Krown Portfolio plugin. <em>Go to Appearance > Install Plugins</em>.</li>
        		<li>After you\'ve done these two steps, please update the content & media, by hitting the button below!</li>
        	</ol>';

        printf(__('<a class="button button-primary" href="%1$s">Update Content & Media</a>'), '?krown_update_done_do=0');

        printf(__('<p><em>If this is a fresh installation, please <strong><a href="%1$s">dismiss this message</a></strong></em></p>'), '?krown_update_done_do=1');

        echo "<p></p></div>";

	}

}
add_action( 'admin_init', 'krown_update_done_do' );

function krown_update_done_do() {
	global $current_user;
    $user_id = $current_user->ID;
    if ( isset( $_GET['krown_update_done_do'] ) && '0' == $_GET['krown_update_done_do'] ) {
        add_option( 'krown_updated_20', 'yes' );
        krown_update_setup();
	} else if ( isset( $_GET['krown_update_done_do'] ) && '1' == $_GET['krown_update_done_do'] ) {
        add_option( 'krown_updated_20', 'yes' );
	}
}


// Function that gets the attachmenet id by url

function pn_get_attachment_id_from_url( $attachment_url = '' ) {
 
	global $wpdb;
	$attachment_id = false;
 
	// If there is no url, return.
	if ( '' == $attachment_url )
		return;
 
	// Get the upload directory paths
	$upload_dir_paths = wp_upload_dir();
 
	// Make sure the upload path base directory exists in the attachment URL, to verify that we're working with a media library image
	if ( false !== strpos( $attachment_url, $upload_dir_paths['baseurl'] ) ) {
 
		// If this is the URL of an auto-generated thumbnail, get the URL of the original image
		$attachment_url = preg_replace( '/-\d+x\d+(?=\.(jpg|jpeg|png|gif)$)/i', '', $attachment_url );
 
		// Remove the upload path base directory from the attachment URL
		$attachment_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $attachment_url );
 
		// Finally, run a custom database query to get the attachment ID from the modified attachment URL
		$attachment_id = $wpdb->get_var( $wpdb->prepare( "SELECT wposts.ID FROM $wpdb->posts wposts, $wpdb->postmeta wpostmeta WHERE wposts.ID = wpostmeta.post_id AND wpostmeta.meta_key = '_wp_attached_file' AND wpostmeta.meta_value = '%s' AND wposts.post_type = 'attachment'", $attachment_url ) );
 
	}
 
	return $attachment_id;
}

/**
 * The shortcodes have changed in version 2.0, so we need to provide backwards compatibily for content created before this version.
 */

// Ignition Deck Shortcodes

function rb_funding_full_function( $atts ) {
	return do_shortcode( '[project_page_widget' . ( isset( $atts['product'] ) ? ' product="' . $atts['product'] . '"' : '' ) . ']' );
}
add_shortcode( 'rb_funding_full', 'rb_funding_full_function' );

function rb_funding_mini_function( $atts ) {
	return do_shortcode( '[project_mini_widget' . ( isset( $atts['product'] ) ? ' product="' . $atts['product'] . '"' : '' ) . ']' );
}
add_shortcode( 'rb_funding_mini', 'rb_funding_mini_function' );

// Some old grids

function column_function( $atts, $content ) {
	return do_shortcode( '[vc_column width="' . $atts['width'] . '"]' . $content . '[/vc_column]' );
}
add_shortcode( 'column', 'column_function' );

?>