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
	$query="select name,email from register where id='$id'";
	$res=mysqli_query($con,$query);
	 if($row=mysqli_fetch_array($res,MYSQLI_BOTH))
	{
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

	<div class="allcatProduct">
        <div class="topdata">
            <a href="logout.php"><button class="btnLogout">Logout</button></a><br/>
            <a href="welcome.php"><button class="btnProduct">back</button></a><br/>
            <h1>Show Data</h1>

	<?php
        $name=$row['name'];
        $email=$row['email'];
        echo "<p>Welcome $name ";
        echo "<t/> $email <br/></p>";
    
        $query1="select * from products group by product_category";
        $res1=mysqli_query($con,$query1);
       
        if($res1)
        {
            while($row1 = $res1->fetch_assoc())
            {
                $cat=$row1['product_category'];
                $query2="select * from products where product_category='$cat'";
                $res2=mysqli_query($con,$query2);
                if($res2)
                {
                    
                    ?>
                        </div>
                        <?php echo "<h3> $cat </h3> "; ?>
                        <div class="category">
                    <?php
                    $sn=1;
                    while($row2 = $res2->fetch_assoc())
                    {
                        if($cat==$row2['product_category'])
                        {
                            // echo $row2['product_name'],$row2['product_price'];
        ?>
                    <div class="categoryproduct">
                            <div><?php echo $row2['product_name'];  ?></div>
                            <div><img src="admin/uploads/<?php echo $row2['product_image']; ?>" height="250" width="100%"></div>
                            <div><?php echo $row2['product_price'];  ?></div>
                    </div>
			

        <?php
                        }
                        $sn++;
                    }
                    ?>
                     </div>
                    <?php
                }
            }
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
}
		?>
       
	</div>
</body>
</html>