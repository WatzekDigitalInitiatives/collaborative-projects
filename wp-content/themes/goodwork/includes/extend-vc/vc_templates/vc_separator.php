<?php
$output = $height = '';
extract(shortcode_atts(array(
    'el_class'        => '',
    'height'        => '50',
    'height_2'		=> 'x',
    'show_border' => 'no_border'
), $atts));

	if ( $show_border == 'no_border' ) { 
		
		if ( intval( $height ) >= 0 ) {

			echo '<span style="display:block;margin-top:' . $height . 'px"' . ($el_class != '' ? ' class="' . $el_class . '"' : '') . ' ></span>';

		} else {

			echo '<span style="display:block;margin-top:' . $height . 'px"' . ($el_class != '' ? ' class="' . $el_class . ' rbBlankNeg"' : ' class="rbBlankNeg"') . ' ></span>';

		}

	} else {


		echo '<hr style="margin-top:' . $height_2 . 'px; margin-bottom:' . $height . 'px;" class="rbDivider ' . ($el_class != '' ? ' ' . $el_class : '') . ' autop" />';


	} 