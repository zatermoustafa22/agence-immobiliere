<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    die("Vous devez être connecté pour effectuer cette action.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (!isset($_POST['propriete_id'])) {
        die("ID de propriété manquant.");
    }

    $user_id = $_SESSION['user_id'];
    $propriete_id = intval($_POST['propriete_id']);

    require_once __DIR__ . '/db.php';

    // Delete the favorite entry for this user and property
    $sql = "DELETE FROM favoris WHERE user_id = ? AND propriete_id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ii", $user_id, $propriete_id);
    $stmt->execute();

    // Redirect back to favoris list
    header("Location: favoris.php"); // Change to your favorites page filename
    exit();
}
?>
