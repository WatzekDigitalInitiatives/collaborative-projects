<?php

$output = '';
extract(shortcode_atts(array(
    'el_class' => '',
    'title' => '',
    'flickr_id' => '95572727@N00',
    'count' => '6',
    'type' => 'user',
    'display' => 'latest',
    'css_animation' => '',
    'css_animation_speed' => 'default',
    'css_animation_delay' => '0'
), $atts));

$el_class = $this->getExtraClass( $el_class );

$html = '<section class="rbFlickr' . ($el_class != '' ? ' ' . $el_class : '') . '"><ul class="clearfix">';
$html .= krown_parse_flickr_feed($flickr_id, $count);

$html .= '</ul></section>';

echo $html;