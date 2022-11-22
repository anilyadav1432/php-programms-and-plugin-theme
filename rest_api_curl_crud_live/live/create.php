<?php
include('token.php');
//$sqlRes = mysqli_query($conn, "SELECT * FROM employee");
$name = $email = $phone = "";
//echo "ok";
if (!isset($status)) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $phone = mysqli_real_escape_string($conn, $_POST['phone']);
    if (isset($_POST['name'])) {
        if (mysqli_query($conn, "insert into employee (name, email, phone) values ('$name', '$email', '$phone')")) {
            $status = 'true';
            $data  = "Data inseted";
            $code  = '10';
        } else {
            $status = 'true';
            $data  = "Data not inserted";
            $code  = '9';
        }
    }
}

echo  json_encode(['status' => $status, 'data' => $data, 'code' => $code]);
