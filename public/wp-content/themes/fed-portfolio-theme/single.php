<?php while( have_posts() ) : the_post() ?>

<div class="row">

        <div class="medium-10 medium-centered column portfolio-post show-for-medium">

            <?php if( !empty(get_post_meta($post->ID, 'project-title', true)) ) :  ?>
            <div class="row">
                <div class="medium-12 column">
                    <h2 class="text-center"><?php echo get_post_meta($post->ID, 'project-title', true) ?></h2>
                    <!-- <hr> -->
                </div>
            </div>
            <div class="column row">
                <hr>
            </div>
            <?php endif ?>

            

            


            <div class="row cc">

                <?php if( !empty( get_post_meta( $post->ID, 'project-description', true ) ) ) : ?>

                <div class="medium-12 large-7 column single-content">
                    <p><?php echo get_post_meta( $post->ID, 'project-description', true ) ?></p>
                </div>

                <?php endif ?>

                <div class="medium-12 large-5 column portfolio-post-right-col">
                    
                    <?php if( !empty(get_post_meta($post->ID, 'project-url', true)) ) :  ?>
                    <div class="row">
                        <div class="medium-12 column">
                            <h5><a class="text-center" href="<?php echo get_post_meta($post->ID, 'project-url', true) ?>">To project!</a> <i class="fa fa-external-link"></i></h5>
                        </div>
                    </div>
                    <?php endif ?>

                    <!-- <div class="column row">
                        <hr>
                    </div> -->


                    <?php if( !empty(get_post_meta($post->ID, 'technologies', true)) ) :  ?>
                    <div class="row">
                        <div class="medium-12 column tech">
                            <h5>Technologies</h5>
                            <p><?php echo get_post_meta($post->ID, 'technologies', true) ?></p>
                        </div>
                    </div>
                    <?php endif ?>  


                </div>

                

            </div>
        </div>


        <div class="small-12 column portfolio-post show-for-small-only">
            <div class="row">
                <div class="small-12 column">
                    <h2 class=""><?php the_title() ?></h2>
                </div>
            </div>

            <?php if( !empty(get_post_meta($post->ID, 'project-url', true)) ) :  ?>

            <div class="row">
                <div class="small-12 column">
                    <a href="<?php echo get_post_meta($post->ID, 'project-url', true) ?>">To project!</a>
                </div>
            </div>

            <?php endif ?> 

            <?php if( !empty(get_post_meta($post->ID, 'technologies', true))) :  ?>
                
            <div class="medium-12 large-5 column tech">
                <h4>Technologies</h4>
                <p><?php echo get_post_meta($post->ID, 'technologies', true) ?></p>
            </div>
            
            <?php endif ?>       
        </div>
</div>

<?php endwhile ?>


