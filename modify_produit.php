<?php
session_start();
include 'config.php';

$msg = "";
if (isset($_POST['submit'])) {
    $id = mysqli_real_escape_string($conn, $_POST['product_id']);
    $nom = mysqli_real_escape_string($conn, $_POST['nom']);
    $libelle = mysqli_real_escape_string($conn, $_POST['libelle']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $categorie = mysqli_real_escape_string($conn, $_POST['categorie']);
    $prix = mysqli_real_escape_string($conn, $_POST['prix']);
    $quantite = mysqli_real_escape_string($conn, $_POST['quantite']);
    $sql = "UPDATE produit SET nom='{$nom}', libelle='{$libelle}', description='{$description}', categorie='{$categorie}', prix='{$prix}', quantite='{$quantite}' WHERE product_id='{$id}'";
    $result = mysqli_query($conn, $sql);
    if ($result) {
        $msg = "<div class='alert alert-info'>Informations du produit mises à jour avec succès.</div>";
        header('Location: produit.php');
        exit();
    } else {
        $msg = "<div class='alert alert-danger'>Une erreur s'est produite lors de la mise à jour des informations du produit.</div>";
    }
    if (!$result) {
        $error = mysqli_error($conn);
        echo "<script>alert('Erreur : $error');</script>";
    }
} elseif (isset($_POST['produit_id'])) {
    $produit_id = mysqli_real_escape_string($conn, $_POST['produit_id']);
    $sql = "SELECT * FROM produit WHERE product_id='{$produit_id}'";
    $result = mysqli_query($conn, $sql);
    if (mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nom = $row['nom'];
        $libelle = $row['libelle'];
        $description = $row['description'];
        $categorie = $row['categorie'];
        $prix = $row['prix'];
        $quantite = $row['quantite'];
    }
}
?>

<style>
    body {
        font-family: Arial, sans-serif;
        background-color: #f8f9fa;
        margin: 0;
        padding: 0;
    }

    header {
        background-color: #007bff;
        color: #fff;
        padding: 20px;
    }

    .header-container {
        display: flex;
        justify-content: space-between;
        align-items: center;
    }

    .container {
        max-width: 800px;
        margin: 20px auto;
        padding: 20px;
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    }

    .form-group {
        margin-bottom: 20px;
    }

    label {
        font-weight: bold;
    }

    input[type="text"],
    textarea,
    select,
    input[type="number"] {
        width: 100%;
        padding: 10px;
        border: 1px solid #ced4da;
        border-radius: 5px;
        box-sizing: border-box;
    }

    select {
        appearance: none;
        background-image: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24'%3E%3Cpath d='M7 10l5 5 5-5H7z'/%3E%3C/svg%3E");
        background-repeat: no-repeat;
        background-position-x: 95%;
        background-position-y: center;
    }

    input[type="submit"],
    .btn-primary,
    .btn-danger,
    .btn-warning {
        background-color: #007bff;
        color: #fff;
        border: none;
        border-radius: 5px;
        padding: 10px 20px;
        cursor: pointer;
        text-decoration: none;
        display: inline-block;
    }

    input[type="submit"]:hover,
    .btn-primary:hover,
    .btn-danger:hover,
    .btn-warning:hover {
        background-color: #0056b3;
    }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />
    <title>PlainAdmin Demo | Bootstrap 5 Admin Template</title>

    <!-- ========== All CSS files linkup ========= -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />
    <link rel="stylesheet" href="assets/css/lineicons.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/materialdesignicons.min.css" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/fullcalendar.css" />
    <link rel="stylesheet" href="assets/css/main.css" />
</head>

<body>
    <!-- ======== Preloader =========== -->
    <div id="preloader">
        <div class="spinner"></div>
    </div>
    <!-- ======== Preloader =========== -->

    <!-- ======== sidebar-nav start =========== -->
    <aside class="sidebar-nav-wrapper">
        <div class="navbar-logo">
            <a href="index.html">
                <img src="assets/images/logo/logo.svg" alt="logo" />
            </a>
        </div>
        <nav class="sidebar-nav">
            <ul>
                <li class="nav-item nav-item-has-children">
                    <a href="index.html" data-bs-toggle="collapse">
                        <span class="text">Tables</span>
                    </a>
                </li>
            </ul>
        </nav>
    </aside>
    <div class="overlay"></div>
    <!-- ======== sidebar-nav end =========== -->

    <!-- ======== main-wrapper start =========== -->
    <main class="main-wrapper">
        <!-- ========== header start ========== -->
        <header class="header">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-5 col-md-5 col-6">
                        <div class="header-left d-flex align-items-center">
                            <div class="menu-toggle-btn mr-15">
                                <button id="menu-toggle" class="main-btn primary-btn btn-hover">
                                    <i class="lni lni-chevron-left me-2"></i> Menu
                                </button>
                            </div>
                            <div class="header-search d-none d-md-flex">
                                <form action="#">
                                    <input type="text" placeholder="Search..." />
                                    <button><i class="lni lni-search-alt"></i></button>
                                </form>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-7 col-md-7 col-6">
                        <div class="header-right">

                            <!-- profile start -->
                            <div class="profile-box ml-15">
                                <button class="dropdown-toggle bg-transparent border-0" type="button" id="profile"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <div class="profile-info">
                                        <div class="info">
                                            <div class="image">
                                                <img src="assets/images/profile/profile-image.png" alt="" />
                                            </div>
                                            <div>
                                                <h6 class="fw-500">Adam Joe</h6>
                                                <p>Admin</p>
                                            </div>
                                        </div>
                                    </div>
                                </button>
                                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                                    <li>
                                        <div class="author-info flex items-center !p-1">
                                            <div class="image">
                                                <img src="assets/images/profile/profile-image.png" alt="image">
                                            </div>
                                            <div class="content">
                                                <h4 class="text-sm">Adam Joe</h4>
                                                <a class="text-black/40 dark:text-white/40 hover:text-black dark:hover:text-white text-xs"
                                                    href="#">Email@gmail.com</a>
                                            </div>
                                        </div>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#0"> <i class="lni lni-cog"></i> Settings </a>
                                    </li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="#0"> <i class="lni lni-exit"></i> Sign Out </a>
                                    </li>
                                </ul>
                            </div>
                            <!-- profile end -->
                        </div>
                    </div>
                </div>
            </div>
        </header>
        <!-- ========== header end ========== -->
        <script>
  function validateForm() {
    var nom = document.forms["myForm"]["nom"].value;
    var libelle = document.forms["myForm"]["libelle"].value;
    var description = document.forms["myForm"]["description"].value;
    var categorie = document.forms["myForm"]["categorie"].value;
    var image = document.forms["myForm"]["image"].value;
    var prix = document.forms["myForm"]["prix"].value;
    var quantite = document.forms["myForm"]["quantite"].value;

    if (nom == "") {
      alert("Veuillez entrer un nom.");
      return false;
    }
    if (libelle == "" || libelle.length < 3) {
      alert("Veuillez entrer un libellé d'au moins 3 caractères.");
      return false;
    }
    if (description == "" || description.length < 5) {
      alert("Veuillez entrer une description d'au moins 5 caractères.");
      return false;
    }
    if (categorie == "") {
      alert("Veuillez sélectionner une catégorie.");
      return false;
    }
    if (image == "") {
      alert("Veuillez sélectionner une image.");
      return false;
    }
    if (prix == "" || isNaN(prix) || parseFloat(prix) <= 0) {
      alert("Veuillez entrer un prix valide supérieur à zéro.");
      return false;
    }
    if (quantite == "" || isNaN(quantite) || parseInt(quantite) <= 0) {
      alert("Veuillez entrer une quantité valide supérieure à zéro.");
      return false;
    }
    return true;
  }
</script>

        <!-- ========== section start ========== -->
        <section class="section">
            <div class="container-fluid">
                <h1>Modifier le produit</h1>
                <?php echo $msg; ?>
                <form name="myForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
                    <input type="hidden" name="product_id" value="<?php echo $produit_id; ?>">
                    <div class="form-group">
                        <label for="nom">Nom :</label>
                        <input type="text" name="nom"
                            title="Le nom doit contenir uniquement des lettres et des espaces"
                            value="<?php echo $nom; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="libelle">Libellé :</label>
                        <input type="text" name="libelle"
                            title="Le libellé doit être au moins 3 caractères" value="<?php echo $libelle; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="description">Description :</label>
                        <textarea name="description"
                            title="La description doit contenir au moins 5 caractères"><?php echo $description; ?></textarea>
                    </div>
                    <div class="form-group">
                        <label for="categorie">Catégorie :</label>
                        <select name="categorie" >
                            <option value="">Sélectionner une catégorie</option>
                            <option value="Soins de visage" <?php echo ($categorie == "Soins de visage") ? "selected" : ""; ?>>Soins de
                                visage</option>
                            <option value="Soins de corps" <?php echo ($categorie == "Soins de corps") ? "selected" : ""; ?>>Soins de corps
                            </option>
                            <option value="Maquillage" <?php echo ($categorie == "Maquillage") ? "selected" : ""; ?>>
                                Maquillage</option>
                            <option value="Parfums" <?php echo ($categorie == "Parfums") ? "selected" : ""; ?>>
                                Parfums
                            </option>
                            <option value="Cheveux" <?php echo ($categorie == "Cheveux") ? "selected" : ""; ?>>
                                Cheveux
                            </option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="prix">Prix :</label>
                        <input type="text" name="prix"
                            title="Le prix doit être un nombre décimal avec deux chiffres après la virgule"
                            value="<?php echo $prix; ?>" >
                    </div>
                    <div class="form-group">
                        <label for="quantite">Stock :</label>
                        <input type="number" name="quantite" value="<?php echo $quantite; ?>" >
                    </div>
                    <input type="submit" name="submit" value="Modifier">
                </form>
            </div>
    <!-- ========== All Javascript files linkup ========== -->
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="assets/js/Chart.min.js"></script>
    <script src="assets/js/dynamic-pie-chart.js"></script>
    <script src="assets/js/moment.min.js"></script>
    <script src="assets/js/fullcalendar.js"></script>
    <script src="assets/js/jvectormap.min.js"></script>
    <script src="assets/js/world-merc.js"></script>
    <script src="assets/js/polyfill.js"></script>
    <script src="assets/js/main.js"></script>
</body>

</html>