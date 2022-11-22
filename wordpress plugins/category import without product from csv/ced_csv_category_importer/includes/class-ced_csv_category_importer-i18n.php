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
 * @package    Ced_csv_category_importer
 * @subpackage Ced_csv_category_importer/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Ced_csv_category_importer
 * @subpackage Ced_csv_category_importer/includes
 * @author     cedcommerce <cedcoss@gmail.com>
 */
class Ced_csv_category_importer_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'ced_csv_category_importer',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
