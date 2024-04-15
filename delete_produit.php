<?php
session_start();
include 'config.php';

if (isset($_POST['delete']) && isset($_POST['produit_id'])) {
    $produit_id = mysqli_real_escape_string($conn, $_POST['produit_id']);
    $email = mysqli_real_escape_string($conn, $_SESSION['SESSION_EMAIL']);

    $query = mysqli_query($conn, "SELECT * FROM produit WHERE product_id='$produit_id'");
    if (mysqli_num_rows($query) == 1) {
        $sql = "DELETE FROM produit WHERE product_id='$produit_id'";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            $msg = "<div class='alert alert-info'>Job offer deleted.</div>";
        } else {
            $msg = "<div class='alert alert-danger'>Failed to delete job offer.</div>";
            // Afficher l'erreur dans la console
            echo "<script>console.log('Erreur MySQL: " . mysqli_error($conn) . "');</script>";
        }
    } else {
        $msg = "<div class='alert alert-danger'>You do not have permission to delete this product.</div>";
    }

    $_SESSION['msg'] = $msg;
    header('Location: produit.php');
    exit();
}
?>
    
<html>
<head>
    <title>Delete Job Offer</title>
</head>
<body>
    <h2>Delete Job Offer</h2>
    <?php
    if (isset($_SESSION['msg'])) {
        echo $_SESSION['msg'];
        unset($_SESSION['msg']);
    }
    ?>
    <form method="post">
        <input type="hidden" name="product_id" value="<?php echo $_GET['produit_id']; ?>">
        <p>Are you sure you want to delete this job offer?</p>
        <button type="submit" name="delete">Delete</button>
        <a href="produit.php">Cancel</a>
    </form>
</body>
</html>
