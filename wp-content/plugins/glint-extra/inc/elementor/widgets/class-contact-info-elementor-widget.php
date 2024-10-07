<?php
/**
 * Elementor Widget
 * @package Glint
 * @since 1.0.0
 */

namespace Elementor;
class glint_cinfo_box_widget extends Widget_Base {

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
	public function get_name() {
		return 'glint-cinfo-widget';
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
	public function get_title() {
		return esc_html__( 'Contact Info Section', 'glint-extra' );
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
	public function get_icon() {
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
	public function get_categories() {
		return [ 'glint_widgets' ];
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
				'label' => esc_html__( 'Contact info Box', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'contactItems', [
			'label'       => esc_html__( 'Contact box Item', 'glint-extra' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'title'        => esc_html__( 'DESIGN PRINCIPALES', 'glint-extra' ),
				]
			],
			'fields'      => [
				
				[
					'name'        => 'title',
					'label'       => esc_html__( 'Box Title', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Position', 'glint-extra' )
				],
				
				[
					'name'        => 'short_content',
					'label'       => esc_html__( 'Box Short Content', 'glint-extra' ),
					'type'        => Controls_Manager::TEXTAREA,
					'description' => esc_html__( 'Enter Content', 'glint-extra' )
				],
				
				[
					'name'        => 'image',
					'label'       => esc_html__( 'Box Thumbnail', 'glint-extra' ),
					'type'        => Controls_Manager::MEDIA,
					'default'     =>
						array(
							'url' => Utils::get_placeholder_image_src(),
						),
					'description' => esc_html__( 'upload Box image', 'glint-extra' )
				],

				[
					'name'        => 'active',
					'label'       => esc_html__( 'Active', 'glint-extra' ),
					'type'        => Controls_Manager::SWITCHER,
					'label_on' => esc_html__( 'Yes', 'glint-extra' ),
				    'label_off' => esc_html__( 'No', 'glint-extra' ),
					'return_value' => 'yes',
				    'default' => '',
				],
				

			],
			'title_field' => "{{name}}"
		] );
	
		$this->end_controls_section();
		
	
		
		// Features style tab start
        $this->start_controls_section(
            'glint_contact_style_section',
            [
                'label'     => __( 'Contact Boxes Style', 'growthcore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );


			
			$this->add_control(
                'box_title_color',
                [
                    'label'     => __( 'Contact Box title Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#3a3a3a',
                    'selectors' => [
                        '{{WRAPPER}} .single-contact .service-text h4' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'box_content_color',
                [
                    'label'     => __( 'Contact Box Content Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#999999',
                    'selectors' => [
                        '{{WRAPPER}} .single-contact .service-text p' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'box_title_typography',
					'label'     => __( 'Service Box title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .single-contact .service-text h4',
                ]
            );
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'box_content_typography',
					'label'     => __( 'Service Box Content typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .single-contact .service-text p',
                ]
            );


			
			$this->add_control(
                'ser_box_title_size',
                [
                    'label' => __( 'Contact box title Font Size', 'growthcore' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'size' => 24,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} single-contact .service-text h4' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
			
			$this->add_control(
                'ser_box_content_size',
                [
                    'label' => __( 'Contact box Content Font Size', 'growthcore' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'size' => 18,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .single-contact .service-text p' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
			
			
			 $this->add_responsive_control(
				'contact_box_padding',
				[
					'label' => __( 'Contact Box Padding', 'growthcore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '50',
						'right' => '40',
						'bottom' => '50',
						'left' => '40',
						'isLinked' => false
					],
					'selectors' => [
						'{{WRAPPER}} .single-contact .single-service' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' =>'before'
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
	protected function render() {
		$settings = $this->get_settings_for_display();
		$contactItems = $settings['contactItems'];

		
		?>	
				

		<!--:::::SERVICE AREA START :::::::-->
        <div class="contact-page-area">
            <div class="container">
                <div class="row">

				<?php
					foreach ( $contactItems as $item ):
				?>
                    <div class="col-lg-4">
					<div class="single-contact">
					<?php
						if(isset($item['active']) && 'yes' === $item['active'] ) {
							$activeClass = ' active';
						} else {
							$activeClass = '';
						}
						

						
					?>		
                        <div class="single-service<?php echo esc_attr($activeClass);?>">
						
						
                            <div class="service-icon">
                                 <img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="">
                            </div>
							
							
                            <div class="service-text">
                                <h4><?php echo esc_html( $item['title'] ); ?></h4>
                                <p><?php echo  wp_kses_post( $item['short_content']  ); ?></p>
                            </div>
                            <div class="circles-wrap">
                                <div class="circles">
                                    <span class="circle circle-1"></span>
                                    <span class="circle circle-2"></span>
                                    <span class="circle circle-3"></span>
                                    <span class="circle circle-4"></span>
                                </div>
                            </div>
						
                        </div>
                    </div>
					</div>
				<?php endforeach; ?>


                </div>
            </div>
        </div>
        <!--:::::SERVICE AREA END :::::::-->


		<?php
	}
}

Plugin::instance()->widgets_manager->register( new glint_cinfo_box_widget() );