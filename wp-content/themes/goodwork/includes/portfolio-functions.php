<?php

// This file contains functions for the custom portfolios available with this theme.

/*---------------------------------
	Gallery
------------------------------------*/

if ( ! function_exists( 'krown_portfolio_slider' ) ) {

	function krown_portfolio_slider( $post_id, $sidebar ){

		$html = '<div class="flexslider pFolio folio" id="slider-' . $post_id . '"><ul class="slides">';

		$slides = explode( ',', get_post_meta( $post_id, 'pp_gallery_slider', true ) );

		$img_width = $sidebar['sidebar_type'] != '' && $sidebar['sidebar_type'] != 'full-width' ? '700' : '940';

		if ( ! empty( $slides ) && ! empty( $slides[0] ) ) {

			// New method

			foreach ( $slides as $slide_id ) {

				// Get video code

				$video_code = get_post_meta( $slide_id, 'video_code', true);
				$video_file = get_post_meta( $slide_id, 'video_file', true);

				// Get image, crop it, then return it back

				$img = wp_get_attachment_image_src( $slide_id, 'full' );
				$img_url = $img[0];
				$image = aq_resize( $img_url, $img_width, null, false, false );

				// Create the slide based on the proper info from above

				if ( $video_code != '' ) {

					$html .= '<li><div class="video-embedded pMedia" data-id="' . rand(1, 9999) . '" data-href="' . krown_parse_video( $video_code ) . '"><img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="" /></div></li>';

				} else if ( $video_file != '' ) {

					$html .= '<li><video class="video-hosted pMedia" width="' . $image[1] . '" height="' . $image[2] . '" style="width:100%;height:100%" poster="' . $image[0] . '"><source type="video/mp4" src="' . $video_file . '" /></video></li>';

				} else {

					$html .= '<li><img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="" /></li>';

				}


			}


		} else {

			// Old method

			$slides = get_post_meta($post_id, 'rb_folio_slider', true);

			if ( ! empty( $slides ) ) {

				foreach ( $slides as $slide ) {

					if ( $slide['rb_slide_image'] != '' ) {

						$html .= '<li data-caption="' . $slide['rb_slide_caption'] . '">';

						$img_url = $slide['rb_slide_image'];; 
						$image = aq_resize( $img_url, $img_width, null, false, false ); 

						$html .= '<img src="' . $image[0] . '" width="' . $image[1] . '" height="' . $image[2] . '" alt="' . $slide['title'] . '" />';

						$html .= '</li>';

					} else if ( $slide['rb_slide_video_code'] != '' ) {

						$html .= '<li>' . $slide['rb_slide_video_code'] . '</li>';

					} else if ( $slide['rb_slide_video_1'] != '' ) {

						$html .= '<li><video id="video-' . $post_id . '" class="pMedia" controls preload="auto" width="100%" height="100%" poster="' . $slide['rb_slide_video_3'] . '" style="width:100%;height:100%;"><source src="' . $slide['rb_slide_video_1'] . '" type="video/mp4"></video></li>';

					}

				}

			}

		}

		$html .= '</ul></div>';

		echo $html;

	}

}

/*---------------------------------
	Additional Functions
------------------------------------*/

function krown_parse_video( $code ) {

	if ( strpos( $code, 'iframe' ) ) {

		preg_match( '/src="(.*?)"/', $code, $matches );

		if ( isset( $matches[1] ) && $matches[1] != '' ) {
			$code = $matches[1];
		}

	}

	if ( ! strpos( $code, 'autoplay' ) ) {
		$code .= strpos( $code, '?' ) ? '&autoplay=1' : '?autoplay=1';
	}

	return $code;

}

function krown_portfolio_the_permalink( $url, $id, $return = false ) {
	if ( ! $return )
		echo $url . ( strpos( $url, '?' ) ? '&' : '?' ) . 'id=' . $id;
	else
		return $url . ( strpos( $url, '?' ) ? '&' : '?' ) . 'id=' . $id;
}

function krown_get_adjacent_post( $in_same_term = false, $excluded_terms = '', $previous = true, $taxonomy = 'category' ) {

	global $post, $wpdb;

	if ( ( ! $post = get_post() ) || ! taxonomy_exists( $taxonomy ) ) 
		return null; 

	$current_post_date = $post->post_date;

	$join = '';
	$posts_in_ex_terms_sql = ''; 
	if ( $in_same_term || ! empty( $excluded_terms ) ) { 
		$join = " INNER JOIN $wpdb->term_relationships AS tr ON p.ID = tr.object_id INNER JOIN $wpdb->term_taxonomy tt ON tr.term_taxonomy_id = tt.term_taxonomy_id"; 

		if ( $in_same_term ) {
			if ( ! is_object_in_taxonomy( $post->post_type, $taxonomy ) ) 
				return '';
			$term_array = wp_get_object_terms( $post->ID, $taxonomy, array( 'fields' => 'ids' ) ); 
			$join .= $wpdb->prepare( " AND tt.taxonomy = %s AND tt.term_id IN (" . implode( ',', array_map( 'intval', $term_array ) ) . ")", $taxonomy ); 
		}

		$posts_in_ex_terms_sql = $wpdb->prepare( "AND tt.taxonomy = %s", $taxonomy ); 
		if ( ! empty( $excluded_terms ) ) { 
			if ( ! is_array( $excluded_terms ) ) { 
				if ( false !== strpos( $excluded_terms, ' and ' ) ) { 
					_deprecated_argument( __FUNCTION__, '3.3', sprintf( __( 'Use commas instead of %s to separate excluded terms.', 'goodwork' ), "'and'" ) ); 
					$excluded_terms = explode( ' and ', $excluded_terms ); 
				} else {
					$excluded_terms = explode( ',', $excluded_terms );
				}
			}

			$excluded_terms = array_map( 'intval', $excluded_terms ); 
				
			if ( ! empty( $term_array ) ) { 
				$excluded_terms = array_diff( $excluded_terms, $term_array );
				$posts_in_ex_terms_sql = ''; 
			}

			if ( ! empty( $excluded_terms ) ) { 
				$posts_in_ex_terms_sql = $wpdb->prepare( " AND tt.taxonomy = %s AND tt.term_id NOT IN (" . implode( $excluded_terms, ',' ) . ')', $taxonomy ); 
			}
		}
	}

	$adjacent = $previous ? 'previous' : 'next';
	$op = $previous ? '<' : '>';
	$order = $previous ? 'DESC' : 'ASC';

	$join  = apply_filters( "get_{$adjacent}_post_join", $join, $in_same_term, $excluded_terms ); 
	$where = apply_filters( "get_{$adjacent}_post_where", $wpdb->prepare( "WHERE p.post_date $op %s AND p.post_type = %s AND p.post_excerpt NOT like 'link' AND p.post_status = 'publish' $posts_in_ex_terms_sql", $current_post_date, $post->post_type), $in_same_term, $excluded_terms ); 
	$sort  = apply_filters( "get_{$adjacent}_post_sort", "ORDER BY p.post_date $order LIMIT 1" );

	$query = "SELECT p.ID FROM $wpdb->posts AS p $join $where $sort"; 
	
	$query_key = 'adjacent_post_' . md5( $query ); 
	$result = wp_cache_get( $query_key, 'counts' ); 
	if ( false !== $result ) {
		if( $result )
			$result = get_post( $result );
		return $result;
	}

	$result = $wpdb->get_var( $query );
	if (null === $result )
		$result = '';

	wp_cache_set( $query_key, $result, 'counts');

	if ( $result ) 
		$result = get_post( $result );

	return $result;

}

/*---------------------------------
	Thumbnails size
------------------------------------*/

if ( ! function_exists( 'krown_portfolio_thumbnails_size' ) ) {

	function krown_portfolio_thumbnails_size( $style, $cols ) {

		$img_size = array();

	    if ( $style == 'classic' ) {

	        if ( $cols == 'col-3' ) {
	            $img_size[0] = 353; 
	            $img_size[1] = 266;
	        } else {
	            $img_size[0] = 255; 
	            $img_size[1] = 193;
	        }

	    } else if ( $style == 'alt' ) {

	        if ( $cols == 'col-3' ) {
	            $img_size[0] = 380; 
	            $img_size[1] = 287;
	        } else {
	            $img_size[0] = 285; 
	            $img_size[1] = 215;
	        }

	    }

	    return $img_size;

	}

}


?>