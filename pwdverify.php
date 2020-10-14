<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="include/css/login.css">
    <title>Login</title>
</head>
<body>
    <form action="include/include.php" method="POST">
    <div class="logo">
        <img src="include/image/icon/logo.png">
        <h2>Forgot password</h2>
    </div>
    <div class="input">
        <?php 
            if (isset($_GET['user'])) {
                echo '<input type="text" name="username" placeholder="Usename" value="'.$_GET['user'].'">';
            } else {
                echo '<input type="text" name="username" placeholder="Usename">';
            }
            
            //error for username
            if (isset($_GET['ver'])) {
                $id = $_GET['ver'];
                if ($id == "UsernameInvalid") {
                    echo "<p class='error' style='margin-top: -.5rem;'>Invalid Username</p>";
                }
            }
            
            if (isset($_GET['email'])) {
                echo '<input type="text" name="email" placeholder="E-mail" value="'.$_GET['email'].'"> ';
            } else {
                echo '<input type="text" name="email" placeholder="E-mail">';
            }

            //error for email or empty
            if (isset($_GET['ver'])) {
                $id = $_GET['ver'];
                if ($id == "empty") {
                    echo "<p class='error' style='text-align: center; margin-top: .5rem;'>Fill out all the fields!</p>";
                }
                elseif ($id == "EmailInvalid"){
                    echo "<p class='error' style='margin-top: .5rem;'>Invalid Email</p>";
                }
            }
        ?>
    </div>
    <div class="logreg">
        <a href="login.php">Back</a>
        <button type="submit" name="chngPass">Submit </button>
    </div>
       </form>
</body>
</html>