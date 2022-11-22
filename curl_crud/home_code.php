<?php
include 'connection.php';
// echo "hii"; die();
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
// echo $name,$mobile,$address;
$query = "insert into register(name,mobile,address) values('$name','$mobile','$address')";
$res   = mysqli_query($con,$query);
if($res>0){
    $status = 'True';
    $msg  = "Data inserted";
}else{
    $status = 'False';
    $msg  = "Data Not insert";
}
 $result =  json_encode(['status' => $status, 'msg' => $msg]);
 echo $result;