<?php
global $post;
?>

		<label for="user_name">Portfolio holders name</label><br>
		<input id="user_name" type="text" name="user_name" required value="<?php echo get_post_meta($post->ID, 'user_name', true) ?>" /><br>

		<label for="user_title">Portfolio holders title</label><br>
		<input id="user_title" type="text" name="user_title" required value="<?php echo get_post_meta($post->ID, 'user_title', true) ?>" /><br>

		<label for="user_portrait">Portfolio holders portrait picture</label><br>
		<input type="file" name="user_portrait" value="<?php echo get_post_meta($post->ID, 'user_portrait', true) ?>" />







