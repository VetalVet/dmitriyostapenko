<?php
/**
 * Elementor Widget
 * @package Glint
 * @since 1.0.0
 */

namespace Elementor;
class glint_coninfo_box_widget extends Widget_Base {

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
		return 'glint-cinfoo-widget';
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
		return esc_html__( 'Contact Info Section', 'glint-extra' );
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
				'label' => esc_html__( 'Contact info Box', 'glint-extra' ),
				'tab'   => Controls_Manager::TAB_CONTENT,
			]
		);
		
		$this->add_control( 'cItems', [
			'label'       => esc_html__( 'Box Item', 'glint-extra' ),
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
					'name'        => 'info',
					'label'       => esc_html__( 'Info', 'glint-extra' ),
					'type'        => Controls_Manager::TEXTAREA,
					'description' => esc_html__( 'Enter Info address', 'glint-extra' )
				],

				
				[
					'name'        => 'icon',
					'label'       => esc_html__( 'Contact Icon', 'glint-extra' ),
					'type'        => Controls_Manager::ICON,
					'default' => 'fas fa-smile',
					'description' => esc_html__( 'Upload Icon', 'glint-extra' )
				],
			
				

			],
			'title_field' => "{{name}}"
		] );
		
		$this->end_controls_section();
				
						
		
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
		$cItems = $settings['cItems'];
	
		
		?>	
			

	<div class="contact-page-area">
        <div class="container">

			
	<div class="row justify-content-center">
	
	<?php
		foreach ( $cItems as $item ):
	?>
				
				
	
	<div class="col-lg-4 text-center">
		<div class="contact__card">
			<div class="contact__card__icon">
				<i class="far <?php echo esc_attr( $item['icon'] ); ?>"></i>
			</div>
			<h4><?php echo esc_html( $item['title'] ); ?></h4>
			<ul>
				<li><a href="#"><?php echo esc_html( $item[ 'info' ] ); ?></a></li>
			</ul>
		</div>
	</div>

	<?php endforeach; ?>
	
	
	</div>	

	</div>	
	
	<img src="<?php echo GLINT_EXTRA_IMG; ?>/bg/service-bg.svg" alt="" class="inner-shape1">
	<img src="<?php echo GLINT_EXTRA_IMG; ?>/bg/inner-bg1.svg" alt="" class="inner-shape2">
				
</div>		
				

		<?php
	}
}

Plugin::instance()->widgets_manager->register( new glint_coninfo_box_widget() );