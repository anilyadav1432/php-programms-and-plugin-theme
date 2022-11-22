<?php
$name=$_POST['name'];
$email=$_POST['email'];
$mobile=$_POST['mobile'];
$password=$_POST['password'];
$cpassword=$_POST['cpassword'];

// echo $name,$email,$mobile,$password,$cpassword;
if(!preg_match("/^([a-zA-Z' ]+)$/",$name))
{
    $ne="please enter valid name";
    header("location:register.php?ne=$ne");
}
elseif(!filter_var($email, FILTER_VALIDATE_EMAIL))
{
    $ee="please enter valid Email";
    header("location:register.php?ee=$ee");
}
elseif(!is_numeric($mobile) || strlen($mobile)<10)
{
    $nume="please enter 10 digit Number";
    header("location:register.php?nume=$nume");
}
elseif($password=="")
{
    $pe="Password is required";
    header("location:register.php?pe=$pe");
}
elseif($cpassword=="")
{
    $cpe="Confirm Password is required";
    header("location:register.php?cpe=$cpe");
}
elseif($password!=$cpassword)
{
    $cpe="password and confirm password is not match";
    header("location:register.php?cpe=$cpe");
}
else
{
    
    include('connection.php');
    $query="insert into register(name,email,mobile,password) values('$name','$email','$mobile','$password')";
    $result=mysqli_query($con,$query);
    if($result>0)
    {
        $msg="You have Successfully Registered";
        header("location:login.php?msg=$msg");
    }
    else{
        $msg="data not Saved";
        header("location:register.php?msg=$msg");
    }
}


?>