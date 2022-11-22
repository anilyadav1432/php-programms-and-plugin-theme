<?php

/**
 * Fired during plugin activation
 *
 * @link       cedcommerce.com
 * @since      1.0.0
 *
 * @package    Woocomplug
 * @subpackage Woocomplug/includes
 */

/**
 * Fired during plugin activation.
 *
 * This class defines all code necessary to run during the plugin's activation.
 *
 * @since      1.0.0
 * @package    Woocomplug
 * @subpackage Woocomplug/includes
 * @author     cedcoss <cedcommerce@gmail.com>
 */
class Woocomplug_Activator {

	/**
	 * Short Description. (use period)
	 *
	 * Long Description.
	 *
	 * @since    1.0.0
	 */
	public static function activate() {

		include_once ABSPATH . 'wp-admin/includes/plugin.php';
 
		
		// // $page_title1="order_page";
		// if( get_page_by_title( 'order_page' ) == NULL )
		// {
		// 	$my_ord_page = array(
		// 	'post_title'    => "cart",
		// 	'post_content'  => "[product-shortcode]",
		// 	'post_status'   => 'publish',
		// 	'post_author'   => 1,
		// 	'post_type'     => 'page',
		// 	);
			
		// 	// Insert the post into the database
		// 	wp_insert_post( $my_ord_page);
		// // }
		// else{
		// 	$page = get_page_by_title("order_page");	
		// 	// echo "<pre>";echo $page->ID;die();
		// 	wp_update_post(array(
		// 	'ID'    =>  $page->ID,
		// 	'post_status'   =>  'publish'
		// 	));
		// }
		
	}

}
