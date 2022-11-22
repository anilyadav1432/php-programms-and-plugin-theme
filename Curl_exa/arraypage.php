<?php
$arr = array(
    array(
        'id'=>1,
        'name'=>"Anil",
        'role'=>"developer",
        'number'=>"9120313518"
    ),
    array(
        'id'=>2,
        'name'=>"Sunil",
        'role'=>"tester",
        'number'=>"8764342121"
    ),
    array(
        'id'=>3,
        'name'=>"Sonu",
        'role'=>"front end developer",
        'number'=>"6453425124"
    ),
);
$user_name = $_GET['name'];
// print_r($user_name);die;
$i=1;
foreach($arr as $val){
   if($val['name'] == $user_name)
   {
    echo $val['number']."<br/>";
    $temp = $val['number'];
   }
}
if(empty($temp)){
    echo "data not found";
}

?>
