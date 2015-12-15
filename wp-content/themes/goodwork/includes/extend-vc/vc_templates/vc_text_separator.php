<?php
$output = $title = $subtitle = $align = $style = $height = $margin = $el_class = '';
extract(shortcode_atts(array(
    'title' => __("Title", "krown"),
    'subtitle' => "",
    'icon' => 'none',
    'align' => 'align-center',
    'height' => '100',
    'margin' => '50',
    'border' => 'true',
    'el_class' => '',
    'css_animation' => '',
    'css_animation_speed' => 'default',
    'css_animation_delay' => '0'
), $atts));

$html = "\n\t\t\t" . '<header style="margin-bottom:' . $atts['margin'] . 'px" class="sectionTitle clearfix' . ( $icon == 'con-none' || $icon == 'none' ? ' no-con' : '' ) . ($el_class != '' ? ' ' . $el_class : '') . '">';
$html .= "\n\t\t\t\t" . '<h3' . ($border == 'false' ? ' style="border-bottom:none"' : '') . '>';

if($icon != 'con-none' && $icon != 'none') {
	if ( $icon[0] == 'c' ) {
		$icon = str_replace( 'con-', 'krown-icon-', $icon);
	}
   	$html .= '<i class="i-small ' . $icon . '"></i>';
}

$html .= '<strong>' . $title . '</strong></h3>';
$html .= "\n\t\t\t" . '</header>';

echo $html;