	<footer class="footer">
		<section class="copyright">
			<small><?php printf(stripslashes(get_option('anzo_footer_copyright')), date('Y')); ?></small>
		</section>
	</footer>

	<!--=== WP_FOOTER() ===-->
	<?php wp_footer(); ?>

</body>
</html>