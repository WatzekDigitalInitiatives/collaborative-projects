<?php
$output = $title = $interval = $el_class = '';
extract(shortcode_atts(array(
    'title' => '',
    'interval' => 0,
    'nav_bullets' => 'none',
    'nav_arrows' => 'none',
    'style' => 'light',
    'el_class' => '',
    'css_animation' => '',
    'css_animation_speed' => 'default',
    'css_animation_delay' => '0'
), $atts));

$el_class = $this->getExtraClass($el_class);

$element = 'rbTabs';

// Extract tab titles
preg_match_all( '/vc_tab title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $content, $matches, PREG_OFFSET_CAPTURE );

if ( empty( $matches ) || sizeof( $matches ) == 0 ) {
	_e( "This shortcode isn't properly configured. Please review it.", "krown" );
	return;
}


if ( isset($matches[0]) ) { $tab_titles = $matches[0]; }
$tabs_nav = '<ul class="titles clearfix' . ( $css_animation != '' ? ' animate ' . $css_animation_speed . '" data-anim-type="' . $css_animation . '" data-anim-delay="' . $css_animation_delay . '"' : '"') . '>';
foreach ( $tab_titles as $tab ) {
    preg_match('/title="([^\"]+)"(\stab_id\=\"([^\"]+)\"){0,1}/i', $tab[0], $tab_matches, PREG_OFFSET_CAPTURE );
    if(isset($tab_matches[1][0])) {
        $tabs_nav .= '<li><a href="#tab-'. (isset($tab_matches[3][0]) ? $tab_matches[3][0] : sanitize_title( $tab_matches[1][0] ) ) .'" class="noa">' . $tab_matches[1][0] . '</a></li>';

    }
}
$tabs_nav .= '</ul>'."\n";

$css_class = apply_filters(VC_SHORTCODE_CUSTOM_CSS_FILTER_TAG, trim($element.' ' .$size.$el_class), $this->settings['base']);

$output .= "\n\t".'<div class="'.$css_class.'">';
$output .= "\n\t\t\t".$tabs_nav;
$output .= "\n\t\t\t".'<div class="contents clearfix">'.wpb_js_remove_wpautop($content).'</div>';
$output .= "\n\t".'</div> '.$this->endBlockComment($element);

echo $output;