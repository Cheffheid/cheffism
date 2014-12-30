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

    // Add support for post formats
    add_theme_support( 'post-formats', array(
        'aside', 'image', 'video', 'audio', 'quote', 'link', 'gallery',
    ) );

    // Add HTML5 support
    add_theme_support( 'html5', array(
        'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
    ) );
}
add_action( 'after_setup_theme', 'cheffism_setup' );

/**
 * Frontend enqueues
 */
function cheffism_frontend_scripts() {
    // Workaround for Wordpress not recognising protocol relative URL's
    $protocol = "http:";
    if ($_SERVER['HTTPS'] == 'on') {
        $protocol = 'https:';
    }

    // Fonts
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
add_action( 'init', 'cheffism_widgets_init' );

/**
 * asynchronous google analytics: mathiasbynens.be/notes/async-analytics-snippet
 * TODO: Move to plugin
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
 * HotJar beta snippet
 * TODO: Move to plugin
 */
function cheffism_hotjar_snippet() { ?>
    <script async type="text/javascript">
        (function(f,b,g){
            var xo=g.prototype.open,xs=g.prototype.send,c;
            f.hj=f.hj||function(){(f.hj.q=f.hj.q||[]).push(arguments)};
            f._hjSettings={hjid:4319, hjsv:2};
            function ls(){f.hj.documentHtml=b.documentElement.outerHTML;c=b.createElement("script");c.async=1;c.src="//static.hotjar.com/c/hotjar-4319.js?sv=2";b.getElementsByTagName("head")[0].appendChild(c);}
            if(b.readyState==="interactive"||b.readyState==="complete"||b.readyState==="loaded"){ls();}else{if(b.addEventListener){b.addEventListener("DOMContentLoaded",ls,false);}}
            if(!f._hjPlayback && b.addEventListener){
                g.prototype.open=function(l,j,m,h,k){this._u=j;xo.call(this,l,j,m,h,k)};
                g.prototype.send=function(e){var j=this;function h(){if(j.readyState===4){f.hj("_xhr",j._u,j.status,j.response)}}this.addEventListener("readystatechange",h,false);xs.call(this,e)};
            }
        })(window,document,window.XMLHttpRequest);
    </script>
<?php }
add_action('wp_head', 'cheffism_hotjar_snippet');

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
    return 100;
}
add_filter( 'excerpt_length', 'cheffism_custom_excerpt_length', 999 );

// Replace the default welcome 'Howdy' in the admin bar with something nicer.
function cheffism_admin_bar_replace_howdy($wp_admin_bar) {
    $account = $wp_admin_bar->get_node('my-account');
    $replace = str_replace('Howdy,', 'Welcome,', $account->title);            
    $wp_admin_bar->add_node(array('id' => 'my-account', 'title' => $replace));
}
add_filter('admin_bar_menu', 'cheffism_admin_bar_replace_howdy', 25);


// Mobile nav toggle script, inline because it's so small
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

/** Include Widgets, Shortcodes, Metaboxes */
require_once(get_template_directory() . '/includes/widgets/custom-recent-posts.php');
require_once(get_template_directory() . '/includes/widgets/custom-text-widget.php');
require_once(get_template_directory() . '/includes/metaboxes.php');
require_once(get_template_directory() . '/includes/shortcodes.php');
