<?php
   if(!empty(isset($_POST['submit'])))
    {
        $h=empty($_POST['height']) ? 0:$_POST['height'];
        $w=empty($_POST['width']) ? 0:$_POST['width'];
        // echo $h,$w; die();

        // Validation on server site
        if(!filter_var($h,FILTER_VALIDATE_INT) && !filter_var($w,FILTER_VALIDATE_INT))
        {
            $height= "please enter valid value of Height"; 
            $width= "please enter valid value of Width";
        }
        else if(!filter_var($w,FILTER_VALIDATE_INT) && filter_var($h,FILTER_VALIDATE_INT))
        {
            $width= "please enter valid value of Width";
        }
        else if(filter_var($w,FILTER_VALIDATE_INT) && !filter_var($h,FILTER_VALIDATE_INT))
        {
            $height= "please enter valid value of height";
        }
        else
        {
            header("location:oneCode.php?h=$h&w=$w");  //This is my query string
        }
                
    }
?>

<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href="one.css">
    <title>BMI Task1</title>
  </head>
  <body>
    <div class="containerDiv">
        <h1>BMI Calculation</h1>
        <div class="formDiv">
            <form id="myForm" action="" method="post">
                <table border="1">
                    <tr>
                        <th for="height">Height</th>
                        <td>
                            <input type="text" id="height" name="height"><br/>
                            <span id="heightErr"><?php echo (isset($height))?$height:""; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <th for="width">Weight</th>
                        <td>
                            <input type="text" name="width" id="width"><br/>
                            <span id="widthErr"><?php echo (isset($width))?$width:""; ?></span>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="2"><button type="submit" name="submit">Submit</button></td>
                    </tr>
                </table>    
            </form>
            
        </div>
    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="one.js"></script>
  </body>
</html>