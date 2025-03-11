<?php
include 'config.php';
session_start();

$sql = "SELECT * FROM bars";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fitness Equipment - Fitmart</title>
    <link rel="stylesheet" href="products.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <h1>Fitmart</h1>


         <div class="divH"> 
        <a href="fit-equ.php">Fitnnes Equipment </a>
        <a href="supp.php">suppliments </a>
        <a href="orders.php">My orders</a>
        
        </div>



        <a href="cart.php">


            <img src="imgs/cart1.jpg" alt="cart">
        </a>
    </header>
    <h1>BARS</h1>

    <div class="product-container">
        <?php while ($row = mysqli_fetch_assoc($result)) { ?>
        <div class="product">
            <img src="<?php echo $row['img_src']; ?>" alt="<?php echo $row['name']; ?>">
            <div class="product-content">
                <h3><?php echo $row['name']; ?></h3>
                <p><?php echo $row['description']; ?></p>
                <p>Price: <?php echo $row['price']; ?></p>
                <form method="post" action="add_to_cart.php">
                    <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                    <input type="hidden" name="product_name" value="<?php echo $row['name']; ?>">
                    <input type="hidden" name="product_price" value="<?php echo $row['price']; ?>">
                    <input type="hidden" name="product_img" value="<?php echo $row['img_src']; ?>">
                    <input type="hidden" name="product_description" value="<?php echo $row['description']; ?>">
                    <button type="submit" class="button">Add to Cart</button>
                </form>
            </div>
        </div>
        <?php } ?>
    </div>

</body>
</html>

<?php
mysqli_close($conn);
?>
