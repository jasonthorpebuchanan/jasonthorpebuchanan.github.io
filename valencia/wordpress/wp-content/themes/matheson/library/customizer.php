<?php
/**
 * Set up the default theme options
 *
 * @since 1.0.0
 */
function bavotasan_theme_options() {
	//delete_option( 'matheson_theme_options' );
	$default_theme_options = array(
		'width' => '992',
		'layout' => 'right',
		'primary' => 'col-md-8',
		'display_author' => 'on',
		'display_date' => 'on',
		'display_comment_count' => 'on',
		'display_categories' => 'on',
		'excerpt_content' => 'excerpt',
		'jumbo_headline_title' => 'A great big headline to catch some attention, because everyone likes attention',
		'jumbo_headline_text' => 'So you understand the roaring wave of fear that swept through the greatest city in the world just as Monday was dawning--the stream of flight rising swiftly to a torrent, lashing in a foaming tumult round the railway stations, banked up into a horrible struggle about the shipping in the Thames, and hurrying by every available channel northward and eastward.  By ten o\'clock the police organisation, and by midday even the railway organisations, were losing coherency, losing shape and efficiency, guttering, softening, running at last in that swift liquefaction of the social body.',
	);

	return get_option( 'matheson_theme_options', $default_theme_options );
}

if ( class_exists( 'WP_Customize_Control' ) ) {
	class Bavotasan_Textarea_Control extends WP_Customize_Control {
	    public $type = 'textarea';

	    public function render_content() {
	        ?>
	        <label>
	        <span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
	        <textarea rows="5" style="width:100%;" <?php $this->link(); ?>><?php echo esc_textarea( $this->value() ); ?></textarea>
	        </label>
	        <?php
	    }
	}

	class Bavotasan_Font_Control extends WP_Customize_Control {
	    public $type = 'select';
	    public $size = true;

	    public function render_content() {
			if ( empty( $this->choices ) )
				return;

			?>
			<label>
				<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
				<select <?php $this->link(); ?>>
					<?php
					foreach ( $this->choices as $label => $choices ) {
						echo '<optgroup label="' . esc_attr( $label ) . '">';
						foreach ( $choices as $css_font => $font_name ) {
							echo '<option value="' . esc_attr( $css_font ) . '"' . selected( $this->value(), $css_font, false ) . '>' . $font_name . '</option>';
						}
						echo '</optgroup>';
					}
					?>
				</select>
			</label>
	        <?php if ( $this->size ) { ?>
			<label>
				<input type="text" data-customize-setting-link="matheson_theme_options[<?php echo $this->id . '_size'; ?>]" style="width: 30px; margin-left: 5px;" /> px
			</label>
	        <?php
	        }
		}
	}

	class Bavotasan_Category_Dropdown_Control extends WP_Customize_Control {
		public function render_content() {
			$dropdown = wp_dropdown_categories( array(
				'name' => $this->id,
				'echo' => 0,
				'show_option_all' => __( 'All', 'matheson' ),
				'selected' => $this->value(),
				'class' => 'customize-dropdown-cats',
			) );

			// hackily add in the data link parameter.
			$dropdown = str_replace( '<select', '<select ' . $this->get_link(), $dropdown );

			printf( '<label class="customize-control-select"><span class="customize-control-title">%s</span> %s</label>',
				$this->label,
				$dropdown
			);
		}
	}

	class Bavotasan_Post_Layout_Control extends WP_Customize_Control {
	    public function render_content() {
			if ( empty( $this->choices ) )
				return;

			$name = '_customize-radio-' . $this->id;

			?>
			<style>
			#customize-control-layout .customize-control-title {
				margin-bottom: 5px;
			}

			#customize-control-layout label {
				display: block;
				clear: both;
				margin-bottom: 10px;
				position: relative;
			}

			#customize-control-layout label input {
				display: inline-block;
				margin-top: -80px;
			}

			#customize-control-layout div {
				width: 124px;
				height: 84px;
				background: url(<?php echo BAVOTASAN_THEME_URL; ?>/library/images/layout.jpg) no-repeat 0 0;
				display: inline-block;
			}

			#customize-control-layout .right {
				background-position: 0 -84px;
			}
			#customize-control-layout .separate {
				background-position: 0 -168px;
			}
			</style>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php
			foreach ( $this->choices as $value => $label ) :
				?>
				<label>
					<input type="radio" value="<?php echo esc_attr( $value ); ?>" name="<?php echo esc_attr( $name ); ?>" <?php $this->link(); checked( $this->value(), $value ); ?> />
					<?php echo '<div class="' . esc_attr( $value ) . '"></div>'; ?>
				</label>
				<?php
			endforeach;
			echo '<p class="description">' . __( 'Sidebars only appear on single posts and pages. All other pages are full width.', 'matheson' ) . '</p>';
	    }
	}
}

class Bavotasan_Customizer {
	public function __construct() {
		add_action( 'customize_register', array( $this, 'customize_register' ) );
	}

	/**
	 * Adds theme options to the Customizer screen
	 *
	 * This function is attached to the 'customize_register' action hook.
	 *
	 * @param	class $wp_customize
	 *
	 * @since 1.0.0
	 */
	public function customize_register( $wp_customize ) {
		$bavotasan_theme_options = bavotasan_theme_options();

		// Layout section panel
		$wp_customize->add_section( 'bavotasan_layout', array(
			'title' => __( 'Layout', 'matheson' ),
			'priority' => 35,
		) );

		$wp_customize->add_setting( 'matheson_theme_options[width]', array(
			'default' => $bavotasan_theme_options['width'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'absint',
		) );

		$wp_customize->add_control( 'bavotasan_width', array(
			'label' => __( 'Site Width', 'matheson' ),
			'section' => 'bavotasan_layout',
			'settings' => 'matheson_theme_options[width]',
			'priority' => 10,
			'type' => 'select',
			'choices' => array(
				'1200' => __( '1200px', 'matheson' ),
				'992' => __( '992px', 'matheson' ),
			),
		) );

		$choices =  array(
			'col-md-2' => '17%',
			'col-md-3' => '25%',
			'col-md-4' => '34%',
			'col-md-5' => '42%',
			'col-md-6' => '50%',
			'col-md-7' => '58%',
			'col-md-8' => '66%',
			'col-md-9' => '75%',
			'col-md-10' => '83%',
			'col-md-12' => '100%',
		);

		$wp_customize->add_setting( 'matheson_theme_options[primary]', array(
			'default' => $bavotasan_theme_options['primary'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
		) );

		$wp_customize->add_control( 'bavotasan_primary_column', array(
			'label' => __( 'Main Content Width', 'matheson' ),
			'section' => 'bavotasan_layout',
			'settings' => 'matheson_theme_options[primary]',
			'priority' => 15,
			'type' => 'select',
			'choices' => $choices,
		) );

		$wp_customize->add_setting( 'matheson_theme_options[layout]', array(
			'default' => $bavotasan_theme_options['layout'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
		) );

		$layout_choices = array(
			'left' => __( 'Left', 'matheson' ),
			'right' => __( 'Right', 'matheson' ),
		);

		$wp_customize->add_control( new Bavotasan_Post_Layout_Control( $wp_customize, 'layout', array(
			'label' => __( 'Sidebar Layout', 'matheson' ),
			'section' => 'bavotasan_layout',
			'settings' => 'matheson_theme_options[layout]',
			'size' => false,
			'priority' => 25,
			'choices' => $layout_choices,
		) ) );

		$wp_customize->add_setting( 'matheson_theme_options[excerpt_content]', array(
			'default' => $bavotasan_theme_options['excerpt_content'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_attr',
		) );

		$wp_customize->add_control( 'bavotasan_excerpt_content', array(
			'label' => __( 'Post Content Display', 'matheson' ),
			'section' => 'bavotasan_layout',
			'settings' => 'matheson_theme_options[excerpt_content]',
			'priority' => 30,
			'type' => 'radio',
			'choices' => array(
				'excerpt' => __( 'Teaser Excerpt', 'matheson' ),
				'content' => __( 'Full Content', 'matheson' ),
			),
		) );

		// Jumbo headline section panel
		$wp_customize->add_section( 'bavotasan_jumbo', array(
			'title' => __( 'Jumbo Headline', 'matheson' ),
			'priority' => 36,
			'description' => __( 'This section appears below the slider/header image on the home page. To remove it just delete all the content from the Title textarea.', 'matheson' ),
		) );

		$wp_customize->add_setting( 'matheson_theme_options[jumbo_headline_title]', array(
			'default' => $bavotasan_theme_options['jumbo_headline_title'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_textarea',
		) );

		$wp_customize->add_control( new Bavotasan_Textarea_Control( $wp_customize, 'jumbo_headline_title', array(
			'label' => __( 'Title', 'matheson' ),
			'section' => 'bavotasan_jumbo',
			'settings' => 'matheson_theme_options[jumbo_headline_title]',
			'priority' => 26,
			'type' => 'text',
		) ) );

		$wp_customize->add_setting( 'matheson_theme_options[jumbo_headline_text]', array(
			'default' => $bavotasan_theme_options['jumbo_headline_text'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => 'esc_textarea',
		) );

		$wp_customize->add_control( new Bavotasan_Textarea_Control( $wp_customize, 'jumbo_headline_text', array(
			'label' => __( 'Text', 'matheson' ),
			'section' => 'bavotasan_jumbo',
			'settings' => 'matheson_theme_options[jumbo_headline_text]',
			'priority' => 27,
			'type' => 'text',
		) ) );

		// Posts panel
		$wp_customize->add_section( 'bavotasan_posts', array(
			'title' => __( 'Posts', 'matheson' ),
			'priority' => 45,
		) );

		$wp_customize->add_setting( 'matheson_theme_options[display_categories]', array(
			'default' => $bavotasan_theme_options['display_categories'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );

		$wp_customize->add_control( 'bavotasan_display_categories', array(
			'label' => __( 'Display Categories', 'matheson' ),
			'section' => 'bavotasan_posts',
			'settings' => 'matheson_theme_options[display_categories]',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'matheson_theme_options[display_author]', array(
			'default' => $bavotasan_theme_options['display_author'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );

		$wp_customize->add_control( 'bavotasan_display_author', array(
			'label' => __( 'Display Author', 'matheson' ),
			'section' => 'bavotasan_posts',
			'settings' => 'matheson_theme_options[display_author]',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'matheson_theme_options[display_date]', array(
			'default' => $bavotasan_theme_options['display_date'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );

		$wp_customize->add_control( 'bavotasan_display_date', array(
			'label' => __( 'Display Date', 'matheson' ),
			'section' => 'bavotasan_posts',
			'settings' => 'matheson_theme_options[display_date]',
			'type' => 'checkbox',
		) );

		$wp_customize->add_setting( 'matheson_theme_options[display_comment_count]', array(
			'default' => $bavotasan_theme_options['display_comment_count'],
			'type' => 'option',
			'capability' => 'edit_theme_options',
            'sanitize_callback' => array( $this, 'sanitize_checkbox' ),
		) );

		$wp_customize->add_control( 'bavotasan_display_comment_count', array(
			'label' => __( 'Display Comment Count', 'matheson' ),
			'section' => 'bavotasan_posts',
			'settings' => 'matheson_theme_options[display_comment_count]',
			'type' => 'checkbox',
		) );
	}

	/**
	 * Sanitize checkbox options
	 *
	 * @since 1.0.2
	 */
    public function sanitize_checkbox( $value ) {
        if ( 'on' != $value )
            $value = false;

        return $value;
    }
}
$bavotasan_customizer = new Bavotasan_Customizer;