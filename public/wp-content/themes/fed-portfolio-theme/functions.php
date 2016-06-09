<?php 
function fed_portfolio_scripts() {
/* Stylez */

	//Normalize
	wp_enqueue_style('normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/4.1.1/normalize.min.css');

	// Foundation CSS
	wp_enqueue_style('foundation-css', 'https://cdn.jsdelivr.net/foundation/6.2.1/foundation.min.css');

	// Theme stylesheet.
	wp_enqueue_style( 'fed-portfolio-style', get_template_directory_uri() . '/css/style.css', ['foundation-css'] );

/* Scripts */

	// jQuery -->
	wp_enqueue_script('jquery');

	// Green Sock
	wp_enqueue_script('tweenLite', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/TweenLite.min.js', array(), false, true);
	wp_enqueue_script('CSSPlugin', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/plugins/CSSPlugin.min.js', [], false, true);
	wp_enqueue_script('TimelineLite', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TimelineLite.min.js', [], false, true);

	// Foundation
	wp_enqueue_script('foundation-js', 'https://cdn.jsdelivr.net/foundation/6.2.1/foundation.min.js', [], false, true);

	//Fed-Portfolio Custom Script
	wp_enqueue_script('Fed-Portfolio-Script', get_template_directory_uri() . '/js/scripts.min.js', ['jquery', 'tweenLite', 'CSSPlugin', 'TimelineLite'], false, true);

	wp_localize_script('Fed-Portfolio-Script', 'ajaxCall', ['ajaxUrl' => get_template_directory_uri() . '/single.php']);


}

add_action( 'wp_enqueue_scripts', 'fed_portfolio_scripts' );

function menus() {
    register_nav_menus(['primary' => 'Animated left menu']);
}
add_action('after_setup_theme','menus');


## Custom post type ##

function cpt_portfolio_init() {
    $labels = array(
        'name'                  => _x( 'Portfolios', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Portfolio', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Portfolios', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Portfolio', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Portfolio', 'textdomain' ),
        'new_item'              => __( 'New Portfolio', 'textdomain' ),
        'edit_item'             => __( 'Edit Portfolio', 'textdomain' ),
        'view_item'             => __( 'View Portfolio', 'textdomain' ),
        'all_items'             => __( 'All Portfolios', 'textdomain' ),
        'search_items'          => __( 'Search Portfolios', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Portfolios:', 'textdomain' ),
        'not_found'             => __( 'No portfolios found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No portfolios found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Portfolio Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Portfolio archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into portfolio', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this portfolio', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter portfolios list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Portfolios list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Portfolios list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => null,
        'menu_icon'			 => 'dashicons-welcome-view-site',
        'supports'           => array(),
    );
 
    register_post_type( 'portfolio', $args );
}
 
add_action( 'init', 'cpt_portfolio_init' );


## Meta ##

add_action('add_meta_boxes', 'add_product_meta');
function add_product_meta()
{
    global $post;

    if(!empty($post))
    {
        $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

        if($pageTemplate == 'front-page.php' )
        {
            add_meta_box(
                'product_meta', // $id
                'Portfolio Customization', // $title
                'display_portfolio_customization', // $callback
                'page', // $page
                'normal', // $context
                'high'); // $priority
        }
    }
}

function display_portfolio_customization() {

    get_template_part('templates/customization', 'fields');
}

function save_portfolio_customization($post_id, $post) {
    $portfolio_meta['user_name'] = $_POST['user_name'];
    $portfolio_meta['user_title'] = $_POST['user_title'];

    //$portfolio_meta['user_portrait'] = $_POST['user_portrait'];


    foreach($portfolio_meta as $key => $value){
        if(get_post_meta($post->ID, $key, FALSE)){
            update_post_meta($post->ID, $key, $value); 
        }
        else {
            add_post_meta($post->ID, $key, $value);
        }
    }
}
add_action('save_post', 'save_portfolio_customization',1,2);
