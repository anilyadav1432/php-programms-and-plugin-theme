<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       wooplug
 * @since      1.0.0
 *
 * @package    Wooplug
 * @subpackage Wooplug/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Wooplug
 * @subpackage Wooplug/public
 * @author     cedcoss <cedcoss@gmail.com>
 */
class Wooplug_Public {

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
		 * defined in Wooplug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wooplug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wooplug-public.css', array(), $this->version, 'all' );

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
		 * defined in Wooplug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wooplug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wooplug-public.js', array( 'jquery' ), $this->version, false );

	}

/**
 * Function for show Unique data inside "cart" single page
 * @since    1.0.0
 */
	public function ced_wooplug_single_product_page(){
		global $post;
		$post_id=$post->ID;
		$meta_val = get_post_meta( $post_id, '_unique_text_input', true );
		echo $meta_val;
	}
/**
 * Function for show Unique data inside "checkout" page
  * @param   array 		$cart_item -> this is all product item details
  * @param   string     $item_name ->  this is current product name
 * @since    1.0.0
 */
	public function ced_wooplug_cart_page_list_unique_data( $item_name,  $cart_item ) {

		$product_id = $cart_item['product_id'];
		echo $item_name;
		$unique_data = get_post_meta( $product_id, '_unique_text_input', true );
		echo "<br/>".$unique_data;
	}
/**
 * Function for show Unique data inside "order" page
 * @param   array 		$item -> this is all product item details
 * @param   int          $item_id->this is product id
 * @since    1.0.0
 */
public function action_woocommerce_order_item_meta_start($item_id, $item){
		$product_id = $item['product_id'];
		$unique_data = get_post_meta( $product_id, '_unique_text_input', true );
		echo "<br/>".$unique_data;
}

/**
 * Function for Change sale Amount with mark value
 * @param    array        $price    this products prices
 * @param    array        $product  this is all products
 * @since    1.0.0
 */
function ced_wooplug_return_sale_price($price, $product){
	global $wpdb;
	$pagename = trim( $_SERVER["REQUEST_URI"] , '/' );
	$pagename=explode("/",$pagename);
	$page_name_id = $wpdb->get_var("SELECT ID FROM $wpdb->posts WHERE post_name = '".end($pagename)."'");

	$check_setting = get_option('ced_commerce_tab_ship_in_service');
	$check_mark = get_option('ced_commerce_tab_mark_in_service');
	$increase_by = get_option('ced_commerce_tab_setting_mark_type');
	$mark_value = get_option('ced_commerce_tab_setting_value_type');
	$role_value = get_option('ced_commerce_tab_setting_user_type');
	$page_id = get_option('ced_commerce_tab_setting_page_type');
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

					if( $check_mark == 'yes' && $increase_by == 'percentage' ){
						$res = intval($price)+(intval($price)*$mark_value/100);
						
					}else if( $check_mark == 'yes' && $increase_by == 'fixed' ){
						$res = intval($price)+$mark_value;
					}else{
						$res = intval($price);
					}
				}
				else{
					$res = intval($price);
				}
			}else{
				$res="";
			}
		}else{
			$res = intval($price);
		}
	}else{
		$res = intval($price);
	}		
		
    return $res;
}
/**
 * Function for Change sale Amount with mark value
 * @param    array        $html              this products html datas
 * @param    array        $post_thumbnail_id this is post thumbnail id
 * @since    1.0.0
 */
function ced_wooplug_feature_img( $html, $attachment_id ){
	global $post;
	// echo "gkjvghfghvf";
	$img_id = get_post_meta( get_the_id(), 'file_path', true );

	if(!empty($img_id)){
		if(get_post_meta(get_the_ID(), 'image_feature', true)=="yes"){
			$imageUrl = str_replace("dl=0", "dl=1", $img_id);  
			$featured_image = get_post_thumbnail_id( $post->ID );
			if ( $attachment_id == $featured_image ){
				echo '<img src="'.$imageUrl.'">';
				echo $html;
			}
			else{
				return $html;
			}
		}else{
			return $html;
		}

   	}else{
	   return $html;
   	}
	
}


}
