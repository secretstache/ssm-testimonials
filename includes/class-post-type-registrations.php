<?php
/**
 * SSM Testimonials
 *
 * @package   SSM_Testimonials
 * @license   GPL-2.0+
 */

/**
 * Register post types and taxonomies.
 *
 * @package SSM_Testimonials
 */
class SSM_Testimonials_Registrations {

	public $post_type = 'testimonial';

	public $taxonomies = array( 'testimonial-category' );

	public function init() {
		// Add the SSM Testimonials and taxonomies
		add_action( 'init', array( $this, 'register' ) );
	}

	/**
	 * Initiate registrations of post type and taxonomies.
	 *
	 * @uses SSM_Testimonials_Registrations::register_post_type()
	 * @uses SSM_Testimonials_Registrations::register_taxonomy_category()
	 */
	public function register() {
		$this->register_post_type();
		$this->register_taxonomy_category();
	}

	/**
	 * Register the custom post type.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_post_type
	 */
	protected function register_post_type() {
		$labels = array(
			'name'               => __( 'Testimonials', 'ssm-testimonials' ),
			'singular_name'      => __( 'Testimonial', 'ssm-testimonials' ),
			'add_new'            => __( 'Add Testimonial', 'ssm-testimonials' ),
			'add_new_item'       => __( 'Add Testimonial', 'ssm-testimonials' ),
			'edit_item'          => __( 'Edit Testimonial', 'ssm-testimonials' ),
			'new_item'           => __( 'New Testimonial', 'ssm-testimonials' ),
			'view_item'          => __( 'View Testimonial', 'ssm-testimonials' ),
			'search_items'       => __( 'Search Testimonials', 'ssm-testimonials' ),
			'not_found'          => __( 'No testimonials found', 'ssm-testimonials' ),
			'not_found_in_trash' => __( 'No testimonials in the trash', 'ssm-testimonials' ),
		);

		$supports = array(
			'title',
			'editor',
		);

		$args = array(
			'labels'          		=> $labels,
			'supports'        		=> $supports,
			'public'          		=> false,
			'capability_type' 		=> 'page',
			'publicly_queriable'	=> true,
			'show_ui' 						=> true,
			'show_in_nav_menus' 	=> false,
			'rewrite'         		=> false,
			'menu_position'   		=> 30,
			'menu_icon'       		=> 'dashicons-format-quote',
			'has_archive'					=> false,
			'exclude_from_search'	=> true,
		);

		$args = apply_filters( 'ssm_testimonials_args', $args );

		register_post_type( $this->post_type, $args );
	}

	/**
	 * Register a taxonomy for Project Categories.
	 *
	 * @link http://codex.wordpress.org/Function_Reference/register_taxonomy
	 */
	protected function register_taxonomy_category() {
		$labels = array(
			'name'                       => __( 'Testimonial Categories', 'ssm-testimonials' ),
			'singular_name'              => __( 'Testimonial Category', 'ssm-testimonials' ),
			'menu_name'                  => __( 'Categories', 'ssm-testimonials' ),
			'edit_item'                  => __( 'Edit Testimonial Category', 'ssm-testimonials' ),
			'update_item'                => __( 'Update Testimonial Category', 'ssm-testimonials' ),
			'add_new_item'               => __( 'Add New Testimonial Category', 'ssm-testimonials' ),
			'new_item_name'              => __( 'New Testimonial Category Name', 'ssm-testimonials' ),
			'parent_item'                => __( 'Parent Testimonial Category', 'ssm-testimonials' ),
			'parent_item_colon'          => __( 'Parent Testimonial Category:', 'ssm-testimonials' ),
			'all_items'                  => __( 'All Testimonial Categories', 'ssm-testimonials' ),
			'search_items'               => __( 'Search Testimonial Categories', 'ssm-testimonials' ),
			'popular_items'              => __( 'Popular Testimonial Categories', 'ssm-testimonials' ),
			'separate_items_with_commas' => __( 'Separate testimonial categories with commas', 'ssm-testimonials' ),
			'add_or_remove_items'        => __( 'Add or remove testimonial categories', 'ssm-testimonials' ),
			'choose_from_most_used'      => __( 'Choose from the most used testimonial categories', 'ssm-testimonials' ),
			'not_found'                  => __( 'No testimonial categories found.', 'ssm-testimonials' ),
		);

		$args = array(
			'labels'            => $labels,
			'public'            => true,
			'show_in_nav_menus' => true,
			'show_ui'           => true,
			'show_tagcloud'     => true,
			'hierarchical'      => true,
			'rewrite'           => array( 'slug' => 'testimonial-category' ),
			'show_admin_column' => true,
			'query_var'         => true,
		);

		$args = apply_filters( 'ssm_testimonials_category_args', $args );

		register_taxonomy( $this->taxonomies[0], $this->post_type, $args );
	}
}