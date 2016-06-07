<?php while( have_posts() ) : the_post() ?>
	
	<div class="small-7 column text-center">
		<h2><?php the_title() ?></h2>
		<p>Visit site: <a href="#">Here</a></p>
		<?php the_content() ?>
	</div>

<?php endwhile ?>