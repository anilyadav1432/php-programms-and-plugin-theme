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
        $query="select * from register";
        $res1=mysqli_query($con,$query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mycss1.css">
    <title>Display Users</title>
</head>
<body>
    
	<div class="welcomeDiv">
        <div class="userDetails">
        <div class="displayDiv">
        <a href="logout.php"><button class="btnLogout">Logout</button></a><br/>
        <a href="dashboard.php"><button class="btnBack">Dashboard</button></a><br/>
            <h1>Display Users</h1>
            <p><?php echo isset($_REQUEST['msg'])?$_REQUEST['msg']:"";?></p>
            <table>
                <tr>
                    <th>Sr.n.</th>
                    <th> Name</th>
                    <th>Email</th>
                    <th>Mobile</th>
                    <th>Password</th>
                </tr>
                <?php
                
                if($res1)
                {
                $sn=1;
                    while($row1 = $res1->fetch_assoc())
                    {
                        if($row1['email']!="admin@admin.com")
                        {
                ?>
                    
                    <tr>
                        <td><?php echo $sn; ?></th>
                        <td><?php echo $row1['name']; ?></td>
                        <td><?php echo $row1['email']; ?></td>
                        <td><?php echo $row1['mobile']; ?></td>
                        <td><?php echo $row1['password']; ?></td>
                        
                    </tr>
                <?php
                        }
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