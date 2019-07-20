<?php
/*
Template Name: Sitemap
*/
get_header(); ?>

  <section class="section-wide" role="main">

    <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>

    <article <?php post_class( "article" ); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Article">
  
      <header class="post-header">
        <h1 class="post-title" itemprop="name"><a href="<?php the_permalink() ?>" rel="<?php _e( 'bookmark','ace' ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h1>
      </header>
    
      <article class="post-content">

        <?php the_content(); ?>

        <section class="split-columns">
        <article class="left">
          <h3><?php _e( 'Pages','ace' ); ?></h3>
          <ul>
            <?php wp_list_pages( 'depth=1&sort_column=menu_order&title_li=' ); ?> 	
          </ul>
        </article>
        <section class="right">
          <h3><?php _e( 'Categories','ace' ); ?></h3>
          <ul>
            <?php wp_list_categories( 'title_li=&hierarchical=0&show_count=1' ) ?>	
          </ul>
        </article>
        </section>

        <?php
        $cats = get_categories();
        foreach ($cats as $cat) {
        query_posts( 'cat='.$cat->cat_ID );
        ?>
        <h2><?php echo $cat->cat_name; ?></h2>
        <ul>	
          <?php if ( have_posts() ) : while ( have_posts() ) : the_post(); ?>
          <li><a href="<?php the_permalink() ?>"><?php the_title(); ?></a> <span class="alignright"><small><?php _e( 'Comment','ace' ); ?> (<?php echo $post->comment_count ?>)</small></span></li>
          <?php endwhile; endif; wp_reset_query(); ?>
        </ul>
        <?php } ?>

      </article><!-- .post-content -->

    </article><!-- .article -->

    <?php endwhile; endif; ?>

  </section><!-- .section -->

  <?php get_sidebar(); ?>

<?php get_footer(); ?>