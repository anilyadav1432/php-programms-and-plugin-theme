<?php
$id=$_POST['id'];
$name=$_POST['name'];
$email=$_POST['email'];
$password=$_POST['password'];
include('connection.php');
$q="update students set name='{$name}',email='{$email}',password='{$password}' where id='{$id}'";
if(mysqli_query($con,$q))
{
    echo "successfuly Updated";
}
else
{
    echo "Data not Updated";
}
?>