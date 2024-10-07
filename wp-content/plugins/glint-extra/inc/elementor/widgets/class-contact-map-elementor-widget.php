<?php

/**
 * Elementor widget
 * @package Glint
 * @since 1.0.0
 * */

namespace Elementor;
class glint_map_section_widget extends Widget_Base{
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
	public function get_name()
	{
		return 'map-section';
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
	public function get_title()
	{
		return esc_html__('Contact Map Section','glint-extra');
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
	public function get_icon()
	{
		return 'fa fa-code';
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
	public function get_categories()
	{
		return ['glint_widgets'];
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
				'label' => esc_html__( 'Map Section Title Content', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

        $this->add_control(
			'title',
			[
				'label'       => esc_html__( 'Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter title.', 'glint-extra' ),
				'default'     => esc_html__('GET IN ONE TOUCH','glint-extra')
			]
		);
		


		$this->add_control(
			'top-sub-title',
			[
				'label'       => esc_html__( 'Sub Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'enter sub title.', 'glint-extra' ),
				'default'     => esc_html__('EXPLORE THE FEATURES','glint-extra')
			]
		);	
		
		$this->add_control(
			'bg-effect-title',
			[
				'label'       => esc_html__( 'Background Effect Title', 'glint-extra' ),
				'type'        => Controls_Manager::TEXT,
				'description' => esc_html__( 'Enter effect title.', 'glint-extra' ),
				'default'     => esc_html__('CONTACT US','glint-extra')
			]
		);	
		

		
		$this->end_controls_section();

		
		// info popup

		$this->start_controls_section(
			'map_section',
			[
				'label' => esc_html__( 'Map Section', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);


	    $this->add_control(
			'map_content',
			[
				'label'       => esc_html__( 'Map Code Content', 'glint-extra' ),
				'type'        => Controls_Manager::WYSIWYG,
				'description' => esc_html__( 'Enter Map content shortcode.', 'glint-extra' ),
				]
		);

	 $this->end_controls_section();
	 
	 $this->start_controls_section(
			'contact_form_section',
			[
				'label' => esc_html__( 'Contact Form Content', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);

		
		$this->add_control(
			'form-content',
			[
				'label'       => esc_html__( 'Form shortcode', 'glint-extra' ),
				'type'        => Controls_Manager::WYSIWYG,
				'description' => esc_html__( 'Enter Contact Form Shortcode.', 'glint-extra' ),
			]
		);
		
		$this->end_controls_section();
	 

	}

	protected function render()
	{
		$settings = $this->get_settings_for_display();

	


		?>

	        <!--:::::CONTACT AREA START :::::::-->
        <div class="contact-page-area inner-bg-shpes section-padding">
            <div class="container">

                <div class="row">
                    <div class="col-lg-6 align-self-center">
                        <div id="map"><?php echo $settings['map_content']; ?></div>
                    </div>
                    <div class="col-lg-6 align-self-center">
                        <div class="primery-heading">
                            <strong class="filltext"><?php echo esc_html( $settings[ 'bg-effect-title' ] ); ?></strong>
                            <small><?php echo esc_html( $settings[ 'top-sub-title' ] ); ?></small>
                            <h2><?php echo esc_html( $settings[ 'title' ] ); ?></h2>
                        </div>
                        <div class="space-20"></div>
						
						<?php echo wp_kses_post( $settings['form-content'] ); ?>
					
						
						
                    </div>
					
					
                </div>
            </div>
  
        </div>
        <!--:::::CONTACT AREA END :::::::-->
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	    
 	<?php
	}
}
plugin::instance()->widgets_manager->register(new glint_map_section_widget());