<?php
/**
 * The default template for displaying content. Used for both single and index/archive/search.
 */
$post_format = get_post_format() == '' ? 'standard' : get_post_format();
?>
		
<article id="post-<?php the_ID(); ?>" <?php post_class( 'clearfix' ); ?>>

	<a class="pTitle clearfix" href="<?php echo get_post_format() == 'link' ? get_post_meta( $post->ID, 'rb_meta_box_post_assets_l', true ) : get_permalink(); ?>">
		<h2 class="icon-none"><?php the_title(); ?></h2>
	</a>

	<?php krown_post_format_content( $post->ID, get_post_format() ); ?>

	<div class="content">

		<ul class="meta">

			<li class="date">
				<i class="icon krown-icon-calendar-1"></i>
				<time pubdate datetime="<?php the_time( 'c' ); ?>">
					<span class="p1"><?php the_time( __( 'jS F Y', 'goodwork' ) ); ?></span>
					<span class="pTime p2"><?php the_time( __( 'j/m/y', 'goodwork' ) ); ?></span>
				</time>
			</li>
			<li class="type">
				<i class="icon krown-icon-tag"></i>
				<a href="<?php echo get_post_format_link( $post_format ); ?>"><span><?php echo ucfirst( $post_format ); ?></span></a>
			</li>
			<li class="comments">
				<i class="icon krown-icon-comment-1"></i>
				<a href="<?php the_permalink(); ?>#comments"><?php comments_number('0', '1', '%'); ?></a>
			</li>

		</ul>

		<div class="excerpt">

			<p class="post-excerpt"><?php echo krown_excerpt( 'krown_excerptlength_post'); ?></p>

			<a href="<?php the_permalink(); ?>" class="more nav-next"><?php _e( 'Read more', 'goodwork' ); ?></a>

		</div>

	</div>

</article>