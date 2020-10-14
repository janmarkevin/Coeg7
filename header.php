<?php 
include 'include/conn.php';
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="include/css/products.css">
    <title>COEG7</title>
</head>
<body>

<nav class="header_color">
        <div class="all_margin">
            <nav class="flex_nav">
                <div class="logoo">
                    <img src="include/image/icon/logo.png" class="logo_header">
                    <p>COEG-7</p>
                </div>
                    <ul class="flex_nav">
                            <li><a href="index.php" class="active">Home</a></li>
                            <li><a href="products.php">Product</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">contact</a></li>
                            <li><a href="blog.php">Blog</a></li>
                            <?php 
                                if (isset($_SESSION['u_name'])==null && isset($_SESSION['u_id'])==null) {
                                 ?>
                                 <li><a href="login.php">Login</a></li>
                                 <?php   
                                } else {
                                    $id = $_SESSION['u_id'];
                                    $user=mysqli_query($link,"SELECT * from user where u_id='$id'");
                                    if ($row=mysqli_fetch_assoc($user)) {
                                    ?>
                                        <li class="dropdown" >
                                            <img src="include/image/icon/user1.png" alt="" onclick="myFunction()" class="dropbtn">
                                            <p><?php echo $row['u_username'] ?></p>
                                            <div  id="myDropdown" class='dropdown-content'>
                                                <a href="logout.php">Profile</a>
                                                <a href="#">My Order</a>
                                                <a href="user/logout.php">Logout</a>
                                            </div>
                                        </li>
                                    <?php  
                                    }
                                }
                            ?>
                    </ul>
            </nav>
        </div>
</nav>

<script>
/* When the user clicks on the button, 
toggle between hiding and showing the dropdown content */
function myFunction() {
  document.getElementById("myDropdown").classList.toggle("show");
}

// Close the dropdown if the user clicks outside of it
window.onclick = function(event) {
  if (!event.target.matches('.dropbtn')) {
    var dropdowns = document.getElementsByClassName("dropdown-content");
    var i;
    for (i = 0; i < dropdowns.length; i++) {
      var openDropdown = dropdowns[i];
      if (openDropdown.classList.contains('show')) {
        openDropdown.classList.remove('show');
      }
    }
  }
}
</script>
