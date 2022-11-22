<?php
$state=$_POST['state'];
$cityData ="";
// echo $state;
$ch=curl_init();
$url="https://raw.githubusercontent.com/thatisuday/indian-cities-database/master/cities.json";
curl_setopt($ch,CURLOPT_URL,$url);
curl_setopt($ch, CURLOPT_RETURNTRANSFER,true);

$resp = curl_exec($ch);

if($e = curl_error($ch))
{
    echo $e;
}
else
{
    $decoded= json_decode($resp, true);
    // print_r($decoded);
    $cityData ="<option value=' '>select city </option>";
    foreach($decoded as $key1=>$val1)
    {
        // print_r($val1); die();
        if($val1['state'] == $state)
        {
            $cityData .='<option value="'.$val1["city"].'">'.$val1["city"].'</option>';
        }
    }
    echo $cityData;
}
curl_close($ch);



?>