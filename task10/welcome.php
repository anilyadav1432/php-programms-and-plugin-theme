<?php
	session_start();
    if(empty($_SESSION['user']))
    {
        unset($_SESSION['user']);
        session_destroy();
        $msg="Error:login first";
        header("location:login.php?msg=$msg");
    }
// echo $email;
if(isset($_SESSION['user']))
{
    $id=$_SESSION['user'];
	include('connection.php');
	$query="select name,email,password from register where id='$id'";
	$res=mysqli_query($con,$query);
	 if($row=mysqli_fetch_array($res,MYSQLI_BOTH))
	{
    $name=$row['name'];
	$email=$row['email'];
    }
	else
	{
		unset($_SESSION['user']);
		session_destroy();
		$msg="Error:something went wrong";
		header("location:login.php?msg=$msg");
	}
}
else
{
	unset($_SESSION['user']);
	session_destroy();
    $msg="Error:Please Login Again";
    header("location:login.php?msg=$msg");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="mycss.css">
	<title>welcome</title>
</head>
<body>

	<div class="welcomeDiv">
	<a href="logout.php"><button class="btnLogout">Logout</button></a><br/>
	<a href="products.php"><button class="btnProduct">View All Products</button></a><br/>
	<p><?php echo isset($_REQUEST['msg'])?$_REQUEST['msg']:"";?></p><br/>
		<h1>Show Data</h1>

	
		<?php
			if(!empty($row))
			{
			echo "<h3>Welcome $name ";
			echo "<br/> $email <br/></h3>";
		?>
		<table border="1">
			<tr>
				<th>name</th>
				<th>password</th>
				<th>Edit</th>
			</tr>
			<tr>
				<td><?php echo $row['name']; ?></td>
				<td><?php echo $row['password']; ?></td>
				<td><a href="edit.php?id=<?php echo $id; ?>"><button class="btnEdit">Edit</button></a></td>
			</tr>
		</table>

		<?php
			}
		?>
	</div>
</body>
</html>