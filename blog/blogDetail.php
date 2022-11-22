<?php
include('connection.php');
if(!empty($_REQUEST['id']))
{
    $q="select * from tbl_blog where id='{$_REQUEST['id']}'";
    $res=mysqli_query($con,$q);
}
// form Submit code here
if(isset($_POST['submit'])){
    $name=$_POST['name'];
    $email=$_POST['email'];
    $message=$_POST['message'];
    $q1="insert into comment(name,email,message) values('$name','$email','$message')";
    
    $res1=mysqli_query($con,$q1);
    if($res1>0){
        echo "<script>alert('data successfully inserted');</script>";
    }
    else
    {
        echo "<script>alert('data not inserted');</script>";
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>Blog Details</title>
  </head>
  <body>
    <div class="container">
        <h1 class="text-center">Blog details</h1>
        <div class="row justify-content-center mt-5">
            <!-- left div -->
            <div class="col-sm-8">
                <?php
                    if($res->num_rows>0){
                        
                        while($row=mysqli_fetch_assoc($res)){
                                echo $row['description'];
                        }
                    }

                ?>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-sm-8">
                <form action="" method="post">
                <div class="mb-3">
                        <label for="name" class="form-label"> name</label>
                        <input type="text" class="form-control" name="name" aria-describedby="name">
                    </div>
                    <div class="mb-3">
                        <label for="exampleInputEmail1" class="form-label">Email</label>
                        <input type="email" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="message" class="form-label">message</label>
                        <input type="text" class="form-control" name="message">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Save Comment</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-center mt-5">
            <div class="col-sm-8 appendData bg-info">
                
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
   <script src="myjs.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>