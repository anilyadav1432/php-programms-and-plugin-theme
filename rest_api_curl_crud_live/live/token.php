<?php
include('db.php');
header('Content-Type:application/json');

if (isset($_GET['token'])) {
   $token = mysqli_real_escape_string($conn, $_GET['token']);
   $checkTokenRes = mysqli_query($conn, "select * from api_tokens WHERE token = '$token'");
   if (mysqli_num_rows($checkTokenRes) > 0) {
      $checkTokenRow = mysqli_fetch_assoc($checkTokenRes);
      if ($checkTokenRow['status'] == 1) {
      } else {
         $status = 'true';
         $data  = "API token deactivated";
         $code  = '3';
      }
   } else {
      $status = 'true';
      $data  = "Please provide valid API token";
      $code  = '2';
   }
} else {
   $status = 'true';
   $data  = "Please provide API token";
   $code  = '1';
}
 //echo  json_encode(['status'=>$status, 'data'=>$data, 'code' => $code ]);
