<?php
/**
 * personal functions and definitions
 *
 * @package personal
 */

/**
 * Theme updater
 */ 
require_once('inc/wp-updates-theme.php');
new WPUpdatesThemeUpdater_908( 'http://wp-updates.com/api/2/theme', basename( get_template_directory() ) );

/**
 * Set the content width based on the theme's design and stylesheet.
 */
if ( ! isset( $content_width ) ) {
	$content_width = 640; /* pixels */
}

if ( ! function_exists( 'personal_setup' ) ) :
/**
 * Sets up theme defaults and registers support for various WordPress features.
 *
 * Note that this function is hooked into the after_setup_theme hook, which
 * runs before the init hook. The init hook is too late for some features, such
 * as indicating support for post thumbnails.
 */
function personal_setup() {

	/*
	 * Make theme available for translation.
	 * Translations can be filed in the /languages/ directory.
	 * If you're building a theme based on personal, use a find and replace
	 * to change 'personal' to the name of your theme in all the template files
	 */
	load_theme_textdomain( 'personal', get_template_directory() . '/languages' );

	// Add default posts and comments RSS feed links to head.
	add_theme_support( 'automatic-feed-links' );

	/*
	 * Enable support for Post Thumbnails on posts and pages.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/add_theme_support#Post_Thumbnails
	 */
	//add_theme_support( 'post-thumbnails' );

	// This theme uses wp_nav_menu() in one location.
	register_nav_menus( array(
		'primary' => __( 'Primary Menu', 'personal' ),
	) );
	
	/*
	 * Switch default core markup for search form, comment form, and comments
	 * to output valid HTML5.
	 */
	add_theme_support( 'html5', array(
		'search-form', 'comment-form', 'comment-list', 'gallery', 'caption'
	) );

	/*
	 * Enable support for Post Formats.
	 * See http://codex.wordpress.org/Post_Formats
	 */
	add_theme_support( 'post-formats', array(
		'aside', 'image', 'video', 'quote', 'link'
	) ); 

}
endif; // personal_setup
add_action( 'after_setup_theme', 'personal_setup' );

/*-----------------------------------------------------------------------------------*/
/* Remove Page + Comements + Posts */ 
/*-----------------------------------------------------------------------------------*/

function remove_admin_menu_items() {
	$remove_menu_items = array(__('Comments'),__('Posts'));    
	global $menu;
	end ($menu);
	while (prev($menu)){
		$item = explode(' ',$menu[key($menu)][0]);
		if(in_array($item[0] != NULL?$item[0]:"" , $remove_menu_items)){
		unset($menu[key($menu)]);}
	}
}

add_action('admin_menu', 'remove_admin_menu_items');

// hide add new page
function hide_buttons()
{
global $current_screen;

if($current_screen->id == 'page'); 
{
echo '<style>#wp-admin-bar-new-page{display: none;}</style>';   
}
}

/**
* Allow SVG files. You're welcome. 
*/

function cc_mime_types( $mimes ){
	$mimes['svg'] = 'image/svg+xml';
	return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' ); 

/**
* Register your google fonts
*/
	
	function load_fonts() {
            wp_register_style('googleFonts', '//fonts.googleapis.com/css?family=Raleway:900,800,300|Open+Sans:300,400,600'); 
            wp_enqueue_style( 'googleFonts'); 
        }
    
    add_action('wp_print_styles', 'load_fonts');
	
/**
* Register Font Awesome
*/
	
add_action( 'wp_enqueue_scripts', 'prefix_enqueue_awesome' );
/**
* Register and load font awesome CSS files using a CDN.
*
* @link http://www.bootstrapcdn.com/#fontawesome
* @author FAT Media
*/
function prefix_enqueue_awesome() {
wp_enqueue_style( 'prefix-font-awesome', '//netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css', array(), '4.2.0' );   
}

/**
 * Register widget area.
 *
 * @link http://codex.wordpress.org/Function_Reference/register_sidebar
 */
function personal_widgets_init() { 
	
	register_sidebar(array(
			'name' => __( 'Overview Section', 'personal'),
			'id' => 'overview-section',
			'description' => __( 'Widgets here will be used for the Brief Overview', 'personal' ),
			'before_widget' => '<aside id="%1$s" class="widget %2$s">', 
			'after_widget' => '</aside>',
			'before_title' => '<h5>', 
			'after_title' => '</h5>',	
	) );
	
}
add_action( 'widgets_init', 'personal_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function personal_scripts() {
	wp_enqueue_style( 'personal-style', get_stylesheet_uri() );
	
	$headings_font = esc_html(get_theme_mod('headings_fonts'));
	$body_font = esc_html(get_theme_mod('body_fonts')); 
	
	if( $headings_font ) {
		wp_enqueue_style( 'personal-headings-fonts', '//fonts.googleapis.com/css?family='. $headings_font );	
	} else {
		wp_enqueue_style( 'personal-raleway', '//fonts.googleapis.com/css?family=Raleway:900,800,300');  
	}	
	if( $body_font ) {
		wp_enqueue_style( 'personal-body-fonts', '//fonts.googleapis.com/css?family='. $body_font );	
	} else {
		wp_enqueue_style( 'personal-open-sans', '//fonts.googleapis.com/css?family=Open+Sans:300,400,600');
	} 
	
	wp_enqueue_style( 'personal-odometerstyle', get_stylesheet_directory_uri() . '/css/odometer-theme-default.css', array(), '' );
	
	if ( file_exists( get_stylesheet_directory_uri() . '/inc/my_style.css' ) ) {
	wp_enqueue_style( 'personal-mystyle', get_stylesheet_directory_uri() . '/inc/my_style.css', array(), false, false );
	}
	 
    wp_enqueue_style( 'personal-animate', get_stylesheet_directory_uri() . '/css/animate.css', array(), '1.0' );
	
	if ( is_admin() ) {
    wp_enqueue_style( 'personal-codemirror', get_stylesheet_directory_uri() . '/css/codemirror.css', array(), '1.0' );  
	} 

	wp_enqueue_script( 'personal-navigation', get_template_directory_uri() . '/js/navigation.js', array(), '20120206', true );
	wp_enqueue_script( 'personal-skip-link-focus-fix', get_template_directory_uri() . '/js/skip-link-focus-fix.js', array(), '20130115', true );
	wp_enqueue_script( 'personal-easing', get_template_directory_uri() . '/js/jquery.easing.1.3.js', array(), false, true );
	wp_enqueue_script( 'personal-animate', get_template_directory_uri() . '/js/jquery.animate-enhanced.min.js', array(), false, true );
	wp_enqueue_script( 'personal-superslides', get_template_directory_uri() . '/js/jquery.superslides.min.js', array('jquery'), false, true );
	wp_enqueue_script( 'personal-nav', get_template_directory_uri() . '/js/jquery.nav.js', array('jquery'), false, true );
	wp_enqueue_script( 'personal-odometer', get_template_directory_uri() . '/js/odometer.js', array('jquery'), false, true );
	wp_enqueue_script( 'personal-waypoint', get_template_directory_uri() . '/js/waypoints.min.js', array('jquery'), false, true ); 
	wp_enqueue_script( 'personal-codemirrorJS', get_template_directory_uri() . '/js/codemirror.js', array(), false, true);
	wp_enqueue_script( 'personal-cssJS', get_template_directory_uri() . '/js/css.js', array(), false, true);
	wp_enqueue_script( 'personal-placeholder', get_template_directory_uri() . '/js/jquery.placeholder.js', array('jquery'), false, true);
 	wp_enqueue_script( 'personal-placeholdertext', get_template_directory_uri() . '/js/placeholdertext.js', array('jquery'), false, true); 
	
	if ( is_page_template( 'page-contact.php' ) ) {  
	wp_enqueue_script( 'personal-validate', get_template_directory_uri() . '/js/jquery.validate.min.js', array('jquery'), false, true);
	wp_enqueue_script( 'personal-verify', get_template_directory_uri() . '/js/verify.js', array('jquery'), false, true);   
	}
	
	wp_enqueue_script( 'personal-scripts', get_template_directory_uri() . '/js/personal.scripts.js', array(), false, true ); 
 
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { 
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'personal_scripts' );

/**
 * Load html5shiv
 */
function personal_html5shiv() {
    echo '<!--[if lt IE 9]>' . "\n";
    echo '<script src="' . esc_url( get_template_directory_uri() . '/js/html5shiv.js' ) . '"></script>' . "\n";
    echo '<![endif]-->' . "\n";
}
add_action( 'wp_head', 'personal_html5shiv' );

/**
 * Implement the Custom Header feature.
 */
//require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Custom functions that act independently of the theme templates.
 */
require get_template_directory() . '/inc/extras.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Include additional custom features.
 */
 
require get_template_directory() . '/inc/my-custom-css.php'; 
require get_template_directory() . '/inc/socialicons.php';

/**
 * Include additional custom admin panel features. 
 */
require get_template_directory() . '/panel/functions-admin.php';

/**
 * Google Fonts  
 */
require get_template_directory() . '/inc/gfonts.php';   

/**
 * Load Jetpack compatibility file.
 */
require get_template_directory() . '/inc/jetpack.php';
