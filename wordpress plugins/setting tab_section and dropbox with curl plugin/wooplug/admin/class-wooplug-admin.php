<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       wooplug
 * @since      1.0.0
 *
 * @package    Wooplug
 * @subpackage Wooplug/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Wooplug
 * @subpackage Wooplug/admin
 * @author     cedcoss <cedcoss@gmail.com>
 */
class Wooplug_Admin {

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
		 * defined in Wooplug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wooplug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/wooplug-admin.css', array(), $this->version, 'all' );

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
		 * defined in Wooplug_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Wooplug_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/wooplug-admin.js', array( 'jquery' ), $this->version, false );

	}


/*
*Ced  shipping method creating class in ced_ship_method.php file
* 
* @since             1.0.0
*/
	public function ced_shippping_method_init()
	{
		include_once (dirname(__FILE__).'/partials/ced_ship_method.php');
	}

/*
*Ced  shipping method will be add new method in shpping method ($methods array type)
* @param array $methods 
* @since             1.0.0
*/
	public function ced_shipping_method( $methods ) {
		include_once (dirname(__FILE__).'/partials/ced_ship_method.php');
        $methods['ced_shipp_method'] = 'Ced_Wooplug_Shipping_Method';
        return $methods;
    }



/**
 * Function for create a tab "ique" - inside product edit page
 * @since 		1.0.0
 */
function ced_wooplug_product_tab($tabs){

	$tabs['unic_identifier'] = [
		'label' => __('unique identifier', 'wooplug'),
		'target' => 'unique_product_data',
		'class' => ['hide_if_external'],
		'priority' => 25
	];
	return $tabs;
}
/**
 * Function for create content of "unique" tab
 * @since 		1.0.0
*/
function ced_wooplug_product_tab_fields(){
	?><div id="unique_product_data" class="panel woocommerce_options_panel hidden"><?php
	woocommerce_wp_text_input([
		'id' => '_unique_text_input',
		'label' => __('Unique text input', 'wooplug'),
	]);
 
	?></div><?php
}
/**
 * Function for SAVE content of "unique" tab
* @param      int		 $post_id ->this is 'unique_product_data' post id
 * @since 		1.0.0
*/
public function ced_wooplug_save_unique_tab_data($post_id){
	$product = wc_get_product($post_id);
	$unique_input = isset($_POST['_unique_text_input']) ? $_POST['_unique_text_input'] : '';
	$product->update_meta_data('_unique_text_input', sanitize_text_field($unique_input));
	$product->save();
}
/**
 * Function for create column inside product list of "unique" tab
 * @param   array    $columns -> is all product list columns name
 * @since    1.0.0
 */
public function ced_wooplug_unique_column($columns){
	
		return array_merge($columns, ['unique_meta' => __('unique_column', 'wooplug')]);

}
/**
 * Function for show Unique data inside product column "unique_column"
 * @param   string            $column_key ->this is created "unique_column" column key
 * @param   int            $post_id ->this is product post id
 * @since    1.0.0
 */
public function ced_wooplug_unique_column_data($column_key, $post_id){
	if($column_key=='unique_meta')
	{
	$meta_val = get_post_meta( $post_id, '_unique_text_input', true );
	echo $meta_val;
	}
}

/**
 * Function for show Unique data inside admin order list
 * @param    int        $item_id    this is item id
 * @param   array 		$item -> this is all product item details
 * @since    1.0.0
 */
function ced_wooplug_unique_order_data( $item_id, $item) {
	$product_id = $item['product_id'];
	$unique_data = get_post_meta( $product_id, '_unique_text_input', true );
	echo "<br/>".$unique_data;
}

/**
 * Function for add setting tab 'cedcommerce tab' ,sections and fields
 * @param    array        $settings    this is array which contain id,label of setting tab
 * @since    1.0.0
 */
function Ced_Wooplug_add_settings( $settings ) {
	
	$settings[]=include_once dirname(__FILE__).'/partials/ced_wooplug_setting_tab.php';
	return $settings;
}


/**
 * creating admin menu registration function 
 *
 * @since 		1.0.0
 */
function ced_wooplug_api_menu_register(){
	add_menu_page(
		__('ced page title','wooplug'),
		'Dropbox',
		'manage_options',
		'ced_api_menu_slug',
		array($this,'ced_api_page'),
		'dashicons-tagcloud',
		6
	);
}
/**
 * this function called from  "ced_wooplug_api_menu_register" to fields
 *
 * @since 		1.0.0
 */
function ced_api_page(){
	include_once dirname(__FILE__).'/partials/app_token.php';
	
}
/**
 * by this function we will create meta box to upload file in dropbox
 *  @since    1.0.0
 */
function ced_wooplug_browse_button(){
	add_meta_box(
		'upload_files',   
		__( 'Upload File', 'wooplug' ), 
		array($this,'ced_wooplug_browse_form'),
		'product',     //type
		'side',
		'high'
	);
	
}

function ced_wooplug_browse_form($post){
	echo "<form method='post' enctype='multipart/form-data'>";
		echo "<input type='file' name='dropbox_file'>";
	echo "</form>";

	$image_urls = get_post_meta(get_the_ID(), 'file_path', 1);

	  if(!empty($image_urls)){
	         $imageUrl = str_replace("dl=0", "dl=1", $image_urls);?>	  
	        <img src="<?php echo $imageUrl ?>" alt="" width="80px" height="80px">
	<?php
		}
		?>
<br>

<input type="checkbox" name='image_feature' id='image_feature' <?php echo get_post_meta(get_the_ID(), 'image_feature', true)=="yes"?"checked":"";  ?>> First Image As Featured Image
<?php 

}
/**
 * by this Function prividing permission to meta box upload file in dropbox
 *  @since    1.0.0
 */
function ced_wooplug_file_upload_support(){
	echo 'enctype="multipart/form-data"';
}
/**
 * by this Function upload in dropbox
 * @param    int     this is post id
 *  @since    1.0.0
 */
function ced_wooplug_save_browse_file($post_id){
	if(!empty($_POST)){
		$filename=$_FILES['dropbox_file']['name'];
		$tmp_name=$_FILES['dropbox_file']['tmp_name'];
		if (get_option( 'app_token_option' ) !== false){
			$token_from_db=get_option( 'app_token_option' );
		}
		// echo "<pre>";echo $tmp_name;die();
		if(isset($filename)){
			$api_url = 'https://content.dropboxapi.com/2/files/upload'; //dropbox api url
			$token = $token_from_db; // oauth token

			$headers = array('Authorization: Bearer '.$token,
				'Content-Type: application/octet-stream',
				'Dropbox-API-Arg: '.
				json_encode(
					array(
						"path"=> '/upload/'.$filename,
						"mode" => "add",
						"autorename" => true,
						"mute" => false
					)
				)

			);

			$fp = fopen($tmp_name, 'rb');
			$filesize = filesize($tmp_name);
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL,$api_url);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_POST, true);

			curl_setopt($ch, CURLOPT_POSTFIELDS, fread($fp, $filesize));
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

			$response = curl_exec($ch);
			$http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);

			if($response) {
				$path = '/upload/'.$filename;
				$body = '{"path":"' . $path . '"}';
				$headers1 = array('Authorization: Bearer '.$token,
                 'Content-Type: application/json');
				 $ch1 = curl_init('https://api.dropboxapi.com/2/sharing/create_shared_link_with_settings');
				 curl_setopt($ch1, CURLOPT_HTTPHEADER, $headers1);
				 curl_setopt($ch1, CURLOPT_POST, 1);
				 curl_setopt($ch1, CURLOPT_CUSTOMREQUEST, 'POST');
				 curl_setopt($ch1, CURLOPT_POSTFIELDS, $body);
				 curl_setopt($ch1, CURLOPT_RETURNTRANSFER, true);
				 $response = curl_exec($ch1);
				 $file_path=json_decode($response,true);
				 if(array_key_exists('url',$file_path))
				 {
					$new_file_path=$file_path['url'];
				 }else{
					$new_file_path=$file_path['error']['shared_link_already_exists']['metadata']['url']; 
				 }
				//  echo "<pre>";print_r($file_path);
				//  $new_file_path=$file_path['error']['shared_link_already_exists']['metadata']['url'];
				//  echo "<pre>";print_r($new_file_path['url']);
				if(!empty($new_file_path)){
				 update_post_meta($post_id,'file_path',$new_file_path);
				}
				//  echo "<pre>";print_r($new_file_path);
				// echo "<pre>";print_r(json_decode($response,true));
				// die;
				curl_close($ch1);

			}
	
			// echo($http_code.'<br/>');
			curl_close($ch);

			$check_feature=$_POST['image_feature'];

			if(isset($check_feature)){
				update_post_meta(get_the_ID(), 'image_feature', 'yes');
			} else {
				update_post_meta(get_the_ID(), 'image_feature', 'no');
			}
			
		}
	}

}




}
