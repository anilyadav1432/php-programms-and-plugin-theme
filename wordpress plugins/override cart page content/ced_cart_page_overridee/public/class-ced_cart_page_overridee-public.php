<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       cedcoss
 * @since      1.0.0
 *
 * @package    Ced_cart_page_overridee
 * @subpackage Ced_cart_page_overridee/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Ced_cart_page_overridee
 * @subpackage Ced_cart_page_overridee/public
 * @author     cedcommerce <cedcoss@gmail.com>
 */
class Ced_cart_page_overridee_Public {

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ced_cart_page_overridee_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_cart_page_overridee_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ced_cart_page_overridee-public.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Ced_cart_page_overridee_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_cart_page_overridee_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ced_cart_page_overridee-public.js', array( 'jquery' ), $this->version, false );

	}

	function ced_template_cart_override($template){
		// echo "hii";die;
		if ('cart.php' === basename($template)) {
			$template = PLUGIN_DIRPATH . 'woocommerce/cart/cart.php';
		}
		return $template;
	}

	function ced_template_cart_total_override($template){
		// echo "hii";die;
		if ('cart-totals.php' === basename($template)) {
			$template = PLUGIN_DIRPATH . 'woocommerce/cart/cart-totals.php';
		}
		return $template;
	}

	function ced_template_cart_total_shipping_override($template){
		if ('cart-shipping.php' === basename($template)) {
			$template = PLUGIN_DIRPATH . 'woocommerce/cart/cart-shipping.php';
		}
		return $template;
	}

}
