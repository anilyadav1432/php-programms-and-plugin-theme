<?php
	session_start();
    if(empty($_SESSION['admin']))
    {
        unset($_SESSION['admin']);
        session_destroy();
        $msg="Error:login first";
        header("location:../login.php?msg=$msg");
    }
// echo $email;
if(isset($_SESSION['admin']))
{
    $id=$_SESSION['admin'];
	include('../connection.php');
	$query="select name,email,password from register where id='$id'";
	$res=mysqli_query($con,$query);
	 if($row=mysqli_fetch_array($res,MYSQLI_BOTH))
	{
    $name=$row['name'];
	$email=$row['email'];
    }
	else
	{
		unset($_SESSION['admin']);
		session_destroy();
		$msg="Error:something went wrong";
		header("location:../login.php?msg=$msg");
	}
}
else
{
	unset($_SESSION['admin']);
	session_destroy();
    $msg="Error:Please Login Again";
    header("location:../login.php?msg=$msg");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<link rel="stylesheet" href="mycss1.css">
	<title>welcome</title>
</head>
<body>

	<div class="welcomeDiv">
        <div class="userDetails">
            <a href="logout.php"><button class="btnLogout">Logout</button></a><br/>
            <p><?php echo isset($_REQUEST['msg'])?$_REQUEST['msg']:"";?></p><br/>
            <h1>Admin dashboard</h1>
            <?php
			if(!empty($row))
			{
			echo "<h3>Welcome $name ";
			echo "<br/> $email <br/></h3><br/>";
            }
		    ?>
        </div>
		<div class="adminMenu">
            <a href="addProduct.php"><button>Add Product</button></a>
            <a href="updateProduct.php?action=edit"><button>Update Product</button></a>
            <a href="updateProduct.php?action=delete"><button>Delete Product</button></a>
            <a href="userShow.php"><button>View Registered Users</button></a>
        </div>

		
			
	</div>
</body>
</html>