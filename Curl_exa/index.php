<?php
echo "please type in url like '?name=Anil' then u will get result<br/>";
    $ch = curl_init();
    
    if(isset($_GET['name'])){
        $name = $_GET['name'];
        // print_r($_GET);
        $url = "http://localhost/php_programs/Curl_exa/arraypage.php";
        $ch=curl_init($url);
        // curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        // curl_setopt($ch, CURLOPT_POSTFIELDS, array("name"=>"Anil"));
        curl_setopt($ch, CURLOPT_URL, $url.'?name='.$name);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

        $result = curl_exec($ch);
        curl_close($ch);
        echo $result;
    }

    ?>