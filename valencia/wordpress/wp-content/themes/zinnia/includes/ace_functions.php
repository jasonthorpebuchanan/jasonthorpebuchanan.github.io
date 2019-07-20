<?php
// ==================================================================
// Theme slider
// ==================================================================
function zinnia_theme_slider() {
  if ( is_front_page() ) {
    echo get_template_part( 'layouts/slide' );
  }
}

// ==================================================================
// Heading
// ==================================================================
function zinnia_heading() {
  if ( get_header_image() ) { ?>
    <a href="<?php echo esc_url( home_url() ); ?>">
      <img src="<?php header_image(); ?>" class="header-title" height="<?php echo get_custom_header()->height; ?>" width="<?php echo get_custom_header()->width; ?>" alt="<?php bloginfo( 'name' ); ?>" title="<?php bloginfo( 'name' ); ?>" />
    </a>
    <h1 class="header-text"><a href="<?php echo esc_url( home_url() ); ?>"><?php bloginfo( 'name' ); ?></a></h1>
    <p class="header-text-desc"><?php bloginfo( 'description' ); ?></p>
  <?php } elseif ( is_home() || is_front_page() ) { ?>
      <h1><a href="<?php echo esc_url( home_url() ); ?>" class="header-title"><?php bloginfo( 'name' ); ?></a></h1>
      <p class="header-desc"><?php bloginfo( 'description' ); ?></p>
  <?php } else { ?>
      <h5><a href="<?php echo esc_url( home_url() ); ?>" class="header-title"><?php bloginfo( 'name' ); ?></a></h5>
      <p class="header-desc"><?php bloginfo( 'description' ); ?></p>
  <?php }
}