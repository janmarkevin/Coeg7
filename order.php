<?php 
include 'include/conn.php';
include 'header.php';

?>
<main>
    

<!--Preview the products-->
<div class="all_margin">
<h1>Order Product</h1>
<div class="product">
    <div class="col1">
    <?php 
        if (isset($_GET['buy'])) {
            $p_id = mysqli_real_escape_string($link, $_GET['buy']);
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
                    </div>
                </div>
                <?php
            }
        }
    ?>
    </div>
    <div class="col2">
        <p>place Order now</p>
        <p>Shipping & Billing</p>
        <?php 
            $u_id = mysqli_real_escape_string($link,$_SESSION['u_id']);
            $sqlUserInfo = mysqli_query($link,"SELECT * FROM user where u_id='$u_id'");
            while($row = mysqli_fetch_assoc($sqlUserInfo)){
                ?>
                    <p><?php echo '<b>'.ucfirst($row['u_firstname']).' '.ucfirst($row['u_lastname']).'</b>'; ?></p>
                    <p><?php echo $row['u_address']; ?></p>
                    <p><?php echo $row['u_number']; ?></p>
                    <p><?php echo $row['u_email']; ?></p>
                
                <br>
                <h3>Order Summary</h3>
                <p>Subtotal(<?php 

                    $id = $_SESSION['u_id'];
                    $name = $_SESSION['u_name'];
                    $buy = $_GET['buy'];

                    $sqlcart = mysqli_query($link,"SELECT count(*) as c_id  from cart where u_id='$id'");
                    while ($rowc = mysqli_fetch_array($sqlcart)) {
                        if ($rowc['c_id'] == 0) {
                            
                        } else {
                            echo $rowc['c_id'];
                        }
                    }
                ?>)</p>
                <?php 
            }
        ?>

    </div>
</div>
</div>
</main>

<?php 
include 'footer.php';
?>

<style>
    .col2{
        background-color: white;
        width: 20rem;
        padding: 1rem;
    }
    .col2 p:first-of-type{
        font-size: ;
        background-color: #BB7229;
        color: white;
        text-align: center;
        text-transform: uppercase;
        padding: .5rem 0;
    }
    .product{
        display: flex;
        justify-content: space-between;
    }
.item{
    width: 10rem;
    height: 10rem;
    object-fit: cover;
    display: block;
}
.wrapper{
    display: flex;
    padding: 2rem 0;
    width: 90%;
}
.wrapper img{
    width: 40%;
}
.content2{
    width: 50%;
    margin-top: auto;
    margin-bottom: auto;
    margin-left: 1rem;
    padding: 1.5rem;
}
.content2 p:first-of-type{
    font-size: 1.5rem;
    border-bottom: 2px solid grey;
    padding-bottom: .5rem;
    margin-bottom: 1rem;
}
.content2 p:nth-of-type(2){
    font-size: 1rem;
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