<?php
session_start();

if (!isset($_SESSION['nom_utilisateur'])) {
    // Not logged in
    header("Location: connexion.php");
    exit;
}

$conn = mysqli_connect("localhost", "root", "", "immobilier");

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$username = mysqli_real_escape_string($conn, $_SESSION['nom_utilisateur']);

// Fetch role
$sql = "SELECT role FROM utilisateurs WHERE nom_utilisateur = '$username'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) == 1) {
    $user = mysqli_fetch_assoc($result);
    $role = $user['role'];

    if ($role == 'admin') {
        header("Location: acceuil_admin.php");
        exit;
    } elseif ($role == 'visiteur') {
        header("Location: accueil.php");
        exit;
    } else {
        echo "Role not recognized.";
    }
} else {
    echo "User not found.";
}

mysqli_close($conn);
?>
