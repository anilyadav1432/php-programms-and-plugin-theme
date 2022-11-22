<?php

?>
<h1>Category Importer</h1>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="cat_csv_file_data" id="">
    <input type="submit" name="importer_sub" value="import csv">
</form>

<?php

if(isset($_POST['importer_sub'])){
    $csv_file = $_FILES['cat_csv_file_data']['name'];
    $tmpName = $_FILES['cat_csv_file_data']['tmp_name'];
    if(!empty($csv_file) && !empty($tmpName)){
        
        $csv_data = array_map('str_getcsv', file($tmpName));
        
        array_walk($csv_data , function(&$x) use ($csv_data) {
            $x = array_combine($csv_data[0], $x);
        });

        /** 
        *
        * array_shift = remove first value of array 
        * in csv file header was the first value
        * 
        */
        array_shift($csv_data);
        $upload = wp_upload_dir();
        // echo "<pre>";print_r($csv_data); die();
        $avatar_dir = $upload['basedir'];
        $filestore  = $avatar_dir.'/'.$csv_file;
        // echo "<pre>";print_r($filestore); die();
        move_uploaded_file($tmpName,$filestore);
        if ( get_option( 'cat_file_img_url' ) !== false) {       
            update_option( "cat_file_img_url", $filestore );
        }else{
            $deprecated = null;
            $autoload   = 'no';
            add_option( "cat_file_img_url", $filestore, $deprecated, $autoload );
        }


        if(get_option( 'cat_file_img_url' )){
            $filestore = get_option( 'cat_file_img_url' );
            $fileurl = array_map('str_getcsv', file($filestore));
            array_walk($fileurl, function(&$a) use ($fileurl) {
            $a = array_combine($fileurl[0], $a);
            });
            array_shift($fileurl); 
            // print_r($fileurl);die();
            $unique_cat = array();

            $all_cats = array();
            for( $i=0; $i<count($fileurl); $i++ ){
                if(!in_array($fileurl[$i]['﻿Categories'],$unique_cat)){
                    $unique_cat[] = $fileurl[$i]['﻿Categories'];    
                    $exp_val = explode( ',', $fileurl[$i]['﻿Categories'] );
                    for( $j = 0; $j<count($exp_val); $j++ ){
                        $all_cats[] = explode( '>', $exp_val[$j] );
                    }
                }
            }
            //echo "<pre>"; print_r($all_cats);die;
            foreach( $all_cats as $key=>$cat_val ){
                $parent = 0;
                foreach($cat_val as $cat_name)
                {
                    $main_cat = wp_insert_term(
                        $cat_name,
                        'product_cat',
                        array(
                            'parent'=> $parent,
                        )
                    );
                    //$prnt_id = $main_cat->error_data['term_exists'];
                    if( isset( $main_cat->error_data['term_exists'] ) )
					{
						$term_id = $main_cat->error_data['term_exists'];
					} 
					else if ( isset( $main_cat['term_id'] ) ) {
						$term_id = $main_cat['term_id'];
					}
                    $parent = $term_id;
                }
            }

        }
    }
}
?>
      