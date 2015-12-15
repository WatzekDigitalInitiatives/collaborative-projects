<?php 
/**
 * This file contains the output of the WordPress Theme Customizer (frontend)
 */

if( ! function_exists( 'krown_custom_css' ) ) {

	function krown_custom_css() {

		// Get Options

		$colors = get_option('rb_o_colors');
		$body = get_option('rb_o_back');
		$bop = !isset($body['boxedopacity']) || !is_numeric($body['boxedopacity']) ? 1 : $body['boxedopacity'];
		
		$f_head = get_option('rb_o_heading');
		$f_body = get_option('rb_o_body');
		$f_quotes = get_option('rb_o_quotes');

		$protocol = is_ssl() ? 'https' : 'http';

		$f_head = is_serialized( get_option('krown_type_heading' ) ) ? unserialize( get_option('krown_type_heading' ) ) : array( 'default' => true, 'font-family' => '"Helvetica Neue", Helvetica, Arial, sans-serif' );
		$f_body = is_serialized( get_option( 'krown_type_body' ) ) ? unserialize( get_option( 'krown_type_body' ) ) : array( 'default' => true, 'font-family' => '"Helvetica Neue", Helvetica, Arial, sans-serif' );
		$f_quote = is_serialized( get_option( 'krown_type_quotes' ) ) ? unserialize( get_option( 'krown_type_quotes' ) ) : array( 'default' => true, 'font-family' => '"Helvetica Neue", Helvetica, Arial, sans-serif' );

		// Enequeue Google Fonts

		if ( ! isset( $f_head['default'] ) ) {
			wp_enqueue_style( 'krown-font-head', "$protocol://fonts.googleapis.com/css?family=" . $f_head['css-name'] . ":300,400,400italic,500,600,700,700,800" );
		}

		if ( $f_body != $f_head && !isset( $f_body['default'] ) ) {
			wp_enqueue_style( 'krown-font-body', "$protocol://fonts.googleapis.com/css?family=" . $f_body['css-name'] . ":300,400,400italic,500,600,700,700,800" );
		}

		if ( $f_quote != $f_head && $f_quote != $f_body && !isset( $f_quote['default'] ) ) {
			wp_enqueue_style( 'krown-font-quote', "$protocol://fonts.googleapis.com/css?family=" . $f_quote['css-name'] . ":300,400,400italic,500,600,700,700,800" );
		}

		// Create Custom CSS

		$custom_css = '

			/* CUSTOM FONTS */

			h1, h2, h3, h4, h5, h6, .tp-caption {
			  font-family: ' . $f_head['font-family'] . ';
			}

			body, .rbStats.pie h5, .rbStats.bars h5, .rbTwitter > a h5, .fancybox-title, .tp-caption > a, button, .woocommerce .buttons a {
			  font-family: ' . $f_body['font-family'] . ';
			}

			.modern blockquote, .post blockquote, .rbTestimonial blockquote {
			  font-family: ' . $f_quote['font-family'] . ';
			}

			/* CUSTOM BACKGROUND */

		';

		if ( isset( $body['image'] ) && $body['image'] != '' ) {

			$custom_css .= 'html.boxed {
				background-image:url(' . $body['image'] . ');
				background-repeat:no-repeat;
				background-position:center center;
				background-attachment:fixed;
				-webkit-background-size: cover;
			 	-moz-background-size: cover;
			  	-o-background-size: cover;
			  	background-size: cover;
			}';

		} else if ( isset( $body['pattern'] ) && $body['pattern'] != '' ) {

			$custom_css .= 'html.boxed {
				background-image:url(' . $body['pattern']. ');
				background-repeat:repeat;
				background-position:0 0;
				background-attachment:fixed;
			}';

		}

		$custom_css .= '

			html {
				background-color:' .  $body['fullcolor'] . ' !important;
			}
			body {
				background:' .  krown_hex_to_rgba('#FFFFFF', $bop) . '
			}

			/* CUSTOM COLORS */

			i.i-medium,
			input[type="submit"]:hover,
			.no-touch .buttons a:hover,
			.no-touch .classic .pTitle:hover h2:before,
			.no-touch #comments-title:hover:after,
			.no-touch .rbAccordion.large > section > h4:hover:before,
			.no-touch .rbPosts.classic header:hover a:before,
			.rbPricingTable .featured header,
			.no-touch .rbTextIcon.large > a:hover > i,
			.no-touch .rbSocial.thumbnails ul li:hover,
			.no-touch .tagcloud > a:hover,
			.no-touch #footer1 input[type="submit"]:hover,
			.no-touch #footer1 .tagcloud > a:hover,
			.minimal-2 .tabs span,
			.no-touch .dark_menu #menu li ul li:hover > a, .no-touch #menu li > ul li:hover > a,
			.no-touch .complex .side .nav a:hover,
			.mejs-controls .mejs-time-rail .mejs-time-current,
			.mejs-controls .mejs-horizontal-volume-slider .mejs-horizontal-volume-current,
			.mejs-controls .mejs-volume-button .mejs-volume-slider .mejs-volume-current,
			.no-touch #searchform .holder:hover .icon-search,
			.no-touch .rbButton.dark:hover, .rbButton.light, .no-touch input[type="submit"]:hover,
			.product .button.add_to_cart, .cart-contents:hover:before, .widget_price_filter .price_slider_amount .button:hover, .woocommerce .buttons a:hover, .woocommerce-pagination li a:hover, .product_list_widget .imgCover, .single-product .cart .button:hover, .product-quantity .button:hover, .single-product .cart input:hover, .product-quantity input:hover, .shop_table .product-remove a:hover, .checkout-button.button, .woocommerce button.button:hover, ul.products li .button:hover, .tp-caption.button_light > a, .tp-caption.button_dark > a:hover, .no-touch .blank .tparrows:hover:before, .main-btn:hover, .woocommerce button.button:hover, .woocommerce .button:hover, .no-touch .ignitiondeck.idc_lightbox .form-row.submit input[type="submit"]:hover, .video-embedded .mejs-overlay-play:hover .mejs-overlay-button, .no-touch .blank .tparrows.default:hover:before, .no-touch #searchform .holder:hover .krown-icon-search, .no-touch .rbTextIcon.one > a:hover > i {
				background-color:' . $colors['main1']. ';
			}

			.no-touch .modern .post:not(.opened) > a:hover .pTitle:before {
				background-color:' . $colors['main1']. ';
			}

			.no-touch a:hover, .no-touch #menu a:hover,
			.no-touch #pageTitle a:hover,
			.no-touch.csstransitions .tone #items a:hover h3, .tone #items a.iehover h3,
			.no-touch .classic .pTitle h2:hover,
			.no-touch .classic .meta a:hover,
			.no-touch #comments-title:hover,
			.no-touch #comments-title:hover:before,
			.no-touch .comment-reply-link:hover:before,
			.await,
			#comment-status p,
			.no-touch .rbAccordion.small > section > h4:hover, .no-touch .rbAccordion.small > section > h4:hover:before,
			.no-touch .rbAccordion.large > section > h4:hover,
			.no-touch .rbContactInfo ul li a:hover:before,
			.no-touch .rbContactInfo ul li a:hover,
			.errorMessage,
			.no-touch .rbCustomPosts a:hover h4,
			.no-touch .rbCustomPosts a:hover .comments i:before,
			.no-touch .rbPosts.classic header:hover h3,
			.no-touch .rbTextIcon > a:hover > h4,
			.no-touch .rbTextIcon.minimal > a:hover > i,
			.no-touch .rbTwitter li a:hover, .no-touch .rbTwitter .time:hover, .no-touch .rbTwitter > a:hover span,
			.no-touch .rbSocial.list li:hover:before, .no-touch .rbSocial.list li:hover a,
			.no-touch .rbSocial.icons li:hover:before,
			.no-touch .rbTabs .titles li a:hover,
			.no-touch .widget.email a:hover i, .no-touch .widget.phone a:hover i,
			.no-touch .widget_meta ul li a:hover:before, .no-touch .widget_meta ul li a:hover,
			.no-touch .widget_pages ul li a:hover, .no-touch .widget_categories ul li a:hover, .no-touch .widget_archive ul li a:hover, .no-touch .widget_recent_entries ul li a:hover, .no-touch .widget_recent_comments ul li a:hover, .no-touch .widget_rss ul li a:hover, #breadcrumb a:hover, #breadcrumb .icon-home:hover, .no-touch #menu > ul > li:hover > a, .no-touch .rbButton.light:hover, .woocommerce-pagination .next:hover, .woocommerce-pagination .prev:hover, p.out-of-stock, .tp-caption.button_light > a:hover, .id-level-title, .progress-percentage, .no-touch.csstransitions ul.products li:hover h3, .ul.products li.iehover h3, .no-touch .miniF .product-name a:hover, .no-touch .rbTextIcon.two > a:hover > i {
				color:' . $colors['main1']. ';
			}

			.no-touch .modern .post:not(.opened) > a:hover .pTitle,
			.no-touch .morePosts:not(.nomore):hover span,
			.no-touch .morePosts:not(.nomore):hover span:before {
				color:' . $colors['main1']. ';
			}

			.ttwo #items .caption,
			.no-touch .anything.folio .arrow a:hover span,
			.minimal-1 .mainControls .m-timer,
			.no-touch .minimal-1 .mainControls .thumbNav li a:hover,
			.no-touch .minimal-1 .mainControls .arrow a:hover span,
			.no-touch .mejs-overlay:hover .mejs-overlay-button, .ch .hover, 
			.no-touch .fancybox-nav span:hover, .no-touch .fancybox-close:hover, .ch .hover, .onsale, .blank .tp-bannertimer, .fancybox-thumb span, .product-video-container.hasvideo .id_thevideo:hover:after {
				background-color:' . $colors['main1']. ';
				background-color:' . krown_hex_to_rgba( $colors['main1'], .9) . ';
			}

			.no-touch #menu > ul > li:hover > a,
			.no-touch.csstransitions .tone #items a:hover .caption, .tone #items a.iehover .caption,
			.no-touch #comments-title:hover:after,
			.contactErrorBorder, .no-touch .rbTextIcon.large:hover, .rbTabs .titles li.opened a, .widget_nav_menu .current-menu-item, .ui-slider-horizontal .ui-slider-handle:hover, .star-rating .star, .comment-form-rating a.star, .no-touch.csstransitions ul.products li:hover .caption, ul.products li.iehover .caption, .no-touch .rbTextIcon.one:hover {
				border-color:' . $colors['main1']. ';
			}

			.no-touch .morePosts:not(.nomore):hover,
			.no-touch .morePosts:not(.nomore):hover span {
				border-color:' . $colors['main1']. ';
			}

			@media all and (max-width: 940px) {

				.no-touch #menu .responsive:hover {
					background:' . $colors['main1']. ';
				}
				#menu li a:hover {
					color:' . $colors['main1']. ' !important;
				}

			}

			/* CUSTOM CSS */

		';

		$custom_css .= ot_get_option( 'rb_custom_css', '' );

		// Embed Custom CSS

		wp_add_inline_style( 'krown-style', $custom_css );

	}

}

add_action( 'wp_enqueue_scripts', 'krown_custom_css', 101 );

?>