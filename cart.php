<?php
session_start();
// Inclure le fichier de configuration de la base de données
include 'config.php';

// Définir les messages par défaut
$successMessage = "";
$errorMessage = "";

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['SESSION_EMAIL'])) {
    // Rediriger l'utilisateur vers la page de connexion ou afficher un message d'erreur
    exit('Vous devez être connecté pour voir votre panier.');
}

// Récupérer l'email de l'utilisateur connecté depuis la session
$email = $_SESSION['SESSION_EMAIL'];

// Requête SQL pour sélectionner les produits du panier de l'utilisateur connecté avec les informations du produit
$sql = "SELECT cart.product_id, produit.nom, produit.prix, produit.description, produit.quantite, produit.image FROM cart INNER JOIN produit ON cart.product_id = produit.product_id WHERE cart.email = '$email'";
$result = $conn->query($sql);

// Traitement de la commande
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['commander'])) {
        $productId = $_POST['product_id'];
        
        // Récupérer les informations du produit
        $productSql = "SELECT * FROM produit WHERE product_id = '$productId'";
        $productResult = $conn->query($productSql);
        $productRow = $productResult->fetch_assoc();

        // Vérifier si la quantité disponible est suffisante
        if ($productRow['quantite'] > 0) {
            // Ajouter la commande dans la table des commandes
            $insertCommandSql = "INSERT INTO commande (email, product_id) VALUES ('$email', '$productId')";
            if ($conn->query($insertCommandSql) === TRUE) {
                // Mettre à jour la quantité du produit dans la table produit
                $newQuantity = $productRow['quantite'] - 1;
                $updateProductSql = "UPDATE produit SET quantite = '$newQuantity' WHERE product_id = '$productId'";
                if ($conn->query($updateProductSql) === TRUE) {
                    // Supprimer le produit du panier
                    $deleteFromCartSql = "DELETE FROM cart WHERE email = '$email' AND product_id = '$productId'";
                    if ($conn->query($deleteFromCartSql) === TRUE) {
                        // Message de succès
                        $successMessage = "Votre commande a été passée avec succès.";
                    } else {
                        // Message d'erreur
                        $errorMessage = "Une erreur est survenue lors de la suppression du produit du panier.";
                    }
                } else {
                    // Message d'erreur
                    $errorMessage = "Une erreur est survenue lors de la mise à jour de la quantité du produit.";
                }
            } else {
                // Message d'erreur
                $errorMessage = "Une erreur est survenue lors de l'ajout de la commande.";
            }
        } else {
            // Message d'erreur
            $errorMessage = "La quantité de ce produit n'est pas suffisante.";
        }
    }
}

?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panier</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
        }

        .cart-container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
        }

        .cart-item {
            border-bottom: 1px solid #ccc;
            padding: 10px 0;
            display: flex;
            align-items: center;
        }

        .product-details {
            flex: 1;
            margin-right: 20px;
        }

        .product-id {
            font-weight: bold;
        }

        .product-image {
            width: 100px;
            height: 100px;
            overflow: hidden;
            border-radius: 5px;
            margin-right: 20px;
        }

        .product-image img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .order-button {
            background-color: #4CAF50;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
        }

        .back-button {
            background-color: #337ab7;
            color: white;
            padding: 10px;
            text-align: center;
            text-decoration: none;
            display: inline-block;
            border-radius: 5px;
            cursor: pointer;
            margin-top: 10px;
            display: block;
            width: 100px;
            margin: 10px auto;
        }
    </style>
</head>

<body>
    <div class="cart-container">
        <h2>Panier</h2>
        <div class="cart-items">
            <?php
            // Vérifier s'il y a des produits dans le panier de l'utilisateur connecté
            if ($result->num_rows > 0) {
                // Afficher les produits dans le panier
                while ($row = $result->fetch_assoc()) {
                    echo "<div class='cart-item'>
                <div class='product-details'>
                    <span class='product-id'>" . $row['product_id'] . "</span>
                    <p><strong>Nom:</strong> " . $row['nom'] . "</p>
                    <p><strong>Prix:</strong> " . $row['prix'] . " DT</p>
                    <p><strong>Description:</strong> " . $row['description'] . "</p>
                    <p><strong>Quantité:</strong> " . $row['quantite'] . "</p>
                </div>
                <div class='product-image'>
                    <img src='images/" . htmlspecialchars($row['image']) . "' alt='product image'>
                </div>
                <form method='post'>
                    <input type='hidden' name='product_id' value='" . $row['product_id'] . "'>
                    <button type='submit' name='commander' class='order-button'>Commander</button>
                </form>
              </div>";
                }
            } else {
                echo "Aucun produit dans le panier.";
            }
            ?>
        </div>
        <a href="index.php" class="back-button">Retour</a>
    </div>
</body>

</html>
