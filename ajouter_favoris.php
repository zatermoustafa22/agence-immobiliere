<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour ajouter aux favoris.");
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immobilier";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];
$propriete_id = intval($_POST['propriete_id']);

// Vérifier si le favori existe déjà
$check = $conn->prepare("SELECT id FROM favoris WHERE user_id = ? AND propriete_id = ?");
$check->bind_param("ii", $user_id, $propriete_id);
$check->execute();
$check->store_result();

if ($check->num_rows === 0) {
    $stmt = $conn->prepare("INSERT INTO favoris (user_id, propriete_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $propriete_id);
    $stmt->execute();
}

$conn->close();
header("Location: afficher_propriete.php");
exit;
