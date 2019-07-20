<?php
/**
 * Striker functions and definitions
 *
 * @package Striker
 * @since Striker 1.0
 */

/**
 * Set the content width based on the theme's design and stylesheet.
 *
 * @since Striker 1.0
 */
if ( ! isset( $content_width ) )
	$content_width = 654; /* pixels */

if ( ! function_exists( 'striker_setup' ) ):
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which runs
 * before the init hook. The init hook is too late for some features, such as indicating
 * support post thumbnails.
 *
 * @since Striker 1.0
 */
function striker_setup() {

	/**
	 * Custom template tags for this theme.
	 */
	require( get_template_directory() . '/inc/template-tags.php' );

	/**
	 * Custom functions that act independently of the theme templates
	 */
	require( get_template_directory() . '/inc/tweaks.php' );

	/**
	 * Make theme available for translation
	 * Translations can be filed in the /languages/ directory
	 * If you're building a theme based on Striker, use a find and replace
	 * to change 'striker' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'striker', get_template_directory() . '/languages' );

	/**
	 * Add default posts and comments RSS feed links to head
	 */
	add_theme_support( 'automatic-feed-links' );

	/**
	 * This theme uses wp_nav_menu() in one location.
	 */
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'striker' ),
	) );

	/**
	 * Add support for the Aside Post Formats
	 */
	add_theme_support( 'post-formats', array( 'aside', ) );
	
	/**
	 * Add support for post thumbnails
	 */
	add_theme_support('post-thumbnails');
	add_image_size(100, 300, true);

}
endif; // striker_setup
add_action( 'after_setup_theme', 'striker_setup' );

/**
 * Setup the WordPress core custom background feature.
 *
 * Use add_theme_support to register support for WordPress 3.4+
 * as well as provide backward compatibility for previous versions.
 * Use feature detection of wp_get_theme() which was introduced
 * in WordPress 3.4.
 *
 * Hooks into the after_setup_theme action.
 *
 * @since Striker 1.0
 */
function striker_register_custom_background() {
	$args = array(
		'default-color' => 'FFF',
	);

	$args = apply_filters( 'striker_custom_background_args', $args );

	if ( function_exists( 'wp_get_theme' ) ) {
		add_theme_support( 'custom-background', $args );
	} else {
		define( 'BACKGROUND_COLOR', $args['default-color'] );
		define( 'BACKGROUND_IMAGE', $args['default-image'] );
		add_theme_support( 'custom-background', $args );
	}
}
add_action( 'after_setup_theme', 'striker_register_custom_background' );

/**
 * Register widgetized area and update sidebar with default widgets
 *
 * @since Striker 1.0
 */
function striker_widgets_init() {
		register_sidebar( array(
			'name' => __( 'Primary Sidebar', 'striker' ),
			'id' => 'sidebar-1',
			'before_widget' => '<aside id="%1$s" class="widget %2$s">',
			'after_widget' => '</aside>',
			'before_title' => '<h1 class="widget-title">',
			'after_title' => '</h1>',
		) );
	
		register_sidebar(array(
			'name' => 'Left Column',
			'id'   => 'left_column',
			'description'   => 'Widget area for home page left column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => 'Center Column',
			'id'   => 'center_column',
			'description'   => 'Widget area for home page center column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));
		register_sidebar(array(
			'name' => 'Right Column',
			'id'   => 'right_column',
			'description'   => 'Widget area for home page right column',
			'before_widget' => '<div id="%1$s" class="widget %2$s">',
			'after_widget'  => '</div>',
			'before_title'  => '<h4>',
			'after_title'   => '</h4>'
		));

}
add_action( 'widgets_init', 'striker_widgets_init' );


/**
	 * Customizer additions
	 */
	require( get_template_directory() . '/inc/customizer.php' );



/**
 * Enqueue scripts and styles
 */
function striker_scripts() {
	wp_enqueue_style( 'style', get_stylesheet_uri() );
	
	if (!is_admin()) {
	wp_enqueue_script( 'small-menu', get_template_directory_uri() . '/js/small-menu.js', array( 'jquery' ), '20120206', true );
	}

	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}

	if ( is_singular() && wp_attachment_is_image() ) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
	
	if (!is_admin()) {
		wp_enqueue_script( 'keyboard-image-navigation', get_template_directory_uri() . '/js/keyboard-image-navigation.js', array( 'jquery' ), '20120202' );
	}
}
add_action( 'wp_enqueue_scripts', 'striker_scripts' );

/**
 * Implement the Custom Header feature
 */
require( get_template_directory() . '/inc/custom-header.php' );


/**
 * Implement home slider
 */

function striker_add_scripts() {
	if (!is_admin()) {
    wp_enqueue_script('flexslider', get_stylesheet_directory_uri('stylesheet_directory').'/js/jquery.flexslider-min.js', array('jquery'));
    wp_enqueue_script('flexslider-init', get_stylesheet_directory_uri('stylesheet_directory').'/js/flexslider-init.js', array('jquery', 'flexslider'));
	}
}
add_action('wp_enqueue_scripts', 'striker_add_scripts');

function striker_add_styles() {
	if (!is_admin()) {
    wp_enqueue_style('flexslider', get_stylesheet_directory_uri('stylesheet_directory').'/js/flexslider.css');
	}
}
add_action('wp_enqueue_scripts', 'striker_add_styles');

/**
 * Implement the Custom Logo feature
 */
function striker_theme_customizer( $wp_customize ) {
   
   $wp_customize->add_section( 'striker_logo_section' , array(
    'title'       => __( 'Logo', 'striker' ),
    'priority'    => 30,
    'description' => 'Upload a logo to replace the default site name and description in the header',
) );

   $wp_customize->add_setting( 'striker_logo' );

$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'striker_logo', array(
    'label'    => __( 'Logo', 'striker' ),
    'section'  => 'striker_logo_section',
    'settings' => 'striker_logo',
) ) );

$wp_customize->add_section( 'striker_color_scheme_settings', array(
		'title'       => __( 'Color Scheme', 'striker' ),
		'priority'    => 30,
		'description' => __( 'Color scheme', 'striker' ),
	) );

	$wp_customize->add_setting( 'striker_color_scheme', array(
		'default'        => 'black',
	) );

	$wp_customize->add_control( 'striker_color_scheme', array(
		'label'   => __( 'Choose a color scheme', 'striker' ),
		'section' => 'striker_color_scheme_settings',
		'default'        => 'black',
		'type'       => 'radio',
		'choices'    => array(
			__( 'Black', 'striker' ) => 'black',
			__( 'Red', 'striker' ) => 'red',
			__( 'Blue', 'striker' ) => 'blue',
			__( 'Orange', 'striker' ) => 'orange',
		),
	));

}
add_action('customize_register', 'striker_theme_customizer');

/**
 * Adds the individual section for featured text box
 */
function striker_customizer( $wp_customize ) {
    $wp_customize->add_section(
        'featured_section_one',
        array(
            'title' => 'Featured Text Area',
            'description' => 'This is a settings section to change the homepage featured text area.',
            'priority' => 35,
        )
    );
	
	$wp_customize->add_setting(
    'featured_textbox',
    array(
        'default' => 'Default featured text',
    )
);

$wp_customize->add_control(
    'featured_textbox',
    array(
        'label' => 'Featured text',
        'section' => 'featured_section_one',
        'type' => 'text',
    )
);

$wp_customize->add_setting(
		'featured_textbox_text',
		array(
			'default' => 'Default featured text',
			'sanitize_callback' => 'striker_sanitize_text',
		)
	);
	
	$wp_customize->add_control(
		'featured_textbox_text',
		array(
			'label' => 'Featured text',
			'section' => 'featured_section_one',
			'type' => 'text',
		)
	);
}
add_action( 'customize_register', 'striker_customizer' );

add_filter( 'wp_title', 'striker_wp_title' );

/**
 * sanitize customizer text input
 */
 function striker_sanitize_text( $input ) {
    return wp_kses_post( force_balance_tags( $input ) );
}
/**
 * Filters the page title appropriately depending on the current page
 *
 * This function is attached to the 'wp_title' fiilter hook.
 *
 * @uses	get_bloginfo()
 * @uses	is_home()
 * @uses	is_front_page()
 */
function striker_wp_title( $title ) {
	global $page, $paged;

	if ( is_feed() )
		return $title;

	$site_description = get_bloginfo( 'description' );

	$filtered_title = $title . get_bloginfo( 'name' );
	$filtered_title .= ( ! empty( $site_description ) && ( is_home() || is_front_page() ) ) ? ' | ' . $site_description: '';
	$filtered_title .= ( 2 <= $paged || 2 <= $page ) ? ' | ' . sprintf( __( 'Page %s', 'striker' ), max( $paged, $page ) ) : '';

	return $filtered_title;
}
function striker_add_customizer_css() { ?>
 
	<link rel="stylesheet" href="<?php echo get_template_directory_uri();?>/css/<?php echo strtolower( get_theme_mod( 'striker_color_scheme', 'black' ) ); ?>.css" type="text/css" media="screen">
 
<?php }
add_action( 'wp_head', 'striker_add_customizer_css' );