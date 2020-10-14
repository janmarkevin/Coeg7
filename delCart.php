<?php 
include 'include/conn.php';
if(isset($_GET['del'])){
    $id = $_GET['del'];
    $sqlDel = mysqli_query($link, "DELETE from cart where c_id ='$id'");
    if ($sqlDel) {
        header("Refresh: 0; url = cart.php");
    }
}
?>