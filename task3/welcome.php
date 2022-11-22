<?php
    if($_REQUEST['email'])
    {
        $e=$_REQUEST['email'];
        $p=$_REQUEST['password'];
        $n=$_REQUEST['name'];
        $a=$_REQUEST['address'];
        $c=$_REQUEST['city'];
    }
    else
    {
        $msg="Please login first";
        header("location:login.php?msg=$msg"); 
    }
?>
<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="mycss.css">
    <!-- Bootstrap CSS -->

    <title>Task 3</title>
  </head>
  <body>
    <div id="navi">
            <div id="menu">
                <ul>
                    <li><a href="register.php">register</a></li>
                    <li><a href="login.php">login</a></li>
                </ul>
            </div> 
        </div>
    <br/>

    <?php
    if(!empty($e) && !empty($p))
    {
    ?>
    <table border="1">
        <tr>
            <th>Sr.n.</th>
            <th>Name</th>
            <th>Email</th>
            <th>Password</th>
            <th>Address</th>
            <th>City</th>
        </tr>
        <tr>
            <td>1</td>
            <td> <?php echo $n;?></td>
            <td> <?php echo $e;?></td>
            <td> <?php echo $p;?></td>
            <td> <?php echo $a;?></td>
            <td> <?php echo $c;?></td>
        </tr>
    </table>

    <?php
    }
    ?>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
 </body>
</html>