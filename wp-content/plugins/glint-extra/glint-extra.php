<?php

/**
 * @package Glint Extra
 * @version 4.0.0
 */
/*
Plugin Name: Glint Extra
Plugin URI:
Description: This is a helper plugin for Glint Theme.
Author: QuomodoTheme
Version: 4.0.0
Author URI:
*/
/**  Related Theme Type */

global $related_theme_type;
$related_theme_type = array('Glint', 'Glint Child');
//define current theme name
$current_theme = !empty(wp_get_theme()) ? wp_get_theme()->get('Name') : '';
define('CURRENT_THEME_NAME', $current_theme);


/*
 * Define Plugin Dir Path
 * @since 1.0.0
 * */
define('GLINT_EXTRA_SELF_PATH', 'glint-extra/glint-extra.php');
define('GLINT_EXTRA_ROOT_PATH', plugin_dir_path(__FILE__));
define('GLINT_EXTRA_ROOT_URL', plugin_dir_url(__FILE__));
define('GLINT_EXTRA_LIB', GLINT_EXTRA_ROOT_PATH . '/lib');
define('GLINT_EXTRA_INC', GLINT_EXTRA_ROOT_PATH . '/inc');
define('GLINT_EXTRA_ADMIN', GLINT_EXTRA_INC . '/admin');
define('GLINT_EXTRA_ADMIN_ASSETS', GLINT_EXTRA_ROOT_URL . 'inc/admin/assets');
define('GLINT_EXTRA_CSS', GLINT_EXTRA_ROOT_URL . 'assets/css');
define('GLINT_EXTRA_JS', GLINT_EXTRA_ROOT_URL . 'assets/js');
define('GLINT_EXTRA_IMG', GLINT_EXTRA_ROOT_URL . 'assets/img');
define('GLINT_EXTRA_ELEMENTOR', GLINT_EXTRA_INC . '/elementor');
define('GLINT_EXTRA_SHORTCODES', GLINT_EXTRA_INC . '/shortcodes');
define('GLINT_EXTRA_WIDGETS', GLINT_EXTRA_INC . '/widgets');

/** Plugin version **/
define('GLINT_CORE_VERSION', '4.0.0');

//initial file
include_once ABSPATH . 'wp-admin/includes/plugin.php';


if (is_plugin_active(GLINT_EXTRA_SELF_PATH)) {

    if (!in_array(CURRENT_THEME_NAME, $GLOBALS['related_theme_type']) && file_exists(GLINT_EXTRA_INC . '/cs-framework-functions.php')) {
        require_once GLINT_EXTRA_INC . '/cs-framework-functions.php';

        if (file_exists(GLINT_EXTRA_INC . '/template-functions.php')) {
            require_once GLINT_EXTRA_INC . '/template-functions.php';
        }
        if (file_exists(GLINT_EXTRA_INC . '/template-tags.php')) {
            require_once GLINT_EXTRA_INC . '/template-tags.php';
        }
        //load theme helper functions
    }

    //plugin core file include
    if (file_exists(GLINT_EXTRA_INC . '/class-glint-extra-init.php')) {
        require_once GLINT_EXTRA_INC . '/class-glint-extra-init.php';
    }

    if (file_exists(GLINT_EXTRA_INC . '/demo-import.php')) {
        require_once GLINT_EXTRA_INC . '/demo-import.php';
    }
}


/*
 * Get Taxonomy
 * return array
 */
function growth_get_taxonomies($growth_texonomy = 'category')
{
    $terms = get_terms(array(
        'taxonomy' => $growth_texonomy,
        'hide_empty' => true,
    ));
    if (!empty($terms) && !is_wp_error($terms)) {
        foreach ($terms as $term) {
            $options[$term->slug] = $term->name;
        }
        return $options;
    }
}

function glint_mime_types($mimes)
{
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter('upload_mimes', 'glint_mime_types');

/*
 * Get Post Type
 * return array
 */
function growth_get_post_types($args = [])
{
    $post_type_args = [
        'show_in_nav_menus' => true,
    ];
    if (!empty($args['post_type'])) {
        $post_type_args['name'] = $args['post_type'];
    }
    $_post_types = get_post_types($post_type_args, 'objects');
    $post_types  = [];
    foreach ($_post_types as $post_type => $object) {
        $post_types[$post_type] = $object->label;
    }
    return $post_types;
}


if (!function_exists('portfolio_single_cat')) {
    function portfolio_single_cat($separetor, $type = 'name')
    {
        global $post;
        $related_taxs = wp_get_post_terms($post->ID, 'portfoliocats');
        $related_cats = array();
        foreach ($related_taxs as $related_tax) {
            $related_cats[] =   $related_tax->$type;
        }
        return implode($separetor, $related_cats);
    }
}
