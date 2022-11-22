<?php

if(isset($_POST['emp_id'])){
    if(!empty($_POST['emp_id'])){
        include 'connection.php';
        $query1 = "select * from register where id= '{$_POST['emp_id']}'";
        $tbl_data   = mysqli_query($con,$query1);
        $row = $tbl_data->fetch_assoc();
        echo json_encode($row);
    }
}