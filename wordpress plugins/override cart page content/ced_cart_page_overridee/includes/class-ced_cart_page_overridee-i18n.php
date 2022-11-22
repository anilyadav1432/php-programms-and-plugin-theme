<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       cedcoss
 * @since      1.0.0
 *
 * @package    Ced_cart_page_overridee
 * @subpackage Ced_cart_page_overridee/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ced_cart_page_overridee
 * @subpackage Ced_cart_page_overridee/includes
 * @author     cedcommerce <cedcoss@gmail.com>
 */
class Ced_cart_page_overridee_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ced_cart_page_overridee',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
