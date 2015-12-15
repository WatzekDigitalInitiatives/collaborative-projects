<?php

/**
Option Tree, to be added eventuall from parent theme (JM, 4/7/14)
*/
 
 // Required: set 'ot_child_theme_mode' filter to true.
//add_filter( 'ot_child_theme_mode', '__return_true' );
 

/* this addresses a bug w/ white text in visual composer textarea  */ 
function tinymce_black_text() {
   echo '<style type="text/css">
           .js .tmce-active .wp-editor-area{color: #000000!important}
           </style>';
}
add_action('admin_head', 'tinymce_black_text'); 

function edit_title_placeholder(){
	?>
	<script>
		jQuery( document ).ready(function() {
			jQuery("label#title-prompt-text").html("Enter the title of your research project here");
		});
	</script>
	<?php
}
add_action('admin_head', 'edit_title_placeholder');

function hide_revslider_metabox(){
	?>
	<script>
		jQuery( document ).ready(function() {
			jQuery("#mymetabox_revslider_0").hide();
		});
	</script>
	<?php

}
add_action('admin_head', 'hide_revslider_metabox');
 
 /* Allows iframes in posts: */
 /* http://ecolosites.eelv.fr/how-to-finally-allow-iframes-in-wordpress-or-any-other-tag/ */

add_filter( 'wp_kses_allowed_html', 'esw_author_cap_filter',1,1 );

function esw_author_cap_filter( $allowedposttags ) {

//Here put your conditions, depending your context

if ( !current_user_can( 'publish_posts' ) )
return $allowedposttags;

// Here add tags and attributes you want to allow

$allowedposttags['iframe']=array(

'align' => true,
'width' => true,
'height' => true,
'frameborder' => true,
'name' => true,
'src' => true,
'id' => true,
'class' => true,
'style' => true,
'scrolling' => true,
'marginwidth' => true,
'marginheight' => true,

);
return $allowedposttags;

}

/* end iframes in posts */
 
 
 
/**
 * Create Metaboxes
 *
 * @link http://www.billerickson.net/wordpress-metaboxes/
 * @param array
 * @return array
 *
 */
function be_create_metaboxes( $meta_boxes ) {
	$meta_boxes[] = array(
    	'id' => 'rotator-options',
	    'title' => 'Project Fields', 
	    'pages' => array('portfolio'), 
		'context' => 'normal',
		'priority' => 'low',
		'show_names' => true, 
		'fields' => array(
		/*	array(
				'name' => 'Required Fields',
				'desc' => 'Please enter the information below',
				'type' => 'title',
			),   */


            array(
				'name' => 'Research Question', 
	            'desc' => '',
            	'id' => 'wdi_research_question',
            	'type' => 'text',
            	//'attributes'=>array('maxlength'=>140)
            	
			),
			array(
				'name' => 'Project Abstract: Enter your abstract here (150 - 250 words)', 
            	'id' => 'wdi_project_abstract',
            	'type' => 'wysiwyg',
                
            	
			),			
		/*	array(
				'name' => 'Optional Fields',
				'desc' => 'You are welcome to add the supporting information below',
				'type' => 'title',
			),  */
            array(
                'name' => 'Blank Canvas: This is an open canvas area for additional text, images, charts, videos, etc. about your project', 
                'id' => 'wdi_canvas',
                'type' => 'wysiwyg',
                //'type' => 'textarea_code'
                
            ),
			array(
    			'name' => 'Upload supporting files here (pdf, txt, csv, excel, etc.) Upload as many supporting files as you like.',
    			'desc' => '',
    			'id' => 'wdi_file_list',
    			'type' => 'file_list',
			),


 /* 
			array(
    			'name' => 'Additional Links',
    			'desc' => 'To add a link, please follow these instructions:<ul><li>--use the format &lt;a href=\'URL\'&gt;LINKTEXT&lt;/a&gt; </li><li>--change URL to the actual URL, and change LINKTEXT to the text displaying the link</li><li>--example: &lt;a href=\'http://www.onlinecharttool.com/\'&gt;Charts and Graphs&lt;/a&gt;. This will display as <a href=\'http://www.onlinecharttool.com/\'>Charts and Graphs</a></li></ul>',
    			
    			'id' => 'wdi_test_text',

    			'type' => 'text',
    			'repeatable'=>true

			),

 */


			array(
				'name' => 'Link 1: Add a link to a supporting or related web site.', 

            	'id' => 'wdi_project_link1',
            	'type' => 'wysiwyg',
            	'options' => array('textarea_rows' => 1)

			),
			array(
				'name' => 'Link 2: Add a link to a supporting or related web site.', 

            	'id' => 'wdi_project_link2',
            	'type' => 'wysiwyg',
            	'options' => array('textarea_rows' => 1)

			),
			array(
				'name' => 'Link 3: Add a link to a supporting or related web site.', 

            	'id' => 'wdi_project_link3',
            	'type' => 'wysiwyg',
            	'options' => array('textarea_rows' => 1)
            	
			),
			array(
				'name' => 'Link 4: Add a link to a supporting or related web site.', 
	            
            	'id' => 'wdi_project_link4',
            	'type' => 'wysiwyg',
            	'options' => array('textarea_rows' => 1)
            	
			), 


		),
	);
	
	return $meta_boxes;
 }
add_filter( 'cmb_meta_boxes' , 'be_create_metaboxes' );
 
/**
 * Initialize Metabox Class
 * see /lib/metabox/example-functions.php for more information
 *
 */ 
 

function be_initialize_cmb_meta_boxes() {
    if ( !class_exists( 'cmb_Meta_Box' ) ) {
        require_once( 'lib/metabox/init.php' );
    }
}
add_action( 'init', 'be_initialize_cmb_meta_boxes', 9999 );



function custom_admin_js() {
    $url = get_option('siteurl');
    $url = get_bloginfo('template_directory') . '-child/admin.js';
    echo '"<script type="text/javascript" src="'. $url . '"></script>"';
}
add_action('admin_footer', 'custom_admin_js');




add_filter( 'admin_post_thumbnail_html', 'add_featured_image_instruction');
function add_featured_image_instruction( $content ) {
    return $content .= '<p>The Featured Image is a thumbnail image used on the home page and in the "Projects" page. Click the link above to add or change the image for this post. </p>';
}

// this function initializes the iframe elements 

function getSubnet(){

    $remote=$_SERVER ["REMOTE_ADDR"];
    $x=explode(".",$remote);  
    if ($x[0]=="149" && $x[1]=="175" && $x[2]=="20"){$user="staff";}
    else{$user="public";}
    return $user;


}

?>