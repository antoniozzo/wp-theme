<?php get_header(); ?>

	<section>
		<article>
			<h1><?php _e('Page not found', 'anzo'); ?></h1>
			<p><?php _e('Sorry, we could not find the page you were looking for.', 'anzo'); ?></p>
			<p><?php printf(__('Go to the <a href="%s">startpage &raquo;</a>', 'anzo'), home_url()); ?></p>
		</article>
	</section>

<?php get_footer(); ?>