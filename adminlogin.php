<?php
session_start();
include 'config.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Fetch user data from the database
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $row = mysqli_fetch_assoc($result);

        // Check if the user is an admin and password matches
        if ($row['reset_token'] == 'admin' && $password == $row['password']) {
            $_SESSION['admin'] = $username;
            header("Location: admin.php");
            exit();
        } else {
            echo "<h1 style='text-align:center;'>Invalid username or password, please try again.</h1>";
            echo "<div style='text-align:center;'><a href='login.htm'><button>Try Again</button></a></div>";
        }
    } else {
        echo "<h1 style='text-align:center;'>User not found. Please sign up or try again.</h1>";
        echo "<div style='text-align:center;'><a href='signup.htm'><button>Sign Up</button></a></div>";
        echo "<div style='text-align:center;'><a href='login.htm'><button>Try Again</button></a></div>";
    }
}

mysqli_close($conn);
?>
