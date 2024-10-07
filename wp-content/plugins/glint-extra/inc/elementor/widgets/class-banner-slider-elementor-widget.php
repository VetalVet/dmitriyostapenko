<?php
/**
 * Elementor Widget
 * @package Glint
 * @since 1.0.0
 */

namespace Elementor;
class glint_banner_slider extends Widget_Base {

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
		return 'glint-slider-widget';
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
		return esc_html__( 'Glint Banner Slider', 'glint-extra' );
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
				'label' => esc_html__( 'Banner Section', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		$this->add_control( 'sliderItems', [
			'label'       => esc_html__( 'Banner Item', 'glint-extra' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'top-title'        => esc_html__( 'IMAGINATION', 'glint-extra' ),
				]
			],
			'fields'      => [
				
				[
					'name'        => 'top-title',
					'label'       => esc_html__( 'Colored Top Title', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter title.', 'glint-extra' ),
					'default'     => esc_html__('IMAGINATION','glint-extra'),
				],
				
				[
					'name'        => 'bottom-title',
					'label'       => esc_html__( 'Title Bottom', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'enter title.', 'glint-extra' ),
					'default'     => esc_html__('IS MORE IMPORTANT','glint-extra')
				],
				
				[
					'name'        => 'sub-title',
					'label'       => esc_html__( 'Sub Title', 'glint-extra' ),
					'type'        => Controls_Manager::TEXTAREA,
					'description' => esc_html__( 'enter sub title.', 'glint-extra' ),
					'default'     => esc_html__('Together we the people achieve.','glint-extra')
				],
				
				[
					'name'        => 'author_image',
					'label'       => esc_html__( 'Right Image', 'glint-extra' ),
					'type'        => Controls_Manager::MEDIA,
					'default'     =>
						array(
							'url' => Utils::get_placeholder_image_src(),
						),
					'description' => esc_html__( 'upload slider right image', 'glint-extra' )
				],
				
				[
					'name'        => 'author-name',
					'label'       => esc_html__( 'Filled Background Text', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'enter sub title.', 'glint-extra' ),
					'default'     => esc_html__('GLINT','glint-extra'),
				],
				
				
				[
					'name'        => 'btn-txt',
					'label'       => esc_html__( 'Button Text', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'enter sub title.', 'glint-extra' ),
					'default'     => esc_html__('Getting Started','glint-extra')
				],
				
				[
					'name'        => 'btn-url',
					'label'       => esc_html__( 'Button Url', 'glint-extra' ),
					'type'        => Controls_Manager::URL,
					'default'     => array(
						'url' => '#'
					),
				],
				
				[
					'name'        => 'btn-icon',
					'label'       => esc_html__( 'Use Button Right Arrow Icon?', 'glint-extra' ),
					'type'        => Controls_Manager::SWITCHER,
					'label_on' => __( 'Show', 'your-plugin' ),
					'label_off' => __( 'Hide', 'your-plugin' ),
					'return_value' => 'yes',
					'default' => 'yes',		
					
					
				],
				
				

			],
			'title_field' => "{{name}}"
		] );

		$this->end_controls_section();
		
		$this->start_controls_section(
            'bg_content',
            [
                'label' => esc_html__( 'Section background', 'glint-extra' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

		$this->add_control(
	   		 'bg_image',
	      	[
	          'label' => esc_html__( 'Banner Background Image', 'glint-extra' ),
	          'type'  => Controls_Manager::MEDIA,
				'dynamic' => [
				'active' => true,
			   ],
	    	]
	    );
		
		$this->end_controls_section();


	// Features style tab start
        $this->start_controls_section(
            'glint_slider_style_section',
            [
                'label'     => __( 'Slider Style', 'growthcore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

	            $this->add_control(
                'banner_title_color',
                [
                    'label'     => __( 'Title Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .wlc-title h1' => 'color: {{VALUE}}',
                    ]
                ]
            ); 
			
			$this->add_control(
                'banner_sub_title_color',
                [
                    'label'     => __( 'Sub Title Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#ffffff',
                    'selectors' => [
                        '{{WRAPPER}} .wlc-title h6' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'banner_title_typography',
					'label'     => __( 'Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .wlc-title h1',
                ]
            ); 
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'banner_sub_title_typography',
					'label'     => __( 'Sub Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .wlc-title h6',
                ]
            );

            $this->add_control(
                'banner_title_size',
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
                        'size' => 80,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .wlc-title h1' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 
			
			$this->add_control(
                'banner_sub_title_size',
                [
                    'label' => __( 'Sub Title Font Size', 'growthcore' ),
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
                        '{{WRAPPER}} .wlc-title p' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
			
			 $this->add_responsive_control(
				'banner_button_padding',
				[
					'label' => __( 'Button Padding', 'growthcore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '13',
						'right' => '70',
						'bottom' => '13',
						'left' => '25',
						'isLinked' => false
					],
					'selectors' => [
						'{{WRAPPER}} .banner-glint a.cbtn.cbnt1' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
					],
					'separator' =>'before'
				]
			);
              
			 $this->add_responsive_control(
				'banner_button_radius',
				[
					'label' => __( 'Button Border Radius', 'growthcore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '4',
						'right' => '4',
						'bottom' => '4',
						'left' => '4',
						'isLinked' => false
					],
					'selectors' => [
						'{{WRAPPER}} .banner-glint a.cbtn.cbnt1' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		
		$sliderItems = $settings['sliderItems'];
	
		
		
		?>	
				
		
		<!--:::::WELCOME ATRA START :::::::-->
        <div class="banner-carousel-warp welcome-area-wrap banner-glint" style="background: url(<?php echo esc_url( $settings['bg_image']['url'] ); ?>);background-size: cover;background-position: center;">
        
            <!--::::: WELCOME CAROUSEL START :::::::-->
            <div class="welcome-carousel owl-carousel" id="home">
			
			<?php
					foreach ( $sliderItems as $item ):
					
						if('yes' === $item['btn-icon'] ) {
							$iconClass = '<i class="fa fa-angle-right"></i>';
						} else {
							$iconClass = '';
						}	
					
				?>
			
                <div class="single-welcome-area">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-7">
                                <div class="wlc-title white">
                                    <h1 class="fadeInDown animated"><span><?php echo esc_html( $item[ 'top-title' ] ); ?></span> <?php echo esc_html( $item[ 'bottom-title' ] ); ?></h1>
                                    <p class="fadeInDown animated"><?php echo  wp_kses_post( $item['sub-title']  ); ?></p>
                                    <a href="<?php echo esc_url( $item['btn-url']['url'] ); ?>" class="cbtn cbnt1 fadeInDown animated"><?php echo esc_html( $item['btn-txt'] ); ?><?php echo $iconClass; ?></a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="wlc-author-1">
                        <img src="<?php echo esc_url( $item['author_image']['url'] ); ?>" alt="">
                        <h1 class="wlc-filltext"><?php echo esc_html( $item[ 'author-name' ] ); ?></h1>
                    </div>
                </div>
				
			<?php endforeach; ?>
				
				
            </div>
            <!--::::: WELCOME CAROUSEL END:::::::-->
        </div>
        <!--:::::WELCOME AREA END :::::::-->



		<?php
	}
}

Plugin::instance()->widgets_manager->register( new glint_banner_slider() );