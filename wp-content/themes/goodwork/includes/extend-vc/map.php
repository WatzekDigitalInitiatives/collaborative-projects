<?php

// This file contains new maps or map updates for the Visual Composer 

// Row

vc_map_update( 'vc_row', array(
  "params" => array(
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "krown"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
      )
  )

) );

// Accordion

vc_map_update( 'vc_accordion', array(
	"params" => array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Active tab", "krown"),
	      "param_name" => "active_tab",
	      "description" => __("Enter tab number to be active on load or enter false to collapse all tabs (0 is the first one).", "krown")
	    ),
	    array(
	      "type" => 'dropdown',
	      "heading" => __("Type", "krown"),
	      "param_name" => "type",
           "value" => array("Accordion" => 'accordion', "Toggle" => 'toggle'),
           "description" => __("Inside accordions only one section can be visible at a time. With toggles the user can open all the sections at once.", "krown")
	    ),
        array(
            "type" => "dropdown",
            "heading" => __("Style", "krown"),
            "param_name" => "style",
            "value" => array("Style #1" => 'one', "Style #2" => 'two')
        ),
	    array(
	      "type" => 'dropdown',
	      "heading" => __("Size", "krown"),
	      "param_name" => "size",
           "value" => array("Small" => 'small', "Large" => 'large'),
           "description" => __("Small accordions should be used in areas smaller than 1/2, while large accordions should only be used in areas larger than 3/4.", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	)

) );

// NEW - Icon Text Block

vc_map( array(
  "name" => __("Icon Text Block", "krown"),
  "base" => "vc_icon_text",
  "icon" => "icon-wpb-ui-textwic",
  "category" => __('Content', 'js_composer'),
  "description" => __('A text block with an icon', 'js_composer'),
  "params" => array(
    array(
      "type" => "textfield",
      "holder" => "h4",
      "heading" => __("Title", "krown"),
      "param_name" => "title",
      "value" => __("Title", "krown"),
      "description" => __("Text block title.", "krown")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Icon", "krown"),
      "param_name" => "icon",
      "value" => $icons_arr,
      "description" => __("Text block icon.", "krown")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Icon Style", "krown"),
      "param_name" => "style",
      "value" => array(__("Style #1", "krown") => "one", __("Style #2", "krown") => "two"),
      "description" => __("The icon's background style.", "krown")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Icon URL (Link)", "krown"),
      "param_name" => "href",
      "description" => __("If you fill this in, the icon will transform into a clickable button. Otherwise it will remain simple.", "krown")
    ),
    array(
      "type" => "dropdown",
      "heading" => __("Icon URL (Target)", "krown"),
      "param_name" => "target",
      "value" => $target_arr,
      "dependency" => Array('element' => "href", 'not_empty' => true)
    ),
    array(
      "type" => "textarea_html",
      "holder" => "div",
      "heading" => __("Text block content", "krown"),
      "param_name" => "content",
      "value" => __("<p>Toggle content goes here, click edit button to change this text.</p>", "krown"),
      "description" => __("Text block content.", "krown")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "krown"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
    )
  )
) );

// Button

vc_map_update( 'vc_button', array(
	"params" => array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Text on the button", "krown"),
	      "holder" => "button",
	      "class" => "wpb_button",
	      "param_name" => "label",
	      "value" => __("Text on the button", "krown"),
	      "description" => __("Text on the button.", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("URL (Link)", "krown"),
	      "param_name" => "url",
	      "description" => __("Button link.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Target", "krown"),
	      "param_name" => "target",
	      "value" => $target_arr,
	      "dependency" => Array('element' => "href", 'not_empty' => true)
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Size", "krown"),
	      "param_name" => "size",
            "value" => array('Small' => "small", 'Medium' => "medium", 'Large' => "large"),
	      "description" => __("Button size.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Style", "krown"),
	      "param_name" => "style",
	      "value" => array(__("Light", "krown") => "light", __("Dark", "krown") => "dark"),
	      "description" => __("Button style.", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	)

) );

// NEW - Contact info

wpb_map( array(
    "name"      => __("Contact Info", "goodwork"),
    "base"      => "vc_contact_info",
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

// NEW - Contact form

vc_map( array(
    "name"      => __("Contact Form", "krown"),
    "base"      => "vc_contact_form",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-contactf",
    "category"  => __('Content', 'goodwork'),
    "description"  => __('A simple contact form', 'goodwork'),
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => __("Type", "krown"),
            "param_name" => "type",
            "value" => array(__('Full', "krown") => "edit_popup_delete", __('Minimal', "krown") => "minimal"),
            "description" => __("Choose the contact form type(the minimal one is good for tight spaces, like a 1/4 column, while the full one needs a larger space, like at least a 3/4 column", "krown")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Name field label", "krown"),
            "param_name" => "label_name",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Email field label", "krown"),
            "param_name" => "label_email",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Subject field label", "krown"),
            "param_name" => "label_subject",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Message field label", "krown"),
            "param_name" => "label_message",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Send button label", "krown"),
            "param_name" => "label_send",
            "value" => ""
        ),
        array(
            "type" => "textfield",
            "heading" => __("Recipent email", "krown"),
            "param_name" => "email",
            "value" => "",
            "description" => __("Write the email address where you want to receive all of the emails sent through this form.", "krown")
        ),
        array(
            "type" => "textarea",
            "heading" => __("Error message", "krown"),
            "param_name" => "error",
            "value" => "",
            "description" => __("This message will appear to the user whenever he tries to send the email with no info or with corrupted email addresses. Please <strong>don't write HTML</strong>. If you want line breaks use <strong>&#92;n</strong>", "krown")
        ),
        array(
            "type" => "textarea",
            "heading" => __("Success message", "krown"),
            "param_name" => "success",
            "value" => "",
            "description" => __("This message will appear to the user after the email has been sent. Please <strong>don't write HTML</strong>. If you want line breaks use <strong>&#92;n</strong>", "krown")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "krown"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.(you can use the 'lessMargin' class for example, to give a smaller bottom margin to this text block", "krown")
        )
    )
) );

// Flickr

vc_map_update( 'vc_flickr', array(
	"params" =>array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Flickr ID", "krown"),
	      "param_name" => "flickr_id",
	      'admin_label' => true,
	      "description" => sprintf(__('To find your flickID visit %s.', "krown"), '<a href="http://idgettr.com/" target="_blank">idGettr</a>')
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Number of photos", "krown"),
	      "param_name" => "count",
	      "value" => "",
	      "description" => __("Choose a number of items to display (between 1-20).", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Type", "krown"),
	      "param_name" => "type",
	      "value" => array(__("User", "krown") => "user", __("Group", "krown") => "group"),
	      "description" => __("Photo stream type.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Display", "krown"),
	      "param_name" => "display",
	      "value" => array(__("Latest", "krown") => "latest", __("Random", "krown") => "random"),
	      "description" => __("Photo order.", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	)
) );


// Maps

vc_map_update( 'vc_gmaps', array(
  "params" =>array(
      array(
        "type" => "textfield",
        "heading" => __("Map latitude", "krown"),
        "param_name" => "map_lat",
        "description" => __('Enter a latitude coordinate for the map\'s center (your POI).', "krown")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Map longitude", "krown"),
        "param_name" => "map_long",
        "description" => __('Enter a longitude coordinate for the map\'s center (your POI).', "krown")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Map style", "krown"),
        "param_name" => "type",
        "value" => array(__("Default", "krown") => "default", __("Greyscale", "krown") => "true"),
        "description" => __("Select map style.", "krown")
      ),
      array(
        "type" => "dropdown",
        "heading" => __("Map Zoom", "krown"),
        "param_name" => "zoom",
        "value" => array(__("14 - Default", "krown") => 14, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11, 12, 13, 15, 16, 17, 18, 19, 20)
      ),
      array(
        "type" => "textfield",
        "heading" => __("Map height", "krown"),
        "param_name" => "size",
        "description" => __('Enter map height in pixels. Example: 200.', "krown")
      ),
      array(
        "type" => "attach_image",
        "heading" => __("Map marker", "krown"),
        "param_name" => "map_img",
        "description" => __("Upload a marker for your image.", "krown")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "krown"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
      )
  )
) );

// Message Box

vc_map_update( 'vc_message', array(
	"params" =>array(
	    array(
	      "type" => "dropdown",
	      "heading" => __("Message box type", "krown"),
	      "param_name" => "color",
	      "value" => array(__('Informational', "krown") => "alert-info", __('Warning', "krown") => "alert-block", __('Success', "krown") => "alert-success", __('Error', "krown") => "alert-error"),
	      "description" => __("Select message type.", "krown")
	    ),
	    array(
	      "type" => "textarea_html",
	      "holder" => "div",
	      "class" => "messagebox_text",
	      "heading" => __("Message text", "krown"),
	      "param_name" => "content",
	      "value" => __("<p>I am message box. Click edit button to change this text.</p>", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	)
) );

// Pie

vc_map_update( 'vc_pie', array(
	"name" => "Pie Charts",
	"params" =>array(
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

// Progress Bar

vc_map_update( 'vc_progress_bar', array(
	"name" => "Progress bars",
  "params" =>array(
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

// NEW - Portfolio Grid

vc_map( array(
	"name" => "Projects Carousel",
    "base" => "vc_portfolio_grid",
    "is_container" => true,
    "icon" => "icon-wpb-ui-projects",
    "description" => __('Portfolio projects in grid view', 'js_composer'),
    "params" => array(
        array(
            "type" => "textfield",
            "heading" => __("Items", "krown"),
            "param_name" => "no",
            "value" => "8",
            "description" => __("Choose how many items will appear in the list.", "krown")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Columns", "krown"),
            "param_name" => "cols",
            "value" => array(__("Four", "krown") => "four", __("Three", "krown") => "three",  __("Two", "krown") => "two"),
            "description" => __("Select the number of visible thumbnails (if more than the total, navigation buttons will appear).", "krown")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Categories", "krown"),
            "param_name" => "cat",
            "value" => "",
            "description" => __("If you only want certain portfolio categories to appear in this grid you should write them here (write the<strong> slugs, separated only by commas, no spaces</strong>). Ex: web-design,motion,identity", "krown")
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
            "heading" => __("Extra class name", "krown"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
        )
	)
) );

// Posts Grid

vc_map_update( 'vc_posts_grid', array(
	"name" => "Posts Carousel",
    "icon" => "icon-wpb-ui-posts",
    "params" => array(
        array(
            "type" => "loop",
            "heading" => __("Grids content", "krown"),
            "param_name" => "loop",
            'settings' => array(
                'size' => array('hidden' => false, 'value' => 4),
                'order_by' => array('value' => 'date'),
            ),
            "description" => __("Create WordPress loop, to populate content from your site.", "krown")
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
            "heading" => __("Extra class name", "krown"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
        )
	)
) );

// New - Lightbox

wpb_map( array(
    "name"      => __("Lightbox", "krown"),
    "base"      => "vc_lightbox",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-single-image",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "attach_image",
            "heading" => __("Thumbnail", "krown"),
            "param_name" => "thumb",
            "value" => "",
            "description" => __("Choose a small thumbnail for the lightbox display.", "krown")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Thumbnail width", "krown"),
            "param_name" => "twidth",
            "value" => "",
            "description" => __("Choose a width for your thumbnail(it will be automatically cropped and resized - don't forget to upload a double sized thumbnail for retina displays - defauls to 200.", "krown")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Thumbnail alignment", "krown"),
            "param_name" => "align",
            "value" => array(__('Left', "krown") => "left", __('Right', "krown") => "right"),
            "description" => "Choose the alignment of your thumbnail(best when used inside a text block)."
        ),
        array(
            "type" => "textfield",
            "heading" => __("Lightbox content", "krown"),
            "param_name" => "large",
            "value" => "",
            "description" => __("The content of the lightbox can either be another image(large one) or any kind of HTML content(you can embed iframes from your own pages, google maps or all kinds of videos which have an embeding code, by pointing to the <strong>iframe src property(the actual url of the iframe)</strong>.", "krown")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Lightbox type", "krown"),
            "param_name" => "type",
            "value" => array(__('Image', "krown") => "img", __('Iframe', "krown") => "iframe"),
            "description" => "If you want to display iframes as the lightbox content, please choose the type here."
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title", "krown"),
            "param_name" => "title",
            "value" => "",
            "description" => "If you want a title to appear in the lightbox(below the content), write it here. You can also leave this blank."
        ),
        array(
            "type" => "textfield",
            "heading" => __("Group id", "krown"),
            "param_name" => "group",
            "value" => "",
            "description" => "If you want this thumbnail to be in a gallery(rotate through the lightbox content), write a unique identifier for this group(needs to be the same). If you want to create a gallery only with images, please use <strong>the WordPress Gallery instead</strong>."
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "krown"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
        )
    )
) );

// NEW - Posts widget

wpb_map( array(
    "name"      => __("Posts Widget", "krown"),
    "base"      => "vc_custom_posts",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-posts2",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
        array(
            "type" => "dropdown",
            "heading" => __("Type", "krown"),
            "param_name" => "type",
            "value" => array(__('Popular', "krown") => "popular", __('Commented', "krown") => "commented", __('Latest', "krown") => "latest", __('Random', "krown") => "random"),
            "description" => __("Choose what posts to show. The popular posts are based on the number of views. The random posts show random posts of all time.", "krown")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Items", "krown"),
            "param_name" => "no",
            "value" => __("3", "krown"),
            "description" => __("The number of posts to show")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "krown"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
        )
    )
) );

// NEW - Promo Box

vc_map( array(
	"name" => "Promo Box",
    "base" => "vc_promo_box",
    "icon" => "icon-wpb-ui-promo",
    "description" => __('A simple boxed content.', 'js_composer'),
    "params" => array(
		array(
		  "type" => "textarea_html",
		  "heading" => __("Content", "krown"),
		  "param_name" => "content",
		  "value" => __('Write your own content here.', "krown"),
		  "description" => ''
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
            "heading" => __("Extra class name", "krown"),
            "param_name" => "el_class",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
        )
	)
) );

// New - Promo line

wpb_map( array(
    "name"      => __("Promo Line", "krown"),
    "base"      => "vc_promo_line",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-promo2",
    "category"  => __('Content', 'goodwork'),
    "params"    => array(
	    array(
	      "type" => "dropdown",
	      "heading" => __("Icon", "krown"),
	      "param_name" => "icon",
	      "value" => $icons_arr,
	      "description" => __("Text block icon.", "krown")
	    ),
        array(
            "type" => "textfield",
            "heading" => __("Title", "krown"),
            "holder" => 'h3',
            "param_name" => "title",
            "value" => "",
            "description" => __("The title of the line(H2 element)", "krown")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Subtitle", "krown"),
            "param_name" => "subtitle",
            "value" => "",
            "description" => __("The subtitle of the line(H5 element)", "krown")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Link URL", "krown"),
            "param_name" => "link_url",
            "value" => "",
            "description" => __("If you fill up this field with an url, a call to action button will appear in the right side of the line", "krown")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Link Label", "krown"),
            "param_name" => "link_label",
            "value" => "",
            "description" => __("The label for the call to action button", "krown")
        ),
        array(
            "type" => "dropdown",
            "heading" => __("Link Target", "krown"),
            "param_name" => "link_target",
            "value" => array('_blank' => "_blank", '_self' => "_self", '_parent' => "_parent", '_top' => "_top"),
            "description" => __("The target of the button", "krown")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "krown"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
        )
    )
) );

// Separator

vc_map_update( 'vc_separator', array(
	"description" => __('Blank Divider', 'js_composer'),
	"show_settings_on_create" => true,
	"params" =>array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Top margin", "krown"),
	      "param_name" => "height_2",
	      "value" => "0",
	      "description" => __("Enter a numeric value for the top margin of this divider (in px).", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Bottom margin", "krown"),
	      "param_name" => "height",
	      "value" => "50",
	      "description" => __("Enter a numeric value for the bottom margin of this divider (in px).", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Border", "krown"),
	      "param_name" => "show_border",
	      "value" => array(__("Hide", "krown") => "no_border", __("Show", "krown") => "yes_border"),
	      "description" => __("You can choose to show a 1px border, like a horizontal rule, or have a blank divider.", "krown")
	    ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "goodwork"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
        )
	)
) );

// Tabs

$tab_id_1 = time().'-1-'.rand(0, 100);
$tab_id_2 = time().'-2-'.rand(0, 100);
vc_map_update( 'vc_tabs', array(
	"params" => array(
        array(
            "type" => "dropdown",
            "heading" => __("Style", "js_composer"),
            "param_name" => "style",
            "value" => array("Light" => 'light', "Dark" => 'dark')
        ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	),
    "default_content" => '
    	[vc_tab title="'.__('Tab 1','js_composer').'" tab_id="'.$tab_id_1.'" icon="none"][/vc_tab]
  		[vc_tab title="'.__('Tab 2','js_composer').'" tab_id="'.$tab_id_2.'" icon="none"][/vc_tab]',
) );

vc_map_update( 'vc_tab', array(
	"params" => array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Title", "krown"),
	      "param_name" => "title",
	      "description" => __("Tab title - only works for tabs, not for tours.", "krown")
	    ),
	    array(
	      "type" => "tab_id",
	      "heading" => __("Tab ID", "krown"),
	      "param_name" => "tab_id"
	    )
	)
) );

// NEW - Tagline


/* ------------------------
-----   Tagline    -----
------------------------------*/

wpb_map( array(
    "name"      => __("Tagline", "goodwork"),
    "base"      => "vc_tagline",
    "class"     => "wpb_controls_top_right",
    "controls"  => "edit_popup_delete",
    "icon"      => "icon-wpb-ui-tab-content-vertical",
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
	      "type" => "dropdown",
	      "heading" => __("Icon", "krown"),
	      "param_name" => "icon",
	      "value" => $icons_arr,
	      "description" => __("Text block icon.", "krown")
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


// NEW - Team

vc_map( array(
  "name" => __("Team Member", "krown"),
  "base" => "vc_team",
  "icon" => "icon-wpb-ui-team",
  "category" => __('Content', 'js_composer'),
  "description" => __('Text block with image at top', 'js_composer'),
  "params" => array(
        array(  /*start edited*/
            "type" => "textfield",
            "heading" => __("Name", "krown"),
            "param_name" => "name",
            "value" => "",
            "description" => __("The full name of the professor or student.", "goodwork")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Title (if faculty)", "krown"),
            "param_name" => "faculty_title",
            "value" => '',
            "description" => __("The faculty member's title (eg. Associate Professor of French)")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Year and Major (if a student)", "krown"),
            "param_name" => "student_yrmajor",
            "value" => '',
            "description" => __("The student's year and major, formatted like this for single major or double major: '14, French Studies or '14, French Studies / English")
        ),
        array(
            "type" => "attach_image",
            "heading" => __("Image", "krown"),
            "param_name" => "image",
            "value" => __("", "goodwork"),
            "description" => __("Add an image if desired. This should be a square image of 300x300(150 is the real size, but 300 will be used for retina).", "goodwork")
        ),
        array(
            "type" => "textarea_html",
            "heading" => __("Faculty: Bio and/or web site", "krown"),
            "param_name" => "content",
            "holder" => 'div',
            "value" => '',
            "description" => __("Optional: enter a brief bio or web site.", "krown")
        ),
        array(
            "type" => "textfield",
            "heading" => __("Extra class name", "js_composer"),
            "param_name" => "el_class",
            "value" => "",
            "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file(you can use the 'lessMargin' class for example, to give a smaller bottom margin to this text block.", "js_composer")
        )  /*end edited*/

/*
    array(
      "type" => "textfield",
      "holder" => "h4",
      "heading" => __("Title", "krown"),
      "param_name" => "title",
      "value" => __("Title", "krown"),
      "description" => __("Team member's title (name).", "krown")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Subtitle", "krown"),
      "param_name" => "subtitle",
      "value" => __("Subtitle", "krown"),
      "description" => __("Team member's subtitle (position).", "krown")
    ),
    array(
      "type" => "attach_image",
      "heading" => __("Image", "krown"),
      "param_name" => "image",
      "description" => __("Team member's image (150px wide or double for retina).", "krown")
    ),
    array(
      "type" => "textarea_html",
      "heading" => __("Content", "krown"),
      "param_name" => "content",
      "value" => __('[vc_social_links facebook="#" twitter="#" behance="#" dribbble="#"]', "krown"),
      "description" => __("Team member's content. Can be anything from a simple social sharing shortcode or a more elaborated description.", "krown")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "krown"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
    )
    */
  )
) );

// NEW - Testimonial

vc_map( array(
  "name" => __("Testimonial", "krown"),
  "base" => "vc_testimonial",
  "icon" => "icon-wpb-ui-testimonial",
  "category" => __('Content', 'js_composer'),
  "description" => __('Simple testimonial block', 'js_composer'),
  "params" => array(
    array(
      "type" => "textfield",
      "holder" => "h4",
      "heading" => __("Title", "krown"),
      "param_name" => "client",
      "value" => __("Title", "krown"),
      "description" => __("Source name (eg. client).", "krown")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Subtitle", "krown"),
      "param_name" => "position",
      "value" => __("Subtitle", "krown"),
      "description" => __("Source subtitle (eg. position or website).", "krown")
    ),
    array(
        "type" => "dropdown",
        "heading" => __("Style", "goodwork"),
        "param_name" => "style",
        "value" => array(__('Dark', "goodwork") => "dark", __('Light', "goodwork") => "light"),
        "description" => __("Choose the style of the testimonial box", "goodwork")
    ),
    array(
      "type" => "textarea_html",
      "heading" => __("Content", "krown"),
      "param_name" => "content",
      "value" => __('<p>Write the contents of the testimonial here.', "krown")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "krown"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
    )
  )
) );

// Text Block

vc_map_update( 'vc_column_text', array(
  "params" => array(
      array(
        "type" => "textarea_html",
        "holder" => "div",
        "heading" => __("Text", "krown"),
        "param_name" => "content",
        "value" => __("<p>I am text block. Click edit button to change this text. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut elit tellus, luctus nec ullamcorper mattis, pulvinar dapibus leo.</p>", "krown")
      ),
      array(
        "type" => "textfield",
        "heading" => __("Extra class name", "krown"),
        "param_name" => "el_class",
        "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
      )
  )

) );

// Text Separator

vc_map_update( 'vc_text_separator', array(
		"description" => __('Section separator with text.', 'js_composer'),
	"params" => array(
	    array(
	      "type" => "textfield",
	      "heading" => __("Title", "krown"),
	      "param_name" => "title",
	      "holder" => "div",
	      "value" => "",
	      "description" => __("Separator title.", "krown")
	    ),
	    array(
	      "type" => "dropdown",
	      "heading" => __("Icon", "krown"),
	      "param_name" => "icon",
	      "value" => $icons_arr,
	      "description" => __("Text block icon.", "krown")
	    ),
        array(
            "type" => "dropdown",
            "heading" => __("Bottom double border", "goodwork"),
            "param_name" => "border",
            "value" => array(__('Show Border', "goodwork") => "yes_border", __('Hide Border', "goodwork") => "no_border"),
            "description" => __("If selected, a thin border will appear below the header.", "goodwork")
        ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Bottom margin", "krown"),
	      "param_name" => "margin",
	      "value" => "30",
	      "description" => __("Choose a bottom margin for the separator.", "krown")
	    ),
	    array(
	      "type" => "textfield",
	      "heading" => __("Extra class name", "krown"),
	      "param_name" => "el_class",
	      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
	    )
	)

) );

// NEW - Twitter

vc_map( array(
  "name" => __("Twitter Widget", "krown"),
  "base" => "vc_twitter",
  "icon" => 'icon-wpb-ui-twitter',
  "category" => __('Social', 'js_composer'),
  "params" => array(
    array(
      "type" => "textfield",
      "heading" => __("Twitter username", "krown"),
      "param_name" => "twitter_name",
      "description" => __("Type in twitter profile name from which load tweets (without @).", "krown")
    ),
    array(
        "type" => "textfield",
        "heading" => __("Full Name", "goodwork"),
        "param_name" => "name",
        "value" => "Ruben Bristian",
        "description" => __("Enter your full name here, as in your twitter author name.", "goodwork")
    ),
    array(
        "type" => "attach_image",
        "heading" => __("Avatar", "goodwork"),
        "param_name" => "avatar",
        "value" => "",
        "description" => __("Choose an avatar for the widget.", "goodwork")
    ),
    array(
        "type" => "textfield",
        "heading" => __("Count", "goodwork"),
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
        "heading" => __("Rotate", "krown"),
        "param_name" => "rotate",
        "value" => array("Rotate" => "enabled", "Static" => "disabled"),
        "description" => __("Choose if you want the tweets to rotate through js or to only display the latest tweet.", "krown")
    ),
    array(
      "type" => "textfield",
      "heading" => __("Extra class name", "krown"),
      "param_name" => "el_class",
      "description" => __("If you wish to style particular content element differently, then use this field to add a class name and then refer to it in your css file.", "krown")
    )
  )
) );

?>