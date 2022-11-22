<?php

include 'connection.php';
$id = $_POST['id'];
if(isset($id)){
    $checkid = "select * from register where id='$id'";
    $res = mysqli_query($con, $checkid);
    $iddata= $res->fetch_assoc();

    if($iddata)
    {
        $query = "delete from register where id='$id'";
        $result = mysqli_query($con, $query);        
        if($result){
            echo "successfully deleted";
        }else{
            echo "something went wrong";
        }
    }else{
        echo "This id is not exist";
    }
}else{
    echo "please enter id";
}