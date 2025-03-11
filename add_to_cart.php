<?php
include 'config.php';
session_start();

if (!isset($_SESSION['username'])) {
    header("Location: login.php"); 
    exit();
}
 $username = $_SESSION['username'];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
   
    $product_id = $_POST['product_id'];
    $product_name = $_POST['product_name'];
    $product_price = $_POST['product_price'];
    $product_img = $_POST['product_img'];
    $product_description = $_POST['product_description'];

    $username = mysqli_real_escape_string($conn, $username);
    $product_id = mysqli_real_escape_string($conn, $product_id);
    $product_name = mysqli_real_escape_string($conn, $product_name);
    $product_price = mysqli_real_escape_string($conn, $product_price);
    $product_img = mysqli_real_escape_string($conn, $product_img);
    $product_description = mysqli_real_escape_string($conn, $product_description);

      $sql = "INSERT INTO cart (usrname, product_id, name, price, img_src, description) VALUES ('$username', '$product_id', '$product_name', '$product_price', '$product_img', '$product_description')";

    if (mysqli_query($conn, $sql)) {
        header("Location: cart.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }


}
if (isset($_GET['delete_cart'])) {
    $product_id = $_GET['delete_cart'];
    $id = $_GET['ID'];
     $sql = "DELETE FROM cart WHERE usrname='$username' AND product_id='$product_id' AND id='$id' ";
    if (mysqli_query($conn, $sql)) {
        header("Location: cart.php");
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
}
mysqli_close($conn);
?>
