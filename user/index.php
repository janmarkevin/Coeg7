<?php 
session_start();
include_once '../include/conn.php';
if (isset($_SESSION["u_name"])==null && $_SESSION["u_id"]==null) {
    header("location: ../login.php");
} else {
    $id = $_SESSION['u_id'];
    $name = $_SESSION['u_name'];
    ?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>asdf</title>
    </head>
    <body>
    <header><?php echo $_SESSION['u_name'];?>
        <a href="logout.php">logout</a>
<br><br>
<a href="../index.php">Home</a>
<br><br>
        <a href="cart.php?id=<?php echo $id ?>" >
             my cart(<?php $sqlcart = mysqli_query($link,"SELECT count(*) as c_id  from cart where u_id='$id'");
            while ($rowc = mysqli_fetch_array($sqlcart)) {
                echo $rowc['c_id'];
            } ?>)</a>
    </header>
    <main>
    <br>
        <?php 
            $sql = mysqli_query($link,"SELECT * FROM products");
            while ($row=mysqli_fetch_assoc($sql)) {
                echo "<div>
                <a href='productDetails.php?id=".$row['p_id']."&user=".$_SESSION['u_id']."'>";
                ?>
                <img src="../include/image/product/<?php echo $row['p_image'] ?>" alt="" class="image"><br>
                <?php
                echo "name: ".$row['p_name']."<br>";
                echo "price: ".number_format($row['p_price'])."<br><br>";
                echo "</a></div>";
            }
        ?>
    </main>
        
    </body>
    </html>
    <?php
}
?>
<style>

.image{
    width: 10rem;
}

div{
    background-color: grey;
    width: 10rem;
    align-items: center;
    display: flex;
    margin: 1rem;
    cursor: pointer;
}
</style>