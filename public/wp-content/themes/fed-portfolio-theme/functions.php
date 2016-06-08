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


}

add_action( 'wp_enqueue_scripts', 'fed_portfolio_scripts' );

function cpt_portfolio_init() {
    $labels = array(
        'name'                  => _x( 'Portfolio-items', 'Post type general name', 'textdomain' ),
        'singular_name'         => _x( 'Portfolio-item', 'Post type singular name', 'textdomain' ),
        'menu_name'             => _x( 'Portfolio-items', 'Admin Menu text', 'textdomain' ),
        'name_admin_bar'        => _x( 'Portfolio-item', 'Add New on Toolbar', 'textdomain' ),
        'add_new'               => __( 'Add New', 'textdomain' ),
        'add_new_item'          => __( 'Add New Portfolio-item', 'textdomain' ),
        'new_item'              => __( 'New Portfolio-item', 'textdomain' ),
        'edit_item'             => __( 'Edit Portfolio-item', 'textdomain' ),
        'view_item'             => __( 'View Portfolio-item', 'textdomain' ),
        'all_items'             => __( 'All Portfolio-items', 'textdomain' ),
        'search_items'          => __( 'Search Portfolio-items', 'textdomain' ),
        'parent_item_colon'     => __( 'Parent Portfolio-items:', 'textdomain' ),
        'not_found'             => __( 'No portfolio-items found.', 'textdomain' ),
        'not_found_in_trash'    => __( 'No portfolio-items found in Trash.', 'textdomain' ),
        'featured_image'        => _x( 'Portfolio-item Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'textdomain' ),
        'archives'              => _x( 'Portfolio-item archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'textdomain' ),
        'insert_into_item'      => _x( 'Insert into portfolio-item', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'textdomain' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this portfolio-item', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'textdomain' ),
        'filter_items_list'     => _x( 'Filter portfolio-items list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'textdomain' ),
        'items_list_navigation' => _x( 'Portfolio-items list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'textdomain' ),
        'items_list'            => _x( 'Portfolio-items list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'textdomain' ),
    );
 
    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array( 'slug' => 'portfolio-item' ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => true,
        'menu_position'      => null,
        'menu_icon'			 => 'dashicons-welcome-view-site',
        'supports'           => array(),
    );
 
    register_post_type( 'portfolio-item', $args );
}
 
add_action( 'init', 'cpt_portfolio_init' );

?>