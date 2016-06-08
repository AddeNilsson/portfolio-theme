<?php //while( have_posts() ) : the_post() ?>

<?php/* $post = get_post($_POST['id']);
print_r($post) ?>

	
	<div class="small-7 column text-center">
		<h2><?php the_title() ?></h2>
		<p>Visit site: <a href="#">Here</a></p>
		<?php the_content() ?>
	</div>

<?php //endwhile */?>


<?php
 	print_r($_POST);
    $post = get_post($_POST['id']);
 
?>
    <div id="single-post post-<?php the_ID(); ?>">
 
    <?php while (have_posts()) : the_post(); ?>
 
                <?php the_title();?>
 
                <?php the_content();?>
 
    <?php endwhile;?> 
 
    </div>