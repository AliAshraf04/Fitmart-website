<?php
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];

   $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    
    if (mysqli_num_rows($result) == 1) {
        echo " user already signed up try login";
            echo "<div style='text-align:center;'><a href='login.htm'><button>login</button></a></div>";
    }else {


    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";

    if (mysqli_query($conn, $sql)) {
        header("Location: login.htm");
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
        }
}

mysqli_close($conn);
?>
