<?php
include('connection.php');
$q="select * from tbl_blog";
$res=mysqli_query($con,$q);

?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <title>index</title>
  </head>
  <body>
    <div class="container">
        <h1 class="text-center">Blog</h1>
        <div class="row">
            <!-- left div -->
            <div class="col-sm-8">
                <?php
                    if($res->num_rows>0){
                        
                        while($row=mysqli_fetch_assoc($res)){
                            $d=date("M d",strtotime($row['date']));
                            $y=date("Y",strtotime($row['date']));
                                echo "<a href='blogDetail.php?id={$row['id']}' style='text-decoration:none'><h2>".$row['title']."</h2></a><b>".$d." , ".$y."</b><br/>";
                                echo substr($row['description'],0,100);
                        }
                    }

                ?>
            </div>

            <!-- right div -->
            <div class="col-sm-4">
                <h2 class="text-center mb-5 mt-5 ">About</h2>
                <ul class="list-group">
                <li class="list-group-item active" aria-current="true">An active item</li>
                <li class="list-group-item">A second item</li>
                <li class="list-group-item">A third item</li>
                <li class="list-group-item">A fourth item</li>
                <li class="list-group-item">And a fifth one</li>
                </ul>

            </div>
        </div>
    </div>

   
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
  </body>
</html>