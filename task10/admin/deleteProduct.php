<?php
session_start();
if(empty($_SESSION['admin']))
{
    unset($_SESSION['admin']);
    session_destroy();
    $msg="Error:login first";
    header("location:../login.php?msg=$msg");
}

if(!empty($_REQUEST['id']))
{
$id=$_REQUEST['id'];
}

// echo $id; die();

    include('../connection.php');
    $q="delete from products where product_id='$id'";
    $res=mysqli_query($con,$q);
        if($res>0)
        {
            $msg="Product have Deleted";
            header("location:updateProduct.php?msg=$msg&&action=delete");
        }
        else{
            $msg="Product not Deleted";
            header("location:../login.php?msg=$msg");
        }

?>