<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              cedcommerce.com
 * @since             1.0.0
 * @package           Total_order_payment_method
 *
 * @wordpress-plugin
 * Plugin Name:       Total Order Payment Method
 * Plugin URI:        cedcommerce.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            cedcommerce
 * Author URI:        cedcommerce.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       total_order_payment_method
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
define( 'TOTAL_ORDER_PAYMENT_METHOD_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-total_order_payment_method-activator.php
 */
function activate_total_order_payment_method() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-total_order_payment_method-activator.php';
	Total_order_payment_method_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-total_order_payment_method-deactivator.php
 */
function deactivate_total_order_payment_method() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-total_order_payment_method-deactivator.php';
	Total_order_payment_method_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_total_order_payment_method' );
register_deactivation_hook( __FILE__, 'deactivate_total_order_payment_method' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-total_order_payment_method.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_total_order_payment_method() {

	$plugin = new Total_order_payment_method();
	$plugin->run();

}
run_total_order_payment_method();
