<?php
/*---------------------------------
	Category Page Template
------------------------------------*/
get_header(); 
?>

<h1 class="title"><?php _e('Categories Archives', 'goodwork'); ?></h1>
<hr style="margin:-30px 0 40px" />

<div class="postsContainer classic">

	<h4 class="result more">
		<?php _e( 'You are currently viewing all posts published under <em>' . get_category(get_query_var('cat'))->name . '</em>.', 'goodwork' ); ?>
	</h4>
	
		<?php get_template_part( 'loop', 'category' ); $modern = false; ?>
				
		<?php rb_pagination('', 1); ?>

</div>
	
<?php get_footer(); ?>