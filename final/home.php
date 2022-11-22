<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Home</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="main">
    <h1>Hello! User here is your Todo</h1>
    <?php 
    include 'header.php';
    include 'connect.php';
    $sql="select * from tbl1";
    $res=$conn->query($sql);
    if($res->num_rows>0){
        ?>
        <div class='mid'>
            <?php
        while($rows=$res->fetch_assoc()){
   echo "<div><a href='category.php?id=".$rows['id']."'>".$rows['category']."</a></div>";
        }?>
        </div>
   <?php }
    ?>
    <div class="addcat"><a href="addcat.php">Add category</a></div>
    </div>
</body>
</html>