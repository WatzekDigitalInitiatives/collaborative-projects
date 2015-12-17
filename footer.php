<?php
/*---------------------------------
	The footer of the theme
------------------------------------*/

global $rev_js;
global $sidebar;

?>

		</article>
    

		<!-- Content Wrapper End -->

		<!-- Sidebars -->
		
                        			



        <?php if(is_array($sidebar) && $sidebar['sidebar_type'] == 'left-sidebar') { ?>
			<aside id="sidebarLeft" class="sidebar clearfix">
				<?php if(is_active_sidebar($sidebar['sidebar_id']))
					dynamic_sidebar($sidebar['sidebar_id']); ?>
			</aside>
		<?php } if(is_array($sidebar) && $sidebar['sidebar_type'] == 'right-sidebar') { ?>
			<aside id="sidebarRight" class="sidebar clearfix" >
				<?php //if(is_active_sidebar($sidebar['sidebar_id']))
					//dynamic_sidebar($sidebar['sidebar_id']); ?>
                               
                               <h5>Project by</h5> 
                               <?php the_content(); ?>


			        <div id="research_period">
                   			<h5>Research Period</h5> 
                   			<?php $all_categories = get_the_terms( $post->ID, 'portfolio_category' ); 

//var_dump($all_categories);

                   			foreach ($all_categories as $a_category) {
                       
                       				if ($a_category->parent == 8) {
                           				echo "<p><a href='/projects/?f=$a_category->slug'>$a_category->name</a></p>";
                       				}    
                   			}?>
                                 </div>

                                 <div id="department">
                                        <h5>Department</h5> 
                                        <?php $all_categories = get_the_terms( $post->ID, 'portfolio_category' ); 

                                        foreach ($all_categories as $a_category) {
                       
                                             if ($a_category->parent == 6) {
                                                  echo "<p><a href='/projects/?f=$a_category->slug'>$a_category->name</a></p>";
                                             }    
                                         }
                                         ?>
                                 </div> 
<?php           



     $tags="";
      foreach ($all_categories as $a_category) {
           if ($a_category->parent == 12) { 
                
?>
                                 
                                         
                                        
                                               <?php  
                      
 			$tags.= "<p><a href='/projects/?f=$a_category->slug'>$a_category->name</a></p>"; ?>
                      
                                 
                                         <?php    }  /*end $a_category */  
                                        } /* end foreach loop */
                                         ?>
  								<?php
  								if (strlen($tags)>0){
  									?><div id="tags"><?php
  										?><h5>Tags</h5><?php
  										echo $tags;
  										?></div><?php
  								}		
  								?>	
  
  
                                 <?php if (get_post_meta($post->ID,'wdi_project_link1',true)) {?>
                                       <div id="project_links" >
                                            <h5>Links</h5>         
                                            <?php  $project_link = get_post_meta($post->ID,'wdi_project_link1',true);?>
                                            <p><?php echo $project_link; ?></p>
                                            <?php if (get_post_meta($post->ID,'wdi_project_link2',true)) {
                                                    $project_link2 = get_post_meta($post->ID,'wdi_project_link2',true);?>
                                                    <p><?php echo $project_link2; ?></p>
                                            <?php }
                                            if (get_post_meta($post->ID,'wdi_project_link3',true)) {
                                                   $project_link3 = get_post_meta($post->ID,'wdi_project_link3',true);?>
                                                   <p><?php echo $project_link3; ?></p>
                                            <?php }
                                            if (get_post_meta($post->ID,'wdi_project_link4',true)) {
                                                   $project_link4 = get_post_meta($post->ID,'wdi_project_link4',true);?>
                                                   <p><?php echo $project_link4; ?></p>
                                            <?php } ?>

                                       </div>
                                  <?php } ?> 

                                  <?php if (get_post_meta($post->ID,'wdi_file_list',true)) {?>
                                        <div id="file_list" >
                                             <h5>Project Files</h5>         
                                             <?php    $file_list = get_post_meta($post->ID,'wdi_file_list',true);
                                             foreach ($file_list as $key=>$value) {
                                                   $attachment = get_post( $key );
                                                   $file_title = $attachment->post_title;
                                                   ?> <p><a href="<?php echo $value;?>"><?php echo $file_title;?></a></p>
                                             <?php  }?>
                                        </div>
                                  <?php } ?> 


                                 <div id="funder">
                                        <h5>Funder</h5> 
                                   <?php foreach ($all_categories as $a_category) {
           if ($a_category->parent == 23) { ?>     
                                               <?php   echo "<p><a href='/projects/?f=$a_category->slug'>$a_category->name</a></p>"; ?>

                                 
                                         <?php    }    
                                         }
                                         ?>
                                   </div>
                        </aside>
		<?php } 

                





if(function_exists('is_woocommerce') && (is_active_sidebar('rb_shop_widget') && is_woocommerce())) { ?>
			<aside id="sidebarBottom" class="sidebar clearfix">
				<div class="row-fluid">
            		<?php dynamic_sidebar('rb_shop_widget'); ?>
           		</div>
			</aside>
        <?php } ?>

	</div>

	<!-- Main Wrapper End -->

	<!-- Footer #1 Wrapper Start -->

	<?php if(get_option('rb_o_ftrtype') == 'full') : ?>

	<footer id="footer1" class="clearfix">

		<div class="row-fluid">

			<?php if(get_option('rb_o_ftrareas') == 'four') : ?>

			<div class="column_container span3">
				<?php if(is_active_sidebar('rb_footer_widget_1'))
					dynamic_sidebar('rb_footer_widget_1'); ?>
			</div>

			<div class="column_container span3 clearfix">
				<?php if(is_active_sidebar('rb_footer_widget_2'))
					dynamic_sidebar('rb_footer_widget_2'); ?>
			</div>

			<div class="column_container span3 clearfix">
				<?php if(is_active_sidebar('rb_footer_widget_3'))
					dynamic_sidebar('rb_footer_widget_3'); ?>
			</div>

			<div class="column_container span3">
				<?php if(is_active_sidebar('rb_footer_widget_4'))
					dynamic_sidebar('rb_footer_widget_4'); ?>
			</div>

			<?php elseif(get_option('rb_o_ftrareas') == 'three') : ?>

			<div class="column_container span4">
				<?php if(is_active_sidebar('rb_footer_widget_1'))
					dynamic_sidebar('rb_footer_widget_1'); ?>
			</div>

			<div class="column_container span4 clearfix">
				<?php if(is_active_sidebar('rb_footer_widget_2'))
					dynamic_sidebar('rb_footer_widget_2'); ?>
			</div>

			<div class="column_container span4">
				<?php if(is_active_sidebar('rb_footer_widget_3'))
					dynamic_sidebar('rb_footer_widget_3'); ?>

			<?php elseif(get_option('rb_o_ftrareas') == 'two') : ?>

			<div class="column_container span6">
				<?php if(is_active_sidebar('rb_footer_widget_1'))
					dynamic_sidebar('rb_footer_widget_1'); ?>
			</div>

			<div class="column_container span6">
				<?php if(is_active_sidebar('rb_footer_widget_2'))
					dynamic_sidebar('rb_footer_widget_2'); ?>

			<?php elseif(get_option('rb_o_ftrareas') == 'one') : ?>

			<div class="column_container span12">
				<?php if(is_active_sidebar('rb_footer_widget_1'))
					dynamic_sidebar('rb_footer_widget_1'); ?>
			</div>

			<?php endif; ?>


		</div>

    </footer>

    <?php endif; ?>

	<!-- Footer #1 Wrapper End -->

	<!-- Footer #2 Wrapper Start -->

	<footer id="footer2" class="clearfix">

		<div class="clearfix">

			<div class="left clearfix">
				<?php if(is_active_sidebar('rb_footer_widget_5'))
					dynamic_sidebar('rb_footer_widget_5'); ?>
			</div>

			<div class="right clearfix">
				<?php if(is_active_sidebar('rb_footer_widget_6'))
					dynamic_sidebar('rb_footer_widget_6'); ?>
			</div>

		</div>

    </footer>

	<!-- Footer #2 Wrapper End -->

	<div id="scripts">

		<?php
        $userType=getSubnet();  /* for Google Analytics custom dimension */
		?><script><?php
		echo "\n var userType='".$userType."';\n";
		?></script><?php


			wp_register_script('theme_plugins', get_template_directory_uri().'/js/plugins.min.js', array('jquery'), NULL, true);
			wp_register_script('theme_scripts', get_template_directory_uri().'/js/scripts.min.js', array('theme_plugins'), NULL, true);
			
			wp_enqueue_script('theme_plugins');
			wp_enqueue_script('theme_scripts');

	if (is_page('2')){
		$base= get_stylesheet_directory_uri();
		wp_register_script( 'superfish_hoverIntent', get_stylesheet_directory_uri() . '/superfish/js/hoverIntent.js' );
		wp_register_script( 'superfish', get_stylesheet_directory_uri() . '/superfish/js/superfish.js' );
		wp_enqueue_script( 'superfish_hoverIntent' );
		wp_enqueue_script( 'superfish' );
	
		//echo "it's post #2!";
	}



			$colors = get_option('rb_o_colors');

			wp_localize_script(
				'theme_scripts', 
				'theme_objects',
				array(
					'base' => get_template_directory_uri(),
					'colorAccent' => $colors['main1'],
					'secondColor' => '#DBDBDB',
					'blogPage' => $kT = ot_get_option('rb_modern_blog_ppp', '8'),
					'commentProcess' => __('Processing your comment...', 'goodwork'),
					'commentError' => __('You might have left one of the fields blank, or be posting too quickly.', 'goodwork'),
					'commentSuccess' => __('Thanks for your response. Your comment will be published shortly after it\'ll be moderated.', 'goodwork')
				)
			);

			if(ot_get_option('rb_tracking_where') == 'footer') echo ot_get_option('rb_tracking');

			wp_footer(); 

		?>

	</div>

	<div id="oldie">
		<p><?php _e('This is a unique website which will require a more modern browser to work!', 'goodwork'); ?>
		<a href="https://www.google.com/chrome/" target="_blank"><?php _e('Please upgrade today!', 'goodwork'); ?></a>
		</p>
	</div>

</body>
</html>

                      <script>
                              jQuery(window).load(function() {
                                   var sidebarHeight=jQuery("#content").height();
                                   if (jQuery("#sidebarRight").height() < sidebarHeight) {
                                       jQuery("#sidebarRight").height(sidebarHeight);
                                   }
                              });
                      </script>
