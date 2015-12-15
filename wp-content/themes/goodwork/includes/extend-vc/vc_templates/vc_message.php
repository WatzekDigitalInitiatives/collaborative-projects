<?php
$output = $color = $el_class = $css_animation = '';
extract(shortcode_atts(array(
    'color' => 'alert-info',
    'el_class' => '',
    'css_animation' => '',
    'css_animation_speed' => 'default',
    'css_animation_delay' => '0'
), $atts));
$el_class = $this->getExtraClass($el_class);

    $html = '<div class="rbAlert ' . $color . ($el_class != '' ? ' ' . $el_class : '') . ' autop"><p>';
    $html .= do_shortcode($content);
    $html .= '</p><i>' . $color . '</i>';

    $html .= '</div>';

echo $html;
