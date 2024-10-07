<?php

/**
 * Elementor Widget
 * @package Glint
 * @since 1.0.0
 */

namespace Elementor;

class glint_about_us extends Widget_Base
{

	/**
	 * Get widget name.
	 *
	 * Retrieve Elementor widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
	public function get_name()
	{
		return 'glint-about-us-widget';
	}

	/**
	 * Get widget title.
	 *
	 * Retrieve Elementor widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title()
	{
		return esc_html__('About Text', 'glint-extra');
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve Elementor widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon()
	{
		return 'eicon-product-info';
	}

	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the Elementor widget belongs to.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories()
	{
		return ['glint_widgets'];
	}

	/**
	 * Register Elementor widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls()
	{

		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__('About Box Content', 'glint'),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control(
			'title',
			[
				'label'       => esc_html__('Title', 'glint'),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__('enter title.', 'glint'),
				'default'     => esc_html__('We Are Leading International Consultiing Agency', 'glint')
			]
		);

		$this->add_control(
			'bottom-title',
			[
				'label'       => esc_html__('Title Colored Bottom', 'glint'),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__('enter title.', 'glint'),
				'default'     => esc_html__('It Is Flavor', 'glint')
			]
		);

		$this->add_control(
			'sub-title',
			[
				'label'       => esc_html__('Sub Title', 'glint'),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__('enter sub title.', 'glint'),
				'default'     => esc_html__('About', 'glint')
			]
		);

		$this->add_control(
			'content',
			[
				'label'       => esc_html__('Content', 'glint'),
				'type'        => Controls_Manager::TEXTAREA,
				'description' => esc_html__('enter content.', 'glint'),
			]
		);

		$this->add_control(
			'btn-txt',
			[
				'label'       => esc_html__('Button Text', 'glint'),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__('enter sub title.', 'glint'),
				'default'     => esc_html__('download cv', 'glint')
			]
		);

		$this->add_control(
			'btn-url',
			[
				'label'       => esc_html__('Button Url', 'glint'),
				'type'        => Controls_Manager::URL,
				'default'     => array(
					'url' => '#'
				),

			]
		);


		$this->add_control(
			'btn-icon',
			[
				'name'        => 'active',
				'label'       => esc_html__('Use Button Right Arrow Icon?', 'glint-extra'),
				'type'        => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'your-plugin'),
				'label_off' => __('Hide', 'your-plugin'),
				'return_value' => 'yes',
				'default' => 'yes',


			]
		);

		$this->add_control(
			'play-video',
			[
				'name'        => 'video-popup',
				'label'       => esc_html__('Use Popup Video', 'glint-extra'),
				'type'        => Controls_Manager::SWITCHER,
				'label_on' => __('Show', 'your-plugin'),
				'label_off' => __('Hide', 'your-plugin'),
				'return_value' => 'yes',
				'default' => 'no',


			]
		);

		$this->add_control(
			'video_link',
			[
				'label' => __('Insert video ID.', 'gazania-extra'),
				'type'        => Controls_Manager::URL,
				'default'     => array(
					'url' => 'https://www.youtube.com/watch?v=vY_19T4jCSA'
				),

				'description' => esc_html__('Enter Video URL', 'gazania-extra')
			]
		);



		$this->add_control(
			'image',
			[
				'label' => esc_html__('About Left Image', 'glint'),
				'type'  => Controls_Manager::MEDIA,
				'dynamic' => [
					'active' => true,
				],
			]
		);




		$this->end_controls_section();


		// Features style tab start
		$this->start_controls_section(
			'glint_about_style_section',
			[
				'label'     => __('About Section Style', 'growthcore'),
				'tab'       => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_control(
			'about_title_color',
			[
				'label'     => __('Title Color', 'growthcore'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0b0d0e',
				'selectors' => [
					'{{WRAPPER}} .about-area .primery-heading h2' => 'color: {{VALUE}}',
				]
			]
		);

		$this->add_control(
			'about_content_color',
			[
				'label'     => __('Content Color', 'growthcore'),
				'type'      => Controls_Manager::COLOR,
				'default'   => '#0b0d0e',
				'selectors' => [
					'{{WRAPPER}} .about-area .primery-heading p' => 'color: {{VALUE}}',
				]
			]
		);



		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'about_title_typography',
				'label'     => __('Title typography', 'growthcore'),
				'selector' => '{{WRAPPER}} .about-area .primery-heading h2',
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'about_content_typography',
				'label'     => __('Short Content typography', 'growthcore'),
				'selector' => '{{WRAPPER}} .about-area .primery-heading p',
			]
		);

		$this->add_control(
			'about_title_size',
			[
				'label' => __('Title Font Size', 'growthcore'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'size' => 48,
				],
				'selectors' => [
					'{{WRAPPER}} .about-area .primery-heading h2' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_control(
			'about_content_size',
			[
				'label' => __('Content Font Size', 'growthcore'),
				'type'  => Controls_Manager::SLIDER,
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 500,
					],
				],
				'default' => [
					'size' => 17,
				],
				'selectors' => [
					'{{WRAPPER}} .about-area .primery-heading p' => 'font-size: {{SIZE}}{{UNIT}};',
				],
			]
		);

		$this->add_responsive_control(
			'about_button_padding',
			[
				'label' => __('Button Padding', 'growthcore'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default' => [
					'top' => '13',
					'right' => '70',
					'bottom' => '13',
					'left' => '25',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .about-area a.cbtn.cbnt1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$this->add_responsive_control(
			'banner_button_radius',
			[
				'label' => __('Button Border Radius', 'growthcore'),
				'type' => Controls_Manager::DIMENSIONS,
				'size_units' => ['px', '%', 'em'],
				'default' => [
					'top' => '4',
					'right' => '4',
					'bottom' => '4',
					'left' => '4',
					'isLinked' => false
				],
				'selectors' => [
					'{{WRAPPER}} .about-area a.cbtn.cbnt1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
				'separator' => 'before'
			]
		);

		$this->end_controls_section(); // Features style tab end		


	}

	/**
	 * Render Elementor widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render()
	{
		$settings = $this->get_settings_for_display();
		$image_id = $settings['image']['id'];
		$image_url = wp_get_attachment_image_src($image_id, 'full', false);

		if ('yes' === $settings['btn-icon']) {
			$iconClass = '<i class="fa fa-angle-right"></i>';
		} else {
			$iconClass = '';
		}




?>

		<!--:::::ABOUT AREA START :::::::-->
		<div class="about-area about-area-primery">
			<div class="container">
				<div class="row">
					<div class="col-lg-5 align-self-center">
						<div class="about-shape">
							<div class="about-img-section text-center" style="background-image: url(<?php echo esc_url(isset($image_url[0]) ? $image_url[0] : '#'); ?>);background-size: cover;background-position: center">

								<?php if ('yes' === $settings['play-video']) : ?>

									<a id="play-video" class="video-play-button js-modal-video-btn" data-video-id=<?php echo $settings['video_link']['url']; ?> href="<?php echo $settings['video_link']['url']; ?>"><span></span></a>

									<div id="video-overlay" class="video-overlay">
										<a class="video-overlay-close"></a>
									</div>

								<?php endif; ?>


							</div>
						</div>
					</div>
					<div class="col-lg-6 offset-lg-1 align-self-center">
						<div class="primery-heading">
							<strong class="filltext">About us</strong>
							<h2><?php echo esc_html($settings['title']); ?> <span><?php echo esc_html($settings['bottom-title']); ?></span></h2>
							<p><?php echo  wp_kses_post($settings['content']); ?>
							<p>
								<a href="<?php echo esc_url($settings['btn-url']['url']); ?>" class="cbtn cbnt1 fadeInDown animated"><?php echo esc_html($settings['btn-txt']); ?><?php echo $iconClass; ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<!--:::::ABOUT AREA END :::::::-->




<?php
	}
}

Plugin::instance()->widgets_manager->register(new glint_about_us());
