<h5 class="post-related-title"><?php _e( 'More related articles','ace' ); ?></h5>
<ul class="post-related">
  <?php
  $tags = wp_get_post_tags($post->ID);
  if ($tags) {$tag_ids = array(); foreach($tags as $individual_tag) $tag_ids[] = $individual_tag->term_id;
  $args=array(
  'tag__in' => $tag_ids,
  'post__not_in' => array($post->ID),
  'showposts'=>5,
  'ignore_sticky_posts'=>1
  );
  $my_query = new wp_query($args);
  if ( $my_query->have_posts() ) { while ($my_query->have_posts()) { $my_query->the_post();
  ?>
    <li>
      <a href="<?php the_permalink() ?>">
      <?php if ( has_post_thumbnail() ) { $slide_img = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'related_thumb', false, '' ); ?>
        <?php the_post_thumbnail( 'slide_image' ); ?>
      <?php } else { ?>
        <img src="<?php echo get_template_directory_uri(); ?>/images/related_thumb.jpg" alt="<?php the_title_attribute(); ?>" />
      <?php } ?>
      </a>
      <a href="<?php the_permalink() ?>" rel="<?php esc_attr_e( 'bookmark','ace' ); ?>" title="<?php the_title_attribute(); ?>"><?php the_title(); ?></a>
    </li>
  <?php } wp_reset_query(); } } ?>
</ul>