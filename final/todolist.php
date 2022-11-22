<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>head</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main">
<h1>Hello! User here is your Todo</h1>
    <?php
 include 'header.php';
 include 'connect.php';
 $sql="select * from tbl2";
    $res=$conn->query($sql);
    if($res->num_rows>0){
        ?>
        <div class='days'>
            <?php
        while($rows=$res->fetch_assoc()){
           if($rows['checks']==0){
               ?>
               <input type="checkbox" value=0 checked name="list">
               <?php
           }
                echo "<div><span>".$rows['tm']."</span>";
 echo "<span class='box'> ".$rows['task']."</span></div>";
        }
        echo "</div>";
    }
   
 ?>
  <div><a href='addtodo.php'>+ Add ToDo</a></div>
</div>
</body>
</html>