<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       ced_json_product_importer
 * @since      1.0.0
 *
 * @package    Ced_json_product_importer
 * @subpackage Ced_json_product_importer/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ced_json_product_importer
 * @subpackage Ced_json_product_importer/includes
 * @author     cedcoss <cedcoss@gmail.com>
 */
class Ced_json_product_importer_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ced_json_product_importer',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
