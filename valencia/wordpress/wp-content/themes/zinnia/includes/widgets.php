<?php
// ==================================================================
// Widget - Sidebar
// ==================================================================
function zinnia_right_widgets_init() {
  register_sidebar( array(
    'name'          => __( 'Footer widgets','zinnia-theme' ),
    'id'            => 'right-widget-1',
    'class'         => '',
    'description'   => 'Footer widget area',
    'before_widget' => '<article class="side-widget">',
    'after_widget'  => '</article>',
    'before_title'  => '<h3>',
    'after_title'   => '</h3>',
  ) );
}
add_action( 'widgets_init', 'zinnia_right_widgets_init' );