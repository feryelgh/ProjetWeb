<style>
  .brand_item-container {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    gap: 20px;
  }

  .brand_item-box {
    width: calc(33.33% - 20px);
    background-color: #fff;
    border: 1px solid #eaeaea;
    border-radius: 5px;
    overflow: hidden;
    box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
  }

  .brand_img-box img {
    width: 100%;
    height: auto;
  }

  .brand_detail-box {
    padding: 20px;
  }

  .brand_detail-box h5 {
    font-size: 18px;
    margin-bottom: 10px;
  }

  .brand_detail-box .product_name {
    font-size: 16px;
    margin-bottom: 15px;
    color: black;
  }

  .view_more_link {
    display: inline-block;
    background-color: #007bff;
    color: #fff;
    padding: 8px 16px;
    border-radius: 5px;
    text-decoration: none;
    transition: background-color 0.3s ease;
  }

  .view_more_link:hover {
    background-color: #0056b3;
  }
</style>


<!DOCTYPE html>
<html>

<head>
  <!-- Basic -->
  <meta charset="utf-8" />
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <!-- Mobile Metas -->
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
  <!-- Site Metas -->
  <meta name="keywords" content="" />
  <meta name="description" content="" />
  <meta name="author" content="" />

  <title>Luminéa</title>

  <!-- slider stylesheet -->
  <link rel="stylesheet" type="text/css"
    href="https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.1.3/assets/owl.carousel.min.css" />

  <!-- bootstrap core css -->
  <link rel="stylesheet" type="text/css" href="css/bootstrap.css" />

  <!-- fonts style -->
  <link href="https://fonts.googleapis.com/css?family=Dosis:400,500|Poppins:400,700&display=swap" rel="stylesheet">
  <!-- Custom styles for this template -->
  <link href="css/style.css" rel="stylesheet" />
  <!-- responsive style -->
  <link href="css/responsive.css" rel="stylesheet" />
</head>

<body>
  <div class="hero_area">
    <!-- header section strats -->
    <header class="header_section">
      <div class="container-fluid">
        <nav class="navbar navbar-expand-lg custom_nav-container pt-3">
          <a class="navbar-brand" href="index.php">
            <span>
              Luminéa
            </span>
          </a>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
          </button>

          <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <div class="d-flex ml-auto flex-column flex-lg-row align-items-center">
              <ul class="navbar-nav  ">
                <li class="nav-item active">
                  <a class="nav-link" href="index.php">Home <span class="sr-only">(current)</span></a>
                </li>
                <?php
                session_start();
                if (isset($_SESSION['SESSION_EMAIL'])) {
                  // Affichage de l'e-mail de l'utilisateur connecté
                  echo "<li class='nav-item'><a class='nav-link'>" . $_SESSION['SESSION_EMAIL'] . "</a></li>";
                  // Ajout du bouton de déconnexion
                  echo "<li class='nav-item'><a class='nav-link' href='logout.php'>Logout</a></li>";
                } else {
                  // Afficher le bouton de connexion lorsque l'utilisateur n'est pas connecté
                  echo "<li class='nav-item'><a class='nav-link' href='auth.php'>Login</a></li>";
                }
                ?>
              </ul>
              <form class="form-inline my-2 my-lg-0 ml-0 ml-lg-4 mb-3 mb-lg-0">
                <button class="btn  my-2 my-sm-0 nav_search-btn" type="submit"></button>
              </form>
            </div>
          </div>
        </nav>
      </div>
    </header>
    <!-- end header section -->

    <!-- end header section -->
    <!-- slider section -->
    <section class=" slider_section position-relative">
      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <div class="slider_item-box">
              <div class="slider_item-container">
                <div class="container">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="slider_img-box">
                        <div>
                          <img src="images/soinscorps4.jpg" alt="" class="" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="slider_item-detail">
                        <div>
                          <h1>
                            Essence de Beauté
                          </h1>
                          <p>
                            La collection innovante inspirée par la nature et formulée avec des ingrédients de la plus
                            haute qualité pour révéler la beauté naturelle de votre peau.
                          </p>
                          <div class="d-flex">
                            <a href="" class="slider-btn1 mr-3">
                              Read More
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="slider_item-box">
              <div class="slider_item-container">
                <div class="container">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="slider_img-box">
                        <div>
                          <img src="images/cheuv4.jpg" alt="" class="" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="slider_item-detail">
                        <div>
                          <h1>
                            Essence de Beauté
                          </h1>
                          <p>
                            La collection innovante inspirée par la nature et formulée avec des ingrédients de la plus
                            haute qualité pour révéler la beauté naturelle de votre peau.
                          </p>
                          <div class="d-flex">
                            <a href="" class="slider-btn1 mr-3">
                              Read More
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
          <div class="carousel-item">
            <div class="slider_item-box">
              <div class="slider_item-container">
                <div class="container">
                  <div class="row">
                    <div class="col-md-5">
                      <div class="slider_img-box">
                        <div>
                          <img src="images/skincare1.jpg" alt="" class="" />
                        </div>
                      </div>
                    </div>
                    <div class="col-md-7">
                      <div class="slider_item-detail">
                        <div>
                          <h1 class="">
                            Essence de Beauté
                          </h1>
                          <p>
                            La collection innovante inspirée par la nature et formulée avec des ingrédients de la plus
                            haute qualité pour révéler la beauté naturelle de votre peau.
                          </p>
                          <div class="d-flex">
                            <a href="" class="slider-btn1 mr-3">
                              Read More
                            </a>
                          </div>
                        </div>
                      </div>
                    </div>

                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="custom_carousel-control">
          <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="sr-only">Previous</span>
          </a>
          <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="sr-only">Next</span>
          </a>
        </div>
      </div>
    </section>
    <!-- end slider section -->
  </div>
  <div class="bg">

    <!-- about section -->
    <section class="about_section layout_padding">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-5 offset-md-2">
            <div class="about_detail-box">
              <h3 class="custom_heading ">
                About our products
              </h3>
              <p class="">
                protéger votre peau et vos cheveux des agressions extérieures telles que la pollution, les rayons UV, le
                vent et le froid. Les crèmes hydratantes, les lotions solaires et les produits capillaires enrichis en
                vitamines et en antioxydants aident à maintenir l'intégrité de notre barrière cutanée et à prévenir les
                dommages causés par ces facteurs environnementaux.
              </p>
              <div>
                <a href="">
                  Read More
                </a>
              </div>
            </div>
          </div>
          <div class="col-md-4">
            <div class="about_img-box">
              <img src="images/skincare2.jpg" alt="">
            </div>
          </div>
        </div>
      </div>
    </section>


    <!-- end about section -->
    <section class="brand_section layout_padding2">
      <div class="container">
        <div class="brand_heading">
          <h3 class="custom_heading">
            Nos produits
          </h3>
        </div>

        <div class="container-fluid brand_item-container">
          <?php
          include 'config.php';

          // Requête SQL pour sélectionner les produits
          $sql = "SELECT * FROM produit";
          $result = $conn->query($sql);

          // Vérifie s'il y a des produits à afficher
          if ($result->num_rows > 0) {
            echo "<div class='row'>";
            $productCount = 0;
            while ($row = $result->fetch_assoc()) {
              // Afficher un maximum de 4 produits par ligne
              if ($productCount % 4 == 0 && $productCount != 0) {
                echo "</div><div class='row'>";
              }
              ?>
              <div class="col-md-3">
                <div class="card product-card">
                  <img src="images/<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="product image">
                  <div class="card-body">
                    <h5 class="card-title">
                      <?php echo $row['nom']; ?>
                    </h5>
                    <p class="card-text">Prix:
                      <?php echo $row['prix']; ?>DT
                    </p>
                    <p class="card-text">Description:
                      <?php echo $row['description']; ?>
                    </p>
                    <p class="card-text">Quantité:
                      <?php echo $row['quantite']; ?>
                    </p>
                    <?php if (isset($_SESSION['SESSION_EMAIL'])): ?>
                      <button class="btn btn-primary add-to-cart" data-product-id="<?php echo $row['product_id']; ?>">Ajouter
                        au panier</button>
                    <?php endif; ?>
                  </div>
                </div>
              </div>
              <?php
              $productCount++;
            }
            echo "</div>"; // Fermer la dernière ligne
          } else {
            echo "Aucun produit trouvé.";
          }
          ?>
        </div>
      </div>

      <!-- Bouton pour aller à la page de panier -->
      <?php if (isset($_SESSION['SESSION_EMAIL'])): ?>
        <div class="text-center mt-4">
          <a href="cart.php" class="btn btn-primary">Voir le panier</a>
        </div>
      <?php endif; ?>
    </section>
    <style>
      .product-card {
        margin-bottom: 20px;
        border: 1px solid #ccc;
        border-radius: 10px;
        overflow: hidden;
        transition: all 0.3s ease;
      }

      .product-card:hover {
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      }

      .product-card .card-img-top {
        height: 200px;
        object-fit: cover;
      }

      .product-card .card-body {
        padding: 20px;
      }

      .product-card .card-title {
        font-size: 18px;
        font-weight: bold;
        margin-bottom: 10px;
      }

      .product-card .card-text {
        margin-bottom: 5px;
      }
    </style>


    <!-- jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <!-- Votre script jQuery -->
    <script type="text/javascript">
      $(document).ready(function () {
        $('.add-to-cart').click(function () {
          var productId = $(this).data('product-id');

          // Envoi de l'identifiant du produit au serveur via une requête AJAX
          $.ajax({
            type: 'POST',
            url: 'add_to_cart.php', // URL du script PHP pour ajouter au panier
            data: { productId: productId },
            success: function (response) {
              // Gérer la réponse du serveur si nécessaire
              alert('Le produit a été ajouté au panier.');
            }
          });
        });
      });
    </script>

    <!-- footer section -->
    <section class="container-fluid footer_section">
      <p>
        Luminéa
      </p>
    </section>
    <!-- footer section -->

    <script type="text/javascript" src="js/jquery-3.4.1.min.js"></script>
    <script type="text/javascript" src="js/bootstrap.js"></script>
</body>

</html>