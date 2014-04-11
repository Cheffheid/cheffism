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
	<meta http-equiv="X-UA-Compatible" content="chrome=1">

	<title><?php
	/*
	 * Print the <title> tag based on what is being viewed.
	 */
	global $page, $paged;

	wp_title( '|', true, 'right' );

	// Add the blog name.
	bloginfo( 'name' );

	// Add a page number if necessary:
	if ( $paged >= 2 || $page >= 2 )
		echo ' | ' . sprintf( __( 'Page %s', 'cheffism' ), max( $paged, $page ) );

	?></title>
			
	<meta name="author" content="Jeffrey de Wit">
	<!--  Mobile Viewport Fix -->
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
    
	<?php wp_head(); ?>
	
	<!--[if lt IE 9]>
    <script src="http://html5shiv.googlecode.com/svn/trunk/html5.js"></script>
    <![endif]-->
	
	<link rel="alternate" type="application/rss+xml" title="RSS Feed 2.0 for <?php bloginfo( 'name' ); ?>" href="<?php bloginfo('rss2_url'); ?>" />
	<link rel="alternate" type="application/atom+xml" title="Atom Feed for <?php bloginfo( 'name' ); ?>" href="<?php bloginfo('atom_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RDF/RSS 1.0 Feed for <?php bloginfo( 'name' ); ?>" href="<?php bloginfo('rdf_url'); ?>" />
	<link rel="alternate" type="application/rss+xml" title="RSS 0.92 Feed for <?php bloginfo( 'name' ); ?>" href="<?php bloginfo('rss_url'); ?>" />
</head>
	
<body <?php body_class();  ?>>
<div id="page" class="hfeed page-wrapper">
	<header id="branding" class="banner-header col" role="banner">
		<div class="wrap">
			<hgroup class="visuallyhidden">
				<h1 id="site-title" class="site-title">
					<?php bloginfo( 'name' ); ?>
				</h1>
				<h2 id="site-description" class="site-description"><em><?php bloginfo( 'description' ); ?></em></h2>
			</hgroup>
			<a href="#access" class="mobile-nav">
				<span class="sr-only">Toggle navigation</span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
				<span class="icon-bar"></span>
			</a>
			<div class="cell">
				<nav id="access" role="navigation" class="header-nav nav col">
					<div class="skip-link visuallyhidden"><a href="#content" title="<?php esc_attr_e( 'Skip to content', 'cheffism' ); ?>"><?php _e( 'Skip to content', 'cheffism' ); ?></a></div>
					<?php wp_nav_menu( array( 'theme_location' => 'primary', 'container_class' => 'nav' ) ); ?>
				</nav><!-- #access -->
			</div>
			<div class="col width-1of4 social-menu">
				<?php
					dynamic_sidebar( 'header' );
				?>
			</div>
		</div>
	</header><!-- #branding -->