<!DOCTYPE html>
<!--[if IE 7]><html id="ie7" <?php language_attributes(); ?>><![endif]-->
<!--[if IE 8]><html id="ie8" <?php language_attributes(); ?>><![endif]-->
<!--[if !(IE 7) | !(IE 8)  ]><!--><html <?php language_attributes(); ?>><!--<![endif]-->
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no" />
<meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1" />
<title><?php wp_title( '|', true, 'right' ); ?></title>
<link rel="profile" href="http://gmpg.org/xfn/11" />
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>" />
<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<div class="BackTop">&uarr;</div>

<section class="wrap">

<section class="container">

<header class="header" role="banner">

  <nav class="nav" role="navigation">
    <?php wp_nav_menu( 'theme_location=top_menu&container_class=menu&menu_class=menu&fallback_cb=wp_page_menu&show_home=1' ); ?>
  </nav><!-- .nav -->
  
  <?php echo zinnia_heading(); ?>

</header><!-- .header -->

<?php echo zinnia_theme_slider(); ?>
<main>