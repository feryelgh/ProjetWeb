<?php

session_start();
if (!isset($_SESSION['SESSION_EMAIL'])) {
  header("Location: produit.php");
  die();
}
include 'config.php';
$query = mysqli_query($conn, "SELECT * FROM vendeur WHERE email='{$_SESSION['SESSION_EMAIL']}'");

if (mysqli_num_rows($query) > 0) {
  $row = mysqli_fetch_assoc($query);
  $email = $row['email'];
}

$msg = "";
if (isset($_POST['submit'])) {
  $nom = mysqli_real_escape_string($conn, $_POST['nom']);
  $libelle = mysqli_real_escape_string($conn, $_POST['libelle']);
  $description = mysqli_real_escape_string($conn, $_POST['description']);
  $categorie = mysqli_real_escape_string($conn, $_POST['categorie']);
  $prix = mysqli_real_escape_string($conn, $_POST['prix']);
  $quantite = mysqli_real_escape_string($conn, $_POST['quantite']);
  // Image upload code
  $img_name = $_FILES['image']['name'];
  $img_size = $_FILES['image']['size'];
  $img_tmp = $_FILES['image']['tmp_name'];
  $img_ext = pathinfo($img_name, PATHINFO_EXTENSION);
  $extensions = array("jpeg", "jpg", "png");
  if (in_array($img_ext, $extensions) === false) {
    $msg = "<div class='alert alert-danger'>Extension not allowed, please choose a JPEG or PNG file.</div>";
  } else if ($img_size > 2097152) {
    $msg = "<div class='alert alert-danger'>File size must be less than 2 MB.</div>";
  } else {
    $img_name = uniqid() . '.' . $img_ext;
    move_uploaded_file($img_tmp, "images/" . $img_name);
    $sql = "INSERT INTO produit (nom, libelle ,description ,categorie, prix, quantite,email, image) VALUES ('{$nom}', '{$libelle}', '{$description}', '{$categorie}', '{$prix}', '{$quantite}', '{$email}', '{$img_name}')";
    $result = mysqli_query($conn, $sql);
    if ($result) {
      echo "</div>";
      $msg = "<div class='alert alert-info'>Success.</div>";
    } else {
      $msg = "<div class='alert alert-danger'>Something wrong went.</div>";
    }
    if (!$result) {
      $error = mysqli_error($conn);
      echo "<script>alert('Erreur : $error');</script>";
    }
  }
}

?>




<style>
  /* Custom styles */
  body {
    background-color: #f8f9fa;
    font-family: Arial, sans-serif;
  }

  .container {
    max-width: 1200px;
    margin: 20px auto;
    display: flex;
  }

  .sidebar {
    width: 250px;
    background-color: #343a40;
    color: #fff;
    padding: 20px;
  }

  .sidebar h3 {
    color: #fff;
    margin-bottom: 20px;
  }

  .sidebar ul {
    list-style-type: none;
    padding: 0;
  }

  .sidebar li {
    margin-bottom: 10px;
  }

  .sidebar a {
    color: #fff;
    text-decoration: none;
  }

  .sidebar a:hover {
    color: #ffc107;
  }

  .main-content {
    flex: 1;
    padding: 20px;
    background-color: #fff;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
  }

  .navbar-brand {
    font-weight: bold;
  }

  .navbar-nav .nav-item {
    margin-bottom: 10px;
  }

  .navbar-nav .nav-link {
    color: #343a40;
  }

  .btn-outline-danger {
    color: #dc3545;
    border-color: #dc3545;
  }

  .btn-outline-danger:hover {
    background-color: #dc3545;
    color: #fff;
  }

  table {
    width: 100%;
    border-collapse: collapse;
    margin-top: 20px;
  }

  th,
  td {
    padding: 10px;
    border: 1px solid #ddd;
    text-align: left;
  }

  th {
    background-color: #007bff;
    color: #fff;
  }

  td img {
    max-width: 100px;
    height: auto;
  }

  .btn-danger,
  .btn-warning {
    padding: 5px 10px;
    color: #fff;
    border: none;
    border-radius: 4px;
    cursor: pointer;
  }

  .btn-danger {
    background-color: #dc3545;
  }

  .btn-warning {
    background-color: #ffc107;
  }
</style>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="shortcut icon" href="assets/images/favicon.svg" type="image/x-icon" />

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
          <a href="produit.php" data-bs-toggle="collapse">
            <span class="text">produit</span>
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
                        <h6 class="fw-500">
                          <?php echo $_SESSION['SESSION_EMAIL']; ?>
                        </h6>
                        <p>VENDEUR</p>
                      </div>
                    </div>
                  </div>
                </button>
                <ul class="dropdown-menu dropdown-menu-end" aria-labelledby="profile">
                  <li>
                  </li>
                  <li class="divider"></li>
                  <li class="divider"></li>
                  <li>
                    <a href="logout.php"> <i class="lni lni-exit"></i> Sign Out </a>
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
        <h2>Ajouter un produit</h2>
        <form name="myForm" action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm()">
          <div class="form-group">
            <label for="nom">Nom :</label>
            <input type="text" name="nom" class="form-control"
              title="Le nom doit contenir uniquement des lettres et des espaces">
          </div>
          <div class="form-group">
            <label for="libelle">Libellé :</label>
            <input type="text" name="libelle" class="form-control" minlength="3"
              title="Le libellé doit contenir au moins 3 caractères">
          </div>
          <div class="form-group">
            <label for="description">Description :</label>
            <textarea name="description" class="form-control" minlength="5"
              title="La description doit contenir au moins 5 caractères"></textarea>
          </div>
          <div class="form-group">
            <label for="categorie">Catégorie :</label>
            <select name="categorie" class="form-control">
              <option value="">Sélectionner une catégorie</option>
              <option value="Soins de visage">Soins de visage</option>
              <option value="Soins de corps">Soins de corps</option>
              <option value="Maquillage">Maquillage</option>
              <option value="Parfums">Parfums</option>
              <option value="Cheveux">Cheveux</option>
            </select>
          </div>
          <div class="form-group">
            <label for="image">Image :</label>
            <input type="file" name="image" class="form-control-file">
          </div>
          <div class="form-group">
            <label for="prix">Prix :</label>
            <input type="text" name="prix" class="form-control"
              title="Le prix doit être un nombre décimal avec deux chiffres après la virgule">
          </div>
          <div class="form-group">
            <label for="quantite">Quantité :</label>
            <input type="text" name="quantite" class="form-control"
              title="La quantité doit être un nombre entier positif">
          </div>
          <button name="submit" type="submit" class="btn btn-primary">Ajouter</button>
        </form>
        <hr>


        <h2>Liste des produits</h2>
        <!-- Product table -->
        <table>
          <thead>
            <tr>
              <th>Nom</th>
              <th>Libellé</th>
              <th>Description</th>
              <th>Catégorie</th>
              <th>Prix</th>
              <th>Quantité</th>
              <th>Image</th>
              <th>Actions</th>
            </tr>
          </thead>
          <tbody>
            <!-- Display products -->
            <?php
            $query = mysqli_query($conn, "SELECT * FROM produit WHERE email='{$_SESSION['SESSION_EMAIL']}'");
            while ($row = mysqli_fetch_assoc($query)) {
              echo "<tr>";
              echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
              echo "<td>" . htmlspecialchars($row['libelle']) . "</td>";
              echo "<td>" . htmlspecialchars($row['description']) . "</td>";
              echo "<td>" . htmlspecialchars($row['categorie']) . "</td>";
              echo "<td>" . htmlspecialchars($row['prix']) . "</td>";
              echo "<td>" . htmlspecialchars($row['quantite']) . "</td>";
              echo "<td><img src='images/" . htmlspecialchars($row['image']) . "' alt='product image'></td>"; // display the image
            
              echo "<td>";
              echo "<form action='delete_produit.php' method='post' onsubmit='return confirm(\"Are you sure you want to delete this product?\")'>";
              echo "<input type='hidden' name='produit_id' value='" . htmlspecialchars($row['product_id']) . "'>";
              echo "<button type='submit' name='delete' class='btn-danger'><i class='fas fa-trash-alt'></i>supprimer</button>";
              echo "</form>";
              echo "<form action='modify_produit.php' method='post'>";
              echo "<input type='hidden' name='produit_id' value='" . htmlspecialchars($row['product_id']) . "'>";
              echo "<button type='submit' name='modify' class='btn-warning'><i class='fas fa-edit'></i>modifier</button>";
              echo "</form>";
              echo "</td>";
              echo "</tr>";
            }
            ?>
          </tbody>
        </table>
      </div>


      </div>
      <!-- end container -->
    </section>
    <!-- ========== section end ========== -->


  </main>
  <!-- ======== main-wrapper end =========== -->

  <!-- ========= All Javascript files linkup ======== -->
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