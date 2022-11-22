<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- Bootstrap CSS -->
     <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">

    <title>Welcome</title>
</head>
<body>
    <div class="container">
        <h1 class="text-center"> Dashboard</h1>
        <h2 class="text-end"><a href="logout.php">logout</a></h2> 


 

        <?php
        session_start();
        include('connection.php');
        $obj=new myclass();
        if(!empty($_SESSION['admin']))
        {
            // echo $_SESSION['admin'];
            $condition=" where email='{$_SESSION['admin']}' ";
            $fields= " * ";
            $result=$obj->selectData('register',$fields,$condition);
            if(count($result)>0){
                for($i=0;$i<count($result);$i++){

                ?>
                <table class='table table-borderd w-50'><tr><th>name</th><th>email</th></tr><tr><td><?php echo $result[$i]['name']; ?></td><td><?php echo $result[$i]['email']; ?></td></tr></table>
            
                <?php 
                }
            }
            ?>

            <div class="row">
                <div class="col-sm-6 justify-content-center">
                <form action="" method="post">
                    <div class="mb-3">
                        <label for="name" class="form-label">Product Name</label>
                        <input type="text" name="name" id="name" class="form-control">
                    </div>
                    <div class="mb-3">
                        <label for="number" class="form-label">Product Price</label>
                        <input type="number" name="price" id="number" class="form-control">
                    </div>
                    <button type="submit" name="submit" class="btn btn-primary">Submit</button>
                </form>
                </div>
                <div class="col-sm-6">
                    <h3 class="text-center">user Data</h3>
                    <?php
                        // $condition=" where email='{$_SESSION['admin']}' ";
                        $fields= " * ";
                        $result1=$obj->selectData('products',$fields);
                        if(!empty($result1))
                        {
                            if(count($result1)>0){
                                for($i=0;$i<count($result1);$i++){
                
                                ?>
                                <table class='table table-borderd w-50'><tr><th>Product name</th><th>Product price</th></tr><tr><td><?php echo $result[$i]['product_name']; ?></td><td><?php echo $result[$i]['product_price']; ?></td></tr></table>
                            
                                <?php 
                                }
                            }
                        }
                        ?>
                    
                </div>
            </div>

            <?php
        }
        else if(!empty($_SESSION['engineer']))
        {
            echo $_SESSION['engineer'];
            $condition=" where email='{$_SESSION['engineer']}' ";
            $fields= " * ";
            $result=$obj->selectData('register',$fields,$condition);
            if(count($result)>0){
                for($i=0;$i<count($result);$i++){
                    echo "<table class='table table-borderd w-50'><tr><th>name</th><th>email</th></tr><tr><td>{$result[$i]['name']}</td><td>{$result[$i]['email']}</td></tr></table>";
                }
            }
        }
        else
        {
        session_destroy();
        unset($_SESSION);
        
        echo "alert('login first');window.location.href='login.php';";
        
        }

        ?>


</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
  
  </body>
  </html>