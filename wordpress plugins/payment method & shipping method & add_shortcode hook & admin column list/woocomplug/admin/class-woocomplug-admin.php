<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       cedcommerce.com
 * @since      1.0.0
 *
 * @package    Woocomplug
 * @subpackage Woocomplug/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Woocomplug
 * @subpackage Woocomplug/admin
 * @author     cedcoss <cedcommerce@gmail.com>
 */
class Woocomplug_Admin {

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
		 * defined in Woocomplug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocomplug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/woocomplug-admin.css', array(), $this->version, 'all' );

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
		 * defined in Woocomplug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Woocomplug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/woocomplug-admin.js', array( 'jquery' ), $this->version, false );

	}

//Strat code to add product tag******************************************
	 public function create_woo_settings_tab($tabs){
		 $tabs['Brand']=array(
			 'label'=>__('Brand','woocomplug'), //name of your panel
			 'target'=>'Brand_panel', //will be used to create an anchor link so needs to be unique
			 'class'=>array('Brand','show_if_simple','show_if_variable'), //class for your panel tab type
			 'priority'=>80,//where your panel willl appear . by default ,70 is last item
		 );
		 return $tabs;
	 }
	
	 public function display_mytab_fields(){
		 ?>
		 <div id="Brand_panel" class="panel woocommerce_options_panel">
			 <div class="options_group">
				<?php
					woocommerce_wp_text_input(
						array(
							'id'=>'woo_settings_text_field',
							'label'=>__('My Text Field','woocomplug'),
							'type'=>'text',
							'desc_tip'=>__('my decription message will be appear here','woocomplug')
						)
						);
				?>
			 </div>
		 </div>
	<?php
	 }

	 public function save_fields($post_id){
		$product=wc_get_product($post_id);

		//save the giftwrap_cost_setting
		$woo_settings_text_field=isset($_POST['woo_settings_text_field'])? $_POST['woo_settings_text_field']:"";
		$product->update_meta_data('woo_settings_text_field',sanitize_text_field($woo_settings_text_field));
		$product->save();
	 }
//end code of product tag **********************************


//creating column in admin product Brand

public function fun_new_columns($columns){
	return array_merge($columns, ['brand' => __('Brand', 'textdomain')]);
}

// in product 'Brand' column creating value
public function ced_show_post_count($column_key, $post_id)
{
	// echo $post_id;die();
	if($column_key=="brand")
	{
	$meta_val = get_post_meta( $post_id, 'woo_settings_text_field', true );
	echo $meta_val;
	}
}


public function my_shipping_method(){
	// die();
	include_once dirname( __FILE__ ) . '/partials/my_shipping.php';
}
public function add_my_shipping_method( $methods ) {
	include_once dirname( __FILE__ ) . '/partials/my_shipping.php';
	$methods['custom_method'] = 'My_Shipping_Method';
        return $methods;
}


//Start payment method custom code here
	function init_custom_gateway_class(){
		include_once dirname( __FILE__ ) . '/partials/my_payment_method.php';
	}

	function add_custom_gateway_class( $methods ) {
		include_once dirname( __FILE__ ) . '/partials/my_payment_method.php';
		$methods[] = 'WC_Gateway_Custom'; 
		return $methods;
	}

	function custom_payment_update_order_meta( $order_id ) {
		include_once dirname( __FILE__ ) . '/partials/my_payment_method.php';
		if($_POST['payment_method'] != 'custom')
			return;

		// echo "<pre>";
		// print_r($_POST);
		// echo "</pre>";
		// exit();

		update_post_meta( $order_id, 'mobile', $_POST['mobile'] );
		update_post_meta( $order_id, 'transaction', $_POST['transaction'] );
	}

	function custom_checkout_field_display_admin_order_meta($order){
		include_once dirname( __FILE__ ) . '/partials/my_payment_method.php';
		// print_r($_POST);
		$method = get_post_meta( $order->id, '_payment_method', true );
		if($method != 'custom')
			return;

		$mobile = get_post_meta( $order->id, 'mobile', true );
		$transaction = get_post_meta( $order->id, 'transaction', true );

		echo '<p><strong>'.__( 'Mobile Number' ).':</strong> ' . $mobile . '</p>';
		echo '<p><strong>'.__( 'Transaction ID').':</strong> ' . $transaction . '</p>';
	}
//End payment method custom code here




}
