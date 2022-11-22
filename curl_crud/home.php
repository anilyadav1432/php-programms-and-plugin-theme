<?php

// if(isset($_POST['submit']))
// {
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    // echo $name,$mobile,$address;echo die;
    $ch = curl_init();
    // print_r($_GET);
    $url = "http://localhost/php_programs/curl_crud/home_code.php";
    $ch=curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, array("name"=>$name,"mobile"=>$mobile,"address"=>$address));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);
    $result = json_decode($result, true);
    if(isset($result['status'])){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>";
        echo $result['msg'];
        echo "<button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
    }
    
// }

?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Curl Crud</title>
  </head>
  <body>
    <div class="container">
        <?php include 'navbar.php'; ?>
        <h1 class="text-center">Save data</h1>
        <div class="row justify-content-center">
            <div class="col-sm-7">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="Name" >
                </div>
                <div class="mb-3">
                    <label for="Mobile" class="form-label">Mobile</label>
                    <input type="number" class="form-control" name="mobile" id="Mobile" >
                </div>
                <div class="mb-3">
                    <label for="Address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="Address" >
                </div>
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-success btn-sm">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  </body>
</html>

