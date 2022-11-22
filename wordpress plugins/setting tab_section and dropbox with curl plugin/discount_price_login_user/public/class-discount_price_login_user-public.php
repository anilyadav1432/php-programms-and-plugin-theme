<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       cedcoss
 * @since      1.0.0
 *
 * @package    Discount_price_login_user
 * @subpackage Discount_price_login_user/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Discount_price_login_user
 * @subpackage Discount_price_login_user/public
 * @author     cedcommerce <cedcoss@gmail.com>
 */
class Discount_price_login_user_Public {

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
		 * defined in Discount_price_login_user_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Discount_price_login_user_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/discount_price_login_user-public.css', array(), $this->version, 'all' );

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
		 * defined in Discount_price_login_user_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Discount_price_login_user_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/discount_price_login_user-public.js', array( 'jquery' ), $this->version, false );

	}

	/**
	 * Function for discount rate 
	 * @param    array        $price    this products prices
	 * @param    array        $product  this is all products
	 * @since    1.0.0
	 */
	function ced_discount_return_sale_price($price, $product){
		global $wpdb;
		$pagename = trim( $_SERVER["REQUEST_URI"] , '/' );
		$pagename=explode("/",$pagename);
		$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".end($pagename)."'");

		$check_setting = get_option('cedcommerce_tab_ship_in_service');
		
		$increase_by = get_option('cedcommerce_tab_setting_discount_rate');
		$role_value = get_option('cedcommerce_tab_setting_user_type');
		$page_id = get_option('cedcommerce_tab_setting_page_type');
		$discount_expiry_date = get_option('cedcommerce_tab_setting_discount_expiry_date');
		// print_r($page_name_id);
		$user = wp_get_current_user();
		$roles = $user->roles[0];
		$roles=ucfirst($roles);
		if( isset( $check_setting ) && $check_setting =='yes' )
		{
			// var_dump(in_array( $roles,$role_value ));
			if(!empty($page_id) && !empty($page_name_id) && in_array($page_name_id,$page_id)){
				if(isset($roles) && !empty($roles))
				{
					
					if(in_array( $roles,$role_value )){

						if( !empty($increase_by) ){
							$res = intval($price)-(intval($price)*$increase_by/100);
							
						}else{
							$res = intval($price);
						}
					}else{
						$res = intval($price);
					}
					
				}else{
					$res = intval($price);
				}
			}else{
				$res = intval($price);
			}
		}else{
			$res = intval($price);
		}		
			
		return $res;
	}

}

