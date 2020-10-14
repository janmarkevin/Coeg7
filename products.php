<?php
include 'header.php';
?>
<main>
    <div class="all_margin">
        <form action="include/include.php" method="post" class="search">    
        <div class="search-wrapper">
        <i></i><input type="text" name="search" placeholder="search" class="search-input">
            <button type="submit" name="search">Search</button>
        </div>
            <?php
                if (isset($_SESSION['u_id'])==null && isset($_SESSION['u_name'])==null) {
                    ?>        
                        <a href="login.php?NeedLogin=cart"><img src="include/image/icon/cart.webp" alt="cart" class="cart-icon"></a>
                    <?php
                } 
                else {
                    $id = $_SESSION['u_id'];
                    $name = $_SESSION['u_name'];
                    
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
    </div>

    <div class="products">
     <div class="all_margin bg">
        <h2 style="font-weight: 300">Products</h2>
            
        <?php
            include_once 'include/conn.php';
            $sql= mysqli_query($link,"SELECT * FROM products");
            $i = 0;
            while($row = mysqli_fetch_assoc($sql)){
                if ($i % 4 === 0) {
                    echo '<div class="items">';
                }
                $i++;
                    ?>      
                            <div class="item">
                                        <a href="viewProduct.php?id=<?php echo $row['p_id']; ?>">
                                <img src="include/image/product/<?php echo $row['p_image'] ?>" class='picture'>
                                <div class="item_details">
                                    <p><?php echo $row['p_name'] ?></p>
                                    <p>&#8369;<?php echo $row['p_price'] ?></p>
                                    </div>
                            </a>
                             </div>          
                    
                    <?php
                    if ($i % 4 === 0) {
                        $i = 0;
                        echo "</div>";
                    }                 

            }

        ?>
            
        </div>
    </div>
</main>

<?php include "footer.php"; ?>
<style>

    a{
        text-decoration: none;
    }
    .item{
        background-color: #EFF0F5;
        margin-left: 1.5rem;
        margin-bottom: 1.5rem;
    }
    .item a{
        color: black;
    }
    .picture{
        width: 12rem;
        height: 12rem;
        display: block;
        object-fit: cover;
    }

    .items{
        width: 12rem;
        display: flex;
        justify-content: center;
        margin: 0 auto;
    }
    .item_details{
        padding: .5rem;
        background-color: #EFF0F5;
        border-top: 1px grey solid;
    }

    .item_details p:first-child{
        font-size: 1.4rem;
    }
    .item_details p:last-of-type{
        font-size: 1.2rem;
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
        justify-content: center;
        display: flex;
    }
    .button button:nth-of-type(1){
        margin-right: .5rem;
    }
</style>