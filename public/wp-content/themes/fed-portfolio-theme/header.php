<!DOCTYPE html>
<html>
	<head>
		<title><?php echo bloginfo('title') //echo get_the_title()?></title>
		<meta http-equiv="content-type" content="text/html;charset=UTF-8">
		<meta http-equiv="x-ua-compatible" content="ie=edge" />
		<meta name="viewport" content="width=device-width, initial-scale=1" />

		<?php wp_head() ?>
	</head>

	<body>
		<header id="slider" class="side-menu-cnt">
			<h1>Meny</h1>
			<!-- <ul>
				<li>Entry</li>
				<li>entry</li>
				<li>Entry</li>
			</ul> -->

			
		     	<?php 
		     	/* Gets content for primary menu. Uses items-wrap to remove <ul> tags. Sets fallback to false which will 
		     	allow admin to completely hide the menu by not adding any content to it */
		     	// $args = ['theme_location' => 'primary', 'items_wrap' => '%3$s', 'fallback_cb' => false];
		     	$args = ['theme_location' => 'primary', 'menu_class' => 'main-menu'];

					wp_nav_menu($args);

				?>
	      	
		</header>

		<div id="wrapper" class="row">