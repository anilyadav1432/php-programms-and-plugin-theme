<?php

?>
<h1>Product Importer</h1>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="csv_file_data" id="">
    <input type="submit" name="importer_sub" value="import csv">
</form>
<h2 style="text-align:center;">This is Simple Product</h2>
<?php

if(isset($_POST['importer_sub'])){
    $csv_file = $_FILES['csv_file_data']['name'];
    $tmpName = $_FILES['csv_file_data']['tmp_name'];
    // echo $tmpName; 
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
        // print_r($upload);
        $avatar_dir = $upload['basedir'];
        $filestore=$avatar_dir.'/'.$csv_file;

        move_uploaded_file($tmpName,$filestore);
        if ( get_option( 'file_img_url' ) !== false) {       
            // The option already exists, so update it.
            update_option( "file_img_url", $csv_file );
        }else{
            $deprecated = null;
            $autoload = 'no';
            add_option( "file_img_url", $csv_file, $deprecated, $autoload );
        }
    }
}
        ?>
        <table border="1" style="border-collapse: collapse;margin:auto;box-shadow:3px 3px 15px grey;">
            <tr>
                <th>ID</th>
                <th>Image</th>
                <th>Name</th>
                <th>Stock</th>
                <th>Price</th>
                <th>Category</th>   
                <th>Product Import</th>   
            </tr>
            
        <?php
        if(get_option( 'file_img_url' )){
            $img_url = get_option( 'file_img_url' );
            $upload = wp_get_upload_dir();
            $avatar_dir = $upload['basedir'];
            $filestore = $avatar_dir.'/'.$img_url;
            $fileurl = array_map('str_getcsv', file($filestore));
            array_walk($fileurl, function(&$a) use ($fileurl) {
            $a = array_combine($fileurl[0], $a);
            });
            array_shift($fileurl); 


            foreach($fileurl as $key=>$val1){
                if($val1['Type'] == "simple"){
                    if(!post_exists($val1['Name'])){
            ?>
                    <tr>
                        <td> <?php echo $val1['﻿ID']; ?></td>
                        <td><img src="<?php  echo $val1['Images']; ?>" alt="" height="60" width="60"></td>
                        <td><?php  echo $val1['Name']; ?></td>
                        <td><?php  echo $val1['Stock']; ?></td>
                        <?php
                            if(!empty($val1['Sale price'])){
                        ?>
                        <td><?php  echo $val1['Sale price']; ?></td>
                        <?php
                            }else{
                        ?>
                        <td><?php  echo $val1['Regular price']; ?></td>
                        <?php
                        } ?>
                        <td><?php  echo $val1['Categories']; ?></td>
                        <td><button class="btn_ced" value="<?php echo $val1['﻿ID']; ?>">Product Importer</button></td>
                    
                    </tr>
                    <?php
                    }
                }
            }
        }
            echo "</table>";
  ?>

<!-- ****************start variable product list import from csv file code**************  -->
<h2 style="text-align:center;">This is variable Product</h2>
<table border="1" style="border-collapse: collapse;margin:auto;box-shadow:3px 3px 15px grey;">
    <tr>
        <th>ID</th>
        <th>Image</th>
        <th>Name</th>
        <th>Stock</th>
        <th>Price</th>
        <th>Category</th>   
        <th>Product Import</th>   
    </tr>

<?php
// echo "<pre>";
// print_r($fileurl);
if(isset( $fileurl )){
    foreach( $fileurl as $key => $val2 ){
        if( $val2['Type'] == "variable" ){
            if(!post_exists($val2['Name'])){
                $all_img = explode(',',$val2['Images']);
                ?>
                <tr>   
                    <td> <?php echo $val2['﻿ID']; ?></td>
                    <td><img src="<?php  echo $all_img[0]; ?>" alt="" height="60" width="60"></td>
                    <td><?php  echo $val2['Name']; ?></td>
                    <td><?php  echo $val2['Stock']; ?></td>
                    <?php
                        if(!empty($val2['Sale price'])){
                    ?>
                    <td><?php  echo $val2['Sale price']; ?></td>
                    <?php
                        }else{
                    ?>
                    <td><?php  echo $val2['Regular price']; ?></td>
                    <?php
                    } ?>
                    <td><?php  echo $val2['Categories']; ?></td>
                    <td><button class="ced_btn_var_pro" value="<?php echo $val2['﻿ID']; ?>">Product Importer</button></td>
                </tr>
                <?php
            }
        }
    }
}

echo "</table>";
?>
