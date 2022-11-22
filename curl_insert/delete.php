<?php
include 'connection.php';
if(isset($_REQUEST['id'])){
    $id = $_REQUEST['id'];
    $q  = "delete from register where id='$id'";
    $res= mysqli_query($con, $q);
    if($res>0){
        echo "<script> alert('data deleted'); window.location.href='index.php';</script>";
    }else{
        echo "<script> alert('data not deleted'); window.location.href='index.php';</script>";
    }
}


?>