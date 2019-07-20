<?php get_header(); ?>

  <section class="section-wide" role="main">

    <article class="article" itemscope itemtype="http://schema.org/Article">

      <header class="post-header">
        <h1 class="post-title"><?php _e( 'Error 404 - Not Found','zinnia-theme' ); ?></h1>
      </header>

      <article class="post-content">

        <p><?php if ( get_option( 'zinnia_404_page' ) == true ) { echo esc_html( get_option( 'zinnia_404_page' ) ); } else { echo _e( '404 Not Found','zinnia-theme' ); } ?></p>

        <?php get_search_form();?>

        <section class="split-columns">
        <article class="left">
          <h3><?php _e( 'Archives by month:','zinnia-theme' ); ?></h3>
          <ul>
            <?php wp_get_archives( 'type=monthly' ); ?>
          </ul>
        </article>
        <section class="right">
          <h3><?php _e( 'Archives by category:','zinnia-theme' ); ?></h3>
          <ul>
            <?php wp_list_categories( 'sort_column=name' ); ?>
          </ul>
        </article>
        </section>

      </article><!-- .post-content -->

    </article><!-- .article -->

  </section><!-- .section -->

  <?php get_sidebar(); ?>

<?php get_footer(); ?>