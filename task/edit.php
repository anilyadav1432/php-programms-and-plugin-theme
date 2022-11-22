<?php

include('connection.php');
if(isset($_POST['submit']))
{
  if(!empty($_REQUEST['id']))
  {
      $id=$_REQUEST['id'];
      $question=$_POST['question'];
     
      $q="update paper set question='$question' where id='$id'";
      $res=mysqli_query($con,$q);
      if($res>0){
          echo "<script>alert('data updated');window.location.href='list.php'; </script>";
      }else
      {
        echo "<script>alert('data not updated');window.location.href='list.php'; </script>";
      }
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

    <title>Hello, world!</title>
  </head>
  <body>
      <div class="container">
        <div class="row">
            <!-- list  -->
            <div class="col-sm-4">
            <ul class="list-group">
                <li class="list-group-item bg-dark text-light"><a class="navbar-brand" href="index.php">Dashboard</a></li>
                <li class="list-group-item bg-dark text-light"><a class="navbar-brand" href="list.php">List Quetions</a></li>
               
            </ul>
            </div>
            <!-- dashboard An menu -->
            <div class="col-sm-8">
            <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
                <div class="container-fluid">
                    <a class="navbar-brand" href="addques.php">+Add Quetions</a>
                    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                  
                    </div>
                </div>
            </nav>
             <!-- Form here -->
            <?php
           
            if(!empty($_REQUEST['id']))
            {
              $id=$_REQUEST['id'];
              
              $q1="select * from paper where id='$id'";
              $res1=mysqli_query($con,$q1);
              if($row=$res1->fetch_assoc())
              {

            ?>
            <h1 class=""></h1>
            <form action="" method="post">
                <div class="mb-3">
                    <label for="question" class="form-label">Quetion</label>
                    <input type="text" class="form-control" id="question" name="question" value="<?php echo $row['question']; ?>" aria-describedby="question">
                </div>
                <button type="submit" name="submit" class="btn btn-primary">Submit</button>
            </form>
            <?php
                   }
                  }
            ?>
            <h1 class="text-center">Dashboard</h1>
           
        </div>


      </div>
    

    



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>