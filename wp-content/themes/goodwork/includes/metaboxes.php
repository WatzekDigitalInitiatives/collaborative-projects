<?php

add_action( 'admin_init', 'rb_meta_boxes' );

global $sidebars_array;

function rb_meta_boxes() {

/*---------------------------------
    INIT SOME USEFUL VARIABLES
------------------------------------*/

$sidebars = ot_get_option('rb_sidebars');
$sidebars_array = array();
$sidebars_k = 0;
if(!empty($sidebars)){
    foreach($sidebars as $sidebar){
        $sidebars_array[$sidebars_k++] = array(
            'label' => $sidebar['title'],
            'value' => $sidebar['id']
        );
    }
}

$portfolios_array = array();
$portfolio_categories = get_categories(array('taxonomy'=>'portfolio_category'));
foreach($portfolio_categories as $portfolio_category) {
    array_push($portfolios_array, 
        array(
            'value' => $portfolio_category->slug,
            'label' => $portfolio_category->name
        )
    );
}

$icons_array = array(
	array('label' => __("None", "krown"), 'value'=>"none"),
	array('label' => __("Delicious", "krown"), 'value'=>"krown-icon-delicious"),
	array('label' => __("Plus", "krown"), 'value'=>"krown-icon-plus"),
	array('label' => __("Minus", "krown"), 'value'=>"krown-icon-minus"),
	array('label' => __("Digg", "krown"), 'value'=>"krown-icon-digg"),
	array('label' => __("Youtube", "krown"), 'value'=>"krown-icon-youtube"),
	array('label' => __("Email", "krown"), 'value'=>"krown-icon-email"),
	array('label' => __("Home", "krown"), 'value'=>"krown-icon-home"),
	array('label' => __("Hourglass", "krown"), 'value'=>"krown-icon-hourglass"),
	array('label' => __("Play", "krown"), 'value'=>"krown-icon-play"),
	array('label' => __("Cloud", "krown"), 'value'=>"krown-icon-cloud"),
	array('label' => __("Umbrella", "krown"), 'value'=>"krown-icon-umbrella"),
	array('label' => __("Star", "krown"), 'value'=>"krown-icon-star"),
	array('label' => __("Moon", "krown"), 'value'=>"krown-icon-moon"),
	array('label' => __("Note Beamed", "krown"), 'value'=>"krown-icon-note-beamed"),
	array('label' => __("Flag", "krown"), 'value'=>"krown-icon-flag"),
	array('label' => __("Tools", "krown"), 'value'=>"krown-icon-tools"),
	array('label' => __("Cog", "krown"), 'value'=>"krown-icon-cog"),
	array('label' => __("Tape", "krown"), 'value'=>"krown-icon-tape"),
	array('label' => __("Flight", "krown"), 'value'=>"krown-icon-flight"),
	array('label' => __("Mail", "krown"), 'value'=>"krown-icon-mail"),
	array('label' => __("Pencil", "krown"), 'value'=>"krown-icon-pencil"),
	array('label' => __("Feather", "krown"), 'value'=>"krown-icon-feather"),
	array('label' => __("Ok", "krown"), 'value'=>"krown-icon-ok"),
	array('label' => __("Cancel", "krown"), 'value'=>"krown-icon-cancel"),
	array('label' => __("Asterisk", "krown"), 'value'=>"krown-icon-asterisk"),
	array('label' => __("Quote", "krown"), 'value'=>"krown-icon-quote"),
	array('label' => __("Forward", "krown"), 'value'=>"krown-icon-forward"),
	array('label' => __("Cw", "krown"), 'value'=>"krown-icon-cw"),
	array('label' => __("Resize Vertical", "krown"), 'value'=>"krown-icon-resize-vertical"),
	array('label' => __("Resize Horizontal", "krown"), 'value'=>"krown-icon-resize-horizontal"),
	array('label' => __("Volume", "krown"), 'value'=>"krown-icon-volume"),
	array('label' => __("Skype", "krown"), 'value'=>"krown-icon-skype"),
	array('label' => __("Phone 1", "krown"), 'value'=>"krown-icon-phone-1"),
	array('label' => __("Pencil 2", "krown"), 'value'=>"krown-icon-pencil-2"),
	array('label' => __("Dribbble", "krown"), 'value'=>"krown-icon-dribbble"),
	array('label' => __("Digg 1", "krown"), 'value'=>"krown-icon-digg-1"),
	array('label' => __("Right Open 1", "krown"), 'value'=>"krown-icon-right-open-1"),
	array('label' => __("Left Open 1", "krown"), 'value'=>"krown-icon-left-open-1"),
	array('label' => __("Book 1", "krown"), 'value'=>"krown-icon-book-1"),
	array('label' => __("Comment", "krown"), 'value'=>"krown-icon-comment"),
	array('label' => __("Eye", "krown"), 'value'=>"krown-icon-eye"),
	array('label' => __("Tag", "krown"), 'value'=>"krown-icon-tag"),
	array('label' => __("Tags", "krown"), 'value'=>"krown-icon-tags"),
	array('label' => __("Print", "krown"), 'value'=>"krown-icon-print"),
	array('label' => __("Chat", "krown"), 'value'=>"krown-icon-chat"),
	array('label' => __("Location", "krown"), 'value'=>"krown-icon-location"),
	array('label' => __("Compass", "krown"), 'value'=>"krown-icon-compass"),
	array('label' => __("Rss", "krown"), 'value'=>"krown-icon-rss"),
	array('label' => __("Share", "krown"), 'value'=>"krown-icon-share"),
	array('label' => __("Basket", "krown"), 'value'=>"krown-icon-basket"),
	array('label' => __("Login", "krown"), 'value'=>"krown-icon-login"),
	array('label' => __("Logout", "krown"), 'value'=>"krown-icon-logout"),
	array('label' => __("Resize Full", "krown"), 'value'=>"krown-icon-resize-full"),
	array('label' => __("Resize Small", "krown"), 'value'=>"krown-icon-resize-small"),
	array('label' => __("Bucket", "krown"), 'value'=>"krown-icon-bucket"),
	array('label' => __("Thermometer", "krown"), 'value'=>"krown-icon-thermometer"),
	array('label' => __("Down Circle2", "krown"), 'value'=>"krown-icon-down-circle2"),
	array('label' => __("Up Circle2", "krown"), 'value'=>"krown-icon-up-circle2"),
	array('label' => __("Left Open", "krown"), 'value'=>"krown-icon-left-open"),
	array('label' => __("Right Open", "krown"), 'value'=>"krown-icon-right-open"),
	array('label' => __("Right Open Mini", "krown"), 'value'=>"krown-icon-right-open-mini"),
	array('label' => __("Network", "krown"), 'value'=>"krown-icon-network"),
	array('label' => __("Inbox", "krown"), 'value'=>"krown-icon-inbox"),
	array('label' => __("Off", "krown"), 'value'=>"krown-icon-off"),
	array('label' => __("Road", "krown"), 'value'=>"krown-icon-road"),
	array('label' => __("Ajust", "krown"), 'value'=>"krown-icon-ajust"),
	array('label' => __("Tint", "krown"), 'value'=>"krown-icon-tint"),
	array('label' => __("Brush", "krown"), 'value'=>"krown-icon-brush"),
	array('label' => __("Paper Plane", "krown"), 'value'=>"krown-icon-paper-plane"),
	array('label' => __("Chart Pie 1", "krown"), 'value'=>"krown-icon-chart-pie-1"),
	array('label' => __("Tablet", "krown"), 'value'=>"krown-icon-tablet"),
	array('label' => __("Pencil 1", "krown"), 'value'=>"krown-icon-pencil-1"),
	array('label' => __("Globe 1", "krown"), 'value'=>"krown-icon-globe-1"),
	array('label' => __("Magnet 1", "krown"), 'value'=>"krown-icon-magnet-1"),
	array('label' => __("Flash 1", "krown"), 'value'=>"krown-icon-flash-1"),
	array('label' => __("User 1", "krown"), 'value'=>"krown-icon-user-1"),
	array('label' => __("Users 1", "krown"), 'value'=>"krown-icon-users-1"),
	array('label' => __("Clock 1", "krown"), 'value'=>"krown-icon-clock-1"),
	array('label' => __("Heart 1", "krown"), 'value'=>"krown-icon-heart-1"),
	array('label' => __("Flickr", "krown"), 'value'=>"krown-icon-flickr"),
	array('label' => __("Facebook Squared", "krown"), 'value'=>"krown-icon-facebook-squared"),
	array('label' => __("Gplus", "krown"), 'value'=>"krown-icon-gplus"),
	array('label' => __("Github", "krown"), 'value'=>"krown-icon-github"),
	array('label' => __("Comment 1", "krown"), 'value'=>"krown-icon-comment-1"),
	array('label' => __("Picture 1", "krown"), 'value'=>"krown-icon-picture-1"),
	array('label' => __("Plus 1", "krown"), 'value'=>"krown-icon-plus-1"),
	array('label' => __("Minus 1", "krown"), 'value'=>"krown-icon-minus-1"),
	array('label' => __("Cancel 1", "krown"), 'value'=>"krown-icon-cancel-1"),
	array('label' => __("Eye 1", "krown"), 'value'=>"krown-icon-eye-1"),
	array('label' => __("Soundcloud", "krown"), 'value'=>"krown-icon-soundcloud"),
	array('label' => __("Dropbox", "krown"), 'value'=>"krown-icon-dropbox"),
	array('label' => __("Xing", "krown"), 'value'=>"krown-icon-xing"),
	array('label' => __("Aim", "krown"), 'value'=>"krown-icon-aim"),
	array('label' => __("Fire Station", "krown"), 'value'=>"krown-icon-fire-station"),
	array('label' => __("Steam", "krown"), 'value'=>"krown-icon-steam"),
	array('label' => __("Instagram", "krown"), 'value'=>"krown-icon-instagram"),
	array('label' => __("Grocery Store", "krown"), 'value'=>"krown-icon-grocery-store"),
	array('label' => __("Harbor", "krown"), 'value'=>"krown-icon-harbor"),
	array('label' => __("Heliport", "krown"), 'value'=>"krown-icon-heliport"),
	array('label' => __("Religious Jewish", "krown"), 'value'=>"krown-icon-religious-jewish"),
	array('label' => __("School", "krown"), 'value'=>"krown-icon-school"),
	array('label' => __("Skiing", "krown"), 'value'=>"krown-icon-skiing"),
	array('label' => __("Swimming", "krown"), 'value'=>"krown-icon-swimming"),
	array('label' => __("Right Open 2", "krown"), 'value'=>"krown-icon-right-open-2"),
	array('label' => __("Left Open 2", "krown"), 'value'=>"krown-icon-left-open-2"),
	array('label' => __("Ccw", "krown"), 'value'=>"krown-icon-ccw"),
	array('label' => __("Vector Pencil", "krown"), 'value'=>"krown-icon-vector-pencil"),
	array('label' => __("Move", "krown"), 'value'=>"krown-icon-move"),
	array('label' => __("Certificate", "krown"), 'value'=>"krown-icon-certificate"),
	array('label' => __("Filter", "krown"), 'value'=>"krown-icon-filter"),
	array('label' => __("Resize Full Alt", "krown"), 'value'=>"krown-icon-resize-full-alt"),
	array('label' => __("Beaker", "krown"), 'value'=>"krown-icon-beaker"),
	array('label' => __("Magic", "krown"), 'value'=>"krown-icon-magic"),
	array('label' => __("Gauge", "krown"), 'value'=>"krown-icon-gauge"),
	array('label' => __("Sitemap", "krown"), 'value'=>"krown-icon-sitemap"),
	array('label' => __("Lightbulb", "krown"), 'value'=>"krown-icon-lightbulb"),
	array('label' => __("Download Cloud", "krown"), 'value'=>"krown-icon-download-cloud"),
	array('label' => __("Upload Cloud", "krown"), 'value'=>"krown-icon-upload-cloud"),
	array('label' => __("Bell Alt", "krown"), 'value'=>"krown-icon-bell-alt"),
	array('label' => __("Beer", "krown"), 'value'=>"krown-icon-beer"),
	array('label' => __("Desktop", "krown"), 'value'=>"krown-icon-desktop"),
	array('label' => __("Laptop", "krown"), 'value'=>"krown-icon-laptop"),
	array('label' => __("Quote Left", "krown"), 'value'=>"krown-icon-quote-left"),
	array('label' => __("Quote Right", "krown"), 'value'=>"krown-icon-quote-right"),
	array('label' => __("Reply", "krown"), 'value'=>"krown-icon-reply"),
	array('label' => __("Vimeo", "krown"), 'value'=>"krown-icon-vimeo"),
	array('label' => __("Twitter", "krown"), 'value'=>"krown-icon-twitter"),
	array('label' => __("Globe", "krown"), 'value'=>"krown-icon-globe"),
	array('label' => __("Pinterest", "krown"), 'value'=>"krown-icon-pinterest"),
	array('label' => __("Tumblr", "krown"), 'value'=>"krown-icon-tumblr"),
	array('label' => __("Linkedin", "krown"), 'value'=>"krown-icon-linkedin"),
	array('label' => __("Stumbleupon", "krown"), 'value'=>"krown-icon-stumbleupon"),
	array('label' => __("Lastfm", "krown"), 'value'=>"krown-icon-lastfm"),
	array('label' => __("Evernote", "krown"), 'value'=>"krown-icon-evernote"),
	array('label' => __("Leaf", "krown"), 'value'=>"krown-icon-leaf"),
	array('label' => __("Picasa", "krown"), 'value'=>"krown-icon-picasa"),
	array('label' => __("Behance", "krown"), 'value'=>"krown-icon-behance"),
	array('label' => __("Google Circles", "krown"), 'value'=>"krown-icon-google-circles"),
	array('label' => __("Gift", "krown"), 'value'=>"krown-icon-gift"),
	array('label' => __("Graduation Cap", "krown"), 'value'=>"krown-icon-graduation-cap"),
	array('label' => __("Mic", "krown"), 'value'=>"krown-icon-mic"),
	array('label' => __("Headphones", "krown"), 'value'=>"krown-icon-headphones"),
	array('label' => __("Palette", "krown"), 'value'=>"krown-icon-palette"),
	array('label' => __("Trophy", "krown"), 'value'=>"krown-icon-trophy"),
	array('label' => __("Award", "krown"), 'value'=>"krown-icon-award"),
	array('label' => __("Thumbs Up", "krown"), 'value'=>"krown-icon-thumbs-up"),
	array('label' => __("Thumbs Down", "krown"), 'value'=>"krown-icon-thumbs-down"),
	array('label' => __("Bag", "krown"), 'value'=>"krown-icon-bag"),
	array('label' => __("User", "krown"), 'value'=>"krown-icon-user"),
	array('label' => __("Users", "krown"), 'value'=>"krown-icon-users"),
	array('label' => __("Lamp", "krown"), 'value'=>"krown-icon-lamp"),
	array('label' => __("Briefcase", "krown"), 'value'=>"krown-icon-briefcase"),
	array('label' => __("Calendar", "krown"), 'value'=>"krown-icon-calendar"),
	array('label' => __("Clipboard", "krown"), 'value'=>"krown-icon-clipboard"),
	array('label' => __("Book", "krown"), 'value'=>"krown-icon-book"),
	array('label' => __("Phone", "krown"), 'value'=>"krown-icon-phone"),
	array('label' => __("Megaphone", "krown"), 'value'=>"krown-icon-megaphone"),
	array('label' => __("Upload", "krown"), 'value'=>"krown-icon-upload"),
	array('label' => __("Download", "krown"), 'value'=>"krown-icon-download"),
	array('label' => __("Mobile", "krown"), 'value'=>"krown-icon-mobile"),
	array('label' => __("Mute", "krown"), 'value'=>"krown-icon-mute"),
	array('label' => __("Sound", "krown"), 'value'=>"krown-icon-sound"),
	array('label' => __("Battery", "krown"), 'value'=>"krown-icon-battery"),
	array('label' => __("Search", "krown"), 'value'=>"krown-icon-search"),
	array('label' => __("Key", "krown"), 'value'=>"krown-icon-key"),
	array('label' => __("Bell", "krown"), 'value'=>"krown-icon-bell"),
	array('label' => __("Link", "krown"), 'value'=>"krown-icon-link"),
	array('label' => __("Fire", "krown"), 'value'=>"krown-icon-fire"),
	array('label' => __("Flashlight", "krown"), 'value'=>"krown-icon-flashlight"),
	array('label' => __("Wrench", "krown"), 'value'=>"krown-icon-wrench"),
	array('label' => __("Hammer", "krown"), 'value'=>"krown-icon-hammer"),
	array('label' => __("Chart Area", "krown"), 'value'=>"krown-icon-chart-area"),
	array('label' => __("Clock", "krown"), 'value'=>"krown-icon-clock"),
	array('label' => __("Rocket", "krown"), 'value'=>"krown-icon-rocket"),
	array('label' => __("Truck", "krown"), 'value'=>"krown-icon-truck"),
	array('label' => __("Block", "krown"), 'value'=>"krown-icon-block"),
	array('label' => __("Picture", "krown"), 'value'=>"krown-icon-picture"),
	array('label' => __("Video", "krown"), 'value'=>"krown-icon-video"),
	array('label' => __("Calendar 1", "krown"), 'value'=>"krown-icon-calendar-1"),
	array('label' => __("Chart", "krown"), 'value'=>"krown-icon-chart"),
	array('label' => __("Chart Bar", "krown"), 'value'=>"krown-icon-chart-bar"),
	array('label' => __("Book Open", "krown"), 'value'=>"krown-icon-book-open"),
	array('label' => __("Mobile 1", "krown"), 'value'=>"krown-icon-mobile-1"),
	array('label' => __("Camera", "krown"), 'value'=>"krown-icon-camera"),
	array('label' => __("Volume Up", "krown"), 'value'=>"krown-icon-volume-up"),
	array('label' => __("Link 1", "krown"), 'value'=>"krown-icon-link-1)")

);

/*---------------------------------
    PORTFOLIO - Portfolio Post Type
------------------------------------*/

  $rb_meta_box_portfolio = array(
    'id'        => 'rb_meta_box_portfolio',
    'title'     => 'Portfolio Options',
    'desc'      => '',
    'pages'     => array( 'page' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
        array(
        'id'          => 'rb_meta_box_portfolio_set',
        'label'       => 'Choose categories',
        'desc'        => 'Select the categories which will appear in this portfolio.',
        'std'         => 'portfolio',
        'type'        => 'checkbox',
        'class'       => '',
        'choices'    => $portfolios_array
        ),
        array(
        'id'          => 'rb_def_p_ajax',
        'label'       => 'Ajax',
        'desc'        => 'Choose if you would like the portfolio posts to load via AJAX or not. 
        <ul>
        <li>If you choose the AJAX way<strong>(true option)</strong>, all posts will load above the thumbnails, without a page reload.</li>
        <li>If you choose the traditional way<strong>(false option)</strong>, the posts will load as a separate page, with a page reload.</li>
        </ul>',
        'std'         => 'false',
        'type'        => 'radio',
        'rows'        => '',
        'post_type'   => '',
        'section'     => 'rb_portfolio',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'True',
            'src'         => ''
          ),
          array(
            'value'       => 'false',
            'label'       => 'False',
            'src'         => ''
          )
        )
        ),
        array(
        'id'          => 'rb_def_p_filtering',
        'label'       => 'Filtering',
        'desc'        => 'Choose if you would like the portfolio grid to be filtered or paginated. 
        <ul>
        <li>A filtered grid<strong>(true option)</strong>, involves cool jQuery animations and an infinite loading option. The filters will automatically appear above the thumbnails(good for small portfolios).</li>
        <li>A paginated grid<strong>(false option)</strong>, doesn\'t offer any kind of animations or infinite loading. Instead, each filter will open as a separate page and you\'ll have pagination at your disposal(good for large portfolios).</li>
        </ul>',
        'std'         => 'true',
        'type'        => 'radio',
        'rows'        => '',
        'post_type'   => '',
        'section'     => 'rb_portfolio',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'True',
            'src'         => ''
          ),
          array(
            'value'       => 'false',
            'label'       => 'False',
            'src'         => ''
          )
        )
        ),
        array(
        'id'          => 'rb_def_p_columns',
        'label'       => 'Columns',
        'desc'        => 'Choose how many columns will there be in a portfolio grid(with no sidebars). If you do use sidebars, the number of columns will be fixed to 3(because of sizing issues).',
        'std'         => 'four',
        'type'        => 'select',
        'rows'        => '',
        'post_type'   => '',
        'section'     => 'rb_portfolio',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'four',
            'label'       => '4',
            'src'         => ''
          ),
          array(
            'value'       => 'three',
            'label'       => '3',
            'src'         => ''
          ),
          array(
            'value'       => 'two',
            'label'       => '2',
            'src'         => ''
          )
        )
        ),
        array(
        'id'          => 'rb_def_p_thumbnails',
        'label'       => 'Thumbnails',
        'desc'        => 'There are two types of thumbnails. One with the text below the thumbnail<strong>(type #1)</strong> and one with the text inside the thumbnail, which appears on hover<strong>(type #2)</strong>.',
        'std'         => 'one',
        'type'        => 'select',
        'rows'        => '',
        'post_type'   => '',
        'section'     => 'rb_portfolio',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'one',
            'label'       => 'Type #1',
            'src'         => ''
          ),
          array(
            'value'       => 'two',
            'label'       => 'Type #2',
            'src'         => ''
          )
        )
        ),
        array(
        'id'          => 'rb_def_p_related',
        'label'       => 'Related projects',
        'desc'        => 'Choose if you want the related projects section to appear under each project page(ajax portfolios don\'t have this feature.',
        'std'         => 'true',
        'type'        => 'radio',
        'rows'        => '',
        'post_type'   => '',
        'section'     => 'rb_portfolio',
        'taxonomy'    => '',
        'class'       => '',
        'choices'     => array( 
          array(
            'value'       => 'true',
            'label'       => 'Yes',
            'src'         => ''
          ),
          array(
            'value'       => 'false',
            'label'       => 'No',
            'src'         => ''
          )
        )
        )
      )
    );

/*---------------------------------
    SIDEBARS - In all kinds of pages
------------------------------------*/

  $rb_meta_box_sidebar = array(
    'id'        => 'rb_meta_box_sidebar',
    'title'     => 'Layout',
    'desc'      => 'If you select a layout with a sidebar, please choose a sidebar from the list below. Sidebars can be created in the Theme Options and configured in the Theme Widgets.',
    'pages'     => array( 'page' ),
    'context'   => 'side',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'rb_meta_box_sidebar_layout',
        'label'       => 'Layout type',
        'desc'        => '',
        'std'         => 'full-width',
        'type'        => 'radio_image',
        'class'       => ''
        ),
      array(
        'id'          => 'rb_meta_box_sidebar_set',
        'label'       => 'Select sidebar',
        'desc'        => '',
        'std'         => '',
        'type'        => 'select',
        'class'       => '',
        'choices'    => $sidebars_array
        )
      )
    );

/*---------------------------------
    TAGLINE - In regular pages
------------------------------------*/

  $rb_meta_box_tagline = array(
    'id'        => 'rb_meta_box_tagline',
    'title'     => 'Title Options',
    'desc'      => '',
    'pages'     => array( 'page' ),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'rb_meta_box_t_show',
        'label'       => 'Show Title',
        'desc'        => 'If selected, the title of the current page will be shown at the top.',
        'std'         => 'true',
        'type'        => 'radio',
        'class'       => '',
        'choices'     => array(
                array(
                    'label' => 'Show',
                    'value' => 'true'
                ),
                array(
                    'label' => 'Hide',
                    'value' => 'false'
                )
            )
        ),
      array(
        'id'          => 'rb_meta_box_t_link',
        'label'       => 'Link Text',
        'desc'        => 'If not empty, a link will appear in the right side of the page, besides the title. This link is configured with the next two params.',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        ),
      array(
        'id'          => 'rb_meta_box_t_url',
        'label'       => 'Link URL',
        'desc'        => 'If selected, the title of the current page will be shown at the top.',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        ),
      array(
        'id'          => 'rb_meta_box_t_target',
        'label'       => 'Link Target',
        'desc'        => '',
        'std'         => '_self',
        'type'        => 'radio',
        'class'       => '',
        'choices'     => array(
                array(
                    'label' => '_self',
                    'value' => '_self'
                ),
                array(
                    'label' => '_blank',
                    'value' => '_blank'
                ),
                array(
                    'label' => '_parent',
                    'value' => '_parent'
                ),
                array(
                    'label' => '_top',
                    'value' => '_top'
                )
            )
        )
      )
    );

/*---------------------------------
    TAGLINE - In slider pages
------------------------------------*/

  $rb_meta_box_title = array(
    'id'        => 'rb_meta_box_title',
    'title'     => 'Tagline',
    'desc'      => '',
    'pages'     => array( 'page' ),
    'context'   => 'side',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'          => 'rb_meta_box_title2_show',
        'label'       => 'Show Tagline',
        'desc'        => 'If selected, a custom tagline configured below will appear above the slider.',
        'std'         => 'true',
        'type'        => 'radio',
        'class'       => '',
        'choices'     => array(
                array(
                    'label' => 'Show',
                    'value' => 'true'
                ),
                array(
                    'label' => 'Hide',
                    'value' => 'false'
                )
            )
        ),
      array(
        'id'          => 'rb_meta_box_title2_title',
        'label'       => 'Title',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        ),
      array(
        'id'          => 'rb_meta_box_title2_subtitle',
        'label'       => 'Subtitle',
        'desc'        => '',
        'std'         => '',
        'type'        => 'text',
        'class'       => '',
        ),

          array(
            'id'      => 'rb_meta_box_title2_icon',
            'label'   => 'Icon',
            'desc'    => 'Choose an icon from the list. To see the complete list of icons, <u>check this page</u>.',
            'std'     => '',
            'type'    => 'select',
            'class'   => '',
            'choices' => $icons_array
          )
      )
    );

/*---------------------------------
    MEDIA - According to post formats
------------------------------------*/

  $rb_meta_box_post_assets = array(
    'id'        => 'rb_meta_box_post_assets',
    'title'     => 'Post Media / Content',
    'desc'      => '',
    'pages'     => array( 'post'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
          array(
            'id'      => 'rb_meta_box_post_assets_desc',
            'label'   => '',
            'desc'    => 'Each post format allows for some media(or other kind of) content. Use the fields bellow to configure this post properly. Please note that media width should be <strong>700px</strong>(or 1400px if you want retina enabled images). The height can be different for each media type(but when you create a slider for example, all the images need to have the same size).' ,
            'std'     => '',
            'type'    => 'textblock',
            'class'   => '',
            'choices' => array()
          ),

          /* Gallery type */

          array(
            'id'          => 'rb_meta_box_post_assets_g',
            'label'       => 'Gallery',
            'desc'        => 'If this is a <strong>gallery post</strong>, you should configure your gallery(slider) here.',
            'std'         => '',
            'type'        => 'upload',
            'class'       => '',

            'type'        => 'list-item',
            'class'       => '',
            'choices'     => array(),
            'settings'    => array(
              array(
                'id'      => 'rb_image',
                'label'   => 'Image',
                'std'     => '',
                'type'    => 'upload',
                'class'   => ''
                ),
              array(
                'id'      => 'rb_caption',
                'label'   => 'Caption',
                'std'     => '',
                'type'    => 'upload',
                'class'   => ''
                )

            )),

          /* Link type */

          array(
            'id'          => 'rb_meta_box_post_assets_l',
            'label'       => 'Link',
            'desc'        => 'If this is an <strong>link post</strong>, just paste your link inside here.',
            'std'         => '',
            'type'        => 'text',
            'class'       => '',
            ),

          /* Image type */

          array(
            'id'          => 'rb_meta_box_post_assets_i',
            'label'       => 'Image',
            'desc'        => 'If this is an <strong>image post</strong>, you should upload an image in this filed.',
            'std'         => '',
            'type'        => 'upload',
            'class'       => '',
            ),

          /* Quote type */

          array(
            'id'          => 'rb_meta_box_post_assets_q_desc',
            'label'       => 'Quote',
            'desc'        => 'If this is an <strong>quote post</strong>, configure it in the fields below.',
            'std'         => '',
            'type'        => 'textblock-titled',
            'class'       => '',
            ),

          array(
            'id'          => 'rb_meta_box_post_assets_q_1',
            'label'       => 'Quote - Content',
            'desc'        => '',
            'std'         => '',
            'type'        => 'textarea',
            'class'       => '',
            ),

          array(
            'id'          => 'rb_meta_box_post_assets_q_2',
            'label'       => 'Quote - Source',
            'desc'        => '',
            'std'         => '',
            'type'        => 'text',
            'class'       => '',
            ),

          /* Video type */

          array(
            'id'      => 'rb_meta_box_post_assets_desc',
            'label'   => 'Video',
            'desc'    => 'If this is a <strong>video post</strong>, use the following fileds to configure it. You can either have a self hosted video(based on mp4 and ogv files) or an embedded one(via iframe).',
            'std'     => '',
            'type'    => 'textblock-titled',
            'class'   => '',
            'choices' => array()
          ),

          /* Embedded video type */

          array(
            'id'      => 'rb_meta_box_post_assets_ev',
            'label'   => 'Embedded Video',
            'desc'    => 'Paste the video embedding code inside this field.',
            'std'     => '',
            'type'    => 'textarea',
            'class'   => '',
            'choices' => array()
          ),

          /* Self hosted video type */

          array(
            'id'      => 'rb_meta_box_post_assets_sv1',
            'label'   => 'Self Hosted Video - MP4',
            'desc'    => 'Upload an .mp4 video file or paste a link to one.',
            'std'     => '',
            'type'    => 'upload',
            'class'   => '',
            'choices' => array()
          ),

          array(
            'id'      => 'rb_meta_box_post_assets_sv2',
            'label'   => 'Self Hosted Video - OGV',
            'desc'    => 'Upload an .ogv video file or paste a link to one.',
            'std'     => '',
            'type'    => 'upload',
            'class'   => '',
            'choices' => array()
          ),

          array(
            'id'      => 'rb_meta_box_post_assets_sv3',
            'label'   => 'Self Hosted Video - Poster',
            'desc'    => 'Upload a poster image for the player or paste a link to one.',
            'std'     => '',
            'type'    => 'upload',
            'class'   => '',
            'choices' => array()
          ),


          /* Audio type */

          array(
            'id'      => 'rb_meta_box_post_assets_a',
            'label'   => 'Audio',
            'desc'    => 'If this is an <strong>audio post</strong>, you sould upload an mp3 file in this field.',
            'std'     => '',
            'type'    => 'upload',
            'class'   => '',
            'choices' => array()
          )

      )
    );

/*---------------------------------
    PROJECT - Media Setup
------------------------------------*/

  $rb_meta_box_home = array(
    'id'        => 'rb_meta_box_home',
    'title'     => 'Project Options',
    'desc'      => '',
    'pages'     => array('portfolio'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
        'id'          => 'rb_folio_slider',
        'label'       => 'Embed a video or upload a large image to display on your project page', /* 'Slider Set-up'  */
        'desc'        => 'This is a slider which supports both images & videos. Please make sure that all of your images/videos share the same size! And don\'t forget about <strong>double sizes</strong> for retina displays',
        'std'         => '',
        'type'        => 'list-item',
        'class'       => 'rb_slider',
        'settings'    => array(

          /* Image type */

          array(
            'id'      => 'rb_slide_image',
            'label'   => 'Image',
            'desc'    => 'If you have a video, ignore this field. If you do not have a video, please upload a large image (width = 700px) or a group of images that will rotate on your project page.',
            'std'     => '',
            'type'    => 'upload',
            'class'   => 'rb_slide_image',
            'choices' => array()
          ),
          array(
            'id'      => 'rb_slide_caption',
            'label'   => 'Caption',
            'desc'    => 'Write a short caption for the current image.',
            'std'     => '',
            'type'    => 'text',
            'class'   => 'rb_slide_image',
            'choices' => array()
          ),

          /* Embedded video type */

          array(
            'id'      => 'rb_slide_video_code',
            'label'   => 'Video Code',
            'desc'    => 'Paste the video embedding code from vimeo into this field (width = 700, height = 393).',
            'std'     => '',
            'type'    => 'textarea',
            'class'   => 'rb_slide_emb',
            'choices' => array()
          ),

          /* Self hosted video type */

          array(
            'id'      => 'rb_slide_video_1',
            'label'   => 'MP4 File',
            'desc'    => 'Upload an .mp4 video file or paste a link to one.',
            'std'     => '',
            'type'    => 'upload',
            'class'   => 'rb_slide_hosted',
            'choices' => array()
          ),

      /*    array(
            'id'      => 'rb_slide_video_2',
            'label'   => 'OGV File',
            'desc'    => 'Upload an .ogv video file or paste a link to one.',
            'std'     => '',
            'type'    => 'upload',
            'class'   => 'rb_slide_hosted',
            'choices' => array()
          ),

          array(
            'id'      => 'rb_slide_video_3',
            'label'   => 'Poster File',
            'desc'    => 'Upload a poster image for the player or paste a link to one.',
            'std'     => '',
            'type'    => 'upload',
            'class'   => 'rb_slide_hosted',
            'choices' => array()
          )   */
        )
      )

    )
  );



/* default
  $rb_meta_box_home = array(
    'id'        => 'rb_meta_box_home',
    'title'     => 'Project Media',
    'desc'      => 'This field controls the <strong>media of the project</strong>. The galleries are managed via the basic WordPress gallery so it\'s easy for you to just drag & drop images into the library and create your gallery directly from here. If you want videos, when you upload a picture (which will be the video poster), you can also see fields for controlling the video. Just fill them as the instructions there and you\'ll have video slides.',
    'pages'     => array('portfolio'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(


        array(
          'label' => 'Gallery slider',
          'id' => 'pp_gallery_slider',
          'type' => 'gallery',
          'desc' => 'Click Create Slider to create your gallery for slider.',
          'post_type' => 'post'
          ),


        array(
          'label' => 'Old slider',
          'id' => 'old_slider_helper',
          'type' => 'textblock',
          'desc' => '',
          )

      )
  );

*/

/*---------------------------------
    SFW
------------------------------------*/

$rb_meta_box_slider2 = array(
    'id'        => 'rb_meta_box_slider2',
    'title'     => 'Slider Options',
    'desc'      => '',
    'pages'     => 'page',
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(
      array(
        'id'      => 'rb_slider_alias',
        'label'   => 'Slider Alias',
        'desc'    => 'Write the revolution slider <strong>SHORTCODE</strong> here.',
        'std'     => '',
        'type'    => 'text',
        'class'   => ''
      )
    )
);

/*---------------------------------
    ALL - Different Types of Sliders
------------------------------------*/

  $rb_meta_box_slider = array(
    'id'        => 'rb_meta_box_slider',
    'title'     => 'Slider Options',
    'desc'      => '',
    'pages'     => 'page',
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

      array(
        'id'          => 'rb_slider_skin',
        'label'       => 'Skin',
        'desc'        => '',
        'std'         => 'minimal-1',
        'type'        => 'select',
        'class'       => 'rb_slider',
        'choices'    => array(
                array(
                    'label' => 'Blank',
                    'value' => 'blank'
                ),
                array(
                    'label' => 'Minimal Skin #1',
                    'value' => 'minimal-1'
                ),
                array(
                    'label' => 'Minimal Skin #2',
                    'value' => 'minimal-2'
                ),
                array(
                    'label' => 'Complex Skin',
                    'value' => 'complex'
                ),
            )

        ),

      array(
        'id'          => 'rb_slider_rev_minimal',
        'label'       => 'Revolution slider id',
        'desc'        => 'The revolution slider already has it\'s own panel in which you can configure it however you like. This is only a place to write the slider\'s <strong>SHORTCODE</strong> here.',
        'std'         => '',
        'type'        => 'text',
        'class'       => 'rb_slider'
      ),

      array(
        'id'          => 'rb_slider_rev_complex',
        'label'       => 'Revolution slider addition',
        'desc'        => 'If you choose the a different skin than the blank one for the revolution slider you\'ll get a some place for captions or rich html.. This is the place to configure the captions/tabs/text for each item. The slides will be still taken from the slider you choose above, but the control bar will take it\'s values from here:<br /><br /><ul><li>Minimal #1 - Title</li><li>Minimal #2 - Title + Subtitle + Icon</li><li>Complex - Title + Rich caption</li></ul>',
        'std'         => '',
        'type'        => 'list-item',
        'class'       => 'rb_slider',
        'settings'    => array(

          array(
            'id'      => 'subtitle',
            'label'   => 'Subtitle',
            'desc'    => '',
            'std'     => '',
            'type'    => 'text',
            'class'   => '',
            'choices' => array()
          ),

          array(
            'id'      => 'icon',
            'label'   => 'Icon',
            'desc'    => 'Choose an icon from the list. To see the complete list of icons, <u>check this page</u>.',
            'std'     => '',
            'type'    => 'select',
            'class'   => '',
            'choices' => $icons_array
          ),

          array(
            'id'      => 'rich_html',
            'label'   => 'Rich caption',
            'desc'    => 'If you\'re using the complex skin, this is the place to write your rich html caption',
            'std'     => '',
            'type'    => 'textarea-simple',
            'class'   => ''
          )

        )
      ),


    )
  );

/*---------------------------------
    PRICING TABLES
------------------------------------*/

  $rb_meta_pricing_1 = array(
    'id'        => 'rb_meta_pricing',
    'title'     => 'Pricing Table',
    'desc'      => '',
    'pages'     => array( 'pricing'),
    'context'   => 'normal',
    'priority'  => 'high',
    'fields'    => array(

        array(
            'id'          => 'rb_meta_pricing_features',
            'label'       => 'Features',
            'desc'        => 'Setup the features of the pricing table. Each feature needs to be on a different line.',
            'std'         => '',
            'type'        => 'textarea',
            'class'       => ''
        ),

        array(
            'id'          => 'rb_meta_pricing_items',
            'label'       => 'Columns',
            'desc'        => 'These are the columns which will appear in the table. Each column has some options, such as a title, a subtitle, price, a place for a button, and a place for all the features.',
            'std'         => '',
            'type'        => 'list-item',
            'class'       => '',
            'settings'    => array(
              array(
                'id'      => 'subtitle',
                'label'   => 'Subtitle',
                'std'     => '',
                'type'    => 'text',
                'class'   => ''
                ),
              array(
                'id'      => 'price',
                'label'   => 'Price',
                'std'     => '',
                'type'    => 'text',
                'class'   => ''
                ),
              array(
                'id'      => 'features',
                'label'   => 'Features',
                'desc'    => 'Each feature needs to be on a new line(row). Even if the feature is not presented in the current column, you should have a blank space',
                'std'     => '',
                'type'    => 'textarea',
                'class'   => ''
                ),
              array(
                'id'      => 'button_label',
                'label'   => 'Button Label',
                'std'     => '',
                'type'    => 'text',
                'class'   => ''
                ),
              array(
                'id'      => 'button_link',
                'label'   => 'Button Link',
                'std'     => '',
                'type'    => 'text',
                'class'   => ''
                )

            )
        ),

        array(
            'id'          => 'rb_meta_pricing_featured',
            'label'       => 'Featured',
            'desc'        => 'Select the most wanted(featured) column(it should be the corresponding number of the column - starts from 0).',
            'std'         => '',
            'type'        => 'text',
            'class'       => ''
        )

      )
    );


    $rb_meta_pricing_2 = array(
        'id'        => 'rb_meta_pricing_info',
        'title'     => 'How to use',
        'desc'      => '',
        'pages'     => array( 'pricing'),
        'context'   => 'side',
        'priority'  => 'high',
        'fields'    => array(

            array(
                'id'          => 'rb_meta_pricing_info',
                'label'       => 'Shortcode',
                'desc'        => 'In order to use this pricing table, just paste the following shortcode into the page where you want to have the table: <br /><br /><code>[rb_pricing_table id="' . $_GET['post'] . '"]</code>',
                'std'         => '',
                'type'        => 'textarea',
                'class'       => ''
            )

        )
    );

    /*---------------------------------
        INIT METABOXES
    ------------------------------------*/

    $post_id = isset($_GET['post']) ? $_GET['post'] : (isset($_POST['post_ID']) ? $_POST['post_ID'] : 'no');
    $template_file = $post_id != 'no' ? get_post_meta($post_id,'_wp_page_template',TRUE) : 'no';

    if($template_file == 'template-blog-classic.php' || $template_file == 'template-blog-modern.php' || $template_file == 'template-slider.php'){
    } else {
        ot_register_meta_box($rb_meta_box_sidebar);
    }

    if($template_file == 'template-portfolio.php')
        ot_register_meta_box($rb_meta_box_portfolio);

    if($template_file == 'template-slider.php') {
        ot_register_meta_box($rb_meta_box_slider);
        ot_register_meta_box($rb_meta_box_title);
    }

    if($template_file == 'template-slider-full.php')
        ot_register_meta_box($rb_meta_box_slider2);

    if($template_file != 'template-slider.php' && $template_file != 'template-portfolio.php' && $template_file != 'template-blog-modern.php')
        ot_register_meta_box($rb_meta_box_tagline);

    ot_register_meta_box($rb_meta_box_post_assets);
    ot_register_meta_box($rb_meta_box_home);
    //ot_register_meta_box($rb_meta_pricing_1);
    //ot_register_meta_box($rb_meta_pricing_2);

}

?>