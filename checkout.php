<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}

if (isset($_POST['checkout-btn'])) {
    $username = $_SESSION['username'];

    $sql_cart = "SELECT * FROM cart WHERE usrname = '$username'";
    $result_cart = mysqli_query($conn, $sql_cart);

    $total_amount = 0;

    if (mysqli_num_rows($result_cart) > 0) {
        while ($row = mysqli_fetch_assoc($result_cart)) {
            $total_amount += floatval($row['price']);
        }

        $order_date = date("Y-m-d H:i:s");
        $order_id = uniqid(); 
        $sql_order = "INSERT INTO orders (username, id, total_amount, created_at) VALUES ('$username', '$order_id', '$total_amount', '$order_date')";
        if (mysqli_query($conn, $sql_order)) {
            mysqli_data_seek($result_cart, 0);
            while ($row = mysqli_fetch_assoc($result_cart)) {
                $product_id = $row['product_id'];
                $product_name = $row['name'];
                $product_price = $row['price'];
                $product_img = $row['img_src'];
                $product_description = $row['description'];

                $sql_order_item = "INSERT INTO order_items (order_id, product_id, product_name, price, img, description) VALUES ('$order_id', '$product_id', '$product_name', '$product_price', '$product_img', '$product_description')";
                mysqli_query($conn, $sql_order_item);
            }

            $sql_clear_cart = "DELETE FROM cart WHERE usrname = '$username'";
            mysqli_query($conn, $sql_clear_cart);

            header("Location: checkout.htm?order_id=$order_id");
            exit();
        } else {
            echo "Error inserting order: " . mysqli_error($conn);
        }
    } else {
        echo "Your cart is empty.";
    }
}

mysqli_close($conn);
?>
