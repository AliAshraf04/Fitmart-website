<?php
require 'vendor/autoload.php';  

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    include 'config.php';
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) == 1) {
        $token = bin2hex(random_bytes(5));
        $sql = "UPDATE users SET reset_token='$token', token_expiry=DATE_ADD(NOW(), INTERVAL 1 HOUR) WHERE email='$email'";
        if (mysqli_query($conn, $sql)) {
            $resetLink = "http://localhost/fitmart/newpasshtm.php?token=$token";

            $mail = new PHPMailer(true);
            try {
                $mail->isSMTP();
                $mail->Host = 'smtp.gmail.com';
                $mail->SMTPAuth = true;
                $mail->Username = 'tawfik7044@gmail.com';  
                $mail->Password = 'matx ccsr uzka bevs'; 
                $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
                $mail->Port = 587;

                $mail->setFrom('tawfik7044@gmail.com', 'FIT-MART');
                $mail->addAddress($email); 

                $mail->isHTML(true);
                $mail->Subject = 'Password Reset Request';
                $mail->Body    = "Please click the following link to reset your password: <a href='$resetLink'>$resetLink</a>";
                $mail->AltBody = "Please click the following link to reset your password: $resetLink";

                $mail->send();
                echo "Password reset link has been sent to your email.";
            } catch (Exception $e) {
                echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
            }
        } else {
            echo "Failed to set reset token.";
        }
    } else {
        echo "No user found with that email address.";
    }

    mysqli_close($conn);
}
?>
