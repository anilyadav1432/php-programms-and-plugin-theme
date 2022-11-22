<?php
$id=$_POST['id'];
include("connection.php");
$q="delete from students where id='$id'";
$res=mysqli_query($con,$q);
if($res>0){
    echo "data successfully deleted";
}
else{
    echo "data not deleted";
}


?>