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
 * @package    Ced_simple_json_impoter
 * @subpackage Ced_simple_json_impoter/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ced_simple_json_impoter
 * @subpackage Ced_simple_json_impoter/includes
 * @author     cedcommerce <cedcoss@gmail.com>
 */
class Ced_simple_json_impoter_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ced_simple_json_impoter',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
