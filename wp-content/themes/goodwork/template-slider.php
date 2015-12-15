<?php
/**
 * Template Name: Page with a Slider
 */
get_header(); 
?>

	<?php if ( have_posts() ) the_post(); 

		$slider_output = '<div class="rev papa ' . get_post_meta($post->ID, 'rb_slider_skin', true) . ' clearfix">';
		$js_output = '';

		$slider = get_post_meta( $post->ID, 'rb_slider_rev_minimal', true );

		// Get slider output

		if ( strpos( $slider, 'rev_slider' ) > 0 ) {
			$slider_output .= do_shortcode( $slider );
		} else {
			$slider_output .= do_shortcode( '[rev_slider ' . $slider . ']' );
		}

		// Get API title 

		preg_match( "/(revapi.+;)/", $slider_output, $matches );
		if ( ! empty( $matches[0] ) ) {
			$api = str_replace( array( ';', "\n" ), '', $matches[0] );
		}

		// Start custom javascript code

		$js_output .= '<script type="text/javascript">
			var $ = jQuery.noConflict();

			$(document).ready(function(){

				var $slider = $(".papa.rev"),
					api = ' . $api . ';';

		// For all cases, design custom skin and paste the proper javascript code

		switch ( get_post_meta($post->ID, 'rb_slider_skin', true ) ) {

			case 'minimal-1' :

				$slider_output .= '<div class="mainControls clearfix">
						<div class="caption"></div>
						<div class="ccontrols clearfix"><span class="arrow back"><a href="#"><span>&larr;</span></a></span><span class="arrow forward"><a href="#"><span>&rarr;</span></a></span><div class="ul"></div></div>
					</div>
					<ul class="dummy-captions clearfix">';

				$tabs = get_post_meta( $post->ID, 'rb_slider_rev_complex', true );

				if ( ! empty( $tabs ) ) {
					foreach ( $tabs as $tab ) {
						$slider_output .= '<li>' . $tab['title'] . '</li>';
					}
				}

				$slider_output .= '</ul>';

				$js_output .= '

					var $captions = $slider.find(".dummy-captions").children("li"),
					$mCaption = $slider.find(".mainControls").children(".caption"),
					$timer = $slider.find(".tp-bannertimer");

					api.on("revolution.slide.onchange", function(e,data) {

						if($timer.data("opt") != undefined) {

							$mCaption.find(".m-timer").stop().animate({"width": 0}, 190, "linear", function(){
								$(this).remove();
							});
							$mCaption.children("p").stop().fadeOut(190, function(){
								$(this).remove();
							});

							text = $captions.eq(data.slideIndex-1).text();

							var ccWidth = $captions.eq(data.slideIndex-1).width() == 0 ? 0 : $captions.eq(data.slideIndex-1).width() + 60;

							$mCaption.append("<p>" + text + "</p><div class=\'m-timer\'></div>")
								.delay(200).animate({"width" : ccWidth}, 500, "easeInQuad", function(){
									$(this).find("p").delay(200).animate({"opacity": 1}, 200);
								}).find(".m-timer").delay(200).animate({"width": ccWidth}, $timer.data("opt").delay, "linear");

						}

					});

					api.on("revolution.slide.onpause",function (e,data) {
						$mCaption.find(".m-timer").pause();
					});

					api.on("revolution.slide.onresume",function (e,data) {
						$mCaption.find(".m-timer").resume();
					});

					api.on("revolution.slide.onstop",function (e,data) {
						$mCaption.find(".m-timer").stop().animate({"width": 0}, 200, "linear", function(){
							$(this).remove();
						});
					});

					api.on("revolution.slide.onloaded",function (e,data) {

						$slider.find(".arrow.forward").on("click", function(){
							api.revnext();
							return false;
						});
						$slider.find(".arrow.back").on("click", function(){
							api.revprev();
							return false;
						});

					});';

				break;

			case 'minimal-2' :

				$slider_output .= '<ul class="tabs clearfix">';

				$tabs = get_post_meta( $post->ID, 'rb_slider_rev_complex', true );

				if ( ! empty( $tabs ) ) {
					foreach ( $tabs as $tab ) {
						$slider_output .= '<li><i class="' . $tab['icon'] . '"></i>
							<h3>' . $tab['title'] . '</h3>
							<h5>' . $tab['subtitle'] . '</h5>
							<span></span>
						</li>';
					}
				}

				$slider_output .= '</ul>';

				$js_output .= '

					var $tabs = $slider.find(".tabs").children("li"),
						$timer = $slider.find(".tp-bannertimer");

					$tabs.click(function(){
						api.revshowslide($(this).index()+1);
					});

					api.on("revolution.slide.onchange",function (e,data) {
						if($timer.data("opt") != undefined) {
							$tabs.eq($timer.data("opt").act).removeClass("active").find("span").stop().animate({"width": 0}, 150, "linear");
							$tabs.eq(data.slideIndex-1).addClass("active").find("span").stop().animate({"width": "100%"}, $timer.data("opt").delay+100, "linear");
						}
					});

					api.on("revolution.slide.onpause",function (e,data) {
						$tabs.eq($timer.data("opt").act).find("span").pause();
					});

					api.on("revolution.slide.onresume",function (e,data) {
						$tabs.eq($timer.data("opt").act).find("span").resume();
					});

					api.on("revolution.slide.onstop",function (e,data) {
						$tabs.eq($timer.data("opt").act).find("span").stop().animate({"width": 0}, 150, "linear");
					});

					api.on("revolution.slide.onloaded",function (e,data) {
						$tabs.eq(0).addClass("active").find("span").stop().animate({"width": "100%"}, $timer.data("opt").delay+100, "linear");
					});';

				break;

			case 'complex' :

				$slider_output .= '<div class="side clearfix">';

				$btns = '';
				$tabs = get_post_meta($post->ID, 'rb_slider_rev_complex', true);

				if ( ! empty($tabs ) ) {
					foreach ( $tabs as $i => $tab ) {
						$slider_output .= '<div class="content">
							<h3>' . $tab['title'] . '</h3>
							<p>' . $tab['rich_html'] . '</p>
						</div>';
						$btns .= '<a' . ($i==0 ? ' class="selected"' : '') . ' href="#">' . $i . '</a>';
					}
				}

				$slider_output .= '<div class="nav clearfix">' . $btns . '</div>';
				$slider_output .= '</div>';

				$js_output .= '

					var $tabs = $slider.find(".side").children("div.content"),
					$selTab = $tabs.eq(0),
					$buttons = $slider.find(".nav").children("a"),
					$selBtn = $buttons.eq(0),
					$slides = $slider.find(".rev_slider").children("ul").children("li"),
					enableBtn = false;

					//api.revpause();

					$buttons.click(function(){
						if(enableBtn){
							enableBtn = false;
							api.revshowslide($(this).index()+1);
						}
						return false;
					});

					api.on("revolution.slide.onchange",function (e,data) {

						$selBtn.removeClass("selected");
						$selBtn = $buttons.eq(data.slideIndex-1);
						$selBtn.addClass("selected");

						$selTab.stop().fadeOut(500);
						$selTab = $tabs.eq(data.slideIndex-1);
						$selTab.stop().delay(500).fadeIn(500);

						setTimeout(function(){
							enableBtn = true;
						}, 3000);

					});';

				break;

			default :

				$js_output .= '

				api.on("revolution.slide.onloaded",function (e,data) {
					$slider.find(".bullet").append("<span></span>");
				});';

		}

		$js_output .= '});</script>';

		$slider_output .= $js_output . '</div>';

		// Output slider and continue

		echo $slider_output;

	the_content();

get_footer(); ?>