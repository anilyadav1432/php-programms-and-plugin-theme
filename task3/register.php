<?php
    if(!empty(isset($_POST['submit'])))
    {
        $name=$_POST['name'];
        $email=$_POST['email'];
        $password=$_POST['password'];
        $address=$_POST['address'];
        $city=$_POST['city'];
        // echo $name,$email,$password,$address,$city;
        
        if($name!="" || $email!="" || $password!="" || $address!="" || $city!="")
        {
            $arrData="name:$name,email:$email,password:$password,address:$address,city:$city";
            // $arrData=array("name"=>$name,"email"=>$email,"password"=>$password,"address"=>$address,"city"=>$city);
            $arr1=json_encode($arrData);
            // print_r($arr1); die(); 
            $filedata=fopen("datafile.txt","a");
            $res=fwrite($filedata,$arrData);
            fwrite($filedata,",");
            if($res>0)
            {
                echo "<script>alert('Successfully Saved');window.location.href='login.php';</script>";
            }
            else
            {
                echo $res;
                echo "<script>alert('Successfully Saved')</script>";
            }
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
        

        <h1>Registration Form</h1>
            <form action="" method="post" id="myform">
                <table>
                    <tr>
                        <th>Name </th>
                        <td><input type="text" id="name" name="name"><br/><span class="nameErr"></span></td>
                    </tr>
                    <tr>
                        <th>Email </th>
                        <td><input type="email" id="email" name="email"><br/><span class="emailErr"></span></td>
                    </tr>
                    <tr>
                        <th>Password </th>
                        <td><input type="text" id="password" name="password"><span class="passwordErr"></span></td>
                    </tr>
                    <tr>
                        <th>Address</th>
                        <td><textarea name="address" placeholder="Leave a Address here" id="address"></textarea><br/><span class="addressErr"></span></td>
                    </tr>
                    <tr>
                        <th>City</th>
                        <td>
                        <select name="city" id="city">
                            <option value="">Please select City</option>
                            <option value="mau">Mau</option>
                            <option value="lucknow">Lucknow</option>
                            <option value="varanasi">Varanasi</option>
                        </select><br/><span class="cityErr"></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" name="submit">Submit</button></td>
                    </tr>
                </div>
            </form>
    </div>

    

    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="register.js"></script>
 </body>
</html>