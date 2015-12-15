<?php
/**
 * Template Name: Sitemap
 */
get_header(); ?>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

		<?php the_content(); ?>

		<div class="row-fluid">

			<section class="widget widget_archive span6 wpb_content column_container cwidget swidget">
				<div class="widget-title">
					<h4><?php _e( 'All pages', 'goodwork' ); ?>
				</div>
			   <ul><?php wp_list_pages( 'title_li=' . ( get_option('krown_404_page') != '' ? '&exclude=' . get_option('krown_404_page') : '' ) ); ?></ul> 
			</section>
			
			<section class="widget widget_archive span6 wpb_content column_container cwidget">
				<div class="widget-title">
					<h4><?php _e( 'Latest 20 posts', 'goodwork' ); ?>
				</div>
			   <ul><?php wp_get_archives( 'type=postbypost&limit=20&show_post_count=1' ); ?></ul> 
			</section>

		</div>

	<?php endwhile; ?>      

<?php get_footer(); ?>