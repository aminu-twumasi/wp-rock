<?php
/*
*
* The default page template file
*
*/
get_header();
global $templateData;
?>
<div class="site-content">
	<?php if (have_posts()) : while (have_posts()) : the_post(); ?>
		<div class="centered-content">
			<?php the_content(); ?>
		</div>
	<?php endwhile; endif; ?>
</div>
<?php get_footer();