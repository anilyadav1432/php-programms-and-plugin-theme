<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       cedcoss_product_impoter
 * @since      1.0.0
 *
 * @package    Cedcoss_product_impoter
 * @subpackage Cedcoss_product_impoter/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cedcoss_product_impoter
 * @subpackage Cedcoss_product_impoter/admin
 * @author     cedcoss <cedcoss@gmail.com>
 */
class Cedcoss_product_impoter_Admin {

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
		 * defined in Cedcoss_product_impoter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cedcoss_product_impoter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cedcoss_product_impoter-admin.css', array(), $this->version, 'all' );

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
		 * defined in Cedcoss_product_impoter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Cedcoss_product_impoter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cedcoss_product_impoter-admin.js', array( 'jquery' ), $this->version, false );
		wp_localize_script($this->plugin_name, "ced_importer_js",array(
			"name"=>"Ced Import Data",
			"ajaxurl"=> admin_url("admin-ajax.php")
		));

	}

	/**
	 * this hook use For create simple product automatically
	 * @since    1.0.0
	 */
	function ced_create_simple_product(){
	$number_of_products = 2;

	// for ($i=1; $i <= $number_of_products; $i++) {
		// First we create the product post so we can grab it's ID
		if(!post_exists("Hoodie with Logo")){
			$post_id = wp_insert_post(
			array(
				'post_title' => 'Hoodie with Logo',
				'post_excerpt' => 'This is a simple product.',
				'post_content' => 'Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Vestibulum tortor quam, feugiat vitae, ultricies eget, tempor sit amet, ante. Donec eu libero sit amet quam egestas semper. Aenean ultricies mi vitae est. Mauris placerat eleifend leo.',
				
				'post_type' => 'product',
				'post_status' => 'publish',
			)
			);
		}
			wp_set_object_terms( $post_id, 'simple', 'product_type' );
			update_post_meta( $post_id, '_visibility', 'visible' );
			update_post_meta( $post_id, 'total_sales', '0' );
			update_post_meta( $post_id, '_downloadable', 'no' );
			update_post_meta( $post_id, '_virtual', 'yes' );
			update_post_meta( $post_id, '_regular_price', '800' );
			update_post_meta( $post_id, '_sale_price', '700' );
			update_post_meta( $post_id, '_tax_status', 'taxable' );
			update_post_meta( $post_id, '_purchase_note', '' );
			update_post_meta( $post_id, '_featured', 'no' );
			update_post_meta( $post_id, '_weight', '11' );
			update_post_meta( $post_id, '_length', '11' );
			update_post_meta( $post_id, '_width', '11' );
			update_post_meta( $post_id, '_height', '11' );
			update_post_meta( $post_id, '_sku', 'woo-hoodie-with-logo' );
			update_post_meta( $post_id, '_product_attributes', array() );
			update_post_meta( $post_id, '_sale_price_dates_from', '' );
			update_post_meta( $post_id, '_sale_price_dates_to', '' );
			update_post_meta( $post_id, '_price', '700' );
			update_post_meta( $post_id, '_sold_individually', '' );
			update_post_meta( $post_id, '_manage_stock', 'yes' );
			update_post_meta( $post_id, '_stock', 1 );
			wc_update_product_stock($post_id, 5, 'set'); 
			update_post_meta( $post_id, '_backorders', 'no' );
	// }

		
	}

	/**
	 * this hook use For create variable product with attribute & variation automatically
	 * @since    1.0.0
	 */
	function ced_create_variable_product(){
		if(!post_exists("Variation Product")){
			$post_id = wp_insert_post(
				array(
					'post_title' => 'Variation Product',
					'post_type' => 'product',
					'post_status' => 'publish'
				)
			);
		}
			wp_set_object_terms( $post_id, 'variable', 'product_type' ); // set product is simple/variable/grouped
			update_post_meta( $post_id, '_visibility', 'visible' );
			update_post_meta( $post_id, '_stock_status', 'instock');
			update_post_meta( $post_id, 'total_sales', '0' );
			update_post_meta( $post_id, '_downloadable', 'no' );
			update_post_meta( $post_id, '_virtual', 'yes' );
			update_post_meta( $post_id, '_regular_price', '800' );
			update_post_meta( $post_id, '_sale_price', '700' );
			update_post_meta( $post_id, '_purchase_note', '' );
			update_post_meta( $post_id, '_featured', 'no' );
			update_post_meta( $post_id, '_weight', '11' );
			update_post_meta( $post_id, '_length', '11' );
			update_post_meta( $post_id, '_width', '11' );
			update_post_meta( $post_id, '_height', '11' );
			update_post_meta( $post_id, '_sku', 'SKU11' );

			$attr_label = 'size';
			$attr_slug = sanitize_title($attr_label);
			$attributes_array[$attr_slug] = array(
				'name' => $attr_label,
				'value' => '90 | 110',
				'is_visible' => '1',
				'is_variation' => '1',
				'is_taxonomy' => '0'       
			);
			update_post_meta( $post_id, '_product_attributes', $attributes_array );

			$parent_id = $post_id;
			$article_name='ced';
			$variation = array(
				'post_title'   => $article_name . ' (variation)',
				'post_content' => '',
				'post_status'  => 'publish',
				'post_parent'  => $parent_id,
				'post_type'    => 'product_variation'
			);
			$variation_id = wp_insert_post( $variation );
			update_post_meta( $variation_id, '_regular_price', 100 );
			update_post_meta( $variation_id, '_price', 80 );
			update_post_meta( $variation_id, '_stock_qty', 10 );
			update_post_meta( $variation_id, 'attribute_' . $attr_slug, '90' );
			WC_Product_Variable::sync( $parent_id );


			update_post_meta( $post_id, '_sale_price_dates_from', '' );
			update_post_meta( $post_id, '_sale_price_dates_to', '' );
			update_post_meta( $post_id, '_price', '700' );
			update_post_meta( $post_id, '_sold_individually', '' );
			update_post_meta( $post_id, '_manage_stock', 'yes' );
			update_post_meta( $post_id, '_thumbnail_id', '' );
			wc_update_product_stock($post_id, 5, 'set');
			update_post_meta( $post_id, '_backorders', 'no' );
			
	}



	/**
	 * admin menu page creation  for csv product importor and listing
	 * @since	1.0.0
	*/
	function ced_csv_product_impoter_menu(){
		add_menu_page("import csv page","Ced Product Import","manage_options","ced_product_importer",array($this,'product_importer_func'),'',20);
	}
	/**
	 * this will be list of product from csv file
	 * @since	1.0.0
	*/
	function product_importer_func(){
		include_once dirname( __FILE__ ) . '/partials/ced_product_importer.php';
	}
	/**
	 * this will be 'simple' product import by ajax request
	 * @since	1.0.0
	*/
	function ced_importer_ajax_request_simple_pro(){
		$product_id=$_POST['product_id'];
		if(get_option( 'file_img_url' ) !== false){
			$img_url= get_option( 'file_img_url' );
			$upload = wp_get_upload_dir();
			$avatar_dir = $upload['basedir'];
        	$filestore=$avatar_dir.'/'.$img_url;
			$fileurl = array_map('str_getcsv', file($filestore));
			array_walk($fileurl, function(&$a) use ($fileurl) {
			$a = array_combine($fileurl[0], $a);
			});
			array_shift($fileurl); 
			// print_r($fileurl);
			// die();
			foreach($fileurl as $product_val)
			{
				// echo $product_val['﻿ID'];
				if($product_val['﻿ID']==$product_id){
					
					$post_id = wp_insert_post(
						array(
							'post_title' => $product_val['Name'],
							'post_excerpt' => $product_val['Short description'],
							'post_content' => $product_val['Description'],
							'post_type' => 'product',
							'post_status' => 'publish'
						)
					);
					wp_set_object_terms( $post_id, 'simple', 'product_type' );
					// update_post_meta( $post_id, '_regular_price', $product_val['Regular price'] );
					// update_post_meta( $post_id, '_price', $product_val['Sale price'] );
					update_post_meta( $post_id, '_tax_status', $product_val['Tax status'] );
					update_post_meta( $post_id, '_sku', $product_val['SKU'] );
					update_post_meta( $post_id, '_featured', $product_val['Is featured?'] );
					update_post_meta( $post_id, '_visibility', $product_val['Visibility in catalog']);
					update_post_meta( $post_id, '_tax_class', $product_val['Tax class']);
					update_post_meta( $post_id, '_stock', $product_val['Stock']);
					update_post_meta( $post_id, '_manage_stock', $product_val['In stock?']);
					update_post_meta( $post_id, '_stock_status', $product_val['Backorders allowed?']);
					update_post_meta( $post_id, '_backorders', $product_val['Backorders allowed?']);
					update_post_meta( $post_id, '_weight', $product_val['Weight (lbs)']);
					update_post_meta( $post_id, '_length', $product_val['Length (in)']);
					update_post_meta( $post_id, '_width', $product_val['Width (in)']);
					update_post_meta( $post_id, '_height', $product_val['Height (in)']);
					update_post_meta( $post_id, '_upsell_ids', $product_val['Upsells']);
					update_post_meta( $post_id, '_crosssell_ids', $product_val['Cross-sells']);

					$attr_slug = sanitize_title($product_val['Attribute 1 name']);
					$att_name = $product_val['Attribute 1 value(s)'];
					$att_name = str_replace(',', ' | ', $att_name);
					// echo $att_name;
					// die();
					$attributes_array[$attr_slug] = array(
						'name' => $product_val['Attribute 1 name'],
						'value' => $att_name,
						'is_visible' => '1',
						'is_variation' => '1',
						'is_taxonomy' => '0'       
					);
					update_post_meta( $post_id, '_product_attributes', $attributes_array );

					// Add Featured Image to Post
					$image_url        = $product_val['Images']; // Define the image URL here
					// echo $image_url;die();
					$upload_dir       = wp_upload_dir(); // Set upload folder
					$image_data       = file_get_contents($image_url); // Get image data
					$unique_file_name = wp_unique_filename( $upload_dir['path'], 'product_img.jpg' ); // Generate unique name
					$filename         = basename( $unique_file_name );
					$avatar_dir = $upload_dir['path'];
        			$filestore=$avatar_dir.'/'.$filename;

					$wp_filetype = wp_check_filetype( $filename, null );
					file_put_contents( $filestore, $image_data );
					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => sanitize_file_name( $filename ),
						'post_content'   => '',
						'post_status'    => 'inherit'
					);
					
					// Create the attachment
					$attach_id = wp_insert_attachment( $attachment, $filestore, $post_id );
					
					// Include image.php
					require_once(ABSPATH . 'wp-admin/includes/image.php');
					
					// Define attachment metadata
					$attach_data = wp_generate_attachment_metadata( $attach_id, $filestore );
					
					// Assign metadata to attachment
					wp_update_attachment_metadata( $attach_id, $attach_data );
					
					// And finally assign featured image to post
					set_post_thumbnail( $post_id, $attach_id );
				}

			}
			
		}

		die();
	}

	/**
	 * this will be 'variable' product import by ajax request
	 * @since	1.0.0
	*/
	function ced_importer_ajax_request_variable_pro(){
		$product_id=$_POST['product_id'];
		// echo $product_id;
		if(get_option( 'file_img_url' ) !== false){
			$img_url= get_option( 'file_img_url' );
			$upload = wp_get_upload_dir();
			$avatar_dir = $upload['basedir'];
        	$filestore=$avatar_dir.'/'.$img_url;
			$fileurl = array_map('str_getcsv', file($filestore));
			array_walk($fileurl, function(&$a) use ($fileurl) {
			$a = array_combine($fileurl[0], $a);
			});
			array_shift($fileurl); 
			// print_r($fileurl);
			// die();
			foreach($fileurl as $product_val)
			{
				// echo $product_val['﻿ID'];
				if($product_val['﻿ID']==$product_id){
					
					$post_id = wp_insert_post(
						array(
							'post_title' => $product_val['Name'],
							'post_excerpt' => $product_val['Short description'],
							'post_content' => $product_val['Description'],
							'post_type' => 'product',
							'post_status' => 'publish'
						)
					);
					wp_set_object_terms( $post_id, 'variable', 'product_type' );
					update_post_meta( $post_id, '_regular_price', $product_val['Regular price'] );
					update_post_meta( $post_id, '_price', $product_val['Sale price'] );
					update_post_meta( $post_id, '_tax_status', $product_val['Tax status'] );
					update_post_meta( $post_id, '_sku', $product_val['SKU'] );
					update_post_meta( $post_id, '_featured', $product_val['Is featured?'] );
					update_post_meta( $post_id, '_visibility', $product_val['Visibility in catalog']);
					update_post_meta( $post_id, '_tax_class', $product_val['Tax class']);
					update_post_meta( $post_id, '_stock', $product_val['Stock']);
					update_post_meta( $post_id, '_manage_stock', $product_val['In stock?']);
					update_post_meta( $post_id, '_stock_status', $product_val['Backorders allowed?']);
					update_post_meta( $post_id, '_backorders', $product_val['Backorders allowed?']);
					update_post_meta( $post_id, '_weight', $product_val['Weight (lbs)']);
					update_post_meta( $post_id, '_length', $product_val['Length (in)']);
					update_post_meta( $post_id, '_width', $product_val['Width (in)']);
					update_post_meta( $post_id, '_height', $product_val['Height (in)']);
					update_post_meta( $post_id, '_upsell_ids', $product_val['Upsells']);
					update_post_meta( $post_id, '_crosssell_ids', $product_val['Cross-sells']);
			
					$attr_slug = sanitize_title($product_val['Attribute 1 name']);
					$att_name=$product_val['Attribute 1 value(s)'];
					$att_name=str_replace(',', ' | ', $att_name);
					$attributes_array[$attr_slug] = array(
						'name' => $product_val['Attribute 1 name'],
						'value' => $att_name,
						'is_visible' => '1',
						'is_variation' => '1',
						'is_taxonomy' => '0'       
					);
					update_post_meta( $post_id, '_product_attributes', $attributes_array );

					// Add variation for Post
					$attr_count=count(explode("|",$att_name));
					$check=0;
					foreach($fileurl as $variation_data){
						if($check!=$attr_count){
							if( $product_val['SKU'] == $variation_data['Parent'] ){
								// print_r($variation_data);
								$parent_id = $post_id;
								$article_name=$variation_data['Name'];
								$variation = array(
									'post_title'   => $article_name .' (variation)',
									'post_status'  => 'publish',
									'post_parent'  => $parent_id,
									'post_type'    => 'product_variation'
								);
								$variation_id = wp_insert_post( $variation );
								// echo $variation_data['Sale price']."<br/>";
								if(empty($variation_data['Sale price'])){
									$variation_data['Sale price']=0;
								}
								update_post_meta( $variation_id, '_price', $variation_data['Sale price'] );	
								update_post_meta( $variation_id, '_sale_price', $variation_data['Sale price'] );	
								update_post_meta( $variation_id, '_regular_price', $variation_data['Regular price'] );
								update_post_meta( $variation_id, '_stock_qty', $variation_data['Stock'] );
								update_post_meta( $variation_id, '_tax_class', $variation_data['Tax class']);
								update_post_meta( $variation_id, '_weight', $variation_data['Weight (lbs)']);
								update_post_meta( $variation_id, '_length', $variation_data['Length (in)']);
								update_post_meta( $variation_id, '_width', $variation_data['Width (in)']);
								update_post_meta( $variation_id, '_height', $variation_data['Height (in)']);
								update_post_meta( $variation_id, '_variation_description', $variation_data['Description']);
								update_post_meta( $variation_id, '_sale_price_dates_from', $variation_data['Date sale price starts']);
								update_post_meta( $variation_id, '_sale_price_dates_to', $variation_data['Date sale price ends']);
								update_post_meta( $variation_id, 'product_shipping_class', $variation_data['Shipping class']);
								update_post_meta( $variation_id, '_download_limit', $variation_data['Download limit']);
								update_post_meta( $variation_id, '_download_expiry', $variation_data['Download expiry days']);
								update_post_meta( $variation_id, 'attribute_'.strtolower($variation_data['Attribute 1 name']), $variation_data['Attribute 1 value(s)'] );
								// WC_Product_Variable::sync( $parent_id );
								// Add Featured Image to Post
								$image_url        = explode(',',$variation_data['Images']);// Define the image URL here
								$image_url		  = $image_url[0];

								$upload_dir       = wp_upload_dir(); // Set upload folder
								$image_data       = file_get_contents($image_url); // Get image data
								$unique_file_name = wp_unique_filename( $upload_dir['path'], 'product_variation_img.jpg' ); // Generate unique name
								$filename         = basename( $unique_file_name );
								$avatar_dir = $upload_dir['path'];
								$filestore=$avatar_dir.'/'.$filename;

								$wp_filetype = wp_check_filetype( $filename, null );
								file_put_contents( $filestore, $image_data );
								$attachment = array(
									'post_mime_type' => $wp_filetype['type'],
									'post_title'     => sanitize_file_name( $filename ),
									'post_content'   => '',
									'post_status'    => 'inherit'
								);
								
								// Create the attachment
								$attach_id = wp_insert_attachment( $attachment, $filestore, $variation_id );					
								// Include image.php
								require_once(ABSPATH . 'wp-admin/includes/image.php');					
								// Define attachment metadata
								$attach_data = wp_generate_attachment_metadata( $attach_id, $filestore );					
								// Assign metadata to attachment
								wp_update_attachment_metadata( $attach_id, $attach_data );					
								// And finally assign featured image to post
								set_post_thumbnail( $variation_id, $attach_id );


								$check++;
							}
						}
					}

					// Add Featured Image to Post
					$image_url        = explode(',',$product_val['Images']);// Define the image URL here
					$image_url		  = $image_url[0];

					$upload_dir       = wp_upload_dir(); // Set upload folder
					$image_data       = file_get_contents($image_url); // Get image data
					$unique_file_name = wp_unique_filename( $upload_dir['path'], 'product_img.jpg' ); // Generate unique name
					$filename         = basename( $unique_file_name );
					$avatar_dir = $upload_dir['path'];
        			$filestore=$avatar_dir.'/'.$filename;

					$wp_filetype = wp_check_filetype( $filename, null );
					file_put_contents( $filestore, $image_data );
					$attachment = array(
						'post_mime_type' => $wp_filetype['type'],
						'post_title'     => sanitize_file_name( $filename ),
						'post_content'   => '',
						'post_status'    => 'inherit'
					);
					
					// Create the attachment
					$attach_id = wp_insert_attachment( $attachment, $filestore, $post_id );					
					// Include image.php
					require_once(ABSPATH . 'wp-admin/includes/image.php');					
					// Define attachment metadata
					$attach_data = wp_generate_attachment_metadata( $attach_id, $filestore );					
					// Assign metadata to attachment
					wp_update_attachment_metadata( $attach_id, $attach_data );					
					// And finally assign featured image to post
					set_post_thumbnail( $post_id, $attach_id );
				}

			}
			
		}
		die();
	}





}
