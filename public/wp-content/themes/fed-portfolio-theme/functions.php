<?php 

/* Disable the Admin Bar. */
show_admin_bar(false);


function fed_portfolio_scripts() {
/* Stylez */

	//Normalize
	wp_enqueue_style('normalize', 'https://cdnjs.cloudflare.com/ajax/libs/normalize/4.1.1/normalize.min.css');

	//Font-awesome
	wp_enqueue_style('font-awesome', "https://maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css");

	// Foundation CSS
	wp_enqueue_style('foundation-css', 'https://cdn.jsdelivr.net/foundation/6.2.1/foundation.min.css');

	// Theme stylesheet.
	wp_enqueue_style( 'fed-portfolio-style', get_template_directory_uri() . '/css/style.css', ['foundation-css', 'font-awesome'] );

/* Scripts */

	// jQuery -->
	wp_enqueue_script('jquery');

	// Green Sock
	wp_enqueue_script('tweenLite', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/TweenLite.min.js', array(), false, true);
	wp_enqueue_script('CSSPlugin', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/plugins/CSSPlugin.min.js', [], false, true);
	wp_enqueue_script('TimelineLite', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TimelineLite.min.js', [], false, true);
	wp_enqueue_script('EasePackPlugin', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/easing/EasePack.min.js', [], false, true);

	wp_enqueue_script('ScrollToPlugin', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/plugins/ScrollToPlugin.min.js', [], false, true);

	// wp_enqueue_script('ScrollToPlugin', 'https://cdnjs.cloudflare.com/ajax/libs/jquery-scrollTo/2.1.2/jquery.scrollTo.min.js', [], false, true);



	// Foundation
	wp_enqueue_script('foundation-js', 'https://cdn.jsdelivr.net/foundation/6.2.1/foundation.min.js', [], false, true);

	//Scroll Magic
	wp_enqueue_script('scroll-magic', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/ScrollMagic.js', [], false, true);
	// wp_enqueue_script('scroll-magic-animation-plug-in', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/animation.gsap.js', [], false, true);
	wp_enqueue_script('scroll-magic-debug-plug-in', 'https://cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/debug.addIndicators.js', [], false, true);


	//Fed-Portfolio Custom Script
	// wp_enqueue_script('Fed-Portfolio-Script', get_template_directory_uri() . '/js/scripts.min.js', ['jquery', 'tweenLite', 'CSSPlugin', 'TimelineLite'], false, true);

	wp_enqueue_script('Fed-Portfolio-Script', get_template_directory_uri() . '/src/js/build/scripts.js', ['jquery', 'tweenLite', 'CSSPlugin', 'TimelineLite'], false, true);
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
        'supports'           => array('title'),
        'register_meta_box_cb' => 'add_portfolio_item_metabox'

    );
 
    register_post_type( 'portfolio', $args );
}
 
add_action( 'init', 'cpt_portfolio_init' );

## Meta ##

function add_portfolio_item_metabox() {
    add_meta_box('portfolio_item__meta', 'Portfolio Item Info', 'portfolio_item_meta_fields', 'portfolio', 'normal', 'high');
}
function portfolio_item_meta_fields() {
    // global $post;
    get_template_part('templates/portfolio', 'fields');
?>

 <?php    
}

function save_portfolio_item_meta($post_id, $post) {

	$portfolio_item_meta['project-title'] = sanitize_text_field($_POST['project-title']);
    $portfolio_item_meta['project-description'] = sanitize_text_field($_POST['project-description']);
    $portfolio_item_meta['technologies'] = sanitize_text_field($_POST['technologies']);
    $portfolio_item_meta['project-url'] = sanitize_text_field($_POST['project-url']);
    
    foreach($portfolio_item_meta as $key => $value){
        if(get_post_meta($post->ID, $key, FALSE)){
            update_post_meta($post->ID, $key, $value); 
        }
        else {
            add_post_meta($post->ID, $key, $value);
        }
    }
}
add_action('save_post', 'save_portfolio_item_meta',1,2);

function add_portfolio_meta() {
    global $post;

    if(!empty($post)) {
        $pageTemplate = get_post_meta($post->ID, '_wp_page_template', true);

        if($pageTemplate == 'front-page.php' ) {
            add_meta_box('portfolio_meta', 'Portfolio Customization', 'display_portfolio_customization', 'page', 'normal', 'high');
        }
    }
}

add_action('add_meta_boxes', 'add_portfolio_meta');

function display_portfolio_customization() {
    get_template_part('templates/customization', 'fields');
}

function save_portfolio_customization($post_id, $post) {

    $portfolio_meta['user_name'] = sanitize_text_field($_POST['user_name']);
    $portfolio_meta['user_title'] = sanitize_text_field($_POST['user_title']);

    $portfolio_meta['user-about'] = sanitize_text_field($_POST['user-about']);

    $portfolio_meta['skill-heading'] = sanitize_text_field($_POST['skill-heading']);

    $portfolio_meta['skill-1'] = sanitize_text_field($_POST['skill-1']);
    $portfolio_meta['master-1'] = sanitize_text_field($_POST['master-1']);

    $portfolio_meta['skill-2'] = sanitize_text_field($_POST['skill-2']);
    $portfolio_meta['master-2'] = sanitize_text_field($_POST['master-2']);

    $portfolio_meta['skill-3'] = sanitize_text_field($_POST['skill-3']);
    $portfolio_meta['master-3'] = sanitize_text_field($_POST['master-3']);

    $portfolio_meta['skill-4'] = sanitize_text_field($_POST['skill-4']);
    $portfolio_meta['master-4'] = sanitize_text_field($_POST['master-4']);


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

### Default nav menu ###

// Check if the menu exists
$default_menu = 'FED portfolio menu';
$default_menu_exists = wp_get_nav_menu_object( $default_menu );

// Create if doesn't exists Logged in menu
if( !$default_menu_exists){
    $menu_id = wp_create_nav_menu($default_menu);

        // Set up default menu items
    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Top'),
        'menu-item-classes' => 'home',
        'menu-item-url' => '#wrapper', 
        'menu-item-status' => 'publish'));

    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('About'),
        'menu-item-url' => '#about-anchor', 
        'menu-item-status' => 'publish'));
    wp_update_nav_menu_item($menu_id, 0, array(
        'menu-item-title' =>  __('Portfolio'),
        'menu-item-url' => '#portfolio-anchor', 
        'menu-item-status' => 'publish'));
}

## Custom user info ##
function add_contact_methods($profile_fields) {
    // Add new fields
    $profile_fields['github'] = 'Github';
    $profile_fields['twitter'] = 'Twitter Username';
    $profile_fields['facebook'] = 'Facebook URL';
    $profile_fields['phone'] = 'Phonenumber';

    return $profile_fields;
}

add_filter('user_contactmethods', 'add_contact_methods');