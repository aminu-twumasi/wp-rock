<?php

/**
 * The template for displaying search results pages
 */

get_header();
?>
<div class="page__wrapper template--search">
	<div class="container">
		<?php if(get_search_query()) : ?>
			<h1 class="h2">Search Results: <span><?php echo get_search_query(); ?></span></h1>
		<?php else : ?>
			<h1 class="h2">Search our site</h1>
		<?php endif; ?>
		<?php echo get_search_form(); ?>

		<?php if (get_search_query()) : ?>
			<div class="search-heading">
				<?php
				global $wp_query;
				if ($wp_query->found_posts == 1) {
					$result = "result";
				} else {
					$result = "results";
				}
				echo "<p>Your search for <strong>" . get_search_query() . "</strong> returned " . $wp_query->found_posts . " " . $result . ".</p>";

				if (function_exists('relevanssi_didyoumean')) {
					relevanssi_didyoumean(get_search_query(false), '<br/><br/>Did you mean: ', '', 5);
				}
				?>
			</div>
		<?php endif; ?>

		<?php if (have_posts()) : ?>

			<?php if (get_search_query()) : ?>
				<div class="search-results">
					<?php while (have_posts()) : the_post();
						$postType = get_post_type_object(get_post_type()); 
						$post_type_slug = get_post_type();
						$post_date = get_the_date();
						$post_excerpt = get_the_excerpt();
						?>

						<article id="post-<?php the_ID(); ?>" class="search-result" aria-label=" <?php echo the_title(); ?>">
							<div class="post-meta"><span class="post-type <?php echo $post_type_slug; ?>"><?php echo esc_html($postType->labels->singular_name); ?></span><span class="post-date"><?php echo $post_date; ?></span></div>
							<h1 class="search-result__title"><?php the_title(sprintf('<a href="%s" rel="bookmark">', esc_url(get_permalink())), '</a>'); ?></h1>
							<?php if($post_excerpt) : ?>
								<p class="search-result__excerpt"><?php echo $post_excerpt; ?></p>
							<?php endif; ?>
							<div class="search-result__button">
								<a href=" <?php the_permalink(); ?>" class="base-link arrow" aria-label=" View More: <?php echo the_title(); ?>">Read More</a>
							</div>
						</article>

					<?php endwhile; ?>
				</div>

				<div class="search-pagination">
					<?php
					$searchPages = $wp_query->max_num_pages;
					$theBigNumber = 999999999;
					$paginateSearchArgs = array(
						'base' => str_replace($theBigNumber, '%#%', esc_url(get_pagenum_link($theBigNumber))),
						'format' => '?page = %#%',
						'current' =>  max(1, get_query_var('paged')),
						'total' => $searchPages,
						'mid_size' => 1,
						'prev_text'          => __('« Prev'),
						'next_text'          => __('Next »'),
					);
					echo paginate_links($paginateSearchArgs);
					?>
				</div>
			<?php else : ?>
				<div class="search__results">
				</div>
			<?php endif; ?>
		<?php else : ?>
			<div class="search__results">
			</div>
		<?php endif; ?>


	</div>
</div>

<?php
get_footer();