<?php while( have_posts() ) : the_post() ?>

<div class="row">

        <div class="medium-10 medium-centered column portfolio-post show-for-medium">
            <div class="row">
                <div class="medium-12 column">
                    <h2 class="text-center"><?php the_title() ?></h2>
                </div>
            </div>
            <?php if( !empty(get_post_meta($post->ID, 'project-url', true))) :  ?>

            <div class="row">
                <div class="medium-12 column">
                    <p class="text-right">Visit site: <a href="<?php echo get_post_meta($post->ID, 'project-url', true) ?>">Here</a></p>
                </div>
            </div>

            <?php endif ?>

            <div class="row">
                <div class="medium-12 large-7 column">
                    <?php the_content() ?>
                </div>
                <?php if( !empty(get_post_meta($post->ID, 'technologies', true))) :  ?>
                
                <div class="medium-12 large-5 column tech">
                    <h4>Technologies</h4>
                    <p><?php echo get_post_meta($post->ID, 'technologies', true) ?></p>
                </div>
                
                <?php endif ?>
            </div>
        </div>


        <div class="small-12 column portfolio-post show-for-small-only">
            <div class="row">
                <div class="small-12 column">
                    <h2 class=""><?php the_title() ?></h2>
                </div>
            </div>

            <?php if( !empty(get_post_meta($post->ID, 'project-url', true))) :  ?>

            <div class="row">
                <div class="small-12 column">
                    <p class="">Visit site: <a href="<?php echo get_post_meta($post->ID, 'project-url', true) ?>">Here</a></p>
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


