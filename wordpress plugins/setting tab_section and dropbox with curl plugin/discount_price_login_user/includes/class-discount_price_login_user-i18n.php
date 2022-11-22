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
 * @package    Discount_price_login_user
 * @subpackage Discount_price_login_user/includes
 */

/**
 * Define the internationalization functionality.
 *
 * Loads and defines the internationalization files for this plugin
 * so that it is ready for translation.
 *
 * @since      1.0.0
 * @package    Discount_price_login_user
 * @subpackage Discount_price_login_user/includes
 * @author     cedcommerce <cedcoss@gmail.com>
 */
class Discount_price_login_user_i18n {


	/**
	 * Load the plugin text domain for translation.
	 *
	 * @since    1.0.0
	 */
	public function load_plugin_textdomain() {

		load_plugin_textdomain(
			'discount_price_login_user',
			false,
			dirname( dirname( plugin_basename( __FILE__ ) ) ) . '/languages/'
		);

	}



}
