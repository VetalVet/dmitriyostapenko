<?php
/**
 * Glint functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package WordPress
 * @subpackage Glint
 * @since 1.0.0
 */

/**
 * Define Const for theme Dir
 * @since 1.0.0
 * */

error_reporting(0);

add_action('wp_enqueue_scripts', 'glint_scripts');
function glint_scripts(){
    if (is_admin()) return; // don't dequeue on the backend
    // wp_deregister_script( 'jquery' );

    // common styles
    // wp_enqueue_style('gallery', get_template_directory_uri() . '/assets/css/lightgallery-bundle.min.css');
    // wp_enqueue_style('swiper', get_template_directory_uri() . '/assets/css/swiper-bundle.min.css');
    // wp_enqueue_style('-style', get_stylesheet_uri());
    // common styles
    // =====================================================================
    // common scripts
    // wp_enqueue_script('jquery', 'https://code.jquery.com/jquery-3.7.1.slim.min.js', array(), null, true);
    // wp_enqueue_script('select', get_template_directory_uri() . '/assets/js/select.js', array(), null, true);
    // wp_enqueue_script('gallery', get_template_directory_uri() . '/assets/js/lightgallery.min.js', array(), null, true);
    // wp_enqueue_script('da', get_template_directory_uri() . '/assets/js/dynamicAdapt.js', array(), null, true);
    // wp_enqueue_script('popup', get_template_directory_uri() . '/assets/js/popup.js', array(), null, true);

    wp_enqueue_script('glint-scripts', get_template_directory_uri() . '/assets/js/custom_scripts.js', array(), null, true);
}



define( 'GLINT_ROOT_PATH', get_template_directory() );
define( 'GLINT_ROOT_URL', get_template_directory_uri() );
define( 'GLINT_CSS', GLINT_ROOT_URL . '/assets/css' );
define( 'GLINT_JS', GLINT_ROOT_URL . '/assets/js' );
define( 'GLINT_INC', GLINT_ROOT_PATH . '/inc' );
define( 'GLINT_THEME_OPTIONS', GLINT_INC . '/theme-options' );
define( 'GLINT_THEME_STYLESHEETS', GLINT_INC . '/theme-stylesheets' );
define( 'GLINT_CS_IMAGES', GLINT_ROOT_URL . '/inc/theme-options/images' );

/**
 * define theme info
 * @since 1.0.0
 * */
if ( is_child_theme() ) {
    $theme        = wp_get_theme();
    $parent_theme = $theme->Template;
    $theme_info   = wp_get_theme( $parent_theme );
} else {
    $theme_info = wp_get_theme();
}
define( 'GLINT_DEV_MODE', true );
$glint_version = GLINT_DEV_MODE ? time() : $theme_info->get( 'Version' );
define( 'GLINT_NAME', $theme_info->get( 'Name' ) );
define( 'GLINT_VERSION', $glint_version );
define( 'GLINT_AUTHOR', $theme_info->get( 'Author' ) );
define( 'GLINT_AUTHOR_URI', $theme_info->get( 'AuthorURI' ) );

/*
 * include template helper function
 * @since 1.0.0
 * */
if ( file_exists( GLINT_INC . '/template-functions.php' ) && GLINT_INC . '/template-tags.php' ) {
    require_once GLINT_INC . '/template-functions.php';
    require_once GLINT_INC . '/template-tags.php';

    function glint_function( $instance ) {
        $new_instance = false;
        switch ( $instance ) {
        case ( "Functions" ):
            $new_instance = class_exists( 'Glint_Helper_Functions' ) ? Glint_Helper_Functions::getInstance() : false;
            break;
        case ( "Tags" ):
            $new_instance = class_exists( 'Glint_Tags' ) ? Glint_Tags::getInstance() : false;
            break;
        default:
            $new_instance = false;
            break;
        }
        return $new_instance;
    }
}

/**
 * Detect Homepage
 *
 * @return boolean value
 */
if( !function_exists('glint_detect_homepage') ){
    function glint_detect_homepage() {
        /*If front page is set to display a static page, get the URL of the posts page.*/
        $homepage_id = get_option( 'page_on_front' );

        /*current page id*/
        $current_page_id = ( is_page( get_the_ID() ) ) ? get_the_ID() : '';

        if( $homepage_id == $current_page_id ) {
            return true;
        } else {
            return false;
        }

    }
}

/*
 * Include codester helper functions
 * @since 1.0.0
 */
if ( file_exists( GLINT_INC . '/cs-framework-functions.php' ) ) {
    require_once GLINT_INC . '/cs-framework-functions.php';
}

/*
 * Include theme init file
 * @since 1.0.0
 */
if ( file_exists( GLINT_INC . '/class-glint-init.php' ) ) {
    require_once GLINT_INC . '/class-glint-init.php';
}
if ( file_exists( GLINT_INC . '/nav-menu-walker.php' ) ) {
    require_once GLINT_INC . '/nav-menu-walker.php';
}

if ( file_exists( GLINT_INC . '/plugins/tgma/activate.php' ) ) {
    require_once GLINT_INC . '/plugins/tgma/activate.php';
}

// Move comments textarea to bottom
function glint_move_comment_field_to_bottom( $fields ) {

    $comment_field = $fields['comment'];
    unset( $fields['comment'] );
    $fields['comment'] = $comment_field;
    return $fields;
}

add_filter( 'comment_form_fields', 'glint_move_comment_field_to_bottom' );
remove_action( 'set_comment_cookies', 'wp_set_comment_cookies' );


// add_theme_support('woocommerce');       // поддержка woocommerce(опционально) 
require get_template_directory() . '/woocommerce/woocommerce.php';

require get_template_directory() . '/functions/polylang.php';

// if (!is_admin()) {
//     add_filter('script_loader_tag', 'add_defer', 10, 2);

//     function add_defer($tag, $handle)
//     {
//         return str_replace(' src=', ' defer src=', $tag);
//     }
// }

// Проверка на кол-во цифр в форме Contact Form 7

// $phone_message = pll__('Please enter a valid phone number111.');
// $lang = get_locale();
function custom_phone_validation($result, $tag)
{
    $type = $tag->type;
    $name = $tag->name;

    if ($type == 'tel' || $type == 'tel*') {

        $phoneNumber = isset($_POST[$name]) ? trim($_POST[$name]) : '';

        $phoneNumber = preg_replace('/[^0-9]/', '', $phoneNumber);
        if (strlen((string)$phoneNumber) < 12) {
            $result->invalidate($tag, pll__('Please enter a valid phone number.'));
        }
    }
    return $result;
}
add_filter('wpcf7_validate_tel', 'custom_phone_validation', 1, 2);
add_filter('wpcf7_validate_tel*', 'custom_phone_validation', 1, 2);
// Проверка на кол-во цифр в форме Contact Form 7

// add_filter( 'wp_check_filetype_and_ext', 'fix_svg_mime_type', 10, 5 );

// # Исправление MIME типа для SVG файлов.
// function fix_svg_mime_type( $data, $file, $filename, $mimes, $real_mime = '' ){

// 	// WP 5.1 +
// 	if( version_compare( $GLOBALS['wp_version'], '5.1.0', '>=' ) ){
// 		$dosvg = in_array( $real_mime, [ 'image/svg', 'image/svg+xml' ] );
// 	}
// 	else {
// 		$dosvg = ( '.svg' === strtolower( substr( $filename, -4 ) ) );
// 	}

// 	// mime тип был обнулен, поправим его
// 	// а также проверим право пользователя
// 	if( $dosvg ){

// 		// разрешим
// 		if( current_user_can('manage_options') ){

// 			$data['ext']  = 'svg';
// 			$data['type'] = 'image/svg+xml';
// 		}
// 		// запретим
// 		else {
// 			$data['ext']  = false;
// 			$data['type'] = false;
// 		}
// 	}

// 	return $data;
// }