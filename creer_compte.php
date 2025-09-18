<?php
session_start();

// Database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immobilier";
$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nom_utilisateur = $_POST['nom_utilisateur'];
    $email = $_POST['email'];
    $mot_de_passe = password_hash($_POST['mot_de_passe'], PASSWORD_BCRYPT);
    $role = 'visiteur';

    // Check if username or email already exists
    $stmt = $conn->prepare('SELECT * FROM utilisateurs WHERE nom_utilisateur = ? OR email = ?');
    $stmt->bind_param('ss', $nom_utilisateur, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        echo "Nom d'utilisateur ou email déjà utilisé.";
    } else {
        // Save user data temporarily in session
        $_SESSION['nom_utilisateur'] = $nom_utilisateur;
        $_SESSION['email'] = $email;
        $_SESSION['mot_de_passe'] = $mot_de_passe;

        // Redirect to sendconf.php to send confirmation email
        header("Location: sendconf.php");
        exit();
    }
}
?>