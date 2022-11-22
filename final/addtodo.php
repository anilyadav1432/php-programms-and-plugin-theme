<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add to do</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main">
<h1>Hello! User add new Todo</h1>
    <?php 
 if(isset($_POST['submit'])){

     $date=$_POST['dat'];
     $task=$_POST['tsk'];
     $cat=$_POST['cat'];
     $tm=$_POST['tim'];
     if(!empty($date) && !empty($task) && !empty($cat) && !empty($tm)){

  include 'connect.php';
  $sql="insert into tbl2(checks,task,tm, dt,category) values (0,'$task','$tm','$date','$cat')";
  if($conn->query($sql)===true){
      header('location:todolist.php');
  }
 }
}
    ?>
    <form action="" method="POST">
        <label>Date</label>
        <input type="date" name="dat">
        <label>Todo</label>
        <input type="text" name="tsk">
        <label>Category</label>
        <input type="text" name="cat">
        <label>Time</label>
        <input type="time" name="tim">
        <input type="submit" name="submit" value="Add">
</form>
</div>
</body>
</html>