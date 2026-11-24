<?php
session_start();

require_once __DIR__ . '/db.php';

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
