<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
</head>
<body>
    <?php 
    include_once 'include/conn.php';
        if(isset($_GET['reg'])){
            $reg = mysqli_real_escape_string($link,$_GET['reg']);
            if ($reg == "email") {
                echo "<p class ='error'>Invalid Email</p>";
            }
            elseif ($reg == "emailTaken") {
                echo "<p class ='error'>Email Taken</p>";
            }
            elseif ($reg == "username") {
                echo "<p class ='error'>Username Taken</p>";
            }
            elseif ($reg == "fill") {
                echo "<p class ='error'>Please fill out all the fields</p>";
            }
            elseif ($reg == "password") {
                echo "<p class ='error'>Password not match!</p>";
            }
        }
    ?>
    <form action ="email.php" method="POST">
        <?php 
        //first name
            if (isset($_GET['first'])) {
                echo '<input name = "fname" placeholder="First name" type="text" value ="'.$_GET['first'].'">';
            } else {
                echo '<input name = "fname" placeholder="First name" type="text">';
            }

        //last name
            if (isset($_GET['last'])) {
                echo '<input name = "lname" placeholder="last name" type="text" value ="'.$_GET['last'].'">';
            } else {
                echo '<input name = "lname" placeholder="Last name" type="text">';
            }

        //email
            if(isset($_GET['email'])){
                echo '<input name = "email" placeholder="Email" type="text" value="'.$_GET['email'].'">';
            } else {
                echo '<input name = "email" placeholder="Email" type="text">';
            }

        //Number
            if(isset($_GET['number'])){
                echo '<input name="number"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number" value="63"
                maxlength = "12" value="'.$_GET['number'].'"
             />';
            } else {
                echo '<input name="number"
                oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
                type = "number" value="63"
                maxlength = "12"
             />';
            }
        //address
            if (isset($_GET['address'])) {
                echo '<input name = "address" placeholder="Address" type="text" value="'.$_GET['address'].'">';
            } else {
                echo '<input name = "address" placeholder="Address" type="text">';
            }
        //username
            if (isset($_GET['username'])) {
                echo '<input name = "username" placeholder="Username" type="text" value="'.$_GET['username'].'">';
            } else {
                echo '<input name = "username" placeholder="Username" type="text">';
            }
        ?>
        <!--
        <input name = "fname" placeholder="First name" type="text">
        <input name = "lname" placeholder="Last name" type="text">
        <input name = "email" placeholder="Email" type="text">
        <input name="number"
    oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);"
    type = "number" value="63"
    maxlength = "12"
 />
        <input name = "address" placeholder="Address" type="text">
        <input name = "username" placeholder="Username" type="text"> -->
        <input name = "password" placeholder="Password" type="password">
        <input name = "cpassword" placeholder="Re-enter Password" type="password"> 
        <br>
        <button name = "register" type="submit">Submit</button>
        <br>
        <a href="email.php">Already have an account</a>
    </form>
</body>
</html>

<?php 
if (isset($_POST['register'])) {
    $first = $_POST['fname'];
    $last = $_POST['lname'];
    $email = $_POST['email'];
    $number = $_POST['number'];
    $add = $_POST['address'];
    $user = $_POST['username'];
    $pwd = $_POST['password'];
    $pwd1 = $_POST['cpassword'];
    
    date_default_timezone_set("Asia/Manila");
    $d = strtotime("Now");
    $time = date("Y-m-d H:i:s, $d");
    
    $unq = strtoupper(substr(md5(time().rand(10000,99999)),0, 4));

    if ($pwd != $pwd1) {
        header("location: email.php?WrongPasswod!");
    } else{
        $sql = mysqli_query($link, "INSERT INTO user (u_id,u_username,u_password,u_email,u_address,u_number,u_firstname,u_lastname,date_created,date_updated,verify) VALUES ('','$user','$pwd','$email','$add','$number','$first','$last',$time','','$unq');");
        if ($sql) {
            header("location: email.php?Success!");
        } else {
            header("location: email.php?Failed!");
        }
    }
    
}
?>