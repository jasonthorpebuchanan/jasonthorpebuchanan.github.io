<section class="comment-box">

<?php
if ( !empty( $_SERVER['SCRIPT_FILENAME'] ) && 'comments.php' == basename( $_SERVER['SCRIPT_FILENAME'] ) )
  die ( 'Please do not load this page directly. Thanks!' );
if ( post_password_required() ) { ?>
  <p class="nocomments"><?php _e( 'This post is password protected. Enter the password to view comments','zinnia-theme' ); ?>.</p>
<?php return; } ?>

<!-- You can start editing here. -->
  <?php if ( have_comments() ) : ?>

    <section class="comment-pagination">
      <section class="alignleft"><?php previous_comments_link( __( 'Older comments','zinnia-theme' ) ) ?></section>
      <section class="alignright"><?php next_comments_link( __( 'Newer comments','zinnia-theme' ) ) ?></section>
    </section>

  <?php if ( !empty( $comments_by_type['comment'] ) ) { ?>
    <h4 id="comments"><?php comments_number( __( '0 comment','zinnia-theme' ), __( '1 Comment','zinnia-theme' ), __( '% Comments','zinnia-theme' ) ); ?> <?php _e( 'on','zinnia-theme' ); ?> <?php the_title(); ?></h4>
    <ol class="commentlist">
      <?php wp_list_comments( 'type=comment&callback=zinnia_comment_style' ); ?>
    </ol>
  <?php } if ( !empty( $comments_by_type['pings'] ) ) { ?>
    <h4 id="comments"><?php echo count( $wp_query->comments_by_type['pings'] ); ?><?php _e( 'Pingbacks &amp; Trackbacks on','zinnia-theme' ); ?> <?php the_title(); ?></h4>
    <ol class="commentlist">
      <?php wp_list_comments( 'type=pingback' ); ?>
    </ol>
  <?php } ?>

    <section class="comment-pagination">
      <section class="alignleft"><?php previous_comments_link( __( 'Older comments','zinnia-theme' ) ) ?></section>
      <section class="alignright"><?php next_comments_link( __( 'Newer comments','zinnia-theme' ) ) ?></section>
    </section>

  <?php else : // this is displayed if there are no comments so far ?>

    <?php if ( 'open' == $post->comment_status) : ?>

    <?php else : // comments are closed ?>

      <?php if ( is_page() ) : else : ?>
        <p class="nocomments"><?php _e( 'Comments are closed','zinnia-theme' ); ?>.</p>
      <?php endif; ?>

    <?php endif; ?>

  <?php endif; ?>

  <?php if ( 'open' == $post->comment_status) : ?>

  <section id="respond">

    <?php comment_form(); ?>

  </section>
  <?php endif; // if you delete this the sky will fall on your head ?>
</section>