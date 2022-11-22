<?php
include 'connection.php';
$name = $_POST['name'];
$mobile = $_POST['mobile'];
$address = $_POST['address'];
// echo $name,$mobile,$address;
$query = "insert into register(name,mobile,address) values('$name','$mobile','$address')";
$res   = mysqli_query($con,$query);
if($res>0){
    $query1 = "select * from register";
    $tbl_data   = mysqli_query($con,$query1);
    echo "<table class='table table-success table-striped'><tr><th>Name</th><th>Mobile</th><th>Address</th><th>Action</th></tr>";
    while($row = $tbl_data->fetch_assoc()) {
        ?>
        <tr>
            <td><?php echo $row['name'];?></td>
            <td><?php echo $row['mobile'];?></td>
            <td><?php echo $row['address'];?></td>
            <td><a href="delete.php?id=<?php echo $row['id']; ?>" class="btn btn-success">Delete</a></td>
        </tr>     
    <?php
    }
    echo " </table>";
}else{
 echo "error";
}

?>