<?php
$output = $size = $icon = $target = $href = $el_class = $title = $position = '';
extract(shortcode_atts(array(
    'size' => 'medium',
    'target' => '_self',
    'url' => '',
    'el_class' => '',
    'style' => 'light',
    'label' => __('Text on the button', "krown"),
    'position' => '',
    'css_animation' => '',
    'css_animation_speed' => 'default',
    'css_animation_delay' => '0'
), $atts));

$el_class = $this->getExtraClass($el_class);

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, 'krown-button '.$style.' '.$size.$el_class.$position, $this->settings['base']);


    $html = '<a class="rbButton ' . $style . ' ' . $size . ($el_class != '' ? ' ' . $el_class : '') . '" href="' . $url . '" target="' . $target . '">' . $label . '</a>';

    echo $html;