<?php
/**
 * Elementor Widget
 * @package Glint
 * @since 1.0.0
 */

namespace Elementor;
class glint_testimonials_widget extends Widget_Base {

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
		return 'glint-testimonial-widget';
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
		return esc_html__( 'Testimonails Section', 'glint-extra' );
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
				'default'     => esc_html__('HAPPY CLIENTS TO','glint-extra')
			]
		);
		
		$this->add_control(
			'colored-title',
			[
				'label'       => esc_html__( 'Title Colored Part', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter title.', 'glint-extra' ),
				'default'     => esc_html__('SAYS','glint-extra')
			]
		);

		$this->add_control(
			'top-sub-title',
			[
				'label'       => esc_html__( 'Sub Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter sub title.', 'glint-extra' ),
				'default'     => esc_html__('TESTIMONIALS','glint-extra')
			]
		);	
		
		$this->add_control(
			'bg-effect-title',
			[
				'label'       => esc_html__( 'Background Effect Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter effect title.', 'glint-extra' ),
				'default'     => esc_html__('TESTIMONIALS','glint-extra')
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
				'label' => esc_html__( 'Testimonial Box', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'testimonialItems', [
			'label'       => esc_html__( 'Testimonial Item', 'glint-extra' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'author_name'        => esc_html__( 'Jack Metiyo Shina', 'glint-extra' ),
				]
			],
			'fields'      => [
				
				[
					'name'        => 'author_name',
					'label'       => esc_html__( 'Author Name', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Position', 'glint-extra' )
				],
				
				[
					'name'        => 'author_review',
					'label'       => esc_html__( 'Service Short Content', 'glint-extra' ),
					'type'        => Controls_Manager::TEXTAREA,
					'description' => esc_html__( 'Enter Content', 'glint-extra' )
				],
				
				[
					'name'        => 'image',
					'label'       => esc_html__( 'Author Thumbnail', 'glint-extra' ),
					'type'        => Controls_Manager::MEDIA,
					'default'     =>
						array(
							'url' => Utils::get_placeholder_image_src(),
						),
					'description' => esc_html__( 'upload reviewer image', 'glint-extra' )
				],
		


			],
			'title_field' => "{{name}}"
		] );
		
		$this->end_controls_section();
		
		
			// Features style tab start
        $this->start_controls_section(
            'glint_test_title_style_section',
            [
                'label'     => __( 'Testimonial Section Style', 'growthcore' ),
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
                        '{{WRAPPER}} .testimonials-area .primery-heading h2' => 'color: {{VALUE}}',
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
                        '{{WRAPPER}} .testimonials-area .primery-info-content p' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'title_typography_test',
					'label'     => __( 'Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .testimonials-area .primery-heading h2',
                ]
            ); 
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'sub_title_typography_test',
					'label'     => __( 'Sub Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .testimonials-area .primery-info-content p',
                ]
            );
			
	            $this->add_control(
                'testimonial_title_size',
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
                        '{{WRAPPER}} .testimonials-area .primery-heading h2' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 
			
			$this->add_control(
                'testimonial_sub_size',
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
                        '{{WRAPPER}} .testimonials-area .primery-info-content p' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );		

	    $this->end_controls_section(); // Features style tab end		
		
		// Features style tab start
        $this->start_controls_section(
            'glint_testimonials_style_section',
            [
                'label'     => __( 'Testimonial Section Style', 'growthcore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );


			
			$this->add_control(
                'testimonial_title_color',
                [
                    'label'     => __( 'Testimonial Box title Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#0b0d0e',
                    'selectors' => [
                        '{{WRAPPER}} .testimonials-area .testimonial-text h4' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'tst_author_color',
                [
                    'label'     => __( 'Testimonial Box Author Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#0b0d0e',
                    'selectors' => [
                        '{{WRAPPER}} .testimonials-area-primery .testimonial-text p' => 'color: {{VALUE}}',
                    ]
                ]
            );


			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'test_title_typography',
					'label'     => __( 'Testimonial Box title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .testimonials-area .testimonial-text h4',
                ]
            );
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'test_author_typography',
					'label'     => __( 'Testimonial Box Author typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .testimonials-area-primery .testimonial-text p',
                ]
            );


			
			$this->add_control(
                'testimonial_title_font',
                [
                    'label' => __( 'Testimonial box title Font Size', 'growthcore' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'size' => 25,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .testimonials-area-primery .testimonial-text h4' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
			
			$this->add_control(
                'testimonial_box_author_size',
                [
                    'label' => __( 'Testimonial box Author Font Size', 'growthcore' ),
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
                        '{{WRAPPER}} .testimonials-area-primery .testimonial-text p' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
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
		$testimonials_items = $settings['testimonialItems'];
		
		if('yes' === $settings['dark_active'] ) {
			$darkClass = '';
		} else {
			$darkClass = 'testimonials-area-primery';
		}
		
		
		
		?>	
				
		
		<!--:::::TESTIMONIALS AREA START :::::::-->
        <div class="testimonials-area <?php echo esc_attr($darkClass);?>">
            <div class="container">
				<div class="row">
                    <div class="col-lg-5 align-self-center">
                        <div class="primery-heading">
                            <strong class="filltext"><?php echo esc_html( $settings[ 'bg-effect-title' ] ); ?></strong>
                            <small><?php echo esc_html( $settings[ 'top-sub-title' ] ); ?></small>
                            <h2><?php echo esc_html( $settings[ 'title' ] ); ?> <span><?php echo esc_html( $settings[ 'colored-title' ] ); ?></span></h2>
                        </div>
                    </div>
                    <div class="col-lg-5 align-self-center">
                         <div class="primery-info-content">
                            <p><?php echo  wp_kses_post( $settings['section-content']  ); ?></p>
                        </div>
                    </div>
                </div>
				<div class="space-60"></div>
                <div class="row">
                    <div class="col-lg-10">
                        <div class="testimonials owl-carousel"> 
						
						<?php
							foreach ( $testimonials_items as $item ):
						?>
						
                            <div class="testimonial">
                                <div class="testimonial-img animated fadeInLeft">
                                    <img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="">
                                </div>
                                <div class="testimonial-text animated fadeInDown">
									<img src="<?php echo GLINT_EXTRA_IMG; ?>/quote.png" alt="Quote Image">
                                    <h4><?php echo esc_html( $item[ 'author_review' ] ); ?></h4>
                                    <p><?php echo esc_html( $item[ 'author_name' ] ); ?></p>
                                </div>
                            </div>
						
						<?php endforeach; ?>

						
							
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!--:::::TESTIMONIALS AREA END :::::::-->



		<?php
	}
}

Plugin::instance()->widgets_manager->register( new glint_testimonials_widget() );