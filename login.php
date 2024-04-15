<?php
session_start();
include 'config.php';

if (isset($_SESSION['SESSION_EMAIL'])) {
    header("Location: index.php");
    exit();
}

if (isset($_POST['submit'])) {
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $password = mysqli_real_escape_string($conn, md5($_POST['password']));

    $sql_client = "SELECT * FROM client WHERE email='$email' AND password='$password'";
    $result_client = mysqli_query($conn, $sql_client);

    $sql_vendeur = "SELECT * FROM vendeur WHERE email='$email' AND password='$password'";
    $result_vendeur = mysqli_query($conn, $sql_vendeur);

    if (mysqli_num_rows($result_client) === 1) {
        $row_client = mysqli_fetch_assoc($result_client);
        if (empty($row_client['code'])) {
            $_SESSION['SESSION_EMAIL'] = $email;
            $_SESSION['message_type'] = 'success';
            $_SESSION['message'] = "Login successful.";
            header("Location: index.php");
            exit();
        } else {
            $_SESSION['message_type'] = 'error';
            $_SESSION['message'] = "An error occurred while logging in.";
        }
    } elseif (mysqli_num_rows($result_vendeur) === 1) {
        $row_vendeur = mysqli_fetch_assoc($result_vendeur);
        if (empty($row_vendeur['code'])) {
            $_SESSION['SESSION_EMAIL'] = $email;
            $_SESSION['message_type'] = 'success';
            $_SESSION['message'] = "Login successful.";
            header("Location: produit.php");
            exit();
        } else {
            $_SESSION['message_type'] = 'error';
            $_SESSION['message'] = "An error occurred while logging in.";
        }
    } else {
        $_SESSION['message_type'] = 'error';
        $_SESSION['message'] = "Email or password do not match.";
    }
}

header("Location: auth.php");
exit();
?>
