<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       cedcommerce.com
 * @since      1.0.0
 *
 * @package    Woocomplug
 * @subpackage Woocomplug/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Woocomplug
 * @subpackage Woocomplug/public
 * @author     cedcoss <cedcommerce@gmail.com>
 */
class Woocomplug_Public {

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
		 * defined in Woocomplug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocomplug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocomplug-public.css', array(), $this->version, 'all' );

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
		 * defined in Woocomplug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocomplug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocomplug-public.js', array( 'jquery' ), $this->version, false );

	}


/**************for show Brand on signle product page************/
	public function show_brand_text($content){
		// echo $content;
		if( is_single() && ! empty( $GLOBALS['post'] ) ) {

			if ( $GLOBALS['post']->ID == get_the_ID() ) {
				$my_book_title = get_post_meta( get_the_ID(), 'woo_settings_text_field', true);
			// echo $my_book_title;
				echo "<p>".$my_book_title."</p>";

			}

		}

		
	}


//custom shortcode function in loader file

	function register_shortcodes() {
		// print_r($post);
		// die("dii");
		
		echo "<h2>this is cartdata shortcode</h2>";
		
	}
//end code custom shortcode function in loader file

/*Start Changing Email And phone Label in checkout page */
	function custom_override_checkout_fields( $fields ) {
		$fields['billing']['billing_email']['label'] = 'Custom Label Email';
		$fields['billing']['billing_phone']['label'] = 'Custom Label Mobile';
		return $fields;
	}
/*End Changing Email And phone Label in checkout page */
	

}
