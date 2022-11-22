<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       accessories
 * @since      1.0.0
 *
 * @package    Accessories
 * @subpackage Accessories/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the public-facing stylesheet and JavaScript.
 *
 * @package    Accessories
 * @subpackage Accessories/public
 * @author     accessories <accessories.com>
 */
class Accessories_Public {

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
		// add_action( 'archive_template', array($this,'get_custom_post_type_template'));
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
		 * defined in Accessories_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Accessories_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/accessories-public.css', array(), $this->version, 'all' );

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
		 * defined in Accessories_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Accessories_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */
		
		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/accessories-public.js', array( 'jquery' ), $this->version, false );

	}

	//display accessory_post_type type function
	
	public function get_custom_post_type_template(){
		// die('display_mypost_type');
		global $post;
		if($post->post_type=='podcast'){
			$archive_template = dirname( __FILE__ ) . '/partials/my_custom_post.php';
		}
		return $archive_template;
	}
	//display mypost type single post page on public parsials folder
	public function display_mypost_page(){
		// die("display_mypost_page");
		global $post;
		if($post->post_type=='podcast'){
			$single_archive_template = dirname( __FILE__ ) . '/partials/mypost_single_page.php';
		}
		return $single_archive_template;
	}


	//display mypost type taxonomy on public parsials folder
	// public function display_mypost_taxonomy(){
		
		
	// 	if(is_tax('accessory_taxonomy'))
	// 	{
	// 		$taxonomy_post=dirname(__FILE__).'/partials/taxonomy_post_data';
	// 	}
	// 	return $taxonomy_post;
	// }


	public function display_meta_post_val($content){
		// echo $content;
		if( is_single() && ! empty( $GLOBALS['post'] ) ) {

			if ( $GLOBALS['post']->ID == get_the_ID() ) {
	            $my_book_title = get_post_meta( get_the_ID(), 'meta_box_id', true);
            // echo $my_book_title;
				return $content."<h1>".$my_book_title."<h1>";
	
			}
	
		}
	
		
	}

}
