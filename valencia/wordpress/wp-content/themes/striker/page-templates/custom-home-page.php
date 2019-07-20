<?php
/*
 * Template Name: Custom Home Page
 * Description: A home page with featured slider and widgets.
 *
 * @package Striker
 * @since Striker 1.0
 */

get_header(); ?>

	<div class="flex-container">
              <div class="flexslider">
                <ul class="slides">
                <?php
                query_posts(array('category_name' => 'featured', 'posts_per_page' => 3));
                if(have_posts()) :
                    while(have_posts()) : the_post();
                ?>
                  <li>
                    <?php the_post_thumbnail(); ?>
                     <div class="flex-caption"><?php the_excerpt(); ?></div>
                  </li>
                <?php
                    endwhile;
                endif;
                wp_reset_query();
                ?>
                </ul>
              </div>
	</div>	
        
        
        <div id="primary" class="content-area">
			<div id="content" class="fullwidth" role="main">
            
     <div class="featuretext">
			 <h3><?php echo get_theme_mod( 'featured_textbox' ); ?></h3>
              <p><?php echo get_theme_mod( 'featured_textbox_text' ); ?></p>
	</div>

	<div class="section group">
    
	<div class="col span_1_of_3">
    <?php if ( is_active_sidebar( 'left_column' ) && dynamic_sidebar('left_column') ) : else : ?>
         <div class="widget">
			<?php echo '<h4>' . __('Widget Ready', 'striker') . '</h4>'; ?>
            <?php echo '<p>' . __('This left column is widget ready! Add one in the admin panel.', 'striker') . '</p>'; ?>
            </div>     
	<?php endif; ?>  
		</div>
        
	<div class="col span_1_of_3">
	<?php if ( is_active_sidebar( 'center_column' ) && dynamic_sidebar('center_column') ) : else : ?>
         <div class="widget">
			<?php echo '<h4>' . __('Widget Ready', 'striker') . '</h4>'; ?>
            <?php echo '<p>' . __('This center column is widget ready! Add one in the admin panel.', 'striker') . '</p>'; ?>
            </div>     
	<?php endif; ?> 

	</div>
    
	<div class="col span_1_of_3">
	<?php if ( is_active_sidebar( 'right_column' ) && dynamic_sidebar('right_column') ) : else : ?>
         <div class="widget">
			<?php echo '<h4>' . __('Widget Ready', 'striker') . '</h4>'; ?>
            <?php echo '<p>' . __('This right column is widget ready! Add one in the admin panel.', 'striker') . '</p>'; ?>
            </div>     
	<?php endif; ?> 
	</div>
	</div>

                
			</div><!-- #content .site-content -->
		</div><!-- #primary .content-area -->

<?php get_footer(); ?>