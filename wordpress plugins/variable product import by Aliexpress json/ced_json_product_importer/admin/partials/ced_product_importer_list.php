<?php

?>

<h1>Product Importer</h1>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="json_file_data" id="">
    <input type="submit" name="importer_json" value="import json">
</form>

<?php
if( isset($_POST['importer_json']) ){
    $json_file  = $_FILES['json_file_data']['name'];
    $tmpName    = $_FILES['json_file_data']['tmp_name'];
    if(!empty($json_file) && !empty($tmpName)){
        // echo $tmpName;
        $upload = wp_upload_dir();
        // print_r($upload); die();
        $avatar_dir = $upload['basedir'];
        $filestore=$avatar_dir.'/'.$json_file;

        move_uploaded_file($tmpName,$filestore);
        if ( get_option( 'json_file_url' ) !== false) {       
            update_option( "json_file_url", $filestore );
        }else{
            $deprecated = null;
            $autoload = 'no';
            add_option( "json_file_url", $filestore, $deprecated, $autoload );
        }
        
    }
}
// Read JSON file
$file_path=get_option( 'json_file_url' );
$json = file_get_contents($file_path);
//Decode JSON
$json_data = json_decode($json,true);
//Print data
// echo "<pre>";print_r($json_data);
?>

<!-- ****************start variable product list import from json file code**************  -->

<?php


/**
 * creating 'WP_LIST_TABLE' for listing variation data from 'Aliexpress Json'
 */

if ( ! class_exists( 'WP_List_Table' ) ) {
    require_once(ABSPATH . 'wp-admin/includes/class-wp-list-table.php');
}   
class ProductTableList extends WP_List_Table{

    public function prepare_items(){
        global $wpdb;
        $arr=array();
        $file_path=get_option( 'json_file_url' );
        $json = file_get_contents($file_path);
        $json_data = json_decode($json,true);
        foreach($json_data as $pro_val){
            foreach($pro_val as $key=>$pro_val1){
                if(isset($pro_val1['subject'])){
                    if(!post_exists($pro_val1['subject'])){
                        $pro_img_url=explode(";",$pro_val1['image_u_r_ls']);
                        $arr[]=array("product_id" => $pro_val1['product_id'], "image_u_r_ls" => "<img src='".$pro_img_url[0]."' height='70' width='70'>", "subject" => $pro_val1['subject'], "total_available_stock" => $pro_val1['total_available_stock']);
                    }
                }
            }
        }
        //Print data
        // echo "<pre>";print_r($json_data);
        $this->items = $arr;
        $columns=$this->get_columns(); //getting columns
        // $sortable=$this->get_sortable_columns(); //sorting columns
        $this->_column_headers =array($columns,array());

        /* pagination */
        $per_page = 3;
        $current_page = $this->get_pagenum();
        $total_items = count($this->items);

        $this->items = array_slice($this->items, (($current_page - 1) * $per_page), $per_page);

        $this->set_pagination_args(array(
                'total_items' => $total_items, // total number of items
                'per_page'    => $per_page // items to show on a page
        ));
    }
    //get_columns
    public function get_columns(){
        $columns = array(
            'cb'		   => '<input type="checkbox" />', // to display the checkbox.	
            "product_id"   =>"ID",
            "image_u_r_ls" =>"Image",
            "subject"      =>"Name",
            "total_available_stock"=>"Stock",
            "action"=>"Action",
        );
        return $columns;
    }
    function column_cb($items) {
        return sprintf(
                '<label class="screen-reader-text" for="product_' . $items['product_id'] . '">' . sprintf( __( 'Select %s' ), $items['product_id'] ) . '</label>'
                . "<input type='checkbox' name='product[]' id='product_{$items['product_id']}' value='{$items['product_id']}' />"					
        );    
    }
    //column_default
    public function column_default($items,$column_name){
        switch($column_name){
            case 'product_id':
            case 'image_u_r_ls':
            case 'subject':
            case 'total_available_stock':
                return $items[$column_name];
            case 'action':
                return '<a href="?page='.$_GET['page'].'&action=product-import&product_id='.$items['product_id'].'">Import</a>';
            default:
                return "no value";
        }
    }

    function get_bulk_actions() {
        $actions = array(
          'import'    => 'Import',
        );
        return $actions;
    }
    

}

function product_show_list_table(){
    $owt_table = new ProductTableList();
    //calling prepare items from class
  
    $owt_table->prepare_items();
    $owt_table->data=$arr;
    
    $owt_table->display();   
}

product_show_list_table();

?>


<?php

//importing product after click import button 
$action = isset($_GET['action'])?trim($_GET['action']):"";

if($action == "product-import"){
    $gall_img="";
    $gallery_arr="";
    $get_product_id=isset($_GET['product_id'])?intval($_GET['product_id']):"";
    $check_variation = 1;
    foreach($json_data as $pro_val){
        foreach($pro_val as $key=>$pro_val1){
            if(isset($pro_val1['subject'])){  
                if($pro_val1['product_id'] == $get_product_id){
                    if(!post_exists($pro_val1['subject'])){
                       
                        $pro_val1_desc = isset($pro_val1['detail'])?$pro_val1['detail']:"";
                        $post_id = wp_insert_post(
                            array(
                                'post_title' => $pro_val1['subject'],
                                'post_content' => $pro_val1_desc,
                                'post_type' => 'product',
                                'post_status' => 'publish'
                            )
                        );
                        wp_set_object_terms( $post_id, 'variable', 'product_type' );

                        update_post_meta( $post_id, '_stock', $pro_val1['total_available_stock']);
                        update_post_meta( $post_id, '_weight', $pro_val1['gross_weight']);
                        update_post_meta( $post_id, '_length', $pro_val1['package_length']);
                        update_post_meta( $post_id, '_width', $pro_val1['package_width']);
                        update_post_meta( $post_id, '_height', $pro_val1['package_height']);

                        // Add Featured Image to Post
                        $image_url        = explode(';',$pro_val1['image_u_r_ls']);// Define the image URL here
                        $image_url		  = $image_url[0];

                        $upload_dir       = wp_upload_dir(); // Set upload folder
                        $image_data       = file_get_contents($image_url); // Get image data
                        $unique_file_name = wp_unique_filename( $upload_dir['path'], 'product_variable_img.jpg' ); // Generate unique name
                        $filename         = basename( $unique_file_name );
                        $avatar_dir = $upload_dir['path'];
                        $filestore = $avatar_dir.'/'.$filename;

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

                       
                        /* This is for attribute creation */
                        // foreach ($pro_val1['aeop_ae_product_propertys']['aeop_ae_product_property'] as $att_val){
                        //     foreach($att_val as $att_data){
                                
                        //         if(!empty($att_val['attr_name']) && !empty($att_val['attr_value'])){
                        //             $attr_slug = sanitize_title($att_val['attr_name']);
                        //             $attributes_array[$attr_slug] = array(
                        //                 'name' => $attr_slug,
                        //                 'value' => esc_attr($att_val['attr_value']),
                        //                 'is_visible' => '1',
                        //                 'is_variation' => '1',
                        //                 'is_taxonomy' => '0'       
                        //             );
                                   
                        //         }
                                
                        //     }
                        // }

                        /***creating array for store of attribute and value  */
                        $attr_name = array();
                        $attr_value = array();
                        foreach ($pro_val1['aeop_ae_product_s_k_us']['aeop_ae_product_sku'] as $key=>$variation_val){
                            foreach($variation_val['aeop_s_k_u_propertys']['aeop_sku_property'] as $attribute_data){
                                if(!empty($attribute_data['sku_property_name'])){
                                    $attr_slug   = $attribute_data['sku_property_name'];
                                    $attr_values = $attribute_data['sku_property_value'];
                                }else{
                                    $attr_slug   = $variation_val['aeop_s_k_u_propertys']['aeop_sku_property']['sku_property_name'];
                                    $attr_values = $variation_val['aeop_s_k_u_propertys']['aeop_sku_property']['sku_property_value'];
                                }       
                                if(!in_array($attr_slug,$attr_name) && !empty($attr_values)){
                                    $attr_name[] = $attr_slug."=>".$attr_values;
                                    $attr_value[] = $attr_slug;
                                }        
                                
                            }
                            
                        }
                        // echo "<pre>";print_r($attr_value);die;
                        
                        /**creating attribute by using above arrays */
                        foreach($attr_value as $val_attr){
                            $arr_variatiions = array();
                            foreach($attr_name as $name_val_attr){
                                $attr_name_val = explode("=>",$name_val_attr);
                                // print_r($val_attr);die;
                                if($val_attr == $attr_name_val[0]){
                                    if(!in_array($attr_name_val[1],$arr_variatiions)){
                                        $arr_variatiions[] = $attr_name_val[1];
                                    }
                                }
                            }
                            // $attr_name_val=explode("=>",$name_val_attr);
                            $att_name_data = sanitize_title($val_attr);
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

                        /**
                         * for create variation 
                         */
                        foreach ($pro_val1['aeop_ae_product_s_k_us']['aeop_ae_product_sku'] as $variation_all_val){
                           
                            // echo "<pre>";
                            //     print_r($variation_all_val);die();
                            $parent_id = $post_id;
                            $variation = array(
                                'post_status'  => 'publish',
                                'post_parent'  => $parent_id,
                                'post_type'    => 'product_variation'
                            );
                            $variation_id = wp_insert_post( $variation );
                            foreach($variation_all_val['aeop_s_k_u_propertys']['aeop_sku_property'] as $key=>$variation_val){
                    
                                // echo "<pre>";print_r($variation_val);die;
                                if(!empty($variation_val['sku_property_name'])){
                                    // print_R($variation_val['sku_property_name']);die();
                                    $article_name = sanitize_title($variation_val['sku_property_name']);
                                    $article_value = $variation_val['sku_property_value'];
                                    $gall_img = $variation_val['sku_image'];
                                }elseif(!empty($key=="property_value_id_long")){ 
                                      foreach($variation_all_val['aeop_s_k_u_propertys']['aeop_sku_property'] as $key1=>$variation_new_val)
                                      {
                                          if($key1=="sku_property_name"){
                                            $article_name = sanitize_title($variation_new_val);
                                            // echo $variation_new_val."<br/>";
                                          }
                                          if($key1=="sku_property_value"){
                                            $article_value = $variation_new_val;
                                          }
                                          if($key1=="sku_image"){
                                            $gall_img = $variation_new_val;
                                          }
                                        
                                      }
                                }
                                
                                // echo $article_name;
                                if(!empty($article_name) && !empty($article_value)){
                                    
                                    
                                    update_post_meta( $variation_id, 'attribute_'.$article_name, $article_value );
                                    if(!empty($variation_all_val['sku_price'])){
                                        update_post_meta( $variation_id, '_regular_price', $variation_all_val['sku_price'] );
                                    }
                                    if(!empty($variation_all_val['offer_sale_price'])){
                                        update_post_meta( $variation_id, '_sale_price', $variation_all_val['offer_sale_price'] );
                                    }
                                    update_post_meta( $variation_id, '_stock', $variation_all_val['s_k_u_available_stock']);
					                update_post_meta( $variation_id, '_manage_stock', 1);
                                    
  
                                    if(!empty($gall_img))
                                    {
                                        $image_url		  = $gall_img;

                                        $upload_dir       = wp_upload_dir();
                                        $image_data       = file_get_contents($image_url); 
                                        $unique_file_name = wp_unique_filename( $upload_dir['path'], 'product_variation_img.jpg' ); 
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
                                        
                                        $attach_id = wp_insert_attachment( $attachment, $filestore, $variation_id );					
                                        require_once(ABSPATH . 'wp-admin/includes/image.php');					
                                        $attach_data = wp_generate_attachment_metadata( $attach_id, $filestore );					
                                        wp_update_attachment_metadata( $attach_id, $attach_data );					
                                        set_post_thumbnail( $variation_id, $attach_id );
                                        $gallery_arr.=$attach_id.",";
                                    }

                                    
                                }
                            }
                               
                            
                        }
                        if(!empty($gallery_arr)){
                            update_post_meta( $post_id, '_product_image_gallery', $gallery_arr);
                        }

                        // header("Refresh:0"); //for page refresh
                    }
                }  
            }
        }
    }
    
        
}

?>