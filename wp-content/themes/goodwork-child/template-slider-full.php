<?php
/*---------------------------------
	Template Name: Page with a Slider (Full Width)
------------------------------------*/
get_header(); 
?>

</div>

	<?php if ( have_posts() ) while ( have_posts() ) : the_post(); 

		echo '<div class="rev blank fullwidth">';
		putRevSlider(get_post_meta($post->ID, 'rb_slider_alias', true));
		echo '</div>'; ?>

	<div class="wrapper clearfix">

	<article id="content" class="clearfix">
<?php if (is_page('Home')) {

 

?>
<div class="wpb_content_element span4 column_container">
			 <div class="row-fluid">
	<div class="wpb_content_element span12 wpb_raw_html">
		<div class="wpb_wrapper">
<section id="categories-4" class="widget sidebox widget_categories clearfix">
<ul>
<?php

$args = array(
  'taxonomy' => 'portfolio_category',
  'parent' => 6,
  'orderby' => 'name',
  'order' => 'ASC'
);
$categories = get_categories( $args );

foreach ($categories as $category) {
    echo "<li><a href='/projects/?f=$category->slug'>$category->name</a></li>";
}

?>

</ul>
</section>
</div></div></div></div>
<?php
} ?>
	<?php the_content(); ?>



	<?php endwhile; ?>      

<?php get_footer(); ?>