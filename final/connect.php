<?php
 $server="localhost";
 $user="root";
 $pass="";
 $db="test";
 $conn=new mysqli($server,$user,$pass,$db);
 if($conn->connect_error){
     echo "connection error";
 }


?>