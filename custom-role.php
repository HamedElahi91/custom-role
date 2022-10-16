<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://egeekbin.com
 * @since             1.0.0
 * @package           Custom_Role
 *
 * @wordpress-plugin
 * Plugin Name:       custom-role
 * Plugin URI:        https://egeekbin.com
 * Description:       This Plugin prepare a custom role for WooCommerce and your customers as loyal customers and bulk customers
 * Version:           1.0.0
 * Author:            Hamed Elahi
 * Author URI:        https://egeekbin.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       custom-role
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * Currently plugin version.
 * Start at version 1.0.0 and use SemVer - https://semver.org
 * Rename this for your plugin and update it as you release new versions.
 */
define( 'CUSTOM_ROLE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-custom-role-activator.php
 */
function activate_custom_role() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-role-activator.php';
	Custom_Role_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-custom-role-deactivator.php
 */
function deactivate_custom_role() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-custom-role-deactivator.php';
	Custom_Role_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_custom_role' );
register_deactivation_hook( __FILE__, 'deactivate_custom_role' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-custom-role.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_custom_role() {

	$plugin = new Custom_Role();
	$plugin->run();

}
run_custom_role();
