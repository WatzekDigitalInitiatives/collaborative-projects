<?php

if(function_exists('vc_set_as_theme')) {

	// Activate Visual Composer theme mode

	vc_set_as_theme( true );
	
	// Set templates directory

	vc_set_template_dir( get_template_directory() . '/includes/extend-vc/vc_templates/');

	// Include proper files

	include( 'dependencies.php' );
	include( 'map.php' );
	include( 'shortcode-functions.php' );
	include( 'shortcodes.php' );

	// Remove some of the elements
	
	vc_remove_element('vc_carousel');
	vc_remove_element('vc_cta_button');
	vc_remove_element('vc_cta_button2');
	vc_remove_element('vc_button2');
	vc_remove_element('vc_facebook');
	vc_remove_element('vc_gallery');
	vc_remove_element('vc_googleplus');
	vc_remove_element('vc_images_carousel');
	vc_remove_element('vc_item');
	vc_remove_element('vc_items');
	vc_remove_element('vc_pinterest');
	vc_remove_element('vc_posts_slider');
	vc_remove_element('vc_toggle');
	vc_remove_element('vc_tweetmeme');
	vc_remove_element('vc_video');
	vc_remove_element('vc_tour');
	vc_remove_element('vc_gmaps'); 
	vc_remove_element('vc_single_image');

	// Replace the classes for the vc_row and vc_column shortcodes

	function custom_css_classes_for_vc_row_and_vc_column( $class_string, $tag ) {

		if ($tag=='vc_row' || $tag=='vc_row_inner') {
			$class_string = str_replace('wpb_row vc_row-fluid', 'krown-column-row', $class_string);
		}

		if ($tag=='vc_column' || $tag=='vc_column_inner') {
			$class_string = preg_replace('/vc_span(\d{1,2})/', 'span$1', $class_string);
			$class_string = str_replace('wpb_column', 'krown-column-container clearfix', $class_string);
		}

		return $class_string;

	}

	add_filter('vc_shortcodes_css_class', 'custom_css_classes_for_vc_row_and_vc_column', 10, 2);

}

?>