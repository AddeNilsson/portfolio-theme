<?php while( have_posts() ) : the_post() ?>

<div class="row">

        <div class="medium-10 medium-centered column portfolio-post show-for-medium">
            <div class="row">
                <div class="medium-12 column">
                    <h2 class="text-center"><?php the_title() ?></h2>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 column">
                    <p class="text-right">Visit site: <a href="#">Here</a></p>
                </div>
            </div>
            <div class="row">
                <div class="medium-12 large-7 column">
                    <?php the_content() ?>
                </div>

                <div class="medium-12 large-5 column tech">
                    <p>Technologies: PHP, HTML, CSS, JavaScript</p>
                </div>
            </div>
        </div>


        <div class="small-12 column portfolio-post show-for-small-only">
            <div class="row">
                <div class="small-12 column">
                    <h2 class=""><?php the_title() ?></h2>
                </div>
            </div>

            <div class="row">
                <div class="small-12 column">
                    <p class="">Visit site: <a href="#">Here</a></p>
                </div>
            </div>        
        </div>
</div>

<?php endwhile ?>


