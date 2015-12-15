<?php
/**
 * 404 Page Template
 */
get_header(); ?>

	<?php if ( get_option( 'krown_404_page', '' ) != '') : 

		$content_post = get_post( get_option('krown_404_page' ) );
		$content = $content_post->post_content;
		$content = apply_filters( 'the_content', $content );
		$content = str_replace( ']]>', ']]&gt;', $content );
		echo $content;

	else : ?>

		<div class="postsContainer classic">

			<h4 class="more">
				<?php _e( 'Apologies, but the page you requested could not be found. Perhaps searching will help. Additionally you can return to our home page and start over.', 'goodwork' ); ?>
			</h4>

		</div>

	<?php endif; ?>

	<?php rewind_posts(); ?>
	
<?php get_footer(); ?>