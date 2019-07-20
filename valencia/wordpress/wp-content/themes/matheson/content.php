<?php
$bavotasan_theme_options = bavotasan_theme_options();
$format = get_post_format();
$featured_image = ( has_post_thumbnail() && 'excerpt' == $bavotasan_theme_options['excerpt_content'] ) ? 'featured-image' : 'no-featured-image';
?>

	<article id="post-<?php the_ID(); ?>" <?php post_class( $featured_image ); ?>>
		<?php if ( ! is_single() ) { ?>
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
		<?php } ?>
				<?php
				if( ! is_single() && 'excerpt' == $bavotasan_theme_options['excerpt_content'] && has_post_thumbnail() ) {
					?>
					<a href="<?php the_permalink(); ?>" class="image-anchor">
						<?php the_post_thumbnail( 'teaser', array( 'class' => 'alignleft' ) ); ?>
					</a>
					<?php
				}

			    get_template_part( 'content', 'header' ); ?>

			    <div class="entry-content">
				    <?php
					if ( 'excerpt' == $bavotasan_theme_options['excerpt_content'] && empty( $format ) && ( ! is_single() || is_search() || is_archive() ) ) {
						the_excerpt();
					} else {
						the_content( __( 'Read more', 'matheson') );
					}
					?>
			    </div><!-- .entry-content -->
			    <?php get_template_part( 'content', 'footer' ); ?>

		<?php if ( ! is_single() ) { ?>
				</div>
			</div>
		</div>
		<?php } ?>
	</article><!-- #post-<?php the_ID(); ?> -->