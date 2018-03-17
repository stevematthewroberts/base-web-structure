<?php

require_once('functions/enqueue.php');

require_once('functions/widgets.php');

// ******************************* Less Compiler
// Compile the less files via PHP and then served the cached file.
// Author - Steve Roberts
add_action( 'wp_print_styles', 'compile_less_files_to_css' );
function compile_less_files_to_css() {
	require('assets/css/less/lib/Less.php');

	$to_cache = array( realpath(dirname(__FILE__) . "/assets/css/less/style.less") => get_bloginfo('wpurl') );
	Less_Cache::$cache_dir = realpath(dirname(__FILE__) . "/assets/css/less/cache");
	Less_Cache::CleanCache();

	$parser_options['compress'] = true;
	$css_file_name = Less_Cache::Get( $to_cache, $parser_options );

	wp_enqueue_style( 'style', get_template_directory_uri() . "/assets/css/less/cache/" . $css_file_name );
}

// *******************************  Debug
// function show_template() {
//     if( is_super_admin() ){
//         global $template;
//         print_r($template);
//     }
// }
// add_action('wp_footer', 'show_template');

// Redirect Wp-Admin to Resource login
// add_action('init','custom_login');
//
// function custom_login(){
//  global $pagenow;
//  if( 'wp-login.php' == $pagenow && !is_user_logged_in()) {
//   wp_redirect('http://resource-group.mobius.mobiusclients.co.uk/resource-login/');
//   exit();
//  }
// }

// ******************************* Functions

/* Custom Image Sizes Here */
add_image_size('blog-article-thumb', 458, 245, true);


function site_setup()
{
	add_theme_support('post-thumbnails');
	add_theme_support('title-tag');

	register_nav_menus(array(
		// 'primary'   => 'Top primary menu',
  	// 'secondary'   => 'Bottom primary menu',
	));

}
add_action('after_setup_theme', 'site_setup');
// add_theme_support( 'less', array(
// 	'enable'  => true,
// 	'develop' => true,
// 	'watch'  => true
// 	// 'minify' => true
// ) );


/* Bootstrap NavWalker */
add_action( 'after_setup_theme', 'wpt_setup' );
    if ( ! function_exists( 'wpt_setup' ) ):
        function wpt_setup() {
            register_nav_menu( 'primary', __( 'Primary' ) );
            register_nav_menu( 'secondary', __( 'Secondary' ) );
            register_nav_menu( 'recruitment', __( 'Recruitment' ) );
            register_nav_menu( 'training', __( 'Training' ) );
        } endif;

function wpt_register_js() {
    wp_enqueue_script('jquery.bootstrap.min');
}
add_action( 'init', 'wpt_register_js' );
function wpt_register_css() {
    wp_enqueue_style( 'bootstrap.min' );
}
add_action( 'wp_enqueue_scripts', 'wpt_register_css' );

require_once('assets/php/class-wp-bootstrap-navwalker.php');

// Bootstrap navigation
function bootstrap_nav()
{
	wp_nav_menu( array(
            'theme_location'    => 'primary',
            'depth'             => 2,
            'container'         => 'false',
            'menu_class'        => 'nav navbar-nav',
            'fallback_cb'       => 'wp_bootstrap_navwalker::fallback',
            'walker'            => new wp_bootstrap_navwalker())
    );
}

// Sidebars
add_action( 'widgets_init', 'theme_slug_widgets_init' );
function theme_slug_widgets_init() {
    register_sidebar( array(
        'name' => __( 'Main Sidebar', 'resource-group' ),
        'id' => 'sidebar-1',
        'description' => __( 'Widgets in this area will be shown on all posts and pages.', 'theme-slug' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget'  => '</li>',
				'before_title'  => '<h2 class="widgettitle">',
				'after_title'   => '</h2>',
    ) );
    register_sidebar( array(
        'name' => __( 'Courses Sidebar', 'resource-group' ),
        'id' => 'sidebar-2',
        'description' => __( 'The main courses sidebar.', 'theme-slug' ),
        'before_widget' => '<li id="%1$s" class="widget %2$s">',
				'after_widget'  => '</li>',
				'before_title'  => '<h2 class="widgettitle">',
				'after_title'   => '</h2>',
    ) );
}

require_once('functions/custom.php');

// the_excerpt
function custom_length_excerpt($word_count_limit) {
    $content = wp_strip_all_tags(get_the_content() , true );
    echo wp_trim_words($content, $word_count_limit);
}

// ******************************* Bookings

// Change Booking 'Availability' Button
add_filter( 'woocommerce_booking_single_check_availability_text', 'wooninja_booking_check_availability_text' );

function wooninja_booking_check_availability_text() {
    return "BOOK NOW";
}

// Multiple Bookings
// wc_bookings_field_resource - Field for area
