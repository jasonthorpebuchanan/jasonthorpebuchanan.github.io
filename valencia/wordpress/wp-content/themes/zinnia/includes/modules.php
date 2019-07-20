<?php
// ==================================================================
// Theme scripts
// ==================================================================
function zinnia_theme_scripts(){

  wp_enqueue_script( 'jquery-ui-widget' );
  wp_enqueue_style( 'style', get_stylesheet_uri(), null, array(), 'all' );
  wp_enqueue_style( 'google-webfont', '//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,700,300', '', 'all' );
  if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) wp_enqueue_script( 'comment-reply' );
  wp_enqueue_script( 'respond', get_template_directory_uri() . '/js/respond.js', array( 'jquery' ), '1.3.0', true );
  wp_enqueue_script( 'responsiveslides', get_template_directory_uri() . '/js/responsiveslides.js', array( 'jquery' ), '1.54', true );
  wp_enqueue_script( 'fitvids', get_template_directory_uri() . '/js/fitvids.js', array( 'jquery' ), '1.0', true );
  wp_enqueue_script( 'doubletaptogo', get_template_directory_uri() . '/js/doubletaptogo.js', array( 'jquery' ), null, true );
  wp_enqueue_script( 'tinynav', get_template_directory_uri() . '/js/tinynav.js', array( 'jquery' ), null, true );
  wp_enqueue_script( 'scripts', get_template_directory_uri() . '/js/scripts.js', array( 'jquery' ), null, true );

}
add_action( 'wp_enqueue_scripts', 'zinnia_theme_scripts' );

// ==================================================================
// Conditional scripts
// ==================================================================
function zinnia_conditional_scripts() {
  ?>
  <!--[if lt IE 7]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE7.js" type="text/javascript"></script><![endif]-->
  <!--[if lt IE 8]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE8.js" type="text/javascript"></script><![endif]-->
  <!--[if lt IE 9]><script src="http://ie7-js.googlecode.com/svn/version/2.1(beta4)/IE9.js" type="text/javascript"></script><![endif]-->
  <!--[if lt IE 9]><script src="http://html5shim.googlecode.com/svn/trunk/html5.js" type="text/javascript"></script><![endif]-->
  <?php
}
add_action( 'wp_head', 'zinnia_conditional_scripts' );

// ==================================================================
// Content width
// ==================================================================
if ( ! isset( $content_width ) )
	$content_width = 720;
		function zinnia_set_full_width() {
			global $zinnia_full_width;
			if ( is_page_template( 'full-page.php' ) || is_page_template( 'sitemap-page.php' ) || is_page_template( 'archives-page.php' ) )
			$zinnia_full_width = 720;
		}
add_action( 'template_redirect', 'zinnia_set_full_width' );

// Theme Setup
// ====================================================================================================================================
function zinnia_theme_setup() {
// ====================================================================================================================================

  // ==================================================================
  // Custom header
  // ==================================================================
  add_theme_support( 'custom-header', array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 720,
	'height'                 => 200,
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => '#000000',
	'header-text'            => true,
	'uploads'                => true,
	'wp-head-callback'       => '',
	'admin-head-callback'    => 'zinnia_admin_header_style',
	'admin-preview-callback' => 'zinnia_admin_header_image',
  ));

  function zinnia_admin_header_style() { ?>
    <link href="//fonts.googleapis.com/css?family=Open+Sans:300italic,400italic,700italic,400,700,300" rel="stylesheet" type="text/css">
    <style type="text/css">
    .appearance_page_custom-header #headimg {
      background-color: #fff;
      width: 720px;
      padding: 20px 0;
      text-align: center;
    }
    #headimg h1 {
      font-family: 'Open Sans', sans-serif;
      font-size: 3.6em;
      font-weight: 700;
      text-align: center;
      margin: 0 0 10px 0;
      text-transform: uppercase;
      letter-spacing: .2em;
    }
    #headimg h1 a {
      text-decoration: none;
    }
    #headimg .displaying-header-desc {
      color: #666;
      text-align: center;
      margin: 0;
    }
    #headimg img {
      vertical-align: middle;
      display: block;
      margin: 0 auto;
    }
    </style>
  <?php }

  function zinnia_admin_header_image() { ?>
    <div id="headimg">
      <?php if ( get_header_image() ) : ?>
      <img src="<?php header_image(); ?>" alt="">
      <?php endif; ?>
      <h1 class="displaying-header-text"><a id="name"<?php echo sprintf( ' style="color:#%s;"', get_header_textcolor() ); ?> onclick="return false;" href="<?php echo esc_url( home_url( '/' ) ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
      <p class="displaying-header-desc"><?php bloginfo( 'description' ); ?></p>
    </div>
  <?php }

  function zinnia_header_image_text() {
  $text_color = get_header_textcolor();
  // If no custom color for text is set, let's bail.
  if ( display_header_text() && $text_color === get_theme_support( 'custom-header', 'default-text-color' ) )
  return;
  // If we get this far, we have custom styles.
  ?>
    <style type="text/css">
    <?php if ( ! display_header_text() ) : ?>
      .header-text,
      .header-text-desc {display: none;}
    <?php elseif ( $text_color != get_theme_support( 'custom-header', 'default-text-color' ) ) : ?>
      .header-text a,
      .header-text-desc {color: #<?php echo esc_attr( $text_color ); ?>;}
    <?php endif; ?>
    </style>
  <?php
  }
  add_action( 'wp_head', 'zinnia_header_image_text' );

  // ==================================================================
  // Custom background
  // ==================================================================
  add_theme_support( 'custom-background', array(
    'default-color' => 'ffffff',
  ) );

  // ==================================================================
  // Post format
  // ==================================================================
  add_theme_support( 'post-formats',
    array(
    'aside',
    'gallery',
    'link',
    'image',
    'quote',
    'status',
    'video',
    'audio',
    'chat'
    )
  );

  // ==================================================================
  // Language
  // ==================================================================
  load_theme_textdomain( 'zinnia-theme', get_template_directory() . '/languages' );

  // ==================================================================
  // Post thumbnail
  // ==================================================================
  add_theme_support( 'post-thumbnails' );
    add_image_size( 'post_thumb', 720, 400, true );
    add_image_size( 'slide_image', 960, 400, true );

  // ==================================================================
  // Add default posts and comments RSS feed links to head
  // ==================================================================
  add_theme_support( 'automatic-feed-links' );

  // ==================================================================
  // Menu location
  // ==================================================================
  register_nav_menu( 'top_menu', __( 'Top Menu','zinnia-theme' ) );

  // ==================================================================
  // Visual editor stylesheet
  // ==================================================================
  add_editor_style( 'editor.css' );

  // ==================================================================
  // Shortcode in excerpt
  // ==================================================================
  add_filter( 'the_excerpt', 'do_shortcode' );

  // ==================================================================
  // Shortcode in widget
  // ==================================================================
  add_filter( 'widget_text', 'do_shortcode' );

  // ==================================================================
  // Add "Home" in menu
  // ==================================================================
  function ace_home_page_menu( $args ) {
    $args['show_home'] = true;
    return $args;
  }
  add_filter( 'wp_page_menu_args', 'ace_home_page_menu' );

// Theme Setup
// ====================================================================================================================================
}
add_action( 'after_setup_theme', 'zinnia_theme_setup' );
// ====================================================================================================================================

// ==================================================================
// Comment spam, prevention
// ==================================================================
function zinnia_check_referrer() {
  if ( !isset( $_SERVER['HTTP_REFERER'] ) || $_SERVER['HTTP_REFERER'] == "" ) {
    wp_die( __( 'Please enable referrers in your browser.','zinnia-theme' ) );
  }
}
add_action( 'check_comment_flood', 'zinnia_check_referrer' );

// ==================================================================
// Custom comment style
// ==================================================================
function zinnia_comment_style( $comment, $args, $depth ) {
  $GLOBALS['comment'] = $comment; ?>
  <li <?php comment_class(); ?>>
    <article class="comment-content" id="comment-<?php comment_ID(); ?>">
      <div class="comment-meta">
        <?php echo get_avatar($comment, $size = '32' ); ?>
        <?php printf( __( '<h6>%s</h6>','zinnia-theme' ), get_comment_author_link() ) ?>
        <small><?php printf( __( '%1$s at %2$s','zinnia-theme' ), get_comment_date(), get_comment_time() ) ?></small>
      </div>
    <?php if ( $comment->comment_approved == '0' ) : ?><em><?php _e( 'Your comment is awaiting moderation','zinnia-theme' ) ?>.</em><br /><?php endif; ?>
    <?php comment_text() ?>
    <?php comment_reply_link( array_merge( $args, array( 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ) ?>
    </article>
<?php }

// ==================================================================
// Header title
// ==================================================================
function zinnia_wp_title( $title, $sep ) {
	global $paged, $page;
	if ( is_feed() )
	return $title;
	$title .= get_bloginfo( 'name' );
	$site_description = get_bloginfo( 'description', 'display' );
	if ( $site_description && ( is_home() || is_front_page() ) )
		$title = "$title $sep $site_description";
	if ( $paged >= 2 || $page >= 2 )
		$title = "$title $sep " . sprintf( __( 'Page %s', 'zinnia-theme' ), max( $paged, $page ) );
	return $title;
}
add_filter( 'wp_title', 'zinnia_wp_title', 10, 2 );

// ==================================================================
// Post/page pagination
// ==================================================================
function zinnia_get_link_pages() {
  wp_link_pages(
    array(
    'before'           => '<p class="page-pagination"><span class="page-pagination-title">' . __( 'Pages:','zinnia-theme' ) . '</span>',
    'after'            => '</p>',
    'link_before'      => '<span class="page-pagination-number">',
    'link_after'       => '</span>',
    'next_or_number'   => 'number',
    'nextpagelink'     => __( 'Next page','zinnia-theme' ),
    'previouspagelink' => __( 'Previous page','zinnia-theme' ),
    'pagelink'         => '%',
    'echo'             => 1
    )
  );
}


// ==================================================================
// Pagination (WordPress)
// ==================================================================
function zinnia_get_pagination_links() {
	if ( $GLOBALS['wp_query']->max_num_pages < 2 ) {
    return;
	}
    $paged        = get_query_var( 'paged' ) ? intval( get_query_var( 'paged' ) ) : 1;
    $pagenum_link = html_entity_decode( get_pagenum_link() );
    $query_args   = array();
    $url_parts    = explode( '?', $pagenum_link );
      if ( isset( $url_parts[1] ) ) {
        wp_parse_str( $url_parts[1], $query_args );
      }

    $pagenum_link = remove_query_arg( array_keys( $query_args ), $pagenum_link );
    $pagenum_link = trailingslashit( $pagenum_link ) . '%_%';
    $format  = $GLOBALS['wp_rewrite']->using_index_permalinks() && ! strpos( $pagenum_link, 'index.php' ) ? 'index.php/' : '';
    $format .= $GLOBALS['wp_rewrite']->using_permalinks() ? user_trailingslashit( 'page/%#%', 'paged' ) : '?paged=%#%';

    $links = paginate_links( array(
      'base'			=> @add_query_arg( 'paged','%#%' ),
      'format'		=> '?paged=%#%',
      'current'		=> $paged,
      'total'			=> $GLOBALS['wp_query']->max_num_pages,
      'prev_next'	=> true,
      'prev_text'	=> __( 'Previous','zinnia-theme' ),
      'next_text'	=> __( 'Next','zinnia-theme' ),
    ) );
    if ( $links ) :
    ?>
      <section class="pagination">
        <p><?php echo $links; ?></p>
      </section>
    <?php endif;
}