<?php

$output = $width = $el_class = $title = $twitter_name = $tweet_count = $el_position = $tweets_count = '';

extract( shortcode_atts( array(
    'el_class' 		 => '',
    'twitter_name'   => 'rubenbristian',
    'no' 			 => '1',
    'name' 		 	 => 'Ruben Bristian',
    'avatar' 		 => '',
    'text_reply' 	 => 'Reply',
    'text_retweet' 	 => 'Retweet',
    'text_favorite'  => 'Favorite',
    'rotate' 		 => 'enabled',
    'css_animation' => '',
    'css_animation_speed' => 'default',
    'css_animation_delay' => '0'
), $atts ) );

$output = '';

if ( function_exists( 'getTweets' ) ) {

	$tweets = getTweets( $twitter_name, $no );

    if ( ! empty ( $tweets['error'] ) ) {

		$output = '<p>Error (go to Settings > Twitter Feed Auth to resolve this): <span style="color:red; ">' . $tweets['error'] . '</span></p>';

    } else {

	$img = wp_get_attachment_image_src( $avatar, 'full' );

		$output = '<section class="rbTwitter clearfix rot' . $rotate . ( $el_class != '' ? ' ' . $el_class : '' ) . ( $css_animation != '' ? ' animate ' . $css_animation_speed . '" data-anim-type="' . $css_animation . '" data-anim-delay="' . $css_animation_delay . '"' : '"') . '>
		<a href="https://twitter.com/' . $twitter_name . '"><img src="' . aq_resize( $img[0], '100', '100', true ) . '" alt="' . $name . '" /></a>
		<a href="https://twitter.com/' . $twitter_name . '"><h5>' . $name . '</h5></a>
		<a href="https://twitter.com/' . $twitter_name . '"><span>@' . $twitter_name . '</span></a>
		  <iframe src="//platform.twitter.com/widgets/follow_button.html?show_screen_name=false&lang=en&show_count=false&screen_name=' . $twitter_name . '" style="width:100px; height:24px;"></iframe>
		<ul>';

    	foreach ( $tweets as $tweet ) {

    		$output .= '<li>
    			<p class="body">' . krown_parse_tweet( $tweet['text'] ) . '</p>
    			<a class="time" href="https://twitter.com/' . $twitter_name . '/status/' . $tweet['id_str'] . '">' . date( 'j F o \a\t g:i A', strtotime( $tweet['created_at'] ) ) . '</a>
    			<div class="intents">
    				<a class="popup reply" data-name="' . $text_reply . '" data-width="400" data-height="200" href="https://twitter.com/intent/tweet?in_reply_to=' . $tweet['id_str'] . '">' . $text_reply . '</a>
    				<a class="popup retweet" data-name="' . $text_retweet . '" data-width="400" data-height="200" href="https://twitter.com/intent/retweet?tweet_id=' . $tweet['id_str'] . '">' . $text_retweet . '</a>
    				<a class="popup favorite" data-name="' . $text_favorite . '" data-width="400" data-height="200" href="https://twitter.com/intent/favorite?tweet_id=' . $tweet['id_str'] . '">' . $text_favorite . '</a>
    			</div>
    		</li>';

    	}

    }

} else {

	$output = '<p style="font-weight:bold;">Please install the <a href="http://wordpress.org/plugins/oauth-twitter-feed-for-developers/">oAuth Twitter Feed Plugin</a> and configure it properly for the twitter widget to run. Read more about this in the manual.</p>';

}

$output .= '</ul></section>';

echo $output;