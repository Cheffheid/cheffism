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

require_once(get_template_directory() . '/widgets/custom-recent-posts.php');
require_once(get_template_directory() . '/widgets/custom-text-widget.php');

/**
 * Frontend enqueues
 */
function frontend_scripts() {
	// Workaround for Wordpress not recognising protocol relative URL's
	$protocol = "http:";
    if ($_SERVER['HTTPS'] == 'on') {
	    $protocol = 'https:';
	}

	// Font
	wp_register_style( 'google-font-open-sans', $protocol . '//fonts.googleapis.com/css?family=Droid+Sans:700|Droid+Serif:400,700italic', null, null, 'all');
	wp_enqueue_style('google-font-open-sans');

	// jQuery
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', $protocol . '//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js', null, '2.0.3', true);
    wp_enqueue_script( 'jquery' );

    wp_register_script( 'modernizr-js', get_template_directory_uri() . '/js/Modernizr.min.js', '0.4', false );
    wp_enqueue_Script( 'modernizr-js' );

    wp_register_script( 'custom-js', get_template_directory_uri() . '/js/custom.js', array('jquery'), '0.4', true );
    wp_enqueue_Script( 'custom-js' );
}    
add_action('wp_enqueue_scripts', 'frontend_scripts');

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
 *	Replace the default welcome 'Howdy' in the admin bar with something more professional.
 */
function admin_bar_replace_howdy($wp_admin_bar) {
    $account = $wp_admin_bar->get_node('my-account');
    $replace = str_replace('Howdy,', 'Welcome,', $account->title);            
    $wp_admin_bar->add_node(array('id' => 'my-account', 'title' => $replace));
}
add_filter('admin_bar_menu', 'admin_bar_replace_howdy', 25);

/**
 * This enables post formats. If you use this, make sure to delete any that you aren't going to use.
 */
add_theme_support( 'post-formats', array( 'gallery', 'status' ) );

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

// asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet
//change the UA-XXXXX-X to be your site's ID
add_action('wp_head', 'async_google_analytics');
function async_google_analytics() { ?>
	<script type="text/javascript">

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

function new_excerpt_more( $more ) {
	return '&hellip;';
}
add_filter('excerpt_more', 'new_excerpt_more');

function custom_excerpt_length( $length ) {
	return 100;
}
add_filter( 'excerpt_length', 'custom_excerpt_length', 999 );

function age_function($atts){
   extract(shortcode_atts(array(
      'date' => '11/04/1985',
      'format' => 'dd/MM/YYYY'
   ), $atts));

  
  //explode the date to get month, day and year
  $date = explode("/", $date);
  //get age from date or birthdate
  $age = (date("md", date("U", mktime(0, 0, 0, $date[1], $date[0], $date[2]))) > date("md")
    ? ((date("Y") - $date[2]) - 1)
    : (date("Y") - $date[2]));

  return $age;

}
function register_shortcodes(){
   add_shortcode('age', 'age_function');
}
add_action( 'init', 'register_shortcodes');