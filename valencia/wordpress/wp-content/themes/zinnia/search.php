<?php get_header(); ?>

  <section class="section-wide" role="main">

    <?php if ( have_posts() ) : ?>
  
      <h2 class="pagetitle"><?php _e( 'Searching for','zinnia-theme' ); ?> &quot;<?php the_search_query(); ?>&quot;</h2>

    <?php while ( have_posts() ) : the_post(); ?>

      <?php get_template_part( 'content', get_post_format() ); ?>

    <?php endwhile; ?>

      <?php echo zinnia_get_pagination_links(); ?>

    <?php else : get_template_part( 'content', 'none' ); endif; ?>

  </section><!-- .section -->

  <?php get_sidebar(); ?>

<?php get_footer(); ?>