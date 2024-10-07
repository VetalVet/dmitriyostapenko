<?php
/**
 * Elementor Widget
 * @package Glint
 * @since 1.0.0
 */

namespace Elementor;
class glint_blog_grid_widget extends Widget_Base {

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
		return 'glint-blog-widget';
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
		return esc_html__( 'Blog Section', 'glint-extra' );
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
                'label' => esc_html__( 'General Settings', 'glint-extra' ),
                'tab'   => Controls_Manager::TAB_CONTENT,
            ]
        );

        $this->add_control(
			'ppp',
			[
				'label'       => esc_html__( 'Dispaly Number', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'How Many Posts Display', 'glint-extra' ),
				'default'     => esc_html__('4','glint-extra')
			]
		);
		
		

		$this->add_control(
			'top-sub-title',
			[
				'label'       => esc_html__( 'Sub Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter sub title.', 'glint-extra' ),
				'default'     => esc_html__('RECENT NEWS DESK','glint-extra')
			]
		);	
		
		$this->add_control(
			'colored-title',
			[
				'label'       => esc_html__( 'Title Colored Part', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter title.', 'glint-extra' ),
				'default'     => esc_html__('BLOGS','glint-extra')
			]
		); 
		
		$this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter title.', 'glint-extra' ),
				'default'     => esc_html__('LASTET NEWS & ','glint-extra')
			]
		);

		
		$this->add_control(
			'bg-effect-title',
			[
				'label'       => esc_html__( 'Background Effect Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter effect title.', 'glint-extra' ),
				'default'     => esc_html__('NEWS & BLOGS','glint-extra')
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
		
	
		// Features style tab start
        $this->start_controls_section(
            'glint_blog_title_style_section',
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
                        '{{WRAPPER}} .blog-area .primery-heading h2' => 'color: {{VALUE}}',
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
                        '{{WRAPPER}} .blog-area .primery-info-content p' => 'color: {{VALUE}}',
                    ]
                ]
            );

            $this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'title_typography_blog',
					'label'     => __( 'Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .blog-area .primery-heading h2',
                ]
            ); 
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'sub_title_typography_blog',
					'label'     => __( 'Sub Title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .blog-area .primery-info-content p',
                ]
            );
			
	            $this->add_control(
                'blog_title_size',
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
                        '{{WRAPPER}} .blog-area .primery-heading h2' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            ); 
			
			$this->add_control(
                'blog_sub_size',
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
                        '{{WRAPPER}} .blog-area .primery-info-content p' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );		

	    $this->end_controls_section(); // Features style tab end		
		
		// Features style tab start
        $this->start_controls_section(
            'glint_blog_style_section',
            [
                'label'     => __( 'Blog Grid Item Boxes Style', 'growthcore' ),
                'tab'       => Controls_Manager::TAB_STYLE,
            ]
        );


			
			$this->add_control(
                'grid_title_color',
                [
                    'label'     => __( 'Blog grid title Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#131616',
                    'selectors' => [
                        '{{WRAPPER}} .blog-area .blog-description h5' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			$this->add_control(
                'grid_content_color',
                [
                    'label'     => __( 'Blog Excerpt Content Color', 'growthcore' ),
                    'type'      => Controls_Manager::COLOR,
					'default'   => '#969ea1',
                    'selectors' => [
                        '{{WRAPPER}} .blog-area .blog-description p' => 'color: {{VALUE}}',
                    ]
                ]
            );
			
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'grid_title_typography',
					'label'     => __( 'Blog Grid title typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .blog-area .blog-description h5',
                ]
            );
			
			$this->add_group_control(
                Group_Control_Typography::get_type(),
                [
                    'name'     => 'grid_content_typography',
					'label'     => __( 'Blog Grid Content typography', 'growthcore' ),
                    'selector' => '{{WRAPPER}} .blog-area .blog-description p',
                ]
            );


			
			$this->add_control(
                'bgrid_title_size',
                [
                    'label' => __( 'Blog Grid title Font Size', 'growthcore' ),
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
                        '{{WRAPPER}} .blog-area .blog-description h5' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
			
			$this->add_control(
                'bgrid_content_size',
                [
                    'label' => __( 'Blog Grid Content Font Size', 'growthcore' ),
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
                        '{{WRAPPER}} .blog-area .blog-description p' => 'font-size: {{SIZE}}{{UNIT}};',
                    ],
                ]
            );
			
			
			 $this->add_responsive_control(
				'grid_box_padding',
				[
					'label' => __( 'Blog Grid Content Padding', 'growthcore' ),
					'type' => Controls_Manager::DIMENSIONS,
					'size_units' => [ 'px', '%', 'em' ],
					'default' => [
						'top' => '30',
						'right' => '30',
						'bottom' => '30',
						'left' => '30',
						'isLinked' => false
					],
					'selectors' => [
						'{{WRAPPER}} .blog-area .blog-description' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
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
		

		
		
		?>	
				

		
		
        <!--:::::BLOG AREA START :::::::-->
        <div class="blog-area">
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
				
					<div class="blogs owl-carousel"> 
					
				<?php  
				
				   $blog = new \WP_Query(array(  
				   'post_type' =>  'post',  
				   'posts_per_page'  => $settings[ 'ppp' ],
				   'ignore_sticky_posts' => 1
					)  );  
					
					if ( $blog->have_posts() ) :
					 while ( $blog->have_posts()) : $blog->the_post(); 
						$blog_img = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
						$glint_featured_img = wp_get_attachment_url( get_post_thumbnail_id( get_the_ID() ) );
				?>
				
                        <div class="single-blog">
							
							<?php if ( !empty( $glint_featured_img ) ): ?>
							
                            <div class="single-blog-img" style="background-image: url(<?php echo esc_url( $glint_featured_img ); ?>);height:250px; background-size: cover;background-position: center;background-repeat: no-repeat;">
                            </div>
							<?php endif; ?>
							
                            <div class="blog-description">
								<p><?php echo get_the_date( 'F j, Y' ); ?></p>
                                <a class="grid_btitle" href="<?php the_permalink( ); ?>"><?php the_title(  ); ?></a>
                                <div class="space-10"></div>
                                <a href="<?php the_permalink( ); ?>" class="readmore-btn"><i class="fa fa-arrow-right"></i> read more</a>
                            </div>
                           
                        </div>
						
						<?php endwhile; wp_reset_postdata(); endif; ?>
						
						
                    </div>
                </div>
            </div>
        </div>
        <!--:::::BLOG AREA END :::::::-->

		
		
		
		
		




		<?php
	}
}

Plugin::instance()->widgets_manager->register( new glint_blog_grid_widget() );