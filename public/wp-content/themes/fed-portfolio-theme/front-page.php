<?php
/*
Template name: Landing-page
*/

get_header() ?>

				<div id="head" class="row landing"> <!-- alt. row -->
					<div class="small-12 column">
						<div class="row">
							<div class="small-12 column">
								<div id="menu-toggle" class="menu-toggle"><i class="fa fa-bars"></i></div>
							</div>
						</div>
						<div class="row profile">
							<div class="small-12 column">
								<div class="row">
									<div id="user-portrait" class="small-6 medium-4 large-2 column small-centered">
										<?php 
										   echo get_avatar( get_bloginfo('admin_email'), $size = '512' ); 
										?>
									</div>
								</div>
								<div class="row">
									<div class="small-12 medium-6 column medium-centered">
										<h1 class="text-center"><?php echo get_post_meta($post->ID, 'user_name', true) ?></h1>
									</div>
								</div>
								<div class="row">
									<div class="small-12 medium-6 column medium-centered">
										<h3 class="text-center"><?php echo get_post_meta($post->ID, 'user_title', true) ?></h3>
									</div>
								</div>
							</div>
						</div>
						<div class="row">
							<div class="small-2 column small-centered">
								<div id="scroll-down" class="cc small-centered"><i class="fa fa-angle-double-down fa-3x"></i></div>
							</div>
						</div>
					</div>
				</div>

				<div id="about-anchor" class="row show-for-medium">
					<div class="small-12 column hr">
						<img src="<?php echo get_template_directory_uri()?>/img/hr-white.svg" alt="horizontal line">
					</div>
				</div>

				<div class="row">
					<div class="medium-8 column medium-centered about">
						<div class="row">
							<div class="medium-12 column">
								<h2>About me</h2>
							</div>
						</div>
						<div class="row">
							<div class="large-4 column">
								<p><?php echo get_post_meta($post->ID, 'user-about', true) ?></p>
							</div>
							<div class="large-8 column">
								<div class=" row">
									<div class="small-12 column">
										<h4><?php echo get_post_meta($post->ID, 'skill-heading', true) ?></h4>
									</div>
								</div>
								<div class="row">
									<div class="medium-6 large-3 column">
										<h3 class="text-center"><?php echo get_post_meta($post->ID, 'skill-1', true) ?></h3>
										<div class="demo" data-percent="<?php echo get_post_meta($post->ID, 'master-1', true) ?>"></div>
									</div>
									<div class="medium-6 large-3 column">
										<h3 class="text-center"><?php echo get_post_meta($post->ID, 'skill-2', true) ?></h3>
										<div class="demo" data-percent="<?php echo get_post_meta($post->ID, 'master-2', true) ?>"></div>
									</div>
									<div class="medium-6 large-3 column">
										<h3 class="text-center"><?php echo get_post_meta($post->ID, 'skill-3', true) ?></h3>
										<div class="demo" data-percent="<?php echo get_post_meta($post->ID, 'master-3', true) ?>"></div>
									</div>
									<div class="medium-6 large-3 column">
										<h3 class="text-center"><?php echo get_post_meta($post->ID, 'skill-4', true) ?></h3>
										<div class="demo" data-percent="<?php echo get_post_meta($post->ID, 'master-4', true) ?>"></div>
									</div>
								</div>
								<div class="row">
									<div class="small-12 column text-right repeat">
										<span id="repeat-skill-animation">Replay animation <i class="fa fa-repeat"></i></span>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>

				<div id="portfolio-anchor" class="row show-for-medium">
					<div class="small-12 column hr">
						<img src="<?php echo get_template_directory_uri()?>/img/hr-white.svg" alt="horizontal line">
					</div>
				</div>
			
				<div class="row">
					<div class="small-12 column">
						<div class="row">
							<div class="medium-10 large-8 column medium-centered portfolio">
							<h1>Portfolio</h1>
								<?php $portfolio = new WP_query(['post_type' => 'portfolio']);

								if( $portfolio->have_posts() ) : 

								 	while( $portfolio->have_posts() ) : $portfolio->the_post(); ?>

									<div class="row portfolio-item">
										<div class="small-6 column portfolio-item-listing show-for-large">
											<img src="<?php echo get_template_directory_uri() ?>/img/listing-white.svg">
										</div>
										<div class="small-12 large-3 column portfolio-item-link">
											<a class="custom-post-link" rel="<?php the_ID(); ?>" href="<?php the_permalink()?>">
												<div class="row">
													<div class="small-12 column">
															<i id="close-info" class="fa fa-times close-info"></i>
													</div>
												</div>
												<div class="small-12 column project-link-img">
													<div class="row">
														<div id="loading" class="small-12 column text-center loading"><i class="fa fa-spinner fa-4x"></i></div>
													</div>
													<img src="<?php echo get_template_directory_uri() ?>/img/diamond-white.svg" alt="White diamond shape">
												</div>
												<div class="project-link-text">
													<h4><?php the_title() ?></h4>
													<p>View project</p>
												</div>
											</a>
											<div class="row">
												<div class="small-12 column project-info"></div>
											</div>
										</div>
									</div>

									<?php 
									endwhile; 
								else : ?>
									<p><?php _e( 'Sorry, no posts matched your criteria.' ); ?></p>
								<?php endif;?>
							</div>
						</div>
					</div>
				</div>
<?php include 'footer.php' ?>
