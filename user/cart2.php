<?php
session_start();
include_once '../include/conn.php';

if (isset($_SESSION['u_id']) == null) {
    header("location ../login.php");
} else{
    ?>

<html><head><title>COEG7</title></head>
    <body>
        <header class="hero">
                <div class="all_margin">
                    <nav class="flex_nav">
                        <img src="https://i.pinimg.com/originals/17/e0/68/17e0689b3b863db1724bff1ff87ab68a.png" class="logo_header">
                        <ul class="flex_nav">
                            <li><a href="#">Home</a></li>
                            <li><a href="#">Product</a></li>
                            <li><a href="#">Services</a></li>
                            <li><a href="#">Team</a></li>
                            <li><a href="#">contact</a></li>
                        </ul>
                    </nav>
             </div>
 </header>
        <main>
            <div class="main_top">
                <div class="all_margin">
                    <h1>My cart</h1>
                </div>
           </div>
            
            <div class="cart_contain all_margin">
                <div class="items">
                <?php
            include_once '../include/conn.php';
            $id = $_SESSION['u_id'];
            $sql= mysqli_query($link,"SELECT * from cart,products,user where cart.p_id=products.p_id and user.u_id=cart.u_id and cart.u_id='$id'");
            $num = mysqli_num_rows($sql);
            $total = 0;
            $place = "";
            $cartId = 0;
            $i = 0;
            while($row = mysqli_fetch_assoc($sql)){
                $cartId = $row['c_id'];
                    ?>      
                    
                        <div class="item">
                                <img src="../include/image/product/<?php echo $row['p_image'] ?>" class='picture'>
                                <div class="item_details">
                                    <p><?php echo $row['p_name'] ?></p>
                                    <p>&#8369;<?php echo $row['p_price'] ?></p>
                                        <div class="button">
                                            <button>Delete</button>
                                            <button>Add to cart</button>
                                            <!-- <a href='cart2.php?delete=<?php echo $cartId ?>'> Delete </a> -->
                                            
                                            <form action="cart2.php" method="post">
                                                <input type="hidden" value='<?php echo $cartId ?>' name='cart'>
                                                <button name='delete' type='submit'><a href='cart2.php?delete=<?php echo $cartId ?>'>Delete</a></button>
                                            </form>
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
                <!---->
                <div class="items_details">
                    <h2>Order summary</h2>
                    <div class="details_content">
                        <div class="content1">
                            <p>Sub total: </p>
                            <p>transfer fee:</p>
                        </div>
                        <div class="content2">
                            <p><?php
                $sqlcart = mysqli_query($link,"SELECT count(*) as c_id  from cart where u_id='$id'");
                while($rows = mysqli_fetch_assoc($sqlcart)){
                        echo $rows['c_id'];
                }  ?></p>
                            <p>45</p>
                        </div>
                    </div>
                    
                    <div class="details_content">
                    <div class="content1">
                        <p>Total:</p>
                    </div>
                    <div class="content2">
                    <?php echo number_format($total); ?>
                    </div>
                    
                    </div>
                    <button>Check out</button>
                </div>
            </div>
        </main>
        <footer></footer>
        
</body></html>

<?php 
if (isset($_GET['delete'])) {
    $idDel=$_GET['delete'];
    $sqlDel = mysqli_query($link, "DELETE FROM cart where c_id='$cartId'");
}

if (isset($_POST['delete'])) {
    $name= $_POST['cart'];

    $sqlDel = mysqli_query($link, "DELETE FROM cart where c_id='$cartId'");
    
}

}

?>


<style>
.button{
        text-align: center;
    }
    .item_details{
        padding: .5rem;
    }
    button{
        cursor: pointer;
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
            .content1 p,.content2 p{
                padding: .5rem 0;
            }
            .details_content{
                border-top: 1px solid #ededed;
                border-bottom: 1px solid #ededed;
                padding: 1rem 0;
                display: flex;
                justify-content: space-between;
            }
            .cart_contain{
                    display: flex;
                    justify-content: space-between;
                }
            .items{
                width: 63%;
                background-color: white;
                padding: .5rem;
            }
            .items_details{
                padding: .5rem;
                width: 35%;
                background-color: white;
                border: 1px;
            }
            .items_details p:last-of-type{
                padding: .5rem 0;
            }
            /*all*/
            *{
                margin: 0;
                padding: 0;
                box-sizing: border-box;
            }
            body{
                background-color: #ededed;
            }
    .white{
    color: white;
    }
            h1{
                color: #525252;
            }
            ul{
                list-style-type: none;
            }
            .all_margin{
                width: 90%;
                max-width: 1010px;
                margin: 0 auto;
            }
           
            
    /*header*/
            .hero{
               background-color: #c9c9c9;
            }
            /*list navagation*/
            .flex_nav{
                display: flex;
                justify-content: space-between;
                align-items: center;
                padding: 2rem 0 1rem;
            }
            .flex_nav li a{
                text-decoration: none;
                color: #000000;
                text-transform: uppercase;
                font-weight: bold;
            }
            .flex_nav li{
                margin-right: 1rem;
            }
            .flex_nav li:last-child{
                margin-right: 0;
            }
            .logo_header{
                width: 4rem;
            }
    
            
            /*logo body*/
            .hero_body{
                color: black;
                height: 70vh;
                display: flex;
                flex-direction: column;
                justify-content: center;
                align-items: center;
            }
            .logo_body{
                width: 15rem;
            }
    /*header*/
            
            /*Main*/
            
            /*main header*/
            .main_top{
                background-color: white;
                color: black;
                margin-bottom: 1rem;
            }
            
            /**/
            .item{
        background-color: #EFF0F5;
        
        margin-bottom: 1.5rem;
        display: flex;
    }
    .picture{
        width: 12rem;
        height: 12rem;
        display: block;
        object-fit: cover;
    }

</style>