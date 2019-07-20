<?php
/**
 * The first/left sidebar widgetized area.
 *
 * If no active widgets in sidebar, default login widget will appear.
 *
 * @since 1.0.0
 */
if ( ! is_bavotasan_full_width() ) {
	?>
	<div id="secondary" <?php bavotasan_sidebar_class(); ?> role="complementary">
		<?php if ( ! dynamic_sidebar( 'sidebar' ) ) : ?>
			<aside id="meta" class="widget">
				<h3 class="widget-title"><?php _e( 'Default Widget', 'matheson' ); ?></h3>
				<p><?php printf( __( 'This is just a default widget. It\'ll disappear as soon as you add your own widgets on the %sWidgets admin page%s.', 'matheson' ), '<a href="' . admin_url( 'widgets.php' ) . '">', '</a>' ); ?></p>

				<p><?php _e( 'Below is an example of an unordered list.', 'matheson' ); ?></p>
				<ul>
					<li><?php _e( 'List item one', 'matheson' ); ?></li>
					<li><?php _e( 'List item two', 'matheson' ); ?></li>
					<li><?php _e( 'List item three', 'matheson' ); ?></li>
					<li><?php _e( 'List item four', 'matheson' ); ?></li>
				</ul>
			</aside>
		<?php endif; ?>
	</div><!-- #secondary.widget-area -->
	<?php
}