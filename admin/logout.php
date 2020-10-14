<?php 
session_start();
session_destroy();

unset($_SESSION['a_username']);
unset($_SESSION['a_id']);

header("location: ../index.php");
?>