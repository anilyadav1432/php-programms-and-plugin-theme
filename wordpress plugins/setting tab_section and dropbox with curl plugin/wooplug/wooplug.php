<?php

/**
 * The plugin bootstrap file
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              wooplug
 * @since             1.0.0
 * @package           Wooplug
 *
 * @wordpress-plugin
 * Plugin Name:       wooplug
 * Plugin URI:        wooplug.com
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            cedcoss
 * Author URI:        wooplug
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       wooplug
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
define( 'WOOPLUG_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-wooplug-activator.php
 */
function activate_wooplug() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wooplug-activator.php';
	Wooplug_Activator::activate();
}

/**
 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-wooplug-deactivator.php
 */
function deactivate_wooplug() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-wooplug-deactivator.php';
	Wooplug_Deactivator::deactivate();
}
/**
 * The code that run during plugin delete
 */

register_activation_hook( __FILE__, 'activate_wooplug' );
register_deactivation_hook( __FILE__, 'deactivate_wooplug' );

/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-wooplug.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_wooplug() {

	$plugin = new Wooplug();
	$plugin->run();

}

/**
 * Checkes if WooCommerce id active
 */
if ( in_array( 'woocommerce/woocommerce.php', apply_filters( 'active_plugins', get_option( 'active_plugins' ) ) ) ) {
	
run_wooplug();

}else {	
	/**
	 * To show error notice if woocommerce is not activated.
	 * @name wooplug_plugin_error_notice
	 * @author CedCommerce <plugins@cedcommerce.com>
	 * @link http://cedcommerce.com/
	 */
	function wooplug_plugin_error_notice() {
		?>
		<div class="error notice is-dismissible">
			<p><?php _e( 'WooCommerce is not activated. Please install WooCommerce first, to use the wooplug plugin !!!', '' ); ?></p>
		</div>
		<?php
	}

	add_action( 'admin_init', 'wooplug_plugin_deactivate' );
	/**
	 * Deactivating plugins
	 * @name wooplug_plugin_deactivate
	 * @author CedCommerce <plugins@cedcommerce.com>
	 * @link http://cedcommerce.com/
	 */
	function wooplug_plugin_deactivate() {
		deactivate_plugins( plugin_basename( __FILE__ ) );
		add_action( 'admin_notices', 'wooplug_plugin_error_notice' );
	}
}
