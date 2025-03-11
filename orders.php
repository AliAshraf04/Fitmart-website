<?php
include 'config.php'; 

session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

$username = $_SESSION['username'];

$sql_orders = "SELECT * FROM orders WHERE username = '$username'";
$result_orders = mysqli_query($conn, $sql_orders);

?>

<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Orders - Fitmart</title>
    <link rel="stylesheet" href="orders.css"> 
</head>
<body>
    <header>
        <h1>Your Orders</h1>
        <div id="divH" > 
            <a href="fit-equ.php">Fitness Equipments</a>
            <a href="bars.php">Bars</a>
            <a href="supp.php">Supplements</a>
        </div>
    </header>

    <div class="order-container">
        <?php
        if (mysqli_num_rows($result_orders) > 0) {
            while ($row = mysqli_fetch_assoc($result_orders)) {
                $order_id = $row['id'];
                $order_date = $row['created_at'];
                $total_amount = $row['total_amount'];

                echo "<div class='order'>";
                echo "<h2>Order #$order_id</h2>";
                echo "<p><strong>Order Date:</strong> $order_date</p>";
                echo "<p><strong>Total Amount:</strong> $total_amount</p>";

                $sql_items = "SELECT * FROM order_items WHERE order_id = '$order_id'";
                $result_items = mysqli_query($conn, $sql_items);

                if (mysqli_num_rows($result_items) > 0) {
                    echo "<table>";
                    echo "<tr><th>Product Name</th><th>Price</th><th>Description</th><th>Image</th></tr>";
                    while ($item = mysqli_fetch_assoc($result_items)) {
                        echo "<tr>";
                        echo "<td>" . $item['product_name'] . "</td>";
                        echo "<td>" . $item['price'] . "</td>";
                        echo "<td>" . $item['description'] . "</td>";
                        echo "<td><img src='" . $item['img'] . "' alt='" . $item['product_name'] . "' width='50'></td>";
                        echo "</tr>";
                    }
                    echo "</table>";
                } else {
                    echo "<p>No items found for this order.</p>";
                }

                echo "</div>";
            }
        } else {
            echo "<p>No orders found.</p>";
        }
        ?>
    </div>

  
</body>
</html>

<?php
mysqli_close($conn);
?>
