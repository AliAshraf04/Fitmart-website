<?php
include 'config.php';
$token = $_POST['token'];
echo "Token received: " . $token;
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $token = $_POST['token'];
    echo "Token received: " . $token;

    $new_password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    if ($new_password !== $confirm_password) {
        echo "Passwords do not match.";
        exit();
    }

    $sql = "SELECT * FROM users WHERE reset_token='" . mysqli_real_escape_string($conn, $token) . "'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $update_sql = "UPDATE users SET password='$new_password', reset_token=NULL, token_expiry=NULL WHERE reset_token='" . mysqli_real_escape_string($conn, $token) . "'";
        if (mysqli_query($conn, $update_sql)) {
            echo "Your password has been reset successfully.";
            header("Location: login.htm?reset=success");
            exit();
        } else {
            echo "Failed to reset password.";
        }
    } else {
        echo "Invalid or expired token.";
    }

    mysqli_close($conn);
}
?>
