<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       ced_json_product_importer
 * @since      1.0.0
 *
 * @package    Ced_json_product_importer
 * @subpackage Ced_json_product_importer/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ced_json_product_importer
 * @subpackage Ced_json_product_importer/admin
 * @author     cedcoss <cedcoss@gmail.com>
 */
class Ced_json_product_importer_Admin {

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
		 * defined in Ced_json_product_importer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_json_product_importer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ced_json_product_importer-admin.css', array(), $this->version, 'all' );

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
		 * defined in Ced_json_product_importer_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_json_product_importer_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ced_json_product_importer-admin.js', array( 'jquery' ), $this->version, false );
		

	}

	/**
	 * admin menu page creation  for json product importor and listing
	 * @since	1.0.0
	*/
	function ced_json_product_impoter_menu(){
		add_menu_page("import json page","Json Product Import","manage_options","json_product_importer",array($this,'product_importer_func'),'',20);
	}
	/**
	 * this will be list of product from json file
	 * @since	1.0.0
	*/
	function product_importer_func(){
		include_once dirname( __FILE__ ) . '/partials/ced_product_importer_list.php';
	}

}
