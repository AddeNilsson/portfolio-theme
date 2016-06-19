<?php while( have_posts() ) : the_post() ?>

<div class="row">
    <div class="medium-10 medium-centered column portfolio-post"><!--show-for-medium ?-->

        <?php if( !empty(get_post_meta($post->ID, 'project-title', true)) ) :  ?>
        <div class="row">
            <div class="medium-12 column">
                <h2 class="text-center"><?php echo get_post_meta($post->ID, 'project-title', true) ?></h2>
            </div>
        </div>
        <?php endif ?>

        <div class="row portfolio-post-info show-for-medium">

            <?php if( !empty( get_post_meta( $post->ID, 'project-description', true ) ) ) : ?>
            <div class="medium-12 large-7 column single-content"><!--show-for-medium ?-->
                <p><?php echo get_post_meta( $post->ID, 'project-description', true ) ?></p>
            </div>
            <?php endif ?>

            <div class=" small-10 medium-12 large-5 column portfolio-post-right-col">
                <div class="row"> <!-- hide-for-landscape om på mobil inte annars..? -->
                    <div class="medium-12">
                        <img class="responsive-img center-block" src="<?php echo get_template_directory_uri()?>/img/diamond-white.svg">
                    </div>
                </div>
                
                <?php if( !empty(get_post_meta($post->ID, 'project-url', true)) ) :  ?>
                <div class="row">
                    <div class="medium-12 column project-url">
                        <h5><a href="<?php echo get_post_meta($post->ID, 'project-url', true) ?>">To project!</a> <i class="fa fa-external-link"></i></h5>
                    </div>
                </div>
                <?php endif ?>

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

        <div class="row column portfolio-post-info show-for-small-only"> <!-- added column to this row -->
            <div class=" small-10 small-centered column portfolio-post-right-col"> <!-- small-10 -->
                <div class="row">
                    <div class="medium-12">
                        <img class="responsive-img center-block" src="<?php echo get_template_directory_uri()?>/img/diamond-white.svg">
                    </div>
                </div>
                
                <?php if( !empty(get_post_meta($post->ID, 'project-url', true)) ) :  ?>
                <div class="row">
                    <div class="medium-12 column project-url">
                        <h5><a href="<?php echo get_post_meta($post->ID, 'project-url', true) ?>">To project!</a> <i class="fa fa-external-link"></i></h5>
                    </div>
                </div>
                <?php endif ?>

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
</div>

<?php endwhile ?>


