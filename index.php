<?php get_header(); ?>

	<section>

		<main class="main">

			<?php while(have_posts()) : the_post(); ?>

				<article class="article">

					<header class="article-header">

						<figure class="article-image">
							<?php the_post_thumbnail('full'); ?>
						</figure>

						<h2 class="article-title">
							<a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
						</h2>

						<span><?php the_author(); ?> - <?php the_time('j F Y'); ?></span>

						<div class="article-share">
							<div class="fb-like" data-href="<?php the_permalink(); ?>" data-layout="button_count" data-action="like" data-show-faces="true" data-share="false"></div>
							<a href="https://twitter.com/share" class="twitter-share-button" data-url="<?php the_permalink(); ?>"><?php _e('Tweet', 'frontend', 'anzo'); ?></a>
							<g:plusone size="medium" href="<?php the_permalink(); ?>"></g:plusone>
						</div>

					</header>
					
					<?php the_content(); ?>

				</article>
				
			<?php endwhile; ?>

			<nav class="pagination">
				<?php
					echo paginate_links(array(
						'base' => owc_pagination_base() . '%_%',
						'format' => 'page/%#%/',
						'current' => max(1, get_query_var('paged')),
						'total' => $wp_query->max_num_pages,
						'type' => 'plain',
						'end_size' => 2
					));
				?>
			</nav>
		</main>

		<aside class="sidebar">
			<?php dynamic_sidebar('standard'); ?>
		</aside>

	</section>

<?php get_footer(); ?>