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
            $x=strtotime($rows['dt']);
            $day=time();
            $diff=$x-$day;
            $diff=abs(floor($diff/86400));
            if($diff>1){
                if($rows['checks']==0){
                    ?>
                    <input type="checkbox" value=0  name="list">
                    <?php
                }
                else{
                  
                    ?>
                    <div><input type="checkbox" value=1 checked name="list">
                   
                         <?php
                     }
                echo "<div><span>".$rows['tm']."</span>";
                echo "<span class='box'> ".$rows['task']."</span></div>";

            }
           
        }
        echo "</div>";
    }

 ?>
<a href='addtodo.php'> <div class="addto">+ Add ToDo</div></a>
</div>
</body>
</html>