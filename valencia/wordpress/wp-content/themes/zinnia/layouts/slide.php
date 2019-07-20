<?php if ( is_sticky() ) { ?>

<section class="responsiveslides">
  <ul class="responsiveslides-slide">
    <?php
    $args = array(
      'post_type' => 'post',
      'post__in' => get_option('sticky_posts'),
    );
    $query = new WP_Query( $args ); while ( $query->have_posts() ) : $query->the_post(); ?>
    <li>
      <a href="<?php the_permalink() ?>">
        <?php if ( has_post_thumbnail() ) { $slide_img = wp_get_attachment_image_src( get_post_thumbnail_id( $post->ID ), 'slide_image', false, '' ); ?>
          <?php the_post_thumbnail( 'slide_image' ); ?>
        <?php } else { ?>
          <img src="<?php echo get_template_directory_uri(); ?>/images/slide_default.jpg" alt="<?php the_title(); ?>" title="<?php the_title(); ?>" />
        <?php } ?>
      </a>
      <?php if ( get_option( "ace_feature_title_enable" ) ) { ?>
        <article class="responsiveslides-caption">
        <h3><?php the_title(); ?></h3>
        <?php the_excerpt(); ?>
        </article>
      <?php } ?>
    </li>
    <?php endwhile; wp_reset_query(); ?>
  </ul>
</section>

<script type="text/javascript">
/* <![CDATA[ */
jQuery(document).ready(function($){ // START

  $( ".responsiveslides-slide" ).responsiveSlides({
    auto: true,             // Boolean: Animate automatically, true or false
    speed: 500,             // Integer: Speed of the transition, in milliseconds
    timeout: 3000,          // Integer: Time between slide transitions, in milliseconds
    pager: true,           // Boolean: Show pager, true or false
    nav: true,             // Boolean: Show navigation, true or false
    random: false,          // Boolean: Randomize the order of the slides, true or false
    pause: true,           // Boolean: Pause on hover, true or false
    pauseControls: true,    // Boolean: Pause when hovering controls, true or false
    prevText: "Previous",   // String: Text for the "previous" button
    nextText: "Next",       // String: Text for the "next" button
    maxwidth: "",           // Integer: Max-width of the slideshow, in pixels
    navContainer: "",       // Selector: Where controls should be appended to, default is after the 'ul'
    manualControls: "",     // Selector: Declare custom pager navigation
    namespace: "responsiveslides",   // String: Change the default namespace used
    before: function(){},   // Function: Before callback
    after: function(){}     // Function: After callback
  });

}); // END
/* ]]> */
</script>

<?php } ?>