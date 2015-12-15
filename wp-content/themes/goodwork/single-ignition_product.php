<?php
/**
 * The Template for displaying all single funding projects.
 */
get_header(); 
?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
	<?php krown_set_post_views( $post->ID );
		$post_format = get_post_format() == '' ? __('standard', 'goodwork') : get_post_format();
	 ?>

	<div class="postsContainer classic"><article id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>

		<?php krown_post_format_content( $post->ID, get_post_format() ); ?>

		<section class="content clearfix">

			<div class="excerpt">
				<?php the_content();

				wp_link_pages( array( 
					'before'           => '<nav class="morepages">' . '<span>' . __( 'Pages:', 'goodwork' ) . '</span>',
					'after'            => '</nav>',
					'link_before'      => '<strong>',
					'link_after'       => '</strong>',
					'next_or_number'   => 'number',
					'pagelink'         => '%',
					'echo'             => 1
					)
				);  ?>
			</div>

		</section>

		<?php if ( comments_open() ) : ?>
		
			<footer>
				<?php comments_template( '', true ); ?>
			</footer>

		<?php endif; ?>

    </article></div>

	<?php endwhile; ?>

<?php get_footer(); ?>