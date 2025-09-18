<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $code_saisi = $_POST['code'];


    if ($code_saisi == $_SESSION['confirmation_code']) {
        // Code matches, create the account
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "immobilier";
        $conn = new mysqli($servername, $username, $password, $dbname);

        if ($conn->connect_error) {
            die("Erreur de connexion : " . $conn->connect_error);
        }

        $nom_utilisateur = $_SESSION['nom_utilisateur'];
        $email = $_SESSION['email'];
        $mot_de_passe = $_SESSION['mot_de_passe'];
        $role = $_SESSION['role'];

        // Insert into the database
        $stmt = $conn->prepare('INSERT INTO utilisateurs (nom_utilisateur, email, mot_de_passe, role) VALUES (?, ?, ?, ?)');
        $stmt->bind_param('ssss', $nom_utilisateur, $email, $mot_de_passe, $role);

        if ($stmt->execute()) {
            echo "Compte créé avec succès ! Vous pouvez maintenant vous connecter.";
        } else {
            echo "Erreur lors de la création du compte.";
        }
        $conn->close();
    } else {
        echo "Le code de confirmation est incorrect.";
    }
}
?>
