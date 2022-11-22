<?php
include('connection.php');
$q="select * from students";
$res=mysqli_query($con,$q);

$output ="";
if(mysqli_num_rows($res)>0){
$output = '<table border="1" cellspacing="0" cellpadding="10px">
            <tr>
                <th>Id</th>
                <th>Name</th>
                <th>Email</th>
                <th>Password</th>
                <th>Edit</th>
                <th>Delete</th>
            </tr>';
        while($row = mysqli_fetch_assoc($res))
        {
            $output .= "<tr><td>{$row["id"]}</td><td>{$row["name"]}</td><td>{$row["email"]}</td><td>{$row["password"]}</td><td><button class='edit_btn' data-eid='{$row["id"]}'>Edit</button></td><td><button class='delete_btn' data-id='{$row["id"]}'>Delete</button></td></tr>";
        }
        $$output = "</table>";
        mysqli_close($con);

        echo $output;
}
else{
    echo "<h2>No Record Foound</h2>";
}
?>