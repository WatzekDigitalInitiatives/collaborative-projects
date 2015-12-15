<?php
/**
 * The template for displaying archives.
 */
get_header();
$titles = krown_check_archive_title();
?>

	<h1 class="title"><?php echo $titles[0]; ?></h1>
	<hr style="margin:-30px 0 40px" />

	<div class="postsContainer classic">

		<?php if ( $titles[1] != '' ) : ?>

			<h4 class="result more">
				<?php echo $titles[1]; ?>
			</h4>

		<?php endif; ?>

		<?php 

			while ( have_posts() ) : the_post();

				get_template_part( 'content' );
					
			endwhile;

			krown_pagination( null, true );

		?>
		
	 </div>
	
<?php get_footer(); ?>