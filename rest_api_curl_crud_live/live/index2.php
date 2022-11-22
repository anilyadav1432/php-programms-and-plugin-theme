<?php
 include('db.php');
 $sql = "SELECT * FROM employee";

 $res = mysqli_query($conn, $sql);

 $count = mysqli_num_rows($res);
 header('Content-Type:application/json');

if($count>0){
    while($row = mysqli_fetch_assoc($res))
    {
        $arr[] = $row;
    }
    $result =  json_encode(['status'=>'true', 'data'=>$arr, 'result' => 'found' ]);
    echo $result;
}
else{
    echo $result =  json_encode(['status'=>'false', 'data'=>'No data found', 'result' => 'not' ]);
}
?>