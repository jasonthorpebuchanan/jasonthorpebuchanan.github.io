<?php
/**
 * The template for displaying posts in the Link post format
 *
 * @since 1.0.6
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( ! is_single() ) { ?>
		<div class="container">
			<div class="row">
				<div class="bordered col-md-8 col-md-offset-2">
		<?php } ?>
				<h3 class="post-format"><?php _e( '<i class="fa fa-link"></i> Link', 'matheson' ); ?></h3>

			    <div class="entry-content">
				    <?php the_content( __( 'Read more', 'matheson') ); ?>
			    </div><!-- .entry-content -->

			    <?php get_template_part( 'content', 'footer' ); ?>
		<?php if ( ! is_single() ) { ?>
				</div>
			</div>
		</div>
		<?php } ?>
	</article>