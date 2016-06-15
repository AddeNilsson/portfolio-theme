<?php while( have_posts() ) : the_post() ?>
	
	<!-- <div class="small-7 column text-center"> -->
    <div class="small-8 small-push-2 column text-center portfolio-post">

		<h2><?php the_title() ?></h2>

		<p>Visit site: <a href="#">Here</a></p>

		<?php the_content() ?>

	</div>

<?php endwhile ?>


