<?php
session_start();
if(isset($_POST['submit']))
{
    $email=$_POST['email'];
    $password=$_POST['password'];
    include('connection.php');
    $ob=new myClass();
    $condition="where email='$email' and password='$password' ";
    $fields=" * ";
    $result=$ob->selectData('register',$fields,$condition);
    // print_r($result[0]['role']);die();
    if(count($result)>0){
        for($i=0;$i<count($result);$i++){
            if($result[$i]['role']=="admin")
            {
                $_SESSION['admin']=$result[$i]['email'];
                header("location:Dashboard.php");
            }
            else if($result[$i]['role']=="engineer")
            {
                $_SESSION['engineer']=$result[$i]['email'];
                header("location:Dashboard.php");
            }
            else if($result[$i]['role']=="user")
            {
                $_SESSION['user']=$result[$i]['email'];
                header("location:user_dashboard.php");
            }
            
        }
        
    }
    else{
        echo "<script>alert('Email id or password incurrect');window.location.href='login.php'</script>";
    }
}
?>


<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Login</title>
  </head>
  <body>
    <div class="container-fluid">
        <!-- Navbar Here -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="index.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="login.php">login</a>
        </li>
          
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

    <!-- form here -->
     
        <h1 class="text-center">Login form</h1>
        <div class="row justify-content-center">
        <form class="w-50" action="" method="post">
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Email address</label>
                <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input type="password" class="form-control" name="password" id="exampleInputPassword1">
            </div>
            <button type="submit" name="submit" class="btn btn-primary">Login</button>
        </form>
        </div>
    </div>


    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>