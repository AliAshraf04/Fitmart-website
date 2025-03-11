<?php
session_start();
include 'config.php';

if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php");
    exit();
}

if (isset($_GET['delete_fi_eq'])) {
    $id = $_GET['delete_fi_eq'];
    $sql = "DELETE FROM fi_eq WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
}

if (isset($_POST['add_fi_eq'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $description = $_POST['description'];
    $img_src = $_POST['img_src'];

    $sql = "INSERT INTO fi_eq (name, price, description, img_src) VALUES ('$name', '$price', '$description', '$img_src')";
    if (mysqli_query($conn, $sql)) {
        echo "Product added successfully.";
    } else {
        echo "Error adding product: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM fi_eq";
$result1 = mysqli_query($conn, $sql);

///////////////////////////////////////////////////////////////////////////////////////////////////

if (isset($_GET['delete_bars'])) {
    $id = $_GET['delete_bars'];
    $sql = "DELETE FROM bars WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
}

if (isset($_POST['add_bars'])) {
    $name = $_POST['name2'];
    $price = $_POST['price2'];
    $description = $_POST['description2'];
    $img_src = $_POST['img_src2'];

    $sql = "INSERT INTO bars (name, price, description, img_src) VALUES ('$name', '$price', '$description', '$img_src')";
    if (mysqli_query($conn, $sql)) {
        echo "Product added successfully.";
    } else {
        echo "Error adding product: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM bars";
$result2 = mysqli_query($conn, $sql);

///////////////////////////////////////////////////////////////////////////////

if (isset($_GET['delete_supp'])) {
    $id = $_GET['delete_supp'];
    $sql = "DELETE FROM supp WHERE id='$id'";
    if (mysqli_query($conn, $sql)) {
        echo "Product deleted successfully.";
    } else {
        echo "Error deleting product: " . mysqli_error($conn);
    }
}

if (isset($_POST['add_supp'])) {
    $name = $_POST['name3'];
    $price = $_POST['price3'];
    $description = $_POST['description3'];
    $img_src = $_POST['img_src3'];

    $sql = "INSERT INTO supp (name, price, description, img_src) VALUES ('$name', '$price', '$description', '$img_src')";
    if (mysqli_query($conn, $sql)) {
        echo "Product added successfully.";
    } else {
        echo "Error adding product: " . mysqli_error($conn);
    }
}

$sql = "SELECT * FROM supp";
$result3 = mysqli_query($conn, $sql);
?>

<html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Fitmart - Admin</title>
    <link rel="stylesheet" href="admin.css">
</head>
<body>
    <header>
        <h1>Fitmart - ADMIN</h1>
    </header>

    <h2>Fitness Equipment Products</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result1)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><img src="<?php echo $row['img_src']; ?>" alt="<?php echo $row['name']; ?>" width="50"></td>
            <td>
                <a class="button" style="padding: 5px 10px; margin-left: 20px;text-decoration: none;"href="admin.php?delete_fi_eq=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <div class="divS">
        <h2>Add New Fitness Equipment Product</h2>
        <form method="post" action="admin.php">
            <input type="hidden" name="add_fi_eq" value="1">
            <label for="name">Product Name:</label>
            <input type="text" id="name" name="name" required><br>

            <label for="price">Price:</label>
            <input type="text" id="price" name="price" required><br>

            <label for="description">Description:</label>
           <input type="description" name="description" required></input><br>
            <label for="img_src">Image URL:</label>
            <input type="text" id="img_src" name="img_src" required><br>

            <button class="button" type="submit">Add Product</button>
        </form>
    </div>

    <!-- Bars Products Section -->
    <h2>Bars Products</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result2)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><img src="<?php echo $row['img_src']; ?>" alt="<?php echo $row['name']; ?>" width="50"></td>
            <td>
                <a class="button" style="padding: 5px 10px; margin-left: 20px;text-decoration: none;" href="admin.php?delete_bars=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <div class="divS">
        <h2>Add New Bars Product</h2>
        <form method="post" action="admin.php">
            <input type="hidden" name="add_bars" value="1">
            <label for="name2">Product Name:</label>
            <input type="text" id="name2" name="name2" required><br>

            <label for="price2">Price:</label>
            <input type="text" id="price2" name="price2" required><br>

            <label for="description2">Description:</label>
            <input type="description" id="description2" name="description2" required></input><br>

            <label for="img_src2">Image URL:</label>
            <input type="text" id="img_src2" name="img_src2" required><br>

            <button class="button" type="submit">Add Product</button>
        </form>
    </div>

    <!-- Supplements Products Section -->
    <h2>Supplements Products</h2>
    <table border="1">
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Price</th>
            <th>Description</th>
            <th>Image</th>
            <th>Action</th>
        </tr>
        <?php while ($row = mysqli_fetch_assoc($result3)) { ?>
        <tr>
            <td><?php echo $row['id']; ?></td>
            <td><?php echo $row['name']; ?></td>
            <td><?php echo $row['price']; ?></td>
            <td><?php echo $row['description']; ?></td>
            <td><img src="<?php echo $row['img_src']; ?>" alt="<?php echo $row['name']; ?>" width="50"></td>
            <td>
                <a class="button" style="padding: 5px 10px; margin-left: 20px;text-decoration: none;" href="admin.php?delete_supp=<?php echo $row['id']; ?>">Delete</a>
            </td>
        </tr>
        <?php } ?>
    </table>

    <div class="divS">
        <h2>Add New Supplements Product</h2>
        <form method="post" action="admin.php">
            <input type="hidden" name="add_supp" value="1">
  <label for="name3">Product Name:</label>
            <input type="text" id="name3" name="name3" required><br>

            <label for="price3">Price:</label>
            <input type="text" id="price3" name="price3" required><br>

            <label for="description3">Description:</label>
            <input type="description" id="description3" name="description3" required></input><br>
            <label for="img_src3">Image URL:</label>
            <input type="text" id="img_src3" name="img_src3" required> <br>
            <button class="button" type="submit">Add Product</button>
        </form>
    </div>
    
</body>
</html>

<?php
mysqli_close($conn);
?>