<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       cedcommerce.com
 * @since      1.0.0
 *
 * @package    Total_order_payment_method
 * @subpackage Total_order_payment_method/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Total_order_payment_method
 * @subpackage Total_order_payment_method/admin
 * @author     cedcommerce <plugins@cedcommerce.com>
 */
class Total_order_payment_method_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Total_order_payment_method_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Total_order_payment_method_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/total_order_payment_method-admin.css', array(), $this->version, 'all' );

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/**
		 * This function is provided for demonstration purposes only.
		 *
		 * An instance of this class should be passed to the run() function
		 * defined in Total_order_payment_method_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Total_order_payment_method_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/total_order_payment_method-admin.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Register Menu page for Total Payment Method List
	 *
	 * @since    1.0.0
	 */
	function ced_total_order_payment_method_menu(){
		add_menu_page( 'Ordered Payment Methods ', 'Ordered Payment Methods List', 'manage_options', 'ordered_payment_method_list', array($this,'ced_ordered_payment_method_list'),'',20);
	}
	/**
	 * include page for listing Total Ordered payment method list
	 *
	 * @since    1.0.0
	 */
	public function ced_ordered_payment_method_list(){
		include_once dirname( __FILE__ ) . '/partials/ced_all_ordered_payment_methods.php';
	}
}
