<?php
if(isset($_POST['submit'])){

   
        $password=$_POST["password"];
        $email=trim($_POST["email"]);
        //ctype_upper()
        $check=preg_match("^[A-Z0-9_\+-]+(\.[A-Z0-9_\+-]+)*@[A-Z0-9-]+(\.[A-Z0-9-]+)*\.([A-Z]{2,4})$^", $email);
        
            class A
            {
                public function __call($fun,$arg)
                {
                    if($fun=="checkValid")
                    {
                        $c=count($arg);
                        // echo $c;
                        switch($c){
                            case 0:
                                echo "Welcome guest";
                            break;
                            case 1:
                                echo $arg[0];
                            break;
                            case 2:
                                echo "Your Email is ".$arg[0]." and your password ".$arg[1];
                            break;
                        }
                    }
                }

            }

            $ob=new A();
            if($password=="" && $email=="")
            {
                $ob->checkValid();
            }
            if($password!="" && $email=="")
            {
                $ob->checkValid("Your ".$password);
            }
            if($password=="" && $email!="")
            {
                if(!$check){
                    $errorMsg= 'error : Please Enter Capital Email.';
                    $code= "1";
                } 
                else{
                    $errorMsg= '';
                    $code= "1";
                    $ob->checkValid("Welcome ".$email);
                }
            }
            if($password!="" && $email!="")
            {
                if(!$check){
                    $errorMsg= 'error : Please Enter Capital Email';
                    $code= "1";
                    
                }elseif($check)
                {
                    $errorMsg= '';
                    $code= "1";
                    $ob->checkValid($email,$password);
                }   
            }        
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Task 7</title>
</head>
<body>
<div class="formDiv">
        <h1>Form</h1>
            <form action="" method="post" id="loginForm">
                <table>
                    <tr>
                        <th>Email </th>
                        <td><input type="text" id="email" name="email"><br/>
                            <span class="emailErr"><?php echo (isset($code))?($code==1?$errorMsg:""):""; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th>Password </th>
                        <td><input type="password" id="password" name="password"><br/>
                            <span class="passwordErr"><?php echo (isset($code))?($code==2?$errorMsg:""):""; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" name="submit">Submit</button></td>
                    </tr>
                </div>
            </form>
    </div>
</body>
</html>