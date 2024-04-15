<?php
session_start();
include 'config.php';

if (isset($_POST['signup-submit'])) {
    $name = mysqli_real_escape_string($conn, $_POST['name']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));
    $user_type = mysqli_real_escape_string($conn, $_POST['user-type']);

    if ($user_type === 'client' || $user_type === 'vendeur') {
        $sql = "INSERT INTO " . $user_type . " (name, email, password) VALUES ('$name', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            $_SESSION['message_type'] = 'success';
            $_SESSION['message'] = "<div class='alert alert-success'>User registered successfully.</div>";
            header("Location: auth.php");
            exit();
        } else {
            $_SESSION['message_type'] = 'error';
            $_SESSION['message'] = "<div class='alert alert-danger'>Error: " . mysqli_error($conn) . "</div>";
        }
    } else {
        $_SESSION['message_type'] = 'error';
        $_SESSION['message'] = "<div class='alert alert-danger'>Invalid user type.</div>";
    }
}

header("Location: auth.php");
exit();
?>
