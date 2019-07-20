<?php 
/*
Copyright: Themes by Fimply
Theme: elegantWhite

All rights reserved.
Alle Rechte vorbehalten.
*/
?>

<?php get_header(); ?>

<div id="second-container">

<div id="content">


<?php if (have_posts()) : while (have_posts()) : the_post(); ?>

  <div id="post" <?php post_class(); ?>>
  
  <?php if ( is_sticky() ) : ?><div class="post-title"><?php _e( 'Featured', 'elegantwhite' ); ?></div><?php endif; ?>
  
  <h1><a class="h1" href="<?php esc_url( the_permalink() ); ?>"><?php the_title(); ?></a></h1>
 
  
  <div id="articledate"><span class="date"><?php elegantwhite_get_date(); ?></span></div>
  
    <?php if ( has_post_thumbnail() ) { ?><a href="<?php esc_url ( the_permalink() ); ?>"><div id="post-thumbnail"><?php the_post_thumbnail(); ?></div></a><?php } ?>
  
   <?php the_content(); ?>
   
   
  <div id="clear"></div>
  
   <div class="page-links"><?php wp_link_pages('before=<div class="page-title">PAGES</div>'); ?></div>
    
       
    <div class="tag-links"><?php the_tags('<div class="tags-title">TAGS</div>', '', ''); ?></div><div id="clear"></div>     
    <div class="category-links"><div class="tags-title"><?php _e( 'CATEGORIES', 'elegantWhite' ); ?></div><?php the_category(''); ?></div><div id="clear"></div>
  
  
  </div>
<p><div class="alignleft"><?php previous_post_link(); ?></div>    <div class="alignright"><?php next_post_link(); ?></div></p>
 <div id="clear"></div>
<?php endwhile; ?> 

<?php endif; ?>


<?php if ( comments_open() ) : ?>
<?php comments_template(); ?> 

<?php endif; ?>

</div>

<div id="sidebar">
<?php get_sidebar(); ?>
</div><div id="clear"></div>

</div>



<?php get_footer(); ?>