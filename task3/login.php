<?php
    if(!empty(isset($_POST['submit'])))
    {
        $email=$_POST['email'];
        $password=$_POST['password'];
        if($email!="" || $password!="")
        {
            // $arr2=array();
            // $arrData="email:$email,password=>$password";
            // $arr1=json_encode($arrData);
            // print_r($arr1); die(); 
            $getArr=fopen("datafile.txt","r");
            $newvar=fread($getArr,filesize("datafile.txt"));
            $newdata=explode(",",$newvar);
            // print_r($newdata); die();
            // $newdata1=
            $chk="false";
            for($i=0;$i<count($newdata);$i++){ 
                
                $dd=explode(":",$newdata[$i+1]); //for email
                // print_r($dd[1]); die();
                if($email==$dd[1])
                {
                    $dd1=explode(":",$newdata[$i+2]); //for password
                    // print_r($dd1[1]); die();
                    if($password==$dd1[1])
                    {
                        // print_r($dd[1]); die();
                        $nameD=explode(":",$newdata[$i]); //for name
                        $name=$nameD[1];
                        $addressD=explode(":",$newdata[$i+3]); //for address
                        $address=$addressD[1];
                        $cityD=explode(":",$newdata[$i+4]); //for address
                        $city=$cityD[1];
                        $chk="true";
                        break;
                    }
                }

            }

            if($chk=="true")
            {
                header("location:welcome.php?email=$email&password=$password&name=$name&address=$address&city=$city");
            }
            else
            {
                $msg="user not register";
                header("location:login.php?msg=$msg");
            }
           
            // die();
            
        }
        else
        {
            echo "<script>alert('All Field is required')</script>";
        }
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
                    <li><a href="welcome.php">display</a></li>
                </ul>
            </div> 
        </div>
    <br/>
    <div class="formDiv">
        <h1>Login Form</h1>
        <span><?php if(!empty($_REQUEST['msg'])){echo $_REQUEST['msg'];}else{echo " ";}?></span>
            <form action="" method="post" id="loginForm">
                <table>
                    <tr>
                        <th>Email </th>
                        <td><input type="email" id="email" name="email"><br/><span class="emailErr"></span></td>
                    </tr>
                    <tr>
                        <th>Password </th>
                        <td><input type="text" id="password" name="password"><span class="passwordErr"></span></td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" name="submit">Submit</button></td>
                    </tr>
                </div>
            </form>
    </div>
    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <!-- <script src="login.js"></script> -->
 </body>
</html>