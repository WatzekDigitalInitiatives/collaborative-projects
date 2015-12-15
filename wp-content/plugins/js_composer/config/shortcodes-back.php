<?php

/* ------------------------
-----   Remove Unwanted Widgets    -----
------------------------------*/

wpb_remove("vc_twitter");
wpb_remove("vc_separator");
wpb_remove("vc_text_separator");
wpb_remove("vc_message");
wpb_remove("vc_toggle");
wpb_remove("vc_teaser_grid");
wpb_remove("vc_posts_slider");
wpb_remove("vc_button");
wpb_remove("vc_cta_button");
wpb_remove("vc_video");
wpb_remove("vc_flickr");
wpb_remove("vc_accordion");
wpb_remove("vc_googleplus");
wpb_remove("vc_pinterest");
wpb_remove("vc_tweetmeme");
wpb_remove("vc_facebook");
wpb_remove("vc_gmaps");
wpb_remove("vc_gallery");
wpb_remove("vc_single_image");
wpb_remove("vc_facebook");
wpb_remove("vc_tabs");
wpb_remove("vc_column_text");
wpb_remove("vc_raw_html");
wpb_remove("vc_raw_js");
wpb_remove("vc_widget_sidebar");

/* ------------------------
-----   Icons Parameter    -----
------------------------------*/

function icon_param_settings($settings, $value) {

    $iconsArray = array(
        __('None', 'goodwork') => 'con-none',
        __('Ajust', 'goodwork') => 'con-ajust',
        __('Asterisk', 'goodwork') => 'con-asterisk',
        __('Award', 'goodwork') => 'con-award',
        __('Bag', 'goodwork') => 'con-bag',
        __('Basket', 'goodwork') => 'con-basket',
        __('Battery', 'goodwork') => 'con-battery',
        __('Beaker', 'goodwork') => 'con-beaker',
        __('Beer', 'goodwork') => 'con-beer',
        __('Behance', 'goodwork') => 'con-behance',
        __('Bell', 'goodwork') => 'con-bell',
        __('Bell-alt', 'goodwork') => 'con-bell-alt',
        __('Block', 'goodwork') => 'con-block',
        __('Book #2', 'goodwork') => 'con-book-1',
        __('Book', 'goodwork') => 'con-book',
        __('Book-open', 'goodwork') => 'con-book-open',
        __('Briefcase', 'goodwork') => 'con-briefcase',
        __('Brush', 'goodwork') => 'con-brush',
        __('Bucket', 'goodwork') => 'con-bucket',
        __('Calendar #2', 'goodwork') => 'con-calendar-1',
        __('Calendar', 'goodwork') => 'con-calendar',
        __('Camera', 'goodwork') => 'con-camera',
        __('Cancel', 'goodwork') => 'con-cancel',
        __('Ccw', 'goodwork') => 'con-ccw',
        __('Certificate', 'goodwork') => 'con-certificate',
        __('Chart', 'goodwork') => 'con-chart',
        __('Chart-area', 'goodwork') => 'con-chart-area',
        __('Chart-bar', 'goodwork') => 'con-chart-bar',
        __('Chart-pie #2', 'goodwork') => 'con-chart-pie-1',
        __('Chat', 'goodwork') => 'con-chat',
        __('Clipboard', 'goodwork') => 'con-clipboard',
        __('Clock #2', 'goodwork') => 'con-clock-1',
        __('Clock', 'goodwork') => 'con-clock',
        __('Cloud', 'goodwork') => 'con-cloud',
        __('Cog', 'goodwork') => 'con-cog',
        __('Comment #2', 'goodwork') => 'con-comment-1',
        __('Comment', 'goodwork') => 'con-comment',
        __('Compass', 'goodwork') => 'con-compass',
        __('Cw', 'goodwork') => 'con-cw',
        __('Delicious', 'goodwork') => 'con-delicious',
        __('Desktop', 'goodwork') => 'con-desktop',
        __('Digg #2', 'goodwork') => 'con-digg-1',
        __('Digg', 'goodwork') => 'con-digg',
        __('Down-circle2', 'goodwork') => 'con-down-circle2',
        __('Download', 'goodwork') => 'con-download',
        __('Download-cloud', 'goodwork') => 'con-download-cloud',
        __('Dribbble', 'goodwork') => 'con-dribbble',
        __('Evernote', 'goodwork') => 'con-evernote',
        __('Eye', 'goodwork') => 'con-eye',
        __('Eye #2', 'goodwork') => 'con-eye-1',
        __('Facebook-squared', 'goodwork') => 'con-facebook-squared',
        __('Feather', 'goodwork') => 'con-feather',
        __('Filter', 'goodwork') => 'con-filter',
        __('Fire', 'goodwork') => 'con-fire',
        __('Fire-station', 'goodwork') => 'con-fire-station',
        __('Flag', 'goodwork') => 'con-flag',
        __('Flash #2', 'goodwork') => 'con-flash-1',
        __('Flashlight', 'goodwork') => 'con-flashlight',
        __('Flickr', 'goodwork') => 'con-flickr',
        __('Flight', 'goodwork') => 'con-flight',
        __('Forward', 'goodwork') => 'con-forward',
        __('Gauge', 'goodwork') => 'con-gauge',
        __('Gift', 'goodwork') => 'con-gift',
        __('Github', 'goodwork') => 'con-github',
        __('Globe #2', 'goodwork') => 'con-globe-1',
        __('Globe', 'goodwork') => 'con-globe',
        __('Google-circles', 'goodwork') => 'con-google-circles',
        __('Gplus', 'goodwork') => 'con-gplus',
        __('Graduation-cap', 'goodwork') => 'con-graduation-cap',
        __('Grocery-store', 'goodwork') => 'con-grocery-store',
        __('Hammer', 'goodwork') => 'con-hammer',
        __('Harbor', 'goodwork') => 'con-harbor',
        __('Headphones', 'goodwork') => 'con-headphones',
        __('Heart #2', 'goodwork') => 'con-heart-1',
        __('Heliport', 'goodwork') => 'con-heliport',
        __('Help', 'goodwork') => 'con-help',
        __('Home', 'goodwork') => 'con-home',
        __('Hourglass', 'goodwork') => 'con-hourglass',
        __('Inbox', 'goodwork') => 'con-inbox',
        __('Key', 'goodwork') => 'con-key',
        __('Lamp', 'goodwork') => 'con-lamp',
        __('Laptop', 'goodwork') => 'con-laptop',
        __('Lastfm', 'goodwork') => 'con-lastfm',
        __('Leaf', 'goodwork') => 'con-leaf',
        __('Left-open #2', 'goodwork') => 'con-left-open-1',
        __('Left-open', 'goodwork') => 'con-left-open',
        __('Lightbulb', 'goodwork') => 'con-lightbulb',
        __('Link #2', 'goodwork') => 'con-link-1',
        __('Link', 'goodwork') => 'con-link',
        __('Linkedin', 'goodwork') => 'con-linkedin',
        __('Location', 'goodwork') => 'con-location',
        __('Login', 'goodwork') => 'con-login',
        __('Logout', 'goodwork') => 'con-logout',
        __('Magic', 'goodwork') => 'con-magic',
        __('Magnet #2', 'goodwork') => 'con-magnet-1',
        __('Mail', 'goodwork') => 'con-mail',
        __('Megaphone', 'goodwork') => 'con-megaphone',
        __('Mic', 'goodwork') => 'con-mic',
        __('Minus #2', 'goodwork') => 'con-minus-1',
        __('Minus', 'goodwork') => 'con-minus',
        __('Mobile', 'goodwork') => 'con-mobile',
        __('Mobile #2', 'goodwork') => 'con-mobile-1',
        __('Moon', 'goodwork') => 'con-moon',
        __('Move', 'goodwork') => 'con-move',
        __('Mute', 'goodwork') => 'con-mute',
        __('Network', 'goodwork') => 'con-network',
        __('Note-beamed', 'goodwork') => 'con-note-beamed',
        __('Off', 'goodwork') => 'con-off',
        __('Ok', 'goodwork') => 'con-ok',
        __('Palette', 'goodwork') => 'con-palette',
        __('Paper-plane', 'goodwork') => 'con-paper-plane',
        __('Pencil #2', 'goodwork') => 'con-pencil-1',
        __('Pencil #3', 'goodwork') => 'con-pencil-2',
        __('Pencil', 'goodwork') => 'con-pencil',
        __('Phone', 'goodwork') => 'con-phone',
        __('Picasa', 'goodwork') => 'con-picasa',
        __('Picture #2', 'goodwork') => 'con-picture-1',
        __('Picture', 'goodwork') => 'con-picture',
        __('Pinterest', 'goodwork') => 'con-pinterest',
        __('Play', 'goodwork') => 'con-play',
        __('Plus #2', 'goodwork') => 'con-plus-1',
        __('Plus', 'goodwork') => 'con-plus',
        __('Print', 'goodwork') => 'con-print',
        __('Quote', 'goodwork') => 'con-quote',
        __('Quote-left', 'goodwork') => 'con-quote-left',
        __('Quote-right', 'goodwork') => 'con-quote-right',
        __('Religious-jewish', 'goodwork') => 'con-religious-jewish',
        __('Reply', 'goodwork') => 'con-reply',
        __('Resize-full', 'goodwork') => 'con-resize-full',
        __('Resize-full-alt', 'goodwork') => 'con-resize-full-alt',
        __('Resize-horizontal', 'goodwork') => 'con-resize-horizontal',
        __('Resize-small', 'goodwork') => 'con-resize-small',
        __('Resize-vertical', 'goodwork') => 'con-resize-vertical',
        __('Right-open #2', 'goodwork') => 'con-right-open-1',
        __('Right-open', 'goodwork') => 'con-right-open',
        __('Road', 'goodwork') => 'con-road',
        __('Rocket', 'goodwork') => 'con-rocket',
        __('Rss', 'goodwork') => 'con-rss',
        __('School', 'goodwork') => 'con-school',
        __('Search', 'goodwork') => 'con-search',
        __('Share', 'goodwork') => 'con-share',
        __('Sitemap', 'goodwork') => 'con-sitemap',
        __('Skiing', 'goodwork') => 'con-skiing',
        __('Skype', 'goodwork') => 'con-skype',
        __('Sound', 'goodwork') => 'con-sound',
        __('Star', 'goodwork') => 'con-star',
        __('Stumbleupon', 'goodwork') => 'con-stumbleupon',
        __('Swimming', 'goodwork') => 'con-swimming',
        __('Tag', 'goodwork') => 'con-tag',
        __('Tags', 'goodwork') => 'con-tags',
        __('Tape', 'goodwork') => 'con-tape',
        __('Thermometer', 'goodwork') => 'con-thermometer',
        __('Thumbs-down', 'goodwork') => 'con-thumbs-down',
        __('Thumbs-up', 'goodwork') => 'con-thumbs-up',
        __('Tint', 'goodwork') => 'con-tint',
        __('Tools', 'goodwork') => 'con-tools',
        __('Trophy', 'goodwork') => 'con-trophy',
        __('Truck', 'goodwork') => 'con-truck',
        __('Tumblr', 'goodwork') => 'con-tumblr',
        __('Twitter', 'goodwork') => 'con-twitter',
        __('Umbrella', 'goodwork') => 'con-umbrella',
        __('Up-circle2', 'goodwork') => 'con-up-circle2',
        __('Upload', 'goodwork') => 'con-upload',
        __('Upload-cloud', 'goodwork') => 'con-upload-cloud',
        __('User #2', 'goodwork') => 'con-user-1',
        __('User', 'goodwork') => 'con-user',
        __('Users #2', 'goodwork') => 'con-users-1',
        __('Users', 'goodwork') => 'con-users',
        __('Vector-pencil', 'goodwork') => 'con-vector-pencil',
        __('Video', 'goodwork') => 'con-video',
        __('Vimeo', 'goodwork') => 'con-vimeo',
        __('Volume', 'goodwork') => 'con-volume',
        __('Volume-up', 'goodwork') => 'con-volume-up',
        __('Wrench', 'goodwork') => 'con-wrench',
        __('Youtube', 'goodwork') => 'con-youtube',
    );

    $dependency = vc_generate_dependencies_attributes($settings);
    $param = '<div class="icon_param_block clearfix row_fluid">';

    foreach($iconsArray as $val){
        $param .= '<div class="icon_tt"><label for="' . $settings['param_name'] . $val . '" class="'. $val . '"></label>';
        $param .= '<input id="' . $settings['param_name'] . $val . '" type="radio" name="' . $settings ['param_name'] . '" value="' . $val . '" /></div>';
    }

    $param .= '<input name="'.$settings['param_name']
             .'" style="display:none !important;" class="hidden wpb_vc_param_value wpb-textinput '
             .$settings['param_name'].' '.$settings['type'].'_field" type="text" value="'
             .$value.'" ' . $dependency . '/></div>';
    return $param;

}
add_shortcode_param('icon_param', 'icon_param_settings');

/* ------------------------
-----   Accordion    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Accordion", "goodwork"),
    "base"      => "rb_accordion",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-accordion",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textarea_html",
            "heading" => __("Content", "goodwork"),
            "holder" => "div",
            "param_name" => "content",
            "value" => '[ac_section title="Section 1"] 
            This is the content of the first section 
            [/ac_section]

            [ac_section title="Section 2"] 
            This is the content of the second section 
            [/ac_section]',
            "description" => __("This is the area of the accordion. Please use section shortcodes for the different areas of the accordion.", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Size", "js_composer"),
            "param_name" => "size",
            "value" => array("Small" => 'small', "Large" => 'large'),
            "description" => __("Small accordions should be used in areas smaller than 1/2, while large accordions should only be used in areas larger than 3/4.", "js_composer")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "js_composer"),
            "param_name" => "style",
            "value" => array("Style #1" => 'one', "Style #2" => 'two')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Type", "js_composer"),
            "param_name" => "type",
            "value" => array("Accordion" => 'accordion', "Toggle" => 'toggle'),
            "description" => __("Inside accordions only one section can be visible at a time. With toggles the user can open all the sections at once.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Opened", "js_composer"),
            "param_name" => "opened",
            "value" => "0",
            "description" => __("Choose the section which you want to be opened(first section is'0'). If you want the accordion/toggle to be closed, choose '-1'.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "goodwork")
        )
    )
) );

/* ------------------------
-----   Alert Messages    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Alert Message", "goodwork"),
    "base"      => "rb_alert",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-alert",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => __("Type", "goodwork"),
            "param_name" => "type",
            "value" => array('Error' => "error", 'Success' => "success", 'Info' => "info", 'Notice' => "notice"),
            "description" => __("Choose the type of the message", "goodwork")
        ),
        array(
            "type" => "textarea_html",
            "heading" => __("Content", "goodwork"),
            "holder" => "div",
            "param_name" => "content",
            "value" => "",
            "description" => __("", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "goodwork")
        )
    )
) );

/* ------------------------
-----   Blank Divider    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Blank Divider", "goodwork"),
    "base"      => "rb_blank_divider",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-blank",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => __("Height", "goodwork"),
            "param_name" => "height",
            "value" => "",
            "description" => __("Choose the height of the divider.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "goodwork")
        )
    )
) );

/* ------------------------
-----   Buttons    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Buttons", "goodwork"),
    "base"      => "rb_button",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-button",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => __("Size", "goodwork"),
            "param_name" => "size",
            "value" => array('Small' => "small", 'Medium' => "medium", 'Large' => "large"),
            "description" => __("Choose the size of the button", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "goodwork"),
            "param_name" => "style",
            "value" => array('Light' => "light", 'Dark' => "dark"),
            "description" => __("The dark button will be gray in the normal state and have the main theme color on roll over, while the light button will be the exact oposite", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("URL", "goodwork"),
            "param_name" => "url",
            "value" => "",
            "description" => __("", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Label", "goodwork"),
            "param_name" => "label",
            "value" => "",
            "description" => __("", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Target", "goodwork"),
            "param_name" => "target",
            "value" => array('_blank' => "_blank", '_self' => "_self", '_parent' => "_parent", '_top' => "_top"),
            "description" => __("", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "goodwork")
        )
    )
) );


/* ------------------------
-----   Contact Info   -----
------------------------------*/

wpb_map( array(
    "name"      => __("Contact Info", "goodwork"),
    "base"      => "rb_cinfo",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-contacti",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => __("Address", "js_composer"),
            "param_name" => "address",
            "value" => "",
            "description" => __("", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Phone", "js_composer"),
            "param_name" => "phone",
            "value" => "",
            "description" => __("", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Mail", "js_composer"),
            "param_name" => "mail",
            "value" => "",
            "description" => __("", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Map Label", "js_composer"),
            "param_name" => "map_text",
            "value" => "",
            "description" => __("", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Map Link", "js_composer"),
            "param_name" => "map",
            "value" => "",
            "description" => __("", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.(you can use the 'lessMargin' class for example, to give a smaller bottom margin to this text block", "js_composer")
        )
    )
) );

/* ------------------------
-----   Contact Form   -----
------------------------------*/

wpb_map( array(
    "name"      => __("Contact Form", "goodwork"),
    "base"      => "rb_form",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-contactf",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => __("Type", "goodwork"),
            "param_name" => "type",
            "value" => array(__('Full', "goodwork") => "edit_popup_delete", __('Minimal', "goodwork") => "minimal"),
            "description" => __("Choose the contact form type(the minimal one is good for tight spaces, like a 1/4 column, while the full one needs a larger space, like at least a 3/4 column", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Name field label", "js_composer"),
            "param_name" => "label_name",
            "value" => "",
            "description" => __("", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Email field label", "js_composer"),
            "param_name" => "label_email",
            "value" => "",
            "description" => __("", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Subject field label", "js_composer"),
            "param_name" => "label_subject",
            "value" => "",
            "description" => __("This field type will not appear in the minimal widget. You should at least provide a subject, because it will be the default subject you'll see in your inbox whenever someone writes an email using this contact form", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Message field label", "js_composer"),
            "param_name" => "label_message",
            "value" => "",
            "description" => __("", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Send button label", "js_composer"),
            "param_name" => "label_send",
            "value" => "",
            "description" => __("", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Recipent email", "js_composer"),
            "param_name" => "email",
            "value" => "",
            "description" => __("Write the email address where you want to receive all of the emails sent through this form", "js_composer")
        ),
        array(
            "type" => "textarea",
            "heading" => __("Error message", "js_composer"),
            "param_name" => "error",
            "value" => "",
            "description" => __("This message will appear to the user whenever he tries to send the email with no info or with corrupted email addresses", "js_composer")
        ),
        array(
            "type" => "textarea",
            "heading" => __("Success message", "js_composer"),
            "param_name" => "success",
            "value" => "",
            "description" => __("This message will appear to the user after the email has been sent", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.(you can use the 'lessMargin' class for example, to give a smaller bottom margin to this text block", "js_composer")
        )
    )
) );

/* ------------------------
-----   Divider    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Divider", "goodwork"),
    "base"      => "rb_divider",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-divider",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => __("Margin Top", "goodwork"),
            "param_name" => "top",
            "value" => "20",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Margin Bottom", "goodwork"),
            "param_name" => "bottom",
            "value" => "20",
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "goodwork")
        )
    )
) );

/* ------------------------
-----   Flickr Feed   -----
------------------------------*/

wpb_map( array(
    "name"      => __("Flickr Feed", "goodwork"),
    "base"      => "rb_flickr",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-flickr",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => __("ID", "goodwork"),
            "param_name" => "id",
            "value" => "",
            "description" => __("Enter your flickr id, which you can get using <a href='http://idgettr.com/'>idgetter.com</a>", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Items", "goodwork"),
            "param_name" => "no",
            "value" => "",
            "description" => __("Choose a number of items to display(between 1-20)", "goodwork")
        )
    )
) );

/* ------------------------
-----   Latest Projects    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Latest Projects", "goodwork"),
    "base"      => "rb_projects",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-projects",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => __("Categories", "goodwork"),
            "param_name" => "type",
            "value" => "",
            "description" => __("If you want to show only certain portfolio categories, not the entire portfolio, please write the categories in this field, separated by commas. Please use the <strong>category slug</strong>, not the title.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Number", "goodwork"),
            "param_name" => "no",
            "value" => __("8", "goodwork"),
            "description" => __("The number of portfolio items to show")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Columns", "goodwork"),
            "param_name" => "cols",
            "value" => array("Four columns" => "four", "Three columns" => "three", "Two columns" => "two")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "goodwork"),
            "param_name" => "style",
            "value" => array("Style #1" => "one", "Style #2" => "two")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("All", "goodwork"),
            "param_name" => "all",
            "value" => array(__('Show', "goodwork") => "true", __('Hide', "goodwork") => "false"),
            "description" => __("Display a link to the main portfolio page", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("All URL", "goodwork"),
            "param_name" => "all_url",
            "value" => "",
            "description" => __("If you don't want to display a link to the portfolio page setup in the theme options (in case you have more than one portfolio or you want a custom url), just write the link here.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("All Text", "goodwork"),
            "param_name" => "all_text",
            "value" => "View all portfolio &rarr;",
            "description" => __("This is the text that will appear for the portfolio url set above.", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Ajax", "goodwork"),
            "param_name" => "ajax",
            "value" => array("Disabled" => "false", "Enabled" => "true")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "goodwork")
        )
    )
) );

/* ------------------------
-----   Latest Posts   -----
------------------------------*/

wpb_map( array(
    "name"      => __("Latest Posts", "goodwork"),
    "base"      => "rb_posts",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-posts",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => __("About this shortcode", "goodwork"),
            "param_name" => "noval",
            "value" => "noval",
            "description" => __("This is a pretty complex shortcode, since it allows a lot of combinations and possibilities for displaying the blog posts, that's why each parameter will function different, depending on the type of blog posts. Please read the descriptions carefully and play with the shortcode until you find the best result for you!", 'goodwork')
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Type", "goodwork"),
            "param_name" => "type",
            "value" => array(__('Modern', "goodwork") => "modern", __('Classic', "goodwork") => "classic"),
            "description" => __("Choose between the two available blog styles(types)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Number of posts displayed", "goodwork"),
            "param_name" => "no",
            "value" => "4", "goodwork",
            "description" => "The number of posts to show on the page.<br /><br /><ul><li><strong>Classic Blog</strong>: Please write the number of columns that you have. If you are using this shortcode into a 3/4 column, write 3. If you are using it into a full width column, write 4.</li><li><strong>Modern Blog without AJAX</strong>: You can write any number here and you'll have as many posts as you want.</li><li><strong>Modern Blog with AJAX</strong>: It doesn't matter, because in this shortcode type, the number of posts shown is the one set in the Theme Options.</li></ul>"
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Number of total posts", "goodwork"),
            "param_name" => "no2",
            "value" => array(__('Double', "goodwork") => "2", __('Triple', "goodwork") => "3"),
            "description" => "This value is valid only for the <strong>Classic Blog with navigation</strong>. You can choose how many posts to appear when the user cycles through posts. This value is dependent on the number of posts displayed."
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Navigation", "goodwork"),
            "param_name" => "more",
            "value" => array(__('Show', "goodwork") => "true", __('Hide', "goodwork") => "false"),
            "description" => __("Display two navigation buttons, to cycle through more than the set number of posts. It can be activated only for the <strong>Classic Blog</strong>.", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("AJAX", "goodwork"),
            "param_name" => "ajax",
            "value" => array(__('Disabled', "goodwork") => "false", __('Enabled', "goodwork") => "true"),
            "description" => __("This can only be possible with the <strong>Modern Blog</strong>. It will function exactly like the modern blog page template, with all posts visible, a filter and AJAX loading of all posts in the same page.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Categories", "goodwork"),
            "param_name" => "categories",
            "value" => "",
            "description" => __("If you want to show only certain posts categories, not the entire blog, please write the categories in this field, separated by commas. Please use the <strong>category slug</strong>, not the title.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("'Read More' Text", "goodwork"),
            "param_name" => "text_read",
            "value" => "Read More",
            "description" => __("This is the text that will appear for the 'read more' button in classic blog shortcode.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("'Load More' Text", "goodwork"),
            "param_name" => "text_more",
            "value" => "Load More Posts",
            "description" => __("This is the text that will appear at the bottom of the modern blog shortcode, in the button for showing more posts.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("'No More' Text", "goodwork"),
            "param_name" => "text_nomore",
            "value" => "No More Posts",
            "description" => __("This is the text that will appear at the bottom of the modern blog shortcode, in the button for showing more posts.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("'Showing' Text", "goodwork"),
            "param_name" => "text_showing",
            "value" => "Showing",
            "description" => __("This is the text that will appear at the top of the modern blog shortcode, for filtering the posts.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "goodwork")
        )
    )
) );


/* ------------------------
-----   Lightbox   -----
------------------------------*/

wpb_map( array(
    "name"      => __("Lightbox", "goodwork"),
    "base"      => "rb_lightbox",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-lightbox",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "attach_image",
            "heading" => __("Thumbnail", "goodwork"),
            "param_name" => "thumb",
            "value" => "",
            "description" => __("Choose a small thumbnail for the lightbox display.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Thumbnail width", "goodwork"),
            "param_name" => "twidth",
            "value" => "",
            "description" => __("Choose a width for your thumbnail(it will be automatically cropped and resized - don't forget to upload a double sized thumbnail for retina displays - defauls to 200.", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Thumbnail alignment", "goodwork"),
            "param_name" => "align",
            "value" => array(__('Left', "goodwork") => "left", __('Right', "goodwork") => "right"),
            "description" => "Choose the alignment of your thumbnail(best when used inside a text block)."
        ),
        array(
            "type" => "textfield",
            "heading" => __("Lightbox content", "goodwork"),
            "param_name" => "large",
            "value" => "",
            "description" => __("The content of the lightbox can either be another image(large one) or any kind of HTML content(you can embed iframes from your own pages, google maps or all kinds of videos which have an embeding code, by pointing to the <strong>iframe src property(the actual url of the iframe)</strong>.", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Lightbox type", "goodwork"),
            "param_name" => "type",
            "value" => array(__('Image', "goodwork") => "img", __('Iframe', "goodwork") => "iframe"),
            "description" => "If you want to display iframes as the lightbox content, please choose the type here."
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", "goodwork"),
            "param_name" => "title",
            "value" => "",
            "description" => "If you want a title to appear in the lightbox(below the content), write it here. You can also leave this blank."
        ),
        array(
            "type" => "textfield",
            "heading" => __("Group id", "goodwork"),
            "param_name" => "group",
            "value" => "",
            "description" => "If you want this thumbnail to be in a gallery(rotate through the lightbox content), write a unique identifier for this group(needs to be the same). If you want to create a gallery only with images, please use <strong>the WordPress Gallery instead</strong>."
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "goodwork")
        )
    )
) );

/* ------------------------
-----   Posts   -----
------------------------------*/

wpb_map( array(
    "name"      => __("Posts Widget", "goodwork"),
    "base"      => "rb_custom_posts",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-posts2",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => __("Type", "goodwork"),
            "param_name" => "type",
            "value" => array(__('Popular', "goodwork") => "popular", __('Commented', "goodwork") => "commented", __('Latest', "goodwork") => "latest", __('Random', "goodwork") => "random"),
            "description" => __("Choose what posts to show. The popular posts are based on the number of views. The random posts show random posts of all time.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Items", "goodwork"),
            "param_name" => "no",
            "value" => __("3", "goodwork"),
            "description" => __("The number of posts to show")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "goodwork")
        )
    )
) );

/* ------------------------
-----   Promo Box    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Promo Box", "goodwork"),
    "base"      => "rb_box",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-promo",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textarea_html",
            "heading" => __("Content", "goodwork"),
            "holder" => 'div',
            "param_name" => "content",
            "value" => __("", "goodwork"),
            "description" => __("", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "goodwork"),
            "param_name" => "style",
            "value" => array(__('Dark', "goodwork") => "dark", __('Light', "goodwork") => "light"),
            "description" => __("Choose the style of the promo box", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "goodwork")
        )
    )
) );

/* ------------------------
-----   Promo Line    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Promo Line", "goodwork"),
    "base"      => "rb_line",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-promo2",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "icon_param",
            "heading" => __("Icon", "goodwork"),
            "param_name" => "icon",
            "value" => "con-none",
            "description" => __("The icon of the promo line, it will appear in the left of the title", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", "goodwork"),
            "holder" => 'h3',
            "param_name" => "title",
            "value" => "",
            "description" => __("The title of the line(H2 element)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Subtitle", "goodwork"),
            "param_name" => "subtitle",
            "value" => "",
            "description" => __("The subtitle of the line(H5 element)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Link URL", "goodwork"),
            "param_name" => "link_url",
            "value" => "",
            "description" => __("If you fill up this field with an url, a call to action button will appear in the right side of the line", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Link Label", "goodwork"),
            "param_name" => "link_label",
            "value" => "",
            "description" => __("The label for the call to action button", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Link Target", "goodwork"),
            "param_name" => "link_target",
            "value" => array('_blank' => "_blank", '_self' => "_self", '_parent' => "_parent", '_top' => "_top"),
            "description" => __("The target of the button", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "goodwork")
        )
    )
) );

/* ------------------------
-----   RAW Code    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Raw html", "js_composer"),
    "base"      => "vc_raw_html",
    "class"     => "div",
    "icon"      => "icon-wpb-raw-html",
    "category"  => __('Structure', 'js_composer'),
    "wrapper_class" => "clearfix",
    "controls"  => "edit_popup_delete",
    "params"    => array(
        array(
            "type" => "textarea_raw_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Raw HTML", "js_composer"),
            "param_name" => "content",
            "value" => base64_encode("<p>I am raw html block.<br/>Click edit button to change this html</p>"),
            "description" => __("Enter your HTML content.", "js_composer")
        ),
    )
) );

wpb_map( array(
    "name"      => __("Raw js", "js_composer"),
    "base"      => "vc_raw_js",
    "class"     => "div",
    "icon"      => "icon-wpb-raw-javascript",
    "category"  => __('Structure', 'js_composer'),
    "wrapper_class" => "clearfix",
    "controls"  => "edit_popup_delete",
    "params"    => array(
        array(
            "type" => "textarea_raw_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Raw js", "js_composer"),
            "param_name" => "content",
            "value" => __(base64_encode("<script type='text/javascript'> alert('Enter your js here!'); </script>"), "js_composer"),
            "description" => __("Enter your Js.", "js_composer")
        ),
    )
) );

/* ------------------------
-----   Section Title    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Section Title", "goodwork"),
    "base"      => "rb_section_title",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-title",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "goodwork"),
            "param_name" => "title",
            "holder" => "h3",
            "value" => __("Title", "goodwork")
        ),
        array(
            "type" => "icon_param",
            "heading" => __("Icon", "goodwork"),
            "param_name" => "icon",
            "value" => "con-none",
            "description" => __("The icon of the section(optional), it will appear in the left of the title", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Bottom double border", "goodwork"),
            "param_name" => "border",
            "value" => array(__('Show Border', "goodwork") => "true", __('Hide Border', "goodwork") => "false"),
            "description" => __("If selected, a thin border will appear below the header.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Bottom margin", "goodwork"),
            "param_name" => "margin",
            "value" => __("35", "goodwork"),
            "description" => __("The margin(in px) between the title and the section below it", "goodwork")
        )
    ),
    "js_callback" => array("init" => "rbCustomSectionTitleCallback")
) );


/* ------------------------
-----   Sharing Icons   -----
------------------------------*/

wpb_map( array(
    "name"      => __("Sharing Icons", "goodwork"),
    "base"      => "rb_sharing",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-sharing",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => __("Facebook link", "goodwork"),
            "param_name" => "facebook",
            "value" => array(__('Enabled', "goodwork") => "true", __('Disabled', "goodwork") => "false")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Twitter link", "goodwork"),
            "param_name" => "twitter",
            "value" => array(__('Enabled', "goodwork") => "true", __('Disabled', "goodwork") => "false")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Google link", "goodwork"),
            "param_name" => "google",
            "value" => array(__('Enabled', "goodwork") => "true", __('Disabled', "goodwork") => "false")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Pinterest link", "goodwork"),
            "param_name" => "pinterest",
            "description" => "<br /><br /><strong>Please add this shortcode only once in your page!</strong>",
            "value" => array(__('Enabled', "goodwork") => "true", __('Disabled', "goodwork") => "false")
        )
    )
) );

/* ------------------------
-----   Social Icons   -----
------------------------------*/

wpb_map( array(
    "name"      => __("Social Icons", "goodwork"),
    "base"      => "rb_social",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-social",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => __("Type", "goodwork"),
            "param_name" => "type",
            "value" => array(__('List', "goodwork") => "list", __('Thumbs', "goodwork") => "thumbnails", __('Small icons', "goodwork") => "icons"),
            "description" => __("Choose a type of social icons display. The list view shows all icons in a list, with some text near the icons, while the thumbs view shows only the icons, without any text. The small icons are best for header/footer displays.", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Target", "goodwork"),
            "param_name" => "target",
            "value" => array( '_self' => "_self", '_blank' => "_blank", '_parent' => "_parent", '_top' => "_top"),
            "description" => __("The target of the social icon.", "goodwork")
        ),

        array(
            "type" => "textfield",
            "heading" => __("Twitter URL", "goodwork"),
            "param_name" => "twitter",
            "value" => "",
            "description" => __("Enter your twitter profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Twitter Text", "goodwork"),
            "param_name" => "twitter_text",
            "value" => "",
            "description" => __("Enter your twitter profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Facebook URL", "goodwork"),
            "param_name" => "facebook",
            "value" => "",
            "description" => __("Enter your facebook profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Facebook Text", "goodwork"),
            "param_name" => "facebook_text",
            "value" => "",
            "description" => __("Enter your facebook profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Dribbble URL", "goodwork"),
            "param_name" => "dribbble",
            "value" => "",
            "description" => __("Enter your dribbble profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Dribbble Text", "goodwork"),
            "param_name" => "dribbble_text",
            "value" => "",
            "description" => __("Enter your dribbble profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Vimeo URL", "goodwork"),
            "param_name" => "vimeo",
            "value" => "",
            "description" => __("Enter your vimeo profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Vimeo Text", "goodwork"),
            "param_name" => "vimeo_text",
            "value" => "",
            "description" => __("Enter your vimeo profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("LinkedIn URL", "goodwork"),
            "param_name" => "linkedin",
            "value" => "",
            "description" => __("Enter your linkedin profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("LinkedIn Text", "goodwork"),
            "param_name" => "linkedin_text",
            "value" => "",
            "description" => __("Enter your linkedin profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Behance URL", "goodwork"),
            "param_name" => "behance",
            "value" => "",
            "description" => __("Enter your behance profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Behance Text", "goodwork"),
            "param_name" => "behance_text",
            "value" => "",
            "description" => __("Enter your behance profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Pinterest URL", "goodwork"),
            "param_name" => "pinterest",
            "value" => "",
            "description" => __("Enter your pinterest profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Pinterest Text", "goodwork"),
            "param_name" => "pinterest_text",
            "value" => "",
            "description" => __("Enter your pinterest profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Delicious URL", "goodwork"),
            "param_name" => "delicious",
            "value" => "",
            "description" => __("Enter your delicious profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Delicious Text", "goodwork"),
            "param_name" => "delicious_text",
            "value" => "",
            "description" => __("Enter your delicious profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Digg URL", "goodwork"),
            "param_name" => "digg",
            "value" => "",
            "description" => __("Enter your digg profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Digg Text", "goodwork"),
            "param_name" => "digg_text",
            "value" => "",
            "description" => __("Enter your digg profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("YouTube URL", "goodwork"),
            "param_name" => "youtube",
            "value" => "",
            "description" => __("Enter your youtube profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("YouTube Text", "goodwork"),
            "param_name" => "youtube_text",
            "value" => "",
            "description" => __("Enter your youtube profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Cloud URL", "goodwork"),
            "param_name" => "cloud",
            "value" => "",
            "description" => __("Enter your cloud profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Cloud Text", "goodwork"),
            "param_name" => "cloud_text",
            "value" => "",
            "description" => __("Enter your cloud profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("GitHub URL", "goodwork"),
            "param_name" => "github",
            "value" => "",
            "description" => __("Enter your github profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("GitHub Text", "goodwork"),
            "param_name" => "github_text",
            "value" => "",
            "description" => __("Enter your github profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Flickr URL", "goodwork"),
            "param_name" => "flickr",
            "value" => "",
            "description" => __("Enter your flickr profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Flickr Text", "goodwork"),
            "param_name" => "flickr_text",
            "value" => "",
            "description" => __("Enter your flickr profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Google Plus URL", "goodwork"),
            "param_name" => "googleplus",
            "value" => "",
            "description" => __("Enter your google plus profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Google Plus Text", "goodwork"),
            "param_name" => "googleplus_text",
            "value" => "",
            "description" => __("Enter your google plus profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Tumblr URL", "goodwork"),
            "param_name" => "tumblr",
            "value" => "",
            "description" => __("Enter your tumblr profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Tumblr Text", "goodwork"),
            "param_name" => "tumblr_text",
            "value" => "",
            "description" => __("Enter your tumblr profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Stumbleupon URL", "goodwork"),
            "param_name" => "stumbleupon",
            "value" => "",
            "description" => __("Enter your stumbleupon profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Stumbleupon Text", "goodwork"),
            "param_name" => "stumbleupon_text",
            "value" => "",
            "description" => __("Enter your stumbleupon profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("LastFm URL", "goodwork"),
            "param_name" => "lastfm",
            "value" => "",
            "description" => __("Enter your lastfm profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("LastFm Text", "goodwork"),
            "param_name" => "lastfm_text",
            "value" => "",
            "description" => __("Enter your lastfm profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Evernote URL", "goodwork"),
            "param_name" => "evernote",
            "value" => "",
            "description" => __("Enter your evernote profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Evernote Text", "goodwork"),
            "param_name" => "evernote_text",
            "value" => "",
            "description" => __("Enter your evernote profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Picasa URL", "goodwork"),
            "param_name" => "picasa",
            "value" => "",
            "description" => __("Enter your picasa profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Picasa Text", "goodwork"),
            "param_name" => "picasa_text",
            "value" => "",
            "description" => __("Enter your picasa profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Google Circles URL", "goodwork"),
            "param_name" => "googlecircles",
            "value" => "",
            "description" => __("Enter your google circles profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Google Circles Text", "goodwork"),
            "param_name" => "googlecircles_text",
            "value" => "",
            "description" => __("Enter your google circles profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Skype URL", "goodwork"),
            "param_name" => "skype",
            "value" => "",
            "description" => __("Enter your skype profile url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Skype Text", "goodwork"),
            "param_name" => "skype_text",
            "value" => "",
            "description" => __("Enter your skype profile text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Email Address", "goodwork"),
            "param_name" => "mail",
            "value" => "",
            "description" => __("Enter your email address(include mailto:)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Email Text", "goodwork"),
            "param_name" => "mail_text",
            "value" => "",
            "description" => __("Enter your email text(will appear only in the list type widget", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("RSS URL", "goodwork"),
            "param_name" => "rss",
            "value" => "",
            "description" => __("Enter your rss feed url", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("RSS Text", "goodwork"),
            "param_name" => "rss_text",
            "value" => "",
            "description" => __("Enter your rss feed text(will appear only in the list type widget", "goodwork")
        )
    )
) );

/* ------------------------
-----   Stats   -----
------------------------------*/

wpb_map( array(
    "name"      => __("Stats", "goodwork"),
    "base"      => "rb_stats",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-stats",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => __("Type", "goodwork"),
            "param_name" => "type",
            "value" => array(__('Pie', "goodwork") => "pie", __('Bars', "goodwork") => "bars"),
            "description" => __("The type of this stats widget(pie is a dynamic rotator, while bars has static content)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #1 Title", "goodwork"),
            "param_name" => "item1_title",
            "value" => "WordPress",
            "description" => __("The title of the first item", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #1 percent", "goodwork"),
            "param_name" => "item1_percent",
            "value" => "68",
            "description" => __("The percent of the first item(1-100)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #1 value", "goodwork"),
            "param_name" => "item1_value",
            "value" => "68",
            "description" => __("The value of the first item(any positive number)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #2 Title", "goodwork"),
            "param_name" => "item2_title",
            "value" => "",
            "description" => __("The title of the second item", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #2 percent", "goodwork"),
            "param_name" => "item2_percent",
            "value" => "",
            "description" => __("The percent of the second item(1-100)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #2 value", "goodwork"),
            "param_name" => "item2_value",
            "value" => "",
            "description" => __("The value of the second item(any positive number)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #3 Title", "goodwork"),
            "param_name" => "item3_title",
            "value" => "",
            "description" => __("The title of the third item", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #3 percent", "goodwork"),
            "param_name" => "item3_percent",
            "value" => "",
            "description" => __("The percent of the third item(1-100)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #3 value", "goodwork"),
            "param_name" => "item3_value",
            "value" => "",
            "description" => __("The value of the third item(any positive number)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #4 Title", "goodwork"),
            "param_name" => "item4_title",
            "value" => "",
            "description" => __("The title of the fourth item", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #4 percent", "goodwork"),
            "param_name" => "item4_percent",
            "value" => "",
            "description" => __("The percent of the fourth item(1-100)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #4 value", "goodwork"),
            "param_name" => "item4_value",
            "value" => "",
            "description" => __("The value of the fourth item(any positive number)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #5 Title", "goodwork"),
            "param_name" => "item5_title",
            "value" => "",
            "description" => __("The title of the fifth item", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #5 percent", "goodwork"),
            "param_name" => "item5_percent",
            "value" => "",
            "description" => __("The percent of the fifth item(1-100)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #5 value", "goodwork"),
            "param_name" => "item5_value",
            "value" => "",
            "description" => __("The value of the fifth item(any positive number)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #6 Title", "goodwork"),
            "param_name" => "item6_title",
            "value" => "",
            "description" => __("The title of the sixth item", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item #6 percent", "goodwork"),
            "param_name" => "item6_percent",
            "value" => "",
            "description" => __("The percent of the sixth item(1-100)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Item 6 value", "goodwork"),
            "param_name" => "item6_value",
            "value" => "",
            "description" => __("The value of the sixth item(any positive number)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file(you can use the 'lessMargin' class for example, to give a smaller bottom margin to this text block.", "js_composer")
        )
    )
) );


/* ------------------------
-----   Tabs    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Tabs", "goodwork"),
    "base"      => "rb_tabs",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-tabs",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textarea_html",
            "heading" => __("Content", "goodwork"),
            "holder" => "div",
            "param_name" => "content",
            "value" => '[tb_section title="Tab 1"] 
            This is the content of the first tab 
            [/tb_section]

            [tb_section title="Tab 2"] 
            This is the content of the second tab 
            [/tb_section]',
            "description" => __("This is the content area of the tabs. Please use tab shortcodes for the different tabs.", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "js_composer"),
            "param_name" => "style",
            "value" => array("Light" => 'light', "Dark" => 'dark')
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "goodwork")
        )
    )
) );

/* ------------------------
-----   Tagline    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Tagline", "goodwork"),
    "base"      => "rb_tagline",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-tagline",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => __("Title", "goodwork"),
            "param_name" => "title",
            "value" => __("Title", "goodwork"),
            "description" => __("The title of the tagline(will be wrapped in an H1 tag)", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Subtitle", "goodwork"),
            "param_name" => "subtitle",
            "value" => __("Subtitle", "goodwork"),
            "description" => __("The subtitle of the tagline(will be wrapped in an H2 tag)", "goodwork")
        ),
        array(
            "type" => "icon_param",
            "heading" => __("Icon", "goodwork"),
            "param_name" => "icon",
            "value" => "con-none",
            "description" => __("The icon of the tagline, will appear in the left side.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "goodwork")
        )
    )
) );


/* ------------------------
-----   Team Member    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Project Collaborator", "goodwork"),
    "base"      => "rb_team",
    "class"     => "",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-team",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => __("Name", "goodwork"),
            "param_name" => "name",
            "value" => "",
            "description" => __("The full name of the professor or student.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title (if faculty)", "goodwork"),
            "param_name" => "faculty_title",
            "value" => '',
            "description" => __("The faculty member's title (eg. Associate Professor of French)")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Year and Major (if a student)", "goodwork"),
            "param_name" => "student_yrmajor",
            "value" => '',
            "description" => __("The student's year and major, formatted like this for single major or double major: '14, French Studies or '14, French Studies / English")
        ),
        array(
            "type" => "attach_image",
            "heading" => __("Image", "goodwork"),
            "param_name" => "image",
            "value" => __("", "goodwork"),
            "description" => __("Add an image if desired. This should be a square image of 300x300(150 is the real size, but 300 will be used for retina).", "goodwork")
        ),
        array(
            "type" => "textarea_html",
            "heading" => __("Faculty: Bio and/or web site", "goodwork"),
            "param_name" => "content",
            "holder" => 'div',
            "value" => '',
            "description" => __("Optional: enter a brief bio or web site.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file(you can use the 'lessMargin' class for example, to give a smaller bottom margin to this text block.", "js_composer")
        )
    )
) );


/* ------------------------
-----   Testimonials    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Testimonials", "goodwork"),
    "base"      => "rb_testimonial",
    "class"     => "",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-testimonial",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => __("Client", "goodwork"),
            "param_name" => "client",
            "value" => "John Doe",
            "description" => __("The name of the person who gave the testimonial", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Position", "goodwork"),
            "param_name" => "position",
            "value" => '',
            "description" => __("The position or website of the person who gave the testimonial")
        ),
        array(
            "type" => "textarea_html",
            "heading" => __("Content", "goodwork"),
            "holder" => 'div',
            "param_name" => "content",
            "value" => __("", "goodwork"),
            "description" => __("", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "goodwork"),
            "param_name" => "style",
            "value" => array(__('Dark', "goodwork") => "dark", __('Light', "goodwork") => "light"),
            "description" => __("Choose the style of the testimonial box", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.(you can use the 'lessMargin' class for example, to give a smaller bottom margin to this text block", "js_composer")
        )
    )
) );

/* ------------------------
-----   Text Block    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Text block", "js_composer"),
    "base"      => "vc_column_text",
    "class"     => "",
    "icon"      => "icon-wpb-layer-shape-text",
    "wrapper_class" => "clearfix",
    "controls"  => "edit_popup_delete",
    "category"  => __('Content', 'js_composer'),
    "params"    => array(
        array(
            "type" => "textarea_html",
            "holder" => "div",
            "class" => "",
            "heading" => __("Text", "js_composer"),
            "param_name" => "content",
            "value" => __("<p>I am text block. Click edit button to change this text.</p>", "js_composer"),
            "description" => __("Enter your content.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
    )
) );

/* ------------------------
-----   Text Block with Icon    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Text Block with Icon", "goodwork"),
    "base"      => "rb_text_icon",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-textwic",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", "goodwork"),
            "param_name" => "style",
            "value" => array("Minimal" => "minimal","Large"=>"large"),
            "description" => __("Choose a style for the text block", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", "goodwork"),
            "param_name" => "title",
            "holder" => "h3",
            "value" => __("The title of the text block", "goodwork")
        ),
        array(
            "type" => "textarea_html",
            "heading" => __("Text", "goodwork"),
            "param_name" => "content",
            "holder" => "div",
            "description" => __("The content of the text block", "goodwork")
        ),
        array(
            "type" => "icon_param",
            "heading" => __("Icon", "goodwork"),
            "param_name" => "icon",
            "value" => "con-none",
            "description" => __("The icon which will above the left of the title", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("URL", "goodwork"),
            "param_name" => "url",
            "description" => __("If you want the entire text block to have a hyperlink attached, write the URL here", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Target", "goodwork"),
            "param_name" => "target",
            "value" => array("_self","_blank","_parent"),
            "description" => __("Choose a target for the above url", "goodwork")
        )
    )
) );

/* ------------------------
-----   Twitter Feed   -----
------------------------------*/

wpb_map( array(
    "name"      => __("Twitter Feed", "goodwork"),
    "base"      => "rb_twitter",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-twitter",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => __("Username", "goodwork"),
            "param_name" => "user",
            "value" => "rubenbristian",
            "description" => __("Enter your twitter username, plain and simple", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Full Name", "goodwork"),
            "param_name" => "name",
            "value" => "Ruben Bristian",
            "description" => __("Enter your full name here, as in your twitter author name.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Avatar", "goodwork"),
            "param_name" => "avatar",
            "value" => "",
            "description" => __("Enter the url to your twitter avatar in here.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("No", "goodwork"),
            "param_name" => "no",
            "value" => "3",
            "description" => __("Choose how many tweets you want to display.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("'Reply' Text", "goodwork"),
            "param_name" => "text_reply",
            "value" => "Reply",
            "description" => __("This is the text for the reply button.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("'Retweet' Text", "goodwork"),
            "param_name" => "text_retweet",
            "value" => "Retweet",
            "description" => __("This is the text for the retweet button.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("'Favorite' Text", "goodwork"),
            "param_name" => "text_favorite",
            "value" => "Favorite",
            "description" => __("This is the text for the favorite button.", "goodwork")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Rotate", "js_composer"),
            "param_name" => "rotate",
            "value" => array("Rotate" => "enabled", "Static" => "disabled"),
            "description" => __("Choose if you want the tweets to rotate through js or to only display the latest tweet (static - the number of tweets you define in the shortcode doesn't apply in this case).", "js_composer")
        )
    )
) );

/* ------------------------
-----   Widgetised Sidebar   -----
------------------------------*/

wpb_map( array(
    "name"      => __("Widgetised Sidebar", "js_composer"),
    "base"      => "vc_widget_sidebar",
    "controls"  => "edit_popup_delete",
    "class"     => "wpb_widget_sidebar_widget",
    "icon"      => "icon-wpb-layout_sidebar",
    "category"  => __('Structure', 'js_composer'),
    "params"    => array(
        array(
            "type" => "textfield",
            "heading" => __("Widget title", "js_composer"),
            "param_name" => "title",
            "value" => "",
            "description" => __("What text use as widget title. Leave blank if no title is needed.", "js_composer")
        ),
        array(
            "type" => "widgetised_sidebars",
            "heading" => __("Sidebar", "js_composer"),
            "param_name" => "sidebar_id",
            "value" => "",
            "description" => __("Select which widget area output.", "js_composer")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "js_composer")
        )
    )
) );

?>