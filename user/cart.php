<?php
session_start();
include_once '../include/conn.php';

if (isset($_SESSION['u_id']) == null) {
    header("location ../login.php");
} else{
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="../include/css/products.css">
        <title>Cart</title>
    </head>
    <body>
    <header>
    <nav class="header_color">
        <div class="all_margin">
            <nav class="flex_nav">
                <img src="../include/image/icon/logo.png" class="logo_header">
                    <ul class="flex_nav">
                            <li><a href="../index.php">Home</a></li>
                            <li><a href="../products.php">Product</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">contact</a></li>
                            <li><a href="logout.php">Logout</a></li>
                    </ul>
            </nav>
        </div>
    </nav>
    </header>
    <div class="all_margin">
        <h2 style="font-weight: 300">My cart</h2>
        <div class="two_columns">
            <div class="first">
            <?php
            include_once '../include/conn.php';
            $id = $_SESSION['u_id'];
            $sql= mysqli_query($link,"SELECT * from cart,products,user where cart.p_id=products.p_id and user.u_id=cart.u_id and cart.u_id='$id'");
            $num = mysqli_num_rows($sql);
            $total = 0;
            $place = "";
            $i = 0;
            while($row = mysqli_fetch_assoc($sql)){
                    ?>      
                    
                        <div class="item">
                                <img src="../include/image/product/<?php echo $row['p_image'] ?>" class='picture'>
                                <div class="item_details">
                                    <p><?php echo $row['p_name'] ?></p>
                                    <p>&#8369;<?php echo $row['p_price'] ?></p>
                                        <div class="button">
                                            <button>Delete</button>
                                            <button>Add to cart</button>
                                            <?php echo "<a href=cart.php?del=$id>Delete</a>" ?>
                                        </div>
                                </div>
                        </div>
                        
                    <?php      
                    $total += $row['p_price'];
                    $place = $row['u_address'];
            }
            if ($num == 0) {
                echo "there are no item in this cart!";
            }
        ?>
            </div>
            <div class="second">
                <?php     
                echo "<p>location:</p>
                        ".$place."\t <a href='#'>Change</a>
                        <hr>
                    <p>Order summary</p>";
                ?>
                <p>sub total (<?php
                $sqlcart = mysqli_query($link,"SELECT count(*) as c_id  from cart where u_id='$id'");
                while($rows = mysqli_fetch_assoc($sqlcart)){
                        echo $rows['c_id'];
                }  ?>)</p>
                <?php
                echo "Total amount: ".number_format($total); ?>
            </div>
        </div>
        </div>
</body>
</html>

    <?php
}
?>


    <style>
        .first {
            width: 60%;
        }
        .second{
            width: 30%;
        }
        .second {
            background-color: #EFF0F5;
        }
        .two_columns{
            display: flex;
            justify-content: space-between;
        }
    *{
        box-sizing: border-box;
    }
    .item{
        background-color: #EFF0F5;
        margin-left: 1.5rem;
        margin-bottom: 1.5rem;
        display: flex;
    }
    .picture{
        width: 12rem;
        height: 12rem;
        display: block;
        object-fit: cover;
    }
    .item_details{
        padding: .5rem;
    }

    .item_details p:last-of-type{
        font-size: 1.5rem;
        color: #BB7229;
        margin: .5rem 0;
    }

    .item_details button:first-of-type{
    background-color: #728D3C;
    color: white;
    border: none;
    padding: .5rem .7rem;
    }

    .item_details button:last-of-type{
    background-color: #BB7229;
    color: white;
    border: none;
    padding: .5rem .7rem;
    }
    .button{
        text-align: center;
    }
</style>