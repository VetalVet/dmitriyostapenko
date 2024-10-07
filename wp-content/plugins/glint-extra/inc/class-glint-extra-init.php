<?php
/**
 * @package Banting
 * @sicne 1.0.0
 * */

if (!class_exists('Glint_Extra_Init')){

	class Glint_Extra_Init{

	//instance
	protected static $instance;

	public function __construct() {
		//plugin_assets
		add_action('wp_enqueue_scripts',array($this,'plugin_assets'));
		//plugin admin assets
		add_action('admin_enqueue_scripts',array($this,'plugin_admin_assets'));
		//load plugin dependency files
		self::load_plugin_dependency_files();
	}

	/**
	 * getInstance()
	 * @since 1.0.0
	 * */
	public static function getInstance(){
		if (null == self::$instance){
			self::$instance = new self();
		}
		return self::$instance;
	}

	/**
	 * plugin_assets()
	 * @since 1.0.0
	 * */
	public function plugin_assets(){
		self::load_plugin_css();
		self::load_plugin_js();
	}
	/**
	 * plugin_admin_assets()
	 * @since 1.0.0
	 * */
	public function plugin_admin_assets(){
		self::load_plugin_admin_css();
		self::load_plugin_admin_js();
	}

	/**
	 * load plugin css
	 * @since 1.0.0
	 * */
	public function load_plugin_css(){

	}
	/**
	 * load plugin js
	 * @since 1.0.0
	 * */
	public function load_plugin_js(){

	}
	/**
	 * load plugin admin css
	 * @since 1.0.0
	 * */
	public function load_plugin_admin_css(){

	}
	/**
	 * load plugin admin js
	 * @since 1.0.0
	 * */
	public function load_plugin_admin_js(){

	}

	/**
	 * load_plugin_dependency_files()
	 * @since 1.0.0
	 * */
	public function load_plugin_dependency_files(){



			$includes_files = array(
				array(
					'file-name' => 'codestar-framework/codestar-framework',
					'file-path' => GLINT_EXTRA_LIB
				),
				
				
				array(
					'file-name' => 'class-elementor-widgets-init',
					'file-path' => GLINT_EXTRA_ELEMENTOR
				),
				
				array(
					'file-name' => 'recent-post-widget',
					'file-path' => GLINT_EXTRA_WIDGETS
				),	
				
			
				
				array(
					'file-name' => 'class-custom-post-type',
					'file-path' => GLINT_EXTRA_ADMIN
				),	
				
	
				
		
				
			); 
			
		if (is_array($includes_files) && !empty($includes_files)){
				foreach ($includes_files as  $file){
					if (file_exists( $file['file-path'].'/'. $file['file-name'].'.php')){
						require_once $file['file-path'].'/'. $file['file-name'].'.php';
					}
				}
			}

	}

	}//end class
}

if ( class_exists('Glint_Extra_Init')){
	Glint_Extra_Init::getInstance();
}