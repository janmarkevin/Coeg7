<?php
include 'include/conn.php';
session_start();

if (isset($_GET['id'])) {
    $user_id = $_SESSION['u_id'];
    $p_id = $_GET['id'];

    $sqlCartAdd = mysqli_query($link, "INSERT INTO cart (c_id,u_id,p_id) values ('','$user_id','$p_id')");
    if ($sqlCartAdd) {
        header('location: products.php');
    } else {
        echo "error!";
    }
}
?>