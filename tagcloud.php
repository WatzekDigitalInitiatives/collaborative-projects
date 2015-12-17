<?php
/*---------------------------------
	Template Name: tagcloud
------------------------------------*/
?>
<div class="clearfix" id="tagcloud" style="display:none;">
	<?php

	// Create an array holding the slugs of each tag, for use in constructing ajax URLs

	$all_tags = get_terms('portfolio_category','child_of=12');
	foreach ($all_tags as $tag){
		$slug = $tag->slug;
		$all_slugs[] = $slug;
	}

	// Populate the cloud

	$cloud = wp_tag_cloud(array('taxonomy'=>'portfolio_category','child_of'=>'12','number'=>0,'smallest'=>12,'largest'=>30,'format'=>'array', 'echo'=>0));

	// Replace the tag links in the cloud with ajax versions of themeselves
	$i = 0;
	foreach ($cloud as $tag){
		$ajax_tag = str_replace('portfolio_category/'.$all_slugs[$i],'projects/?f='.$all_slugs[$i],$tag);
		$ajax_cloud[] = $ajax_tag;
		$i++;
	}

	// Format and display the new ajax cloud
	foreach ($ajax_cloud as $tag){
		echo $tag.' ';
	}

	?>
</div>
