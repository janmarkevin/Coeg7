<?php include 'header.php'; ?>


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
    <form action ="include/include.php" method="POST">
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
        <input name = "password" placeholder="Password" type="password">
        <input name = "cpassword" placeholder="Re-enter Password" type="password"> 
        <br>
        <button name = "register" type="submit">Submit</button>
        <br>
        <a href="form.php">Already have an account</a>
    </form>
</body>
</html>


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
    }
    form{
     border: 1px solid #DADCE0;
     border-radius: .7rem;
     background-color: white;
     width: 25rem;
     padding: 2rem;
     display: flex;
     flex-direction: column;
     justify-content: center;
     align-items: center;
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
        margin-bottom: .8rem;
        margin-top: 2rem;
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