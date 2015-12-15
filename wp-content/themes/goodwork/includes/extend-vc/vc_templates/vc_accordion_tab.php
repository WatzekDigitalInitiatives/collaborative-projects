<?php
$output = $title = '';

extract(shortcode_atts(array(
	'title' => __("Section", "krown")
), $atts));

    $output = '<section>
    	<h4>' . $title . '</h4>
    	<div>' . wpb_js_remove_wpautop($content). '</div>
    </section>';

echo $output;