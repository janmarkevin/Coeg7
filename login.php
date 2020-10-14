<?php include 'header.php'; 

?>

<main>
    <form action="include/include.php" method="POST">
    <div class="logo">
        <a href="index.php"><img src="include/image/icon/logo.png"></a>
        <h2>Login</h2>
    </div>
    <div class="input">
        <?php 
            if (isset($_GET['username'])) {
                echo '<input placeholder="Enter username" name="username" type="text" value ="'.$_GET['username'].'">';
            } else {
                echo '<input placeholder="Enter username" name="username" type="text">';
            }
        ?>
        <?php 
        if(isset($_GET['login'])){
            $login = $_GET['login'];
            if ($login == 'invalidUser') {
                echo "<p class='error'>invalid username</p>";
            }
        }
    ?>
        <input type="hidden" name="type" value='<?php echo $_GET['NeedLogin'] ?>'>
        <input placeholder="Password" name="pwd" type="password">
        <?php 
            if(isset($_GET['login'])){
            if($login == 'password') {
                echo "<p class='error'>wrong password</p>";
            } } ?>
    </div>
    <a href="pwdverify.php" class="forgot">Forgot Password</a>
        <?php
        if(isset($_GET['login'])){
            if($login == 'empty'){
                echo "<p class='error empty'>Please fill out all the fields!</p>";
            } 
        }
        ?>

    <div class="logreg">
        <a href="reg.php">Create account</a>
        <button type="submit" name="login">Submit </button>
    </div>
       </form>
</main>       

<?php include 'footer.php'; ?>
<style>
    .logreg{
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-top: 2rem;
}
.logreg button{
    width: 35%;
}
    *{
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }
    main{
        display: flex;
        justify-content: center;
        align-items: center;
        margin: 3rem 0;
    }
    form{
     border: 1px solid #DADCE0;
     border-radius: .7rem;
     background-color: white;
     width: 25rem;
     padding: 2rem;
    }
    .logo{
        text-align: center;
    }
    .logo img {
        width: 5rem;
        margin-bottom: 1rem;
    }
    h2{
        font-weight: 100;
    }
    .input{
        display: flex;
        flex-direction: column;
    }
    .input input:first-of-type{
        margin: 1rem 0 .5rem;
    }
    .input input:last-of-type{
        margin-bottom: .5rem;
    }
    .input input{
        padding: .7rem .8rem;
        font-size: 1rem;
        color: #5C5D5F;
        border: .5px solid #DADCE0;
        border-radius: 3px;
    }
    .input input:focus{
        border: .5px solid #728D3C;
        outline-color: #728D3C;
    }

    button{
        width: 100%;
        padding: .7rem 0;
        margin: .3rem 0;
        font-weight: bold;
        color: white;
        background-color: green;
        border: 0;
        cursor: pointer;
    }

    a{
    text-decoration: none;
    color: blue;
    }
    .error{
        color: red;
        font-size: .8rem;
    }
    .empty{
        margin-top: .8rem;
        text-align: center;
    }
</style>