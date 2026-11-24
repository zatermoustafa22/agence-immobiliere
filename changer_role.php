<?php
session_start();

require_once __DIR__ . '/db.php';

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
    <link rel="icon" type="image/png" href="logo2.png">
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
