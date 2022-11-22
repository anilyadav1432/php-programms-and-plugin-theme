<?php
include('token.php');
//$id = $_GET['id'];
if (!isset($status)) {
    $id = mysqli_real_escape_string($conn, $_POST['id']);
    if (isset($_POST['id']) && isset($_POST['id']) > 0) {
        $sqlRes = mysqli_query($conn, "SELECT * FROM employee WHERE id='$id'");
        if ($sqlRes) {
            $data = [];
            while ($row = mysqli_fetch_assoc($sqlRes)) {
                $data[] = $row;
            }
            $status = 'true';
            $code  = '5';
        } else {
            $status = 'true';
            $data  = "Data Not found";
            $code  = '4';
        }
    }
}

echo $result =  json_encode(['status' => $status, 'data' => $data, 'code' => $code]);
