<?php 
include_once "include/conn.php"; 
include 'header.php';

?>

<main>
<form action="include/include.php" method="post" class="search">    
        <div class="search-wrapper">
        <i></i><input type="text" name="search" placeholder="search" class="search-input">
            <button type="submit" name="search">Search</button>
        </div>
            <?php
                if (isset($_SESSION['u_id'])==null && isset($_SESSION['u_name'])==null) {
                    ?>        
                        <a href="login.php"><img src="include/image/icon/cart.webp" alt="cart" class="cart-icon"></a>
                    <?php
                } 
                else {
                    $sqlcart = mysqli_query($link,"SELECT count(*) as c_id  from cart where u_id='$id'");
                    while ($rowc = mysqli_fetch_array($sqlcart)) {
                        if ($rowc['c_id'] == 0) {
                            
                        } else {
                            echo $rowc['c_id'];
                        }
                    }

                    ?>
                    <a href="cart.php"><img src="include/image/icon/cart.webp" alt="cart" class="cart-icon"></a>
                    <?php
                }
                
            ?>
                
        </form>
        
        <div class="products">
<div class="all_margin bg">
    <?php 
        if (isset($_GET['id'])) {
            $p_id = mysqli_real_escape_string($link, $_GET['id']);
            $sqlGet= mysqli_query($link,"SELECT * from products where p_id='$p_id'");
            while ($row = mysqli_fetch_assoc($sqlGet)) {
                ?>
                <div class="wrapper">
                    <img class="item" src="include/image/product/<?php echo $row['p_image'] ?>" alt="" srcset="">
                    <div class="content2">
                        <p><?php echo $row['p_name'] ?></p>
                        <p>details:<br>&nbsp;&nbsp;&nbsp;&nbsp;
                        &nbsp;&nbsp;
                        <?php echo $row['p_details'] ?></p>
                        <p>₱ <?php echo $row['p_price'] ?></p>
                        <div class="buttonss">
                        
                        <?php
                                 if (isset($_SESSION['u_id'])==null && isset($_SESSION['u_name'])==null) {
                                    ?>  
                                <a href="login.php?NeedLoginBuy=<?php echo $row['p_id'] ?>&NeedLoginBuyType=buy">Buy now</a>                            
                            <a href="login.php?NeedLoginCart=<?php echo $row['p_id'] ?>&NeedLoginCartType=cart">Add to cart</a>
                    <?php 
                           } else {
                               ?>
                                <a href="order.php?buy=<?php echo $row['p_id'] ?>">Buy now</a>                            
                            <a href="viewProduct.php?vi=<?php echo $row['p_id'] ?>">Add to cart</a>
                               <?php
                           }
                    ?>
                        </div>
                        
                    </div>
                </div>
                <?php
            }
        }

        
        if (isset($_GET['vi'])) {
            $user_id = $_SESSION['u_id'];
            $p_id = $_GET['vi'];
        
            $sqlCartAdd = mysqli_query($link, "INSERT INTO cart (c_id,u_id,p_id) values ('','$user_id','$p_id')");
            if ($sqlCartAdd) {
                header('location: viewProduct.php?id='.$p_id);
            } else {
                echo "error!";
            }
        }
        ?>
    </div>
</div>
    
</main>
</body>
</html>

<style>
.item{
    width: 20rem;
    height: 20rem;
    object-fit: cover;
}
.wrapper{
    display: flex;
    justify-content: center;
    padding: 2rem 0;
}
.wrapper img{
    width: 30%;
}
.content2{
    width: 40%;
    margin-top: auto;
    margin-bottom: auto;
    margin-left: 1rem;
    padding: 1.5rem;
}
.content2 p:first-of-type{
    font-size: 2rem;
    border-bottom: 2px solid grey;
    padding-bottom: .5rem;
    margin-bottom: 1rem;
}
.content2 p:nth-of-type(2){
    font-size: 1.5rem;
}
.content2 p:last-of-type{
    font-size: 2rem;
    color: #BB7229;
    margin: 1rem 0 2rem;
}
.buttonss{
    text-align: center;
}
a{
    text-decoration: none;
}
.buttonss a:first-of-type{
    background-color: #BB7229;
    color: white;
    border: none;
    padding: .5rem .7rem;
    margin-right: .5rem;
}

.buttonss a:last-of-type{
    background-color: #728D3C;
    color: white;
    border: none;
    padding: .5rem .7rem;
}

.buttonss a:first-of-type:hover{
    background-color: #c96f14;
}

.buttonss a:last-of-type:hover{
    background-color: #7fa337;
}

</style>