<?php include 'header.php' ?>
<h1 id="foo">Foo</h1>

			<div id="head" class="row landing"> <!-- alt. column row -->
				<div class="column">
					<div class="row">
						<div class="small-12">
							<div id="menu-toggle" class="menu-toggle centered"></div>
						</div>
					</div>

					<div class="row">
						<div class="small-12 medium-6 column medium-centered">
							<h1 class="text-center"><?php echo bloginfo('title') ?></h1>
						</div>
					</div>
					
					<div class="row">
						<div class="small-12 medium-6 column medium-centered">
							<h3 class="text-center">Front-End Developer</h3>
						</div>
					</div>

					<div class="row">
						<div class="small-1 column small-centered">
							<div class="scroll-arrow small-centered"></div>
						</div>
					</div>
				</div>
			</div>

<?php /*
			<div class="col-xs-12 front-page-area">
			<div class="row">
				<h1 class="text-center blue-back">Portfolios</h1>
				<?php
				// Loops our Portfolio custom post types
				$portfolio = new WP_query(['post_type' => 'portfolio-item']);

				if( $portfolio->have_posts() ) : 
					while( $portfolio->have_posts() ) : $portfolio->the_post() ;
				?>
						<div class="col-xs-6 portfolio">
							<img class="img-responsive center-block" src="<?php the_field('screenshot') ?>" />
							<a href="<?php the_permalink(); ?>">
								<h3 class="text-center"><?php the_title(); ?></h3>
								<p><?php the_content() ?></p>
							</a>
						</div>
					<?php 
					endwhile; 
				else : ?>
					<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
				<?php 
				endif;	
				?>
			</div>
*/ ?>

			<div class="row">
				<div class="medium-8 column medium-centered portfolio">

				<?php/* $portfolio = new WP_query(['post-type' => 'portfolio-item']);

				 if( $portfolio->have_posts() ) : 
				 	while( $portfolio->have_posts() ) : $portfolio->the_post();
				 ?>

					<div class="row portfolio-item">

						<div class="small-6 column portfolio-item-listing">
							<img src="<?php echo get_template_directory_uri() ?>/img/listing-white.svg">
						</div>

						<div id="item-2" class="small-3 column portfolio-item-link">

							<div id="close-info" class="close-info"></div>


							<div class="small-12 column project-link-img">
								<img src="<?php echo get_template_directory_uri() ?>/img/diamond-white.svg" alt="White diamond shape">
							</div>

							<div class="project-link-text">
								<h4><a href="<?php the_permalink()?>"><?php the_title() ?></a></h4>
								<span>view project</span>
							</div>

							<div class="project-info"></div>

							<a class="post-link" rel="<?php the_ID(); ?>" href="<?php the_permalink(); ?>">
 
						       <?php the_title(); ?> 
						 
						    </a>

						</div>
					</div>
					<?php 
					endwhile; 
					else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php 
					endif;
					*/?>
					<?php $portfolio = new WP_query(['post-type' => 'portfolio-item']);

				 if( $portfolio->have_posts() ) : 
				 	while( $portfolio->have_posts() ) : $portfolio->the_post();
				 ?>

					<div class="row portfolio-item">

						<div class="small-6 column portfolio-item-listing">
							<img src="<?php echo get_template_directory_uri() ?>/img/listing-white.svg">
						</div>

						<a id="item-2" class="small-3 column portfolio-item-link" rel="<?php the_ID(); ?>" href="<?php the_permalink(); ?>">

							<div id="close-info" class="close-info"></div>


							<div class="small-12 column project-link-img">
								<img src="<?php echo get_template_directory_uri() ?>/img/diamond-white.svg" alt="White diamond shape">
							</div>

<!-- <a class="post-link" rel="<?php //the_ID(); ?>" href="<?php //the_permalink(); ?>"> -->
							<div class="project-link-text">
					

								<h4><?php the_title() ?></h4>
								<span>view project</span>
							</div>
<!-- </a> -->

							<div class="project-info"></div>
						</a>

					</div>
					<?php 
					endwhile; 
					else : ?>
						<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
					<?php 
					endif;
					?>


				</div>
			</div>


<?php include 'footer.php' ?>