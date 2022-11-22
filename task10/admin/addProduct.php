<?php
    session_start();
    if(empty($_SESSION['admin']))
    {
        unset($_SESSION['admin']);
        session_destroy();
        $msg="Error:login first";
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
    <title>Add Product</title>
</head>
<body>
    
	<div class="welcomeDiv">
        <div class="userDetails">
        <div class="formDiv">
        <a href="logout.php"><button class="btnLogout">Logout</button></a><br/>
        <a href="dashboard.php"><button class="btnBack">Dashboard</button></a><br/>
            <h1>Add Product</h1>
            <p><?php echo isset($_REQUEST['msg'])?$_REQUEST['msg']:"";?></p>

            <form action="productSave.php" method="post" enctype="multipart/form-data">
                <table>
                    <tr>
                        <th>Product Name</th>
                        <td><input type="text" name="product_name"></td>
                    </tr>
                    <tr>
                        <th>Product Category</th>
                        <td><input type="text" name="product_category"></td>
                    </tr>
                    <tr>
                        <th>Product Price</th>
                        <td><input type="number" name="product_price"></td>
                    </tr>
                    <tr>
                        <th>Image</th>
                        <td><input type="file" name="product_image" require ></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit">Save Data</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    </div>
</body>
</html>