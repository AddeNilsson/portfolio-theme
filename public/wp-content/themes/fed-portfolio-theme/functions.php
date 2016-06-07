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

?>