<?php
/**
 * @package WordPress
 * @subpackage Cheffism
 */

function cheffism_setup() {
    /**
     * Make theme available for translation
     * Translations can be filed in the /languages/ directory
     */
    load_theme_textdomain( 'cheffism', get_template_directory() . '/languages' );

    $locale = get_locale();
    $locale_file = get_template_directory() . "/languages/$locale.php";
    if ( is_readable( $locale_file ) )
        require_once( $locale_file );

    // Disable XML-RPC
    add_filter('xmlrpc_enabled', '__return_false');

    // Add different image sizes, lower thumbnail quality to 80%
    add_image_size( 'full-header', 720, 300, false );
    add_image_size( 'tablet-header', 588, 245, false );
    add_image_size( 'mobile-header', 368, 153, false );
    add_image_size( 'small-mobile-header', 300, 125, false );

    add_filter( 'jpeg_quality', create_function( '', 'return 80;' ) );

    // Register menus
    register_nav_menus( array(
        'primary' => __( 'Primary Menu', 'cheffism' ),
        'footer' => __( 'Footer Menu', 'cheffism' ),
        'utility' => __( 'Utility Menu', 'cheffism' )
    ) );

    // Add default posts and comments RSS feed links to head
    add_theme_support( 'automatic-feed-links' );

    // This theme uses post thumbnails
    add_theme_support( 'post-thumbnails' );

    // This theme supports editor styles
    add_editor_style("/css/layout-style.css");

    // Add HTML5 support
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );

    add_theme_support( "title-tag" );

}
add_action( 'after_setup_theme', 'cheffism_setup' );

/**
 * Frontend enqueues
 */
function cheffism_frontend_scripts() {
    // Fonts
    wp_register_style( 'google-fonts', '//fonts.googleapis.com/css?family=Droid+Sans:700|Droid+Serif:400,400italic,700italic', null, null, 'all');
    wp_enqueue_style('google-fonts');

    // Stylesheet
    wp_register_style('main-style', get_template_directory_uri() . '/style.css', 'google-fonts', null, 'all' );
    wp_enqueue_style('main-style');

    // modernizr-js
    wp_register_script( 'modernizr-js', get_template_directory_uri() . '/js/Modernizr.min.js', null, null, true );
    wp_enqueue_Script( 'modernizr-js' );

    // jQuery
    wp_deregister_script( 'jquery' );
    wp_register_script( 'jquery', '//ajax.googleapis.com/ajax/libs/jquery/2.0.3/jquery.min.js', null, null, true);
    wp_enqueue_script( 'jquery' );
}
add_action('wp_enqueue_scripts', 'cheffism_frontend_scripts');

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
        'name' => __( 'Homepage Content', 'cheffism' ),
        'id' => 'homepage-content',
        'before_widget' => '<div id="%1$s" class="widget %2$s">',
        'after_widget' => "</div>",
        'before_title' => '<h4 class="widget-title">',
        'after_title' => '</h4>',
    ) );        
}
add_action( 'widgets_init', 'cheffism_widgets_init' );

/**
 * Various functions
 */

// Remove pingback headers
function cheffism_remove_x_pingback($headers) {
    unset($headers['X-Pingback']);
    return $headers;
}
add_filter('wp_headers', 'cheffism_remove_x_pingback');   

// Hellipses at the end of excerpts!
function cheffism_new_excerpt_more( $more ) {
    return '&hellip;';
}
add_filter('excerpt_more', 'cheffism_new_excerpt_more');

// Set excerpt to 100 characters
function cheffism_custom_excerpt_length( $length ) {
    return 50;
}
add_filter( 'excerpt_length', 'cheffism_custom_excerpt_length', 999 );

// Replace the default welcome 'Howdy' in the admin bar with something nicer.
function cheffism_admin_bar_replace_howdy($wp_admin_bar) {
    $account = $wp_admin_bar->get_node('my-account');
    $replace = str_replace('Howdy,', 'Welcome,', $account->title);            
    $wp_admin_bar->add_node(array('id' => 'my-account', 'title' => $replace));
}
add_filter('admin_bar_menu', 'cheffism_admin_bar_replace_howdy', 25);

// Add specific CSS class by filter
add_filter( 'body_class', 'cheffism_add_body_classes' );
function cheffism_add_body_classes( $classes ) {
    $classes[] = 'page-wrapper';
    return $classes;
}

// Mobile nav toggle script, inline because it's so small
function cheffism_mobile_nav_js() { ?>
    <script async type="text/javascript">
        (function($){
            $('body').on('click', '.mobile-nav', function(e) {
                e.preventDefault();
                $('.page-wrapper').toggleClass('active');
                $('.modal-bg').toggleClass('active');
            });
            $('body').on('click', '.modal-bg', function(e) {
                e.preventDefault();
                $('.page-wrapper').removeClass('active');
                $('.modal-bg').removeClass('active');   
            });
        })(jQuery);
    </script>
<?php }
add_action('wp_footer', 'cheffism_mobile_nav_js', 999);

// Minor Skip Nav link focus fix, adds focus to target element so keyboard wielders can continue from there
function cheffism_fix_skip_nav() { ?>
    <script async type="text/javascript">
        window.addEventListener("hashchange", function(event) {
            var element = document.getElementById(location.hash.substring(1));

            if (element) {
                if (!/^(?:a|select|input|button|textarea)$/i.test(element.tagName)) {
                    element.tabIndex = -1;
                }
                element.focus();
            }
        }, false);
    </script>
<?php }
add_action('wp_footer', 'cheffism_fix_skip_nav', 999);

/*
 * Print the <title> tag based on what is being viewed.
 */
function cheffism_title_filter( $title, $sep ) {
    global $page, $paged;

    if ( is_feed() )
        return $title;

    // Add a page number if necessary:
    if ( $paged >= 2 || $page >= 2 )
        $title = $title . $sep . sprintf( __( 'Page %s', 'cheffism' ), max( $paged, $page ) );

    return $title;
}
add_filter( 'wp_title', 'cheffism_title_filter', 10, 2 );

function cheffism_post_footer() {
    do_action('cheffism_post_footer');
}

function cheffism_home_footer() {
    do_action('cheffism_home_footer');
}

/** Include Widgets, Shortcodes, Metaboxes */
require_once(get_template_directory() . '/includes/metaboxes.php');
