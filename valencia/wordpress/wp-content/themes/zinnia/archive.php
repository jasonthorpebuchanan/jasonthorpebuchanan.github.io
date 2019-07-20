<?php get_header(); ?>

  <section class="section-wide" role="main">

    <?php if ( have_posts() ) : ?>
      <?php if ( is_category() ) { ?>
        <h3 class="pagetitle"><?php _e( 'Archive of','zinnia-theme' ); ?> &#8216;<?php single_cat_title(); ?>&#8217; <?php _e( 'category','zinnia-theme' ); ?></h3>
      <?php } elseif ( is_tag() ) { ?>
        <h3 class="pagetitle"><?php _e( 'Posts Tagged','zinnia-theme' ); ?> &#8216;<?php single_tag_title(); ?>&#8217;</h3>
      <?php } elseif ( is_day() ) { ?>
        <h3 class="pagetitle"><?php echo get_the_date( 'F jS Y' ); ?> <?php _e( 'archive','zinnia-theme' ); ?></h3>
      <?php } elseif ( is_month() ) { ?>
        <h3 class="pagetitle"><?php echo get_the_date( 'F Y' ); ?> <?php _e( 'archive','zinnia-theme' ); ?></h3>
      <?php } elseif ( is_year() ) { ?>
        <h3 class="pagetitle"><?php echo get_the_date( 'Y' ); ?> <?php _e( 'archive','zinnia-theme' ); ?></h3>
      <?php } elseif ( is_author() ) { ?>
        <h3 class="pagetitle"><?php _e( 'Author Archive','zinnia-theme' ); ?></h3>
      <?php } ?>
    <?php while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'content', 'list' ); ?>

    <?php endwhile; ?>

      <?php echo zinnia_get_pagination_links(); ?>

    <?php else : get_template_part( 'content', 'none' ); endif; ?>

  </section><!-- .section -->

  <?php get_sidebar(); ?>

<?php get_footer(); ?>