<?php
include 'connection.php';
    $query1 = "select * from register";
    $tbl_data   = mysqli_query($con,$query1);
    echo "<table class='table table-success table-striped'><tr><th>Name</th><th>Mobile</th><th>Address</th></tr>";
    if($tbl_data->num_rows>0){
        while($row = $tbl_data->fetch_assoc()) {
            ?>
            <tr>
                <td><?php echo $row['name'];?></td>
                <td><?php echo $row['mobile'];?></td>
                <td><?php echo $row['address'];?></td>
            </tr>     
        <?php
        }
        echo " </table>";
    }else{
        echo "error";
    }

?>