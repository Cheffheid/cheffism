<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */

/**
 * Make theme available for translation
 * Translations can be filed in the /languages/ directory
 */
load_theme_textdomain( 'cheffism', get_template_directory() . '/languages' );

$locale = get_locale();
$locale_file = get_template_directory() . "/languages/$locale.php";
if ( is_readable( $locale_file ) )
	require_once( $locale_file );

/**
 * Include Widget and Shortcode files
 */
require_once(get_template_directory() . '/includes/widgets/custom-recent-posts.php');
require_once(get_template_directory() . '/includes/widgets/custom-text-widget.php');
require_once(get_template_directory() . '/includes/shortcodes.php');

/** 
 * Disable XML-RPC 
 */
add_filter('xmlrpc_enabled', '__return_false');
function cheffism_remove_x_pingback($headers) {
    unset($headers['X-Pingback']);
    return $headers;
}
add_filter('wp_headers', 'cheffism_remove_x_pingback');

/**
 * Add different image sizes, lower thumbnail quality to 80%
 */
add_image_size( 'full-header', 720, 300, false );
add_image_size( 'tablet-header', 588, 245, false );
add_image_size( 'mobile-header', 368, 153, false );
add_image_size( 'small-mobile-header', 300, 125, false );

add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );

/**
 * Register navs
 */
register_nav_menus( array(
	'primary' => __( 'Primary Menu', 'cheffism' ),
	'footer' => __( 'Footer Menu', 'cheffism' ),
	'utility' => __( 'Utility Menu', 'cheffism' )
) );

/** 
 * Add default posts and comments RSS feed links to head
 */
add_theme_support( 'automatic-feed-links' );

/**
 * This theme uses post thumbnails
 */
add_theme_support( 'post-thumbnails' );

/**
 *	This theme supports editor styles
 */
add_editor_style("/css/layout-style.css");

/**
 * Frontend enqueues
 */
function cheffism_frontend_scripts() {
	// Workaround for Wordpress not recognising protocol relative URL's
	$protocol = "http:";
    if ($_SERVER['HTTPS'] == 'on') {
	    $protocol = 'https:';
	}

	// Font
	wp_register_style( 'google-fonts', $protocol . '//fonts.googleapis.com/css?family=Droid+Sans:700|Droid+Serif:400,400italic,700italic', null, null, 'all');
	wp_enqueue_style('google-fonts');

	wp_register_style( 'font-awesome', $protocol . '//maxcdn.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css', null, null, 'all');
	wp_enqueue_style('font-awesome');

	// Stylesheet
	wp_register_style('main-style', get_template_directory_uri() . '/style.css', 'google-fonts', null, 'all' );
	wp_enqueue_style('main-style');

    // modernizr-js
    wp_register_script( 'modernizr-js', get_template_directory_uri() . '/js/Modernizr.min.js', null, null, true );
    wp_enqueue_Script( 'modernizr-js' );

	// jQuery
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', $protocol . '//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js', null, null, true);
    wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts', 'cheffism_frontend_scripts');

/**
 *	Replace the default welcome 'Howdy' in the admin bar with something more professional.
 */
function cheffism_admin_bar_replace_howdy($wp_admin_bar) {
    $account = $wp_admin_bar->get_node('my-account');
    $replace = str_replace('Howdy,', 'Welcome,', $account->title);            
    $wp_admin_bar->add_node(array('id' => 'my-account', 'title' => $replace));
}
add_filter('admin_bar_menu', 'cheffism_admin_bar_replace_howdy', 25);

/**
 * Register widgetized area and update sidebar with default widgets
 */
function cheffism_widgets_init() {
	register_sidebar( array (
		'name' => __( 'Sidebar', 'cheffism' ),
		'id' => 'sidebar',
		'before_widget' => '<aside id="%1$s" class="widget %2$s" role="complementary">',
		'after_widget' => "</aside>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array (
		'name' => __( 'Header', 'cheffism' ),
		'id' => 'header',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array (
		'name' => __( 'Footer', 'cheffism' ),
		'id' => 'footer',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array (
		'name' => __( 'Homepage Row 1', 'cheffism' ),
		'id' => 'homepage-1',
		'before_widget' => '<div id="%1$s" class="widget %2$s">',
		'after_widget' => "</div>",
		'before_title' => '<h4 class="widget-title">',
		'after_title' => '</h4>',
	) );
	register_sidebar( array (
		'name' => __( 'Homepage Row 2', 'cheffism' ),
		'id' => 'homepage-2',
		'before_widget' => '<div id="%1$s" class="home-widget widget %2$s">',
		'after_widget' => '</div>',
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
}
add_action( 'init', 'cheffism_widgets_init' );

/**
 * asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet
 */
function cheffism_async_google_analytics() { ?>
	<script async type="text/javascript">

		var _gaq = _gaq || [];
		_gaq.push(['_setAccount', 'UA-22338583-1']);
		_gaq.push(['_trackPageview']);

		(function() {
		  var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
		  ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
		  var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
		})();

	</script>
<?php }
add_action('wp_head', 'cheffism_async_google_analytics');

/**
 * Hellipses at the end of excerpts!
 */
function cheffism_new_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter('excerpt_more', 'cheffism_new_excerpt_more');

/**
 * Set excerpt to 100 characters
 */
function cheffism_custom_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'cheffism_custom_excerpt_length', 999 );

/**
 * Mobile nav toggle script, inline because it's so small
 */
function cheffism_mobile_nav_js() { ?>
	<script async type="text/javascript">
		(function($){
			$( '.mobile-nav' ).click(function() {
				event.preventDefault();
				$('.page-wrapper').toggleClass('active');
			});
		})(jQuery);
	</script>
<?php }
add_action('wp_footer', 'cheffism_mobile_nav_js', 999);