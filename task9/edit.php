<?php
  session_start();
    if(empty($_SESSION['user']))
    {
        unset($_SESSION['user']);
        session_destroy();
        $msg="Error:login first";
        header("location:login.php?msg=$msg");
    }

    if(isset($_REQUEST['id']))
    {
        $id=$_REQUEST['id'];
        include('connection.php');
        $q="select * from register where id=$id";
        $res=mysqli_query($con,$q);
        if($row=mysqli_fetch_array($res,MYSQLI_BOTH))
        {
?>
<html>
    <head>
    <link rel="stylesheet" href="mycss.css">
    </head>
    <body>
    <div class="logDiv">
        <a href="logout.php"><button class="btnLogout">Logout</button></a><br/>
        <h4><?php echo "Welcome ".$row['name'];  ?></h4>
        <h1>Edit Form</h1>
        <form action="editCode.php" method="post">
            <table>
            <tr>
                <input type="hidden" name="id" value="<?php echo $row['id']; ?>">
                <th>Name</th>
                <td><input type="text" name="name" value="<?php echo $row['name']; ?>"></td>
            </tr>
            <tr>
                <th>Password</th>
                <td><input type="text" name="password" value="<?php echo $row['password']; ?>"></td>
            </tr>
            <tr>
                <th>Confirm Password</th>
                <td><input type="password" name="cpassword" value="<?php echo $row['password']; ?>" disabled readonly><br/></td>
            </tr>
            <tr>
                <th>email</th>
                <td><input type="text" name="email" value="<?php echo $row['email']; ?>" disabled readonly><br/></td>
            </tr>
            <tr>
                <th>Mobile</th>
                <td><input type="number" name="mobile" value="<?php echo $row['mobile']; ?>" disabled readonly><br/></td>
            </tr>
            
            <tr>
                <td colspan="2"><button type="submit"> Update</button></td>
            </tr>
            </table>
        </form>
    </div>
    <?php
    }
        }
    ?>
    
</body>
<html>