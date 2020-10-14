<?php 
session_start();
include_once '../include/conn.php';
$count = mysqli_query($link,"SELECT count(*) as p_id from products");
while($rows = mysqli_fetch_assoc($count)){
    $countt = $rows['p_id'];
}
?>
    <!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Admin</title>
    </head>
    <body>
        <header>
        <?php echo $_SESSION['a_name']; ?>
        <a href="logout.php">logout</a>
        </header>

        <main>
            <form action="../include/include.php" method="post" enctype="multipart/form-data">
            <input type="file" name="product_image" id="" accept="image/*">
            <input type="text" name="product_name" placeholder="Product name">
            <input type="text" name="product_price" placeholder="Price">
            <input type="text" name="product_details" placeholder="Details">
            <input type="text" name="product_quantity" placeholder="Quantity">
            <button type="submit" name="a_submit">Submit</button>
            </form>
        </main>
        <?php echo $countt." Products"; ?>
        <?php 
            $sql=mysqli_query($link,"SELECT * from products");
                while ($row=mysqli_fetch_assoc($sql)) {
                    
                    ?>
                        <div>
                            <img src="../include/image/product/<?php echo $row['p_image']; ?>" class="image" alt="" srcset="">
                            <p><?php echo $row['p_name']; ?></p>
                            <p><?php echo number_format($row['p_price']); ?> Pesos</p>
                            <p><?php echo $row['p_details']; ?></p>
                            <p><?php echo $row['p_quantity']; 
                                if ($row['p_quantity'] > 1) {
                                    echo " pieces left";
                                } else{
                                    echo " piece left";
                                }
                            ?></p>
                            <a href="#">delete</a>
                            <a href="#">update</a>
                        </div>
                    <?php
                }
        ?>
    </body>
    </html>       
  
  <style>
  .image{
      width: 10rem;
  }
  </style>