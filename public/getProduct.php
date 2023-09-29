<?php
// Récupérez l'idProduct depuis la requête GET
$idProduct = $_GET['idProduct'];

// Effectuez une requête SQL pour récupérer les informations du produit
// Assurez-vous d'éviter les injections SQL en utilisant des requêtes préparées
$conn = new mysqli('localhost', 'root', 'test_technique');
$query = "SELECT * FROM Products WHERE idProduct = ?";
$stmt = $conn->prepare($query);
$stmt->bind_param('i', $idProduct);
$stmt->execute();
$result = $stmt->get_result();
$product = $result->fetch_assoc();

// Fermez la connexion à la base de données
$stmt->close();
$conn->close();

// Répondez au client avec les données du produit au format JSON
header('Content-Type: application/json');
echo json_encode($product);
