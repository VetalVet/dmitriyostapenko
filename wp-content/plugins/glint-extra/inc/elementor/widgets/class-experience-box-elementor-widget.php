<?php
/**
 * Elementor Widget
 * @package Glint
 * @since 1.0.0
 */

namespace Elementor;
class glint_experince_skill_widget extends Widget_Base {

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
		return 'glint-experience-widget';
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
		return esc_html__( 'Skill Box', 'glint-extra' );
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
			'title',
			[
				'label'       => esc_html__( 'Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter title.', 'glint-extra' ),
				'default'     => esc_html__('EXPERIENCE AND','glint-extra')
			]
		);
		
		$this->add_control(
			'colored-title',
			[
				'label'       => esc_html__( 'Title Colored Part', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter title.', 'glint-extra' ),
				'default'     => esc_html__('SKILL','glint-extra')
			]
		);

		$this->add_control(
			'top-sub-title',
			[
				'label'       => esc_html__( 'Sub Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter sub title.', 'glint-extra' ),
				'default'     => esc_html__('MY EXPERIENCE','glint-extra')
			]
		);	
		
		$this->add_control(
			'bg-effect-title',
			[
				'label'       => esc_html__( 'Background Effect Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter effect title.', 'glint-extra' ),
				'default'     => esc_html__('My Carrer','glint-extra')
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

        $this->end_controls_section();


		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Skill Box', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'skillItems', [
			'label'       => esc_html__( 'Skill Box', 'glint-extra' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'experience_year'        => esc_html__( '2011 - 2014', 'glint-extra' ),
					'position' => esc_html__( 'LEAD DESIGNER MUSICSOFT', 'glint-extra' ),
				]
			],
			'fields'      => [
				[
					'name'        => 'experience_year',
					'label'       => esc_html__( 'Experience Year', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Give Work Experinece Year', 'glint-extra' ),
				'default'     => esc_html__('2011 - 2014 (Ui designer)','glint-extra')
				],
				
				[
					'name'        => 'position',
					'label'       => esc_html__( 'Position', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Position', 'glint-extra' )
				],
				
				[
					'name'        => 'exp-info',
					'label'       => esc_html__( 'Experience Short Content', 'glint-extra' ),
					'type'        => Controls_Manager::TEXTAREA,
					'description' => esc_html__( 'Enter Content', 'glint-extra' )
				],


			],
			'title_field' => "{{name}}"
		] );
		
		$this->end_controls_section();
		
		
		
			// Features style tab start
        $this->start_controls_section(
            'glint_skill_title_style_section',
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
                        '{{WRAPPER}} .skill-area .primery-heading h2' => 'color: {{VALUE}}',
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
                        '{{WRAPPER}} .skill-area .primery-info-content p' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'title_typography_exp',
					'label'     => __( 'Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .skill-area .primery-heading h2',
                ]
            ); 
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'sub_title_typography_exp',
					'label'     => __( 'Sub Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .skill-area .primery-info-content p',
                ]
            );
			
	            $this->add_control(
                'skill_title_size',
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
                        '{{WRAPPER}} .skill-area .primery-heading h2' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 
			
			$this->add_control(
                'skill_sub_size',
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
                        '{{WRAPPER}} .skill-area .primery-info-content p' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );		

	    $this->end_controls_section(); // Features style tab end		
		
		// Features style tab start
        $this->start_controls_section(
            'glint_skill_style_section',
            [
                'label'     => __( 'Skill Section Style', 'growthcore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );


			
			$this->add_control(
                'skill_title_color',
                [
                    'label'     => __( 'Skill Box title Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#0b0d0e',
                    'selectors' => [
                        '{{WRAPPER}} .primery-skill .skill-box h5' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'skill_content_color',
                [
                    'label'     => __( 'Skill Box Content Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#0b0d0e',
                    'selectors' => [
                        '{{WRAPPER}} .primery-skill .skill-box p' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'skill_time_color',
                [
                    'label'     => __( 'Skill Box Year Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#2d2e2f',
                    'selectors' => [
                        '{{WRAPPER}} .primery-skill .skill-box small' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			


			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'skill_title_typography',
					'label'     => __( 'Skill Box title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .primery-skill .skill-box h5',
                ]
            );
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'skill_year_typography',
					'label'     => __( 'Skill Box Year typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .primery-skill .skill-box small',
                ]
            );


			
			$this->add_control(
                'skill_box_title_size',
                [
                    'label' => __( 'Skill box title Font Size', 'growthcore' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'size' => 20,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .primery-skill .skill-box h5' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
			
			$this->add_control(
                'skill_box_content_size',
                [
                    'label' => __( 'Skill box Content Font Size', 'growthcore' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'size' => 15,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .primery-skill .skill-box p' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
			
			$this->add_control(
                'skill_box_year_size',
                [
                    'label' => __( 'Skill box year Font Size', 'growthcore' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'size' => 14,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .primery-skill .skill-box small' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
			
			 $this->add_responsive_control(
				'skill_box_padding',
				[
					'label' => __( 'Skill Box Padding', 'growthcore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '20',
						'right' => '30',
						'bottom' => '23',
						'left' => '30',
						'isLinked' => false
					],
					'selectors' => [
						'{{WRAPPER}} .primery-skill .skill-box' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		$skill_items = $settings['skillItems'];
		
		
		?>	
				

		<!--:::::SKILL AREA START :::::::-->
        <div class="skill-area primery-skill section-padding">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 align-self-center">
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
                <div class="row">
				
				<?php
					foreach ( $skill_items as $item ):
				?>
						
                    <div class="col-lg-4">
                        <div class="skill-box">
                            <small><?php echo esc_html( $item['experience_year'] ); ?></small>
                            <h5><?php echo esc_html( $item['position'] ); ?></h5>
                            <p><?php echo  wp_kses_post( $item['exp-info']  ); ?></p>
                        </div>
                    </div>
					
				<?php endforeach; ?>

  
                </div>
            </div>
        </div>
        <!--:::::SKILL AREA END :::::::-->




		<?php
	}
}

Plugin::instance()->widgets_manager->register( new glint_experince_skill_widget() );