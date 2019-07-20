    <article <?php post_class( "article hentry" ); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Article">

      <header class="post-header">
        <section class="header-meta">
          <time datetime="<?php the_time( get_option( 'date_format' ) ); ?>" itemprop="datePublished" pubdate class="post-date updated"><?php the_time( get_option( 'date_format' ) ) ?></time>
          <section class="post-category"><?php the_category( ', ' ); ?> | <?php comments_popup_link( __( '0 comment','zinnia-theme' ), __( '1 Comment','zinnia-theme' ), __( '% Comments','zinnia-theme' ) ); ?></section>
        </section>
        <h2 class="post-title entry-title" itemprop="name"><a href="<?php the_permalink(); ?>" rel="<?php esc_attr_e( 'bookmark','zinnia-theme' ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
      </header>

      <article class="post-content">

        <?php the_content(); ?>

        <?php echo zinnia_get_link_pages() ?>

        <section class="post-author-bio">
          <?php echo get_avatar( get_the_author_meta( 'email' ) , 64 ); ?>
          <?php echo get_the_author_meta( 'description' ); ?>
        </section>

        <footer class="post-footer">
          <p><?php the_tags( 'Tags: ', ', ', '<br />' ); ?></p>
          <ul class="footer-navi">
            <?php previous_post_link( '<li class="previous" rel="prev">&laquo; %link</li>' ); ?>
            <?php next_post_link( '<li class="next" rel="next">%link &raquo;</li>' ); ?>
          </ul>
        </footer><!-- .post-footer -->

        <?php comments_template( '/comments.php',true ); ?>

      </article><!-- .post-content -->

    </article><!-- .article -->