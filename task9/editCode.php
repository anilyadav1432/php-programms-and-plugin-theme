<?php
session_start();
if(empty($_SESSION['user']))
{
    unset($_SESSION['user']);
    session_destroy();
    $msg="Error:login first";
    header("location:login.php?msg=$msg");
}

$id=$_POST['id'];
$name=$_POST['name'];
$password=$_POST['password'];
// echo $name,$id; die();
if(!empty($name) && !empty($password))
{
    include('connection.php');
    $q="update register set name='$name',password='$password' where id='$id'";
    $res=mysqli_query($con,$q);
    if($res>0)
    {
        $msg="data successfully updated";
        header("location:welcome.php?msg=$msg");
    }
    else
    {
        $msg="data not updated";
        header("location:welcome.php?msg=$msg");
    }
}
else
{
    $msg="Something went wrong";
    header("location:welcome.php?msg=$msg");
}

?>