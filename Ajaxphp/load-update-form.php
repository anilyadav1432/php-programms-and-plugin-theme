<?php

$student_id=$_POST['id'];
include('connection.php');
$q="select * from students where id={$student_id}";
$res=mysqli_query($con,$q);

$output ="";
if(mysqli_num_rows($res)>0){
        while($row = mysqli_fetch_assoc($res))
        {
            $output .= "<tr>
                        <td>Name</td>
                        <td><input type='hidden' name='' id='edit-id' value='{$row['id']}' ><input type='text' name='' id='edit-name' value='{$row['name']}' ></td>
                    </tr>
                    <tr>
                        <td>Email</td>
                        <td><input type='email' name='' id='edit-email' value='{$row['email']}'></td>
                    </tr>
                    <tr>
                        <td>Password</td>
                        <td><input type='password' name='' id='edit-password' value='{$row['password']}'></td>
                    </tr>
                    <tr>
                        <td><input type='submit' name='' class='edit-submit'></td>
                    </tr>";
        }
        mysqli_close($con);

        echo $output;
}
else{
    echo "<h2>No Record Foound</h2>";
}
?>