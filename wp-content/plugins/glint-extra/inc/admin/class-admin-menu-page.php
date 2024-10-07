<?php
/*
 * @package Quray-extra
 * @since 1.0.0
*/
if (!class_exists('Glint_extra_admin_page')){
 class Glint_extra_admin_page{

 	private static $instance;

    public function __construct(){

    	add_action('admin_menu', array( $this, 'glint_menu_page' ));

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



    /*
    * add page in menu
	* @since 1.0.0
    */

    public function glint_menu_page(){
		
    	 add_menu_page( 'Glint Options', 'Glint Options', 'manage_options','glint-theme-option','', GLINT_EXTRA_IMG.'/favicon-1.png');
    	 add_submenu_page('glint-theme-option', 'Project', 'Project', 'manage_options', 'edit.php?post_type=project'); 
    	 add_submenu_page('glint-theme-option', 'Project Category', 'Project Category', 'manage_options', 'edit-tags.php?taxonomy=project-category'); 
    }

 } //end class


 if (class_exists('Glint_extra_admin_page')){
		Glint_extra_admin_page::getInstance();
	}

} //endif 