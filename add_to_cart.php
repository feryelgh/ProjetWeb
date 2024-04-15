<?php
session_start();
include 'config.php';

// Vérifiez si l'utilisateur est connecté
if (!isset($_SESSION['SESSION_EMAIL'])) {
  // Rediriger l'utilisateur vers la page de connexion ou afficher un message d'erreur
  exit('Vous devez être connecté pour ajouter des produits au panier.');
}

// Récupérez l'identifiant du produit à partir de la requête AJAX
if (isset($_POST['productId'])) {
  $productId = $_POST['productId'];
  $email = $_SESSION['SESSION_EMAIL']; // Supposons que vous stockez l'identifiant de l'utilisateur dans la session

  // Utilisation d'une requête préparée pour éviter les attaques par injection SQL
  $stmt = $conn->prepare("INSERT INTO cart (email, product_id) VALUES (?, ?)");
  $stmt->bind_param("si", $email, $productId); // 's' pour string, 'i' pour integer

  // Exécutez la requête préparée
  if ($stmt->execute()) {
    echo "Le produit a été ajouté au panier.";
  } else {
    echo "Une erreur s'est produite lors de l'ajout du produit au panier.";
  }

  // Fermez la déclaration
  $stmt->close();
}
?>
