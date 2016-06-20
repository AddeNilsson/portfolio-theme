<?php 

######################## Misc ##########################

/* Disable the Admin Bar. */
show_admin_bar(false);

/* Remove comment support */
function remove_comment_support() {
    remove_post_type_support( 'post', 'comments' );
    remove_post_type_support( 'page', 'comments' );
}
add_action('admin_menu', 'remove_comment_support');

/* Favicon */
function blog_favicon() {
	echo '<link rel="Shortcut Icon" type="image/x-icon" href="'.get_template_directory_uri().'/img/favicon.png" />';
}
add_action('wp_head', 'blog_favicon');

/* Image for login screen */
function login_logo() { ?>
    <style type="text/css">
        #login h1 a, .login h1 a {
            background-image: url(<?php echo get_stylesheet_directory_uri(); ?>/img/diamond-dark.svg);
            padding-bottom: 30px;
        }
    </style>
<?php }
add_action( 'login_enqueue_scripts', 'login_logo' );

######################## Scripts / Stylez ##########################

function fed_portfolio_scripts() {

	//Normalize
	wp_enqueue_style('normalize', '//cdnjs.cloudflare.com/ajax/libs/normalize/4.1.1/normalize.min.css');

	//Font-awesome
	wp_enqueue_style('font-awesome', "//maxcdn.bootstrapcdn.com/font-awesome/4.6.1/css/font-awesome.min.css");

	// Foundation CSS
	wp_enqueue_style('foundation-css', '//cdn.jsdelivr.net/foundation/6.2.1/foundation.min.css');

	// Theme stylesheet.
	wp_enqueue_style( 'fed-portfolio-style', get_template_directory_uri() . '/css/style.css', ['foundation-css', 'font-awesome'] );

	// jQuery -->
	wp_enqueue_script('jquery');
	wp_enqueue_script('browserDetect', get_template_directory_uri() . '/js/browserCheck.js', array(), false, false);

	// Green Sock
	wp_enqueue_script('tweenLite', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/TweenLite.min.js', array(), false, true);
	wp_enqueue_script('CSSPlugin', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/plugins/CSSPlugin.min.js', [], false, true);
	wp_enqueue_script('TimelineLite', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.17.0/TimelineLite.min.js', [], false, true);
	wp_enqueue_script('EasePackPlugin', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.5/easing/EasePack.min.js', [], false, true);
	wp_enqueue_script('ScrollToPlugin', '//cdnjs.cloudflare.com/ajax/libs/gsap/1.18.4/plugins/ScrollToPlugin.min.js', [], false, true);

	// Foundation
	wp_enqueue_script('foundation-js', '//cdn.jsdelivr.net/foundation/6.2.1/foundation.min.js', [], false, true);

	//Scroll Magic
	wp_enqueue_script('scroll-magic', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/ScrollMagic.js', [], false, true);
	// wp_enqueue_script('scroll-magic-debug-plug-in', '//cdnjs.cloudflare.com/ajax/libs/ScrollMagic/2.0.3/plugins/debug.addIndicators.js', [], false, true);


	//Fed-Portfolio Custom Script
	// wp_enqueue_script('Fed-Portfolio-Script', get_template_directory_uri() . '/js/scripts.min.js', ['jquery', 'tweenLite', 'CSSPlugin', 'TimelineLite'], false, true);

	wp_enqueue_script('Fed-Portfolio-Script', get_template_directory_uri() . '/src/js/build/scripts.js', ['jquery', 'tweenLite', 'CSSPlugin', 'TimelineLite'], false, true);
	wp_localize_script('Fed-Portfolio-Script', 'ajaxCall', ['ajaxUrl' => get_template_directory_uri() . '/single.php']);
}
add_action( 'wp_enqueue_scripts', 'fed_portfolio_scripts' );

######################## Theme menu Location ##########################

function menus() {
    register_nav_menus(['primary' => 'Animated left menu']);
}
add_action('after_setup_theme','menus');

######################## Theme menu ##########################

// Check if the menu exists
$default_menu = 'FED portfolio menu';
$default_menu_exists = wp_get_nav_menu_object( $default_menu );

// Create once if doesn't exists
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

######################## Portfolio CPT ##########################

function cpt_portfolio_init() {
    $labels = array(
        'name'                  => _x( 'Portfolios', 'Post type general name', 'fed-portfolio-theme' ),
        'singular_name'         => _x( 'Portfolio', 'Post type singular name', 'fed-portfolio-theme' ),
        'menu_name'             => _x( 'Portfolios', 'Admin Menu text', 'fed-portfolio-theme' ),
        'name_admin_bar'        => _x( 'Portfolio', 'Add New on Toolbar', 'fed-portfolio-theme' ),
        'add_new'               => __( 'Add New', 'fed-portfolio-theme' ),
        'add_new_item'          => __( 'Add New Portfolio', 'fed-portfolio-theme' ),
        'new_item'              => __( 'New Portfolio', 'fed-portfolio-theme' ),
        'edit_item'             => __( 'Edit Portfolio', 'fed-portfolio-theme' ),
        'view_item'             => __( 'View Portfolio', 'fed-portfolio-theme' ),
        'all_items'             => __( 'All Portfolios', 'fed-portfolio-theme' ),
        'search_items'          => __( 'Search Portfolios', 'fed-portfolio-theme' ),
        'parent_item_colon'     => __( 'Parent Portfolios:', 'fed-portfolio-theme' ),
        'not_found'             => __( 'No portfolios found.', 'fed-portfolio-theme' ),
        'not_found_in_trash'    => __( 'No portfolios found in Trash.', 'fed-portfolio-theme' ),
        'featured_image'        => _x( 'Portfolio Cover Image', 'Overrides the “Featured Image” phrase for this post type. Added in 4.3', 'fed-portfolio-theme' ),
        'set_featured_image'    => _x( 'Set cover image', 'Overrides the “Set featured image” phrase for this post type. Added in 4.3', 'fed-portfolio-theme' ),
        'remove_featured_image' => _x( 'Remove cover image', 'Overrides the “Remove featured image” phrase for this post type. Added in 4.3', 'fed-portfolio-theme' ),
        'use_featured_image'    => _x( 'Use as cover image', 'Overrides the “Use as featured image” phrase for this post type. Added in 4.3', 'fed-portfolio-theme' ),
        'archives'              => _x( 'Portfolio archives', 'The post type archive label used in nav menus. Default “Post Archives”. Added in 4.4', 'fed-portfolio-theme' ),
        'insert_into_item'      => _x( 'Insert into portfolio', 'Overrides the “Insert into post”/”Insert into page” phrase (used when inserting media into a post). Added in 4.4', 'fed-portfolio-theme' ),
        'uploaded_to_this_item' => _x( 'Uploaded to this portfolio', 'Overrides the “Uploaded to this post”/”Uploaded to this page” phrase (used when viewing media attached to a post). Added in 4.4', 'fed-portfolio-theme' ),
        'filter_items_list'     => _x( 'Filter portfolios list', 'Screen reader text for the filter links heading on the post type listing screen. Default “Filter posts list”/”Filter pages list”. Added in 4.4', 'fed-portfolio-theme' ),
        'items_list_navigation' => _x( 'Portfolios list navigation', 'Screen reader text for the pagination heading on the post type listing screen. Default “Posts list navigation”/”Pages list navigation”. Added in 4.4', 'fed-portfolio-theme' ),
        'items_list'            => _x( 'Portfolios list', 'Screen reader text for the items list heading on the post type listing screen. Default “Posts list”/”Pages list”. Added in 4.4', 'fed-portfolio-theme' ),
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
        'supports'           => array('title', 'thumbnail'),
        'register_meta_box_cb' => 'add_portfolio_item_metabox'

    );
 
    register_post_type( 'portfolio', $args );
}
add_action( 'init', 'cpt_portfolio_init' );
add_theme_support( 'post-thumbnails', array( 'portfolio' ) );

######################## Meta fields for Portfolio ##########################

function add_portfolio_item_metabox() {
    add_meta_box('portfolio_item__meta', 'Portfolio Item Info', 'portfolio_item_meta_fields', 'portfolio', 'normal', 'high');
}

function portfolio_item_meta_fields() {
    get_template_part('templates/portfolio', 'fields');
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
add_action( 'save_post', 'save_portfolio_item_meta', 1, 2 );

######################## Meta fields for Landing Page Template ##########################

function add_portfolio_meta() {
    global $post;

    if(!empty($post)) {
        $pageTemplate = get_post_meta( $post->ID, '_wp_page_template', true );

        if($pageTemplate == 'front-page.php' ) {
            add_meta_box( 'portfolio_meta', 'Portfolio Customization', 'display_portfolio_customization', 'page', 'normal', 'high' );
   			remove_post_type_support( 'page', 'editor' );

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

######################## Custom User Info fields ##########################

function add_contact_methods($profile_fields) {
    $profile_fields['github'] = 'Github';
    $profile_fields['twitter'] = 'Twitter Url';
    $profile_fields['facebook'] = 'Facebook URL';
    $profile_fields['phone'] = 'Phonenumber';

    return $profile_fields;
}
add_filter('user_contactmethods', 'add_contact_methods');