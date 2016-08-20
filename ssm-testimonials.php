<?php
/**
 * SSM Testimonials
 *
 * @package   SSM_Testimonials
 * @license   GPL-2.0+
 *
 * @wordpress-plugin
 * Plugin Name: SSM Testimonials
 * Plugin URI:  http://secretstache.com
 * Description: Enables a Testimonial Custom Post Type.
 * Version:     0.1.3
 * Author:      Secret Stache Media
 * Author URI:  http://secretstache.com
 * Text Domain: ssm-testimonials
 * License:     GPL-2.0+
 * License URI: http://www.gnu.org/licenses/gpl-2.0.txt
 * Domain Path: /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// Required files for registering the post type and taxonomies.
require plugin_dir_path( __FILE__ ) . 'includes/class-post-type.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-post-type-registrations.php';
require plugin_dir_path( __FILE__ ) . 'includes/class-post-type-metaboxes.php';

// Instantiate registration class, so we can add it as a dependency to main plugin class.
$post_type_registrations = new SSM_Testimonials_Registrations;

// Instantiate main plugin file, so activation callback does not need to be static.
$post_type = new SSM_Testimonials( $post_type_registrations );

// Register callback that is fired when the plugin is activated.
register_activation_hook( __FILE__, array( $post_type, 'activate' ) );

// Initialize registrations for post-activation requests.
$post_type_registrations->init();

// Initialize metaboxes
// $post_type_metaboxes = new SSM_Testimonials_Metaboxes;
// $post_type_metaboxes->init();


/**
 * Adds styling to the dashboard for the post type and adds Project posts
 * to the "At a Glance" metabox.
 */
if ( is_admin() ) {

	// Loads for users viewing the WordPress dashboard
	if ( ! class_exists( 'Dashboard_Glancer' ) ) {
		require plugin_dir_path( __FILE__ ) . 'includes/class-dashboard-glancer.php';  // WP 3.8
	}

	require plugin_dir_path( __FILE__ ) . 'includes/class-post-type-admin.php';

	$post_type_admin = new SSM_Testimonials_Admin( $post_type_registrations );
	$post_type_admin->init();

}

require plugin_dir_path( __FILE__ ) . 'includes/plugin_update_check.php';

$MyUpdateChecker = new PluginUpdateChecker_2_0 (
    'https://kernl.us/api/v1/updates/57a155031d2583841187809d/',
    __FILE__,
    'ssm-testimonials',
    1
);
// $MyUpdateChecker->purchaseCode = "somePurchaseCode";  <---- Optional!