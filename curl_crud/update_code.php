<?php
include 'connection.php';

$id = $_POST['id'];
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
// echo $name,$mobile,$address;
$query = "update register set name='$name', mobile='$mobile', address='$address' where id='$id'";
$res = mysqli_query($con, $query);
if($res>0){
    echo "data succesfully updated";
}else{
    echo "data not updated";
}