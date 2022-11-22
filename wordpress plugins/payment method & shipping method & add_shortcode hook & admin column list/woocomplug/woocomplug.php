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
 * @package           Woocomplug
 *
 * @wordpress-plugin
 * Plugin Name:       woocomplug
 * Plugin URI:        woocomplug
 * Description:       This is a short description of what the plugin does. It's displayed in the WordPress admin area.
 * Version:           1.0.0
 * Author:            cedcoss
 * Author URI:        cedcommerce.com
 * License:           GPL-2.0+
 * License URI:       http://www.gnu.org/licenses/gpl-2.0.txt
 * Text Domain:       woocomplug
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
define( 'WOOCOMPLUG_VERSION', '1.0.0' );

/**
 * The code that runs during plugin activation.
 * This action is documented in includes/class-woocomplug-activator.php
 */
function activate_woocomplug() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocomplug-activator.php';

	

	Woocomplug_Activator::activate();

}

/**

 * The code that runs during plugin deactivation.
 * This action is documented in includes/class-woocomplug-deactivator.php
 */
function deactivate_woocomplug() {
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-woocomplug-deactivator.php';
	Woocomplug_Deactivator::deactivate();
}




register_activation_hook( __FILE__, 'activate_woocomplug' );
register_deactivation_hook( __FILE__, 'deactivate_woocomplug' );

// for checking plugin activated or not
// register_activation_hook(__FILE__, 'my_plugin_init');


/**
 * The core plugin class that is used to define internationalization,
 * admin-specific hooks, and public-facing site hooks.
 */
require plugin_dir_path( __FILE__ ) . 'includes/class-woocomplug.php';

/**
 * Begins execution of the plugin.
 *
 * Since everything within the plugin is registered via hooks,
 * then kicking off the plugin from this point in the file does
 * not affect the page life cycle.
 *
 * @since    1.0.0
 */
function run_woocomplug() {

	$plugin = new Woocomplug();
	$plugin->run();

}
 

//plugin activation checking bellow*******************

add_action('init','my_plugin_init');

function my_plugin_init() {
	if ( class_exists( 'WooCommerce' ) ) 
	{ 
		run_woocomplug();
		// die(" activated");
		return true; 
	} 
	else 
	{ 
		add_action( 'admin_notices', 'independence_notice' );
		deactivate_plugins(plugin_basename(__FILE__));
		// die("not activated");
		// return false; 
	}

}

function independence_notice() { 
	?>
	<div class="notice notice-error is-dismissible">
		<p>Activate First "WooCommerce plugin" </p>
	</div>
	<?php
}







