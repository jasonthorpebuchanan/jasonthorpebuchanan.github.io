<?php
// ==================================================================
// Social network
// ==================================================================
class zinnia_social extends WP_Widget {

  function zinnia_social() {
    $widget_ops = array( 'description' => __( 'Show social network like Twitter, Facebook, RSS, etc.','zinnia-theme' ) );
    parent::WP_Widget( false, __( 'Simply Social Network','zinnia-theme' ), $widget_ops );      
  }

  function widget( $args, $data ) {  
  extract( $args );
    $title    	= $data['title'];
    $rss      	= $data['rss'];
    $email    	= $data['email'];
    $facebook 	= $data['facebook'];
    $twitter  	= $data['twitter'];
    $google     = $data['google'];
    $flickr     = $data['flickr'];
    $linkedin   = $data['linkedin'];
    $youtube    = $data['youtube'];
    $vimeo      = $data['vimeo'];
    $instagram  = $data['instagram'];
    $bloglovin  = $data['bloglovin'];
    $pinterest  = $data['pinterest'];
    $tumblr     = $data['tumblr'];

    echo $before_widget; ?>

      <?php if ( $title ) { echo $before_title . $title . $after_title; } ?>

      <div class="textwidget">
        <ul class="social-icons">
          <?php if ( $data['twitter'] ) echo '<li><a href="' . $twitter . '" class="social-twitter">Twitter</a></li>' ?>
          <?php if ( $data['facebook'] ) echo '<li><a href="' . $facebook . '" class="social-facebook">Facebook</a></li>' ?>
          <?php if ( $data['google'] ) echo '<li><a href="' . $google.'" class="social-google">Google Plus</a></li>' ?>
          <?php if ( $data['flickr'] ) echo '<li><a href="' . $flickr.'" class="social-flickr">Flickr</a></li>' ?>
          <?php if ( $data['linkedin'] ) echo '<li><a href="' . $linkedin.'" class="social-linkedin">Linkedin</a></li>' ?>
          <?php if ( $data['youtube'] ) echo '<li><a href="' . $youtube.'" class="social-youtube">YouTube</a></li>' ?>
          <?php if ( $data['vimeo'] ) echo '<li><a href="' . $vimeo.'" class="social-vimeo">Vimeo</a></li>' ?>
          <?php if ( $data['instagram'] ) echo '<li><a href="' . $instagram.'" class="social-instagram">Instagram</a></li>' ?>
          <?php if ( $data['bloglovin'] ) echo '<li><a href="' . $bloglovin.'" class="social-bloglovin">Bloglovin</a></li>' ?>
          <?php if ( $data['pinterest'] ) echo '<li><a href="' . $tumblr.'" class="social-pinterest">Pinterest</a></li>' ?>
          <?php if ( $data['tumblr'] ) echo '<li><a href="' . $pinterest.'" class="social-tumblr">Tumblr</a></li>' ?>
          <?php if ( $data['email'] ) echo '<li><a href="mailto:' . $email . '" class="social-email">Email</a></li>' ?>
          <?php if ( $data['rss'] ) echo '<li><a href="' . $rss.'" class="social-rss">RSS feed</a></li>' ?>
        </ul>
        <div class="clearfix">&nbsp;</div>
      </div>

    <?php	 echo $after_widget; }
    function update( $new_data, $old_data ) { return $new_data; }
    function form( $data ) {
      $title    = isset( $data['title'] ) ? esc_attr( $data['title'] ) : '';
      $rss      = isset( $data['rss'] ) ? esc_attr( $data['rss'] ) : '';
      $email    = isset( $data['email'] ) ? esc_attr( $data['email'] ) : '';
      $facebook = isset( $data['facebook'] ) ? esc_attr( $data['facebook'] ) : '';
      $twitter  = isset( $data['twitter'] ) ? esc_attr( $data['twitter'] ) : '';
      $google     = isset( $data['google'] ) ? esc_attr( $data['google'] ) : '';
      $flickr     = isset( $data['flickr'] ) ? esc_attr( $data['flickr'] ) : '';
      $linkedin   = isset( $data['linkedin'] ) ? esc_attr( $data['linkedin'] ) : '';
      $youtube    = isset( $data['youtube'] ) ? esc_attr( $data['youtube'] ) : '';
      $vimeo      = isset( $data['vimeo'] ) ? esc_attr( $data['vimeo'] ) : '';
      $instagram  = isset( $data['instagram'] ) ? esc_attr( $data['instagram'] ) : '';
      $bloglovin  = isset( $data['bloglovin'] ) ? esc_attr( $data['bloglovin'] ) : '';
      $pinterest  = isset( $data['pinterest'] ) ? esc_attr( $data['pinterest'] ) : '';
      $tumblr     = isset( $data['tumblr'] ) ? esc_attr( $data['tumblr'] ) : '';
    ?>

<p><?php _e( 'Please key in full url (including http://)','zinnia-theme' ); ?></p>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e( 'Title','zinnia-theme' ); ?>:</label>
  <input type="text" name="<?php echo $this->get_field_name( 'title' ); ?>"  value="<?php echo $title; ?>" class="widefat" id="<?php echo $this->get_field_id( 'title' ); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'email' ); ?>"><?php _e( 'Email address','zinnia-theme' ); ?>::</label>
  <input type="text" name="<?php echo $this->get_field_name( 'email' ); ?>"  value="<?php echo $email; ?>" class="widefat" id="<?php echo $this->get_field_id( 'email' ); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e( 'Custom RSS feed','zinnia-theme' ); ?>:</label>
  <input type="text" name="<?php echo $this->get_field_name( 'rss' ); ?>"  value="<?php echo $rss; ?>" class="widefat" id="<?php echo $this->get_field_id( 'rss' ); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e( 'Facebook','zinnia-theme' ); ?>:</label>
  <input type="text" name="<?php echo $this->get_field_name( 'facebook' ); ?>"  value="<?php echo $facebook; ?>" class="widefat" id="<?php echo $this->get_field_id( 'facebook' ); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e( 'Twitter','zinnia-theme' ); ?>:</label>
  <input type="text" name="<?php echo $this->get_field_name( 'twitter' ); ?>"  value="<?php echo $twitter; ?>" class="widefat" id="<?php echo $this->get_field_id( 'twitter' ); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('google'); ?>"><?php _e( 'Google Plus:','zinnia-theme' ); ?></label>
  <input type="text" name="<?php echo $this->get_field_name('google'); ?>"  value="<?php echo $google; ?>" class="widefat" id="<?php echo $this->get_field_id('google'); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('flickr'); ?>"><?php _e( 'Flickr:','zinnia-theme' ); ?></label>
  <input type="text" name="<?php echo $this->get_field_name('flickr'); ?>"  value="<?php echo $flickr; ?>" class="widefat" id="<?php echo $this->get_field_id('flickr'); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('linkedin'); ?>"><?php _e( 'Linkedin:','zinnia-theme' ); ?></label>
  <input type="text" name="<?php echo $this->get_field_name('linkedin'); ?>"  value="<?php echo $linkedin; ?>" class="widefat" id="<?php echo $this->get_field_id('linkedin'); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('youtube'); ?>"><?php _e( 'YouTube:','zinnia-theme' ); ?></label>
  <input type="text" name="<?php echo $this->get_field_name('youtube'); ?>"  value="<?php echo $youtube; ?>" class="widefat" id="<?php echo $this->get_field_id('youtube'); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('vimeo'); ?>"><?php _e( 'Vimeo:','zinnia-theme' ); ?></label>
  <input type="text" name="<?php echo $this->get_field_name('vimeo'); ?>"  value="<?php echo $vimeo; ?>" class="widefat" id="<?php echo $this->get_field_id('vimeo'); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('instagram'); ?>"><?php _e( 'Instagram:','zinnia-theme' ); ?></label>
  <input type="text" name="<?php echo $this->get_field_name('instagram'); ?>"  value="<?php echo $instagram; ?>" class="widefat" id="<?php echo $this->get_field_id('instagram'); ?>" />
</p>
<p>
  <label for="<?php echo $this->get_field_id('pinterest'); ?>"><?php _e( 'Pinterest:','zinnia-theme' ); ?></label>
  <input type="text" name="<?php echo $this->get_field_name('pinterest'); ?>"  value="<?php echo $pinterest; ?>" class="widefat" id="<?php echo $this->get_field_id('pinterest'); ?>" />
</p>

<p>
  <label for="<?php echo $this->get_field_id('bloglovin'); ?>"><?php _e( 'Bloglovin:','zinnia-theme' ); ?></label>
  <input type="text" name="<?php echo $this->get_field_name('bloglovin'); ?>"  value="<?php echo $bloglovin; ?>" class="widefat" id="<?php echo $this->get_field_id('bloglovin'); ?>" />
</p>

<p>
  <label for="<?php echo $this->get_field_id('tumblr'); ?>"><?php _e( 'Tumblr:','zinnia-theme' ); ?></label>
  <input type="text" name="<?php echo $this->get_field_name('tumblr'); ?>"  value="<?php echo $tumblr; ?>" class="widefat" id="<?php echo $this->get_field_id('tumblr'); ?>" />
</p>

  <?php }

}

function zinnia_social() {
  register_widget( 'zinnia_social' );
}
add_action( 'widgets_init','zinnia_social' );