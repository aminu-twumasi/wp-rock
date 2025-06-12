<?php
/*
*
* The default index template file
*
*/
get_header();
global $templateData;
?>
<div <?php post_class('page__wrapper'); ?>>
	<?php if (have_posts()) : ?>
		<?php while (have_posts()) : the_post(); ?>

			<?php the_content(); ?>

		<?php endwhile; ?>
	<?php endif; ?>
</div>
<?php get_footer();