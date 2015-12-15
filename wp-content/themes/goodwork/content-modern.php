<?php
/**
 * The default template for displaying content. Used for the modern blog.
 */
$post_format = get_post_format() == '' ? 'standard' : get_post_format();
global $kI;
global $kT;
?>
				
<article id="post-<?php the_ID(); ?>" <?php post_class( $post->post_name . ' clearfix' ); ?><?php echo $kI++ >= $kT ? ' style="height:0"' : ''; ?>>

	<a class="clearfix" href="<?php echo get_post_format() == 'link' ? get_post_meta( $post->ID, 'rb_meta_box_post_assets_l', true ) : get_permalink(); ?>" data-slug="<?php echo $post->post_name; ?>" data-type="<?php echo $post_format; ?>">

		<header>
			<time pubdate datetime="<?php the_time( 'c' ); ?>">
				<span class="pTime"><?php the_time( __( 'jS F Y', 'goodwork' ) ); ?></span>
				<span class="pTime p2"><?php the_time( __( 'j/m/y', 'goodwork' ) ); ?></span>
			</time>
			<h3 class="pTitle icon-none"><?php the_title(); ?></h3>
		</header>

		<footer>
			<div class="pComments icon-none"><?php comments_number( '0', '1', '%' ); ?></div>
			<div class="pType icon-none"><?php echo ucfirst( $post_format ); ?></div>
		</footer>

	</a>

</article>