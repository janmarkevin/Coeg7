<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="include/css/login.css">
    <title>Change Password</title>
</head>
<body>
    <form action="include/include.php" method="POST">
    <div class="logo">
        <img src="include/image/icon/logo.png">
        <h2>Change password</h2>
    </div>
    <!--Body content-->
    <div class="input">
        <input type="password" name="pwd" placeholder="Enter password">
        <input type="password" name="cpwd" placeholder="Re-enter password">
        <input type="hidden" name="username" value="<?php echo $_SESSION['u_id'] ?>">
    </div>
    <div class="logreg">
        <button type="submit" name="changePassword">Submit</button>
    </div>
       </form>
</body>
</html>