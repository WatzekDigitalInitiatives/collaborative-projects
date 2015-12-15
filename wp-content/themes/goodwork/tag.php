<?php
/*---------------------------------
	Tags Page Template
------------------------------------*/
get_header(); 
?>
	
<h1 class="title"><?php _e('Tags Archives', 'goodwork'); ?></h1>
<hr style="margin:-30px 0 40px" />

<div class="postsContainer classic">

	<h4 class="result more">
		<?php _e( 'You are currently viewing all posts tagged with <em>' . single_tag_title('', false) . '</em>.', 'goodwork' ); ?>
	</h4>
	
		<?php get_template_part( 'loop', 'tag' ); ?>
				
		<?php rb_pagination('', 1) ?>

</div>
	
<?php get_footer(); ?>