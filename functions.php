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

function cheffism_add_meta_boxes() {
	add_meta_box( 'page-schema', 'Schema.org', 'cheffism_page_schemas', 'page' );
}
add_action( 'add_meta_boxes', 'cheffism_add_meta_boxes' );

function cheffism_page_schemas( $post ) {

	wp_nonce_field( 'cheffism_schema_meta_box', 'cheffism_schema_meta_box_nonce' );

	$value = get_post_meta( $post->ID, '_cheffism_schema_type', true );

	echo '<label for="cheffism_schema_type">';
	_e( 'Enter this page\'s Schema.org type', 'cheffism' );
	echo '</label> ';
	echo '<input type="text" id="cheffism_schema_type" name="cheffism_schema_type" value="' . esc_attr( $value ) . '" size="25" />';
}

/**
 * When the post is saved, saves our custom data.
 *
 * @param int $post_id The ID of the post being saved.
 */
function cheffism_save_schema_meta_box( $post_id ) {

	/*
	 * We need to verify this came from our screen and with proper authorization,
	 * because the save_post action can be triggered at other times.
	 */

	// Check if our nonce is set.
	if ( ! isset( $_POST['cheffism_schema_meta_box_nonce'] ) ) {
		return;
	}

	// Verify that the nonce is valid.
	if ( ! wp_verify_nonce( $_POST['cheffism_schema_meta_box_nonce'], 'cheffism_schema_meta_box' ) ) {
		return;
	}

	// If this is an autosave, our form has not been submitted, so we don't want to do anything.
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE ) {
		return;
	}

	// Check the user's permissions.
	if ( isset( $_POST['post_type'] ) && 'page' == $_POST['post_type'] ) {

		if ( ! current_user_can( 'edit_page', $post_id ) ) {
			return;
		}

	} else {

		if ( ! current_user_can( 'edit_post', $post_id ) ) {
			return;
		}
	}

	/* OK, it's safe for us to save the data now. */
	
	// Make sure that it is set.
	if ( ! isset( $_POST['cheffism_schema_type'] ) ) {
		return;
	}

	// Sanitize user input.
	$my_data = sanitize_text_field( $_POST['cheffism_schema_type'] );

	// Update the meta field in the database.
	update_post_meta( $post_id, '_cheffism_schema_type', $my_data );
}
add_action( 'save_post', 'cheffism_save_schema_meta_box' );