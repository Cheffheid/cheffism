<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */
?><!DOCTYPE html>
<!--[if lt IE 7 ]> <html <?php language_attributes(); ?> class="ie6"> <![endif]-->
<!--[if IE 7 ]>    <html <?php language_attributes(); ?> class="ie7"> <![endif]-->
<!--[if IE 8 ]>    <html <?php language_attributes(); ?> class="ie8"> <![endif]-->
<!--[if IE 9 ]>    <html <?php language_attributes(); ?> class="ie9"> <![endif]-->
<!--[if (gt IE 9)|!(IE)]><!--> <html <?php language_attributes(); ?> class="no-js"> <!--<![endif]-->

<head>
	<title><?php wp_title(); ?></title>

	<meta http-equiv="X-UA-Compatible" content="chrome=1">
	<meta charset="utf-8">
	
	<!--  Mobile Viewport Fix -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<?php wp_head(); ?>
	
	<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->

	<link rel="shortcut icon" href="<?php echo get_stylesheet_directory_uri(); ?>/favicon.ico" />
	
	<link rel="alternate" type="application/rss+xml" title="RSS Feed 2.0 for <?php bloginfo( 'name' ); ?>" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom Feed for <?php bloginfo( 'name' ); ?>" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RDF/RSS 1.0 Feed for <?php bloginfo( 'name' ); ?>" href="<?php bloginfo('rdf_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 0.92 Feed for <?php bloginfo( 'name' ); ?>" href="<?php bloginfo('rss_url'); ?>" />
</head>
	
<body <?php body_class(); ?>>
	<header id="branding" class="banner-header" role="banner">
		<div class="skip-link">
			<a href="#content" title=""><?php _e( 'Skip to content', 'cheffism' ); ?></a>
		</div>

		<h1 id="site-title" class="site-title">
			<a href="/"><?php bloginfo( 'name' ); ?></a>
		</h1>
		<a href="#access" class="mobile-nav">
			<span class="sr-only">Toggle navigation</span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
			<span class="icon-bar"></span>
		</a>
		<nav id="access" role="navigation" class="header-nav nav">
			<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'nav' ) ); ?>
		</nav><!-- #access -->
	</header><!-- #branding -->
	<main id="content" class="main-wrap" role="main">
		<div class="content-container">