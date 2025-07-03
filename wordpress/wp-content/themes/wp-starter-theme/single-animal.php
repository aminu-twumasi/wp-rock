<?php
/*
*
* The default index template file
*
*/
get_header();
global $templateData;
?>
<div class="site-content"></div>
    <div <?php post_class('animal__wrapper'); ?>>
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>

            <div class="animal-content">
                <?php the_content(); ?>
                <p>Age: <?php the_field('age'); ?> years old</p>
                <p>Weight: <?php the_field('weight'); ?></p>
                <p>Length/Height: <?php the_field('size'); ?></p>
                <p>Fun Fact: <?php the_field('fun_facts'); ?></p>
                <!-- Add more fields as needed -->
            </div>

            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</div>
<?php get_footer();