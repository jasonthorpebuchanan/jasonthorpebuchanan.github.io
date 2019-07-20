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
    
  <?php if ( has_post_thumbnail() ) { ?><a href="<?php esc_url ( the_permalink() ); ?>"><div class="post-thumbnail"><?php the_post_thumbnail(); ?></div></a><?php } ?>
  
   <?php the_content(); ?>
   
   
  <div id="clear"></div>
  
   
  
  
  </div>

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