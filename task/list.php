
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
            <!-- Form here -->
            <div class="row col-sm-12 justify-content-center">
                <h1 class="text-center">Question List </h1>
                <?php
                        include('connection.php');
                        $q="select * from paper";
                        $res=mysqli_query($con,$q);
                            ?>
                            <table class="table table-bordered w-50">
                                <thead>
                                    <tr>
                                    <th scope="col">Sr.n.</th>
                                    <th scope="col">Question</th>
                                    <th scope="col">Edit</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if($res->num_rows > 0){
                                    $sn=1;
                                        while($row=mysqli_fetch_assoc($res))
                                        {
                                    ?>
                                    <tr>
                                        <th scope="row"><?php echo $sn; ?></th>
                                        <td><?php echo $row['question']; ?></td>
                                        <td><a href="edit.php?id=<?php echo $row['id']; ?>"><button class="btn btn-success btn-sm">Edit</button></a></td>
                                    </tr>
                                    <?php
                                    $sn++;
                                        }
                                    }else{
                                        echo "something error";
                                    
                                    }
                                    ?>
                                </tbody>
                            </table>

            
            </div>
        </div>


      </div>
    
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

  </body>
</html>

