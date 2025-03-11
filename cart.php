<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];

$sql = "SELECT * FROM cart WHERE usrname = '$username'";
$result = mysqli_query($conn, $sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Shopping Cart - Fitmart</title>
    <link rel="stylesheet" href="products.css">
</head>
<body>
    <header>
        <h1>Your Shopping Cart</h1>
        <div class="divH"> 
        <a href="fit-equ.php">fitness equipments </a>
        <a href="bars.php">bars </a>
        <a href="supp.php">suppliments </a>
        
        
        </div>
    </header>

    <div class="product-container" id="cart-items">
        <?php
        $total = 0;
        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                $price = floatval($row['price']);
                $total += $price;
                ?>
                <div class="product">
                    <img src="<?php echo $row['img_src']; ?>" alt="<?php echo $row['name']; ?>">
                    <div class="product-content">
                        <h3><?php echo $row['name']; ?></h3>
                        <p><?php echo $row['description']; ?></p>
                        <p style="font-weight: bold; font-size: 20px;">Price: $<?php echo number_format($price, 2); ?></p>
<a class="button" style="padding: 5px 10px; margin-left: 20px;text-decoration: none;" href="add_to_cart.php?delete_cart=<?php echo $row['product_id']; ?>&ID=<?php echo $row['id']; ?>">Delete</a>
                    </div>
                </div>
                <?php
            }
        } else {
            echo "<p>Your cart is empty.</p>";
        }
        ?>
    </div>

    <footer style="text-align: center; padding: 20px;">
        <p class="title" style="margin-right:30px; font-size:30px;" id="total-price">Total Price: $<?php echo number_format($total, 2); ?></p>
  <form action="checkout.php" method="post">
        <button style="margin-top: 10px;" class="button" type="submit" name="checkout-btn">Checkout</button>
    </form>    </footer>



 
</body>
</html>

<?php
mysqli_close($conn);
?>
