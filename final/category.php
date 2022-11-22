<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main">
<h1>Hello! User</h1>
    <?php
    $id=$_GET['id'];
    include 'connect.php';
    $sql="select category from tbl1 where id='$id'";
    $res=$conn->query($sql);
    if($res->num_rows>0){
        while($rows=$res->fetch_assoc()){
            $cat=$rows['category'];
            echo "<h1>$cat</h1>";
            $sql1="select * from tbl2 where category='$cat'";
            $res1=$conn->query($sql1);
            if($res1->num_rows>0){
                ?>
                <div class='days'>
                    <?php
                while($rows1=$res1->fetch_assoc()){
                    echo "<div><span>".$rows1['tm']."</span>";
                    echo "<span class='box'> ".$rows1['task']."</span></div>";
                }
                echo "</div>";
            }
        } }
        
    ?>
   <div class="back"> <a href="home.php">Home</a></div>
    </div>
</body>
</html>