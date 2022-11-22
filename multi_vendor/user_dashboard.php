<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Document</title>
</head>
<body>
<div class="container-fluid">
  <!-- Navbar Here -->
  <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="user_dashboard.php">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="product.php">products</a>
        </li>
          
      </ul>
      <form class="d-flex">
        <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search">
        <button class="btn btn-outline-success" type="submit">Search</button>
      </form>
    </div>
  </div>
</nav>

    <h1 class="text-center">User Dashboard</h1>
<h2 class="text-end"><a href="logout.php">logout</a></h2> 

</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
</body>
</html>

<?php
session_start();

if(!empty($_SESSION['user']))
{
    echo $_SESSION['user'];
    include('connection.php');
    $obj=new myclass();
    $condition=" where email='{$_SESSION['user']}' ";
    $fields= " * ";
    $result=$obj->selectData('register',$fields,$condition);
    // echo $result[0]['name'];
    if(count($result)>0){
        for($i=0;$i<count($result);$i++){
            echo "<table class='table table-borderd w-50'><tr><th>name</th><th>email</th></tr><tr><td>{$result[$i]['name']}</td><td>{$result[$i]['email']}</td></tr></table>";
        }
    }
}


?>
