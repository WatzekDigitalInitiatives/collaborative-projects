<?php


/*---------------------------------
	Setup OptionTree
------------------------------------*/

add_filter( 'ot_show_pages', '__return_false' );
add_filter( 'ot_theme_mode', '__return_true' );
require_once( 'option-tree/ot-loader.php' );

function filter_ot_upload_text(){
	return __( 'Insert', 'goodwork' );
}
function filter_ot_header_list(){
	echo '<li id="option-tree-version"><span>' . __( 'Goodwork Options', 'goodwork' ) . '</span></li>';
}
function filter_ot_header_version_text(){
	return '3.2.2';
}

add_filter( 'ot_header_list', 'filter_ot_header_list' );
add_filter( 'ot_upload_text', 'filter_ot_upload_text' );
add_filter( 'ot_header_version_text', 'filter_ot_header_version_text');

/*---------------------------------
	Include other functions and classes
------------------------------------*/

include('includes/krown-update.php');
include('includes/widget.php');
include('includes/theme-options.php');
include('includes/customizer-options.php');
include('includes/custom-styles.php');
include('includes/metaboxes.php');
include('includes/pricing.php');
include('includes/aq_resizer.php');
include('includes/plugins.php');
include('includes/portfolio-functions.php');
include('includes/woocommerce.php');
include('includes/extend-vc/init.php');
include('includes/extend-ot.php');

/*---------------------------------
	Make some adjustments on theme setup
------------------------------------*/

if ( ! function_exists( 'krown_setup' ) ) {

	function krown_setup() {

		// Add more widget areas based on user settings

		$sidebars = ot_get_option( 'rb_sidebars' );
		if ( ! empty( $sidebars ) ) {
			foreach ( $sidebars as $sidebar ) {
				register_sidebar( array(
					'name' => $sidebar['title'],
					'id' => $sidebar['id'],
					'description' => '',
					'before_widget' => '<section id="%1$s" class="widget sidebox %2$s clearfix">',
					'after_widget' => '</section>',
					'before_title' => '<div class="widget-title"><h4>',
					'after_title' => '</h4></div>',
				) );
			}
		}

		// Setup radio images for metaboxes (action)

		add_filter( 'ot_radio_images', 'filter_radio_images', 10, 2 );
		
		// Setup theme update with PIXELENTITY's class
			
		if( ot_get_option( 'krown_updates_user' ) != '' && ot_get_option( 'krown_updates_api' ) != '' ){

			require_once( 'pixelentity-theme-update/class-pixelentity-theme-update.php' );
			PixelentityThemeUpdate::init( ot_get_option( 'krown_updates_user' ), ot_get_option( 'krown_updates_api' ), 'KrownThemes' );

		}

		// Make theme available for translation

		load_theme_textdomain( 'goodwork', get_template_directory() . '/lang' );
	
		$locale = get_locale();
		$locale_file = get_template_directory() . "/lang/$locale.php";

		if ( is_readable( $locale_file ) ) {
			require_once( $locale_file );
		}
	
		// Define content width (stupid feature, this theme has no width)

		if( ! isset( $content_width ) ) {
			$content_width = 940;
		}
		
		// Add RSS feed links to head

		add_theme_support( 'automatic-feed-links' );

		// Enable excerpts for pages

		add_post_type_support( 'page', 'excerpt' );

		// Enable shortcodes inside text widgets

		add_filter('widget_text', 'do_shortcode');

		// Add post formats support

		add_theme_support( 'post-formats', array( 'image', 'quote', 'gallery', 'video', 'audio', 'link' ) );
			
		// Add primary navigation 

		register_nav_menus( array(
			'primary' => __( 'Primary Navigation', 'goodwork' ),
		) );
		
	}

}

add_action( 'after_setup_theme', 'krown_setup' );

/*---------------------------------
	Setup radio images for metaboxes (function)
------------------------------------*/

function filter_radio_images( $array, $field_id ) {

	if ( $field_id == 'rb_meta_box_sidebar_layout' ) {
		$array = array(
			array(
				'value'   => 'full-width',
				'label'   => __( 'Full Width', 'option-tree' ),
				'src'     => OT_URL . '/assets/images/layout/full-width.png'
			),
			array(
				'value'   => 'right-sidebar',
				'label'   => __( 'Right Sidebar', 'option-tree' ),
				'src'     => OT_URL . '/assets/images/layout/right-sidebar.png'
			),
			array(
				'value'   => 'left-sidebar',
				'label'   => __( 'Left Sidebar', 'option-tree' ),
				'src'     => OT_URL . '/assets/images/layout/left-sidebar.png'
			)
		);
	}

	return $array;
  
}

/*---------------------------------
	Insert analytics code into the footer
------------------------------------*/

if ( ! function_exists( 'krown_analytics' ) ) {

	function krown_analytics() {
		echo ot_get_option( 'krown_tracking' );
	}

}

add_filter( 'wp_footer', 'krown_analytics' );

/*---------------------------------
	Make some changes to the wp_title function
------------------------------------*/

if ( ! function_exists( 'krown_filter_wp_title' ) ) {

	function krown_filter_wp_title( $title, $separator ) {

		if ( is_feed() ) return $title;
			
		global $paged, $page;

		if ( is_search() ) {
		
			$title = sprintf( __( 'Search results for %s', 'goodwork' ), '"' . get_search_query() . '"' );

			if ( $paged >= 2 ) {
				$title .= " $separator " . sprintf( __( 'Page %s', 'goodwork' ), $paged );
			}

			$title .= " $separator " . get_bloginfo( 'name', 'display' );

			return $title;

		}

		$title .= get_bloginfo( 'name', 'display' );

		$site_description = get_bloginfo( 'description', 'display' );

		if ( $site_description && ( is_home() || is_front_page() ) ) {
			$title .= " $separator " . $site_description;
		}

		if ( $paged >= 2 || $page >= 2 ) {
			$title .= " $separator " . sprintf( __( 'Page %s', 'goodwork' ), max( $paged, $page ) );
		}

		return $title;

	}

}

add_filter( 'wp_title', 'krown_filter_wp_title', 10, 2 );

/*---------------------------------
	Create a wp_nav_menu fallback, to show a home link
------------------------------------*/

function krown_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
}
add_filter( 'wp_page_menu_args', 'krown_page_menu_args' );

/*---------------------------------
	Enable SVG upload
------------------------------------*/

function krown_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'krown_mime_types' );

/*---------------------------------
	Retina info (by js cookie)
------------------------------------*/

if ( ! function_exists( 'krown_retina' ) ) {

	function krown_retina() {

		if ( isset( $_COOKIE['dpi'] ) ) {
			$retina = $_COOKIE['dpi'];
		} else { 
			$retina = false;
		}

		$retina = 'true';

	}

	add_action( 'init', 'krown_retina' );

}

/*---------------------------------
	Register widget areas
------------------------------------*/

function krown_widgets_init() {

	register_sidebar( array(
		'name' => __('Blog sidebar', 'goodwork'),
		'id' => 'rb_blog_widget_right',
		'description' => __('The blog/post/archives default sidebar', 'goodwork'),
		'before_widget' => '<section id="%1$s" class="widget sidebox %2$s clearfix">',
		'after_widget' => '</section>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	) );

	register_sidebar( array(
		'name' => __('Search sidebar', 'goodwork'),
		'id' => 'rb_search_widget_right',
		'description' => __('The search page\'s default sidebar', 'goodwork'),
		'before_widget' => '<section id="%1$s" class="widget sidebox %2$s clearfix">',
		'after_widget' => '</section>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	) );

	register_sidebar( array(
		'name' => __('Shop sidebar (bottom)', 'goodwork'),
		'id' => 'rb_shop_widget',
		'description' => __('The default sidebar for all woocommerce pages (which will appear at the bottom of shop pages).', 'goodwork'),
		'before_widget' => '<section id="%1$s" class="widget sidebox %2$s span3 column_container clearfix">',
		'after_widget' => '</section>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	) );

	register_sidebar( array(
		'name' => __('Shop sidebar (aside)', 'goodwork'),
		'id' => 'rb_shop_widget_2',
		'description' => __('The default sidebar for the woocommerce main shop page and other related archives (which will appear either in the left or right side based on your theme options).', 'goodwork'),
		'before_widget' => '<section id="%1$s" class="widget sidebox %2$s clearfix">',
		'after_widget' => '</section>',
		'before_title' => '<div class="widget-title"><h4>',
		'after_title' => '</h4></div>',
	) );

	register_sidebar( array(
		'name' => __('Header first widget area', 'goodwork'),
		'id' => 'rb_header_widget_1',
		'description' => __('The header\'s first widget area', 'goodwork'),
		'before_widget' => '<div id="%1$s" class="widget sidebox %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="hidden">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => __('Header second widget area', 'goodwork'),
		'id' => 'rb_header_widget_2',
		'description' => __('The header\'s second widget area', 'goodwork'),
		'before_widget' => '<div id="%1$s" class="widget sidebox %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h4 class="hidden">',
		'after_title' => '</h4>',
	) );

	register_sidebar( array(
		'name' => __('Footer first widget area', 'goodwork'),
		'id' => 'rb_footer_widget_1',
		'description' => __('The top footer\'s first widget area(1/4)', 'goodwork'),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</section>',
		'before_title' => '<div class="widget-title"><h5>',
		'after_title' => '</h5></div>',
	) );

	register_sidebar( array(
		'name' => __('Footer second widget area', 'goodwork'),
		'id' => 'rb_footer_widget_2',
		'description' => __('The top footer\'s second widget area(2/4)', 'goodwork'),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</section>',
		'before_title' => '<div class="widget-title"><h5>',
		'after_title' => '</h5></div>',
	) );

	register_sidebar( array(
		'name' => __('Footer third widget area', 'goodwork'),
		'id' => 'rb_footer_widget_3',
		'description' => __('The top footer\'s third widget area(3/4)', 'goodwork'),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</section>',
		'before_title' => '<div class="widget-title"><h5>',
		'after_title' => '</h5></div>',
	) );

	register_sidebar( array(
		'name' => __('Footer fourth widget area', 'goodwork'),
		'id' => 'rb_footer_widget_4',
		'description' => __('The top footer\'s fourth widget area(4/4)', 'goodwork'),
		'before_widget' => '<section id="%1$s" class="widget %2$s clearfix">',
		'after_widget' => '</section>',
		'before_title' => '<div class="widget-title"><h5>',
		'after_title' => '</h5></div>',
	) );

	register_sidebar( array(
		'name' => __('Footer\'s bottom first widget area', 'goodwork'),
		'id' => 'rb_footer_widget_5',
		'description' => __('The footer\'s bottom stripe first widget area(1/2)', 'goodwork'),
		'before_widget' => '<div id="%1$s" class="widget left %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<span class="hidden">',
		'after_title' => '</span>',
	) );

	register_sidebar( array(
		'name' => __('Footer\'s bottom second widget area', 'goodwork'),
		'id' => 'rb_footer_widget_6',
		'description' => __('The footer\'s bottom stripe second widget area(2/2)', 'goodwork'),
		'before_widget' => '<div id="%1$s" class="widget right %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<span class="hidden">',
		'after_title' => '</span>',
	) );
	
}  
add_action( 'widgets_init', 'krown_widgets_init' );

/*---------------------------------
	Remove "Recent Comments Widget" Styling
------------------------------------*/

function krown_remove_recent_comments_style() {
	global $wp_widget_factory;
	remove_action( 'wp_head', array( $wp_widget_factory->widgets['WP_Widget_Recent_Comments'], 'recent_comments_style' ) );
}
add_action( 'widgets_init', 'krown_remove_recent_comments_style' );


/*---------------------------------
	Function that replaces the default the_excerpt function
------------------------------------*/

if ( ! function_exists( 'krown_excerptlength_folio' ) ) {

	// Length (words no)
	 
	function krown_excerptlength_folio() {
	    return 20;
	}

}

if ( ! function_exists( 'krown_excerptlength_widget' ) ) {

	// Length (words no)
	 
	function krown_excerptlength_widget() {
	    return 18;
	}

}

if ( ! function_exists( 'krown_excerptlength_post' ) ) {

	// Length (words no)
	 
	function krown_excerptlength_post() {
	    return 25;
	}

}

if ( ! function_exists( 'krown_excerptmore' ) ) {

	// More text

	function krown_excerptmore() {
	    return ' ...';
	}

}

if ( ! function_exists( 'krown_excerpt' ) ) {

	// The actual function
	
	function krown_excerpt( $length_callback = '', $more_callback = 'krown_excerptmore' ) {

	    global $post;
		
	    if ( function_exists( $length_callback ) ) {
			add_filter( 'excerpt_length', $length_callback );
	    }
		
	    if ( function_exists( $more_callback ) ){
			add_filter( 'excerpt_more', $more_callback );
	    }
		
	    $output = get_the_excerpt();

	    if ( empty( $output ) ) {

	    	// If the excerpt is empty (on pages created 100% with shortcodes), we should take the content, strip shortcodes, remove all HTML tags, then return the correct number of words

	    	$output = strip_tags( preg_replace( "~(?:\[/?)[^\]]+/?\]~s", '', $post->post_content ) );
	    	$output = explode( ' ', $output, $length_callback() );
	    	array_pop( $output );
	    	$output = implode( ' ', $output ) . $more_callback();

	    } else {

	    	// Continue with the regular excerpt method

		    $output = apply_filters( 'wptexturize', $output );
		    $output = apply_filters( 'convert_chars', $output );

	    }
		
	    return $output;
		
	}   

}

/*--------------------------------
	Function that returns all categories of a custom post
------------------------------------*/

function krown_categories( $post_id, $taxonomy, $delimiter = ', ', $get = 'name', $echo = true, $link = false ){

	$tags = wp_get_post_terms( $post_id, $taxonomy );
	$list = '';
	foreach( $tags as $tag ){
		if ( $link ) {
			$list .= '<a href="' . get_category_link( $tag->term_id ) . '"> ' . $tag->$get . '</a>' . $delimiter;
		} else {
			$list .= $tag->$get . $delimiter;
		}
	}

	if ( $echo ) {
		echo substr( $list, 0, strlen($delimiter)*(-1) );
	} else { 
		return substr( $list, 0, strlen($delimiter)*(-1) );
	}

}

/*---------------------------------
	A custom pagination function
------------------------------------*/

if ( ! function_exists( 'krown_pagination' ) ) {

	function krown_pagination( $query = null, $range = 2, $echo = true ) {  

		if ( $query == null ) {
			global $wp_query;
			$query = $wp_query;
		}

		$page = $query->query_vars['paged'];
		$pages = $query->max_num_pages;

		if ( $page == 0 ) {
			$page = 1;
		}

		$html = '';

		if( $pages > 1 ) {

			$html .= '<nav class="pagination">';

			if ( $page + 1 <= $pages ) {
				$html .= '<a class="more nav-prev" href="' . get_pagenum_link( $page + 1 ) . '">' . __( 'Older Posts' ,'goodwork' ) . '</a>';
			}

			if ( $page - 1 >= 1 ) {
				$html .= '<a class="more nav-next" href="' . get_pagenum_link( $page - 1 ) . '">' . __( 'Newer Posts' ,'goodwork' ) . '</a>';
			}
				
			$html .= '</nav>';

		}

		if ( $echo ) {
			echo $html;
		} else {
			return $html;
		}
		 
	}

}

/*---------------------------------
	Return the title of the current page (if any)
------------------------------------*/

if ( ! function_exists( 'krown_check_page_title' ) ) {

	function krown_check_page_title() {

		global $post;

		$page_title = '';

		if ( is_404() ) {

			// 404
			if( get_option( 'krown_404_page' ) != '' ) {
				$page_title = get_the_title( get_option( 'krown_404_page' ) );
			} else {
				$page_title = __( 'Page Not Found', 'goodwork' );
			}

		} else if ( is_search() ) {

			// Search
			$page_title = __( 'Search Results', 'goodwork' );

		} else if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {

			// WooCommerce

			$page_title = __( 'Shop', 'goodwork' );

		} else {

			// Regular pages
			$page_title = get_the_title();

			// Special case
			if ( get_post_meta( $post->ID, 'rb_meta_box_t_show', true ) == 'false' ) {
				$page_title = '';
			}

			// Portfolio posts vs Blog posts
			if( is_singular( 'portfolio' ) ) {
				$page_title = get_the_title( isset( $_GET['id'] ) ? $_GET['id'] : get_option( 'krown_portfolio_page', '' ) );
			} else if ( is_singular( 'post' ) || is_archive() ) {
				$page_title = __( 'Our Blog' );
			}

		}

		// Return by case
		if ( $page_title != '' ) {
			if ( is_single() ) {
				return '<h2 class="title">' . $page_title . '</h2>';
			} else {
				return '<h1 class="title">' . $page_title . '</h1>';
			}
		} else {
			return '';
		}

	}

}

if ( ! function_exists( 'krown_check_archive_title' ) ) {

	function krown_check_archive_title() {

		global $post;

		if ( is_category() ) {

			$title = __( 'Categories Archives', 'goodwork' );
			$subtitle = __( 'You are currently viewing all posts published under', 'goodwork') . ' <em>' . get_category( get_query_var( 'cat' ) )->name . '</em>';

		} else if ( is_author() ) {

			$title = __( 'Author Archives', 'goodwork' );
			$subtitle = __( 'You are currently viewing all posts published by', 'goodwork') . ' <em>' . get_userdata( get_query_var( 'author' ) )->display_name . '</em>';

		} else if ( is_tag() ) {

			$title = __( 'Tags Archives', 'goodwork' );
			$subtitle = __( 'You are currently viewing all posts tagged with', 'goodwork') . ' <em>' . single_tag_title( '', false ) . '</em>';

		} else if ( is_day() ) {

			$title = __( 'Daily Archives', 'goodwork' );
			$subtitle = __( 'You are currently viewing all posts published on', 'goodwork') . ' <em>' . get_the_date() . '</em>';

		} else if ( is_month() ) {

			$title = __( 'Monthly Archives', 'goodwork' );
			$subtitle = __( 'You are currently viewing all posts published on', 'goodwork') . ' <em>' . get_the_date( 'F Y' ) . '</em>';

		} else if ( is_year() ) {

			$title = __( 'Yearly Archives', 'goodwork' );
			$subtitle = __( 'You are currently viewing all posts published in', 'goodwork') . ' <em>' . get_the_date( 'Y' ) . '</em>';

		} else if ( is_tax( 'post_format' ) ) {
			
			$title = __( 'Format Archives', 'goodwork' );
			$subtitle = __( 'You are currently viewing all', 'goodwork' ) . '<em> ' . ( get_post_format() == '' ? __( 'standard', 'goodwork' ) : get_post_format() ) . '</em> ' . __( 'posts', 'goodwork' );

		}

		return array( $title, $subtitle );

	}

}

/*---------------------------------
	Return the sidebar of the page
------------------------------------*/

if ( ! function_exists( 'krown_global_sidebar' ) ) {
	
	function krown_global_sidebar() {

		global $sidebar;
		global $post;

		$sidebar = array(
			'sidebar_type' => '',
			'sidebar_id' => ''
		);

		if ( is_search() ) {

			// Search
			$sidebar = array(
				'sidebar_type' => get_option( 'krown_search_layout' ),
				'sidebar_id' => 'rb_search_widget_right'
			);

		} else {

			if ( isset( $post ) ) {

				if ( function_exists( 'is_woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() ) ) {

					// Shop
					$sidebar = array(
						'sidebar_type' => get_option( 'krown_shop_layout' ),
						'sidebar_id' => 'rb_shop_widget_2'
					);

				} else if ( is_page_template( 'template-blog-classic.php' ) || is_archive() || is_singular( 'post' ) ) {

					// Blog
					$sidebar = array(
						'sidebar_type' => get_option( 'krown_blog_layout' ),
						'sidebar_id' => 'rb_blog_widget_right'
					);

				} else if ( is_page_template( 'template-portfolio.php' ) ) {

					// Portfolio
					$sidebar = array(
						'sidebar_type' => get_post_meta( $post->ID, 'rb_meta_box_sidebar_layout', true ),
						'sidebar_id' => get_post_meta( $post->ID, 'rb_meta_box_sidebar_set', true )
					);	

				} else if ( is_singular( 'portfolio' ) ) {

					$v_page = isset( $_GET['id'] ) ? $_GET['id'] : get_option( 'krown_portfolio_page', '' );

					// Project
					$sidebar = array(
						'sidebar_type' => get_post_meta( $v_page, 'rb_meta_box_sidebar_layout', true ),
						'sidebar_id' => get_post_meta( $v_page, 'rb_meta_box_sidebar_set', true )
					);	

				} else {

					$sidebar = array(
						'sidebar_type' => get_post_meta( $post->ID, 'rb_meta_box_sidebar_layout', true ),
						'sidebar_id' => get_post_meta ($post->ID, 'rb_meta_box_sidebar_set', true )
					);

				}

			} else {

				// 404
				$sidebar = array(
					'sidebar_type' => get_post_meta( get_option( 'krown_404_page', '' ), 'rb_meta_box_sidebar_layout', true ),
					'sidebar_id' => get_post_meta( get_option( 'krown_404_page', '' ), 'rb_meta_box_sidebar_set', true )
				);

			}

		}

	}

}

/*---------------------------------
	Post Views
------------------------------------*/

function krown_get_post_views( $post_id ){

    $count_key = 'post_views_count';
    $count = get_post_meta( $post_id, $count_key, true );

    if ( $count=='' ) {
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, '0' );
        return 0;
    }

    return $count;

}

function krown_set_post_views( $post_id ) {

    $count_key = 'post_views_count';
    $count = get_post_meta( $post_id, $count_key, true );

    if ( $count=='' ) {
        $count = 0;
        delete_post_meta( $post_id, $count_key );
        add_post_meta( $post_id, $count_key, '0' );
    } else {
        $count++;
        update_post_meta( $post_id, $count_key, $count );
    }

}

/*---------------------------------
	Custom login logo
------------------------------------*/

function krown_custom_login_logo() {
    echo '<style type="text/css">
        h1 a { background-image: url(' . ot_get_option( 'krown_custom_login_logo_uri', get_template_directory_uri() . '/images/krown-login-logo.png' ) . ') !important; background-size: 273px 63px !important; width: 273px !important; height: 63px !important; }
    </style>';
}

add_action( 'login_head', 'krown_custom_login_logo' );

/*---------------------------------
	Fix empty search issue
------------------------------------*/

function krown_request_filter( $query_vars ) {

    if( isset( $_GET['s'] ) && empty( $_GET['s'] ) ) {
        $query_vars['s'] = " ";
    }

    return $query_vars;
}

add_filter('request', 'krown_request_filter');

/*---------------------------------
	Enqueue admin styles
------------------------------------*/

function krown_admin_scripts() {
	wp_enqueue_style( 'krown-admin-css', get_template_directory_uri() . '/css/admin-styles.css' );
	wp_enqueue_script( 'krown-admin-js', get_template_directory_uri() . '/js/admin-scripts.js' );
}

$load_script_theme = true;
if( isset($_GET['page']) && substr( $_GET['page'] ,0 ,7 ) == 'wysija_' ){
    $load_script_theme = false;
}

if( $load_script_theme ){
    add_action( 'admin_enqueue_scripts', 'krown_admin_scripts' );
}

/*---------------------------------
	Ajaxify Comments
------------------------------------*/

add_action('comment_post', 'ajaxify_comments',20, 2);
function ajaxify_comments($comment_ID, $comment_status){
	if(!empty($_SERVER['HTTP_X_REQUESTED_WITH']) && strtolower($_SERVER['HTTP_X_REQUESTED_WITH']) == 'xmlhttprequest'){
	//If AJAX Request Then
		switch($comment_status){
			case '0':
				//notify moderator of unapproved comment
				wp_notify_moderator($comment_ID);
			case '1': //Approved comment
				echo "success";
				$commentdata=&get_comment($comment_ID, ARRAY_A);
				$post=&get_post($commentdata['comment_post_ID']); 
				wp_notify_postauthor($comment_ID, $commentdata['comment_type']);
			break;
			default:
				echo "error";
		}
		exit;
	}
}

/*---------------------------------
	Custom bbs
------------------------------------*/

if ( ! function_exists ('krown_breadcrumbs' ) ) {

	function krown_breadcrumbs() {

		global $post;

		if ( function_exists( 'is_woocommerce' ) && is_woocommerce() ) {

			do_action( 'rb_custom_breadcrumb' );

		} else {
		
		    echo '<nav id="breadcrumb"' . ( get_option( 'rb_bread', 'false' ) != 'true' ? ' class="hidden"' : '' ) . ' itemprop="breadcrumb">';

			if ( ! is_front_page() ) {

				echo '<a href="' . home_url() . '"><i class="krown-icon-home"></i></a> <span>></span> ';

				if ( is_category() || is_single() ) {

					if( is_singular( 'portfolio' ) ) {
						$v_page = isset( $_GET['id'] ) ? $_GET['id'] : get_option( 'krown_portfolio_page', '' );
						echo '<a href="' . get_permalink( $v_page ) . '">' . get_the_title( $v_page ) . '</a>';
					}

					the_category(', ');

					if ( is_single() ) {
						echo ' <span>></span> ' . get_the_title();;
					}

				} elseif ( is_page() && $post->post_parent ) {

					$home = get_page_by_title('home');

					for ($i = count($post->ancestors)-1; $i >= 0; $i--) {
						if (($home->ID) != ($post->ancestors[$i])) {
							echo '<a href="' . get_permalink($post->ancestors[$i]) . '">' . get_the_title($post->ancestors[$i]) . '</a> <span>></span> ';
						}
					}

					echo get_the_title();

				} elseif (is_page()) {
					echo get_the_title();
				} elseif (is_404()) {
					_e( '404', 'goodwork' );
				}

			} else {

				bloginfo('name');

			}

			echo '</nav>';

		}

	}

}

add_filter('mce_buttons_2', 'wpse3882_mce_buttons_2');
function wpse3882_mce_buttons_2($buttons)
{
    array_unshift($buttons, 'styleselect');
    return $buttons;
}

add_filter('tiny_mce_before_init', 'wpse3882_tiny_mce_before_init');
function wpse3882_tiny_mce_before_init($settings)
{
    $settings['theme_advanced_blockformats'] = 'p,h1,h2,h3,h4';

    // From http://tinymce.moxiecode.com/examples/example_24.php
    $style_formats = array(
        array('title' => 'Dropcap 1', 'inline' => 'span', 'classes' => 'rbDropcap square'),
        array('title' => 'Dropcap 2', 'inline' => 'span', 'classes' => 'rbDropcap default'),
        array('title' => 'Highlight 1', 'inline' => 'mark', 'classes' => 'rbHighlight black'),
        array('title' => 'Highlight 2', 'inline' => 'mark', 'classes' => 'rbHighlight yellow'),
        array('title' => 'Smaller', 'inline' => 'span', 'classes' => 'rbSmall'),
        array('title' => 'Larger', 'inline' => 'span', 'classes' => 'rbLarge'),
        array('title' => 'Unordered List 1', 'inline' => 'span', 'classes' => 'list1'),
        array('title' => 'Unordered List 2', 'inline' => 'span', 'classes' => 'list2'),
        array('title' => 'Unordered List 3', 'inline' => 'span', 'classes' => 'list3'),
        array('title' => 'Unordered List 4', 'inline' => 'span', 'classes' => 'list4')
    );
    // Before 3.1 you needed a special trick to send this array to the configuration.
    // See this post history for previous versions.
    $settings['style_formats'] = json_encode( $style_formats );

    return $settings;
}

/*---------------------------------
	Color conversion functions
------------------------------------*/

function krown_hex_to_rgba( $hex, $a, $string = true ) {

	$hex = str_replace("#", "", $hex);

	if(strlen($hex) == 3) {
		$r = hexdec(substr($hex,0,1).substr($hex,0,1));
		$g = hexdec(substr($hex,1,1).substr($hex,1,1));
		$b = hexdec(substr($hex,2,1).substr($hex,2,1));
	} else {
		$r = hexdec(substr($hex,0,2));
		$g = hexdec(substr($hex,2,2));
		$b = hexdec(substr($hex,4,2));
	}

	if ( $string ) {
		return 'rgba(' . $r . ',' . $g . ',' . $b . ',' . $a . ')';
	} else {
		return array( $r, $g, $b, $a );
	}
   
}

function krown_rgb_to_hex( $rgb ) {

	$hex = '#'; 

	$hex .= str_pad(dechex($rgb[0]), 2, "0", STR_PAD_LEFT);
	$hex .= str_pad(dechex($rgb[1]), 2, "0", STR_PAD_LEFT);
	$hex .= str_pad(dechex($rgb[2]), 2, "0", STR_PAD_LEFT);

	return $hex;

}

/*---------------------------------
	Post Format Media Output
------------------------------------*/

if ( ! function_exists( 'krown_post_format_content' ) ) {

	function krown_post_format_content( $id, $format ){

		global $sidebar;

		switch ( $format ) {

			case 'image' :
				echo '<img class="pMedia" src="' . get_post_meta($id, 'rb_meta_box_post_assets_i', true) . '" alt="" />';
				break;

			case 'audio' :
				echo '<div class="audiojsZ pMedia">
					<audio style="width:100%; height:30px;" class="audio-js" controls preload src="' . get_post_meta($id, 'rb_meta_box_post_assets_a', true) . '" />
				</div>';
				break;

			case 'video' :
				if(get_post_meta($id, 'rb_meta_box_post_assets_ev', true) != '') {
					echo '<div class="pMedia">' . get_post_meta($id, 'rb_meta_box_post_assets_ev', true) . '</div>';
				} else {
					echo '<video id="video-' . $id . '" class="video-js vjs-default-skin pMedia" controls
					  preload="auto" width="940" height="528" style="width:100%; height:100%" poster="' . get_post_meta($id, 'rb_meta_box_post_assets_sv3', true) .'"
					  data-setup="{}">
					  <source src="' . get_post_meta($id, 'rb_meta_box_post_assets_sv1', true) . '" type="video/mp4">
					  <source src="' . get_post_meta($id, 'rb_meta_box_post_assets_sv2', true) . '" type="video/ogg">
					</video>';
				}
				break;

			case 'gallery' :
				$slides = get_post_meta($id, 'rb_meta_box_post_assets_g', true);
				echo '<div class="flexslider pMedia folio">
					<ul class="slides">';
					if(!empty($slides))
						foreach($slides as $slide){
							$img_url = $slide['rb_image'];
							$width = $sidebar['sidebar_type'] != '' && $sidebar['sidebar_type'] != 'full-width' ? '700' : '940';
							$image = aq_resize($img_url, $width, null, false, false);
							echo '<li data-caption="' . $slide['rb_caption'] . '">
									<img src="'. $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $slide['rb_caption'] . '" />
								</li>';
						}
				echo '</ul>
				</div>';
				break;

			case 'quote' :
				echo '<blockquote class="special"><p>' . get_post_meta($id, 'rb_meta_box_post_assets_q_1', true) . '</p><cite>' . get_post_meta($id, 'rb_meta_box_post_assets_q_2', true) . '</cite></blockquote>';
				break;


		} 

	}

}


/*---------------------------------
	Enqueue front scripts
------------------------------------*/

function krown_enqueue_scripts() {

	global $post;

	wp_deregister_style('wp-mediaelement');
	wp_deregister_script('wp-mediaelement');
	wp_deregister_script('wp-playlist');

	// Register some js libraries

	wp_register_script( 'flexslider', get_template_directory_uri() . '/js/jquery.flexslider-min.js', array('jquery'), NULL, true );
	wp_register_script( 'isotope', get_template_directory_uri() . '/js/jquery.isotope.min.js', array('jquery'), NULL, true );
	wp_register_script( 'google-maps', 'https://maps.googleapis.com/maps/api/js?sensor=false', NULL, true );
	wp_register_script('wp-playlist', get_template_directory_uri() . '/js/mejs-gw-playlist.min.js', array( 'wp-util', 'backbone', 'mediaelement' ), NULL, true );

	// Enqueue theme scripts based on page templates and shortcodes. I haven't used "has_shortcode()" because that function doesn't work with nested shortcodes

	if ( isset( $post ) ) {

		if ( is_single() || is_singular( 'portfolio' ) || strpos( $post->post_content, '[gallery' ) >= 0 ) {
			wp_enqueue_script( 'flexslider' );
		}

		if ( is_page_template( 'template-portfolio.php' ) || strpos( $post->post_content, '[vc_portfolio_grid' ) >= 0 || strpos( $post->post_content, '[vc_posts_grid' ) >= 0 || strpos( $post->post_content, '[project_grid' ) >= 0 || ( function_exists( 'is_woocommerce' ) && ( is_shop() || is_product_category() || is_product_tag() ) ) ) {
			wp_enqueue_script( 'isotope' );
		}

		if ( is_page_template( 'template-contact.php' ) || strpos( $post->post_content, '[vc_gmaps' ) >= 0 ) {
			wp_enqueue_script( 'google-maps' );
		}

		if ( strpos( $post->post_content, '[playlist') >= 0 ) {
			wp_enqueue_script( 'wp-playlist' );
		}

	}

	// Enqueue the rest of libraries all the time, since they are used almost on any page

	wp_enqueue_script( 'fancybox', get_template_directory_uri().'/js/jquery.fancybox.pack.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'theme_plugins', get_template_directory_uri().'/js/plugins.min.js', array('jquery'), NULL, true );
	wp_enqueue_script( 'theme_scripts', get_template_directory_uri().'/js/scripts.min.js', array('theme_plugins'), NULL, true );
	wp_enqueue_script( 'wp-mediaelement', get_template_directory_uri().'/js/mediaelement-and-player.min.js', array('theme_plugins'), NULL, true  );

	// Enqueue styles

	wp_enqueue_style( 'krown-style-parties', get_template_directory_uri() . '/css/third-parties.css' );
	wp_enqueue_style( 'krown-style', get_stylesheet_uri() );

	// Handle comments script

	if ( is_single() || is_page() ) {
		wp_enqueue_script( 'comment-reply' );
	} else {
		wp_dequeue_script( 'comment-reply' );
	}
	
	// We need to pass some useful variables to the theme scripts through the following function

	$colors = get_option( 'rb_o_colors' );

	wp_localize_script(
		'theme_scripts', 
		'themeObjects',
		array(
			'base' 		=> get_template_directory_uri(),
			'mainColor'	=> $colors['main1'],
			'secondColor' => '#DBDBDB',
			'blogPage' => get_option( 'krown_modern_blog_ppp', '8' ),
			'commentProcess' => __( 'Processing your comment...', 'goodwork' ),
			'commentError' => __( 'You might have left one of the fields blank, or be posting too quickly.', 'goodwork' ),
			'commentSuccess' => __( 'Thanks for your response. Your comment will be published shortly after it\'ll be moderated.', 'goodwork' ),
			'idText1' => __( 'FUNDED', 'goodwork' ),
			'idText2' => __( 'RAISED', 'goodwork' ),
			'idText3' => __( 'GOAL', 'goodwork' ),
			'idText4' => __( 'PLEDGERS', 'goodwork' ),
			'idText5' => __( 'END DATE', 'goodwork' ),
			'idText6' => __( 'DAYS LEFT', 'goodwork' )
		)
	);

}

add_action( 'wp_enqueue_scripts', 'krown_enqueue_scripts', 100 );

// The function below deregisters the scripts embedded through the Visual Composer plugin. This is needed because i have rewritten most of the shortcode from the plugin and the theme will load the proper scripts & styles anyway.

function krown_handle_jscomp_scripts() {
	wp_dequeue_style( array( 'js_composer_front', 'flexslider', 'nivo-slider-css', 'nivo-slider-theme', 'prettyphoto', 'isotope-css' ) );
    wp_deregister_style( array( 'js_composer_front', 'flexslider', 'nivo-slider-css', 'nivo-slider-theme', 'prettyphoto', 'isotope-css' ) );
	wp_dequeue_script( array( 'wpb_composer_front_js', 'flexslider', 'isotope', 'tweet', 'jcarousellite', 'nivo-slider', 'waypoints', 'prettyphoto', 'jquery_ui_tabs', 'jquery_ui_tabs_rotate' ) );
    wp_deregister_script( array( 'wpb_composer_front_js', 'flexslider', 'isotope', 'tweet', 'jcarousellite', 'nivo-slider', 'waypoints', 'prettyphoto', 'jquery_ui_tabs', 'jquery_ui_tabs_rotate' ) );
}

add_action( 'wp_enqueue_scripts', 'krown_handle_jscomp_scripts', 99 );

// The function below deregisters the WooCommerce scripts on pages which have nothing to do with WOO. I've wrapped this function to allow for easy disablement is there are any issues with it.

if ( ! function_exists( 'krown_handle_woo_scripts' ) ) {

	function krown_handle_woo_scripts() {

		if ( function_exists( 'is_woocommerce' ) && ! ( is_woocommerce() || is_cart() || is_checkout() || is_account_page() ) ) {

			wp_dequeue_script( 'wc-add-to-cart' );
			wp_dequeue_script( 'jquery-blockui' ); 
			wp_dequeue_script( 'jquery-placeholder' ); 
			wp_dequeue_script( 'jquery-cookie' ); 
			wp_dequeue_script( 'wc-country-select' ); 
			wp_dequeue_script( 'jquery-payment' ); 
			wp_dequeue_script( 'wc-credit-card-form' ); 
			wp_dequeue_script( 'woocommerce' ); 

		}

	}

}

add_action( 'wp_enqueue_scripts', 'krown_handle_woo_scripts', 101 );

/// The function below deregisters font awesome styles, in order to ensure full compatibility with the theme's icons. I've wrapped this function to allow for easy disablement if there are any issues with it.

if ( ! function_exists( 'krown_handle_fa_style' ) ) {

	function krown_handle_fa_style() {
		wp_dequeue_style( 'font-awesome' );
	}

}

add_action( 'wp_enqueue_scripts', 'krown_handle_fa_style', 101 );

/* ------------------------
-----   Filter Video Shortcode   -----
------------------------------*/

function krown_video_shortcode($content) {
	$keyword = strpos( $content, 'poster' ) > 0 ? "poster" : "preload";
    echo preg_replace( "(width=.+$keyword)", "width='100%' height='100%' style='width:100%;height:100%' $keyword", $content );
}
add_filter('wp_video_shortcode', 'krown_video_shortcode');

/*---------------------------------
    Navigation Walker
------------------------------------*/

class menu_default_walker extends Walker_Nav_Menu
{

	function start_lvl(&$output, $depth){
		$output .= '<ul class="clearfix">';
	}

	function display_element($element, &$children_elements, $max_depth, $depth=0, $args, &$output){
        $id_field = $this->db_fields['id'];
        if ( is_object( $args[0] ) ) {
            $args[0]->has_children = ! empty( $children_elements[$element->$id_field] );
        }
        return parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
    }


    function start_el(&$output, $item, $depth, $args) {
		global $wp_query;
		global $rb_submenus;

		$indent = ( $depth ) ? str_repeat( "\t", $depth ) : '';

		$new_output = '';
		$depth_class = ($args->has_children ? 'parent ' : '');

		$class_names = $value = $selected_class = '';
		$classes = empty($item->classes) ? array() : (array) $item->classes;

		$current_indicators = array('current-menu-item','current-menu-parent','current_page_item','current_page_parent', 'current-menu-ancestor');

		foreach($classes as $el)
			if(in_array($el,$current_indicators))
				$selected_class = 'selected ';

		$class_names = ' class="' . $selected_class . $depth_class . 'menu-item' . (!empty($classes[0]) ? ' ' . $classes[0] : '') .'"';

		if ( !get_post_meta( $item->object_id , '_members_only' , true ) || is_user_logged_in() ) {
			$output .= $indent . '<li id="menu-item-'. $item->ID . '"' . $class_names . '>';
		}

		$attributes  = ! empty( $item->attr_title ) ? ' title="'  . esc_attr( $item->attr_title ) .'"' : '';
		$attributes .= ! empty( $item->target )     ? ' target="' . esc_attr( $item->target     ) .'"' : '';
		$attributes .= ! empty( $item->xfn )        ? ' rel="'    . esc_attr( $item->xfn        ) .'"' : '';
		$attributes .= ! empty( $item->url )        ? ' href="'   . esc_attr( $item->url        ) .'"' : '';

		$item_output = $args->before;
		$item_output .= '<a'. $attributes .'>';
		$item_output .= $args->link_before . apply_filters( 'the_title', $item->title, $item->ID ) . $args->link_after;
		$item_output .= '</a>';
		$item_output .= $args->after;


		if ( !get_post_meta( $item->object_id, '_members_only' , true ) || is_user_logged_in() ) {
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}

		$output .= $new_output;

	}

	function end_el(&$output, $item, $depth) {
		if ( !get_post_meta( $item->object_id, '_members_only' , true ) || is_user_logged_in() ) {
			$output .= "</li>\n";
		}
	}
	
	 function end_lvl(&$output, $depth) {

		  $output .= "</ul>\n";
		  
	}
	
}

?>