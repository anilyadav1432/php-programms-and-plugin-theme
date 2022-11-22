<?php
session_start();
unset($_SESSION['admin']);
session_destroy();
$msg="Succesfully logout";
header("location:../login.php?msg=$msg");
?>