<?php get_header(); ?>

  <section class="section-wide" role="main">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article <?php post_class( "article" ); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Article">

      <header class="post-header">
        <h1 class="post-title" itemprop="name"><a href="<?php the_permalink() ?>" rel="<?php esc_attr_e( 'bookmark','zinnia-theme' ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
      </header>
 
      <article class="post-content">

        <?php the_content(); ?>

        <?php echo zinnia_get_link_pages() ?>

        <?php comments_template( '/comments.php',true ); ?>

      </article><!-- .post-content -->

    </article><!-- .article -->

    <?php endwhile; endif; ?>

  </section><!-- .section -->

  <?php get_sidebar(); ?>

<?php get_footer(); ?>