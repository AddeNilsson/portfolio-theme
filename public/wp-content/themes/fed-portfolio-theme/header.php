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
					<div id="user-menu-portrait" class="small-6 medium-8 large-10 column small-centered menu-portrait">
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

				<div class="row text-center contact-field">
					<?php 
					$user_id = get_user_by('email', get_bloginfo('admin_email'))->ID;
					$user_data = get_userdata($user_id);
					?>
					
					<div class="small-3 column ">
						<a href="<?php echo $user_data->github?>"><i class="fa fa-github"></i></a>
					</div>
					<div class="small-3 column">
						<a href="<?php echo $user_data->facebook?>"><i class="fa fa-facebook-square"></i></a>
					</div>
					<div class="small-3 column">
						<a href="<?php echo $user_data->twitter?>"><i class="fa fa-twitter-square"></i></a>
					</div>
					<div class="small-3 column">
						<a href="mailto:<?php echo get_bloginfo('admin_email')?>"><i class="fa fa-envelope"></i></a>
					</div>

				</div>
			</div>

		</header>

		<div id="wrapper" class="row">
			<div class="small-12 column">