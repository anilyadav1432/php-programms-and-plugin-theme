<?php
session_start();
// echo $email;
if(isset($_SESSION['user']))
{
    $id=$_SESSION['user'];
	include('connection.php');
	$query="select name,email from register where id='$id'";
	$res=mysqli_query($con,$query);
	 if($row=mysqli_fetch_array($res,MYSQLI_BOTH))
	{
    echo "Welcome ".$row['name'];
	echo "<br/>".$row['email'];
    }
}
else
{
	unset($_SESSION['user']);
	session_destroy();
    $msg="Error:Please Login Again";
    header("location:login.php?msg=$msg");
}
?>