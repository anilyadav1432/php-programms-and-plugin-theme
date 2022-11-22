<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add category</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
<div class="main">
<h1>Hello! User add new category</h1>
    <?php 
 if(isset($_POST['submit'])){  
     $cat=$_POST['cat'];
     if(!empty($cat)){
  include 'connect.php';
  $sql="insert into tbl1(category) values ('$cat')";
  if($conn->query($sql)===true){
      header('location:home.php');
  }
 }
}
    ?>
    <form action="" method="POST">
        <label>Category</label>
        <input type="text" name="cat">
        <input type="submit" name="submit" value="Add Category">
</form>
</div>
</body>
</html>