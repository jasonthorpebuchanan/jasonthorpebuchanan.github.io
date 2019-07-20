<?php
/**
 * The template for displaying posts in the Quote post format
 *
 * @since 1.0.0
 */
?>
	<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
		<?php if ( ! is_single() ) { ?>
		<div class="container">
			<div class="row">
				<div class="bordered col-md-8 col-md-offset-2">
		<?php }
		// Conditional for RTL languages
		$quote = ( is_rtl() ) ? 'right' : 'left';
		?>
			    <i class="fa fa-quote-<?php echo $quote; ?> quote"></i>
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