<?php
$output = $title = $values = $units = $bgcolor = $custombgcolor = $options = $el_class = '';
extract( shortcode_atts( array(

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
    'item6_percent' => '',

    'el_class' => ''

), $atts ) );


	$html = '<section class="rbStats bars' . ($el_class != '' ? ' ' . $el_class : '') . ($item2_title != '' ? ' wButtons' : '') . '">
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

	echo $html;