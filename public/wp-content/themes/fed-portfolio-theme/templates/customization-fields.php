<?php
global $post;
?>
	<h3>Landing info</h3>

		<label for="user_name">Portfolio holders name</label><br>
		<input id="user_name" type="text" name="user_name" required value="<?php echo get_post_meta($post->ID, 'user_name', true) ?>" /><br>


		<label for="user_title">Portfolio holders title</label><br>
		<input id="user_title" type="text" name="user_title" required value="<?php echo get_post_meta($post->ID, 'user_title', true) ?>" /><br>
<hr>

	<h3>About info</h3>

		<label for="user-about">Add som text about yourself</label><br>
		<textarea id="user-about" name="user-about" maxlength="850" cols="50" rows="15"><?php echo get_post_meta($post->ID, 'user-about', true) ?></textarea>
<hr>
	<h3>Add your skills</h3>

		<label for="skill-heading">Add a heading for your skills</label><br>
		<input id="skill-heading" type="text" name="skill-heading" value="<?php echo get_post_meta($post->ID, 'skill-heading', true) ?>" /><br>
<hr>
		<label for="skill-1">Add a skill</label><br>
		<input id="skill-1" type="text" name="skill-1" value="<?php echo get_post_meta($post->ID, 'skill-1', true) ?>" /><br>

		<label for="master-1">Add mastering percentage for skill</label><br>
		<input id="master-1" type="number" max="100" min="0" name="master-1" value="<?php echo get_post_meta($post->ID, 'master-1', true) ?>" /><br>

		<label for="skill-2">Add a second skill</label><br>
		<input id="skill-2" type="text" name="skill-2" value="<?php echo get_post_meta($post->ID, 'skill-2', true) ?>" /><br>

		<label for="master-2">Add mastering percentage for skill</label><br>
		<input id="master-2" type="number" max="100" min="0" name="master-2" value="<?php echo get_post_meta($post->ID, 'master-2', true) ?>" /><br>

		<label for="skill-3">Add a third skill</label><br>
		<input id="skill-3" type="text" name="skill-3" value="<?php echo get_post_meta($post->ID, 'skill-3', true) ?>" /><br>

		<label for="master-3">Add mastering percentage for skill</label><br>
		<input id="master-3" type="number" max="100" min="0" name="master-3" value="<?php echo get_post_meta($post->ID, 'master-3', true) ?>" /><br>

		<label for="skill-4">Add a fouth skill</label><br>
		<input id="skill-4" type="text" name="skill-4" value="<?php echo get_post_meta($post->ID, 'skill-4', true) ?>" /><br>

		<label for="master-4">Add mastering percentage for skill</label><br>
		<input id="master-4" type="number" max="100" min="0" name="master-4" value="<?php echo get_post_meta($post->ID, 'master-4', true) ?>" /><br>







