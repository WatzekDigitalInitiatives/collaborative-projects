<?php
/*---------------------------------
	Template Name: Portfolio
------------------------------------*/
	get_header();
	global $sidebar;

	$v_page = ot_get_option('rb_def_p_page', '');

	$v_cats = get_post_meta($post->ID, 'rb_meta_box_portfolio_set', true);

	$v_ajax = get_post_meta($post->ID, 'rb_def_p_ajax', true);
	$v_filter = get_post_meta($post->ID, 'rb_def_p_filtering', true);
	$v_columns = get_post_meta($post->ID, 'rb_def_p_columns', true);
	$v_thumbnails = get_post_meta($post->ID, 'rb_def_p_thumbnails', true);

	$all_cats = !empty($v_cats) ? implode($v_cats, ', ') : -1;
	$custom_cat = isset($_GET['f']) ? $_GET['f'] : $all_cats;
	
	if (!isset($_GET['f'])){$custom_cat='';}
	
	$v_page = $post->ID;

?>
<?php

$allcats=get_categories(array('taxonomy'=>'portfolio_category'));
$sfish=array();
foreach ($allcats as $cat){
	$name=$cat->name;
	$slug=$cat->slug;
	$parent=$cat->parent;
	$term_id=$cat->term_id;
	
	if ($parent==0){
	
		//echo "<p>$name</p>";
		$sfish[$term_id]["label"]=$name;
	
	}
	else{
		
		if ($parent==13){
			$n=explode(" ",$name);
			$ln=array_pop($n);
			$fn=array_shift($n);
			$sort="$ln,$fn";
		}
		else{$sort=$name;}
		$sfish[$parent]["$sort"]["sort"]=$sort;
		$sfish[$parent]["$sort"]["name"]=$name;
		$sfish[$parent]["$sort"]["slug"]=$slug;
		
		
		//$sfish[$parent]["$name"]=$slug;

	}

}
/* sort fac by last name*/
$fac=$sfish[13];
sort($fac);
$sfish[13]=$fac;
$sfish[13]["label"]="Faculty";


$sfmenu="<ul class='sf-menu' id='example'>\n";

foreach ($sfish as $sf){
	$label=$sf["label"];
	$sfmenu.="<li >\n";
	$sfmenu.="<a >$label</a>\n";
	$sfmenu.="<ul>\n";
	foreach ($sf as $key=>$vals){
		$name=$vals["name"];
		$slug=$vals["slug"];
		if ($key !="label"){$sfmenu.="<li ><a  href='?f=$slug'>$name</a></li>\n";}
		
	}
	$sfmenu.="</ul>\n";
	$sfmenu.="</li>\n";


}

$sfmenu.="</ul>\n";



?>



	<div id="portfolio" class="t<?php echo $v_thumbnails; ?> c<?php echo $v_columns; ?> a<?php echo $v_ajax; ?> clearfix" >

		<?php #if($all_cats == -1) : ?>
<div id="filters" >
<span >View by:</span> 
<?php echo $sfmenu; ?>

</div>          
          <!--    
		  <div id="filter" >
			<p><?php _e('Showing', 'goodwork'); ?> </p>
			<ul class="clearfix portfolioFilter<?php if($v_filter == 'false') echo ' disabled'; ?>">
				<!-- all 
				<li<?php if($v_filter == true) echo ' class="active"'; ?>><a href="<?php echo $v_filter == 'true' ? '#' : get_permalink($v_page); ?>" data-filter="*"><?php _e('All', 'goodwork'); ?></a></li>
				<!-- end all
				<?php 
				//$portfolio_categories = get_categories(array('taxonomy'=>'portfolio_category', parent=>6));

				foreach($v_cats as $cat) {
					echo '<li' . ($v_filter == false && $cat == $custom_cat ? ' class="active"' : '')  .  '><a' . ($v_filter == 'true' ? '' : ' class="direct"') . ' href="' . ($v_filter == 'true' ? '#' : get_permalink($post->ID) . '?f=' . $cat)  . '" data-filter=".' . $cat . '">' . str_replace('-', ' ', ucfirst($cat)) . '</a></li>';
				}
				?>
			</ul>
		
         </div>
          -->
          
          
                
		<?php #else: ?>
			<!--<p><?php _e('Please edit this page and select at least one category to be displayed inside the current portfolio, from the Portfolio Options', 'goodwork'); ?></p>-->
		<?php# endif; ?>

		<?php if($v_ajax == 'true') : ?><div id="folioDetails"></div><?php endif; ?>


<?php #  var_dump($cat_depts);?>


		<ul id="items" class="clearfix">

			<?php 

				$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
				$args = array( 
				     'posts_per_page' => $v_filter == 'true' ? -1 : 12, 
					   'offset'=> 0,
					   'paged' => $paged,
					   'portfolio_category' => $custom_cat,
					   //'portfolio_category' => '',
					   'post_type' => 'portfolio');

				$all_posts = new WP_Query($args);

				while($all_posts->have_posts()) : $all_posts->the_post();

			?>

			<li class="item <?php krown_categories($post->ID, 'portfolio_category', ' ', 'slug'); ?>">
				<!--<a href="<?php the_permalink(); ?>?id=<?php echo $v_page; ?>" data-slug="<?php echo $post->post_name; ?>" class="clearfix">-->
                                <a href="<?php the_permalink(); ?>" data-slug="<?php echo $post->post_name; ?>" class="clearfix">
					<?php

						$thumb = get_post_thumbnail_id();
						$img_url = wp_get_attachment_url( $thumb, 'full' );  
						$size = $v_columns == 'four' || ($sidebar['sidebar_type'] != '' && $sidebar['sidebar_type'] != 'full-width') ? array('220', '165') : ($v_columns == 'three' ? array('300', '225') : array('460', '345'));
						$image = aq_resize($img_url, $size[0], $size[1], true, false); 

					?>
					<img src="<?php echo $image[0]; ?>" width="<?php echo $image[1]; ?>" height="<?php echo $image[2]; ?>" alt="<?php the_title(); ?>" />
					<div class="caption">
						<h3><?php $question=get_post_meta($post->ID, 'wdi_research_question', true); 
                            echo $question;?></h3>
						<!--<span><? /*php rb_get_categories($post->ID, 'portfolio_category');*/ ?></span> -->
					</div>
				</a>
			</li>

			<?php endwhile; ?>

		</ul>

		<?php if($v_filter == 'false') rb_pagination($all_posts->max_num_pages, 1, __('projects', 'goodwork')); ?>

	</div>
<?php #var_dump($allcats); ?>
	<?php get_footer(); ?>