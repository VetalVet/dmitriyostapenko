<?php

add_action( 'widgets_init', 'glint_latest_post' );

function glint_latest_post() {
	register_widget( 'Glint_Latest_Post');
}

class Glint_Latest_Post extends WP_Widget {

	private $defaults = array();

	function __construct(){

		$this->defaults = array(
			'title' => esc_html__('Latest Post', 'glint-extra'),
			'number' => 5,
		);
		parent::__construct( 'widget_latest_posts_tab', esc_html__('Glint Latest Posts','glint-extra'),
		array( 
			'description' => __( 'Widget for Latest Post', 'glint-extra' ), 
			'classname' => 'post-widget',
		  ) 
		 );
	}

   /*----------------------------------------
	  update()
	  ----------------------------------------
	
	* Function to update the settings from
	* the form() function.
	
	* Params:
	* - Array $new_instance
	* - Array $old_instance
	----------------------------------------*/
	
	function update ( $new_instance, $old_instance ) {		
		$defaults           = $this->defaults;
		$instance           = $old_instance;		
		$instance['title']  = esc_attr( $new_instance['title'] );
		$instance['number'] = intval( $new_instance['number'] );

		return $instance;
		
	} // End update()

   /*----------------------------------------
	 form()
	 ----------------------------------------
	  
	  * The form on the widget control in the
	  * widget administration area.
	  
	  * Make use of the get_field_id() and 
	  * get_field_name() function when creating
	  * your form elements. This handles the confusing stuff.
	  
	  * Params:
	  * - Array $instance
	----------------------------------------*/

   function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->defaults );
		$title = isset( $instance['title'] ) ? esc_attr($instance['title']) : '';
		?>
		<p>
			<label for="<?php echo esc_attr($this->get_field_id('title')); ?>"><?php esc_html_e('Title:', 'glint-extra'); ?></label>
			<input type="text" name="<?php echo esc_attr($this->get_field_name('title')); ?>"  value="<?php echo esc_attr($title); ?>" class="widefat" id="<?php echo esc_attr($this->get_field_id('title')); ?>" />
		</p>
		<p>
		   <label for="<?php print esc_attr($this->get_field_id( 'number' )); ?>"><?php esc_html_e('Number of posts:', 'glint-extra'); ?>
		   <input class="widefat" id="<?php print esc_attr($this->get_field_id( 'number' )); ?>" name="<?php print esc_attr($this->get_field_name( 'number' )); ?>" type="text" value="<?php echo isset( $instance['number'] ) ? esc_attr($instance['number']) : ''; ?>" />
		   </label>
		</p>


		<?php

	} // End form()


	function widget($args, $instance) {

		$per_row = '';
		$first_full = '';
		$meta_on_thumb = '';

		$instance = wp_parse_args( (array) $instance, $this->defaults );

		extract( $args );
	
		$number = isset( $instance['number'] ) ? $instance['number'] : 5;

		$title = $instance['title'];

		print wp_kses_post($before_widget);
		/* If a title was input by the user, display it. */
		if ( !empty( $title ) ){ 
			print wp_kses_post($before_title . apply_filters( 'widget_title', $title, $instance, $this->id_base ) . $after_title);
		}
		$this->glint_all_latest_posts($number,$per_row,$first_full,$meta_on_thumb);
		print wp_kses_post($after_widget);
	}


	function glint_all_latest_posts($number = 5,$per_row = 1,$first_full = null,$meta_on_thumb = null) {

		$query_args = array(
			'posts_per_page'      => $number,
			'no_found_rows'       => true,
			'post_status'         => 'publish',
			'ignore_sticky_posts' => true
		);



		$sds_r = new WP_Query( $query_args );
		?>
		<div class="widget popular-post">
		
			<?php
			$sds_r_i = 0;
			$first_gone = false;
			if ($sds_r->have_posts()):
				while ( $sds_r->have_posts() ) : $sds_r->the_post();
				?>
				
				<?php 
					$featured_img_url = get_the_post_thumbnail_url(get_the_ID(),'thumbnail');
				?>
					<div class="single-blog-post">
						<?php if( $featured_img_url ) : ?>
							<a class="widget__post__tumbs" href="<?php esc_url(the_permalink()); ?>"><img src="<?php echo esc_url($featured_img_url); ?>" alt=""></a>						
						<?php endif; ?>
						<a href="<?php esc_url(the_permalink()); ?>"><?php the_title(); ?></a>
					</div>
				<?php

				endwhile;
			endif;
			wp_reset_postdata();
		?>
		</div>
	<?php
	}
}