<?php
    session_start();
    if(empty($_SESSION['admin']))
    {
        unset($_SESSION['admin']);
        session_destroy();
        $msg="Error:login first";
        header("location:../login.php?msg=$msg");
    }
        $id=$_SESSION['admin'];
        include('../connection.php');
        $query="select * from products";
        $res1=mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mycss1.css">
    <title>Display Product</title>
</head>
<body>
    
	<div class="welcomeDiv">
        <div class="userDetails">
        <div class="displayDiv">
        <a href="logout.php"><button class="btnLogout">Logout</button></a><br/>
        <a href="dashboard.php"><button class="btnBack">Dashboard</button></a><br/>
            <h1>Display Product</h1>
            <p><?php echo isset($_REQUEST['msg'])?$_REQUEST['msg']:"";?></p>
            <table>
                <tr>
                    <th>Sr.n.</th>
                    <th>Product Name</th>
                    <th>Product Category</th>
                    <th>Product Price</th>
                    <th>Product Image</th>
                    <th colspan="2">Action</th>
                </tr>
                <?php
                
                if($res1)
                {
                $sn=1;
                    while($row1 = $res1->fetch_assoc())
                    {
                ?>
                    
                    <tr>
                        <td><?php echo $sn; ?></th>
                        <td><?php echo $row1['product_name']; ?></td>
                        <td><?php echo $row1['product_category']; ?></td>
                        <td><?php echo $row1['product_price']; ?></td>
                        <td><img src="uploads/<?php echo $row1['product_image']; ?>" height="60" width="60"></td>
                        <td colspan="2">
                            <?php
                            // echo $_REQUEST['action']; die();
                            if($_REQUEST['action']=="edit")
                            {
                            ?>
                            <a href="editProduct.php?id=<?php echo $row1['product_id']; ?>"><button type="button" class="btn1">Edit</button></a>
                            <?php
                            }
                            else if($_REQUEST['action']=="delete")
                            {
                            ?>
                            <a href="deleteProduct.php?id=<?php echo $row1['product_id']; ?>"><button type="button" class="btn2">Delete</button></a>
                            <?php
                            }
                            ?>
                        </td>
                    </tr>
                <?php
                    $sn++;
                    }
                }
                ?>
            </table>
            
        </div>
    </div>
    </div>
</body>
</html>