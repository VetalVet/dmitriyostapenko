<?php
/**
 * Elementor Widget
 * @package Glint
 * @since 1.0.0
 */

namespace Elementor;
class glint_counter_box_widget extends Widget_Base {

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
		return 'glint-counter-widget';
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
		return esc_html__( 'Stats Section', 'glint-extra' );
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
				'label' => esc_html__( 'Stat Box', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'statItems', [
			'label'       => esc_html__( 'Stat Item', 'glint-extra' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'title'        => esc_html__( 'DESIGN PRINCIPALES', 'glint-extra' ),
				]
			],
			'fields'      => [
				
				[
					'name'        => 'title',
					'label'       => esc_html__( 'Title', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Title', 'glint-extra' )
				],
				[
					'name'        => 'number',
					'label'       => esc_html__( 'Counter Number', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Counter Number', 'glint-extra' )
				],
				
				[
					'name'        => 'icon',
					'label'       => esc_html__( 'Stat Icon', 'glint-extra' ),
					'type'        => Controls_Manager::ICON,
					'default' => 'fas fa-smile',
					'description' => esc_html__( 'Upload Icon', 'glint-extra' )
				],
				
				[
					'name'        => 'color',
					'label'       => esc_html__( 'Icon Box Color', 'glint-extra' ),
					'type'        => Controls_Manager::COLOR,
					'description' => esc_html__( 'Select Color', 'glint-extra' ),
					
				
				],
				

			],
			'title_field' => "{{name}}"
		] );
		
		$this->end_controls_section();
		
		// Features style tab start
        $this->start_controls_section(
            'glint_stat_style_section',
            [
                'label'     => __( 'Stat Boxes Style', 'glint-extra' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );

			
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'stat_title_typography',
					'label'     => __( 'Stat Box title typography', 'glint-extra' ),
                    'selector' => '{{WRAPPER}} .fact.Client h2',
                ]
            );
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'stat_inner_typography',
					'label'     => __( 'Stat Box Content typography', 'glint-extra' ),
                    'selector' => '{{WRAPPER}} .fact span',
                ]
            );


			
			$this->add_control(
                'stat_box_title_size',
                [
                    'label' => __( 'Stat box title Font Size', 'glint-extra' ),
                    'type'  => Controls_Manager::SLIDER,
                    'range' => [
                        'px' => [
                            'min' => 0,
                            'max' => 500,
                        ],
                    ],
                    'default' => [
                        'size' => 56,
                    ],
                    'selectors' => [
                        '{{WRAPPER}} .fact.Client h2' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
			
			$this->add_control(
                'stat_box_content_size',
                [
                    'label' => __( 'Stat box Content Font Size', 'glint-extra' ),
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
                        '{{WRAPPER}} .fact span' => 'font-size: {{SIZE}}{{UNIT}};',
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
		$stat_items = $settings['statItems'];
	
		
		?>	
				
				
		<!--:::::COUNTER AREA START :::::::-->
        <div class="fun-facts center">
            <div class="pattern"></div>
            <div class="container">
                <div class="row">
					
				<?php
					foreach ( $stat_items as $item ):
				?>
				
                    <!-- Fact No. 1 -->
                    <div class="col-md-3 col-sm-6">
                        <div class="fact Client">
                            <i style="color:<?php echo esc_attr( $item['color'] ); ?>" class="<?php echo esc_attr( $item['icon'] ); ?>"></i>

	                    <h2 style="color:<?php echo esc_attr( $item['color'] ); ?>" class="project-counter"><?php echo esc_html( $item['number'] ); ?></h2>
                            <span><?php echo esc_html( $item['title'] ); ?></span>
                        </div>
                    </div>
					
				<?php endforeach; ?>	
					
					
                </div>
            </div>
        </div>
        <!--:::::COUNTER AREA END :::::::-->		
				

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new glint_counter_box_widget() );