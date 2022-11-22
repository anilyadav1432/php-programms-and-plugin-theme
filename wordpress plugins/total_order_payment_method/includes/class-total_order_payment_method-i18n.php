<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       cedcommerce.com
 * @since      1.0.0
 *
 * @package    Total_order_payment_method
 * @subpackage Total_order_payment_method/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Total_order_payment_method
 * @subpackage Total_order_payment_method/includes
 * @author     cedcommerce <plugins@cedcommerce.com>
 */
class Total_order_payment_method_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'total_order_payment_method',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
