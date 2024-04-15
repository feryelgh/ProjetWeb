<?php
// Configuration de la connexion à la base de données
$servername = "localhost"; // Adresse du serveur MySQL
$username = "root"; // Nom d'utilisateur MySQL
$password = ""; // Mot de passe MySQL
$database = "site"; // Nom de la base de données

// Création de la connexion
$conn = mysqli_connect($servername, $username, $password, $database);

// Vérification de la connexion
if (!$conn) {
    // En cas d'échec de connexion, afficher l'erreur
    die("Connection failed: " . mysqli_connect_error());
}
?>
