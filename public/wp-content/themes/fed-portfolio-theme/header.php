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
		<header id="slider" class="row side-menu-cnt">
		
			<div class="small-12 column">
				<div class="row">
					<div id="user-menu-portrait" class="small-6 medium-4 large-10 column small-centered menu-portrait">
						<?php 
						   echo get_avatar( get_bloginfo('admin_email'), $size = '512' ); 
						?>
					</div>
				</div>

				<div class="row">
					<div class="small-12 column menu">
				     	<?php
				     	$args = ['theme_location' => 'primary', 'menu_class' => 'main-menu', 'fallback_cb' => false]; //'items_wrap' => '%3$s'
							wp_nav_menu($args);
						?>
					</div>
				</div>
			</div>
		</header>

		<div id="wrapper" class="row">