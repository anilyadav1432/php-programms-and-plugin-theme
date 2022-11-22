<?php
  session_start();
    if(empty($_SESSION['admin']))
    {
        unset($_SESSION['admin']);
        session_destroy();
        $msg="Error:login first";
        header("location:../login.php?msg=$msg");
    }

    if(isset($_REQUEST['id']))
    {
        $id=$_REQUEST['id'];
        include('../connection.php');
        $q="select * from products where product_id=$id";
        $res=mysqli_query($con,$q);
        if($row=mysqli_fetch_array($res,MYSQLI_BOTH))
        {
?>
<html>
    <head>
    <link rel="stylesheet" href="mycss1.css">
    </head>
    <body>
    <div class="welcomeDiv">
        <div class="userDetails">
        <div class="formDiv">
        <a href="logout.php"><button class="btnLogout">Logout</button></a><br/>
        <a href="dashboard.php"><button class="btnBack">Dashboard</button></a><br/>
        <h1>Edit Product</h1>
        <form action="editSave.php" method="post" enctype="multipart/form-data">
            <table>
            <tr>
                <input type="hidden" name="id" value="<?php echo $row['product_id']; ?>">
                <th>Product Name</th>
                <td><input type="text" name="product_name" value="<?php echo $row['product_name']; ?>"></td>
            </tr>
            <tr>
                <th>Product category</th>
                <td><input type="text" name="product_category" value="<?php echo $row['product_category']; ?>"></td>
            </tr>
            <tr>
                <th>Product Price</th>
                <td><input type="number" name="product_price" value="<?php echo $row['product_price']; ?>"><br/></td>
            </tr>
            <tr>
                <th>Image</th>
                <td><input type="file" name="product_image">
                <input type="hidden" name="old_image" value="<?php echo $row['product_image']; ?>">
                <img src="uploads/<?php echo $row['product_image']; ?>" height="40" width="40">
            </td>
            </tr>
            
            <tr>
                <td colspan="2"><button type="submit"> Update</button></td>
            </tr>
            </table>
        </form>
        </div>
        </div>
    </div>
    <?php
    }
        }
    ?>
    
</body>
<html>