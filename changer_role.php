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

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['changer_role']) && isset($_SESSION['user_id'])) {
    $id = intval($_SESSION['user_id']);  // Use session to identify user

    $sql = "UPDATE utilisateurs SET role = 'proprietaire' WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        $_SESSION['role'] = 'proprietaire'; // update session too
        header("Location: ajouter_propriete.php");
        exit();
    } else {
        echo "Erreur : " . $conn->error;
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Changer de rôle</title>
</head>
<body>
    <h2>Passer de Visiteur à Propriétaire</h2>

    <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 'visiteur'): ?>
        <form method="POST">
            <input type="hidden" name="changer_role" value="1">
            <input type="submit" value="Je veux vendre (Devenir Propriétaire)">
        </form>
    <?php else: ?>
        <?php
            // Redirect to ajouter_propriete.php if not a visitor
            header("Location: ajouter_propriete.php");
            exit();
        ?>
    <?php endif; ?>
</body>
</html>
