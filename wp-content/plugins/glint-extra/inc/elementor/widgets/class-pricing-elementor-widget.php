<?php
/**
 * Elementor Widget
 * @package Glint
 * @since 1.0.0
 */

namespace Elementor;
class glint_pricing_box_widget extends Widget_Base {

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
		return 'glint-pricing-widget';
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
		return esc_html__( 'Pricing Section', 'glint-extra' );
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

        $this->end_controls_section();


		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Pricing Box', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'pricingItems', [
			'label'       => esc_html__( 'Pricing Item', 'glint-extra' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'title'        => esc_html__( 'INFLUENCER', 'glint-extra' ),
				]
			],
			'fields'      => [
				
				[
					'name'        => 'title',
					'label'       => esc_html__( 'Pricing Title', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Position', 'glint-extra' )
				],
				
				[
					'name'        => 'sub-title',
					'label'       => esc_html__( 'Pricing Sub Title', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Position', 'glint-extra' )
				],
				
				[
					'name'        => 'price',
					'label'   => esc_html__( 'Price', 'glint-extra' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => '104',
                ],
				
				[
					'name'        => 'currency_symbol',
                    'label'   => __( 'Currency Symbol', 'glint-extra' ),
                    'type'    => Controls_Manager::SELECT,
                    'options' => [
                        ''             => esc_html__( 'None', 'glint-extra' ),
                        'dollar'       => '&#36; ' . __( 'Dollar', 'glint-extra' ),
                        'euro'         => '&#128; ' . __( 'Euro', 'glint-extra' ),
                        'baht'         => '&#3647; ' . __( 'Baht', 'glint-extra' ),
                        'franc'        => '&#8355; ' . __( 'Franc', 'glint-extra' ),
                        'guilder'      => '&fnof; ' . __( 'Guilder', 'glint-extra' ),
                        'krona'        => 'kr ' . __( 'Krona', 'glint-extra' ),
                        'lira'         => '&#8356; ' . __( 'Lira', 'glint-extra' ),
                        'peseta'       => '&#8359 ' . __( 'Peseta', 'glint-extra' ),
                        'peso'         => '&#8369; ' . __( 'Peso', 'glint-extra' ),
                        'pound'        => '&#163; ' . __( 'Pound Sterling', 'glint-extra' ),
                        'real'         => 'R$ ' . __( 'Real', 'glint-extra' ),
                        'ruble'        => '&#8381; ' . __( 'Ruble', 'glint-extra' ),
                        'rupee'        => '&#8360; ' . __( 'Rupee', 'glint-extra' ),
                        'indian_rupee' => '&#8377; ' . __( 'Rupee (Indian)', 'glint-extra' ),
                        'shekel'       => '&#8362; ' . __( 'Shekel', 'glint-extra' ),
                        'yen'          => '&#165; ' . __( 'Yen/Yuan', 'glint-extra' ),
                        'won'          => '&#8361; ' . __( 'Won', 'glint-extra' ),
                        'custom'       => __( 'Custom', 'glint-extra' ),
                    ],
                    'default' => 'dollar',
                ],
				
				[
                    
					'name'        => 'currency_custom',
					'label'     => __( 'Custom Symbol', 'glint-extra' ),
                    'type'      => Controls_Manager::TEXT,
                    'condition' => [
                        'currency_symbol' => 'custom',
                    ],
                ],
								
				[
					
					'name'        => 'time_cycle',
					'label'   => esc_html__( 'Period', 'glint-extra' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Per Month', 'glint-extra' ),
                ],
				
				[
                    'name'        => 'button_text',
					'label'   => esc_html__( 'Button Text', 'glint-extra' ),
                    'type'    => Controls_Manager::TEXT,
                    'default' => esc_html__( 'Purchase Now', 'glint-extra' ),
                ],
				
				[
					'name'        => 'button_link',
					'label'       => __( 'Link', 'glint-extra' ),
                    'type'        => Controls_Manager::URL,
                    'placeholder' => 'http://your-link.com',
                    'default'     => [
                        'url' => '#',
                    ],
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

        // Style tab section start
        $this->start_controls_section(
            'growth_pricing_style_section',
            [
                'label' => __( 'Pricing Box', 'glint-extra' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        
        
        
        
            $this->start_controls_tabs( 'pricing_full_box_tabs');

                $this->start_controls_tab(
                    'pricing_full_box_tab_normal',
                    [
                        'label' => __( 'Normal', 'glint-extra' ),
                    ]
                );
				
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'pricing_table_background',
                        'label' => __( 'Background', 'glint-extra' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .single-service',
                    ]
                ); 
				

          

                $this->add_responsive_control(
                    'pricing_table_padding',
                    [
                        'label' => __( 'Padding', 'glint-extra' ),
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
                            '{{WRAPPER}} .single-service' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' =>'before'
                    ]
                );
                $this->end_controls_tab();
				
                $this->start_controls_tab(
                    'pricing_full_box_tab_hover',
                    [
                        'label' => __( 'Hover', 'glint-extra' ),
                    ]
                );
                $this->add_group_control(
                    Group_Control_Background::get_type(),
                    [
                        'name' => 'pricing_table_background_hover',
                        'label' => __( 'Background', 'glint-extra' ),
                        'types' => [ 'classic', 'gradient' ],
                        'selector' => '{{WRAPPER}} .single-service:hover',
                    ]
                );
			

                $this->add_responsive_control(
                    'pricing_table_padding_hover',
                    [
                        'label' => __( 'Padding', 'glint-extra' ),
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
                            '{{WRAPPER}} .single-service:hover' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' =>'before'
                    ]
                );
                $this->end_controls_tab();
            $this->end_controls_tabs();

        $this->end_controls_section(); // Style tab section end 



		// Features style tab start
        $this->start_controls_section(
            'glint_pric_title_style_section',
            [
                'label'     => __( 'Pricing Section Title', 'growthcore' ),
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
                        '{{WRAPPER}} .pricing-area .primery-heading h2' => 'color: {{VALUE}}',
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
                        '{{WRAPPER}} .pricing-area .primery-info-content p' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'title_typography_price',
					'label'     => __( 'Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .pricing-area .primery-heading h2',
                ]
            ); 
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'sub_title_typography_price',
					'label'     => __( 'Sub Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .pricing-area .primery-info-content p',
                ]
            );
				

	    $this->end_controls_section();




		// Features style tab start
        $this->start_controls_section(
            'growthcore_price_content_style_section',
            [
                'label'     => __( 'Pricing Box Content Style', 'glint-extra' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

			$this->add_control(
                'serv_title_color',
                [
                    'label'     => __( 'Pricing Title Color', 'glint-extra' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#22cd6f',
                    'selectors' => [
                        '{{WRAPPER}} .pricing-area .service-text h3' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'pricing_subtitle_color',
                [
                    'label'     => __( 'Pricing Sub Title Color', 'glint-extra' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#999999',
                    'selectors' => [
                        '{{WRAPPER}} .pricing-area .service-text h5' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'pricing_subspan_color',
                [
                    'label'     => __( 'Pricing Time Cycle Color', 'glint-extra' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#999999',
                    'selectors' => [
                        '{{WRAPPER}} .pricing-area .service-text h5.timecycle' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'btnn_color',
                [
                    'label'     => __( 'Pricing Button Color', 'glint-extra' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#08d665',
                    'selectors' => [
                        '{{WRAPPER}} a.cbtn.pricing-btn' => 'background-color: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'pricing_btn_txt_color',
                [
                    'label'     => __( 'Pricing Button Text Color', 'glint-extra' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} .pricing-area a.cbtn.pricing-btn' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			
			$this->add_control(
                'icon_color_bgg',
                [
                    'label'     => __( 'Pricing Box icon background color', 'glint-extra' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#fff',
                    'selectors' => [
                        '{{WRAPPER}} a.cbtn.pricing-btn i' => 'background-color: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'icon_color',
                [
                    'label'     => __( 'Pricing Box Icon Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#08D665',
                    'selectors' => [
                        '{{WRAPPER}} a.cbtn.pricing-btn i' => 'color: {{VALUE}}',
                    ]
                ]
            );
			

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'title_typography_s',
					'label'     => __( 'Title typography', 'glint-extra' ),
                    'selector' => '{{WRAPPER}} .pricing-area .primery-heading h2',
                ]
            ); 
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => '_p',
					'label'     => __( 'Sub Title typography', 'glint-extra' ),
                    'selector' => '{{WRAPPER}} .pricing-area .primery-info-content p',
                ]
            );
			
	            $this->add_control(
                'price_title_size',
                [
                    'label' => __( 'Title Font Size', 'glint-extra' ),
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
                        '{{WRAPPER}} .pricing-area .primery-heading h2' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 
			
			$this->add_control(
                'price_sub_size',
                [
                    'label' => __( 'Sub title Font Size', 'glint-extra' ),
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
                        '{{WRAPPER}} .pricing-area .primery-info-content p' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
		
              
			  
        
        $this->end_controls_section(); // Features style tab end
		
		
		
		
	}
	
		function get_currency_symbol( $symbol_name ) {
        $symbols = [
            'dollar'       => '&#36;',
            'baht'         => '&#3647;',
            'euro'         => '&#128;',
            'franc'        => '&#8355;',
            'guilder'      => '&fnof;',
            'indian_rupee' => '&#8377;',
            'krona'        => 'kr',
            'lira'         => '&#8356;',
            'peseta'       => '&#8359',
            'peso'         => '&#8369;',
            'pound'        => '&#163;',
            'real'         => 'R$',
            'ruble'        => '&#8381;',
            'rupee'        => '&#8360;',
            'shekel'       => '&#8362;',
            'won'          => '&#8361;',
            'yen'          => '&#165;',
        ];
        return isset( $symbols[ $symbol_name ] ) ? $symbols[ $symbol_name ] : '';
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
		$pricing_items = $settings['pricingItems'];
		
	
		
		?>	
				
		<!--:::::PRICING AREA START :::::::-->
        <div class="pricing-area">
            <div class="container">
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
                <div class="row">
				
				<?php
					foreach ( $pricing_items as $item ):
				?>
				
                    <div class="col-lg-4">
					
					<?php
						if('yes' === $item['active'] ) {
							$activeClass = ' active';
						} else {
							$activeClass = '';
						}
						
		
						
												
		$price_rate = array();        
        if ( ! empty( $item['currency_symbol'] ) ) {
            if ( $item['currency_symbol'] != 'custom' ) {
                $price_rate[] = $this->get_currency_symbol( $item['currency_symbol'] );
            } else {
                $price_rate[] = $item['currency_custom'];
            }
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
                                <h3><?php echo esc_html( $item['title'] ); ?></h3>
                                <h5><?php echo esc_html( $item['sub-title'] ); ?></h5>
                            </div>
                            <div class="separator"></div>
                             <div class="service-text">
                                <h3><?php echo implode( ' ', $price_rate ); ?><?php echo esc_html( $item['price'] ); ?></h3>
                                <h5 class="timecycle"><?php echo esc_html( $item['time_cycle'] ); ?></h5>
								
	
                            </div>

                            <a href="<?php echo esc_url( $item['button_link']['url'] ); ?>" class="cbtn pricing-btn"><?php echo esc_html( $item['button_text'] ); ?> <i class="fa fa-angle-right"></i></a>
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
        <!--:::::PRICING AREA END :::::::-->



		<?php
	}
}


Plugin::instance()->widgets_manager->register( new glint_pricing_box_widget() );