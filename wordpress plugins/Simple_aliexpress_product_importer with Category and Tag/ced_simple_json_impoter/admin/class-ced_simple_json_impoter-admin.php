<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       cedcoss
 * @since      1.0.0
 *
 * @package    Ced_simple_json_impoter
 * @subpackage Ced_simple_json_impoter/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Ced_simple_json_impoter
 * @subpackage Ced_simple_json_impoter/admin
 * @author     cedcommerce <cedcoss@gmail.com>
 */
class Ced_simple_json_impoter_Admin {

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
		// ini_set('display_errors', 1);
		// ini_set('display_startup_errors', 1);
		// error_reporting(E_ALL);
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
		 * defined in Ced_simple_json_impoter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_simple_json_impoter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/ced_simple_json_impoter-admin.css', array(), $this->version, 'all' );

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
		 * defined in Ced_simple_json_impoter_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Ced_simple_json_impoter_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/ced_simple_json_impoter-admin.js', array( 'jquery' ), $this->version, false );

		wp_localize_script($this->plugin_name, "ced_simple_importer_js",array(
			"name"=>"Ced Simple Import Data",
			"ajaxurl"=> admin_url("admin-ajax.php")
		));

	}
	/**
	 * admin menu page creation  for Aliexpress simple json product importor and listing
	 * @since	1.0.0
	*/
	function ced_json_simple_product_impoter_menu(){
		add_menu_page("import simple json page","Ced Json Simple Product Import","manage_options","ced_json_simple_product_importer",array($this,'product_importer_func'),'',20);
	}
	/**
	 * this will be list of product from Aliexpress Json file
	 * @since	1.0.0
	*/
	function product_importer_func(){
		include_once dirname( __FILE__ ) . '/partials/ced_simple_product_importer.php';
	}

	/**
	 * this will be 'simple' product import by ajax request
	 * @since	1.0.0
	*/
	function ced_ajax_request_simple_pro_importer(){

		$product_id=$_POST['product_id'];
		// echo $product_id;
		if(get_option( 'simple_json_file_url' ) !== false && !empty($product_id)){
			$file_path=get_option( 'simple_json_file_url' );
			$json = file_get_contents($file_path);
			$json_data = json_decode($json,true);
			// echo "<pre>";print_r($json_data);die();
			foreach($json_data as $product_val)
			{
				if($product_val['data']['ID'] == $product_id){
					/** This function will be create product */
					$post_id = $this->product_create_fun($product_val);
					/** This function will be create product metadata */
					$post_id = $this->product_postmeta_fun($post_id, $product_val);	
					/** This function will be create attribute of this product */
					$post_id = $this->product_attribute_create_fun($post_id, $product_val);
					/** This function will be create category of this product */
					$post_id = $this->product_category_create_fun($post_id, $product_val);
					/** This function will be create tag of this product */
					$post_id = $this->product_tag_create_fun($post_id, $product_val);
					/** This functtion will be create feature  image for product */
					$post_id = $this->product_feature_img_create_fun($post_id, $product_val);				

				}
			}

		}
		die;
	}

	/** This function will be create product 
	 * @param	$product_val	all product data in this variable
	*/
	function product_create_fun($product_val){
		$post_id = wp_insert_post(
			array(
				'post_title' => $product_val['data']['name'],
				'post_excerpt' => $product_val['data']['short_description'],
				'post_content' => file_get_contents($product_val['data']['description_url']),
				'post_type' => 'product',
				'post_status' => 'publish'
			)
		);
		// print_r($post_id);die();
		 wp_set_object_terms( $post_id, 'simple', 'product_type' );

		 return $post_id;
	}
	/**
	 * this function  will be create product postmeta data
	 * @param	$post_id	post id in this parameter
	 * @param	$product_val	all details of product
	 */
	function product_postmeta_fun($post_id, $product_val){
		if(!empty($product_val['data']['offer_price_cr'])){
			update_post_meta( $post_id, '_regular_price', $product_val['data']['offer_price_cr'] );
		}
		if(!empty($product_val['data']['price'])){
			update_post_meta( $post_id, '_price', $product_val['data']['price'] );
		}
		
		update_post_meta( $post_id, '_stock', $product_val['data']['inventory']);
		update_post_meta( $post_id, '_manage_stock', 1);
		// update_post_meta( $post_id, '_tax_status', $product_val['data']['name'] );
		// update_post_meta( $post_id, '_featured', $product_val['data']['name'] );
		// update_post_meta( $post_id, '_visibility', $product_val['data']['name']);
		// update_post_meta( $post_id, '_tax_class', $product_val['data']['name']);
		// update_post_meta( $post_id, '_stock_status', $product_val['data']['name']);
		// update_post_meta( $post_id, '_backorders', $product_val['data']['name']);
		// update_post_meta( $post_id, '_weight', $product_val['data']['name']);
		// update_post_meta( $post_id, '_length', $product_val['data']['name']);
		// update_post_meta( $post_id, '_width', $product_val['data']['name']);
		// update_post_meta( $post_id, '_height', $product_val['data']['name']);
		// update_post_meta( $post_id, '_upsell_ids', $product_val['data']['name']);
		// update_post_meta( $post_id, '_crosssell_ids', $$product_val['data']['name']);
		// update_post_meta( $post_id, '_sku', $product_val['data']['name'] );
		return $post_id;
	}
	/**
	 * this function will be create attribute of product
	 * @param	$post_id	this is product post id
	 * @param	$product_val	this is product details
	 */
	function product_attribute_create_fun($post_id, $product_val){
		 /***creating array for store of attribute and value  */
		 $attr_val_arr = array();
		 $attr_arr = array();
		 foreach($product_val['data']['specifications'] as $key=>$att_datas){
			 
			 if(!empty($att_datas['attr_name']) && !empty($att_datas['attr_value'])){
				 $attr_slug   = $att_datas['attr_name'];
				 $attr_values = $att_datas['attr_value'];
			 }
			 if(!empty($attr_slug) && !empty($attr_values)){
				 $attr_val_arr[] = $attr_slug."=>".$attr_values;
				 $attr_arr[] = $attr_slug;
			 }
		 }
		 // print_r($attr_val_arr);die;

		 /***************creating attribute by using above arrays ************/
		 foreach($attr_arr as $attr_data){
			 $arr_variatiions = array();
			 foreach($attr_val_arr as $val_attr_data){
				 $attr_name_val = explode("=>",$val_attr_data);
				 // print_r($val_attr);die;
				 if($attr_data == $attr_name_val[0]){
					 if(!in_array($attr_name_val[1],$arr_variatiions)){
						 $arr_variatiions[] = $attr_name_val[1];
					 }
				 }
			 }
			 // $attr_name_val=explode("=>",$name_val_attr);
			 $att_name_data = sanitize_title($attr_data);
			 $variation_data = implode(" | ",$arr_variatiions);
			 $attributes_array[$att_name_data] = array(
				 'name' => $att_name_data,
				 'value' => $variation_data,
				 'is_visible' => '1',
				 'is_variation' => '1',
				 'is_taxonomy' => '0'       
			 );
		 }
		 update_post_meta( $post_id, '_product_attributes', $attributes_array );
		 return $post_id;
	}
	/**
	 * this function will be create category of product
	 * @param	$post_id	this is product post id
	 * @param	$product_val	this is product details
	 */
	function product_category_create_fun($post_id, $product_val){
		/******************product category creating *******************/
		$all_cat = explode(",",$product_val['data']['keyword']);
		// print_r($all_cat);die;
		$term_id_arr=array();
		foreach($all_cat as $cat_data)
		{		
			// if(!term_exists($cat_data)) {
			$main_category = wp_insert_term( $cat_data, 'product_cat', array(
				'description' => $cat_data,
				) );
				// print_R($main_category);
				if(isset($main_category->error_data)){
					$term_id_arr[] = $main_category->error_data['term_exists'];
				}
				elseif(isset($main_category['term_id'])){
					$term_id_arr[] = $main_category['term_id'];
					// $term = term_exists( $cat_data, 'product_cat' )['term_id']; //it will get term_id
				}
					
		}
		// print_r($term_id_arr);die;
		wp_set_object_terms( $post_id, array_unique($term_id_arr), 'product_cat' );
		return $post_id;
	}
	/**
	 * this function will be create tag of product
	 * @param	$post_id	this is product post id
	 * @param	$product_val	this is product details
	 */
	function product_tag_create_fun($post_id, $product_val){
		/******************product Tag creating *******************/
		$all_tags = explode(",",$product_val['data']['tagline']);
			
		$tag_term_id_arr = array();
		foreach($all_tags as $tag_data)
		{	
			$main_tag = wp_insert_term( $tag_data, 'product_tag', array(
				'description' => $tag_data,
				) 
			);	
			if(isset($main_tag->error_data)){
				$tag_term_id_arr[] = $main_tag->error_data['term_exists'];
			}
			elseif(isset($main_tag['term_id'])){
				$tag_term_id_arr[] = $main_tag['term_id'];
			}
		}
		wp_set_object_terms( $post_id, array_unique($tag_term_id_arr), 'product_tag' );
		return $post_id;
	}
	/**
	 * this function will be create feature_img of product
	 * @param	$post_id	this is product post id
	 * @param	$product_val	this is product details
	 */
	function product_feature_img_create_fun($post_id, $product_val){
		/***set featured image of product */
		$image_url        = $product_val['data']['main_image']; 
				
		$upload_dir       = wp_upload_dir(); 
		$image_data       = file_get_contents($image_url); 
		$unique_file_name = wp_unique_filename( $upload_dir['path'], 'product_simple_img.jpg' ); 
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
		$attach_id = wp_insert_attachment( $attachment, $filestore, $post_id );
		require_once(ABSPATH . 'wp-admin/includes/image.php');
		$attach_data = wp_generate_attachment_metadata( $attach_id, $filestore );
		wp_update_attachment_metadata( $attach_id, $attach_data );
		set_post_thumbnail( $post_id, $attach_id );

	}

}
