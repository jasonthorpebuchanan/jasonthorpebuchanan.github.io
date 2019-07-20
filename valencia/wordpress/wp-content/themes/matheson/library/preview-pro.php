<?php
class Bavotasan_Preview_Pro {
	private $theme_url = 'https://themes.bavotasan.com/2014/matheson-pro/';

	public function __construct() {
		add_action( 'admin_menu', array( $this, 'admin_menu' ) );
	}

	/**
	 * Add a 'Preview Pro' menu item to the Appearance panel
	 *
	 * This function is attached to the 'admin_menu' action hook.
	 *
	 * @since 1.0.0
	 */
	public function admin_menu() {
		add_theme_page( sprintf( __( 'Upgrade to %s Pro', 'matheson' ), BAVOTASAN_THEME_NAME ), sprintf( __( 'Upgrade %s', 'matheson' ), BAVOTASAN_THEME_NAME ), 'edit_theme_options', 'bavotasan_preview_pro', array( $this, 'bavotasan_preview_pro' ) );
	}

	public function bavotasan_preview_pro() {
		?>
		<style>
		.about-wrap h1,
		.about-text {
			margin-right: 0;
		}

		.about-wrap .feature-section img {
			max-width: 65%;
		}

		.about-wrap .feature-section.images-stagger-right img {
			float: right;
			margin: 0 0 12px 2em;
		}

		.about-wrap .feature-section.images-stagger-left img {
			float: left;
			margin: 0 2em 12px 0;
		}

		.about-wrap .feature-section img {
			background: #fff;
			border: 1px #ccc solid;
			-webkit-box-shadow: 0 1px 3px rgba(0,0,0,0.3);
			box-shadow: 0 1px 3px rgba(0,0,0,0.3);
			-webkit-corder-radius: 3px;
			border-radius: 3px;
		}

		@media (max-width: 768px) {
			.about-wrap .feature-section img {
				max-width: 100%;
			}
		}
		</style>
		<div class="wrap about-wrap" id="custom-background">
			<h1><?php echo get_admin_page_title(); ?></h1>
			<div class="about-text">
				<?php printf( __( 'Take your site to the next level with %s. Check out some of the advanced features that\'ll give you more control over your site\'s layout and design.', 'matheson' ), '<em>' . BAVOTASAN_THEME_NAME . ' Pro</em>' ); ?>
			</div>
			<h2 class="nav-tab-wrapper">
				<?php _e( 'Features', 'matheson' ); ?>
			</h2>

			<div class="changelog">
				<h3><?php _e( 'Featured Slider', 'matheson' ); ?></h3>

				<div class="feature-section images-stagger-right">
					<img alt="" src="<?php echo BAVOTASAN_THEME_URL; ?>/library/images/slider.jpg" class="image-66">
					<h4><?php _e( 'Focus on What\'s Important', 'matheson' ); ?></h4>
					<p><?php printf( __( 'The most important information on your site should be at the top. That\'s why %s offers a featured slider directly below your site title. Get your point across as soon as your site loads.', 'matheson' ), '<em>' . BAVOTASAN_THEME_NAME . ' Pro</em>' ); ?></p>
					<p><?php _e( 'Use the Slider admin page to create/edit each custom slide or let the default set up feature your latest posts.', 'matheson' ); ?></p>
				</div>
			</div>

			<div class="changelog">
				<h3><?php _e( 'Social Menu', 'matheson' ); ?></h3>

				<div class="feature-section images-stagger-left">
					<img alt="" src="<?php echo BAVOTASAN_THEME_URL; ?>/library/images/social-menu.jpg" class="image-66">
					<h4><?php _e( 'Let\'s Get Social!', 'matheson' ); ?></h4>
					<p><?php _e( 'Establish your online presense by letting your visitors join your social network. Help them stay up to date on everything you\'re doing', 'matheson' ); ?></p>
					<p><?php _e( 'Easily add a social menu by creating links to the most popular social media websites.', 'matheson' ); ?></p>
				</div>
			</div>

			<div class="changelog">
				<h3><?php _e( 'Grid Page Template', 'matheson' ); ?></h3>

				<div class="feature-section images-stagger-right">
					<img alt="" src="<?php echo BAVOTASAN_THEME_URL; ?>/library/images/grid-template.jpg" class="image-66">
					<h4><?php _e( 'Line Up Your Posts', 'matheson' ); ?></h4>
					<p><?php _e( 'Why display your posts in a single column when you can take advantage of the included grid page template?', 'matheson' );?>
					<p><?php _e( 'Each post will appear as part of the three columns grid. Use the custom field "category_name" to specify which category feeds your grid.', 'matheson' ); ?></p>
				</div>
			</div>

			<div class="changelog">
				<h3><?php _e( 'Google Fonts', 'matheson' ); ?></h3>

				<div class="feature-section images-stagger-left">
					<img alt="" src="<?php echo BAVOTASAN_THEME_URL; ?>/library/images/google-fonts.jpg" class="image-66">
					<h4><?php _e( 'Over 20 to Choose From', 'matheson' ); ?></h4>
					<p><?php _e( 'Web-safe fonts are a thing of the past, so why not try to spice things up a bit?', 'matheson' ); ?></p>
					<p><?php _e( 'Choose from some of Google Fonts\' most popular fonts to improve your site\'s typeface readability and make things look even more amazing.', 'matheson' ); ?></p>
				</div>
			</div>

			<div class="changelog">
				<h3><?php _e( 'Extended Widgetized Footer', 'matheson' ); ?></h3>

				<div class="feature-section images-stagger-right">
					<img alt="" src="<?php echo BAVOTASAN_THEME_URL; ?>/library/images/extended-footer.jpg" class="image-66">
					<h4><?php _e( 'Add More Widgets', 'matheson' ); ?></h4>
					<p><?php _e( 'If you need to include more widgets on your site, take advantage of the Extended Footer.', 'matheson' ); ?></p>
					<p><?php _e( 'Use the Theme Options customizer to set the number of columns you want to appear. You can also customize your site\'s copyright notice.', 'matheson' ); ?></p>
				</div>
			</div>

			<div class="changelog">
				<h3><?php _e( 'Even More Theme Options', 'matheson' ); ?></h3>
				<div class="feature-section col two-col">
					<div>
						<h4><?php _e( 'Full Width Posts/Pages', 'matheson' ); ?></h4>
						<p><?php _e( 'Each page/post has an option to remove both sidebars so you can use the full width of your site to display whatever you want.', 'matheson' ); ?></p>
					</div>
					<div class="last-feature">
						<h4><?php _e( 'Multiple Sidebar Layouts', 'matheson' ); ?></h4>
						<p><?php _e( 'Sometimes one sidebar just isn\'t enough, so add a second one and place it where you want.', 'matheson' ); ?></p>
					</div>
				</div>

				<div class="feature-section col two-col">
					<div>
						<h4><?php _e( 'Bootstrap Shortcodes', 'matheson' ); ?></h4>
						<p><?php printf( __( 'Shortcodes are awesome and easy to use. That\'s why %s comes with a bunch, like a slideshow carousel, alert boxes and more.', 'matheson' ), '<em>' . BAVOTASAN_THEME_NAME . ' Pro</em>' ); ?></p>
					</div>
					<div class="last-feature">
						<h4><?php _e( 'Import/Export Tool', 'matheson' ); ?></h4>
						<p><?php _e( 'Once you\'ve set up your site exactly how you want, you can easily export the Theme Options and Custom CSS for safe keeping.', 'matheson' ); ?></p>
					</div>
				</div>
			</div>

			<p><a href="<?php echo $this->theme_url; ?>" target="_blank" class="button-primary button-large"><?php printf( __( 'Buy %s Now &rarr;', 'matheson' ), '<strong>' . BAVOTASAN_THEME_NAME . ' Pro</strong>' ); ?></a></p>
		</div>
		<?php
	}
}
$bavotasan_preview_pro = new Bavotasan_Preview_Pro;