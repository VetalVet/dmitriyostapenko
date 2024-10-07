<?php

/**
 * All Elementor widget init
 * @package Glint
 * @since 1.0.0
 */

if (!defined('ABSPATH')) {
	exit(); // exit if access directly
}


if (!class_exists('Glint_Elementor_Widget_Init')) {

	class Glint_Elementor_Widget_Init
	{
		/*
			* $instance
			* @since 1.0.0
			* */
		private static $instance;
		/*
		* construct()
		* @since 1.0.0
		* */
		public function __construct()
		{
			add_action('elementor/elements/categories_registered', array($this, '_widget_categories'));
			//elementor widget registered
			add_action('elementor/widgets/register', array($this, '_widget_registered'));
			// elementor editor css
			//add_action( 'elementor/editor/after_enqueue_scripts', array($this,'load_assets_for_elementor'));
			add_action('elementor/controls/controls_registered', array($this, 'modify_controls'), 10, 1);
		}
		/*
	   * getInstance()
	   * @since 1.0.0
	   * */
		public static function getInstance()
		{
			if (null == self::$instance) {
				self::$instance = new self();
			}
			return self::$instance;
		}
		/**
		 * _widget_categories()
		 * @since 1.0.0
		 * */
		public function _widget_categories($elements_manager)
		{
			$elements_manager->add_category(
				'glint_widgets',
				[
					'title' => __('Glint Widgets', 'glint-extra'),
					'icon' => 'fa fa-plug',
				]
			);
		}

		/**
		 * _widget_registered()
		 * @since 1.0.0
		 * */
		public function _widget_registered()
		{
			if (!class_exists('Elementor\Widget_Base')) {
				return;
			}
			$elementor_widgets = array(
				'about-text',
				'experience-box',
				'services',
				'counter',
				'testimonials',
				'pricing',
				'banner',
				'banner-slider',
				'blog',
				'project-gallery',
				'newsletter-instagram',
				'project',
				'contact-map',
				'skill',
				'experience-dark',
				'contact-info',
				'contact',

			);
			$elementor_widgets = apply_filters('glint_elementor_widget', $elementor_widgets);

			if (is_array($elementor_widgets) && !empty($elementor_widgets)) {
				foreach ($elementor_widgets as $widget) {
					$widget_file = 'plugins/elementor/widget/' . $widget . '.php';
					$template_file = locate_template($widget_file);
					if (!$template_file || !is_readable($template_file)) {
						$template_file = GLINT_EXTRA_ELEMENTOR . '/widgets/class-' . $widget . '-elementor-widget.php';
					}
					if ($template_file && is_readable($template_file)) {
						include_once $template_file;
					}
				}
			}
		}


		/**
		 * Adding custom icon to icon control in Elementor
		 */
		public function modify_controls($controls_registry)
		{
			// Get existing icons
			$icons = $controls_registry->get_control('icon')->get_settings('options');

			// Append new icons
			$new_icons = array_merge(
				array(
					'ti-location-pin' => esc_html__('Location', 'glint-extra'),

				),
				$icons
			);

			// Then we set a new list of icons as the options of the icon control
			$controls_registry->get_control('icon')->set_settings('options', $new_icons);
		}
	}

	if (class_exists('Glint_Elementor_Widget_Init')) {
		Glint_Elementor_Widget_Init::getInstance();
	}
}//end if
