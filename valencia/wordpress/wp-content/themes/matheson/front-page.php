<?php
/**
 * The front page template.
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages
 * and that other 'pages' on your WordPress site will use a
 * different template.
 *
 * @since 1.0.0
 */
get_header();

global $paged;
$bavotasan_theme_options = bavotasan_theme_options();

if ( 2 > $paged ) {
	// Display jumbo headline is the option is set
	if ( ! empty( $bavotasan_theme_options['jumbo_headline_title'] ) ) {
	?>
	<div class="home-top">
		<div class="container">
			<div class="home-jumbotron jumbotron row">
				<div class="col-md-6">
					<h1><?php echo apply_filters( 'the_title', html_entity_decode( $bavotasan_theme_options['jumbo_headline_title'] ) ); ?></h1>
				</div>
				<div class="col-md-6">
					<p class="lead"><?php echo wp_kses_post( html_entity_decode( $bavotasan_theme_options['jumbo_headline_text'] ) ); ?></p>
				</div>
			</div>
		</div>
	</div>
	<?php
	}

	// Display home page top widgetized area
	if ( is_active_sidebar( 'home-page-top-area' ) ) {
		?>
		<div id="home-page-widgets">
			<div class="container">
				<div class="row">
					<?php dynamic_sidebar( 'home-page-top-area' ); ?>
				</div>
			</div>
		</div>
		<?php
	}
}
// Check if home is set to a static page and add container
if ( 'page' == get_option('show_on_front') ) { ?>
<div class="static-home">
	<div class="container">
		<div class="row">
<?php } ?>
			<div id="primary" <?php bavotasan_primary_attr(); ?>>
				<?php
				if ( have_posts() ) :
					while ( have_posts() ) : the_post();
						if ( 'page' == get_option('show_on_front') ) { ?>
							<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
							    <div class="entry-content">
								    <?php the_content( __( 'Read more', 'matheson' ) ); ?>
							    </div><!-- .entry-content -->

							    <?php get_template_part( 'content', 'footer' ); ?>
							</article><!-- #post-<?php the_ID(); ?> -->
							<?php
						} else {
							get_template_part( 'content', get_post_format() );
						}
					endwhile;

					bavotasan_pagination();
				else :

					if ( current_user_can( 'edit_posts' ) ) {
						// Show a different message to a logged-in user who can add posts.
						?>
						<article id="post-0" class="post no-results not-found">
							<h1 class="entry-title"><?php _e( 'No posts to display', 'matheson' ); ?></h1>

							<div class="entry-content">
								<p><?php printf( __( 'Ready to publish your first post? <a href="%s">Get started here</a>.', 'matheson' ), admin_url( 'post-new.php' ) ); ?></p>
							</div><!-- .entry-content -->
						</article>
						<?php
					} else {
						get_template_part( 'content', 'none' );
					} // end current_user_can() check

				endif;
				?>
			</div><!-- #primary.c8 -->
<?php
// Check if home is set to a static page, add sidebar and close container
if ( 'page' == get_option('show_on_front') ) {
			get_sidebar(); ?>
		</div>
	</div>
</div>
<?php } ?>

<?php get_footer(); ?>