<?php

// This file contains some new shortcodes for the Visual Composer plugin - custom shortcodes made by me


// Gallery

function krown_gallery_function( $attr ) {

    global $post;

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
        'type'           => 'thumbs',
        'columns'        => '3',
        'width'          => 'null',
        'lightbox'       => 'false',
        'grid'           => 'false'
    ), $attr ) );

    $id = intval( $id );
    if ( 'RAND' == $order ) {
        $orderby = 'none';
    }

    if ( $type == 'thumbs' ) {
    	$type = 'thumbnails';
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

    $slides = '';

    $thumbs_col = 100 / $columns;
    $thumbs_width = floor(1140 / $columns);

    $i = 0;

    foreach ( $attachments as $id => $attachment ) {

        $link = isset( $attr['link'] ) && 'file' == $attr['link'] ? wp_get_attachment_image_src( $id, 'full', false, false ) : wp_get_attachment_image_src( $id, 'full', true, false );

        $caption = get_post( $id )->post_excerpt;
        $title = get_post( $id )->post_title;

        $extra_class = '';
        if ( $i % $columns == 0 ) {
            $extra_class = ' first';
        }
        if ( ++$i % $columns == 0 ) {
            $extra_class = ' last';
        } 

        if ( $type == 'slider' ) {

            $slides .= '<li>';

            if ( $lightbox == 'true') {
                $slides .= '<a href="' . $link[0] . '" class="fancybox fancybox-thumb">';
            }

            if ( $grid == 'true' ) {
                $link[0] = aq_resize( $link[0], '680', null );
            }

            $slides .= '<img src="' . $link[0] . '" alt="' . $caption .'" />';


            if ( $lightbox == 'true') {
                $slides .= '</a>';
            }

            if ( isset( $caption ) && $caption != '' ) {
                $slides .= '<p class="flex-caption">'. $caption . '</p>';
            }

            $slides .= '</li>';


        } else {

            $slides .= '<a class="fancybox fancybox-thumb' . $extra_class . '" data-fancybox-group="gallery-' . $instance . '" data-fancybox-title="' . $caption . '" href="' . $link[0] . '" style="width:' . $thumbs_col . '%"><img src="' . aq_resize( $link[0], $thumbs_width, $thumbs_width, true ) . '" /></a>';

        }

    }

    if ( $type == 'slider' ) {

        $html = '<div class="flexslider pMedia folio nono"><ul class="slides">' . $slides . '</ul></div>';

    } else {

        $html = '<div class="krown-thumbnail-gallery clearfix">' . $slides . '</div>';

    }

    return $html;

}

remove_shortcode( 'gallery', 'gallery_shortcode' );
add_shortcode( 'gallery', 'krown_gallery_function' );

// Contact info

function vc_contact_info_function($atts, $content=null) { 

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

add_shortcode( 'vc_contact_info', 'vc_contact_info_function' );
add_shortcode( 'rb_cinfo', 'vc_contact_info_function' );

// Contact form

function vc_contact_form_function($atts, $content=null) { 

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

add_shortcode( 'vc_contact_form', 'vc_contact_form_function' );
add_shortcode( 'rb_form', 'vc_contact_form_function' );

// Lightbox

function vc_lightbox_function($atts, $content=null){

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

add_shortcode( 'vc_lightbox', 'vc_lightbox_function' );
add_shortcode( 'rb_lightbox', 'vc_lightbox_function' );

// Pricing tables

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
  							$html .= '<li><i class="krown-icon-ok"></i></li>';

  					}
  				}

  				$html .= '<li class="last clearfix"><a href="' . $column['button_link'] . '" target="_self" class="rbButton large dark">' . $column['button_label'] . '</a></li>
  				</ul></section>';

  			}

   		$html .= '</div>';

    }
   
   	return $html;

}

add_shortcode( 'rb_pricing_table', 'rb_pricing_table_function' );

// Promo box

function vc_promo_box_function($atts, $content=null) { 

    extract(shortcode_atts(array(
        'el_class' => '',
        'style' => 'light'
    ), $atts));

    $html = '<section class="rbBox clearfix ' . $style . ($el_class != '' ? ' ' . $el_class : '') . ' autop">';
    $html .= do_shortcode($content);
    $html .= '</section>';
   
   return $html;

}

add_shortcode( 'vc_promo_box', 'vc_promo_box_function' );
add_shortcode( 'rb_promo_box', 'vc_promo_box_function' );

// Promo line

function vc_promo_line_function($atts, $content=null) { 

    extract(shortcode_atts(array(
        'el_class' => '',
        'title' => '',
        'subtitle' => '',
        'icon' => 'none',
        'link_url' => '',
        'link_label' => '',
        'link_target' => ''
    ), $atts));

	if ( $icon[0] == 'c' ) {
		$icon = str_replace( 'con-', 'krown-icon-', $icon);
	}

    $html = '<section class="rbLine clearfix ' . ($el_class != '' ? ' ' . $el_class : '') . '">
    	<i class="i-medium ' . $icon . '"></i>
    	<h2>' . $title . '</h2>
    	<h5>' . $subtitle . '</h5>';
    $html .= $link_url != '' ? '<a class="rbButton large dark" href="' . $link_url . '" target="' . $link_target . '">' . $link_label . '</a>' : '';
    $html .= '</section>';
   
   return $html;

}

add_shortcode( 'vc_promo_line', 'vc_promo_line_function' );
add_shortcode( 'rb_promo_line', 'vc_promo_line_function' );

// Custom posto

function vc_custom_posts_function($atts, $content=null) { 

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

		if($type == 'commented') {
			$html .= '<span class="comments"><i class="krown-icon-comment"></i><strong>' . get_comments_number('0', '1', '%') . '</strong></span>';
		} else {

			$thumb = get_post_thumbnail_id( $post->ID );
			$img_url = wp_get_attachment_url( $thumb, 'full' );  
			$image = aq_resize($img_url, 58, 43, true); 
			$html .= '<img src="' . $image . '" alt="" />';
		}

		$html .= '<h4>' . get_the_title() . '</h4>
			<span class="time">' . get_the_time('j F Y') . '</span>
		</a></article>';

	endforeach;

	wp_reset_query();
	wp_reset_postdata();

    $html .= '</section>';

    return $html;

}

add_shortcode( 'vc_custom_posts', 'vc_custom_posts_function' );
add_shortcode( 'rb_custom_posts', 'vc_custom_posts_function' );

// Sharing icons

function rb_sharing_function(){
	return '';
}
add_shortcode( 'rb_sharing', 'rb_sharing_function' );

// Sharing links

function vc_social_function($atts, $content){

    extract(shortcode_atts(array(
        'el_class' => '',
        'target' => '_self',
        'type' => 'icons'
    ), $atts));

	$html = '<div class="clearfix">';

	$html .= '<section class="rbSocial clearfix notli ' . $type . ($el_class != '' ? ' ' . $el_class : '') . '"><ul>';

	if(isset($atts['twitter']))
		$html .= '<li class="i-square krown-icon-twitter"><a target="' . $target . '" href="' . $atts['twitter'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['twitter_text']) ? $atts['twitter_text'] : '') . '</p>' : $atts['twitter']) . '</a></li>';
  
  if(isset($atts['facebook']))
    $html .= '<li class="i-square krown-icon-facebook-squared"><a target="' . $target . '" href="' . $atts['facebook'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['facebook_text']) ? $atts['facebook_text'] : '') . '</p>' : $atts['facebook']) . '</a></li>';
  
	if(isset($atts['dribbble']))
		$html .= '<li class="i-square krown-icon-dribbble"><a target="' . $target . '" href="' . $atts['dribbble'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['dribbble_text']) ? $atts['dribbble_text'] : '') . '</p>' : $atts['dribbble']) . '</a></li>';
  
	if(isset($atts['vimeo']))
		$html .= '<li class="i-square krown-icon-vimeo"><a target="' . $target . '" href="' . $atts['vimeo'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['vimeo_text']) ? $atts['vimeo_text'] : '') . '</p>' : $atts['vimeo']) . '</a></li>';
  
	if(isset($atts['linkedin']))
		$html .= '<li class="i-square krown-icon-linkedin"><a target="' . $target . '" href="' . $atts['linkedin'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['linkedin_text']) ? $atts['linkedin_text'] : '') . '</p>' : $atts['linkedin']) . '</a></li>';
  
	if(isset($atts['behance']))
		$html .= '<li class="i-square krown-icon-behance"><a target="' . $target . '" href="' . $atts['behance'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['behance_text']) ? $atts['behance_text'] : '') . '</p>' : $atts['behance']) . '</a></li>';
  
  if(isset($atts['pinterest']))
    $html .= '<li class="i-square krown-icon-pinterest"><a target="' . $target . '" href="' . $atts['pinterest'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['pinterest_text']) ? $atts['pinterest_text'] : '') . '</p>' : $atts['pinterest']) . '</a></li>';
  
	if(isset($atts['delicious']))
		$html .= '<li class="i-square krown-icon-delicious"><a target="' . $target . '" href="' . $atts['delicious'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['delicious_text']) ? $atts['delicious_text'] : '') . '</p>' : $atts['delicious']) . '</a></li>';
  
	if(isset($atts['digg']))
		$html .= '<li class="i-square krown-icon-digg"><a target="' . $target . '" href="' . $atts['digg'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['digg_text']) ? $atts['digg_text'] : '') . '</p>' : $atts['digg']) . '</a></li>';
  
	if(isset($atts['youtube']))
		$html .= '<li class="i-square krown-icon-youtube"><a target="' . $target . '" href="' . $atts['youtube'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['youtube_text']) ? $atts['youtube_text'] : '') . '</p>' : $atts['youtube']) . '</a></li>';
  
	if(isset($atts['cloud']))
		$html .= '<li class="i-square krown-icon-cloud"><a target="' . $target . '" href="' . $atts['cloud'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['cloud_text']) ? $atts['cloud_text'] : '') . '</p>' : $atts['cloud']) . '</a></li>';
  
	if(isset($atts['github']))
		$html .= '<li class="i-square krown-icon-github"><a target="' . $target . '" href="' . $atts['github'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['github_text']) ? $atts['github_text'] : '') . '</p>' : $atts['github']) . '</a></li>';
  
	if(isset($atts['flickr']))
		$html .= '<li class="i-square krown-icon-flickr"><a target="' . $target . '" href="' . $atts['flickr'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['flickr_text']) ? $atts['flickr_text'] : '') . '</p>' : $atts['flickr']) . '</a></li>';
  
	if(isset($atts['googleplus']))
		$html .= '<li class="i-square krown-icon-gplus"><a target="' . $target . '" href="' . $atts['googleplus'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['googleplus_text']) ? $atts['googleplus_text'] : '') . '</p>' : $atts['googleplus']) . '</a></li>';
  
	if(isset($atts['tumblr']))
		$html .= '<li class="i-square krown-icon-tumblr"><a target="' . $target . '" href="' . $atts['tumblr'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['tumblr_text']) ? $atts['tumblr_text'] : '') . '</p>' : $atts['tumblr']) . '</a></li>';
  
	if(isset($atts['stumbleupon']))
		$html .= '<li class="i-square krown-icon-stumbleupon"><a target="' . $target . '" href="' . $atts['stumbleupon'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['stumbleupon_text']) ? $atts['stumbleupon_text'] : '') . '</p>' : $atts['stumbleupon']) . '</a></li>';
  
	if(isset($atts['lastfm']))
		$html .= '<li class="i-square krown-icon-lastfm"><a target="' . $target . '" href="' . $atts['lastfm'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['lastfm_text']) ? $atts['lastfm_text'] : '') . '</p>' : $atts['lastfm']) . '</a></li>';
  
	if(isset($atts['evernote']))
		$html .= '<li class="i-square krown-icon-evernote"><a target="' . $target . '" href="' . $atts['evernote'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['evernote_text']) ? $atts['evernote_text'] : '') . '</p>' : $atts['evernote']) . '</a></li>';
  
	if(isset($atts['picasa']))
		$html .= '<li class="i-square krown-icon-picasa"><a target="' . $target . '" href="' . $atts['picasa'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['picasa_text']) ? $atts['picasa_text'] : '') . '</p>' : $atts['picasa']) . '</a></li>';
  
	if(isset($atts['googlecircles']))
		$html .= '<li class="i-square krown-icon-google-circles"><a target="' . $target . '" href="' . $atts['googlecircles'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['googlecircles_text']) ? $atts['googlecircles_text'] : '') . '</p>' : $atts['googlecircles']) . '</a></li>';
  
  if(isset($atts['skype']))
    $html .= '<li class="i-square krown-icon-skype"><a target="' . $target . '" href="' . $atts['skype'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['skype_text']) ? $atts['skype_text'] : '') . '</p>' :  $atts['skype']) . '</a></li>';
  
  if(isset($atts['soundcloud']))
    $html .= '<li class="i-square krown-icon-soundcloud"><a target="' . $target . '" href="' . $atts['soundcloud'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['soundcloud_text']) ? $atts['soundcloud_text'] : '') . '</p>' :  $atts['soundcloud']) . '</a></li>';
  
  if(isset($atts['dropbox']))
    $html .= '<li class="i-square krown-icon-dropbox"><a target="' . $target . '" href="' . $atts['dropbox'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['dropbox_text']) ? $atts['dropbox_text'] : '') . '</p>' :  $atts['dropbox']) . '</a></li>';
  
  if(isset($atts['xing']))
    $html .= '<li class="i-square krown-icon-xing"><a target="' . $target . '" href="' . $atts['xing'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['xing_text']) ? $atts['xing_text'] : '') . '</p>' :  $atts['xing']) . '</a></li>';
  
  if(isset($atts['instagram']))
    $html .= '<li class="i-square krown-icon-instagram"><a target="' . $target . '" href="' . $atts['instagram'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['instagram_text']) ? $atts['instagram_text'] : '') . '</p>' :  $atts['instagram']) . '</a></li>';
  
  if(isset($atts['aim']))
    $html .= '<li class="i-square krown-icon-aim"><a target="' . $target . '" href="' . $atts['aim'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['aim_text']) ? $atts['aim_text'] : '') . '</p>' :  $atts['aim']) . '</a></li>';
  
  if(isset($atts['steam']))
    $html .= '<li class="i-square krown-icon-steam"><a target="' . $target . '" href="' . $atts['steam'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['steam_text']) ? $atts['steam_text'] : '') . '</p>' :  $atts['steam']) . '</a></li>';
  
  if(isset($atts['mail']))
    $html .= '<li class="i-square krown-icon-mail"><a target="' . $target . '" href="' . $atts['mail'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['mail_text']) ? $atts['mail_text'] : '') . '</p>' :  $atts['mail']) . '</a></li>';
  
	if(isset($atts['rss']))
		$html .= '<li class="i-square krown-icon-rss"><a target="' . $target . '" href="' . $atts['rss'] . '">' . ($type == 'list' ? '<p>' . (isset($atts['rss_text']) ? $atts['rss_text'] : '') . '</p>' :  $atts['rss']) . '</a></li>';

	$html .= '</ul></section></div>';

	return $html;

}

add_shortcode( 'vc_social', 'vc_social_function' );
add_shortcode( 'vc_social_links', 'vc_social_function' );
add_shortcode( 'rb_social', 'vc_social_function' );

// Tagline

function vc_tagline_function($atts, $content){

  extract(shortcode_atts(array(
      'el_class' => '',
      'title' => '',
      'subtitle' => '',
      'align' => 'center',
      'icon' => 'none'
  ), $atts));

  $html = '<header class="rbTagline scd clearfix' . ($icon != 'con-none' && $icon != 'none' ? ' wicon' : '') . '">';
  if(!empty($title))
    $html .= '<h1>' . $title . '</h1>';
  if(!empty($subtitle))
    $html .= '<h2>' . $subtitle . '</h2>';

	
	if($icon != 'con-none' && $icon != 'none' ) {

		if ( $icon[0] == 'c' ) {
			$icon = str_replace( 'con-', 'krown-icon-', $icon);
		}

	}

  if($icon != 'con-none')
    $html .= '<i class="i-medium ' . $icon . '"></i>';
  $html .= '</header>';

  return $html;

}

add_shortcode( 'vc_tagline', 'vc_tagline_function' );
add_shortcode( 'rb_tagline', 'vc_tagline_function' );

// Team




function vc_team_function($atts, $content){

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
    $html .= '<span class="img"><img src="' . $image . '" alt="" /></span>
    	<h3>' . $name . '</h3>
        
    	<h5 id="' . $id . '">' . $descriptor . '</h5>
   
        <div class="bio">' . $content . '</div>
    	<hr />';
/*
    $html .= '<span class="img"><img src="' . $image . '" alt="' . $title . '" /></span>
    	<h3>' . $title . '</h3>
    	<h5>' . $subtitle . '</h5>
    	<hr />';
*/
   /*
    $contents = do_shortcode($content);

	if(strpos($contents, 'sicon') > 0)
		$html .= '<ul class="socialList clearfix autop">' . $contents . '</ul>';
	else 
		$html .= $contents;
*/
    $html .= '</div>';

    return $html;

}

add_shortcode( 'vc_team', 'vc_team_function' );
add_shortcode( 'rb_team', 'vc_team_function' );

// Testimonial

function vc_testimonial_function($atts, $content=null) { 

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

add_shortcode( 'vc_testimonial', 'vc_testimonial_function' );
add_shortcode( 'rb_testimonial', 'vc_testimonial_function' );

// Text block with icon

function vc_text_icon_function($atts, $content){

    extract(shortcode_atts(array(
        'el_class' => '',
        'href' => '',
        'title' => '',
        'target' => '_self',
        'icon' => 'none',
        'style' => 'large'
    ), $atts));

    if ( isset( $atts['url'] ) && $atts['url'] != '' && $atts['url'] != $href && $href == '' ) {
    	$href = $atts['url'];
    }

	$html = '<section class="rbTextIcon clearfix ' . $style . ($el_class != '' ? ' ' . $el_class : '') . '">';

	if($href != '') {
		$url_s = '<a class="clearfix" href="' . $href . '" target="' . $target . '">';
		$url_e = '</a>';
	} else {
		$url_s = $url_e = '';
	}


	if($icon != 'con-none' && $icon != 'none' ) {

		if ( $icon[0] == 'c' ) {
			$icon = str_replace( 'con-', 'krown-icon-', $icon);
		}

	   	$html .= $url_s . '<i class="' . ($style == 'large' ? 'i-large' : 'i-default') . ' ' . $icon . '"></i>';

	}

	$html .= '<h4>' . $title. '</h4>' . $url_e;
	$html .= '<div>' . do_shortcode($content) . '</div>';
	$html .= '</section>';

	return $html;

}

add_shortcode( 'vc_icon_text', 'vc_text_icon_function' );
add_shortcode( 'rb_text_icon', 'vc_text_icon_function' );

// Portfolio

function vc_portfolio_grid_function( $atts, $content ) {


  extract(shortcode_atts(array(
      'el_class' => '',
      'style' => 'one',
      'no' => '4',
      'cols' => 'four',
      'all' => 'true',
      'all_url' => '',
      'all_text' => 'View all portfolio &rarr;',
      'cat' => '',
      'ajax' => 'false'
  ), $atts));

  global $post;

  $v_page = get_option('krown_portfolio_page');

  $html = '<section class="rbProjects latestProjects portfolio clearfix ' . ($el_class != '' ? ' ' . $el_class : '') . ' t' . $style . ' c' . $cols . ' a' . $ajax . ' autop">';

  if($ajax == 'true')
    $html .= '<div id="folioDetails"></div>';

	$html .= '<ul id="items" class="clearfix">';

	$paged = get_query_var( 'paged' ) ? get_query_var( 'paged' ) : 1;
	$args = array( 'posts_per_page' => $no, 
		   'offset'=> 0,
		   'paged' => $paged,
		   'portfolio_category' => $cat,
		   'post_type' => 'portfolio');

	$all_posts = new WP_Query($args);

	while($all_posts->have_posts()) : $all_posts->the_post();

		$html .= '<li class="item ' . krown_categories($post->ID, 'portfolio_category', ' ', 'slug', false) . '">
				<a href="' . get_permalink($post->ID) . '" data-slug="' . $post->post_name . '" class="clearfix">
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

add_shortcode( 'vc_portfolio_grid', 'vc_portfolio_grid_function' );
add_shortcode( 'rb_projects', 'vc_portfolio_grid_function' );

?>