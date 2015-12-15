<?php
/*
Plugin Name: Pricing Post Type
Plugin URI: http://www.wptheming.com
Description: Enables a pricing post type and taxonomies.
Version: 0.5
Author: Devin Price
Author URI: http://wptheming.com/pricing-post-type/
License: GPLv2
*/

add_action( 'init', 'pricing_init', 0 );

function pricing_init() {

	/**
	 * Enable the Pricing custom post type
	 * http://codex.wordpress.org/Function_Reference/register_post_type
	 */

	$labels = array(
		'name' => __( 'Pricing', 'pricingposttype' ),
		'singular_name' => __( 'Pricing Item', 'pricingposttype' ),
		'add_new' => __( 'Add New Item', 'pricingposttype' ),
		'add_new_item' => __( 'Add New Pricing Item', 'pricingposttype' ),
		'edit_item' => __( 'Edit Pricing Item', 'pricingposttype' ),
		'new_item' => __( 'Add New Pricing Item', 'pricingposttype' ),
		'view_item' => __( 'View Item', 'pricingposttype' ),
		'search_items' => __( 'Search Pricing', 'pricingposttype' ),
		'not_found' => __( 'No pricing items found', 'pricingposttype' ),
		'not_found_in_trash' => __( 'No pricing items found in trash', 'pricingposttype' )
	);
	
	$args = array(
    	'labels' => $labels,
    	'public' => true,
		'supports' => array( 'title', 'editor', 'excerpt', 'thumbnail', 'comments', 'author', 'custom-fields', 'revisions' ),
		'capability_type' => 'post',
		'rewrite' => array("slug" => "pricing"), // Permalinks format
		'menu_position' => 5,
		'has_archive' => false
	);
	
	$args = apply_filters('pricingposttype_args', $args);

	register_post_type( 'pricing', $args );
	
	/**
	 * Register a taxonomy for Pricing Tags
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	
	/*$taxonomy_pricing_tag_labels = array(
		'name' => _x( 'Pricing Tags', 'pricingposttype' ),
		'singular_name' => _x( 'Pricing Tag', 'pricingposttype' ),
		'search_items' => _x( 'Search Pricing Tags', 'pricingposttype' ),
		'popular_items' => _x( 'Popular Pricing Tags', 'pricingposttype' ),
		'all_items' => _x( 'All Pricing Tags', 'pricingposttype' ),
		'parent_item' => _x( 'Parent Pricing Tag', 'pricingposttype' ),
		'parent_item_colon' => _x( 'Parent Pricing Tag:', 'pricingposttype' ),
		'edit_item' => _x( 'Edit Pricing Tag', 'pricingposttype' ),
		'update_item' => _x( 'Update Pricing Tag', 'pricingposttype' ),
		'add_new_item' => _x( 'Add New Pricing Tag', 'pricingposttype' ),
		'new_item_name' => _x( 'New Pricing Tag Name', 'pricingposttype' ),
		'separate_items_with_commas' => _x( 'Separate pricing tags with commas', 'pricingposttype' ),
		'add_or_remove_items' => _x( 'Add or remove pricing tags', 'pricingposttype' ),
		'choose_from_most_used' => _x( 'Choose from the most used pricing tags', 'pricingposttype' ),
		'menu_name' => _x( 'Pricing Tags', 'pricingposttype' )
	);
	
	$taxonomy_pricing_tag_args = array(
		'labels' => $taxonomy_pricing_tag_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_tagcloud' => true,
		'hierarchical' => false,
		'rewrite' => array( 'slug' => 'pricing_tag' ),
		'show_admin_column' => true,
		'query_var' => true
	);
	
	register_taxonomy( 'pricing_tag', array( 'pricing' ), $taxonomy_pricing_tag_args );*/
	
	/**
	 * Register a taxonomy for Pricing Categories
	 * http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */

    $taxonomy_pricing_category_labels = array(
		'name' => _x( 'Pricing Categories', 'pricingposttype' ),
		'singular_name' => _x( 'Pricing Category', 'pricingposttype' ),
		'search_items' => _x( 'Search Pricing Categories', 'pricingposttype' ),
		'popular_items' => _x( 'Popular Pricing Categories', 'pricingposttype' ),
		'all_items' => _x( 'All Pricing Categories', 'pricingposttype' ),
		'parent_item' => _x( 'Parent Pricing Category', 'pricingposttype' ),
		'parent_item_colon' => _x( 'Parent Pricing Category:', 'pricingposttype' ),
		'edit_item' => _x( 'Edit Pricing Category', 'pricingposttype' ),
		'update_item' => _x( 'Update Pricing Category', 'pricingposttype' ),
		'add_new_item' => _x( 'Add New Pricing Category', 'pricingposttype' ),
		'new_item_name' => _x( 'New Pricing Category Name', 'pricingposttype' ),
		'separate_items_with_commas' => _x( 'Separate pricing categories with commas', 'pricingposttype' ),
		'add_or_remove_items' => _x( 'Add or remove pricing categories', 'pricingposttype' ),
		'choose_from_most_used' => _x( 'Choose from the most used pricing categories', 'pricingposttype' ),
		'menu_name' => _x( 'Pricing Categories', 'pricingposttype' ),
    );
	
    $taxonomy_pricing_category_args = array(
		'labels' => $taxonomy_pricing_category_labels,
		'public' => true,
		'show_in_nav_menus' => true,
		'show_ui' => true,
		'show_admin_column' => true,
		'show_tagcloud' => true,
		'hierarchical' => true,
		'rewrite' => array( 'slug' => 'pricing_category' ),
		'query_var' => true
    );
	
    register_taxonomy( 'pricing_category', array( 'pricing' ), $taxonomy_pricing_category_args );
	
}

 ?>