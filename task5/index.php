<?php

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="index.css">
    <title>Task 5</title>
</head>
<body>
  <div class="mainDiv">
    <h1>Concept of class ,Method , constructor And Inheritance</h1>
    <div id="boxDiv">
      <?php
        // echo "hii";
        class Vehicles
        {
          public $max_speed;
          public $mileage;
          function run()
          {
            echo "Vehicle max-speed is ".$this->max_speed."<br/>";
            echo "<br/>Vehicle mileage is ".$this->mileage."<br/>";
            echo "Vehicle color is ".$this->color."<br/>";

          }
          // Constructor
          function __construct($max_speed,$mileage)
          {
            $this->max_speed = $max_speed;
            $this->mileage = $mileage;
          }
        }
        class Bus extends Vehicles
        {
          public $color="blue";
          function __construct($max_speed,$mileage,$color)
          { 
            parent::__construct($max_speed,$mileage);
          }
          
        }
        $ob1=new Bus(100,40,"red");
        
        $ob1->run();
       
      ?>
    </div>
</div>
    
</body>
</html>