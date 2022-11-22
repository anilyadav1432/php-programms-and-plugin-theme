<?php
include('token.php');
$sqlRes = mysqli_query($conn, "SELECT * FROM employee");
if (!isset($status)) {
    if (mysqli_num_rows($sqlRes) > 0) {
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

echo $result =  json_encode(['status' => $status, 'data' => $data, 'code' => $code]);
