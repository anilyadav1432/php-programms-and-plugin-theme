<?php
  session_start();

    unset($_SESSION['user']);
    session_destroy();
    $msg="Error:Succesfully logout";
    header("location:login.php?msg=$msg");
?>