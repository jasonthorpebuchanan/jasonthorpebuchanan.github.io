<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the id=main div and all content after
 *
 * @package Striker
 * @since Striker 1.0
 */
?>

	</div><!-- #main .site-main -->

	<footer id="colophon" class="site-footer" role="contentinfo">
		<div class="site-info">
			<?php printf( __( 'Powered by %1$s. %2$s theme by %3$s.', 'striker' ),'<a href="http://wordpress.org/" target="_blank">WordPress</a>', '<a href="http://www.templateexpress.com/striker-theme/" target="_blank">Striker</a>', 'Ossie' ); ?>
		</div><!-- .site-info -->
	</footer><!-- #colophon .site-footer -->
</div><!-- #page .hfeed .site -->
</div><!-- end of wrapper -->
<?php wp_footer(); ?>

</body>
</html>