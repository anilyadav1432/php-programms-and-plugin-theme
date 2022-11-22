<?php
$product_name=$_POST['product_name'];
$product_category=$_POST['product_category'];
$product_price=$_POST['product_price'];
$product_image=$_FILES['product_image']['name'];
$tmp=$_FILES['product_image']['tmp_name'];

// echo $product_name,$product_category,$product_price,$product_image; die();
    // if(isset($product_image))
    // {
        include('../connection.php');
        $query="insert into products(product_name,product_category,product_price,product_image) values('$product_name','$product_category','$product_price','$product_image')";
        $result=mysqli_query($con,$query);
        if(isset($product_image))
        {
            move_uploaded_file($tmp,"uploads/".$product_image);
        }
        if($result>0)
        {
            $msg="Product have Successfully Added";
            header("location:addProduct.php?msg=$msg");
        }
        else{
            $msg="Product not Saved";
            header("location:../login.php?msg=$msg");
        }
    // }



?>