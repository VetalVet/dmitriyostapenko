<?php
/**
 * Elementor Widget
 * @package Glint
 * @since 1.0.0
 */

namespace Elementor;
class glint_service_box_widget extends Widget_Base {

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
		return 'glint-services-widget';
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
		return esc_html__( 'Services Section', 'glint-extra' );
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
            'title_content',
            [
                'label' => esc_html__( 'Section Title', 'glint-extra' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );
		
		$this->add_control(
			'title_active',
			[
				'label'       => esc_html__( 'Show Title Section', 'glint-extra' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'yes',
			]
			
		);
		
        $this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter title.', 'glint-extra' ),
				'default'     => esc_html__('SERVICES AND','glint-extra')
			]
		);
		
		$this->add_control(
			'colored-title',
			[
				'label'       => esc_html__( 'Title Colored Part', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter title.', 'glint-extra' ),
				'default'     => esc_html__('SOLUTIONS','glint-extra')
			]
		);

		$this->add_control(
			'top-sub-title',
			[
				'label'       => esc_html__( 'Sub Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter sub title.', 'glint-extra' ),
				'default'     => esc_html__('WHAT WE DO','glint-extra')
			]
		);	
		
		$this->add_control(
			'bg-effect-title',
			[
				'label'       => esc_html__( 'Background Effect Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter effect title.', 'glint-extra' ),
				'default'     => esc_html__('Our Services','glint-extra')
			]
		);	
		

		$this->add_control(
			'section-content',
			[
				'label'       => esc_html__( 'Content', 'glint-extra' ),
				'type'        => Controls_Manager::TEXTAREA,
				'description' => esc_html__( 'enter content.', 'glint-extra' ),
				]
		);
		
		$this->add_control(
			'dark_active',
			[
				'label'       => esc_html__( 'Make Dark mode Active', 'glint-extra' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
			
		);
		

        $this->end_controls_section();


		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Service Box', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'serviceItems', [
			'label'       => esc_html__( 'Service Item', 'glint-extra' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'title'        => esc_html__( 'DESIGN PRINCIPALES', 'glint-extra' ),
				]
			],
			'fields'      => [
				
				[
					'name'        => 'title',
					'label'       => esc_html__( 'Service Title', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Position', 'glint-extra' )
				],
				
				[
					'name'        => 'short_content',
					'label'       => esc_html__( 'Service Short Content', 'glint-extra' ),
					'type'        => Controls_Manager::TEXTAREA,
					'description' => esc_html__( 'Enter Content', 'glint-extra' )
				],
				
				[
				'name'        => 'feature_icon_type',
                'label' => __('Feature Icon Type','growthcore'),
                'type' =>Controls_Manager::CHOOSE,
                'options' =>[
                    'img' =>[
                        'title' =>__('Image','growthcore'),
                        'icon' =>'fa fa-picture-o',
                    ],
                    'icon' =>[
                        'title' =>__('Icon','growthcore'),
                        'icon' =>'fa fa-info',
                    ]
					],
					'default' => 'img',
				],
			
				[
					'name'        => 'feature_image',
					'label' => __('Image','growthcore'),
					'type'=>Controls_Manager::MEDIA,
					'default' => [
						'url' => Utils::get_placeholder_image_src(),
					],
					'condition' => [
						'feature_icon_type' => 'img',
					]
				],
				
				[
					'name'        => 'feature_icon',
					'label' =>esc_html__('Icon','growthcore'),
					'type'=>Controls_Manager::ICON,
					'default' => 'fal fa-atom-alt',
					'condition' => [
						'feature_icon_type' => 'icon',
					]
				],
				
				[
					'name'        => 'active',
					'label'       => esc_html__( 'Make Box Active', 'glint-extra' ),
					'type'        => Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'your-plugin' ),
					'label_off' => __( 'Hide', 'your-plugin' ),
					'return_value' => 'yes',
					'default' => 'no',
				],
				

			],
			'title_field' => "{{name}}"
		] );
		
		$this->end_controls_section();
		
	
			// Features style tab start
        $this->start_controls_section(
            'glint_service_title_style_section',
            [
                'label'     => __( 'Title Section Style', 'growthcore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );



	            $this->add_control(
                'title_color',
                [
                    'label'     => __( 'Section Title Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#0b0d0e',
                    'selectors' => [
                        '{{WRAPPER}} .service-area .primery-heading h2' => 'color: {{VALUE}}',
                    ]
                ]
            ); 
			
			$this->add_control(
                'sub_title_color',
                [
                    'label'     => __( 'Sub title Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#08d665',
                    'selectors' => [
                        '{{WRAPPER}} .service-area .primery-info-content p' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'title_typography_services',
					'label'     => __( 'Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .service-area .primery-heading h2',
                ]
            ); 
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'sub_title_typography_ty',
					'label'     => __( 'Sub Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .service-area .primery-info-content p',
                ]
            );
			
	            $this->add_control(
                'ser_title_size',
                [
                    'label' => __( 'Title Font Size', 'growthcore' ),
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
                        '{{WRAPPER}} .service-area .primery-heading h2' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 
			
			$this->add_control(
                'ser_sub_size',
                [
                    'label' => __( 'Sub title Font Size', 'growthcore' ),
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
                        '{{WRAPPER}} .service-area .primery-info-content p' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );		

	    $this->end_controls_section(); // Features style tab end		
		
		// Features style tab start
        $this->start_controls_section(
            'glint_service_style_section',
            [
                'label'     => __( 'Service Boxes Style', 'growthcore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );


			
			$this->add_control(
                'ser_title_color',
                [
                    'label'     => __( 'Service Box title Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#22cd6f',
                    'selectors' => [
                        '{{WRAPPER}} .service-area .service-text h4' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'icon_color',
                [
                    'label'     => __( 'Service Box Icon Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#08D665',
                    'selectors' => [
                        '{{WRAPPER}} .feature-icon i' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'box_content_color',
                [
                    'label'     => __( 'Service Box Content Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#999999',
                    'selectors' => [
                        '{{WRAPPER}} .service-area .service-text p' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'box_title_typography',
					'label'     => __( 'Service Box title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .service-area .service-text h4',
                ]
            );
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'box_content_typography',
					'label'     => __( 'Service Box Content typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .service-area .service-text p',
                ]
            );


			
			$this->add_control(
                'ser_box_title_size',
                [
                    'label' => __( 'Service box title Font Size', 'growthcore' ),
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
                        '{{WRAPPER}} .service-area .service-text h4' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
			
			$this->add_control(
                'ser_box_content_size',
                [
                    'label' => __( 'Service box Content Font Size', 'growthcore' ),
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
                        '{{WRAPPER}} .service-area .service-text p' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
			
			
			 $this->add_responsive_control(
				'service_box_padding',
				[
					'label' => __( 'Service Box Padding', 'growthcore' ),
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
						'{{WRAPPER}} .service-area .single-service' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$service_items = $settings['serviceItems'];
		
		if('yes' === $settings['dark_active'] ) {
			$darkClass = '';
		} else {
			$darkClass = 'service-primery';
		}

		
		?>	
				

		<!--:::::SERVICE AREA START :::::::-->
        <div class="service-area <?php echo esc_attr($darkClass);?>">
            <div class="container">
			
			<?php if('yes' === $settings['title_active'] ) : ?>
			
                <div class="row">
                    <div class="col-lg-6 align-self-center title-wrapp">
                        <div class="primery-heading">
                            <strong class="filltext"><?php echo esc_html( $settings[ 'bg-effect-title' ] ); ?></strong>
                            <small><?php echo esc_html( $settings[ 'top-sub-title' ] ); ?></small>
                            <h2><?php echo esc_html( $settings[ 'title' ] ); ?> <span><?php echo esc_html( $settings[ 'colored-title' ] ); ?></span></h2>
                        </div>
                    </div>
                    <div class="col-lg-6 align-self-center">
                         <div class="primery-info-content">
                            <p><?php echo  wp_kses_post( $settings['section-content']  ); ?></p>
                        </div>
                    </div>
                </div>
                <div class="space-60"></div>
				
			<?Php endif; ?>	
				
				
                <div class="row">
				
				
				
				<?php
					foreach ( $service_items as $item ):
				?>
                    <div class="col-lg-4">
					<?php
						if('yes' === $item['active'] ) {
							$activeClass = ' active';
						} else {
							$activeClass = '';
						}
						

						
					?>		
                        <div class="single-service<?php echo esc_attr($activeClass);?>">
						
						
                            <div class="service-icon">
							
							<?php if( $item['feature_icon_type'] == 'img' ): ?>
							
                                 <img src="<?php echo esc_url( $item['feature_image']['url'] ); ?>" alt="">
								 
						<?php elseif( $item['feature_icon_type'] == 'icon' and !empty($item['feature_icon']) ) :?>	 
								 
						<div class="feature-icon"><i class="<?php echo esc_attr($item['feature_icon']); ?>"></i></div>	

						<?php endif; ?>
	 
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
					
				<?php endforeach; ?>


                </div>
            </div>
        </div>
        <!--:::::SERVICE AREA END :::::::-->




		<?php
	}
}

Plugin::instance()->widgets_manager->register( new glint_service_box_widget() );