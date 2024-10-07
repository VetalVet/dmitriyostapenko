<?php
/**
 * Functions which enhance the theme by hooking into WordPress
 *
 * @package Glint
 */

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 * @return array
 */

if(!class_exists('Glint_Functions')){
	class Glint_Functions{
		private static $instance;

		public function __construct() {
			add_filter( 'body_class', array($this,'body_classes') );
			add_action( 'wp_head', array($this,'pingback_header') );
		}

		/**
		 * get instance
		 * @since 1.0.0
		 * */
		public static function getInstance(){
			if (null ==  self::$instance){
				self::$instance = new self();
			}
			return self::$instance;
		}

		/**
		 * banting_body_classes
		 * @since 1.0.0
		 * */
		public function body_classes($classes){
			// Adds a class of hfeed to non-singular pages.
			if ( ! is_singular() ) {
				$classes[] = 'hfeed';
			}

			// Adds a class of no-sidebar when there is no sidebar present.
			if ( ! is_active_sidebar( 'sidebar-1' ) ) {
				$classes[] = 'no-sidebar';
			}

			return $classes;
		}

		/**
		 * pingback_header
		 * @since 1.0.0
		 * */
		public function pingback_header(){
			if ( is_singular() && pings_open() ) {
				printf( '<link rel="pingback" href="%s">', esc_url( get_bloginfo( 'pingback_url' ) ) );
			}
		}
		
		
		/*
         * Pages Links
         *
         * @since 1.0.0
          */
        public static function link_pages(){
            $defaults = array(
                'before' => '<div class="wp-link-pages"><span>'.esc_html__('Pages:' ,'glint').'</span>',
                'after' => '</div>',
                'link_before' => '',
                'link_after' => '',
                'next_or_number' => 'number',
                'separator' => ' ',
                'pagelink' => '%',
                'echo' => 1
            );
            wp_link_pages($defaults);
        }
		
		/*
         * Pagination
         *
         * @since 1.0.0
          */
        public function post_pagination( $nav_query = NULL ){
            if ( function_exists('wp_pagenavi') ){
                wp_pagenavi();
            }else{
                $older_post = esc_html__('Prev','glint');
                $newer_post = esc_html__('Next','glint');
                global $wp_query;
                $big = 999999999;
                $current =  max(1,get_query_var('paged'));
                $total = ($nav_query != NULL) ? $nav_query->max_num_pages : $wp_query->max_num_pages;
                if ( $wp_query->max_num_pages == '1' ){}else{echo '';}
                echo paginate_links(
                    array(
                        'base' => str_replace($big,'%#%',get_pagenum_link($big)),
                        'format' => '?paged=%#%',
                        'prev_text' => '<i class="fa fa-long-arrow-left"></i>',
                        'next_text' => '<i class="fa fa-long-arrow-right"></i>',
                        'current' => $current,
                        'total' => $total,
                        'type' => 'list'
                    )
                );
                if ( $wp_query->max_num_pages == '1' ){}else{echo '';}
            }
        }
		
		
		/*
         * kses allowed html
         * @since 1.0.0
         * */
        public function kses_allowed_html( $allowed_tags = 'all' ) {
            $allowed_html = array(
                'div'    => array( 'class' => array(), 'id' => array() ),
                'header' => array( 'class' => array(), 'id' => array() ),
                'h1'     => array( 'class' => array(), 'id' => array() ),
                'h2'     => array( 'class' => array(), 'id' => array() ),
                'h3'     => array( 'class' => array(), 'id' => array() ),
                'h4'     => array( 'class' => array(), 'id' => array() ),
                'h5'     => array( 'class' => array(), 'id' => array() ),
                'h6'     => array( 'class' => array(), 'id' => array() ),
                'p'      => array( 'class' => array(), 'id' => array() ),
                'span'   => array( 'class' => array(), 'id' => array() ),
                'i'      => array( 'class' => array(), 'id' => array() ),
                'mark'   => array( 'class' => array(), 'id' => array() ),
                'strong' => array( 'class' => array(), 'id' => array() ),
                'br'     => array( 'class' => array(), 'id' => array() ),
                'b'      => array( 'class' => array(), 'id' => array() ),
                'em'     => array( 'class' => array(), 'id' => array() ),
                'del'    => array( 'class' => array(), 'id' => array() ),
                'ins'    => array( 'class' => array(), 'id' => array() ),
                'u'      => array( 'class' => array(), 'id' => array() ),
                's'      => array( 'class' => array(), 'id' => array() ),
                'nav'    => array( 'class' => array(), 'id' => array() ),
                'ul'     => array( 'class' => array(), 'id' => array() ),
                'li'     => array( 'class' => array(), 'id' => array() ),
                'form'   => array( 'class' => array(), 'id' => array() ),
                'select' => array( 'class' => array(), 'id' => array() ),
                'option' => array( 'class' => array(), 'id' => array() ),
                'img'    => array( 'class' => array(), 'id' => array() ),
                'a'      => array( 'class' => array(), 'id' => array(), 'href' => array()),
            );

            if ( 'all' == $allowed_tags ) {
                return $allowed_html;
            } else {
                if ( is_array( $allowed_tags ) && ! empty( $allowed_tags ) ) {
                    $specific_tags = array();
                    foreach ( $allowed_tags as $allowed_tag ) {
                        if ( array_key_exists( $allowed_tag, $allowed_html ) ) {
                            $specific_tags[ $allowed_tag ] = $allowed_html[ $allowed_tag ];
                        }
                    }
                    return $specific_tags;
                }
            }

        } //end kses_allowed_html
		
		
	   /*
       * meta query
       * @since 1.0.0
       * */
       public function meta_query( $prefix, $id ){
          global $post;
          $meta = '';
          if ( !empty( $post->ID ) ){
              $meta = get_post_meta( $post->ID, $prefix, true );
              $meta = ( isset($meta[$id]) && !empty( $meta[$id] )) ? $meta[$id] : '';
              }
          return $meta;

       }	
		
	public function page_layout(){
			
        global $post;
        $sidebar_status = is_active_sidebar('sidebar-1') ? true : false;
		
        $return_var['content_column_class'] = $sidebar_status ? 'col-lg-8' :'col-lg-12';
        $return_var['sidebar_column_class']='';
        $return_var['glint_sidebar_activity']='';

        if ( is_home() && !empty( cs_get_option('glint_blog_layout')  ) ){

          $return_var['sidebar_column_class'] = ('left-sidebar' == cs_get_option('glint_blog_layout') ) ? 'order-first left-blogg' : '';
          //if left-sidebar select change the order of column
          $return_var['content_column_class'] = ('default' == cs_get_option('glint_blog_layout') ) ? 'col-lg-12' : $return_var['content_column_class'];
          $return_var['glint_sidebar_activity']= cs_get_option('glint_blog_layout');
        } //endif

        
        if ( is_single() && !empty( cs_get_option('glint_single_page_layout')  ) ){

          $return_var['sidebar_column_class'] = ('left-sidebar' == cs_get_option('glint_single_page_layout') ) ? 'order-first left-blogg' : '';
          //if left-sidebar select change the order of column
          $return_var['content_column_class'] = ('default' == cs_get_option('glint_single_page_layout') ) ? 'col-lg-12' : $return_var['content_column_class'];
          $return_var['glint_sidebar_activity']= cs_get_option('glint_single_page_layout');
        } //endif

        if ( is_archive() && !empty( cs_get_option('glint_archive_layout')  ) ){

          $return_var['sidebar_column_class'] = ('left-sidebar' == cs_get_option('glint_archive_layout') ) ? 'order-first left-blogg' : '';
          //if left-sidebar select change the order of column
          $return_var['content_column_class'] = ('default' == cs_get_option('glint_archive_layout') ) ? 'col-lg-12' : $return_var['content_column_class'];
          $return_var['glint_sidebar_activity']= cs_get_option('glint_archive_layout');

        } //

          if ( is_search() && !empty( cs_get_option('glint_search_layout')  ) ){

          $return_var['sidebar_column_class'] = ('left-sidebar' == cs_get_option('glint_search_layout') ) ? 'order-first left-blogg' : '';
          //if left-sidebar select change the order of column
          $return_var['content_column_class'] = ('default' == cs_get_option('glint_search_layout') ) ? 'col-lg-12' : $return_var['content_column_class'];
           $return_var['glint_sidebar_activity']= cs_get_option('glint_search_layout');
         } //
		 


        return $return_var; 
       }
	   

	}//end class

}
