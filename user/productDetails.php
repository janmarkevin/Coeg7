<?php 
session_start();
include_once "../include/conn.php";

$id = $_SESSION['u_id'];
$name = $_SESSION['u_name'];
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Product Details</title>
    </head>
    <body>
    <a href="cart.php?id=<?php echo $id ?>" >
             my cart(<?php $sqlcart = mysqli_query($link,"SELECT count(*) as c_id  from cart where u_id='$id'");
            while ($rowc = mysqli_fetch_array($sqlcart)) {
                echo $rowc['c_id'];
            } ?>)</a>

        <?php echo $_SESSION['u_name']; 
        
        if (isset($_GET['id'])) {
            $p_id = $_GET['id'];
            $user = $_GET['user'];
            $sqlGet= mysqli_query($link,"SELECT * from products where p_id='$p_id'");
            while ($row = mysqli_fetch_assoc($sqlGet)) {
                ?>
                <br>
                <form action="productDetails.php" method="post">
                    
                </form>
                <img class="item" src="../include/image/product/<?php echo $row['p_image'] ?>" alt="" srcset="">
                <p>name: <?php echo $row['p_name'] ?></p>
                <p>details: <?php echo $row['p_details'] ?></p>
                <p>Price: <?php echo $row['p_price'] ?></p>
                <form action="productDetails.php" method="post">
                    <input type="hidden" name="userId" value="<?php echo $user ?>">
                    <input type="hidden" name="pId" value="<?php echo $p_id ?>">
                    <button name="cart">Add to cart</button>    
                </form>
                <?php
            }
        }

        if (isset($_POST['cart'])) {
            $userID = $_POST['userId'];
            $pID = $_POST['pId'];
            $sqlInsert = mysqli_query($link,"INSERT INTO cart (c_id,u_id,p_id) values ('','$userID','$pID')");
            if($sqlInsert){
                header("location: productDetails.php");
                exit();
            } else {
                echo "error!";
            }
        }
        ?>
        
    </body>
    </html>

    <style>
        .item{
            width: 10rem;
        }
    </style>