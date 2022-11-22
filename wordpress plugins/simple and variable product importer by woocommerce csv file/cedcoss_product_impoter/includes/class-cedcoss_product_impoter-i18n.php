<?php

/**
 * Define the internationalization functionality
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @link       cedcoss_product_impoter
 * @since      1.0.0
 *
 * @package    Cedcoss_product_impoter
 * @subpackage Cedcoss_product_impoter/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Cedcoss_product_impoter
 * @subpackage Cedcoss_product_impoter/includes
 * @author     cedcoss <cedcoss@gmail.com>
 */
class Cedcoss_product_impoter_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'cedcoss_product_impoter',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
