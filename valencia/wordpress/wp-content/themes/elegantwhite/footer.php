<div class="line-footer"></div>

<?php if ( has_nav_menu( 'footer-nav' ) ) { ?><div id="footer-nav"><?php wp_nav_menu( array('theme_location' => 'footer-nav', 'fallback_cb' => 'elegantwhite_fb_footer', 'depth' => 1, 'menu_class' => 'footer-menu' )); ?></div><?php } ?>
    
    <div id="footer-credit"><?php elegantwhite_footer_text(); ?></div>
    
<?php wp_footer(); ?>
</body>
</html>