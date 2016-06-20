<?php global $post ?>   

<label for="project-title">Project Title</label><br> <input id="project-title" type="text" required name="project-title" maxlength="16" value="<?php echo get_post_meta($post->ID, 'project-title', true) ?>"><br>

<label for="project-description">Project Description</label><br> <textarea id="project-description" type="text" name="project-description" maxlength="400" cols="40" rows="10" value=""><?php echo get_post_meta($post->ID, 'project-description', true) ?></textarea><br>


<label for="tech-meta-box">Technologies</label><br> <input id="tech-meta-box" type="text" name="technologies" maxlength="60" value="<?php echo get_post_meta($post->ID, 'technologies', true) ?>"><br>

<label for="project-url">Url for project</label><br> <input id="project-url" type="text" name="project-url" value="<?php echo get_post_meta($post->ID, 'project-url', true) ?>">