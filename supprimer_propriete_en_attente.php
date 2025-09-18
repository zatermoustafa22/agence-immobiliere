<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immobilier";

// Connexion
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['id'])) {
    $id = intval($_POST['id']);

    // Supprimer la propriété
    $sql = "DELETE FROM propriete WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        header("Location: manage_prop_en_attente.php"); // Redirige vers la page de liste
        exit();
    } else {
        echo "Erreur lors de la suppression.";
    }

    $stmt->close();
}
if (isset($_POST['redirect'])) {
    $redirect_url = $_POST['redirect'];
    header("Location: " . $redirect_url);
    exit();
}
$redirect = $_GET['redirect'] ?? $_POST['redirect'] ?? null;
if ($redirect) {
    header("Location: " . $redirect);
    exit();
}


$conn->close();
?>
