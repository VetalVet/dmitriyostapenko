<?php
/*
 * @package Quray-extra
 * @since 1.0.0
*/
if (!class_exists('Glint_custom_taxonomy')){
class Glint_custom_taxonomy {

	private static $instance;

    function __construct() {

        add_action( 'init', array( $this, 'create_taxonomy' ) );

    }

    /**
	 * getInstance();
	 * @since 1.0.0
	 * */
	public static function getInstance(){
		if (null == self::$instance){
			self::$instance = new self();
		}
		return self::$instance;
	}

    function create_taxonomy() {
        $labels = array(
                'name'              => _x( 'project-categories', 'taxonomy general name', 'quray-extra' ),
                'singular_name'     => _x( 'project-category', 'taxonomy singular name', 'quray-extra' ),
                'search_items'      => __( 'Search project-categories', 'quray-extra' ),
                'all_items'         => __( 'All project-categories', 'quray-extra' ),
                'parent_item'       => __( 'Parent project-category', 'quray-extra' ),
                'parent_item_colon' => __( 'Parent project-category:', 'quray-extra' ),
                'edit_item'         => __( 'Edit project-category', 'quray-extra' ),
                'update_item'       => __( 'Update project-category', 'quray-extra' ),
                'add_new_item'      => __( 'Add New project-category', 'quray-extra' ),
                'new_item_name'     => __( 'New project-category Name', 'quray-extra' ),
                'menu_name'         => __( 'project-category', 'quray-extra' ),
            );

            $args = array(
                'hierarchical'      => true,
                'labels'            => $labels,
                'show_ui'           => true,
                'show_admin_column' => true,
                'query_var'         => true,
                'rewrite'           => array( 'slug' => 'project-category' ),
            );

        register_taxonomy( 'project-category', array( 'project' ), $args );

    } //end function



} // end class


 if (class_exists('Glint_custom_taxonomy')){
		Glint_custom_taxonomy::getInstance();
	}

} //endif 