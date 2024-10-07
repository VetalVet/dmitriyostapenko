<?php
/**
 * Elementor Widget
 * @package Glint
 * @since 1.0.0
 */

namespace Elementor;
class glint_project_gallery_widget extends Widget_Base {

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
		return 'glint-project-gallery-widget';
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
		return esc_html__( 'Project Gallery', 'glint-extra' );
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

        $this->end_controls_section();


		$this->start_controls_section(
			'settings_section',
			[
				'label' => esc_html__( 'Project Gallery', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'projectgalleryItems', [
			'label'       => esc_html__( 'Testimonial Item', 'glint-extra' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'author_name'        => esc_html__( 'Jack Metiyo Shina', 'glint-extra' ),
				]
			],
			'fields'      => [
				
				[
					'name'        => 'project_title',
					'label'       => esc_html__( 'Project Title', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Position', 'glint-extra' )
				],
				
				[
					'name'        => 'image',
					'label'       => esc_html__( 'Project Thumbnail', 'glint-extra' ),
					'type'        => Controls_Manager::MEDIA,
					'default'     =>
						array(
							'url' => Utils::get_placeholder_image_src(),
						),
					'description' => esc_html__( 'Upload Project image', 'glint-extra' )
				],
				
				[
				'name'        => 'project-url',
				'label'       => esc_html__( 'Box Url', 'glint' ),
				'type'        => Controls_Manager::URL,
					'default'     => array(
						'url' => '#'
					),
					
				],
		


			],
			'title_field' => "{{name}}"
		] );
		
		$this->end_controls_section();

		
			// Features style tab start
        $this->start_controls_section(
            'glint_project_title_style_section',
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
                        '{{WRAPPER}} .project-area .primery-heading h2' => 'color: {{VALUE}}',
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
                        '{{WRAPPER}} .project-area .primery-info-content p' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'title_typography_prohec',
					'label'     => __( 'Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .project-area .primery-heading h2',
                ]
            ); 
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'sub_title_typography_gal',
					'label'     => __( 'Sub Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .project-area .primery-info-content p',
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
                        '{{WRAPPER}} .project-area .primery-heading h2' => 'font-size: {{SIZE}}{{UNIT}};',
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
                        '{{WRAPPER}} .project-area .primery-info-content p' => 'font-size: {{SIZE}}{{UNIT}};',
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
		$pgallery_items = $settings['projectgalleryItems'];

		
		
		?>	
				


        <!--:::::PROJECT AREA START :::::::-->
        <div class="project-area project-area-primery">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 align-self-center">
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
                    <ul id="da-thumbs" class="da-thumbs portfolio-carousel owl-carousel">

						<?php
							foreach ( $pgallery_items as $item ):
						?>
						
                        <li>
                            <a href="<?php echo esc_url( $item['project-url']['url'] ); ?>">
                                <img src="<?php echo esc_url( $item['image']['url'] ); ?>" alt="" />
                                <div><span><?php echo esc_html( $item[ 'project_title' ] ); ?></span></div>
                            </a>
                        </li>
						
					<?php endforeach; ?>

                    </ul>
                </div>
            </div>
        </div>
        <!--:::::PROJECT AREA END :::::::-->
		
		
		
		
		




		<?php
	}
}

Plugin::instance()->widgets_manager->register( new glint_project_gallery_widget() );