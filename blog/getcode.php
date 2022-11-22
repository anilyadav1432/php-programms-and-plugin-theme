<?php
include('connection.php');
$q2="select * from comment order by c_id desc";
$res2=mysqli_query($con,$q2);
if($res2->num_rows>0){
    $p="";
    while($row2=mysqli_fetch_assoc($res2)){
        $t=explode(" ",$row2['create_at']);
        $p.="<b>".$row2['name']."</b> ".$row2['email']." ".$t[1]."<br/>".$row2['message']."<hr>";
    }
    echo $p;
}


?>