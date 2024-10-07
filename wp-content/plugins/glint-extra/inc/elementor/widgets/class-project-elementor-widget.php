<?php
namespace Elementor;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * growthcore button widget.
 *
 * growthcore widget that displays a button with the ability to control every
 * aspect of the button design.
 *
 * @since 1.0.0
 */
class glint_Portfolio extends Widget_Base {

	/**
	 * Get widget name.
	 *
	 * Retrieve button widget name.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget name.
	 */
    public function get_name() {
        return 'glint-portfolio-addons';
    }

	/**
	 * Get widget title.
	 *
	 * Retrieve button widget title.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget title.
	 */
	public function get_title() {
		return __( 'Portfolio Grid', 'glint-extra' );
	}

	/**
	 * Get widget icon.
	 *
	 * Retrieve button widget icon.
	 *
	 * @since 1.0.0
	 * @access public
	 *
	 * @return string Widget icon.
	 */
	public function get_icon() {
		return 'eicon-post-content';
	}

    
    public function get_script_depends() {
        return [
            'isotope',
            'imagesloaded',
            'el-widget-active'
        ];
    }
	/**
	 * Get widget categories.
	 *
	 * Retrieve the list of categories the button widget belongs to.
	 *
	 * Used to determine where to display the widget in the editor.
	 *
	 * @since 2.0.0
	 * @access public
	 *
	 * @return array Widget categories.
	 */
	public function get_categories() {
		return [ 'glint_widgets' ];
	}

	/**
	 * Register button widget controls.
	 *
	 * Adds different input fields to allow the user to change and customize the widget settings.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function register_controls() {
        $this->start_controls_section(
            'post_carousel_content',
            [
                'label' => __( 'Portfolio Options', 'glint-extra' ),
            ]
        );

        $this->add_control(
            'slider_on',
            [
                'label'         => __( 'Carousel', 'glint-extra' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'On', 'glint-extra' ),
                'label_off'     => __( 'Off', 'glint-extra' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
            ]
        );
        
        $this->add_control(
            'filter_on',
            [
                'label'         => __( 'Filter Menu', 'glint-extra' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'On', 'glint-extra' ),
                'label_off'     => __( 'Off', 'glint-extra' ),
                'return_value'  => 'yes',
                'default'       => 'yes',
                'condition' => [
                    'slider_on!' => 'yes',
                ]
            ]
        );
        $this->add_control(
            'hover_effect',
            [
                'label'         => __( 'Hover Effect', 'glint-extra' ),
                'type'          => Controls_Manager::SWITCHER,
                'label_on'      => __( 'On', 'glint-extra' ),
                'label_off'     => __( 'Off', 'glint-extra' ),
                'return_value'  => 'yes',
                'default'       => 'no'
            ]
        );
        
        $this->end_controls_section();        
        
		$this->start_controls_section(
			'section_button',
			[
				'label' => __( 'Post Option', 'glint-extra' ),
			]
		);

        
        $this->add_control(
            'portfolio_categories',
            [
                'label' => esc_html__( 'Categories', 'glint-extra' ),
                'type' => Controls_Manager::SELECT2,
                'label_block' => true,
                'multiple' => true,
                'options' => growth_get_taxonomies('portfoliocats')
            ]
        );

        $this->add_control(
            'post_limit',
            [
                'label' => __('Limit', 'glint-extra'),
                'type' => Controls_Manager::NUMBER,
                'default' => 5,
                'separator'=>'before',
            ]
        );

        
        $this->add_control(
            'custom_order',
            [
                'label' => esc_html__( 'Custom order', 'glint-extra' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'no',
            ]
        );

        
        $this->add_control(
            'postorder',
            [
                'label' => esc_html__( 'Order', 'glint-extra' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'DESC',
                'options' => [
                    'DESC'  => esc_html__('Descending','glint-extra'),
                    'ASC'   => esc_html__('Ascending','glint-extra'),
                ],
                'condition' => [
                    'custom_order!' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'orderby',
            [
                'label' => esc_html__( 'Orderby', 'glint-extra' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'none',
                'options' => [
                    'none'          => esc_html__('None','glint-extra'),
                    'ID'            => esc_html__('ID','glint-extra'),
                    'date'          => esc_html__('Date','glint-extra'),
                    'name'          => esc_html__('Name','glint-extra'),
                    'title'         => esc_html__('Title','glint-extra'),
                    'comment_count' => esc_html__('Comment count','glint-extra'),
                    'rand'          => esc_html__('Random','glint-extra'),
                ],
                'condition' => [
                    'custom_order' => 'yes',
                ]
            ]
        );

        $this->add_control(
            'show_category',
            [
                'label' => esc_html__( 'Category', 'glint-extra' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );
        
         $this->add_control(
            'show_title',
            [
                'label' => esc_html__( 'Title', 'glint-extra' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'title_length',
            [
                'label' => __( 'Title Length', 'glint-extra' ),
                'type' => Controls_Manager::NUMBER,
                'step' => 1,
                'default' => 5,
                'condition'=>[
                    'show_title'=>'yes',
                ]
            ]
        );   
         $this->add_control(
            'show_desc',
            [
                'label' => esc_html__( 'Description', 'glint-extra' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'desc_length',
            [
                'label' => __( 'Desc Length', 'glint-extra' ),
                'type' => Controls_Manager::NUMBER,
                'step' => 1,
                'default' => 15,
                'condition'=>[
                    'show_desc'=>'yes',
                ]
            ]
        );    

        $this->add_control(
            'show_read_more_btn',
            [
                'label' => esc_html__( 'Read More', 'glint-extra' ),
                'type' => Controls_Manager::SWITCHER,
                'return_value' => 'yes',
                'default' => 'yes',
            ]
        );

        $this->add_control(
            'read_more_txt',
            [
                'label' => __( 'Read More button text', 'glint-extra' ),
                'type' => Controls_Manager::TEXT,
                'default' => __( 'Read More', 'glint-extra' ),
                'placeholder' => __( 'Read More', 'glint-extra' ),
                'label_block'=>true,
                'condition'=>[
                    'show_read_more_btn'=>'yes',
                ]
            ]
        );


        $this->add_control(
            'readmore_button_icon',
            [
                'label' => __( 'Read More icon', 'glint-extra' ),
                'type' => Controls_Manager::ICON,
                'default' => 'fas fa-long-arrow-right',
                'condition'=>[
                    'show_read_more_btn'=>'yes',
                ]
            ]
        );

		$this->end_controls_section();
        
        
        
        // Carousel setting
        $this->start_controls_section(
            'slider_option',
            [
                'label' => esc_html__( 'Carousel Option', 'glint-extra' ),
                'condition' => [
                    'slider_on' => 'yes',
                ]
            ]
        );

            $this->add_control(
                'slitems',
                [
                    'label' => esc_html__( 'Slider Items', 'glint-extra' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 20,
                    'step' => 1,
                    'default' => 3,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slarrows',
                [
                    'label' => esc_html__( 'Slider Arrow', 'glint-extra' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slprevicon',
                [
                    'label' => __( 'Previous icon', 'glint-extra' ),
                    'type' => Controls_Manager::ICON,
                    'default' => 'fa fa-angle-left',
                    'condition' => [
                        'slider_on' => 'yes',
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slnexticon',
                [
                    'label' => __( 'Next icon', 'glint-extra' ),
                    'type' => Controls_Manager::ICON,
                    'default' => 'fa fa-angle-right',
                    'condition' => [
                        'slider_on' => 'yes',
                        'slarrows' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sldots',
                [
                    'label' => esc_html__( 'Slider dots', 'glint-extra' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slpause_on_hover',
                [
                    'type' => Controls_Manager::SWITCHER,
                    'label_off' => __('No', 'glint-extra'),
                    'label_on' => __('Yes', 'glint-extra'),
                    'return_value' => 'yes',
                    'default' => 'yes',
                    'label' => __('Pause on Hover?', 'glint-extra'),
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );
            $this->add_control(
                'slcentermode',
                [
                    'label' => esc_html__( 'Center Mode', 'glint-extra' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slcenterpadding',
                [
                    'label' => esc_html__( 'Center padding', 'glint-extra' ),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 0,
                    'max' => 500,
                    'step' => 1,
                    'default' => 50,
                    'condition' => [
                        'slider_on' => 'yes',
                        'slcentermode' => 'yes',
                    ]
                ]
            );
                
            $this->add_control(
                'slverticalmode',
                [
                    'label' => __( 'Vertical Mode', 'glint-extra' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautolay',
                [
                    'label' => esc_html__( 'Slider auto play', 'glint-extra' ),
                    'type' => Controls_Manager::SWITCHER,
                    'return_value' => 'yes',
                    'separator' => 'before',
                    'default' => 'no',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slautoplay_speed',
                [
                    'label' => __('Autoplay speed', 'glint-extra'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 3000,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );


            $this->add_control(
                'slanimation_speed',
                [
                    'label' => __('Autoplay animation speed', 'glint-extra'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 300,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slscroll_columns',
                [
                    'label' => __('Slider item to scroll', 'glint-extra'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 10,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_tablet',
                [
                    'label' => __( 'Tablet', 'glint-extra' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_display_columns',
                [
                    'label' => __('Slider Items', 'glint-extra'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 8,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_scroll_columns',
                [
                    'label' => __('Slider item to scroll', 'glint-extra'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 8,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'sltablet_width',
                [
                    'label' => __('Tablet Resolution', 'glint-extra'),
                    'description' => __('The resolution to tablet.', 'glint-extra'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 750,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'heading_mobile',
                [
                    'label' => __( 'Mobile Phone', 'glint-extra' ),
                    'type' => Controls_Manager::HEADING,
                    'separator' => 'after',
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_display_columns',
                [
                    'label' => __('Slider Items', 'glint-extra'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_scroll_columns',
                [
                    'label' => __('Slider item to scroll', 'glint-extra'),
                    'type' => Controls_Manager::NUMBER,
                    'min' => 1,
                    'max' => 4,
                    'step' => 1,
                    'default' => 1,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

            $this->add_control(
                'slmobile_width',
                [
                    'label' => __('Mobile Resolution', 'glint-extra'),
                    'description' => __('The resolution to mobile.', 'glint-extra'),
                    'type' => Controls_Manager::NUMBER,
                    'default' => 480,
                    'condition' => [
                        'slider_on' => 'yes',
                    ]
                ]
            );

        $this->end_controls_section(); // Slider Option end
        
        
        
        // portfolio Style tab section
        $this->start_controls_section(
            'growthcore_portfolio_area_style_section',
            [
                'label' => __( 'Area Style', 'glint-extra' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'portfolio_area_width',
            [
                'label' => __( 'Width', 'glint-extra' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 9999,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .growth-portfolios' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        $this->add_responsive_control(
            'portfolio_area_margin',
            [
                'label' => __( 'Margin', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .growth-portfolios' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'portfolio_area_padding',
            [
                'label' => __( 'Padding', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .growth-portfolios' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'portfolio_area_background',
                'label' => __( 'Background', 'glint-extra' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .growth-portfolios',
            ]
        );
        $this->end_controls_section(); // portfolio section style end
        
        
        
        
        // Service Style tab section
        $this->start_controls_section(
            'portfolio_column_style_section',
            [
                'label' => __( 'Column Style', 'glint-extra' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'slider_on!' => 'yes',
                ]
            ]
        );
        $this->add_responsive_control(
            'portfolio_column_margin',
            [
                'label' => __( 'Margin', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-grid' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );        
        $this->add_responsive_control(
            'portfolio_column_padding',
            [
                'label' => __( 'Padding', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-grid' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );        
		$this->add_responsive_control(
			'portfolio_column_width',
			[
				'label' => __( 'Width', 'glint-extra' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					]
				],
				'default' => [
					'unit' => '%',
					'size' => 50,
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-grid' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->end_controls_section();
        
        // portfolio Style tab section
        $this->start_controls_section(
            'growthcore_portfolio_box_style_section',
            [
                'label' => __( 'Full Box', 'glint-extra' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'portfolio_box_padding',
            [
                'label' => __( 'Padding', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .growth-portfolios .portfolio-grid' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'portfolio_box_background',
                'label' => __( 'Overlay Background', 'glint-extra' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .growth-portfolios .portfolio-box',
            ]
        );    
		$this->add_responsive_control(
			'box_width',
			[
				'label' => __( 'Width', 'glint-extra' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .growth-portfolios .portfolio-box' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);
        $this->add_responsive_control(
            'portfolio_box_align',
            [
                'label' => __( 'Alignment', 'growth' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'growth' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'growth' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'growth' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'growth' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .growth-portfolios .portfolio-box' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left',
                'separator' =>'before',
            ]
        );

        
        
        
        $this->start_controls_tabs('full_box_tab_style');
        
        $this->start_controls_tab( 'full_box_normal',
			[
				'label' => __( 'Normal', 'glint-extra' ),
			]
		);
        
        $this->add_responsive_control(
            'portfolio_box_margin',
            [
                'label' => __( 'Margin', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .growth-portfolios .portfolio-box' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'full_box_border',
                'label' => __( 'Border', 'glint-extra' ),
                'selector' => '{{WRAPPER}} .growth-portfolios .portfolio-box',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'full_box_shadow',
                'label' => __( 'Box Shadow', 'glint-extra' ),
                'selector' => '{{WRAPPER}} .growth-portfolios .portfolio-box',
            ]
        );

        $this->add_responsive_control(
            'full_box_radius',
            [
                'label' => esc_html__( 'Box Radius', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .growth-portfolios .portfolio-box' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_image_radius',
            [
                'label' => esc_html__( 'Image Radius', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .growth-portfolios .portfolio-box .protfolio-image' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        
        
        
        $this->end_controls_tab(); // Hover Style tab end
        $this->start_controls_tab( 'full_box_hover',
			[
				'label' => __( 'Hover', 'glint-extra' ),
			]
		); 
        
        $this->add_responsive_control(
            'portfolio_box_margin_hover',
            [
                'label' => __( 'Margin', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .growth-portfolios .portfolio-box:hover' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'full_box_border_hover',
                'label' => __( 'Border', 'glint-extra' ),
                'selector' => '{{WRAPPER}} .growth-portfolios .portfolio-box:hover',
            ]
        );
        $this->add_group_control(
            Group_Control_Box_Shadow::get_type(),
            [
                'name' => 'full_box_shadow_hover',
                'label' => __( 'Box Shadow', 'glint-extra' ),
                'selector' => '{{WRAPPER}} .growth-portfolios .portfolio-box:hover',
            ]
        );

        $this->add_responsive_control(
            'full_box_radius_hover',
            [
                'label' => esc_html__( 'Box Radius', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .growth-portfolios .portfolio-box:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_responsive_control(
            'box_image_radius_hover',
            [
                'label' => esc_html__( 'Image Radius', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .growth-portfolios .portfolio-box:hover .protfolio-image' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        
        
        
        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end  
        
        
        
        
        
        
        
        
        $this->end_controls_section(); // portfolio section style end
        
        
        // portfolio Style tab section
        $this->start_controls_section(
            'content_box_style_section',
            [
                'label' => __( 'Content Box', 'glint-extra' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        $this->add_responsive_control(
            'content_box_margin',
            [
                'label' => __( 'Margin', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .growth-portfolios .portfolio-details' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );

        $this->add_responsive_control(
            'content_box_padding',
            [
                'label' => __( 'Padding', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .growth-portfolios .portfolio-details' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Background::get_type(),
            [
                'name' => 'content_box_background',
                'label' => __( 'Overlay Background', 'glint-extra' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .growth-portfolios .portfolio-details',
            ]
        );
        
                
		$this->add_responsive_control(
			'content_box_width',
			[
				'label' => __( 'Width', 'glint-extra' ),
				'type' => Controls_Manager::SLIDER,
				'size_units' => [ 'px', '%' ],
				'range' => [
					'px' => [
						'min' => 0,
						'max' => 1000,
						'step' => 1,
					],
					'%' => [
						'min' => 0,
						'max' => 100,
					],
				],
				'default' => [
					'unit' => '%',
					'size' => 100,
				],
				'selectors' => [
					'{{WRAPPER}} .growth-portfolios .portfolio-details' => 'width: {{SIZE}}{{UNIT}};',
				],
			]
		);        
        $this->end_controls_section(); // portfolio section style end
        
        
        
        
        // portfolio portfolio Title Style tab section
        $this->start_controls_section(
            'portoflio_title_style',
            [
                'label' => __( 'Title', 'growth' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_title' => 'yes',
                ],
            ]
        );
            
            $this->add_control(
                'portfolio_title_color',
                [
                    'label' => __( 'Color', 'growth' ),
                    'type' => Controls_Manager::COLOR,
                   'selectors' => [
                        '{{WRAPPER}} .portfolio-box .portfolio-details .title a' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_control(
                'portfolio_title_hover_color',
                [
                    'label' => __( 'Hover Color', 'growth' ),
                    'type' => Controls_Manager::COLOR,
                    'default' => '#0a0c19',
                    'selectors' => [
                        '{{WRAPPER}} .portfolio-box .portfolio-details .title a:hover' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'portfolio_title_typography',
                    'selector' => '{{WRAPPER}} .portfolio-box .portfolio-details .title',
                ]
            );
            $this->add_responsive_control(
                'portfolio_title_margin',
                [
                    'label' => __( 'Margin', 'growth' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .portfolio-box .portfolio-details .title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'portfolio_title_padding',
                [
                    'label' => __( 'Padding', 'growth' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .portfolio-box .portfolio-details .title' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // portfolio title style end

        
        
        // portfolio portfolio Title Style tab section
        $this->start_controls_section(
            'portoflio_desc_style',
            [
                'label' => __( 'Description', 'growth' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'show_desc' => 'yes',
                ],
            ]
        );
            
            $this->add_control(
                'portfolio_desc_color',
                [
                    'label' => __( 'Color', 'growth' ),
                    'type' => Controls_Manager::COLOR,
                    'selectors' => [
                        '{{WRAPPER}} .portfolio-box .portfolio-details .desc' => 'color: {{VALUE}};',
                    ],
                ]
            );
            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name' => 'portfolio_desc_typography',
                    'selector' => '{{WRAPPER}} .portfolio-box .portfolio-details .desc',
                ]
            );
            $this->add_responsive_control(
                'portfolio_desc_margin',
                [
                    'label' => __( 'Margin', 'growth' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .portfolio-box .portfolio-details .desc' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

            $this->add_responsive_control(
                'portfolio_desc_padding',
                [
                    'label' => __( 'Padding', 'growth' ),
                    'type' => Controls_Manager::DIMENSIONS,
                    'size_units' => [ 'px', '%', 'em' ],
                    'selectors' => [
                        '{{WRAPPER}} .portfolio-box .portfolio-details .desc' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                    ],
                    'separator' =>'before',
                ]
            );

        $this->end_controls_section(); // portfolio title style end

        
        
        // portfolio Style tab section
        $this->start_controls_section(
            'box_cats_section',
            [
                'label' => __( 'Categores', 'glint-extra' ),
                'tab' => Controls_Manager::TAB_STYLE,
            ]
        );
        
        $this->start_controls_tabs('box_cats_style_tab');
        
        $this->start_controls_tab( 'box_cats_normal',
			[
				'label' => __( 'Normal', 'glint-extra' ),
			]
		);
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'portfolio_cats_typography',
                'selector' => '{{WRAPPER}} .portfolio-box .portfolio-details .cats a',
            ]
        );
        $this->add_control(
            'cats_color',
            [
                'label' => __( 'Color', 'glint-extra' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#a9b5c9',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-box .portfolio-details .cats, {{WRAPPER}} .portfolio-box .portfolio-details .cats a' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'cats_padding',
            [
                'label' => __( 'Padding', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'default' => [
                    'top' => '0',
                    'right' => '0',
                    'bottom' => '0',
                    'left' => '0',
                    'isLinked' => true
                ],
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-box .portfolio-details .cats a' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );      
        $this->add_control(
			'box_cats_transition',
			[
				'label' => __( 'Transition Duration', 'glint-extra' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-box .portfolio-details .cats a' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        $this->end_controls_tab(); // Hover Style tab end
        $this->start_controls_tab( 'box_cats_hover',
			[
				'label' => __( 'Hover', 'glint-extra' ),
			]
		);        
        $this->add_control(
            'hover_cats_color',
            [
                'label' => __( 'Hover Color', 'glint-extra' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#00b0fa',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-box .portfolio-details .cats a:hover' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section();
        
        $this->start_controls_section(
            'post_slider_readmore_style_section',
            [
                'label' => __( 'Read More', 'glint-extra' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'show_read_more_btn'=>'yes',
                    'read_more_txt!'=>'',
                ]
            ]
        );
            
            $this->start_controls_tabs('readmore_style_tabs');

                $this->start_controls_tab(
                    'readmore_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'glint-extra' ),
                    ]
                );

                    $this->add_control(
                        'readmore_color',
                        [
                            'label' => __( 'Color', 'glint-extra' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .portfolio-box .portfolio-details .readmore-btn' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Typography::get_type(),
                        [
                            'name' => 'readmore_typography',
                            'label' => __( 'Typography', 'glint-extra' ),
                            'selector' => '{{WRAPPER}} .portfolio-box .portfolio-details .readmore-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_margin',
                        [
                            'label' => __( 'Margin', 'glint-extra' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .portfolio-box .portfolio-details .readmore-btn' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_padding',
                        [
                            'label' => __( 'Padding', 'glint-extra' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .portfolio-box .portfolio-details .readmore-btn' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'readmore_background',
                            'label' => __( 'Background', 'glint-extra' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .portfolio-box .portfolio-details .readmore-btn',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'readmore_border',
                            'label' => __( 'Border', 'glint-extra' ),
                            'selector' => '{{WRAPPER}} .portfolio-box .portfolio-details .readmore-btn',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'glint-extra' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .portfolio-box .portfolio-details .readmore-btn' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 

                $this->start_controls_tab(
                    'readmore_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'glint-extra' ),
                    ]
                );
                    $this->add_control(
                        'readmore_hover_color',
                        [
                            'label' => __( 'Color', 'glint-extra' ),
                            'type' => Controls_Manager::COLOR,
                            'default'=>'#ffc576',
                            'selectors' => [
                                '{{WRAPPER}} .portfolio-box .portfolio-details .readmore-btn:hover' => 'color: {{VALUE}}',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'readmore_hover_background',
                            'label' => __( 'Background', 'glint-extra' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .portfolio-box .portfolio-details .readmore-btn:hover',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'readmore_hover_border',
                            'label' => __( 'Border', 'glint-extra' ),
                            'selector' => '{{WRAPPER}} .portfolio-box .portfolio-details .readmore-btn:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'readmore_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'glint-extra' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .portfolio-box .portfolio-details .readmore-btn:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); 

            $this->end_controls_tabs();

        $this->end_controls_section();
        
        $this->start_controls_section(
            'slider_arrow_style',
            [
                'label'     => __( 'Arrow', 'glint-extra' ),
                'tab'       => Controls_Manager::TAB_STYLE,
                'condition' =>[
                    'slider_on' => 'yes',
                    'slarrows'  => 'yes',
                ],
            ]
        );
        
            $this->start_controls_tabs( 'slider_arrow_style_tabs' );

                // Normal tab Start
                $this->start_controls_tab(
                    'slider_arrow_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'glint-extra' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_color',
                        [
                            'label' => __( 'Color', 'glint-extra' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#FFC576',
                            'selectors' => [
                                '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_fontsize',
                        [
                            'label' => __( 'Font Size', 'glint-extra' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 100,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 16,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow' => 'font-size: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'slider_arrow_background',
                            'label' => __( 'Background', 'glint-extra' ),
                            'default' => '#ffffff',
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_height',
                        [
                            'label' => __( 'Height', 'glint-extra' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 50,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );
                    $this->add_responsive_control(
                        'slider_arrow_line_height',
                        [
                            'label' => __( 'Line Height', 'glint-extra' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 46,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow' => 'line-height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_width',
                        [
                            'label' => __( 'Width', 'glint-extra' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 50,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_padding',
                        [
                            'label' => __( 'Padding', 'glint-extra' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                            'separator' =>'before',
                        ]
                    );
        
                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'slider_arrow_border',
                            'label' => __( 'Border', 'glint-extra' ),
                            'selector' => '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'glint-extra' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'slider_arrow_box_shadow',
                            'label' => __( 'Box Shadow', 'glint-extra' ),
                            'selector' => '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow',
                        ]
                    );
        

                $this->end_controls_tab(); // Normal tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'slider_arrow_style_hover_tab',
                    [
                        'label' => __( 'Hover', 'glint-extra' ),
                    ]
                );

                    $this->add_control(
                        'slider_arrow_hover_color',
                        [
                            'label' => __( 'Color', 'glint-extra' ),
                            'type' => Controls_Manager::COLOR,
                            'default' => '#ffffff',
                            'selectors' => [
                                '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow:hover' => 'color: {{VALUE}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'slider_arrow_hover_background',
                            'label' => __( 'Background', 'glint-extra' ),
                            'types' => [ 'classic', 'gradient' ],
                            'default' => '#ffc576',
                            'selector' => '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow:before',
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'slider_arrow_hover_border',
                            'label' => __( 'Border', 'glint-extra' ),
                            'selector' => '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow:hover',
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_arrow_hover_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'glint-extra' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow:hover' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );
        
                    $this->add_group_control(
                        Group_Control_Box_Shadow::get_type(),
                        [
                            'name' => 'slider_arrow_box_shadow_hover',
                            'label' => __( 'Box Shadow', 'glint-extra' ),
                            'selector' => '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow:hover',
                        ]
                    );
        

                $this->end_controls_tab(); // Hover tab end

            $this->end_controls_tabs();
        
             $this->add_control(
                'slider_arrow_position_title',
                [
                    'label'     => __( 'Arrow Position', 'glint-extra' ),
                    'type'      => Controls_Manager::HEADING,
                    'separator' => 'before',
                ]
            );
        
            $this->start_controls_tabs( 'slider_arrow_position_tabs' );
                // Normal tab Start
                $this->start_controls_tab(
                    'slider_arrow_prev_tab',
                    [
                        'label' => __( 'Prev', 'glint-extra' ),
                    ]
                );
                $this->add_control(
                    'prev_arrow_x_dir',
                    [
                        'label' => __( 'Direction X', 'glint-extra' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'right',
                        'options' => [
                            'left'  => __( 'Left', 'glint-extra' ),
                            'right' => __( 'Right', 'glint-extra' ),
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'slider_arrow_prev_gap_x',
                    [
                        'label' => __( 'Position X', 'glint-extra' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vw' ],
                        'range' => [
                            'px' => [
                                'min' => -9999,
                                'max' => 9999,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                            'vh' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 49,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow.slick-prev' => 'position: absolute; {{prev_arrow_x_dir.VALUE}}: {{SIZE}}{{UNIT}};'
                        ],
                    ]
                );

                $this->add_control(
                    'prev_arrow_y_dir',
                    [
                        'label' => __( 'Direction Y', 'glint-extra' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'top',
                        'options' => [
                            'top'  => __( 'Top', 'glint-extra' ),
                            'bottom' => __( 'Bottom', 'glint-extra' ),
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'slider_arrow_prev_gap_y',
                    [
                        'label' => __( 'Position Y', 'glint-extra' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vh' ],
                        'range' => [
                            'px' => [
                                'min' => -9999,
                                'max' => 9999,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                            'vh' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => -100,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow.slick-prev' => 'position: absolute; {{prev_arrow_y_dir.VALUE}}: {{SIZE}}{{UNIT}};'
                        ],
                    ]
                );
        
                $this->add_responsive_control(
                    'slider_arrow_prev_border_radius',
                    [
                        'label' => __( 'Border Radius', 'eforestcore' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'default' => [
                            'top' => '3',
                            'right' => '0',
                            'bottom' => '0',
                            'left' => '3',
                            'isLinked' => true
                        ],
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow.slick-prev' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'after',
                    ]
                );
        
                 $this->end_controls_tab(); // Left Arrow tab end

                // Hover tab Start
                $this->start_controls_tab(
                    'slider_arrow_next_tab',
                    [
                        'label' => __( 'Next', 'glint-extra' ),
                    ]
                );  
                    $this->add_control(
                        'next_arrow_x_dir',
                        [
                            'label' => __( 'Direction X', 'glint-extra' ),
                            'type' => Controls_Manager::SELECT,
                            'default' => 'right',
                            'options' => [
                                'left'  => __( 'Left', 'glint-extra' ),
                                'right' => __( 'Right', 'glint-extra' ),
                            ],
                        ]
                    );
                   $this->add_responsive_control(
                    'slider_arrow_next_gap_x',
                    [
                        'label' => __( 'Position X', 'glint-extra' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vw' ],
                        'range' => [
                            'px' => [
                                'min' => -9999,
                                'max' => 9999,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                            'vh' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => 0,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow.slick-next' => 'position: absolute; {{next_arrow_x_dir.VALUE}}: {{SIZE}}{{UNIT}};'
                        ],
                    ]
                );
               $this->add_control(
                    'next_arrow_y_dir',
                    [
                        'label' => __( 'Direction Y', 'glint-extra' ),
                        'type' => Controls_Manager::SELECT,
                        'default' => 'top',
                        'options' => [
                            'top'  => __( 'Top', 'glint-extra' ),
                            'bottom' => __( 'Bottom', 'glint-extra' ),
                        ],
                    ]
                );
                $this->add_responsive_control(
                    'slider_arrow_next_gap_y',
                    [
                        'label' => __( 'Position Y', 'glint-extra' ),
                        'type' => Controls_Manager::SLIDER,
                        'size_units' => [ 'px', '%', 'vh' ],
                        'range' => [
                            'px' => [
                                'min' => -9999,
                                'max' => 9999,
                                'step' => 1,
                            ],
                            '%' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                            'vh' => [
                                'min' => -100,
                                'max' => 100,
                                'step' => 1,
                            ],
                        ],
                        'default' => [
                            'unit' => 'px',
                            'size' => -100,
                        ],
                        'selectors' => [
                            '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow.slick-next' => 'position: absolute; {{next_arrow_y_dir.VALUE}}: {{SIZE}}{{UNIT}};'
                        ],
                    ]
                );
        
                $this->add_responsive_control(
                    'slider_arrow_next_border_radius',
                    [
                        'label' => __( 'Border Radius', 'eforestcore' ),
                        'type' => Controls_Manager::DIMENSIONS,
                        'default' => [
                            'top' => '0',
                            'right' => '3',
                            'bottom' => '3',
                            'left' => '0',
                            'isLinked' => true
                        ],
                        'size_units' => [ 'px', '%', 'em' ],
                        'selectors' => [
                            '{{WRAPPER}} .growthcore-carousel-activation .slick-arrow.slick-next' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                        ],
                        'separator' => 'after',
                    ]
                );

                $this->end_controls_tab(); // Right Arrow tab end
            $this->end_controls_tabs();
        $this->end_controls_section(); // Style Slider arrow style end


        // Style Pagination button tab section
        $this->start_controls_section(
            'post_slider_pagination_style_section',
            [
                'label' => __( 'Pagination', 'glint-extra' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition'=>[
                    'slider_on' => 'yes',
                    'sldots'=>'yes',
                ]
            ]
        );
            $this->add_responsive_control(
                'growth_portfolio_dots_alignment',
                [
                    'label' => __( 'Alignment', 'glint-extra' ),
                    'type' => Controls_Manager::CHOOSE,
                    'options' => [
                        'left' => [
                            'title' => __( 'Left', 'glint-extra' ),
                            'icon' => 'fa fa-align-left',
                        ],
                        'center' => [
                            'title' => __( 'Center', 'glint-extra' ),
                            'icon' => 'fa fa-align-center',
                        ],
                        'right' => [
                            'title' => __( 'Right', 'glint-extra' ),
                            'icon' => 'fa fa-align-right',
                        ],
                        'justify' => [
                            'title' => __( 'Justified', 'glint-extra' ),
                            'icon' => 'fa fa-align-justify',
                        ],
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .slick-dots' => 'text-align: {{VALUE}};'
                    ],
                    'default' => 'left',
                    'separator' =>'before',
                ]
            );
            $this->start_controls_tabs('pagination_style_tabs');

                $this->start_controls_tab(
                    'pagination_style_normal_tab',
                    [
                        'label' => __( 'Normal', 'glint-extra' ),
                    ]
                );

                    $this->add_responsive_control(
                        'slider_pagination_height',
                        [
                            'label' => __( 'Height', 'glint-extra' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .growthcore-carousel-activation .slick-dots li button' => 'height: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_responsive_control(
                        'slider_pagination_width',
                        [
                            'label' => __( 'Width', 'glint-extra' ),
                            'type' => Controls_Manager::SLIDER,
                            'size_units' => [ 'px', '%' ],
                            'range' => [
                                'px' => [
                                    'min' => 0,
                                    'max' => 1000,
                                    'step' => 1,
                                ],
                                '%' => [
                                    'min' => 0,
                                    'max' => 100,
                                ],
                            ],
                            'default' => [
                                'unit' => 'px',
                                'size' => 15,
                            ],
                            'selectors' => [
                                '{{WRAPPER}} .growthcore-carousel-activation .slick-dots li button' => 'width: {{SIZE}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'pagination_background',
                            'label' => __( 'Background', 'glint-extra' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .growthcore-carousel-activation .slick-dots li button',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_margin',
                        [
                            'label' => __( 'Margin', 'glint-extra' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'size_units' => [ 'px', '%', 'em' ],
                            'selectors' => [
                                '{{WRAPPER}} .growthcore-carousel-activation .slick-dots li button' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                            ],
                        ]
                    );

                    $this->add_group_control(
                        Group_Control_Border::get_type(),
                        [
                            'name' => 'pagination_border',
                            'label' => __( 'Border', 'glint-extra' ),
                            'selector' => '{{WRAPPER}} .growthcore-carousel-activation .slick-dots li button',
                        ]
                    );

                    $this->add_responsive_control(
                        'pagination_border_radius',
                        [
                            'label' => esc_html__( 'Border Radius', 'glint-extra' ),
                            'type' => Controls_Manager::DIMENSIONS,
                            'selectors' => [
                                '{{WRAPPER}} .growthcore-carousel-activation .slick-dots li button' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                            ],
                        ]
                    );

                $this->end_controls_tab(); // Normal Tab end

                $this->start_controls_tab(
                    'pagination_style_active_tab',
                    [
                        'label' => __( 'Active', 'glint-extra' ),
                    ]
                );
                    
                    $this->add_group_control(
                        Group_Control_Background::get_type(),
                        [
                            'name' => 'pagination_hover_background',
                            'label' => __( 'Background', 'glint-extra' ),
                            'types' => [ 'classic', 'gradient' ],
                            'selector' => '{{WRAPPER}} .growthcore-carousel-activation .slick-dots li button:hover, {{WRAPPER}} .growthcore-carousel-activation .slick-dots li.slick-active button',
                        ]
                    );

                $this->end_controls_tab(); // Hover Tab end

            $this->end_controls_tabs();

        $this->end_controls_section();
        
                
        // portfolio Style tab section
        $this->start_controls_section(
            'portfolio_filter_section',
            [
                'label' => __( 'Filter Menu', 'xenburcore' ),
                'tab' => Controls_Manager::TAB_STYLE,
                'condition' => [
                    'filter_on' => 'yes',
                ]
            ]
        );
        
        $this->add_responsive_control(
            'portfolio_menu_align',
            [
                'label' => __( 'Alignment', 'xenbur' ),
                'type' => Controls_Manager::CHOOSE,
                'options' => [
                    'left' => [
                        'title' => __( 'Left', 'xenbur' ),
                        'icon' => 'fa fa-align-left',
                    ],
                    'center' => [
                        'title' => __( 'Center', 'xenbur' ),
                        'icon' => 'fa fa-align-center',
                    ],
                    'right' => [
                        'title' => __( 'Right', 'xenbur' ),
                        'icon' => 'fa fa-align-right',
                    ],
                    'justify' => [
                        'title' => __( 'Justified', 'xenbur' ),
                        'icon' => 'fa fa-align-justify',
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter-menu' => 'text-align: {{VALUE}};',
                ],
                'default' => 'left'
            ]
        );
        $this->add_responsive_control(
            'filter_menu_width',
            [
                'label' => __( 'Width', 'xenburcore' ),
                'type' => Controls_Manager::SLIDER,
                'size_units' => [ 'px', '%', 'vw' ],
                'range' => [
                    'px' => [
                        'min' => 0,
                        'max' => 9999,
                        'step' => 1,
                    ],
                    '%' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                    'vw' => [
                        'min' => 0,
                        'max' => 100,
                    ],
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter-menu' => 'width: {{SIZE}}{{UNIT}};',
                ],
            ]
        );
        
        $this->add_responsive_control(
            'filter_menu_margin',
            [
                'label' => __( 'Margin', 'xenburcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter-menu' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'filter_menu_area_border',
                'label' => __( 'Border', 'glint-extra' ),
                'selector' => '{{WRAPPER}} .portfolio-filter-menu',
            ]
        );
        
        $this->add_control(
            'filter_menu_list_title_sc',
            [
                'label'     => __( 'Filter Menu Item Style', 'xenburcore' ),
                'type'      => Controls_Manager::HEADING,
                'separator' => 'before',
            ]
        );
        
        $this->start_controls_tabs('box_filter_style_tab');
        
        $this->start_controls_tab( 'box_filter_normal',
			[
				'label' => __( 'Normal', 'xenburcore' ),
			]
		);
        $this->add_control(
            'portfolio_filter_menu_display',
            [
                'label' => esc_html__( 'Display Item', 'xenburcore' ),
                'type' => Controls_Manager::SELECT,
                'default' => 'inline-block',
                'options' => [
                    'block'          => esc_html__('Block','xenburcore'),
                    'inline-block'          => esc_html__('Inline Block','xenburcore'),
                ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter-menu li' => 'display: {{VALUE}};'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Typography::get_type(),
            [
                'name' => 'portfolio_filter_typography',
                'selector' => '{{WRAPPER}} .portfolio-filter-menu li',
            ]
        );
        $this->add_control(
            'filter_color',
            [
                'label' => __( 'Color', 'xenburcore' ),
                'type' => Controls_Manager::COLOR,
               'default' => '#87899c',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter-menu li' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->add_control(
            'filter_bg_color',
            [
                'label' => __( 'Background Color', 'xenburcore' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter-menu li' => 'background-color: {{VALUE}};'
                ],
            ]
        );
        $this->add_responsive_control(
            'filter_margin',
            [
                'label' => __( 'Margin', 'xenburcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter-menu li' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );
        
        $this->add_responsive_control(
            'filter_padding',
            [
                'label' => __( 'Padding', 'xenburcore' ),
                'type' => Controls_Manager::DIMENSIONS,
                'size_units' => [ 'px', '%', 'em' ],
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter-menu li' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
                ],
                'separator' =>'before',
            ]
        );  
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'filter_menu_border',
                'label' => __( 'Border', 'glint-extra' ),
                'selector' => '{{WRAPPER}} .portfolio-filter-menu li',
            ]
        );
        $this->add_responsive_control(
            'filter_menu_border_radius',
            [
                'label' => esc_html__( 'Box Radius', 'glint-extra' ),
                'type' => Controls_Manager::DIMENSIONS,
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter-menu li' => 'border-radius: {{TOP}}px {{RIGHT}}px {{BOTTOM}}px {{LEFT}}px;',
                ],
            ]
        );
        $this->add_control(
			'box_filter_transition',
			[
				'label' => __( 'Transition Duration', 'glint-extra' ),
				'type' => Controls_Manager::SLIDER,
				'default' => [
					'size' => 0.3,
				],
				'range' => [
					'px' => [
						'max' => 3,
						'step' => 0.1,
					],
				],
				'selectors' => [
					'{{WRAPPER}} .portfolio-filter-menu li' => 'transition-duration: {{SIZE}}s',
				],
			]
		);
        $this->end_controls_tab(); // Hover Style tab end
        $this->start_controls_tab( 'box_filter_hover',
			[
				'label' => __( 'Hover', 'xenburcore' ),
			]
		);    
        
        $this->add_control(
            'hover_filter_color',
            [
                'label' => __( 'Active Color', 'xenburcore' ),
                'type' => Controls_Manager::COLOR,
                'default' => '#00b0fa',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter-menu li:hover' => 'color: {{VALUE}};',
                    '{{WRAPPER}} .portfolio-filter-menu li.active' => 'color: {{VALUE}};'
                ],
            ]
        );
        $this->add_control(
            'hover_filter_bg_color',
            [
                'label' => __( 'Active Background', 'xenburcore' ),
                'type' => Controls_Manager::COLOR,
                'default' => 'transparent',
                'selectors' => [
                    '{{WRAPPER}} .portfolio-filter-menu li:hover' => 'background-color: {{VALUE}};',
                    '{{WRAPPER}} .portfolio-filter-menu li.active' => 'background-color: {{VALUE}};'
                ],
            ]
        );
        $this->add_group_control(
            Group_Control_Border::get_type(),
            [
                'name' => 'filter_menu_border_hover',
                'label' => __( 'Border', 'glint-extra' ),
                'selector' => '{{WRAPPER}} .portfolio-filter-menu li:hover,{{WRAPPER}} .portfolio-filter-menu li.active',
            ]
        );
        $this->end_controls_tab(); // Hover Style tab end
        $this->end_controls_tabs();// Box Style tabs end  
        $this->end_controls_section();
	}

	/**
	 * Render button widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
        $settings   = $this->get_settings_for_display();
        $custom_order_ck    = $this->get_settings_for_display('custom_order');
        $orderby            = $this->get_settings_for_display('orderby');
        $postorder          = $this->get_settings_for_display('postorder');        
        $this->add_render_attribute( 'growth_portf_slider_attr', 'class', 'growth-portfolios' );
        $this->add_render_attribute( 'growth_portf_item_attr', 'class', 'portfolio-box' );
        
        if( $settings['hover_effect'] == 'yes' ){
            $this->add_render_attribute( 'growth_portf_item_attr', 'class', 'hover-ef-active' );
        }
        
        if( $settings['slider_on'] == 'yes' ){
            $this->add_render_attribute( 'growth_portf_slider_attr', 'class', 'growthcore-carousel-activation' );
            $slider_settings = [
                'arrows' => ('yes' === $settings['slarrows']),
                'arrow_prev_txt' => $settings['slprevicon'],
                'arrow_next_txt' => $settings['slnexticon'],
                'dots' => ('yes' === $settings['sldots']),
                'autoplay' => ('yes' === $settings['slautolay']),
                'autoplay_speed' => absint($settings['slautoplay_speed']),
                'animation_speed' => absint($settings['slanimation_speed']),
                'pause_on_hover' => ('yes' === $settings['slpause_on_hover']),
                'center_mode' => ( 'yes' === $settings['slcentermode']),
                'vertical_mode' => ( 'yes' === $settings['slverticalmode']),
                'center_padding' => absint($settings['slcenterpadding']),
            ];
            $slider_responsive_settings = [
                'display_columns' => $settings['slitems'],
                'scroll_columns' => $settings['slscroll_columns'],
                'tablet_width' => $settings['sltablet_width'],
                'tablet_display_columns' => $settings['sltablet_display_columns'],
                'tablet_scroll_columns' => $settings['sltablet_scroll_columns'],
                'mobile_width' => $settings['slmobile_width'],
                'mobile_display_columns' => $settings['slmobile_display_columns'],
                'mobile_scroll_columns' => $settings['slmobile_scroll_columns'],
            ];
            $slider_settings = array_merge( $slider_settings, $slider_responsive_settings );
            $this->add_render_attribute( 'growth_portf_slider_attr', 'data-settings', wp_json_encode( $slider_settings ) );
        }else {            
            $this->add_render_attribute( 'growth_portf_slider_attr', 'class', 'grid-portfolios' );
        }        
        $args = array(
            'post_type'             => 'portfolio',
            'post_status'           => 'publish',
            'ignore_sticky_posts'   => 1,
            'posts_per_page'        => !empty( $settings['post_limit'] ) ? $settings['post_limit'] : 3,
            'order'                 => $postorder
        );                
        if( $custom_order_ck == 'yes' ){
            $args['orderby']    = $orderby;
        }
		
		
        $get_categories = $settings['portfolio_categories'];
        $portfolio_cats = str_replace( ' ', '', $get_categories );
        if (  !empty( $get_categories ) ) {
            if( is_array($portfolio_cats) and count($portfolio_cats) > 0 ){
                $field_name = is_numeric( $portfolio_cats[0] ) ? 'term_id' : 'slug';
                $args['tax_query'] = array(
                    array(
                        'taxonomy' => 'portfoliocats',
                        'terms' => $portfolio_cats,
                        'field' => $field_name,
                        'include_children' => false
                    )
                );
            }
        }
        $portf_post = new \WP_Query( $args );        
        if( $settings['filter_on'] == 'yes' and $settings['slider_on'] != 'yes' and !empty($portfolio_cats)){            
            $this->add_render_attribute( 'growth_portf_slider_attr', 'class', 'portfolio_filter_items' );            
            echo '<ul class="portfolio-filter portfolio-filter-menu">';
            echo '<li data-filter="*" class="active" >'.esc_html__( 'All','glint-extra' ).'</li>';
            foreach( $portfolio_cats as $portfolio_cat ){
                echo '<li data-filter=".'.esc_attr($portfolio_cat).'">'.esc_html($portfolio_cat).'</li>';
            }
            echo '</ul>';
        }
        if( $portf_post->have_posts() ):        
        echo '<div '.$this->get_render_attribute_string( 'growth_portf_slider_attr' ).' >';        
        while( $portf_post->have_posts() ): $portf_post->the_post();        
        ?>
		
		
        <div class="portfolio-grid <?php echo portfolio_single_cat( ' ', 'slug' ); ?> " >
            <div <?php echo $this->get_render_attribute_string( 'growth_portf_item_attr' ); ?> >
			
			

				<div class="single-portfolio-item lage">
					<a href="<?php echo get_the_permalink(); ?>" class="protfolio-image">
						<?php the_post_thumbnail('full'); ?>
					</a>
					<div class="portfolio-hover">
						<div class="portfolio-hover-table">
							<div class="portfolio-hover-table-cell">
								<a href="<?php echo get_the_permalink(); ?>"><i class="fa fa-eye"></i></a>
								
							</div>
						</div>
					</div>
				</div>
				
				
				
                <div class="portfolio-details portfolio-description">
                    <?php
                        if( $settings['show_category'] == 'yes' ):
                            echo get_the_term_list( get_the_ID(), 'portfoliocats', '<div class="cats">', ', ', '</div>' );
                        endif;
                        if( $settings['show_title'] == 'yes' ):
                        echo '<h4 class="title"><a href="'.get_the_permalink().'">'.wp_trim_words( get_the_title(), $settings['title_length'], '' ).'</a></h4>';
                        endif;
                        if( $settings['show_desc'] == 'yes' ):
                        echo '<div class="desc">'.wp_trim_words( get_the_content(), $settings['desc_length'], '' ).'</div>';
                        endif;
                        if( $settings['show_read_more_btn'] == 'yes' ): ?>
                            <a class="readmore-btn" href="<?php the_permalink();?>"><?php echo esc_html__( $settings['read_more_txt'], 'glint-extra' );?> <span class="icon"><i class="<?php echo esc_attr($settings['readmore_button_icon']); ?>"></i></span></a>
                        <?php endif; ?>
                </div>
            </div>
        </div>
		
		
		
        <?php     
        endwhile;
        wp_reset_postdata();
        wp_reset_query();
        echo '</div>';
        endif;
	}
}

Plugin::instance()->widgets_manager->register( new glint_Portfolio );