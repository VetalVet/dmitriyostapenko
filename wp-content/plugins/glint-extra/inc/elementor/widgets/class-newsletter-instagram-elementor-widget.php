<?php
/**
 * Elementor Widget
 * @package Glint
 * @since 1.0.0
 */

namespace Elementor;
class glint_newsletter_section extends Widget_Base {

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
		return 'glint-newsletter-widget';
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
		return esc_html__( 'Newsletter & Instagram Section', 'glint-extra' );
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
				'label' => esc_html__( 'About Box Content', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control(
	   		 'image',
	      	[
	          'label' => esc_html__( 'Section background Image', 'glint-extra' ),
	          'type'  => Controls_Manager::MEDIA,
				'dynamic' => [
				'active' => true,
			   ],
	    	]
	    );
	
		$this->add_control(
			'newsletter-content',
			[
				'label'       => esc_html__( 'Newsletter Content', 'glint-extra' ),
				'type'        => Controls_Manager::WYSIWYG,
				'description' => esc_html__( 'Enter newsletter Title & Form shortcode', 'glint-extra' ),
				]
		);
		
		$this->add_control(
			'sociall_active',
			[
				'label'       => esc_html__( 'Show Social Box', 'glint-extra' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on' => __( 'Show', 'your-plugin' ),
				'label_off' => __( 'Hide', 'your-plugin' ),
				'return_value' => 'yes',
				'default' => 'no',
			]
			
		);
		

		$this->end_controls_section();
		

		$this->start_controls_section(
			'social_section',
			[
				'label' => esc_html__( 'Social Box', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'socialItems', [
			'label'       => esc_html__( 'Social Item', 'glint-extra' ),
			'type'        => Controls_Manager::REPEATER,
			'default'     => [
				[
					'title'        => esc_html__( 'Join our instagram', 'glint-extra' ),
				]
			],
			'fields'      => [
				
				[
					'name'        => 'title',
					'label'       => esc_html__( 'Social Title', 'glint-extra' ),
					'type'        => Controls_Manager::TEXT,
					'description' => esc_html__( 'Enter Position', 'glint-extra' )
				],
				
				[
					'name'        => 'social_image',
					'label'       => esc_html__( 'Social image Thumbnail', 'glint-extra' ),
					'type'        => Controls_Manager::MEDIA,
					'default'     =>
						array(
							'url' => Utils::get_placeholder_image_src(),
						),
					'description' => esc_html__( 'upload social image', 'glint-extra' )
				],
				
				[
					'name'        => 'social_icon',
					'label'       => esc_html__( 'Social Icon', 'glint-extra' ),
					'type'        => Controls_Manager::ICON,
					'default' => 'fa fa-instagram',
					'description' => esc_html__( 'Upload Icon', 'glint-extra' )
				],
				
				[
					'name'        => 'social_url',
					'label'       => esc_html__( 'Social Url', 'glint-extra' ),
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
            'glint_newsletter_title_style_section',
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
                        '{{WRAPPER}} .cta-area .primery-heading h2' => 'color: {{VALUE}}',
                    ]
                ]
            ); 
			

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'title_typography_latter',
					'label'     => __( 'Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .cta-area .primery-heading h2',
                ]
            ); 
			
			
	            $this->add_control(
                'newsletter_title_size',
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
                        '{{WRAPPER}} .cta-area .primery-heading h2' => 'font-size: {{SIZE}}{{UNIT}};',
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
		$image_id = $settings['image']['id'];
		$image_url = wp_get_attachment_image_src( $image_id, 'full', false );
		
		$socialItems = $settings['socialItems'];
		
		
		

		?>	
		
        <!--:::::CALL TO ACTION AREA START :::::::-->
        <div class="cta-area cta-primery" style="background-image: url(<?php echo esc_url( isset($image_url[0])?$image_url[0]:'#' ); ?>);background-position: center;background-size: cover;background-repeat: no-repeat;">
            <div class="container">
                <div class="row">
                    <div class="col-lg-6 m-auto text-center">
					
					<?php echo wp_kses_post( $settings['newsletter-content'] ); ?>
					
                    </div>
                </div>
            </div>
			
			
			<?Php if('yes' === $settings['sociall_active'] ) : ?>
			
            <div class="space-100"></div>
            <!--:::::SOCIAL AREA START :::::::-->


            <div class="social-area">
                <div class="container">
                    <div class="row">
					
						<?php
					foreach ( $socialItems as $item ):
				?>
				
                        <div class="col-lg">
                            <div class="single-social">
							
							
                                <div class="sinlge-social-hover" style="background: url(<?php echo esc_url( $item['social_image']['url'] ); ?>);background-position: center;-webkit-background-size: cover;
                                background-size: cover;">
							
								
                                    <a href="<?php echo esc_url( $item['social_url']['url'] ); ?>">
                                        <span class="single-social-icon">
                                           <i class="<?php echo esc_attr( $item['social_icon'] ); ?>"></i>
                                        </span>
                                        <span class="single-soicial-text">
                                            <p><?php echo esc_html( $item['title'] ); ?></p>
                                        </span>
                                    </a>
                                </div>
                            </div>
                        </div>
						
				<?php endforeach; ?>

				
	
                    </div>
                </div>
            </div>
        <!--:::::SOCIAL AREA END :::::::-->
		
		<?php endif; ?>
		



        <!--:::::SOCIAL AREA END :::::::-->


        </div>
        <!--:::::CALL TO ACTION AREA END :::::::-->


		





		<?php
	}
}

Plugin::instance()->widgets_manager->register( new glint_newsletter_section() );