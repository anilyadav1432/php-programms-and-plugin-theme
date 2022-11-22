<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              cedcoss
 * @since             1.0.0
 * @package           Ced_override_woocommerce
 *
 * @wordpress-plugin
 * Plugin Name:       Ced Override Woocommerce
 * Plugin URI:        ced_override_woocommerce
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            cedcommerce
 * Author URI:        cedcoss
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       ced_override_woocommerce
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
define( 'CED_OVERRIDE_WOOCOMMERCE_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-ced_override_woocommerce-activator.php
 */
function activate_ced_override_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ced_override_woocommerce-activator.php';
	Ced_override_woocommerce_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-ced_override_woocommerce-deactivator.php
 */
function deactivate_ced_override_woocommerce() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-ced_override_woocommerce-deactivator.php';
	Ced_override_woocommerce_Deactivator::deactivate();
}

register_activation_hook( __FILE__, 'activate_ced_override_woocommerce' );
register_deactivation_hook( __FILE__, 'deactivate_ced_override_woocommerce' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-ced_override_woocommerce.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_ced_override_woocommerce() {

	$plugin = new Ced_override_woocommerce();
	$plugin->run();

}

/**
 * Checkes if WooCommerce id active
 */
	if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
		run_ced_override_woocommerce();
	
	}else {	
		/**
		 * To show error notice if woocommerce is not activated.
		 * @author CedCommerce <plugins@cedcommerce.com>
		 * @link http://cedcommerce.com/
		 */
		function ced_override_message_error_notice() {
			?>
			<div class="error notice is-dismissible">
				<p><?php _e( 'WooCommerce is not activated. Please install WooCommerce first, to use the override plugin !!!', 'ced_override_woocommerce' ); ?></p>
			</div>
			<?php
		}
	
		add_action( 'admin_init', 'ced_override_plugin_deactivate' );
		/**
		 * Deactivating plugins
		 * @name ced_gift_message_deactivate
		 * @author CedCommerce <plugins@cedcommerce.com>
		 * @link http://cedcommerce.com/
		 */
		function ced_override_plugin_deactivate() {
			deactivate_plugins( plugin_basename( __FILE__ ) );
			add_action( 'admin_notices', 'ced_override_message_error_notice' );
		}
	}



//template override
add_filter( 'woocommerce_locate_template', 'intercept_wc_template', 10, 3 );
/**
 * Filter the woocommerce template path to override template files.
 *
 * @param string $template      Default template file path.
 * @param string $template_name Template file slug.
 * @param string $template_path Template file name.
 *
 * @return string The new Template file path.
 */
function intercept_wc_template( $template, $template_name, $template_path ) {

	// if ( 'cart.php' === basename( $template ) ) {
	// 	$template = trailingslashit( plugin_dir_path( __FILE__ ) ) . 'woocommerce/cart/cart.php';
	// }
	$template_directory = trailingslashit( plugin_dir_path(__FILE__))."woocommerce/";
	$path = $template_directory.$template_name;
	return file_exists( $path ) ? $path : $template;

}
