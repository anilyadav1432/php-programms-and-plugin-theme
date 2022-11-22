<?php

?>
<h1>Product Importer</h1>
<form action="" method="post" enctype="multipart/form-data">
    <input type="file" name="json_file_data" id="">
    <input type="submit" name="importer_sub" value="import json">
</form>
<h2 style="text-align:center;">This is Simple Product</h2>
<?php

if(isset($_POST['importer_sub'])){
    $json_file  = $_FILES['json_file_data']['name'];
    $tmpName    = $_FILES['json_file_data']['tmp_name'];
    if(!empty($json_file) && !empty($tmpName)){
        // echo $tmpName;
        $upload = wp_upload_dir();
        // print_r($upload); die();
        $avatar_dir = $upload['basedir'];
        $filestore=$avatar_dir.'/'.$json_file;

        move_uploaded_file($tmpName,$filestore);
        if ( get_option( 'simple_json_file_url' ) !== false) {       
            update_option( "simple_json_file_url", $filestore );
        }else{
            $deprecated = null;
            $autoload = 'no';
            add_option( "simple_json_file_url", $filestore, $deprecated, $autoload );
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
        <th> Import Simple Product</th>   
    </tr>
    
<?php
if(get_option( 'simple_json_file_url' )){
    $file_path=get_option( 'simple_json_file_url' );
    $json = file_get_contents($file_path);
    $json_data = json_decode($json,true);
    // echo "<pre>";print_r($json_data);die();

    foreach( $json_data as $key=>$all_simple_product ){
        if(!post_exists($all_simple_product['data']['name'])){
    ?>
        <tr>
            <td> <?php echo $all_simple_product['data']['ID']; ?></td>
            <td><img src="<?php  echo $all_simple_product['data']['main_image']; ?>" alt="" height="60" width="60"></td>
            <td><?php  echo $all_simple_product['data']['name']; ?></td>
            <td><?php  echo $all_simple_product['data']['inventory']; ?></td>
            <?php
                if(!empty($all_simple_product['data']['offer_price_cr'])){
            ?>
            <td><?php  echo $all_simple_product['data']['offer_price_cr']; ?></td>
            <?php
                }else{
            ?>
            <td><?php  echo $all_simple_product['data']['price']; ?></td>
            <?php
            } ?>
            <td><?php  echo $all_simple_product['data']['keyword']; ?></td>
            <td><button class="ced_btn_pro_import" value="<?php echo $all_simple_product['data']['ID']; ?>" id="btn<?php echo $all_simple_product['data']['ID']; ?>">Product Importer</button></td>
        
        </tr>
        <?php
        }
    }
}
    echo "</table>";
  ?>