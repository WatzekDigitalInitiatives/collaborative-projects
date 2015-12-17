<?php get_header(); 

	if ( have_posts() ) while ( have_posts() ) : the_post(); ?>

<?php 

	global $sidebar;

    //var_dump($sidebar);




	$v_page = isset($_GET['id']) ? $_GET['id'] : ot_get_option('rb_def_p_page', '');

	$v_ajax = get_post_meta($v_page, 'rb_def_p_ajax', true);
	$v_filter = get_post_meta($v_page, 'rb_def_p_filtering', true);
	$v_columns = get_post_meta($v_page, 'rb_def_p_columns', true);
	$v_thumbnails = get_post_meta($v_page, 'rb_def_p_thumbnails', true);
	$v_related = get_post_meta($v_page, 'rb_def_p_related', true);

	$cats_excluded = array();
	$cats_included = get_post_meta($v_page, 'rb_meta_box_portfolio_set', true);
	$cats_all = get_categories(array('taxonomy'=>'portfolio_category'));

	if(!empty($cats_included))
		foreach($cats_all as $cat) {
			if(!in_array($cat->slug, $cats_included)){
				array_push($cats_excluded, $cat->cat_ID);
			}
		}

	$cats_excluded = implode(', ', $cats_excluded);

	//$next_post = rb_get_adjacent_post(false, $cats_excluded, false, 'portfolio_category');
	//$prev_post = rb_get_adjacent_post(false, $cats_excluded, true, 'portfolio_category');
	
?>

	<div id="projectDetails" data-slider-height="<?php echo get_post_meta($post->ID, 'rb_slider_height', true); ?>">

        

	<header id="projectTitle" class="clearfix">
		<!--<h2><?php the_title(); ?></h2>-->
		<!--<nav class="buttons">
			<?php if (!empty( $next_post )): ?>
			  <a class="btnPrev" href="<?php echo get_permalink( $next_post->ID ); ?>?id=<?php echo $v_page; ?>" data-slug="<?php echo $next_post->post_name; ?>"></a>
			<?php endif;
			if (!empty( $prev_post )): ?>
			  <a class="btnNext" href="<?php echo get_permalink( $prev_post->ID ); ?>?id=<?php echo $v_page; ?>" data-slug="<?php echo $prev_post->post_name; ?>"></a>
			<?php endif; ?>
			<a href="<?php echo $v_page == '' ? '#' : get_permalink($v_page); ?>" class="btnClose"><span style="margin-left:-2px"></span></a>
		</nav>-->
	</header>

	<div class="flexslider pFolio folio" id="slider-<?php echo $post->ID; ?>">

		<ul class="slides">
		<?php $slides = get_post_meta($post->ID, 'rb_folio_slider', true);
			if(!empty($slides)) :
				
				foreach($slides as $slide) : 

					
					if($slide['rb_slide_image'] != '') : ?>
						<li data-caption="<?php echo $slide['rb_slide_caption']; ?>">
							<?php
							$img_url = $slide['rb_slide_image']; 
							$img_url=str_replace("https", "http", $img_url); /* for some reason aq_resize doesn't work with https*/
							$width = $sidebar['sidebar_type'] != '' && $sidebar['sidebar_type'] != 'full-width' ? '700' : '940';
							$image = aq_resize($img_url, $width, null, false, false);
							?>
							<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php echo $slide['title']; ?>" />
						</li>

					<?php elseif($slide['rb_slide_video_code'] != '') : ?>
						<li><?php echo $slide['rb_slide_video_code']; ?></li>

					<?php elseif($slide['rb_slide_video_1'] != '') : ?>
						<li><video id="video-<?php echo $post->ID; ?>" class="video-js vjs-default-skin pMedia" controls preload="auto" width="100%" height="100%" poster="<?php echo $slide['rb_slide_video_3']; ?>" data-setup="{}" style="width:100%;height:100%;">
								<source src="<?php echo $slide['rb_slide_video_1']; ?>" type="video/mp4">
								<source src="<?php echo $slide['rb_slide_video_2']; ?>" type="video/ogg">
							</video>
						</li>

					<?php endif; ?>

				<?php endforeach;
			endif; ?>
		</ul>

	</div>

	<div class="clearfix">
		

                <?php $research_question = get_post_meta($post->ID,'wdi_research_question',true); ?>
                      <h3><?php echo $research_question;?></h3>

                <?php //$abstract = get_post_meta($post->ID,'wdi_project_abstract',true); ?>
                <?php $abstract= wpautop( get_post_meta( $post->ID,'wdi_project_abstract',true ) ); ?>
                      <div id="abstract">
                         <h5>Project Abstract</h5>
                         <p><?php echo $abstract;?></p>
                      </div>
                 
                <?php if (get_post_meta($post->ID,'wdi_canvas',true)) {
                       $canvas = get_post_meta($post->ID,'wdi_canvas',true); 
                       $canvas = wpautop( get_post_meta( $post->ID,'wdi_canvas',true ) );
                       ?>
                       <div id="canvas">
                          <h5>More about this project</h5>
                          
                          <?php  /* the apply_fliters enables shortcodes to work*/                ?>
                          <p><?php echo apply_filters( 'the_content', $canvas );?></p>
                   
                       </div>
                     <?php } ?>
              
	</div>

</div>

	<?php $tags = array();
			
		$post_terms = wp_get_object_terms($post->ID, 'portfolio_category');
		$tag = isset($post_terms[0] -> slug) ? $post_terms[0] -> slug : '';
		if(!empty($post_terms)){
			if(!is_wp_error( $post_terms ))
				foreach($post_terms as $term)
					array_push($tags, $term->slug); 
		}

	endwhile; ?>

	<?php if($v_related == 'true') : ?>

	<header class="sectionTitle clearfix con-none" style="margin-bottom:35px">
		<h3><?php _e('Related Projects', 'goodwork'); ?></h3>
	</header>

   	<div id="portfolio" class="t<?php echo $v_thumbnails; ?> c<?php echo $v_columns; ?> clearfix">

   		<ul id="items">

			<?php $paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;

				$args = array( 'posts_per_page' => $sidebar['sidebar_type'] != '' && $sidebar['sidebar_type'] != 'full-width' ? 3 : ($v_columns == 'four' ? 4 : ($v_columns == 'three' ? 3 : 2)),
					   'offset'=> 0,
					   'post_type' => 'portfolio',
					   'orderby' => 'rand',
					   'portfolio_category' => implode($tags, ','));

				$all_posts = new WP_Query($args);
				while($all_posts->have_posts()) : $all_posts->the_post();
					
			?>

			<li class="item <?php rb_get_categories($post->ID, 'portfolio_category', ' ', 'slug'); ?>">
				<a href="<?php the_permalink(); ?>?id=<?php echo $v_page; ?>" class="clearfix">
					<?php

						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb, 'full' ); 
						$size = $v_columns == 'four' || ($sidebar['sidebar_type'] != '' && $sidebar['sidebar_type'] != 'full-width') ? array('220', '165') : ($v_columns == 'three' ? array('300', '225') : array('460', '345'));
						$image = aq_resize($img_url, $size[0], $size[1], true, false); 

					?>
					<img width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" src="<?php echo $image[0]; ?>" alt="<?php the_title(); ?>" />
					<div class="caption">
						<h3><?php the_title(); ?></h3>
						<span><?php rb_get_categories($post->ID, 'portfolio_category') ?></span>
					</div>
				</a>
			</li>

			<?php endwhile; ?>

   		</ul>

   	</div>

   <?php endif; ?>

	<?php if(comments_open() && ot_get_option('rb_allow_folio_comments', 'false') == 'true')
		comments_template( '', true ); ?>

<?php get_footer(); ?>