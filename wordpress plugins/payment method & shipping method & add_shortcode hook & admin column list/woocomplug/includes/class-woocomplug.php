<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       cedcommerce.com
 * @since      1.0.0
 *
 * @package    Woocomplug
 * @subpackage Woocomplug/includes
 */

/**
 * The core plugin class.
 *
 * This is used to define internationalization, admin-specific hooks, and
 * public-facing site hooks.
 *
 * Also maintains the unique identifier of this plugin as well as the current
 * version of the plugin.
 *
 * @since      1.0.0
 * @package    Woocomplug
 * @subpackage Woocomplug/includes
 * @author     cedcoss <cedcommerce@gmail.com>
 */
class Woocomplug {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Woocomplug_Loader    $loader    Maintains and registers all hooks for the plugin.
	 */
	protected $loader;

	/**
	 * The unique identifier of this plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $plugin_name    The string used to uniquely identify this plugin.
	 */
	protected $plugin_name;

	/**
	 * The current version of the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      string    $version    The current version of the plugin.
	 */
	protected $version;

	/**
	 * Define the core functionality of the plugin.
	 *
	 * Set the plugin name and the plugin version that can be used throughout the plugin.
	 * Load the dependencies, define the locale, and set the hooks for the admin area and
	 * the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function __construct() {
		if ( defined( 'WOOCOMPLUG_VERSION' ) ) {
			$this->version = WOOCOMPLUG_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'woocomplug';

		$this->load_dependencies();
		$this->set_locale();
		$this->define_admin_hooks();
		$this->define_public_hooks();

	}

	/**
	 * Load the required dependencies for this plugin.
	 *
	 * Include the following files that make up the plugin:
	 *
	 * - Woocomplug_Loader. Orchestrates the hooks of the plugin.
	 * - Woocomplug_i18n. Defines internationalization functionality.
	 * - Woocomplug_Admin. Defines all hooks for the admin area.
	 * - Woocomplug_Public. Defines all hooks for the public side of the site.
	 *
	 * Create an instance of the loader which will be used to register the hooks
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function load_dependencies() {

		/**
		 * The class responsible for orchestrating the actions and filters of the
		 * core plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woocomplug-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-woocomplug-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-woocomplug-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-woocomplug-public.php';

		$this->loader = new Woocomplug_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Woocomplug_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Woocomplug_i18n();

		$this->loader->add_action( 'plugins_loaded', $plugin_i18n, 'load_plugin_textdomain' );

	}

	/**
	 * Register all of the hooks related to the admin area functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_admin_hooks() {

		$plugin_admin = new Woocomplug_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		//create custom product tab
		$this->loader->add_filter( 'woocommerce_product_data_tabs', $plugin_admin, 'create_woo_settings_tab' );
		//Add custom fields
		$this->loader->add_action("woocommerce_product_data_panels", $plugin_admin, "display_mytab_fields");
		//save the custom fields
		$this->loader->add_action("woocommerce_process_product_meta", $plugin_admin,"save_fields");
		//creating custom column in product
		$this->loader->add_filter('manage_edit-product_columns',$plugin_admin, "fun_new_columns");
		//show data in admin product column
		$this->loader->add_action('manage_product_posts_custom_column',$plugin_admin,'ced_show_post_count',10,2); 
		//Add Custom shipping method
		$this->loader->add_action( 'woocommerce_shipping_init',$plugin_admin, 'my_shipping_method' );
		$this->loader->add_filter( 'woocommerce_shipping_methods',$plugin_admin, 'add_my_shipping_method' );
		

		//Add custom payment method  code
		$this->loader->add_action('plugins_loaded',$plugin_admin, 'init_custom_gateway_class');
		$this->loader->add_filter( 'woocommerce_payment_gateways',$plugin_admin, 'add_custom_gateway_class' );
		$this->loader->add_action( 'woocommerce_checkout_update_order_meta',$plugin_admin, 'custom_payment_update_order_meta' );
		$this->loader->add_action( 'woocommerce_admin_order_data_after_billing_address',$plugin_admin, 'custom_checkout_field_display_admin_order_meta', 10, 1 );

	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Woocomplug_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
		 
        //show data in product single page
		$this->loader->add_action('woocommerce_single_product_summary',$plugin_public,'show_brand_text');
    //    die("hi");
	
		//shortcode function on pages
		$this->loader->add_shortcode( 'my_shortcode',$plugin_public, 'register_shortcodes');
		/* Change Checkout page Label Email,phone */
		$this->loader->add_filter( 'woocommerce_checkout_fields',$plugin_public , 'custom_override_checkout_fields', 9999 );

		
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.`
	 *
	 * @since    1.0.0
	 */
	public function run() {
		$this->loader->run();
	}

	/**
	 * The name of the plugin used to uniquely identify it within the context of
	 * WordPress and to define internationalization functionality.
	 *
	 * @since     1.0.0
	 * @return    string    The name of the plugin.
	 */
	public function get_plugin_name() {
		return $this->plugin_name;
	}

	/**
	 * The reference to the class that orchestrates the hooks with the plugin.
	 *
	 * @since     1.0.0
	 * @return    Woocomplug_Loader    Orchestrates the hooks of the plugin.
	 */
	public function get_loader() {
		return $this->loader;
	}

	/**
	 * Retrieve the version number of the plugin.
	 *
	 * @since     1.0.0
	 * @return    string    The version number of the plugin.
	 */
	public function get_version() {
		return $this->version;
	}

}
