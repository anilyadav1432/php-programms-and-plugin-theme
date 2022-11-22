<?php
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="mycss.css">
    <title>Login Page</title>
</head>
<body>
    <div class="outer">
    <div class="subouter">
        <!-- For menu code here -->
        <div class="mainu">
            <ul>
                <li><a href="register.php">registration</a></li>
                <li><a href="login.php">login</a></li>
            </ul>
        </div>
        <div class="formDiv">
        <h1>Login Form</h1>
            <p><?php echo isset($_REQUEST['msg'])?$_REQUEST['msg']:"";?></p>
            <form action="loginCode.php" id="formID" method="post">
                <table>
                    <tr>
                        <th>email</th>
                        <td><input type="text" name="email" id="email"><br/><span id="emailErr"><?php echo isset($_REQUEST['ee'])?$_REQUEST['ee']:"";?></span></td>
                    </tr>
                    <tr>
                        <th>password</th>
                        <td><input type="password" name="password" id="password"><br/><span id="passwordErr"><?php echo isset($_REQUEST['pe'])?$_REQUEST['pe']:"";?></span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit">Login</button></td>
                    </tr>
                </table>
            </form>
        </div>
    </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="login.js"></script>
</body>
</html>