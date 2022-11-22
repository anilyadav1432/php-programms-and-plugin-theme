<?php
  session_start();

    unset($_SESSION['user']);
    session_destroy();
    $msg="Succesfully logout";
    header("location:login.php?msg=$msg");
?>