<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immobilier";

// Create a connection using mysqli
$conn = new mysqli($servername, $username, $password, $dbname);

// Check if the connection is successful
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Check if form is submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Check if the user exists
    $stmt = $conn->prepare('SELECT id, nom_utilisateur, mot_de_passe, role FROM utilisateurs WHERE nom_utilisateur = ?');
    $stmt->bind_param('s', $nom_utilisateur);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        // Store user session
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['nom_utilisateur'] = $user['nom_utilisateur'];

        // Redirect based on user role
        if ($user['role'] === 'admin') {
            echo json_encode(["status" => "success", "redirect" => "acceuil_admin.php"]); // Admin redirect
        } elseif ($user['role'] === 'visiteur') {
            echo json_encode(["status" => "success", "redirect" => "accueil.php"]); // Visiteur redirect
        }
        elseif ($user['role'] === 'proprietaire') {
            echo json_encode(["status" => "success", "redirect" => "accueil.php"]); // Visiteur redirect
        }else {
            echo json_encode(["status" => "error", "message" => "Rôle non reconnu."]);
        }

        exit();
    } else {
        echo json_encode(["status" => "error", "message" => "Nom d'utilisateur ou mot de passe incorrect."]);
        exit();
    }
}
?>
