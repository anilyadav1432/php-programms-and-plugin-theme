<?php
include('token.php');
//$sqlRes = mysqli_query($conn, "SELECT * FROM employee");
$name = $email = $phone = "";
//echo "ok";
if (!isset($status)) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    if (isset($_POST['id']) && isset($_POST['id']) > 0) {
        if (mysqli_query($conn, "update  employee set name = '$name', email = '$email', phone = '$phone' where id = '$id'")) {
            $status = 'true';
            $data  = "Data updated";
            $code  = '10';
        } else {
            $status = 'true';
            $data  = "Data not inserted";
            $code  = '9';
        }
    }
}

echo  json_encode(['status' => $status, 'data' => $data, 'code' => $code]);
