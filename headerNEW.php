<!DOCTYPE html>
<!--[if lt IE 8]> <html <?php language_attributes(); ?> class="no-touch no-js ie7 ie <?php echo get_option( 'rb_ltype' ); ?>" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 8]> <html <?php language_attributes(); ?> class="no-touch no-js ie8 ie <?php echo get_option( 'rb_ltype' ); ?>" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if IE 9]> <html <?php language_attributes(); ?> class="no-touch no-js no-ie ie9 <?php echo get_option( 'rb_ltype' ); ?>" xmlns="http://www.w3.org/1999/xhtml"> <![endif]-->
<!--[if gt IE 9]><!--> <html <?php language_attributes(); ?> xmlns="http://www.w3.org/1999/xhtml" class="no-ie no-touch no-js <?php echo get_option( 'rb_ltype' ); ?>"> <!--<![endif]-->

<head>

	<!-- META -->

	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=no">
	<meta name="format-detection" content="telephone=no">
	<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">

	<!-- TITLE & SEO -->

	<title><?php wp_title( '|', true, 'right' ); ?></title>

	<!-- LINKS -->

	<link rel="profile" href="http://gmpg.org/xfn/11" />
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />

	<?php if ( get_option( 'krown_fav' ) != '' ) : ?>

	<link rel="shortcut icon" type="image/x-icon" href="<?php echo get_option( 'krown_fav' ); ?>" />

	<?php endif; ?>





	<?php global $sidebar;
		krown_global_sidebar(); ?>


<?php
	if(is_search()){

		$sidebar = array(
			'sidebar_type' => ot_get_option('rb_search_sidebars'),
			'sidebar_id' => 'rb_search_widget_right'
		);

		$custom_the_title = ot_get_option('rb_search_title', '');

	} else {

		if ( have_posts() ) while ( have_posts() ) : the_post();

			if(function_exists('is_woocommerce') && (is_woocommerce() && !(is_cart() || is_checkout() || is_account_page()))){

				$custom_the_title = ot_get_option('rb_shop_title', 'Shop');

				if(is_shop() || is_product_category() || is_product_tag()){
					$sidebar = array(
						'sidebar_type' => ot_get_option('rb_shop_sidebars'),
						'sidebar_id' => 'rb_shop_widget_2'
					);
				}

			} else if(is_page_template('template-blog-classic.php') || (is_archive() && !is_post_type_archive('portfolio')) || (is_single() && get_post_type() == 'post')) {
 
				$sidebar = array(
					'sidebar_type' => ot_get_option('rb_blog_sidebars'),
					'sidebar_id' => 'rb_blog_widget_right'
				);

				$custom_the_title = ot_get_option('rb_blog_title', '');

			} else if(is_page_template('template-portfolio.php')) {

				$sidebar = array(
					'sidebar_type' => get_post_meta($post->ID, 'rb_meta_box_sidebar_layout', true),
					'sidebar_id' => get_post_meta($post->ID, 'rb_meta_box_sidebar_set', true)
				);	

				$custom_the_title = get_the_title($post->ID);

			} else if( is_post_type_archive('portfolio')) { 

				$v_page = isset($_GET['id']) ? $_GET['id'] : ot_get_option('rb_def_p_page', '');

				$sidebar = array(
					'sidebar_type' => get_post_meta($v_page, 'rb_meta_box_sidebar_layout', true),
					'sidebar_id' => get_post_meta($v_page, 'rb_meta_box_sidebar_set', true)
				);	

				$custom_the_title = get_the_title($v_page);

			} else if (is_single() && get_post_type() == 'portfolio') { 

				$v_page = isset($_GET['id']) ? $_GET['id'] : ot_get_option('rb_def_p_page', '');

				$sidebar = array(
					'sidebar_type' => 'right-sidebar',
					'sidebar_id' => '1'
				);	

				$custom_the_title = get_the_title($v_page);

			} else {

				$sidebar = array(
					'sidebar_type' => get_post_meta($post->ID, 'rb_meta_box_sidebar_layout', true),
					'sidebar_id' => get_post_meta($post->ID, 'rb_meta_box_sidebar_set', true)
				);

			}

		endwhile;

	}

	if(is_404()) {

		if(ot_get_option('rb_404', '') != '') {

			$custom_the_title = get_the_title(ot_get_option('rb_404', ''));
			$sidebar = array(
				'sidebar_type' => get_post_meta(ot_get_option('rb_404', ''), 'rb_meta_box_sidebar_layout', true),
				'sidebar_id' => get_post_meta(ot_get_option('rb_404', ''), 'rb_meta_box_sidebar_set', true)
			);

		} else {

			$custom_the_title = __('404 Error', 'goodwork');
			
		}

	}

?>



	<!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script><![endif]-->

	<!-- WP HEAD -->
	<?php
	/* JM- superfish stuff, for projects page */
	if (is_page('2')){

		wp_register_style( 'superfish_style', get_stylesheet_directory_uri() . '/superfish/css/superfish.css' );
		wp_enqueue_style( 'superfish_style' );
	
	
		//echo "it's post #2!";
	}
	?>

	<?php wp_head(); ?>
		
</head>

<body id="body" <?php body_class( $sidebar ); ?>>

	<!-- Main Wrapper Start -->

	<div class="wrapper clearfix tt<?php echo get_post_meta( $post->ID, 'rb_meta_box_t_show', true ); ?>">

		<!-- Header Start -->

		<header id="mainHeader" class="<?php echo get_option( 'rb_o_hlayout' ); ?> <?php echo get_option( 'rb_hmenu' ); ?> <?php echo get_option( 'rb_o_hlogo' ); ?>">

			<!-- Logo Start -->
			<div id="logo" class="clearfix">
				
				<?php 

				$logo = get_option( 'krown_logo' );
				$logo_x2 = get_option( 'krown_logo_x2' );

				if ( $logo == '' ) {
					$logo = get_template_directory_uri() . '/images/logo.png';
				}
				if ( $logo_x2 == '' ) {
					$logo_x2 = $logo;
				}

				?>

				<a href="<?php echo home_url(); ?>" style="width:<?php echo get_option( 'krown_logo_width', '193' ); ?>px;">
					<img class="default" src="<?php echo $logo; ?>" alt="<?php bloginfo( 'name' ); ?>" />
					<img class="retina" src="<?php echo $logo_x2; ?>" alt="<?php bloginfo('name'); ?>" />
				</a>

			</div>
			<!-- Logo End -->

			<!-- Widgets Start -->
			<div id="headerWidgets" class="clearfix">
				<div class="left clearfix">
					<?php if ( is_active_sidebar('rb_header_widget_1' ) ) {
						dynamic_sidebar( 'rb_header_widget_1' );
					} ?>
				</div>
				<div class="right clearfix">
					<?php if ( is_active_sidebar( 'rb_header_widget_2' ) ) {
						dynamic_sidebar( 'rb_header_widget_2' ); 
					} ?>
				</div>
			</div>
			<!-- Widgets End -->

			<!-- Menu Start -->
			<nav id="menu" class="cart<?php echo function_exists( 'is_woocommerce' ) ? 'true' : 'false'; ?>">
				<p class="responsive"><?php _e('Navigation', 'goodwork'); ?></p>

				<?php if ( has_nav_menu( 'primary' ) ) {

					wp_nav_menu( array(
						'container' => false,
						'menu_class' => 'clearfix',
						'echo' => true,
						'before' => '',
						'after' => '',
						'link_before' => '',
						'link_after' => '',
						'depth' => 3,
						'theme_location' => 'primary',
						'walker' => new menu_default_walker()
						)
					);

				} ?>

				<?php if ( get_option('rb_o_hsearch') == 'true' ) {
					get_search_form();
				}

				if ( function_exists('is_woocommerce') ) :

					global $woocommerce; ?>

					<div class="cart-widget">
						<a class="cart-contents" href="<?php echo $woocommerce->cart->get_cart_url(); ?>" title="<?php _e('View your shopping cart', 'goodwork'); ?>">
							<p><?php echo sprintf( _n('%d item', '%d items', $woocommerce->cart->cart_contents_count, 'goodwork' ), $woocommerce->cart->cart_contents_count);?>
								<?php echo $woocommerce->cart->get_cart_total(); ?>
							</p>
						</a>
					</div>

				<?php endif; ?>

			</nav>

			<?php krown_breadcrumbs(); ?>
			<!-- Menu End -->

		</header>
		
		<!-- Header End -->

		<?php $custom_title = krown_check_page_title(); ?>

		<?php if ( ! is_page_template('template-slider.php') && !is_page_template('template-slider-full.php') && $custom_title != '' ) : ?>

			<!-- Page Title -->

			<div id="pageTitle" class="clearfix">

				<?php echo $custom_title; ?>

				<?php if ( !( is_search() || is_404() ) && get_post_meta( $post->ID, 'rb_meta_box_t_link', true) != '' ) : ?>

					<a href="<?php echo get_post_meta( $post->ID, 'rb_meta_box_t_url', true ); ?>" target="<?php echo get_post_meta( $post->ID, 'rb_meta_box_t_target', true ); ?>"><?php echo get_post_meta( $post->ID, 'rb_meta_box_t_link', true ); ?></a>

				<?php endif; ?>

				<?php if( is_single() && is_singular( 'post' ) ) : ?>

					<nav class="postsNav">
						<?php previous_post_link('<span class="prev">%link</span>');
						next_post_link('<span class="next">%link</span>'); ?>
					</nav>

				<?php endif; ?>

			</div>

		<?php elseif ( is_page_template('template-slider.php' ) && get_post_meta( $post->ID, 'rb_meta_box_title2_show', true ) == 'true') : ?>

			<!-- Page Tagline -->

			<header class="rbTagline clearfix<?php if( get_post_meta( $post->ID, 'rb_meta_box_title2_icon', true ) != 'none' ) echo ' wicon'; ?>">

				<?php if ( get_post_meta( $post->ID, 'rb_meta_box_title2_title', true) != '' ) { ?>

					<h1><?php echo get_post_meta( $post->ID, 'rb_meta_box_title2_title', true ); ?></h1>

				<?php } if( get_post_meta( $post->ID, 'rb_meta_box_title2_subtitle', true ) != '' ) { ?>

					<h2><?php echo get_post_meta( $post->ID, 'rb_meta_box_title2_subtitle', true ); ?></h2>

				<?php } if( get_post_meta( $post->ID, 'rb_meta_box_title2_icon', true ) != 'icon' ) { ?>

					<i class="i-medium krown-<?php echo get_post_meta( $post->ID, 'rb_meta_box_title2_icon', true ); ?>"></i>

				<?php } ?>

			</header>

		<?php endif; ?>

		<!-- Content Wrapper Start -->

		<?php if ( ! is_page_template('template-slider-full.php') ) : ?>

		<article id="content" class="clearfix"> 

		<?php endif; ?>