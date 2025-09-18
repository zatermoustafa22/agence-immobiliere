<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immobilier";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    $sql = "UPDATE propriete SET statut = 'acceptee' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: acceuil_admin.php");
        exit();
    } else {
        echo "Erreur : " . $conn->error;
    }
}

$conn->close();
?>
