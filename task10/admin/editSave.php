<?php
session_start();
if(empty($_SESSION['admin']))
{
    unset($_SESSION['admin']);
    session_destroy();
    $msg="Error:login first";
    header("location:../login.php?msg=$msg");
}

$id=$_POST['id'];
$product_name=$_POST['product_name'];
$product_category=$_POST['product_category'];
$product_price=$_POST['product_price'];
$product_image=$_FILES['product_image']['name'];
$tmp=$_FILES['product_image']['tmp_name'];
$old_image=$_POST['old_image'];
// echo $product_name,$product_category,$product_price,$product_image,$old_image,$id; die();
if($old_image==$product_image)
{
    unlink("uploads/".$old_image);
}
    include('../connection.php');
    $q="update products set product_name='$product_name',product_category='$product_category',product_price='$product_price',product_image='$product_image' where product_id='$id';";
    $res=mysqli_query($con,$q);

        if(isset($product_image))
        {
            move_uploaded_file($tmp,"uploads/".$product_image);
        }
        if($res>0)
        {
            $msg="Product have Successfully Updated";
            header("location:updateProduct.php?msg=$msg&&action=edit");
        }
        else{
            $msg="Product not Update";
            header("location:../login.php?msg=$msg");
        }

?>