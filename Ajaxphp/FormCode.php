<?php
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
include('connection.php');
$q="insert into students(name,email,password) values('{$name}','{$email}','{$password}')";
$res=mysqli_query($con,$q);
if($res>0)
{
    echo "Data successfully Inserted";
}
else{
    echo "Data not Inserted";
}


?>