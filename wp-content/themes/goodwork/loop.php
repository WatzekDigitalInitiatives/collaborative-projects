<?php
/*---------------------------------
	The loop that displays all posts
------------------------------------*/
?>

<?php //If there are no posts to display, such as an empty archive page ?>
<?php if ( ! have_posts() ) : ?>
		<h2><?php _e( 'Not Found', 'goodwork' ); ?></h2>
		<p><?php _e( 'Apologies, but no results were found for the requested archive. Perhaps searching will help find a related post.', 'goodwork' ); ?></p>
		<?php get_search_form(); ?>

<?php endif; ?>

<?php while ( have_posts() ) : the_post(); ?>

	<?php $post_format = get_post_format() == '' ? __('standard', 'goodwork') : get_post_format(); ?>

	<?php if(get_post_type($post->ID) != 'pricing') : ?> 

	<article id="post-<?php echo $post->ID; ?>" <?php post_class('post clearfix'); ?>>

		<a class="pTitle clearfix" href="<?php echo get_post_format() == 'link' ? get_post_meta($post->ID, 'rb_meta_box_post_assets_l', true) : get_permalink(); ?>">
				<h2 class="icon-none"><?php the_title(); ?></h2>
		</a>
		
		<?php if($post->post_type != 'page') :

			rb_get_post_format_content($post->ID, get_post_format());

		endif; ?>

		<div class="content">

			<?php if($post->post_type == 'post') : ?>

				<ul class="meta">
					<li class="date"><i class="icon icon-calendar-1"></i><span><?php the_time('jS F Y'); ?></span></li>
					<li class="type"><i class="icon icon-tag"></i><a href="<?php echo get_post_format_link($post_format); ?>"><?php echo ucfirst($post_format); ?></a></li>
					<li class="comments"><i class="icon icon-comment-1"></i><a href="<?php the_permalink(); ?>#comments"><?php comments_number('0', '1', '%'); ?></a></li>
				</ul>

			<?php else: ?>

				<ul class="meta">
					<li class="date"><i class="icon icon-calendar-1"></i><span><?php the_time('jS F Y'); ?></span></li>
				</ul>

			<?php endif; ?>

			<div class="excerpt">
				<?php echo rb_excerpt('rb_post', 'rb_more') != '' ? '<p>' . rb_excerpt('rb_post', 'rb_more') . '</p>' : ''; ?>
				<a href="<?php the_permalink(); ?>" class="more nav-next"><?php _e('Read more', 'goodwork'); ?></a>
			</div>

		</div>

	</article>

	<?php endif ;?>

	<?php if ( is_archive() || is_search() ) : ?>
		<!-- Search & Archive Results -->
	<?php else : ?>

	<?php endif; ?>

<?php endwhile;
	wp_reset_query();
 ?>