<?php
session_start();
header('Content-Type: application/json'); // Important for fetch()

if (!isset($_SESSION['user_id'])) {
    echo json_encode(['success' => false, 'message' => 'Utilisateur non connecté']);
    exit;
}

require_once __DIR__ . '/db.php';

$user_id = $_SESSION['user_id'];
$propriete_id = intval($_POST['propriete_id'] ?? 0);

// Vérifier si le favori existe déjà
$check = $conn->prepare("SELECT id FROM favoris WHERE user_id = ? AND propriete_id = ?");
$check->bind_param("ii", $user_id, $propriete_id);
$check->execute();
$check->store_result();

if ($check->num_rows === 0) {
    $stmt = $conn->prepare("INSERT INTO favoris (user_id, propriete_id) VALUES (?, ?)");
    $stmt->bind_param("ii", $user_id, $propriete_id);
    $stmt->execute();
    $stmt->close();
}
$check->close();

// Récupérer le nouveau total
$result = $conn->query("SELECT COUNT(*) AS total FROM favoris WHERE propriete_id = $propriete_id");
$row = $result->fetch_assoc();
$newCount = (int) $row['total'];

$conn->close();

// Retourner une réponse JSON
echo json_encode(['success' => true, 'newCount' => $newCount]);
exit;
