<?php

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


/**
 * Portfolio: Custom Post Types
 *
 *
 */
class glint_portfolio_Post_Types {
	
	public function __construct()
	{
		$this->register_post_type();
	}

	public function register_post_type()
	{
		$args = array();	

		// Portfolio
		$args['post-type-portfolio'] = array(
			'labels' => array(
				'name' => __( 'Portfolios', 'growthcore' ),
				'singular_name' => __( 'Item', 'growthcore' ),
				'add_new' => __( 'Add Portfolio', 'growthcore' ),
				'add_new_item' => __( 'Add Portfolio', 'growthcore' ),
				'edit_item' => __( 'Edit Portfolio', 'growthcore' ),
				'new_item' => __( 'New Portfolio', 'growthcore' ),
				'view_item' => __( 'View Portfolio', 'growthcore' ),
				'search_items' => __( 'Search Through portfolio', 'growthcore' ),
				'not_found' => __( 'No Portfolio found', 'growthcore' ),
				'not_found_in_trash' => __( 'No Portfolio found in Trash', 'growthcore' ),
				'parent_item_colon' => __( 'Parent Portfolio:', 'growthcore' ),
				'menu_name' => __( 'Portfolio', 'growthcore' ),				
			),		  
			'hierarchical' => false,
	        'description' => __( 'Add a Portfolio Item', 'growthcore' ),
	        'supports' => array( 'title', 'editor', 'thumbnail', 'excerpt'),
	        'menu_icon' =>  'dashicons-images-alt',
	        'public' => true,
	        'publicly_queryable' => true,
	        'exclude_from_search' => true,
	        'query_var' => true,
	        'rewrite' => array( 'slug' => 'portfolio' ),
	        // This is where we add taxonomies to our CPT
        	//'taxonomies'          => array( 'category' ),
		);	

		// Register post type: name, arguments
		register_post_type('portfolio', $args['post-type-portfolio']);
	}
}

function glint_portfolio_types() { new glint_portfolio_Post_Types(); }

add_action( 'init', 'glint_portfolio_types' );

/*-----------------------------------------------------------------------------------*/
/*	Creating Custom Taxonomy 
/*-----------------------------------------------------------------------------------*/
// hook into the init action and call create_book_taxonomies when it fires
add_action( 'init', 'growthcore_create_portfolio_taxonomies', 0 );

// create two taxonomies, genres and writers for the post type "book"
function growthcore_create_portfolio_taxonomies() {
	// Add new taxonomy, make it hierarchical (like categories)
	$labels = array(
		'name'              => _x( 'Categories', 'taxonomy general name', 'growthcore' ),
		'singular_name'     => _x( 'Category', 'taxonomy singular name', 'growthcore' ),
		'search_items'      => __( 'Search Categories', 'growthcore' ),
		'all_items'         => __( 'Categories', 'growthcore' ),
		'parent_item'       => __( 'Parent Category', 'growthcore' ),
		'parent_item_colon' => __( 'Parent Category:', 'growthcore' ),
		'edit_item'         => __( 'Edit Category', 'growthcore' ),
		'update_item'       => __( 'Update Category', 'growthcore' ),
		'add_new_item'      => __( 'Add New Category', 'growthcore' ),
		'new_item_name'     => __( 'New Category', 'growthcore' ),
		'menu_name'         => __( 'Categories', 'growthcore' ),
	);

	$args = array(
		'hierarchical'      => true,
		'labels'            => $labels,
		'show_ui'           => true,
		'show_admin_column' => true,
		'query_var'         => true,
		'rewrite'           => array( 'slug' => 'portfoliocategory' ),
	);

	register_taxonomy( 'portfoliocats', array( 'portfolio' ), $args );
}