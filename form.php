<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="include/css/style.css">
    <title>Login</title>
</head>
<body>
    <?php 
        if(isset($_GET['login'])){
            $login = $_GET['login'];
            if ($login == 'invalidUser') {
                echo "invalid username";
            }
            elseif ($login == 'password') {
                echo "wrong password";
            }
            elseif($login == 'empty'){
                echo "Please fill out all the fields!";
            }
        }
    ?>
    <form action="include/include.php" method="POST">
        <?php 
            if (isset($_GET['username'])) {
                echo '<input placeholder="Enter username" name="username" type="text" value ="'.$_GET['username'].'">';
            } else {
                echo '<input placeholder="Enter username" name="username" type="text">';
            }
        ?>
        <input placeholder="Enter password" name="pwd" type="password">
        <button name="login">Submit</button>
        <br>
        <a href = "pwdverify.html">Forgot Password</a><br>
        <a href = "reg.php">Register</a>
    </form>
    
</body>
</html>