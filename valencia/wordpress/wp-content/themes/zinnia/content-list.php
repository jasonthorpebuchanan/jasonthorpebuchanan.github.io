    <article <?php post_class( "article hentry" ); ?> id="post-<?php the_ID(); ?>" itemscope itemtype="http://schema.org/Article">

      <header class="post-header">
        <section class="header-meta">
          <time datetime="<?php the_time( get_option( 'date_format' ) ); ?>" itemprop="datePublished" pubdate class="post-date updated"><?php the_time( get_option( 'date_format' ) ) ?></time>
          <section class="post-category"><?php the_category( ', ' ); ?> | <?php comments_popup_link( __( '0 comment','zinnia-theme' ), __( '1 Comment','zinnia-theme' ), __( '% Comments','zinnia-theme' ) ); ?></section>
        </section>
        <h2 class="post-title entry-title" itemprop="name"><a href="<?php the_permalink(); ?>" rel="<?php esc_attr_e( 'bookmark','zinnia-theme' ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a></h2>
      </header>
    
      <article class="post-content">

        <?php if ( has_post_thumbnail() ) { the_post_thumbnail( 'post_thumb', array( 'class'=>'aligncenter' ) ); } ?>

        <?php the_content(); ?>

      </article><!-- .post-content -->

    </article><!-- .article -->