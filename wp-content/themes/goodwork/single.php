<?php
/**
 * The Template for displaying all single posts.
 */
get_header(); 
$type = isset( $_GET['m'] ) ? 'modern' : 'classic';
?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>
	
	<?php krown_set_post_views( $post->ID );
		$post_format = get_post_format() == '' ? __('standard', 'goodwork') : get_post_format();
	 ?>

	<?php if( $type == 'modern' ) : ?>

		<article id="post-<?php the_ID();?>" <?php post_class( 'modern' ); ?>>
		
			<header>
				<time class="pTime" pubdate datetime="<?php the_time( 'c' ); ?>"><?php the_time( __( 'jS F Y', 'goodwork' ) ); ?></time>
				<h3 class="pTitle icon-none"><?php the_title(); ?></h3>
			</header>

			<section id="pContent">

				<?php krown_post_format_content( $post->ID, get_post_format() ); ?>

				<?php the_content(); ?>	

				<span class="meta-holder">
					<span class="meta-title"><?php _e( 'Tags:', 'krown' ); ?></span>
					<?php the_tags( '' ); ?>
				</span>

				<?php if ( comments_open() && ot_get_option( 'rb_allow_blog_comments', 'true') == 'true' ) : ?>

					<footer>
						<?php comments_template( '', true ); ?>
					</footer>

				<?php endif; ?>

			</section>

		<article>

	<?php else : ?>

		<div class="postsContainer classic"><article id="post-<?php the_ID(); ?>" <?php post_class('post clearfix'); ?>>

			<a class="pTitle clearfix" href="<?php echo get_post_format() == 'link' ? get_post_meta($post->ID, 'rb_meta_box_post_assets_l', true) : get_permalink(); ?>">
				<h2 class="icon-none"><?php the_title(); ?></h2>
			</a>

			<?php krown_post_format_content( $post->ID, get_post_format() ); ?>

			<section class="content clearfix">

				<ul class="meta">
					<li class="date">
						<i class="icon krown-icon-calendar-1"></i>
						<time pubdate datetime="<?php the_time( 'c' ); ?>">
							<span class="p1"><?php the_time( __( 'jS F Y', 'goodwork' )); ?></span>
							<span class="pTime p2"><?php the_time( __( 'j/m/y', 'goodwork' )); ?></span>
						</time>
					</li>
					<li class="type">
						<i class="icon krown-icon-tag"></i>
						<a href="<?php echo get_post_format_link( $post_format ); ?>"><span><?php echo ucfirst( $post_format ); ?></span></a>
					</li>
					<li class="comments">
						<i class="icon krown-icon-comment-1"></i>
						<a href="<?php the_permalink(); ?>#comments"><?php comments_number( '0', '1', '%' ); ?></a>
					</li>
				</ul>

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

				<span class="meta-holder">
					<span class="meta-title"><?php _e( 'Tags:', 'krown' ); ?></span>
					<?php the_tags( '' ); ?>
				</span>

			</section>

			<?php if ( comments_open() ) : ?>
			
				<footer>
					<?php comments_template( '', true ); ?>
				</footer>

			<?php endif; ?>

	    </article></div>

	<?php endif; ?>

	<?php endwhile; ?>

<?php get_footer(); ?>