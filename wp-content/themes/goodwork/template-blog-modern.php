<?php
/**
 * Template Name: Blog - Modern
 */
get_header(); ?>

	<div class="postsContainer modern">

		<div id="filter">

			<p><?php _e( 'Showing', 'goodwork' ); ?></p>

			<ul class="clearfix">
				<li class="active"><a href="#" data-filter="*"><?php _e( 'All', 'goodwork' ); ?></a></li>

				<?php 

				$blog_categories = get_categories(array( 'type'=>'post', 'orderby' => 'name' ) );
				foreach ( $blog_categories as $cat ) {
					echo '<li><a href="#" data-filter=".category-' . $cat->slug . '">' . $cat->name . '</a></li>';
				}

				?>

			</ul>

		</div>

		<?php while ( have_posts() ) : the_post(); 

			$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : ( get_query_var( 'page' ) ? get_query_var( 'page' ) : 1 );

			$args = array(
				'paged' => $paged, 
				'post_type' => 'post',
				'posts_per_page' => -1
			);

			$all_posts = new WP_Query( $args );

			global $kI;
			global $kT;

			$kI = 0;
			$kT = get_option( 'krown_modern_blog_ppp', '8' );

			while ( $all_posts->have_posts() ) : $all_posts->the_post();

				get_template_part( 'content-modern' );

			endwhile;
			
		endwhile; ?>

		<a class="clearfix morePosts" href="#"><span data-more="<?php _e( 'Load More Posts', 'goodwork' ); ?>" data-less="<?php _e( 'No More Posts', 'goodwork' ); ?>"><?php _e( 'Load More Posts', 'goodwork' ); ?></span></a>

	</div>

<?php get_footer(); ?>