<?php

/**
 * Elementor widget
 * @package Glint
 * @since 1.0.0
 * */

namespace Elementor;
class glint_progressbar_Widget extends Widget_Base{
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
		return 'glint-progressbar-widget';
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
		return esc_html__(' Progressbar ','glint-extra');
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
		return 'eicon-h-align-right';
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
		protected function register_controls() {

		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'General Settings', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control( 'progress_items', [
			'label'       => esc_html__( 'Progress Bar, Click Preview To See Progress Bar', 'glint-extra' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'progressbar-title'        => esc_html__( 'Web Design & Development', 'glint-extra' ),

				]
			],
			'fields'      => [
				[
					'name'        => 'progressbar-title',
					'label'       => esc_html__( 'Progress Bar Title', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Write Progress Bar Title', 'glint-extra' )
				],				
				[
					'name'        => 'progressbar_percentage',
					'label'       => esc_html__( 'Progress Bar Percentage', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Write Progress Bar Percentage', 'glint-extra' ),
                    'default' => '90',
				],				



			],
			'title_field' => "{{name}}"
		] );
		$this->end_controls_section();
		
		
		// Features style tab start
        $this->start_controls_section(
            'glint_progress_style_section',
            [
                'label'     => __( 'Progress Bar Style', 'growthcore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );


			
			$this->add_control(
                'pbar_color',
                [
                    'label'     => __( 'Progress Bar Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#00C851',
                    'selectors' => [
                        '{{WRAPPER}} .warning-stroke, .success-stroke, .danger-stroke' => 'stroke: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'pbar_color_wrap',
                [
                    'label'     => __( 'Progress Bar Bg Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#efefef',
                    'selectors' => [
                        '{{WRAPPER}} .circle-chart__background' => 'stroke: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'pbar_color_title',
                [
                    'label'     => __( 'Progress Bar Title Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .technical-skills .skill h5' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'pbar_color_number',
                [
                    'label'     => __( 'Progress Number Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#111',
                    'selectors' => [
                        '{{WRAPPER}} .circle-chart__percent.customm' => 'fill: {{VALUE}}',
                    ]
                ]
            );
		

               
        
        $this->end_controls_section(); // Features style tab end			
		
		
		
		
		
		
		
		
		
		
	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

		$progress_items = $settings['progress_items'];


		?>

				
            <!-- Start Technical Skills Section -->
            <div class="technical-skills center">
                <div class="pattern"></div>
                <div class="container">
                    <!-- Start main skills -->
                    <div class="skills-wrapper row">
					
					<?php foreach( $progress_items as $item ){ ?>
					
					
                        <!-- main skill No. 1 -->
                        <div class="skill col-md-3 col-sm-6">
						
                            <div class="circlechart" data-percentage="<?php echo esc_html( $item['progressbar_percentage'] ); ?>"></div>
							
                            <h5><?php echo esc_html( $item['progressbar-title'] ); ?></h5>
                        </div>
						
					<?php } ?>

                    </div>
					
                </div>
            </div>				
						
				
				
		<?php
	}
}
plugin::instance()->widgets_manager->register(new glint_progressbar_Widget());