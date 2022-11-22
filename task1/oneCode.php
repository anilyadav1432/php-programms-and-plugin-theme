<?php

    $h=empty($_REQUEST['h']) ? 0:$_REQUEST['h'];
    $w=empty($_REQUEST['w']) ? 0:$_REQUEST['w'];
    $index=0;
    // echo $h,$w; die();
    // echo "$index";
    $bmi="";
        $index=round($w/($h*$h)* 703,2);
    
        if ($index < 18.5){
            $bmi="underweight BMI Result : ".$index;
            
        } else if ($index < 25){
            $bmi="normal BMI Result : ".$index;
            
        } else if ($index < 30){
            $bmi="overweight BMI Result : ".$index;  
            
        } else {
            $bmi="obese BMI Result : ".$index;
        }
    echo $bmi;
            

?>