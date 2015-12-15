<?php

    /* Add Theme Support */

    define('WOOCOMMERCE_USE_CSS', false);
    add_theme_support('woocommerce');

    /* Remove Unwanted Actions */

    remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10);
    remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10);
    remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10);

    /* Reposition and Restyle the Breadcrumbs */
    
    function woocommerce_remove_breadcrumb(){
        remove_action('woocommerce_before_main_content', 'woocommerce_breadcrumb', 20);
    }
    add_action('woocommerce_before_main_content', 'woocommerce_remove_breadcrumb');
    function woocommerce_custom_breadcrumb(){
        woocommerce_breadcrumb();
    }
    add_action( 'rb_custom_breadcrumb', 'woocommerce_custom_breadcrumb' );

     function rb_woocommerce_breadcrumbs_style() {
        return array(
                'delimiter'   => ' <span>></span>',
                'wrap_before' => '<nav id="breadcrumb" class="woo' . ( get_option( 'rb_bread', 'false' ) != 'true' ? ' hidden' : '' ) . '" itemprop="breadcrumb">',
                'wrap_after'  => '</nav>',
                'before'      => '',
                'after'       => '',
                'home'        => '<i class="krown-icon-home"></i>'
            );
    }
    add_filter( 'woocommerce_breadcrumb_defaults', 'rb_woocommerce_breadcrumbs_style' );

    function rb_blank_title(){
        return '';
    }
    add_filter('woocommerce_my_account_my_orders_title', 'rb_blank_title');
    add_filter('woocommerce_my_account_my_address_title', 'rb_blank_title');

    /* Product Title */

    function rb_woo_before_item_title(){
        echo '<div class="caption">';
    }
    function rb_woo_after_item_title(){
        echo '</div>';
    }
    function rb_woo_after_item_link(){
        echo '<a class="view_button button" href="' . get_permalink() . '">View Item</a>';
    }

    add_filter( 'woocommerce_before_shop_loop_item_title', 'rb_woo_before_item_title' );
    add_filter( 'woocommerce_after_shop_loop_item_title', 'rb_woo_after_item_title' );
    add_filter( 'woocommerce_after_shop_loop_item', 'rb_woo_after_item_link' );

    /* Add Rating */

    function rb_woo_rating(){

        global $wpdb;
        global $post;

        $count = $wpdb->get_var("
            SELECT COUNT(meta_value) FROM $wpdb->commentmeta
            LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
            WHERE meta_key = 'rating'
            AND comment_post_ID = $post->ID
            AND comment_approved = '1'
            AND meta_value > 0
        ");

        $rating = $wpdb->get_var("
            SELECT SUM(meta_value) FROM $wpdb->commentmeta
            LEFT JOIN $wpdb->comments ON $wpdb->commentmeta.comment_id = $wpdb->comments.comment_ID
            WHERE meta_key = 'rating'
            AND comment_post_ID = $post->ID
            AND comment_approved = '1'
        ");

        if(!($count == 0 || $rating == 0))
            $average = ceil(number_format($rating / $count, 2));
        else 
            $average = 0;

        echo '<div itemprop="reviewRating" itemscope itemtype="http://schema.org/Rating" class="star-rating clearfix" title="' . sprintf(__( 'Rated %d out of 5', 'woocommerce' ), $average) . '">';
        for($i = 1; $i <= 5; $i++){
            if($i <= $average)
                echo '<b class="star"></b>';
            else
                echo '<b class="no-star"></b>';
        }
        echo '</div>';
        
    }

    if(get_option('woocommerce_enable_review_rating') == 'yes')
        add_filter('woocommerce_single_product_summary', 'rb_woo_rating', 15);

    /* Set Thumbnail Size */

    global $pagenow;

    if (is_admin() && isset($_GET['activated']) && $pagenow == 'themes.php') 
        add_action('init', 'rb_woocommerce_image_dimensions', 1);

    function rb_woocommerce_image_dimensions() {
        $thumbnail = array(
            'width' => '65',  
            'height'    => '65',  
            'crop'  => 1 
        ); 
        $catalog = array(
            'width' => '220', 
            'height'    => '175',  
            'crop'  => 1 
        );  
        update_option('shop_catalog_image_size', $catalog); 
        update_option('shop_thumbnail_image_size', $thumbnail);
    }

?>
