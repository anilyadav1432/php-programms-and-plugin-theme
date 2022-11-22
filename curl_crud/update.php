<?php
if(isset($_POST['submit']))
{
    $id = $_POST['id'];
    $name = $_POST['name'];
    $mobile = $_POST['mobile'];
    $address = $_POST['address'];
    // echo $name,$mobile,$address;echo die;
    $ch = curl_init();
    // print_r($_GET);
    $url = "http://localhost/php_programs/curl_crud/update_code.php";
    $ch=curl_init($url);
    curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
    curl_setopt($ch, CURLOPT_POSTFIELDS, array("id"=>$id,"name"=>$name,"mobile"=>$mobile,"address"=>$address));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

    $result = curl_exec($ch);
    curl_close($ch);
    if(isset($result)){
        echo "<div class='alert alert-success alert-dismissible fade show' role='alert'>
                $result
                <button type='button' class='btn-close' data-bs-dismiss='alert' aria-label='Close'></button>
            </div>";
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

    <title>Curl update</title>
  </head>
  <body>
    <div class="container">
        <?php include 'navbar.php'; ?>
        <h1 class="text-center">Update data</h1>
        <div class="row justify-content-center">
            <div class="col-sm-7">
            <form action="" method="post">
                <div class="mb-3">
                    <label for="emp_id" class="form-label">Enter ID</label>
                    <input type="number" class="form-control" name="id" id="emp_id" required>
                </div>
                <div class="mb-3">
                    <label for="Name" class="form-label">Name</label>
                    <input type="text" class="form-control" name="name" id="Name" required>
                </div>
                <div class="mb-3">
                    <label for="Mobile" class="form-label">Mobile</label>
                    <input type="number" class="form-control" name="mobile" id="Mobile" required>
                </div>
                <div class="mb-3">
                    <label for="Address" class="form-label">Address</label>
                    <input type="text" class="form-control" name="address" id="Address" required>
                </div>
                <div class="text-center">
                    <button type="submit" name="submit" class="btn btn-success btn-sm">Save</button>
                </div>
            </form>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script>
        $(document).ready(function(){
            $("#emp_id").on("input",function(){
                // alert("hii");
                var emp_id = $(this).val();
                $.ajax({
                    url:"ajaxupdate.php",
                    method:"post",
                    data:{emp_id:emp_id},
                    success:function(response){
                        res_data = JSON.parse(response);
                        // console.log(res_data);
                        if(res_data){
                            $("#Name").val(res_data.name);
                            $("#Mobile").val(res_data.mobile);
                            $("#Address").val(res_data.address);
                        }else{
                            $("#Name").val("");
                            $("#Mobile").val("");
                            $("#Address").val("");
                            alert("This id Data not exist in table");
                        }
                    }
                })
            });
        });
    </script>
  </body>
</html>
