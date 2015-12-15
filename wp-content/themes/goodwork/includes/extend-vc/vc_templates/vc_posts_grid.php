<?php
$grid_link = $grid_layout_mode = $title = $filter= '';
$posts = array();

extract(shortcode_atts(array(
    'el_class'     => '',
      'type' => 'classic',
      'no' => '4',
      'no2' => '2',
      'more' => 'true',
      'ajax' => 'false',
      'text_nomore' => 'No More Posts',
      'text_more' => 'Load More Posts',
      'text_showing' => 'Showing',
      'text_read' => 'Read More',
    'loop'         => 'order_by:date|post_type:post'
), $atts));

$args_temp = explode( '|', $loop);
$args = array();
foreach ( $args_temp as $arg ) {
    $arg_temp = explode( ':', $arg );
    if ( $arg_temp[0] == 'size' ) {
        $args['posts_per_page'] = $no;
    } else if ( $arg_temp[0] == 'categories' ) {
        $args['cat'] = $arg_temp[1];
    } else if ( $arg_temp[0] == 'tags' ) {
        $args['tag_id'] = $arg_temp[1];
    } else {
        $args[$arg_temp[0]] = $arg_temp[1];
    }
}

$paged_string = is_home() || is_front_page() ? 'page' : 'paged';
$paged = get_query_var( $paged_string ) ? get_query_var( $paged_string ) : 1;

$args['paged'] = $paged;

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

		if ( isset( $args['cat'] ) && $args['cat'] != '' ) {

			$blog_categories_temp = explode( ',', $args['cat'] );
			$blog_categories = array();

			foreach ( $blog_categories_temp as $cat_id ) {
				array_push( $blog_categories, get_term_by( 'id', $cat_id, 'category' ) );
			}

		} else {	

			$blog_categories = get_categories(array('type'=>'post', 'orderby' => 'name'));

     	}
 
      foreach ( $blog_categories as $blog_category )
            $html .= '<li><a href="#" data-filter=".category-' . $blog_category->slug . '">' . $blog_category->name . '</a></li>';

        $html .= '</ul>
      </div>';

  }

  if($more == 'true' && $ajax == 'false' && $type == 'classic')
    $po = $no * $no2;

    $i = 0;

$all_posts = new WP_Query( $args );

wp_reset_query();



	while($all_posts->have_posts()) : $all_posts->the_post();

  	$post_format = get_post_format() == '' ? __('standard', 'goodwork') : get_post_format();
  	$cat = get_the_category();
  	$class = get_post_class($post->post_name . ' post clearfix', $post->ID);

    if($type == 'modern') :
  	
    	$html .= '<article id="post-' . $post->ID . '" class="' . implode(' ', $class) . '"' . ($ajax == 'true' && $type == 'modern' ? ($kI++ >= $kT ? ' style="height:0"' : '') : '') . '>

    		<a class="clearfix" href="' . (get_post_format() == 'link' ? get_post_meta($post->ID, 'rb_meta_box_post_assets_l', true) : get_permalink($post->ID)) .'" data-slug="' . $post->post_name .'" data-type="' . $post_format . '">

    			<header>
    				<span class="pTime">' . get_the_time( __( 'jS F Y', 'goodwork' ) ) . '</span>
            <span class="pTime p2">' . get_the_time( __( 'j/m/y', 'goodwork' ) ) . '</span>
    				<h3 class="pTitle krown-icon-none">' . get_the_title($post->ID) . '</h3>
    			</header>

    			<footer>
    				<div class="pComments krown-icon-none">' . get_comments_number('0', '1', '%') . '</div>
    				<div class="pType krown-icon-none">' .  $cat[0]->cat_name . '</div>
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
            <span class="time">' . get_the_time( __( 'jS F Y', 'goodwork' ) ) . '</span>
          </a>
        </header>

        <section><p>' . krown_excerpt( 'krown_excerptlength_post') . '<a class="more nav-next" href="' . get_permalink($post->ID) .'">' . $text_read . '</a></p></section>

      </article>';

    endif;
		
	endwhile;

  if($ajax == 'true' && $type == 'modern')
    $html .= '<a class="clearfix morePosts" href="#"><span data-more="' . $text_more . '" data-less="' . $text_nomore . '">' . $text_more . '</span></a>';

	$html .= '</div>';

  if($more == 'true')
    $html .= '<div class="buttons"><a class="btnPrev" href="#"></a><a class="btnNext" href="#"></a></div>';

  $html .= '</section>';

echo $html;

//$el_class = $this->getExtraClass( $el_class );