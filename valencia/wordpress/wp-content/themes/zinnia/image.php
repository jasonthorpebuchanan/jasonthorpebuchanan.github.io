<?php get_header(); ?>

  <section class="section-wide" role="main">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article <?php post_class( "article" ); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Article">

      <header class="post-header">
        <h1 class="post-title"><?php the_title(); ?></h1>
      </header>

      <img src="<?php echo wp_get_attachment_url( $post->ID ); ?>" alt="<?php the_title(); ?>" class="centered" />

      <article class="attachment-caption"><?php the_excerpt(); ?></article>

      <article class="attachment-desc"><?php the_content(); ?></article>

    </article><!-- .article -->

    <?php endwhile; endif; ?>

  </section><!-- .section -->

  <?php get_sidebar(); ?>

<?php get_footer(); ?>