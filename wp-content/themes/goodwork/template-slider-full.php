<?php
/**
 * Template Name: Page with a Slider (Full Width)
 */
get_header(); 
?>

</div>

	<?php if ( have_posts() ) the_post(); 
	
		$slider = get_post_meta( $post->ID, 'rb_slider_alias', true );

		echo '<div class="rev blank fullwidth">';

		if ( strpos( $slider, 'rev_slider' ) > 0 ) {
			echo do_shortcode( $slider );
		} else {
			echo do_shortcode( '[rev_slider ' . $slider . ']' );
		}

		echo '</div>'; ?>

	<div class="wrapper clearfix">

	<article id="content" class="clearfix">

	<?php the_content(); ?>    

<?php get_footer(); ?>