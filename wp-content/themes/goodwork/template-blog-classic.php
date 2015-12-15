<?php
/**
 * Template Name: Blog - Classic
 */
get_header(); ?>

	<div class="postsContainer classic">

		<?php while ( have_posts() ) : the_post(); 

			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );

			$args = array(
				'paged' => $paged, 
				'post_type' => 'post'
			);
			$all_posts = new WP_Query( $args );

			while ( $all_posts->have_posts() ) : $all_posts->the_post();

				get_template_part( 'content' );

			endwhile;

			krown_pagination( $all_posts, true );
			
		endwhile; ?>

	</div>

<?php get_footer(); ?>