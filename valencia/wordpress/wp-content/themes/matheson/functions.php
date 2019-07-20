<?php
/**
 * Defining constants
 *
 * @since 1.0.0
 */
$bavotasan_theme_data = wp_get_theme();
define( 'BAVOTASAN_THEME_URL', get_template_directory_uri() );
define( 'BAVOTASAN_THEME_TEMPLATE', get_template_directory() );
define( 'BAVOTASAN_THEME_NAME', $bavotasan_theme_data->Name );

/**
 * Includes
 *
 * @since 1.0.0
 */
require( BAVOTASAN_THEME_TEMPLATE . '/library/customizer.php' ); // Functions for theme options page
require( BAVOTASAN_THEME_TEMPLATE . '/library/preview-pro.php' ); // Functions for preview pro page
require( BAVOTASAN_THEME_TEMPLATE . '/library/custom-metaboxes.php' ); // Functions for home page alignment

/**
 * Prepare the content width
 *
 * @since 1.0.2
 */
function bavotasan_content_width() {
	$bavotasan_theme_options = bavotasan_theme_options();
	$bavotasan_array_content = array( 'col-md-2' => .1666, 'col-md-3' => .25, 'col-md-4' => .3333, 'col-md-5' => .4166, 'col-md-6' => .5, 'col-md-7' => .5833, 'col-md-8' => .6666, 'col-md-9' => .75, 'col-md-10' => .8333, 'col-md-12' => 1 );
	$bavotasan_main_content =  $bavotasan_array_content[$bavotasan_theme_options['primary']] * $bavotasan_theme_options['width'] - 30;

    return round( $bavotasan_array_content[$bavotasan_theme_options['primary']] * $bavotasan_theme_options['width'] - 30 );
}

if ( ! isset( $content_width ) )
	$content_width = bavotasan_content_width();

add_action( 'template_redirect', 'bavotasan_content_width_adjust' );
/**
 * Adjust content_width value for image attachment template.
 *
 @ since 1.0.3
 */
function bavotasan_content_width_adjust() {
	if ( is_home() || is_search() || is_archive() ) {
		$bavotasan_theme_options = bavotasan_theme_options();
		$GLOBALS['content_width'] = $bavotasan_theme_options['width'] - 30;
	}
}

add_action( 'after_setup_theme', 'bavotasan_setup' );
if ( ! function_exists( 'bavotasan_setup' ) ) :
/**
 * Initial setup
 *
 * This function is attached to the 'after_setup_theme' action hook.
 *
 * @uses	load_theme_textdomain()
 * @uses	get_locale()
 * @uses	BAVOTASAN_THEME_TEMPLATE
 * @uses	add_theme_support()
 * @uses	add_editor_style()
 * @uses	add_custom_background()
 * @uses	add_custom_image_header()
 * @uses	register_default_headers()
 *
 * @since 1.0.0
 */
function bavotasan_setup() {
	load_theme_textdomain( 'matheson', BAVOTASAN_THEME_TEMPLATE . '/library/languages' );

	// Add default posts and comments RSS feed links to <head>.
	add_theme_support( 'automatic-feed-links' );

	// This theme styles the visual editor with editor-style.css to match the theme style.
	add_editor_style( array( 'library/css/admin/editor-style.css', bavotasan_font_url() ) );

	// This theme uses wp_nav_menu() in two location.
	register_nav_menu( 'primary', __( 'Primary Menu', 'matheson' ) );

	// Add support for a variety of post formats
	add_theme_support( 'post-formats', array( 'gallery', 'image', 'video', 'audio', 'quote', 'link', 'status', 'aside' ) );

	// This theme uses Featured Images (also known as post thumbnails) for archive pages
	add_theme_support( 'post-thumbnails' );
	add_image_size( 'teaser', 300, 300, true );

	// Add a filter to bavotasan_header_image_width and bavotasan_header_image_height to change the width and height of your custom header.
	add_theme_support( 'custom-header', array(
		'default-text-color' => '282828',
		'flex-height' => true,
		'flex-width' => true,
		'random-default' => true,
		'width' => apply_filters( 'bavotasan_header_image_width', 1200 ),
		'height' => apply_filters( 'bavotasan_header_image_height', 600 ),
		'wp-head-callback' => 'bavotasan_header_style',
		'admin-head-callback' => 'bavotasan_admin_header_style',
		'admin-preview-callback' => 'bavotasan_admin_header_image'
	) );

	// Default custom headers packaged with the theme. %s is a placeholder for the theme template directory URI.
	register_default_headers( array(
		'header01' => array(
			'url' => '%s/library/images/header01.jpg',
			'thumbnail_url' => '%s/library/images/header01-thumbnail.jpg',
			'description' => __( 'Default Header 1', 'matheson' )
		),
	) );

	// Add support for custom backgrounds
	add_theme_support( 'custom-background' );

	// Add HTML5 elements
	add_theme_support( 'html5', array( 'comment-list', 'search-form', 'comment-form', ) );

	// Infinite scroll
	add_theme_support( 'infinite-scroll', array(
	    'type' => 'scroll',
	    'container' => 'primary',
		'wrapper' => false,
		'footer' => false,
	) );

	// Remove default gallery styles
	add_filter( 'use_default_gallery_style', '__return_false' );
}
endif; // bavotasan_setup

add_action( 'wp_head', 'bavotasan_styles' );
/**
 * Add a style block to the theme for the current link color.
 *
 * This function is attached to the 'wp_head' action hook.
 *
 * @since 1.0.0
 */
function bavotasan_styles() {
	$bavotasan_theme_options = bavotasan_theme_options();
	?>
<style>
.boxed #page { max-width: <?php echo $bavotasan_theme_options['width'] + 180; ?>px; }
.container { max-width: <?php echo $bavotasan_theme_options['width']; ?>px; }
</style>
	<?php
}

/**
 * Register Open Sans and Raleway Google font.
 *
 * @since 1.0.2
 */
function bavotasan_font_url() {
	/*
	 * Translators: If there are characters in your language that are not supported
	 * by Open Sans or Raleway, translate this to 'off'. Do not translate
	 * into your own language.
	 */
	return ( 'off' !== _x( 'on', 'Google Fonts: on or off', 'matheson' ) ) ? add_query_arg( 'family', 'Raleway|Open+Sans:400,400italic,700,700italic', '//fonts.googleapis.com/css' ) : '';
}

add_action( 'admin_print_scripts-appearance_page_custom-header', 'bavotasan_header_admin_enqueue' );
/**
 * Add font to Header admin page
 *
 * @since 1.0.2
 */
function bavotasan_header_admin_enqueue( $hook ) {
	wp_enqueue_style( 'google_fonts', bavotasan_font_url(), false, null, 'all' );
}

if ( ! function_exists( 'bavotasan_header_style' ) ) :
/**
 * Styles the header image and text displayed on the blog
 *
 * @since 1.0.2
 */
function bavotasan_header_style() {
	$header_text_color = get_header_textcolor();

	// If no custom options for text are set, let's bail
	// get_header_textcolor() options: HEADER_TEXTCOLOR is default, hide text (returns 'blank') or any hex value
	if ( HEADER_TEXTCOLOR == $header_text_color )
		return;

	// If we get this far, we have custom styles. Let's do this.
	?>
	<style type="text/css">
	<?php
		// Has the text been hidden?
		if ( 'blank' == $header_text_color ) :
	?>
		#site-meta {
			position: absolute;
			clip: rect(1px, 1px, 1px, 1px);
		}
	<?php
		// If the user has set a custom color for the text use that
		else :
	?>
		.site-title a,
		.site-description {
			color: #<?php echo $header_text_color; ?>;
		}
	<?php endif; ?>
	</style>
	<?php
}
endif; // bavotasan_header_style

/**
 * Styles the header image displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in bavotasan_setup().
 *
 * @since 1.0.0
 */
function bavotasan_admin_header_style() {
	$text_color = get_header_textcolor();
	$styles = ( 'blank' == $text_color ) ? 'display:none' : 'color:#' . $text_color . ' !important';
	?>
<style>
.appearance_page_custom-header #headimg {
	border: none;
	}

#site-title,
#site-description {
	font-family: Raleway, sans-serif;
	font-weight: normal;
	text-align: center;
}

#site-title {
	margin: 0;
	font-size: 60px;
	line-height: 1.3;
	}

#site-description {
	margin: 0 0 30px;
	font-size: 14px;
	line-height: 1;
	padding: 0;
	}

#headimg img {
	max-width: 1500px;
	height: auto;
	width: 100%;
	}

#site-title,#site-description{<?php echo $styles; ?>}
</style>
	<?php
}

/**
 * Custom header image markup displayed on the Appearance > Header admin panel.
 *
 * Referenced via add_custom_image_header() in bavotasan_setup().
 *
 * @uses	bloginfo()
 * @uses	get_header_image()
 *
 * @since 1.0.0
 */
function bavotasan_admin_header_image() {
	?>
	<div id="headimg">
		<h1 id="site-title"><?php bloginfo( 'name' ); ?></h1>
		<h2 id="site-description"><?php bloginfo( 'description' ); ?></h2>
		<?php if ( $header_image = get_header_image() ) : ?>
			<img src="<?php echo esc_url( $header_image ); ?>" alt="" />
		<?php endif; ?>
	</div>
	<?php
}

add_action( 'wp_enqueue_scripts', 'bavotasan_add_js' );
if ( ! function_exists( 'bavotasan_add_js' ) ) :
/**
 * Load all JavaScript to header
 *
 * This function is attached to the 'wp_enqueue_scripts' action hook.
 *
 * @uses	is_admin()
 * @uses	is_singular()
 * @uses	get_option()
 * @uses	wp_enqueue_script()
 * @uses	BAVOTASAN_THEME_URL
 *
 * @since 1.0.0
 */
function bavotasan_add_js() {
	if ( is_singular() && get_option( 'thread_comments' ) )
		wp_enqueue_script( 'comment-reply' );

	wp_enqueue_script( 'bootstrap', BAVOTASAN_THEME_URL .'/library/js/bootstrap.min.js', array( 'jquery' ), '3.0.3', true );

	wp_enqueue_script( 'theme', BAVOTASAN_THEME_URL .'/library/js/theme.js', array( 'bootstrap' ), '', true );
	wp_enqueue_style( 'theme_stylesheet', get_stylesheet_uri() );

	wp_enqueue_style( 'google_fonts', bavotasan_font_url(), false, null, 'all' );
	wp_enqueue_style( 'font_awesome', BAVOTASAN_THEME_URL .'/library/css/font-awesome.css', false, null, 'all' );
}
endif; // bavotasan_add_js

add_action( 'widgets_init', 'bavotasan_widgets_init' );
if ( ! function_exists( 'bavotasan_widgets_init' ) ) :
/**
 * Creating the two sidebars
 *
 * This function is attached to the 'widgets_init' action hook.
 *
 * @uses	register_sidebar()
 *
 * @since 1.0.0
 */
function bavotasan_widgets_init() {
	require( BAVOTASAN_THEME_TEMPLATE . '/library/widgets/widget-image-icon.php' ); // Custom Image/Icon Text widget

	register_sidebar( array(
		'name' => __( 'First Sidebar', 'matheson' ),
		'id' => 'sidebar',
		'description' => __( 'This sidebar only appears on single posts and pages. All defaults widgets work great here.', 'matheson' ),
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __( 'Home Page Top Area', 'matheson' ),
		'id' => 'home-page-top-area',
		'description' => __( 'Area on the home page above the main content. Specifically designed for 3 Image & Text widgets.', 'matheson' ),
		'before_widget' => '<aside id="%1$s" class="home-widget col-md-4 %2$s">',
		'after_widget' => '</aside>',
		'before_title' => '<h3 class="home-widget-title">',
		'after_title' => '</h3>',
	) );
}
endif; // bavotasan_widgets_init

/**
 * Add pagination
 *
 * @uses	paginate_links()
 * @uses	add_query_arg()
 *
 * @since 1.0.0
 */
function bavotasan_pagination() {
	global $wp_query, $paged, $bavotasan_grid_query;

	$wp_query = ( $bavotasan_grid_query ) ? $bavotasan_grid_query : $wp_query;

	// Don't print empty markup if there's only one page.
	if ( $wp_query->max_num_pages < 2 && 0 == $paged )
		return;
	?>
	<nav class="navigation clearfix" role="navigation">
		<div class="container">
			<div class="row">
				<div class="col-sm-12">
					<h1 class="sr-only"><?php _e( 'Posts navigation', 'matheson' ); ?></h1>
					<?php if ( get_next_posts_link() ) : ?>
					<div class="nav-previous"><?php next_posts_link( __( '&larr; Older posts', 'matheson' ) ); ?></div>
					<?php endif; ?>

					<?php if ( get_previous_posts_link() ) : ?>
					<div class="nav-next"><?php previous_posts_link( __( 'Newer posts &rarr;', 'matheson' ) ); ?></div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</nav><!-- .navigation -->
	<?php
	wp_reset_query();
}

add_filter( 'wp_title', 'bavotasan_filter_wp_title', 10, 2 );
if ( ! function_exists( 'bavotasan_filter_wp_title' ) ) :
/**
 * Filters the page title appropriately depending on the current page
 *
 * @uses	get_bloginfo()
 * @uses	is_home()
 * @uses	is_front_page()
 *
 * @since 1.0.0
 */
function bavotasan_filter_wp_title( $title, $sep ) {
	global $paged, $page;

	if ( is_feed() )
		return $title;

	// Add the site name.
	$title .= get_bloginfo( 'name' );

	// Add the site description for the home/front page.
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";

	// Add a page number if necessary.
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'matheson' ), max( $paged, $page ) );

	return $title;
}
endif; // bavotasan_filter_wp_title

if ( ! function_exists( 'bavotasan_comment' ) ) :
/**
 * Callback function for comments
 *
 * Referenced via wp_list_comments() in comments.php.
 *
 * @uses	get_avatar()
 * @uses	get_comment_author_link()
 * @uses	get_comment_date()
 * @uses	get_comment_time()
 * @uses	edit_comment_link()
 * @uses	comment_text()
 * @uses	comments_open()
 * @uses	comment_reply_link()
 *
 * @since 1.0.0
 */
function bavotasan_comment( $comment, $args, $depth ) {
	$GLOBALS['comment'] = $comment;

	switch ( $comment->comment_type ) :
		case '' :
		?>
		<li <?php comment_class(); ?>>
			<div id="comment-<?php comment_ID(); ?>" class="comment-body">
				<div class="comment-avatar">
					<?php echo get_avatar( $comment, 60 ); ?>
				</div>
				<div class="comment-content">
					<div class="comment-author">
						<?php echo get_comment_author_link() . ' '; ?>
					</div>
					<div class="comment-meta">
						<?php
						printf( __( '%1$s at %2$s', 'matheson' ), get_comment_date(), get_comment_time() );
						edit_comment_link( __( '(edit)', 'matheson' ), '  ', '' );
						?>
					</div>
					<div class="comment-text">
						<?php if ( '0' == $comment->comment_approved ) { echo '<em>' . __( 'Your comment is awaiting moderation.', 'matheson' ) . '</em>'; } ?>
						<?php comment_text() ?>
					</div>
					<?php if ( $args['max_depth'] != $depth && comments_open() && 'pingback' != $comment->comment_type ) { ?>
					<div class="reply">
						<?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
					</div>
					<?php } ?>
				</div>
			</div>
			<?php
			break;

		case 'pingback'  :
		case 'trackback' :
		?>
		<li id="comment-<?php comment_ID(); ?>" class="pingback">
			<div class="comment-body">
				<i class="fa fa-paperclip"></i>
				<?php _e( 'Pingback:', 'matheson' ); ?> <?php comment_author_link(); ?><?php edit_comment_link( __( '(edit)', 'matheson' ), ' ' ); ?>
			</div>
			<?php
			break;
	endswitch;
}
endif; // bavotasan_comment

add_filter( 'excerpt_more', 'bavotasan_excerpt' );
if ( ! function_exists( 'bavotasan_excerpt' ) ) :
/**
 * Adds a read more link to all excerpts
 *
 * This function is attached to the 'excerpt_more' filter hook.
 *
 * @param	int $more
 *
 * @return	Custom excerpt ending
 *
	 * @since 1.0.0
 */
function bavotasan_excerpt( $more ) {
	return '&hellip;';
}
endif; // bavotasan_excerpt

add_filter( 'wp_trim_excerpt', 'bavotasan_excerpt_more' );
if ( ! function_exists( 'bavotasan_excerpt_more' ) ) :
/**
 * Adds a read more link to all excerpts
 *
 * This function is attached to the 'wp_trim_excerpt' filter hook.
 *
 * @param	string $text
 *
 * @return	Custom read more link
 *
 * @since 1.0.0
 */
function bavotasan_excerpt_more( $text ) {
	if ( is_singular() )
		return $text;

	return '<p class="excerpt">' . $text . '</p><p class="more-link-p"><a class="btn btn-default" href="' . get_permalink( get_the_ID() ) . '">' . __( 'Read more', 'matheson') . '</a></p>';
}
endif; // bavotasan_excerpt_more

add_filter( 'the_content_more_link', 'bavotasan_content_more_link', 10, 2 );
if ( ! function_exists( 'bavotasan_content_more_link' ) ) :
/**
 * Customize read more link for content
 *
 * This function is attached to the 'the_content_more_link' filter hook.
 *
 * @param	string $link
 * @param	string $text
 *
 * @return	Custom read more link
 *
 * @since 1.0.0
 */
function bavotasan_content_more_link( $link, $text ) {
	return '<p class="more-link-p"><a class="btn btn-default" href="' . get_permalink( get_the_ID() ) . '">' . $text . '</a></p>';
}
endif; // bavotasan_content_more_link

add_filter( 'excerpt_length', 'bavotasan_excerpt_length', 999 );
if ( ! function_exists( 'bavotasan_excerpt_length' ) ) :
/**
 * Custom excerpt length
 *
 * This function is attached to the 'excerpt_length' filter hook.
 *
 * @param	int $length
 *
 * @return	Custom excerpt length
 *
 * @since 1.0.0
 */
function bavotasan_excerpt_length( $length ) {
	global $bavotasan_custom_excerpt_length;

	if ( $bavotasan_custom_excerpt_length )
		return $bavotasan_custom_excerpt_length;

	return 60;
}
endif; // bavotasan_excerpt_length

/**
 * Print the attached image with a link to the next attached image.
 *
 * @since 1.0.9
 */
function bavotasan_the_attached_image() {
	$post = get_post();

	$attachment_size = apply_filters( 'bavotasan_attachment_size', array( 810, 810 ) );
	$next_attachment_url = wp_get_attachment_url();

	$attachment_ids = get_posts( array(
		'post_parent' => $post->post_parent,
		'fields' => 'ids',
		'numberposts' => -1,
		'post_status' => 'inherit',
		'post_type' => 'attachment',
		'post_mime_type' => 'image',
		'order' => 'ASC',
		'orderby' => 'menu_order ID',
	) );

	if ( count( $attachment_ids ) > 1 ) {
		foreach ( $attachment_ids as $attachment_id ) {
			if ( $attachment_id == $post->ID ) {
				$next_id = current( $attachment_ids );
				break;
			}
		}

		if ( $next_id )
			$next_attachment_url = get_attachment_link( $next_id );
		else
			$next_attachment_url = get_attachment_link( array_shift( $attachment_ids ) );
	}

	printf( '<a href="%1$s" rel="attachment">%2$s</a>',
		esc_url( $next_attachment_url ),
		wp_get_attachment_image( $post->ID, $attachment_size )
	);
}

/**
 * Full width conditional check
 *
 * @since 1.0.0
 *
 * @return	boolean True if post/page is set to full width
 */
function is_bavotasan_full_width() {
	$single_layout = ( is_singular() ) ? get_post_meta( get_the_ID(), 'matheson_single_layout', true ) : '';
	if ( 'on' == $single_layout )
		return true;
}

/**
 * Create the required attributes for the #primary container
 *
 * @since 1.0.0
 */
function bavotasan_primary_attr() {
	$bavotasan_theme_options = bavotasan_theme_options();
	$primary = str_replace( 'col-md-', '', $bavotasan_theme_options['primary'] );
	$secondary = ( is_active_sidebar( 'second-sidebar' ) ) ? str_replace( 'col-md-', '', $bavotasan_theme_options['secondary'] ) : 12 - $primary;
	$tertiary = 12 - $primary - $secondary;
	$class = ( ! is_bavotasan_full_width() ) ? $bavotasan_theme_options['primary'] : '';
	$class = ( is_singular() && is_bavotasan_full_width() ) ? 'col-sm-12' : $class;
	$class = ( is_singular() || is_404() || ( function_exists( 'is_bbpress' ) && is_bbpress() ) ) ? $class : 'col-sm-12';
	$push = '';

	if ( is_active_sidebar( 'second-sidebar' ) && ! is_bavotasan_full_width() && is_singular() ) {
		$push = ( 'left' == $bavotasan_theme_options['layout'] ) ? ' col-md-push-' . ( $secondary + $tertiary ) : '';
		$push = ( 'separate' == $bavotasan_theme_options['layout'] ) ? ' col-md-push-' . $secondary: $push;
	} else {
		$class = ( 'left' == $bavotasan_theme_options['layout'] ) ? $class . ' pull-right' : $class;
	}

	echo 'class="' . esc_attr( $class ) . esc_attr( $push ) . '"';
}

/**
 * Create the required classes for the #secondary sidebar container
 *
 * @since 1.0.0
 */
function bavotasan_sidebar_class() {
	$bavotasan_theme_options = bavotasan_theme_options();
	$primary = str_replace( 'col-md-', '', $bavotasan_theme_options['primary'] );
	$pull = '';

	if ( is_active_sidebar( 'second-sidebar' ) ) {
		$class = $bavotasan_theme_options['secondary'];
		$pull = ( 'right' != $bavotasan_theme_options['layout'] ) ? ' col-md-pull-' . $primary : '';
	} else {
		$end = ( 'right' == $bavotasan_theme_options['layout'] ) ? ' end' : '';
		$class = 'col-md-' . ( 12 - $primary ) . $end;
	}

	echo 'class="' . esc_attr( $class ) . esc_attr( $pull ) . '"';
}

/**
 * Create the required classes for the #tertiary sidebar container
 *
 * @since 1.0.0
 */
function bavotasan_second_sidebar_class() {
	$bavotasan_theme_options = bavotasan_theme_options();
	$primary = str_replace( 'col-md-', '', $bavotasan_theme_options['primary'] );
	$secondary = str_replace( 'col-md-', '', $bavotasan_theme_options['secondary'] );
	$pull = ( 'left' == $bavotasan_theme_options['layout'] ) ? ' col-md-pull-' . $primary : '';

	$end = ( 'left' != $bavotasan_theme_options['layout'] ) ? ' end' : '';
	$class = 'col-md-' . ( 12 - $primary - $secondary ) . $end;

	echo 'class="' . esc_attr( $class ) . esc_attr( $pull ) . '"';
}

/**
 * Default menu
 *
 * Referenced via wp_nav_menu() in header.php.
 *
 * @since 1.0.0
 */
function bavotasan_default_menu( $args ) {
	extract( $args );

	$output = wp_list_categories( array(
		'title_li' => '',
		'echo' => 0,
		'number' => 5,
		'depth' => 1,
	) );
	echo "<$container class='$container_class'><ul class='nav nav-justified'>$output</ul></$container>";
}

/**
 * Add bootstrap classes to menu items
 *
 * @since 1.0.0
 */
class Bavotasan_Page_Navigation_Walker extends Walker_Nav_Menu {
	function check_current( $classes ) {
		return preg_match( '/(current[-_])|active|dropdown/', $classes );
	}

	function start_lvl( &$output, $depth = 0, $args = array() ) {
		$output .= "\n<ul class=\"dropdown-menu\">\n";
	}

	function start_el( &$output, $item, $depth = 0, $args = array(), $id = 0 ) {
		$item_html = '';
		parent::start_el( $item_html, $item, $depth, $args );

		if ( $item->is_dropdown && ( $depth === 0 ) ) {
			$item_html = str_replace( '<a', '<a class="dropdown-toggle" data-toggle="dropdown" data-target="#"', $item_html );
			$item_html = str_replace( '</a>', ' <b class="caret"></b></a>', $item_html );
		} elseif ( stristr( $item_html, 'li class="divider' ) ) {
			$item_html = preg_replace( '/<a[^>]*>.*?<\/a>/iU', '', $item_html );
		} elseif ( stristr( $item_html, 'li class="nav-header' ) ) {
			$item_html = preg_replace( '/<a[^>]*>(.*)<\/a>/iU', '$1', $item_html );
		}

		$output .= $item_html;
	}

	function display_element( $element, &$children_elements, $max_depth, $depth = 0, $args, &$output ) {
		$element->is_dropdown = !empty( $children_elements[$element->ID] );

		if ( $element->is_dropdown ) {
			if ( $depth === 0 ) {
				$element->classes[] = 'dropdown';
			} elseif ( $depth > 0 ) {
				$element->classes[] = 'dropdown-submenu';
			}
		}
		$element->classes[] = ( $element->current || in_array( 'current-menu-parent', $element->classes ) ) ? 'active' : '';

		parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
	}
}

add_filter( 'wp_nav_menu_args', 'bavotasan_nav_menu_args' );
/**
 * Set our new walker only if a menu is assigned and a child theme hasn't modified it to one level deep
 *
 * This function is attached to the 'wp_nav_menu_args' filter hook.
 *
 * @author Kirk Wight <http://kwight.ca/adding-a-sub-menu-indicator-to-parent-menu-items/>
 * @since 1.0.0
 */
function bavotasan_nav_menu_args( $args ) {
    if ( 1 !== $args[ 'depth' ] && has_nav_menu( 'primary' ) )
        $args[ 'walker' ] = new Bavotasan_Page_Navigation_Walker;

    return $args;
}

/**
 * Display either the custom image or default header image
 *
 * @since 1.0.0
 */
function header_images() {
	$custom_image = ( is_singular() ) ? get_post_meta( get_the_ID(), 'matheson_custom_image', true ) : '';

	if ( is_singular() && ( ! empty( $custom_image ) || has_post_thumbnail() ) ) {
		if ( $custom_image )
			echo '<img src="' . esc_url( $custom_image ) . '" alt="" class="header-img" />';
		else
			the_post_thumbnail( 'full', array( 'class' => 'header-img' ) );
	} else {
		$header_image = get_header_image();
		if ( ! empty( $header_image ) ) :
			?>
			<img class="header-img" src="<?php header_image(); ?>" width="<?php echo get_custom_header()->width; ?>" height="<?php echo get_custom_header()->height; ?>" alt="" />
			<?php
		endif;
	}
}

add_filter( 'body_class', 'bavotasan_body_class' );
/**
 * Add body class
 *
 * @since 1.0.2
 */
function bavotasan_body_class( $classes ) {
   	$classes[] = 'boxed basic';

	return $classes;
}