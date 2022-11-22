<?php

/**
 * The file that defines the core plugin class
 *
 * A class definition that includes attributes and functions used across both the
 * public-facing side of the site and the admin area.
 *
 * @link       wooplug
 * @since      1.0.0
 *
 * @package    Wooplug
 * @subpackage Wooplug/includes
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
 * @package    Wooplug
 * @subpackage Wooplug/includes
 * @author     cedcoss <cedcoss@gmail.com>
 */
class Wooplug {

	/**
	 * The loader that's responsible for maintaining and registering all hooks that power
	 * the plugin.
	 *
	 * @since    1.0.0
	 * @access   protected
	 * @var      Wooplug_Loader    $loader    Maintains and registers all hooks for the plugin.
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
		if ( defined( 'WOOPLUG_VERSION' ) ) {
			$this->version = WOOPLUG_VERSION;
		} else {
			$this->version = '1.0.0';
		}
		$this->plugin_name = 'wooplug';

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
	 * - Wooplug_Loader. Orchestrates the hooks of the plugin.
	 * - Wooplug_i18n. Defines internationalization functionality.
	 * - Wooplug_Admin. Defines all hooks for the admin area.
	 * - Wooplug_Public. Defines all hooks for the public side of the site.
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
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wooplug-loader.php';

		/**
		 * The class responsible for defining internationalization functionality
		 * of the plugin.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'includes/class-wooplug-i18n.php';

		/**
		 * The class responsible for defining all actions that occur in the admin area.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'admin/class-wooplug-admin.php';

		/**
		 * The class responsible for defining all actions that occur in the public-facing
		 * side of the site.
		 */
		require_once plugin_dir_path( dirname( __FILE__ ) ) . 'public/class-wooplug-public.php';

		$this->loader = new Wooplug_Loader();

	}

	/**
	 * Define the locale for this plugin for internationalization.
	 *
	 * Uses the Wooplug_i18n class in order to set the domain and to register the hook
	 * with WordPress.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function set_locale() {

		$plugin_i18n = new Wooplug_i18n();

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

		$plugin_admin = new Wooplug_Admin( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_styles' );
		$this->loader->add_action( 'admin_enqueue_scripts', $plugin_admin, 'enqueue_scripts' );
		;
		/**
		 * For shipping method calling a function to declare shipping class 
		 * @since    1.0.0
		 */
		$this->loader->add_action('woocommerce_shipping_init', $plugin_admin,'ced_shippping_method_init');
		/**
		 * For shipping method , calling a function to add method in $methods array 
		 * @since    1.0.0
		 */
		$this->loader->add_filter( 'woocommerce_shipping_methods', $plugin_admin, 'ced_shipping_method' );
		/**
		 * Function for create a tab "ique" - inside product edit pagel
		 * @since    1.0.0
		 */
		$this->loader->add_filter('woocommerce_product_data_tabs', $plugin_admin,'ced_wooplug_product_tab');
		/**
		 * Function for create content of "unique" tab
		 * @since    1.0.0
		 */
		$this->loader->add_action("woocommerce_product_data_panels", $plugin_admin,"ced_wooplug_product_tab_fields");
		/**
		 * Function for save content of "unique" tab
		 * @since    1.0.0
		 */
		$this->loader->add_action("woocommerce_process_product_meta", $plugin_admin,"ced_wooplug_save_unique_tab_data");
		/**
		 * Function for create column inside product list of "unique" tab
		 * @since    1.0.0
		 */
		$this->loader->add_filter('manage_edit-product_columns', $plugin_admin, "ced_wooplug_unique_column");
		/**
		 * Function for show Unique data inside product column "unique_column"
		 * @since    1.0.0
		 */
		$this->loader->add_action('manage_product_posts_custom_column', $plugin_admin, "ced_wooplug_unique_column_data",10,2);
		/**
		 * Function for show Unique data inside admin order list
		 * @since    1.0.0
		 */
		$this->loader->add_action('woocommerce_after_order_itemmeta', $plugin_admin, "ced_wooplug_unique_order_data",10,2);

		/**
		 * hook for add setting tab 'cedcommerce tab' ,sections and fields
		 * @since    1.0.0
		 */
    	$this->loader->add_filter( 'woocommerce_get_settings_pages', $plugin_admin, 'Ced_Wooplug_add_settings' );
		/**
		 * This hook will be add admin menu
		 *  @since    1.0.0
		 */
		$this->loader->add_action('admin_menu', $plugin_admin, 'ced_wooplug_api_menu_register');
		/**
		 * by this hook we will create meta box to upload file in dropbox
		 *  @since    1.0.0
		 */
		$this->loader->add_action( 'add_meta_boxes', $plugin_admin, 'ced_wooplug_browse_button' ); 
		/**
		 * by this hook prividing permission to meta box upload file in dropbox
		 *  @since    1.0.0
		 */
		$this->loader->add_action( 'post_edit_form_tag', $plugin_admin, 'ced_wooplug_file_upload_support' ); 
		/**
		*by this hook we will save browse file in dropbox
		*/
		$this->loader->add_action( 'save_post_product', $plugin_admin, 'ced_wooplug_save_browse_file' ); 
		
	}

	/**
	 * Register all of the hooks related to the public-facing functionality
	 * of the plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 */
	private function define_public_hooks() {

		$plugin_public = new Wooplug_Public( $this->get_plugin_name(), $this->get_version() );

		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_styles' );
		$this->loader->add_action( 'wp_enqueue_scripts', $plugin_public, 'enqueue_scripts' );
        /**
		 * Function for show Unique data inside "cart" single page
		 * @since    1.0.0
		 */
		$this->loader->add_action('woocommerce_before_add_to_cart_form', $plugin_public, "ced_wooplug_single_product_page",10);
		 /**
		 * Function for show Unique data inside "checkout" page
		 * @since    1.0.0
		 */
		$this->loader->add_filter( 'woocommerce_cart_item_name', $plugin_public , 'ced_wooplug_cart_page_list_unique_data', 10,2 );
		/**
		 * Function for show Unique data inside "order" page
		 * @since    1.0.0
		 */
		$this->loader->add_action( 'woocommerce_order_item_meta_start',$plugin_public, 'action_woocommerce_order_item_meta_start', 10, 2 );
		
		/**
		 * hook for Change sale Amount with mark value
		 * @since    1.0.0
		 */
		$this->loader->add_filter('woocommerce_get_price', $plugin_public, 'ced_wooplug_return_sale_price', 10, 2);
		/**
		 * this hook use For update feature image
		 * @since    1.0.0
		 */
		$this->loader->add_filter( 'woocommerce_single_product_image_thumbnail_html', $plugin_public, 'ced_wooplug_feature_img', 10, 2 );
		// $this->loader->add_filter( 'woocommerce_single_product_image_html', $plugin_public, 'ced_wooplug_feature_img', 10, 2 );

		
	
	}

	/**
	 * Run the loader to execute all of the hooks with WordPress.
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
	 * @return    Wooplug_Loader    Orchestrates the hooks of the plugin.
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
