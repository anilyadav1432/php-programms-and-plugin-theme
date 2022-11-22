<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       accessories
 * @since      1.0.0
 *
 * @package    Accessories
 * @subpackage Accessories/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Accessories
 * @subpackage Accessories/admin
 * @author     accessories <accessories.com>
 */
class Accessories_Admin {

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
    //  die('hii');
		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		// die('hii');
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

		wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/accessories-admin.css', array(), $this->version, 'all' );

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
		 * defined in Accessories_Loader as all of the hooks are defined
		 * in that particular class.
		 *
		 * The Accessories_Loader will then create the relationship
		 * between the defined hooks and the functions defined in this
		 * class.
		 */

		wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/accessories-admin.js', array( 'jquery' ), $this->version, false );
        
		wp_localize_script($this->plugin_name, "cedcoss_meta",array(
			"name"=>"Cedcoss technology",
			"ajaxurl"=> admin_url("admin-ajax.php")
		));
	}

//creating function of my_custom_post 

	public function my_custom_post(){
	// echo "hii";
	$name = 'Podcasts';
     $singular_name = 'Podcast';    

        $labels = array(
            'name'                => __( $name, 'Post Type General Name', 'ascent' ),
            'singular_name'       => __(  $singular_name, 'Post Type Singular Name', 'ascent' ),
            'menu_name'           => __( $name, 'ascent' ),
            'parent_item_colon'   => __( 'Parent '.$singular_name, 'ascent' ),
            'all_items'           => __( 'All '.$singular_name, 'ascent'),
            'view_item'           => __( 'View '.$singular_name, 'ascent'),
            'add_new_item'        => __( 'Add '.$singular_name, 'ascent'),
            'add_new'             => __( 'Add '.$singular_name, 'ascent' ),
            'edit_item'           => __( 'Edit '.$singular_name, 'ascent'),
            'update_item'         => __( 'Update '.$singular_name, 'ascent'),
            'search_items'        => __( 'Search '.$singular_name, 'ascent'),
            'not_found'           => __( 'Not Found', 'ascent' ),
            'not_found_in_trash'  => __( 'Not found in Trash', 'ascent' ),
            );

        $args = array(
            'label'               => __( $name, 'ascent' ),
            'description'         => __( $name, 'ascent' ),
            'labels'              => $labels,
                        // Features this CPT supports in Post Editor
            'supports'            => array( 'title', 'editor', 'excerpt', 'author', 'thumbnail', 'comments', 'revisions', 'custom-fields', ),
                    
                        'hierarchical'        => false,
                        'public'              => true,
                        'show_ui'             => true,
                        'show_in_menu'        => true,
                        'show_in_nav_menus'   => true,
                        'show_in_admin_bar'   => true,
                        'menu_position'       => 5,
                        'rewrite'            => array( 'slug' => 'podcast','with_front' => false ),
                        'can_export'          => true,
                        'has_archive'         => 'podcast',
                        'exclude_from_search' => false,
                        'publicly_queryable'  => true,
                        'capability_type'     => 'page',
                        'menu_icon'           => plugin_dir_url( __DIR__ )."assets/img/podcast_icon1.png" 
                        
                        );
        
        register_post_type('podcast',$args);
		//category add in custom post type
	register_taxonomy("categories", array("podcast"), array("hierarchical" => true, "label" => "Categories", "singular_label" => "Category", "rewrite" => array( 'slug' => 'podcast', 'with_front'=> true )));  
	}

 //Creating function of accessory_taxonomy 

//  public function accessory_taxonomy(){
// 	 register_taxonomy(
// 		 'accessory_taxonomy',  //taxonomy name
// 		 'accessory',           // post type , in which taxonomy will be show
// 		 array(
// 			 'label' 		=>__('Accessory Taxonomy'),
// 			 'rewrite' 		=>array('slug'=>'accessory'),
// 			 'hierachical' 	=> true
// 		 )
// 	 );
//  }


public function my_meta_post(){
	add_meta_box(
        'meta_box_id',   //meta box key
        __( 'ajax update meta', 'accessories' ), //title/text-domain
        array($this,'my_meta_box_ui'),  //function name
        'post'     //where will be show meta box
    );
}

public function my_meta_box_ui($post){
	
// 	$votes = get_post_meta($post->ID, "votes", true);
//  $votes = ($votes == "") ? 0 : $votes;
//  echo "<pre>"; print_r($post);die();
	echo "<input type='text' id='metadata1'><br/>";
	echo "<input type='hidden' id='metadata1Id' value='{$post->ID}'><br/>";
	echo "<button id='btn_metaBox'>button</button>";
}


//update meta box click value
public function handle_ajax_request_admin(){
	$val=isset($_REQUEST['val'])?$_REQUEST['val']:"";
	$metaID=isset($_REQUEST['metaID'])?$_REQUEST['metaID']:"";
	if(!empty($metaID)){
        //    echo $metaID;
		   if(update_post_meta( $metaID, "meta_box_id",$val )) //id ,meta_key,value
		   {
			   echo "success";
		   }
		   else{
			   echo "post meta data not update";
		   }
	}
	wp_die();
}

//creating column in admin post post meta

public function fun_new_columns($columns){
	return array_merge($columns, ['post_meta' => __('post_meta', 'textdomain')]);
}

// in post meta column creating value
public function ced_show_post_count($column_key, $post_id)
{
	// echo $post_id;die();
	$meta_val = get_post_meta( $post_id, 'meta_box_id', true );
	echo $meta_val;
}


}
