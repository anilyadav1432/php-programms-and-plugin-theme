<?php
session_start();
$email=$_POST['email'];
$password=$_POST['password'];

// echo $email,$password;

if(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $ee="please enter valid Email";
    header("location:register.php?ee=$ee");
}
elseif($password=="")
{
    $pe="Password is required";
    header("location:register.php?pe=$pe");
}
else
{
    
    include('connection.php');
    $query="select * from register where email='$email' and password='$password'";
    $result=mysqli_query($con,$query);
    if($row=mysqli_fetch_array($result,MYSQLI_BOTH))
    {
        $_SESSION['user']=$row['id'];
        header("location:welcome.php");
    }
    else{
        $msg="Email or Password incurrect";
        header("location:login.php?msg=$msg");
    }
}


?>