<?php

/* ------------------------
-----   Accordion    -----
------------------------------*/

function rb_accordion_function($atts, $content){

    extract(shortcode_atts(array(
        'el_class' => '',
        'size' => 'small',
        'style' => 'one',
        'type' => 'accordion',
        'opened' => '0'
    ), $atts));

    $html = '<div data-opened="' . $opened . '" class="rbAccordion ' . $type . ' ' . $size . ' ' . $style . ($el_class != '' ? ' ' . $el_class : '') . ' clearfix autop">';

    $html .= do_shortcode($content);

    $html .= '</div>';

    return $html;

}

function ac_section_function($atts, $content){

    extract(shortcode_atts(array(
        'title' => 'Section',
    ), $atts));

    $html = '<section>
    	<h4>' . $title . '</h4>
    	<div>' . do_shortcode($content) . '</div>
    </section>';

    return $html;

}

/* ------------------------
-----   Alert Messages    -----
------------------------------*/

function rb_alert_function($atts, $content=null) { 

    extract(shortcode_atts(array(
        'el_class' => '',
        'type' => 'info'
    ), $atts));

    $html = '<div class="rbAlert ' . $type . ($el_class != '' ? ' ' . $el_class : '') . ' autop">';
    $html .= do_shortcode($content);
    $html .= '<i>' . $type . '</i>';

    $html .= '</div>';
   
   return $html;

}

/* ------------------------
-----   Basic Column  -----
------------------------------*/

function column_function($atts, $content){

  extract(shortcode_atts(array(
      'el_position' => '',
      'width' => '1/1'
  ), $atts));

  $html = '<div class="column_container nospace clearfix ';

  switch($width){
    case '1/1':
      $html .= 'span12';
      break;
    case '1/2':
      $html .= 'span6';
      break;
    case '1/4':
      $html .= 'span3';
      break;
    case '3/4':
      $html .= 'span9';
      break;
    case '1/3':
      $html .= 'span4';
      break;
    case '2/3':
      $html .= 'span8';
      break;
    default:
      $html .= 'span12';
  }

  $html .= ($el_position != '' ? ' f' . $el_position : '') . '">';
  $html .= do_shortcode($content);
  $html .= '</div>';

  return $html;

}

/* ------------------------
-----   Blank Divider    -----
------------------------------*/

function rb_blank_divider_function($atts, $content=null) { 

  extract(shortcode_atts(array(
      'el_class' => '',
      'height' => '50'
  ), $atts));

  if(intval($height) >= 0)

    return '<span style="display:block;margin-top:' . $height . 'px"' . ($el_class != '' ? ' class="' . $el_class . '"' : '') . ' ></span>';

  else

    return '<span style="display:block;margin-top:' . $height . 'px"' . ($el_class != '' ? ' class="' . $el_class . ' rbBlankNeg"' : ' class="rbBlankNeg"') . ' ></span>';

}


/* ------------------------
-----   Buttons    -----
------------------------------*/

function rb_button_function($atts, $content=null) { 

    extract(shortcode_atts(array(
        'el_class' => '',
        'style' => 'light',
        'size' => 'medium',
        'label' => 'Button',
        'target' => '_blank',
        'url' => '#'
    ), $atts));

    $html = '<a class="rbButton ' . $style . ' ' . $size . ($el_class != '' ? ' ' . $el_class : '') . '" href="' . $url . '" target="' . $target . '">' . $label . '</a>';
   
   return $html;

}

/* ------------------------
-----   Contact Info    -----
------------------------------*/

function rb_cinfo_function($atts, $content=null) { 

    extract(shortcode_atts(array(
        'el_class' => '',
        'phone' => '',
        'address' => '',
        'mail' => '',
        'map_text' => '',
        'map' => ''
    ), $atts));

    $html = '<section class="rbContactInfo ' . ($el_class != '' ? ' ' . $el_class : '') . ' autop">
      <ul>';

    if($address != '')
      $html .= '<li class="address">'.$address.'</li>';
    if($phone != '')
      $html .= '<li class="phone">'.$phone.'</li>';
    if($mail != '')
      $html .= '<li class="email"><a href="mailto:'.$mail.'">'.$mail.'</a></li>';
    if($map != '')
      $html .= '<li class="flag"><a href="'.$map.'">' . $map_text . '</a></li>';

    $html .= '</ul></section>';

    return $html;

}

/* ------------------------
-----   Contact Form    -----
------------------------------*/

function rb_form_function($atts, $content=null) { 

    extract(shortcode_atts(array(
        'el_class' => '',
        'type' => 'minimal',
        'label_name' => 'Name',
        'label_email' => 'Email',
        'label_subject' => 'Subject',
        'label_message' => 'Message',
        'label_send' => 'Send',
        'email' => '',
        'success' => 'Your message was sent!',
        'error' => 'Complete all the fields'
    ), $atts));

    $html = '<section class="rbForm ' . $type . ($el_class != '' ? ' ' . $el_class : '') . ' autop">
    	<form method="POST" action="' . get_template_directory_uri() . '/includes/contact-form.php">';

    if($type == 'minimal')
    	$html .= '
    		<input type="text" name="name" class="name" value="' . $label_name . '" />
    		<input type="email" name="email" class="email" value="' . $label_email . '" />
    		<input type="text" name="subject" value="' . $label_subject . '"' . ($type == 'minimal' ? ' class="subject hidden"' : ' class="subject"') . ' />
    		<textarea name="message" class="message">' . $label_message . '</textarea>
    		<input type="text" name="fred" class="fred hidden" value="" />
        <input type="submit" class="submit" value="'. $label_send . '" />
    		<input type="hidden" name="dlo128" class="hidden dlo128" value="' . $email . '" />';
    else
    	$html .= '
    		<div class="column_container span4" style="padding-left:0">
    			<label for="name">' . $label_name . '</label>
    			<input type="text" name="name" class="name" />
    		</div>
    		<div class="column_container span4">
    			<label for="email">' . $label_email . '</label>
    			<input type="email" name="email" class="email" />
    		</div>
    		<div class="column_container span4" style="padding-right:0">
    			<label for="subject">' . $label_subject . '</label>
    			<input type="text" name="subject" class="subject" />
    		</div>
    		<div class="column_container span12" style="padding:0 0 10px 0">
    			<label for="message">' . $label_message . '</label>
    			<textarea type="text" name="message" class="message"></textarea>
    		</div>
    		<input type="text" name="fred" class="fred hidden" value="" />
        <input type="submit" class="submit" value="'. $label_send . '" />
    		<input type="hidden" name="dlo128" class="hidden dlo128" value="' . $email . '" />';

    $html .= '</form>
    	<p class="hidden successMessage">' . $success . '</p>
    	<p class="hidden errorMessage">' . $error . '</p>
    </section>';
   
   return $html;

}

/* ------------------------
-----   Crowdfunding Widgets    -----
------------------------------*/

function rb_funding_mini_function($atts, $content=null){
    extract(shortcode_atts(array(
        'product' => '1'
    ), $atts));

    $html = do_shortcode('<div class="miniF minis clearfix"><a class="changeLink" href="#">[project_name product="' . $product . '"]</a>[project_image product="' . $product . '" image="1"]<div class="morethan">
      [project_percentage_bar product="' . $product . '"]<span class="helper h1">' . __('FUNDED', 'goodwork') . '</span>
      <div class="wrap1 clearfix"><div class="c1">[project_goal product="' . $product . '"]<span class="helper">' . __('GOAL', 'goodwork') . '</span></div>
      <div class="c2">[project_daystogo product="' . $product . '"] ' . __('days', 'goodwork') . '<span class="helper">' . __('TO GO', 'goodwork') . '</span></div></div>
      <a class="main-btn changeLink" href="#">' . __('Learn More', 'goodwork') . '</a>
    </div></div>[project_mini_widget product="' . $product . '"]');

    return $html;
}

function rb_funding_full_function($atts, $content=null){
    extract(shortcode_atts(array(
        'product' => '1'
    ), $atts));

    $html = do_shortcode('<div class="miniF clearfix">
      [project_percentage_bar product="' . $product . '"]<span class="helper h1">' . __('FUNDED', 'goodwork') . '</span>
      <div class="wrap1 clearfix"><div class="c1">[project_goal product="' . $product . '"]<span class="helper">' . __('GOAL', 'goodwork') . '</span></div>
      <div class="c2">[project_daystogo product="' . $product . '"] ' . __('days', 'goodwork') . '<span class="helper">' . __('TO GO', 'goodwork') . '</span></div></div>
    </div>[project_page_widget product="' . $product . '"]');

    return $html;
}

/* ------------------------
-----   Divider    -----
------------------------------*/

function rb_divider_function($atts, $content=null) { 

    extract(shortcode_atts(array(
        'el_class' => '',
        'top' => '20',
        'bottom' => '20'
    ), $atts));

    $html = '<hr style="margin-top:' . $top . 'px; margin-bottom:' . $bottom . 'px;" class="rbDivider ' . ($el_class != '' ? ' ' . $el_class : '') . ' autop" />';

    return $html;

}

/* ------------------------
-----   Flickr Feed   -----
------------------------------*/

function rb_flickr_function($atts, $content){

    extract(shortcode_atts(array(
        'el_class' => '',
        'id' => '52617155@N08',
        'no' => '15'
    ), $atts));

	$html = '<section class="rbFlickr' . ($el_class != '' ? ' ' . $el_class : '') . '"><ul class="clearfix">';
	$html .= parseFlickrFeed($id, $no);

	$html .= '</ul></section>';

	return $html;

}

/* ------------------------
-----   Gallery   -----
------------------------------*/

function rb_gallery_function($attr) {

  global $post;
  global $sidebar;

  $post = get_post();

  static $instance = 0;
  $instance++;

  if ( ! empty( $attr['ids'] ) ) {
      if ( empty( $attr['orderby'] ) ) {
          $attr['orderby'] = 'post__in';
      }
      $attr['include'] = $attr['ids'];
  }

  $html = apply_filters( 'post_gallery', '', $attr );
  if ( $html != '' ) {
      return $html;
  }

  if ( isset( $attr['orderby'] ) ) {
      $attr['orderby'] = sanitize_sql_orderby( $attr['orderby'] );
      if ( !$attr['orderby'] ) {
          unset( $attr['orderby'] );
      }
  }

  extract( shortcode_atts( array(
      'order'          => 'ASC',
      'orderby'        => 'menu_order ID',
      'id'             => $post->ID,
      'include'        => '',
      'exclude'        => '',
      'type'           => 'thumbnails',
      'captions'       => 'true'
  ), $attr ) );

  $id = intval( $id );
  if ( 'RAND' == $order ) {
      $orderby = 'none';
  }

  if ( ! empty( $include ) ) {

      $_attachments = get_posts( array('include' => $include, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );

      $attachments = array();

      foreach ( $_attachments as $key => $val ) {
          $attachments[$val->ID] = $_attachments[$key];
      }

  } else if ( ! empty( $exclude ) ) {
      $attachments = get_children( array('post_parent' => $id, 'exclude' => $exclude, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  } else {
      $attachments = get_children( array('post_parent' => $id, 'post_status' => 'inherit', 'post_type' => 'attachment', 'post_mime_type' => 'image', 'order' => $order, 'orderby' => $orderby) );
  }

  if ( empty( $attachments ) ) {
      return '';
  }

  if ( is_feed() ) {
      $html = "\n";
      foreach ( $attachments as $att_id => $attachment ) {
          $html .= wp_get_attachment_link($att_id, $size, true) . "\n";
      }
      return $html;
  }

  if($type == 'thumbnails') :

    $output = '<ul class="rbGallery clearfix">';

    $i = 0; $unique = rand()*1000;
    foreach ($attachments as $id => $attachment) {

      $img_url = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_image_src( $id, 'full', false, false ) : wp_get_attachment_image_src( $id, 'full', true, false );
    
      $caption = get_post($id)->post_excerpt;
      $title = get_post($id)->post_title;

      $image = aq_resize($img_url[0], '229', '165', true, false); 
      
      $output .= '
        <li>

          <a class="clearfix fancybox ch" href="' . $img_url[0] . '" data-fancybox-group="rb_custom_gallery' . $unique . '" data-fancybox-title="' . $title . '">
            <img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $title . '" />
          </a>

        </li>';
      
    }

    $output .= '</ul>';

  elseif($type == 'slider') :

    $output .= '<div class="flexslider pMedia folio nono caption-' . $captions . '">
        <ul class="slides">';

    $i = 0; $unique = $post->ID;
    foreach ($attachments as $id => $attachment) {

        $caption = get_post($id)->post_excerpt;
        $title = get_post($id)->post_title;

        $img_url = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_image_src( $id, 'full', false, false ) : wp_get_attachment_image_src( $id, 'full', true, false );

        $img_width = $sidebar['sidebar_type'] != '' && $sidebar['sidebar_type'] != 'full-width' ? '940' : '700';
        $image = aq_resize($img_url[0], $img_width, null, false, false); 

        $output .= '<li>
            <img src="'. $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $title . '" />';
            if($captions == 'true' && !empty($caption))
              $output .= '<p class="flex-caption">' . $caption . '</p>';
            $output .= '</li>';
    }

    $output .= '</ul>
    </div>';

  endif;

  return $output;
}

/* ------------------------
-----   Latest Projects   -----
------------------------------*/

function rb_projects_function($atts, $content=null){

  extract(shortcode_atts(array(
      'el_class' => '',
      'style' => 'one',
      'no' => '4',
      'cols' => 'four',
      'all' => 'true',
      'all_url' => '',
      'all_text' => 'View all portfolio &rarr;',
      'type' => '',
      'ajax' => 'false'
  ), $atts));

  if($type == 'portfolio')
    $type = '';

  global $post;

  $v_arrays = ot_get_option('rb_portfolios_create');
  $v_page = ot_get_option('rb_def_p_page');

  $html = '<section class="rbProjects latestProjects portfolio clearfix ' . ($el_class != '' ? ' ' . $el_class : '') . ' t' . $style . ' c' . $cols . ' a' . $ajax . ' autop">';

  if($ajax == 'true')
    $html .= '<div id="folioDetails"></div>';

	$html .= '<ul id="items" class="clearfix">';

	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	$args = array( 'posts_per_page' => $no, 
		   'offset'=> 0,
		   'paged' => $paged,
		   'portfolio_category' => $type,
		   'post_type' => 'portfolio');

	$all_posts = new WP_Query($args);

	while($all_posts->have_posts()) : $all_posts->the_post();

		$html .= '<li class="item ' . rb_get_categories($post->ID, 'portfolio_category', ' ', 'slug', false) . '">
				<a href="' . get_permalink($post->ID) .'" data-slug="' . $post->post_name . '" class="clearfix">
					';

		$thumb = get_post_thumbnail_id();
		$img_url = wp_get_attachment_url( $thumb, 'full' );  
		$size = $cols == 'four' ? array('220', '165') : ($cols == 'three' ? array('300', '225') : array('460', '345'));
        $image = aq_resize($img_url, $size[0], $size[1], true, false);
        $all_categories = get_the_terms( $post->ID, 'portfolio_category' );
        $fac_category="";
              foreach ($all_categories as $a_category) {
                    if ($a_category->parent == 13) {
                          $fac_category = "$a_category->name";
                    }
              }            
		$html .= '<img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . get_the_title() . '" />
				<div class="caption">
					<h3>' . get_the_title() . '</h3>
                    <p>' . $fac_category . '</p>
					<p>' . get_the_excerpt() . '</p>
				</div>
			</a>
		</li>';

	endwhile;

	$html .= '</ul>';
  
	if($all == 'true') {
    if($all_url != '')
      $html .= '<a href="' . $all_url . '" class="btnAll">' . $all_text . '</a>';
    else
		  $html .= '<a href="' . ($v_page == '' ? '#' : get_permalink($v_page)) . '" class="btnAll">' . $all_text . '</a>';
	}

	$html .= '</section>';

	return $html;

}

/* ------------------------
-----   Latest Posts    -----
------------------------------*/

function rb_posts_function($atts, $content=null){

  extract(shortcode_atts(array(
      'el_class' => '',
      'type' => 'classic',
      'no' => '4',
      'no2' => '2',
      'more' => 'true',
      'ajax' => 'false',
      'text_nomore' => 'No More Posts',
      'text_more' => 'Load More Posts',
      'text_showing' => 'Showing',
      'text_read' => 'Read More',
      'categories' => ''
  ), $atts));

  $html = '<section class="rbPosts clearfix jx' . $ajax . ' ' . $type . ($el_class != '' ? ' ' . $el_class : '') . ' autop" data-no="' . $no . '" data-more="' . $more . '"><div class="postsContainer holder ' . $type . ' clearfix">';

	global $post;

  $po = $no;

  if($ajax == 'true' && $type == 'modern'){

    $kI = 0;
    $kT = ot_get_option('rb_modern_blog_ppp', '8');
    $po = -1;

    $html .= '<div id="filter">
      <p>' . $text_showing .'</p>
      <ul class="clearfix">
        <li class="active"><a href="#" data-filter="*">' . __('All', 'goodwork') . '</a></li>';

      $blog_categories = get_categories(array('type'=>'post', 'orderby' => 'name'));
      foreach($blog_categories as $blog_category)
            $html .= '<li><a href="#" data-filter=".category-' . $blog_category->slug . '">' . $blog_category->name . '</a></li>';

        $html .= '</ul>
      </div>';

  }

  if($more == 'true' && $ajax == 'false' && $type == 'classic')
    $po = $no * $no2;

	$args = array('offset'=> 0, 'posts_per_page'=>$po, 'category_name' => $categories);
	$all_posts = new WP_Query($args);
  $i = 0;

	while($all_posts->have_posts()) : $all_posts->the_post();

  	$post_format = get_post_format() == '' ? __('standard', 'goodwork') : get_post_format();
  	$cat = get_the_category();
  	$class = get_post_class($post->post_name . ' post clearfix', $post->ID);

    if($type == 'modern') :
  	
    	$html .= '<article id="post-' . $post->ID . '" class="' . implode(' ', $class) . '"' . ($ajax == 'true' && $type == 'modern' ? ($kI++ >= $kT ? ' style="height:0"' : '') : '') . '>

    		<a class="clearfix" href="' . (get_post_format() == 'link' ? get_post_meta($post->ID, 'rb_meta_box_post_assets_l', true) : get_permalink($post->ID)) .'" data-slug="' . $post->post_name .'" data-type="' . $post_format . '">

    			<header>
    				<span class="pTime">' . get_the_time('jS F Y') . '</span>
            <span class="pTime p2">' . get_the_time('j/m/y') . '</span>
    				<h3 class="pTitle icon-none">' . get_the_title($post->ID) . '</h3>
    			</header>

    			<footer>
    				<div class="pComments icon-none">' . get_comments_number('0', '1', '%') . '</div>
    				<div class="pType icon-none">' .  $cat[0]->cat_name . '</div>
    			</footer>

    		</a>

        </article>';

    elseif($type == 'classic') :

      $thumb = get_post_thumbnail_id();
      if(!empty($thumb)) {
        $img_url = wp_get_attachment_url($thumb, 'full');  
        $image = aq_resize($img_url, '220', '125', true, false); 
      } else {
        $image = 'nothumb';
      }

      $html .= '<article id="post-' . $post->ID . '" class="' . implode(' ', $class) . ($i++>=$no ? ' hidden' : '') . '">';

      if($image != 'nothumb')
        $html .= '<a class="ch thumb clearfix" href="' . get_permalink($post->ID) .'"><img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . get_the_title() . '" /></a>';

        $html .= '<header>
          <a class="clearfix ' . $post_format . '" href="' . get_permalink($post->ID) .'">
            <h3>' . get_the_title($post->ID) . '</h3>
            <span class="time">' . get_the_time('jS F Y') . '</span>
          </a>
        </header>

        <section><p>' . rb_excerpt('rb_excerptlength_post') . '<a class="more nav-next" href="' . get_permalink($post->ID) .'">' . $text_read . '</a></p></section>

      </article>';

    endif;
		
	endwhile;

  if($ajax == 'true' && $type == 'modern')
    $html .= '<a class="clearfix morePosts" href="#"><span data-more="' . $text_more . '" data-less="' . $text_nomore . '">' . $text_more . '</span></a>';

	$html .= '</div>';

  if($more == 'true')
    $html .= '<div class="buttons"><a class="btnPrev" href="#"></a><a class="btnNext" href="#"></a></div>';

  $html .= '</section>';

	return $html;

}

/* ------------------------
-----   Lightbox Content    -----
------------------------------*/

function rb_lightbox_function($atts, $content=null){

    extract(shortcode_atts(array(
        'thumb' => '',
        'large' => '',
        'align' => 'left',
        'title' => '',
        'group' => '',
        'twidth' => '200',
        'type'  => 'img'
    ), $atts));

    if($thumb != '' && strpos($thumb, '.') === false){
      $img_url = wp_get_attachment_image_src($thumb, 'full');
      $image = aq_resize($img_url[0], $twidth, null, false, false); 
    } else {
      $image = aq_resize($thumb, $twidth, null, false, false); 
    }

    $html = '<a class="clearfix fancybox ch a' . $align . '"' . (!empty($title) ? ' data-fancybox-title="' . $title . '"' : '') . (!empty($group) ? ' data-fancybox-group="' . $group . '"' : '') . ($type != 'img' ? ' data-fancybox-type="' . $type . '"' : '') .  ' href="' . $large . '" style="height:' . $image[2] . 'px">
      <img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $title. '" />
    </a>';

    return $html;

}

/* ------------------------
-----   Pricing Tables    -----
------------------------------*/

function rb_pricing_table_function($atts, $content=null) { 

    extract(shortcode_atts(array(
        'id' => '-1'
    ), $atts));

    $html = '';

    if($id != '-1'){

  		$columns = get_post_meta($id, 'rb_meta_pricing_items', true);
  		$features = explode("\n", get_post_meta($id, 'rb_meta_pricing_features', true));
  		$featured = get_post_meta($id, 'rb_meta_pricing_featured', true);

   		$html .= '<div class="rbPricingTable clearfix size' . count($columns) . ' wpautop">';

  		$html .= '<ul class="features clearfix">';
  		foreach($features as $feature)
  			$html .= '<li>' . $feature . '</li>';
  		$html .= '</ul>';

  		$c = 0;

  		if(!empty($columns))
  			foreach($columns as $column){

  				$c_features = explode("\n", $column['features']);

  				$html .= '<section class="' . ($featured == $c ? 'featured ' : '') . 'column clearfix">
  					<header>
  						' . ($featured == $c++ ? '<span>Most Popular</span>' : '' ) . '
  						<h3>' . $column['title'] . '</h3>
  						<h4>' . $column['price'] . '</h4>
  						<h5>' . $column ['subtitle'] . '</h5>
  					</header>

  					<ul class="features clearfix">';

  				foreach($c_features as $c_feature){
  					if(strpos($c_feature, '*yes*') === false && strpos($c_feature, '*no*') === false) {
  						$html .= '<li>' . $c_feature . '</li>';
  					} else {
  						if(strpos($c_feature, '*yes*') === false) 
  							$html .= '<li>&nbsp;</li>';
  						else
  							$html .= '<li><i class="icon-ok"></i></li>';

  					}
  				}

  				$html .= '<li class="last clearfix"><a href="' . $column['button_link'] . '" target="_self" class="rbButton large dark">' . $column['button_label'] . '</a></li>
  				</ul></section>';

  			}

   		$html .= '</div>';

    }
   
   	return $html;

}

/* ------------------------
-----   Promo Box    -----
------------------------------*/

function rb_box_function($atts, $content=null) { 

    extract(shortcode_atts(array(
        'el_class' => '',
        'style' => 'light'
    ), $atts));

    $html = '<section class="rbBox clearfix ' . $style . ($el_class != '' ? ' ' . $el_class : '') . ' autop">';
    $html .= do_shortcode($content);
    $html .= '</section>';
   
   return $html;

}

/* ------------------------
-----   Posts Widget    -----
------------------------------*/

function rb_custom_posts_function($atts, $content=null) { 

    extract(shortcode_atts(array(
        'el_class' => '',
        'type' => 'popular',
        'no' => '3'
    ), $atts));

    $html = '<section class="rbCustomPosts clearfix ' . $type . ($el_class != '' ? ' ' . $el_class : '') . '">';

	global $post;

	switch($type) {
		case 'popular':
			$all_posts = get_posts(array('numberposts' => $no, 'meta_key' => 'post_views_count', 'orderby' => 'meta_value_num', 'order' => 'DESC'));
			break;
		case 'commented':
			$all_posts = get_posts(array('orderby' => 'comment_count', 'numberposts' => $no));
			break;
		case 'random':
			$all_posts = get_posts(array('orderby' => 'rand', 'numberposts' => $no));
			break;
		default:
			$all_posts = get_posts(array('numberposts' => $no));
	}

	foreach($all_posts as $post) : setup_postdata($post);

		$html .= '<article>
			<a href="' . get_permalink($post->ID) . '" class="clearfix">';

		if($type == 'commented')
			$html .= '<span class="comments"><i class="icon-comment"></i><strong>' . get_comments_number('0', '1', '%') . '</strong></span>';
		else
			$html .= get_the_post_thumbnail($post->ID, 'thumbnail');

		$html .= '<h4>' . get_the_title() . '</h4>
			<span class="time">' . get_the_time('j F Y') . '</span>
		</a></article>';

	endforeach;

	wp_reset_query();
	wp_reset_postdata();

    $html .= '</section>';

    return $html;

}

/* ------------------------
-----   Promo Line    -----
------------------------------*/

function rb_line_function($atts, $content=null) { 

    extract(shortcode_atts(array(
        'el_class' => '',
        'title' => '',
        'subtitle' => '',
        'icon' => 'con-none',
        'link_url' => '',
        'link_label' => '',
        'link_target' => ''
    ), $atts));

    $html = '<section class="rbLine clearfix ' . ($el_class != '' ? ' ' . $el_class : '') . '">
    	<i class="i-medium i' . $icon . '"></i>
    	<h2>' . $title . '</h2>
    	<h5>' . $subtitle . '</h5>';
    $html .= $link_url != '' ? '<a class="rbButton large dark" href="' . $link_url . '" target="' . $link_target . '">' . $link_label . '</a>' : '';
    $html .= '</section>';
   
   return $html;

}

/* ------------------------
-----   Section Title    -----
------------------------------*/

function rb_section_title_function($atts){

    extract(shortcode_atts(array(
        'el_class' => '',
        'icon' => 'con-none',
        'title' => 'Title',
        'margin' => '35',
        'border' => 'true'
    ), $atts));

	$html = "\n\t\t\t" . '<header style="margin-bottom:' . $atts['margin'] . 'px" class="sectionTitle clearfix ' . $icon . ($el_class != '' ? ' ' . $el_class : '') . '">';
	$html .= "\n\t\t\t\t" . '<h3' . ($border == 'false' ? ' style="border-bottom:none"' : '') . '>';

	if($icon != 'con-none') : 
	   	$html .= '<i class="i-small i' . $icon . '"></i>';
	endif;

	$html .= '<strong>' . $title . '</strong></h3>';
	$html .= "\n\t\t\t" . '</header>';

	return $html;

}

/* ------------------------
-----   Sharing Icons   -----
------------------------------*/

function rb_sharing_function($atts){

  global $post;

  extract(shortcode_atts(array(
      'el_class' => '',
      'facebook' => 'true',
      'twitter' => 'true',
      'google' => 'true',
      'pinterest' => 'true'
  ), $atts));

  $html = '<div class="rbSharing">';

  if($facebook == 'true')
    $html .= '<div id="fb-root"></div>
      <script>(function(d, s, id) {
        var js, fjs = d.getElementsByTagName(s)[0];
        if (d.getElementById(id)) return;
        js = d.createElement(s); js.id = id;
        js.src = "//connect.facebook.net/en_US/all.js#xfbml=1&appId=544037148980371";
        fjs.parentNode.insertBefore(js, fjs);
      }(document, "script", "facebook-jssdk"));</script>
      <div class="fb-like" data-href="' . get_permalink($post->ID) . '" data-send="false" data-layout="button_count" data-width="100" data-show-faces="true"></div>';

  if($twitter == 'true')
    $html .= '<a href="https://twitter.com/share" class="twitter-share-button">Tweet</a>
      <script>!function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],p=/^http:/.test(d.location)?"http":"https";if(!d.getElementById(id)){js=d.createElement(s);js.id=id;js.src=p+"://platform.twitter.com/widgets.js";fjs.parentNode.insertBefore(js,fjs);}}(document, "script", "twitter-wjs");</script>';

  if($google == 'true')
    $html .= '<div class="g-plusone" data-size="medium"></div>
      <script type="text/javascript">
      (function() {
        var po = document.createElement("script"); po.type = "text/javascript"; po.async = true;
        po.src = "https://apis.google.com/js/plusone.js";
        var s = document.getElementsByTagName("script")[0]; s.parentNode.insertBefore(po, s);
      })();
    </script>';

  if($pinterest == 'true')
    $html .= '<script type="text/javascript">
      (function(d){
        var f = d.getElementsByTagName("SCRIPT")[0], p = d.createElement("SCRIPT");
        p.type = "text/javascript";
        p.async = true;
        p.src = "//assets.pinterest.com/js/pinit.js";
        f.parentNode.insertBefore(p, f);
      }(document));
      </script><a href="//pinterest.com/pin/create/button/" data-pin-do="buttonBookmark" ><img src="//assets.pinterest.com/images/pidgets/pin_it_button.png" /></a>';

  $html .= '</div>';

  return $html;

}

/* ------------------------
-----   Social Icons   -----
------------------------------*/

function rb_social_function($atts, $content){

    extract(shortcode_atts(array(
        'el_class' => '',
        'target' => '_self',
        'type' => 'thumbs'
    ), $atts));

	$html = '<div class="clearfix">';

	$html .= '<section class="rbSocial clearfix notli ' . $type . ($el_class != '' ? ' ' . $el_class : '') . '"><ul>';

	if(isset($atts['twitter']))
		$html .= '<li class="i-square icon-twitter"><a target="' . $target . '" href="' . $atts['twitter'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['twitter_text']) ? $atts['twitter_text'] : '') . '</p>' : $atts['twitter']) . '</a></li>';
  
  if(isset($atts['facebook']))
    $html .= '<li class="i-square icon-facebook-squared"><a target="' . $target . '" href="' . $atts['facebook'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['facebook_text']) ? $atts['facebook_text'] : '') . '</p>' : $atts['facebook']) . '</a></li>';
  
	if(isset($atts['dribbble']))
		$html .= '<li class="i-square icon-dribbble"><a target="' . $target . '" href="' . $atts['dribbble'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['dribbble_text']) ? $atts['dribbble_text'] : '') . '</p>' : $atts['dribbble']) . '</a></li>';
  
	if(isset($atts['vimeo']))
		$html .= '<li class="i-square icon-vimeo"><a target="' . $target . '" href="' . $atts['vimeo'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['vimeo_text']) ? $atts['vimeo_text'] : '') . '</p>' : $atts['vimeo']) . '</a></li>';
  
	if(isset($atts['linkedin']))
		$html .= '<li class="i-square icon-linkedin"><a target="' . $target . '" href="' . $atts['linkedin'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['linkedin_text']) ? $atts['linkedin_text'] : '') . '</p>' : $atts['linkedin']) . '</a></li>';
  
	if(isset($atts['behance']))
		$html .= '<li class="i-square icon-behance"><a target="' . $target . '" href="' . $atts['behance'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['behance_text']) ? $atts['behance_text'] : '') . '</p>' : $atts['behance']) . '</a></li>';
  
  if(isset($atts['pinterest']))
    $html .= '<li class="i-square icon-pinterest"><a target="' . $target . '" href="' . $atts['pinterest'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['pinterest_text']) ? $atts['pinterest_text'] : '') . '</p>' : $atts['pinterest']) . '</a></li>';
  
	if(isset($atts['delicious']))
		$html .= '<li class="i-square icon-delicious"><a target="' . $target . '" href="' . $atts['delicious'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['delicious_text']) ? $atts['delicious_text'] : '') . '</p>' : $atts['delicious']) . '</a></li>';
  
	if(isset($atts['digg']))
		$html .= '<li class="i-square icon-digg"><a target="' . $target . '" href="' . $atts['digg'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['digg_text']) ? $atts['digg_text'] : '') . '</p>' : $atts['digg']) . '</a></li>';
  
	if(isset($atts['youtube']))
		$html .= '<li class="i-square icon-youtube"><a target="' . $target . '" href="' . $atts['youtube'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['youtube_text']) ? $atts['youtube_text'] : '') . '</p>' : $atts['youtube']) . '</a></li>';
  
	if(isset($atts['cloud']))
		$html .= '<li class="i-square icon-cloud"><a target="' . $target . '" href="' . $atts['cloud'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['cloud_text']) ? $atts['cloud_text'] : '') . '</p>' : $atts['cloud']) . '</a></li>';
  
	if(isset($atts['github']))
		$html .= '<li class="i-square icon-github"><a target="' . $target . '" href="' . $atts['github'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['github_text']) ? $atts['github_text'] : '') . '</p>' : $atts['github']) . '</a></li>';
  
	if(isset($atts['flickr']))
		$html .= '<li class="i-square icon-flickr"><a target="' . $target . '" href="' . $atts['flickr'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['flickr_text']) ? $atts['flickr_text'] : '') . '</p>' : $atts['flickr']) . '</a></li>';
  
	if(isset($atts['googleplus']))
		$html .= '<li class="i-square icon-gplus"><a target="' . $target . '" href="' . $atts['googleplus'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['googleplus_text']) ? $atts['googleplus_text'] : '') . '</p>' : $atts['googleplus']) . '</a></li>';
  
	if(isset($atts['tumblr']))
		$html .= '<li class="i-square icon-tumblr"><a target="' . $target . '" href="' . $atts['tumblr'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['tumblr_text']) ? $atts['tumblr_text'] : '') . '</p>' : $atts['tumblr']) . '</a></li>';
  
	if(isset($atts['stumbleupon']))
		$html .= '<li class="i-square icon-stumbleupon"><a target="' . $target . '" href="' . $atts['stumbleupon'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['stumbleupon_text']) ? $atts['stumbleupon_text'] : '') . '</p>' : $atts['stumbleupon']) . '</a></li>';
  
	if(isset($atts['lastfm']))
		$html .= '<li class="i-square icon-lastfm"><a target="' . $target . '" href="' . $atts['lastfm'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['lastfm_text']) ? $atts['lastfm_text'] : '') . '</p>' : $atts['lastfm']) . '</a></li>';
  
	if(isset($atts['evernote']))
		$html .= '<li class="i-square icon-evernote"><a target="' . $target . '" href="' . $atts['evernote'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['evernote_text']) ? $atts['evernote_text'] : '') . '</p>' : $atts['evernote']) . '</a></li>';
  
	if(isset($atts['picasa']))
		$html .= '<li class="i-square icon-picasa"><a target="' . $target . '" href="' . $atts['picasa'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['picasa_text']) ? $atts['picasa_text'] : '') . '</p>' : $atts['picasa']) . '</a></li>';
  
	if(isset($atts['googlecircles']))
		$html .= '<li class="i-square icon-google-circles"><a target="' . $target . '" href="' . $atts['googlecircles'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['googlecircles_text']) ? $atts['googlecircles_text'] : '') . '</p>' : $atts['googlecircles']) . '</a></li>';
  
  if(isset($atts['skype']))
    $html .= '<li class="i-square icon-skype"><a target="' . $target . '" href="' . $atts['skype'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['skype_text']) ? $atts['skype_text'] : '') . '</p>' :  $atts['skype']) . '</a></li>';
  
  if(isset($atts['mail']))
    $html .= '<li class="i-square icon-mail"><a target="' . $target . '" href="' . $atts['mail'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['mail_text']) ? $atts['mail_text'] : '') . '</p>' :  $atts['mail']) . '</a></li>';
  
	if(isset($atts['rss']))
		$html .= '<li class="i-square icon-rss"><a target="' . $target . '" href="' . $atts['rss'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['rss_text']) ? $atts['rss_text'] : '') . '</p>' :  $atts['rss']) . '</a></li>';

	$html .= '</ul></section></div>';

	return $html;

}

/* ------------------------
-----   Stats   -----
------------------------------*/

function rb_stats_function($atts, $content){

    extract(shortcode_atts(array(
        'el_class' => '',

        'type' => 'pie',

        'item1_title' => '',
        'item1_value' => '',
        'item1_percent' => '',

        'item2_title' => '',
        'item2_value' => '',
        'item2_percent' => '',

        'item3_title' => '',
        'item3_value' => '',
        'item3_percent' => '',

        'item4_title' => '',
        'item4_value' => '',
        'item4_percent' => '',

        'item5_title' => '',
        'item5_value' => '',
        'item5_percent' => '',

        'item6_title' => '',
        'item6_value' => '',
        'item6_percent' => ''
    ), $atts));

	$html = '<section class="rbStats ' . $type . ($el_class != '' ? ' ' . $el_class : '') . ($item2_title != '' ? ' wButtons' : '') . '">
		<div class="holder">
			<p>0</p>
			<h5>' . $item1_title . '</h5>
		</div>

		<ul>';

		if($item1_title != '')
			$html .= '<li data-value="' . $item1_value . '" data-percent="' . $item1_percent . '">
				<p>' . $item1_value . '</p>
				<h5>' . $item1_title . '</h5>
			</li>';

		if($item2_title != '')
			$html .= '<li data-value="' . $item2_value . '" data-percent="' . $item2_percent . '">
				<p>' . $item2_value . '</p>
				<h5>' . $item2_title . '</h5>
			</li>';

		if($item3_title != '')
			$html .= '<li data-value="' . $item3_value . '" data-percent="' . $item3_percent . '">		
				<p>' . $item3_value . '</p>
				<h5>' . $item3_title . '</h5>	
			</li>';

		if($item4_title != '')
			$html .= '<li data-value="' . $item4_value . '" data-percent="' . $item4_percent . '">
				<p>' . $item4_value . '</p>
				<h5>' . $item4_title . '</h5>
			</li>';

		if($item5_title != '')
			$html .= '<li data-value="' . $item5_value . '" data-percent="' . $item5_percent . '">
				<p>' . $item5_value . '</p>
				<h5>' . $item5_title . '</h5>
			</li>';

		if($item6_title != '')
			$html .= '<li data-value="' . $item6_value . '" data-percent="' . $item5_percent . '">
				<p>' . $item6_value . '</p>
				<h5>' . $item6_title . '</h5>
			</li>';

	$html .= '</ul>';

	if($item2_title != '')
		$html .= '<div class="buttons">
			<a class="btnPrev" href="#"></a>
			<a class="btnNext" href="#"></a>
		</div>';

	$html .= '</section>';

	return $html;

}

/* ------------------------
-----   Tabs   -----
------------------------------*/

function rb_tabs_function($atts, $content){

    extract(shortcode_atts(array(
        'el_class' => '',
        'style' => 'light'
    ), $atts));

    $html = '<div class="rbTabs ' . $style . ' ' . ($el_class != '' ? ' ' . $el_class : '') . ' clearfix autop">';

	$tabs = explode('<!-- cut out -->', do_shortcode($content));
	$i = 0; $top = ''; $bottom = '';

	foreach($tabs as $item){

		if($i++%2==0)
			$top .= $item;
		else 
			$bottom .= $item;
	}

    $html .= '<ul class="titles  clearfix autop">' . preg_replace('/<li>/', '<li class="opened">', $top, 1) . '</ul>';
    $html .= '<div class="contents clearfix autop">' . $bottom . '</div>';

    $html .= '</div>';

    return $html;

}

function tb_section_function($atts, $content){

    extract(shortcode_atts(array(
        'title' => 'Section',
    ), $atts));

	$html = '<li><a class="noa" href="#">' . $atts['title'] . '</a></li><!-- cut out --><div>' . do_shortcode($content) . '</div><!-- cut out -->';

    return $html;

}

/* ------------------------
-----   Tagline   -----
------------------------------*/

function rb_tagline_function($atts, $content){

  extract(shortcode_atts(array(
      'el_class' => '',
      'title' => '',
      'subtitle' => '',
      'align' => 'center',
      'icon' => 'con-none'
  ), $atts));

  $html = '<header class="rbTagline scd clearfix' . ($icon != 'con-none' ? ' wicon' : '') . '">';
  if(!empty($title))
    $html .= '<h1>' . $title . '</h1>';
  if(!empty($subtitle))
    $html .= '<h2>' . $subtitle . '</h2>';
  if($icon != 'con-none')
    $html .= '<i class="i-medium i' . $icon . '"></i>';
  $html .= '</header>';

  return $html;

}

/* ------------------------
-----   Team   -----
------------------------------*/

function rb_team_function($atts, $content){

    extract(shortcode_atts(array(
        'el_class' => '',
        'name' => '',
        'faculty_title' => '',
        'student_yrmajor' => '',
        'image' => ''

    ), $atts));

    $html = '<div class="rbTeam ' . ($el_class != '' ? ' ' . $el_class : '') . ' clearfix autop">';

	if($image != ''){
		$img_url = wp_get_attachment_image_src($image, 'full');
		$image = aq_resize($img_url[0], 130, 130, true); 
	}
     
     if ($atts['faculty_title']){
         $id='faculty_title';
         $descriptor=$faculty_title;
     }
     
     if ($atts['student_yrmajor']) {
         $id='student_yrmajor';
         $descriptor=$student_yrmajor;
     } 


     
   // $html .= '<span class="img"><img src="' . $image . '" alt="' . $name . '" /></span>  
    $html .= '<span class="img"><img src="' . $image . '" alt="" /></span>
    	<h3>' . $name . '</h3>
        
    	<h5 id="' . $id . '">' . $descriptor . '</h5>
   
        <div class="bio">' . $content . '</div>
    	<hr />';

   /* $contents = do_shortcode($content);

	if(strpos($contents, 'sicon') > 0)
		$html .= '<ul class="socialList clearfix autop">' . $contents . '</ul>';
	else 
		$html .= $contents;  */

    $html .= '</div>';

    return $html;

}

/*function rb_social_icon_function($atts, $content){

    extract(shortcode_atts(array(
        'type' => 'twitter',
        'url' => '#',
        'target' => '_blank',
    ), $atts));

    $html = '<li><a class="sicon ' . $type . '" href="' . $url . '" target="' . $target . '">' . $url . '</a></li>';

    return $html;

}   */

/* ------------------------
-----   Testimonial    -----
------------------------------*/

function rb_testimonial_function($atts, $content=null) { 

    extract(shortcode_atts(array(
        'el_class' => '',
        'style' => 'light',
        'client' => '',
        'position' => ''
    ), $atts));

	$html = '<figure class="rbTestimonial ' . $style . ($el_class != '' ? ' ' . $el_class : '') . '">
		<blockquote>' . $content . '</blockquote>
		<figcaption><p>' . $client . '</p>
			<span>' . $position . '</span></figcaption>
		</figure>';
   
   return $html;

}

/* ------------------------
-----   Text Block   -----
------------------------------*/

function vc_theme_vc_column_text($atts, $content = null) {

  extract(shortcode_atts(array(
      'el_class' => ''
  ), $atts));

	$html = '<section class="rbText clearfix' . ($el_class != '' ? ' ' . $el_class : ''). ' autop">';
	$html .= do_shortcode($content);
	$html .= '</section>';

	return $html;

}

/* ------------------------
-----   Text Block with Icon    -----
------------------------------*/

function rb_text_icon_function($atts, $content){

    extract(shortcode_atts(array(
        'el_class' => '',
        'url' => '',
        'title' => '',
        'target' => '',
        'icon' => 'con-none',
        'style' => 'large'
    ), $atts));

	$html = '<section class="rbTextIcon clearfix ' . $style . ($el_class != '' ? ' ' . $el_class : '') . '">';

	if($url != '') {
		$url_s = '<a class="clearfix" href="' . $url . '" target="' . $target . '">';
		$url_e = '</a>';
	} else {
		$url_s = $url_e = '';
	}

	if($icon != 'con-none') : 
	   	$html .= $url_s . '<i class="' . ($style == 'large' ? 'i-large' : 'i-default') . ' i' . $icon . '"></i>';
	endif;

	$html .= '<h4>' . $title. '</h4>' . $url_e;
	$html .= '<div>' . do_shortcode($content) . '</div>';
	$html .= '</section>';

	return $html;

}

/* ------------------------
-----   Twitter Feed   -----
------------------------------*/

function rb_twitter_function($atts, $content){

    extract(shortcode_atts(array(
        'el_class' => '',
        'user' => 'rubenbristian',
        'no' => '3',
        'name' => 'Ruben Bristian',
        'avatar' => '',
        'text_reply' => 'Reply',
        'text_retweet' => 'Retweet',
        'text_favorite' => 'Favorite',
        'rotate' => 'enabled'
    ), $atts));

	$html = '<section class="rbTwitter clearfix rot' . $rotate . ($el_class != '' ? ' ' . $el_class : '') . '">
		<a href="https://twitter.com/' . $user . '"><img src="' . $avatar . '" alt="' . $name . '" /></a>
		<a href="https://twitter.com/' . $user . '"><h5>' . $name . '</h5></a>
		<a href="https://twitter.com/' . $user . '"><span>@' . $user . '</span></a>
	    <iframe src="//platform.twitter.com/widgets/follow_button.html?show_screen_name=false&lang=en&show_count=false&screen_name=' . $user . '" style="width:100px; height:24px;"></iframe>
		<ul>';

	$tweets = getTweets($user, $no);

	foreach($tweets as $tweet) {

    if ( ! empty( $tweet) )

  		$html .= '<li>
  			<p class="body">' . rbTwitterFilter($tweet['text']) . '</p>
  			<a class="time" href="https://twitter.com/' . $user . '/status/' . $tweet['id_str'] . '">' . date('j F o \a\t g:i A', strtotime($tweet['created_at'])) . '</a>
  			<div class="intents">
  				<a class="popup reply" data-name="' . $text_reply . '" data-width="400" data-height="200" href="https://twitter.com/intent/tweet?in_reply_to=' . $tweet['id_str'] . '">' . $text_reply . '</a>
  				<a class="popup retweet" data-name="' . $text_retweet . '" data-width="400" data-height="200" href="https://twitter.com/intent/retweet?tweet_id=' . $tweet['id_str'] . '">' . $text_retweet . '</a>
  				<a class="popup favorite" data-name="' . $text_favorite . '" data-width="400" data-height="200" href="https://twitter.com/intent/favorite?tweet_id=' . $tweet['id_str'] . '">' . $text_favorite . '</a>
  			</div>
  		</li>';

	}

	$html .= '</ul></section>';

	return $html;

}

/* ------------------------
-----   Video   -----
------------------------------*/

function rb_video_function($atts, $content){

  extract(shortcode_atts(array(
      'el_class' => '',
      'poster' => '',
      'mp4' => '',
      'ogv' => ''
  ), $atts));

  $html = '<video id="video-' . rand(0, 200) . '" class="video-js vjs-default-skin" controls preload="auto" width="100%" height="100%" poster="' . $poster . '" data-setup="{}" style="width:100%;height:100%;">
      <source src="' . $mp4 . '" type="video/mp4">
      <source src="' . $ogv . '" type="video/ogg">
    </video>';

  return $html;

}

/* ------------------------
-----   Add all Shortcodes from Above   -----
------------------------------*/

add_shortcode('rb_tagline', 'rb_tagline_function');
add_shortcode('rb_projects', 'rb_projects_function');
add_shortcode('rb_posts', 'rb_posts_function');
add_shortcode('rb_list_icons', 'rb_list_icons_function');
add_shortcode('rb_section_title', 'rb_section_title_function');
add_shortcode('rb_text_icon', 'rb_text_icon_function');
add_shortcode('column', 'column_function');
add_shortcode('rb_twitter', 'rb_twitter_function');
add_shortcode('rb_social', 'rb_social_function');
add_shortcode('rb_testimonial', 'rb_testimonial_function');
add_shortcode('rb_social_connect', 'rb_social_connect_function');
add_shortcode('rb_stats', 'rb_stats_function');
add_shortcode('rb_accordion', 'rb_accordion_function');
add_shortcode('ac_section', 'ac_section_function');
add_shortcode('rb_button', 'rb_button_function');
add_shortcode('rb_box', 'rb_box_function');
add_shortcode('rb_flickr','rb_flickr_function');
add_shortcode('rb_line','rb_line_function');
add_shortcode('rb_alert','rb_alert_function');
add_shortcode('rb_form','rb_form_function');
add_shortcode('rb_custom_posts','rb_custom_posts_function');
add_shortcode('rb_tabs','rb_tabs_function');
add_shortcode('tb_section','tb_section_function');
add_shortcode('rb_divider','rb_divider_function');
add_shortcode('rb_social_icon','rb_social_icon_function');
add_shortcode('rb_team','rb_team_function');
add_shortcode('rb_cinfo', 'rb_cinfo_function');
add_shortcode('rb_pricing_table','rb_pricing_table_function');
add_shortcode('rb_blank_divider', 'rb_blank_divider_function');
add_shortcode('rb_lightbox', 'rb_lightbox_function');
remove_shortcode('gallery', 'gallery_shortcode');
add_shortcode('gallery', 'rb_gallery_function');
add_shortcode('rb_sharing', 'rb_sharing_function');
add_shortcode('rb_funding_full', 'rb_funding_full_function');
add_shortcode('rb_funding_mini', 'rb_funding_mini_function');
add_shortcode('rb_video', 'rb_video_function');

?>
