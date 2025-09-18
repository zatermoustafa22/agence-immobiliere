<?php
session_start();
$afficher_formulaire = true;
$message = "";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (
        isset($_SESSION['email']) &&
        isset($_POST['nouveau_mot_de_passe']) &&
        isset($_POST['confirmation_mot_de_passe'])
    ) {
        $email = $_SESSION['email'];
        $nouveau_mot_de_passe = $_POST['nouveau_mot_de_passe'];
        $confirmation_mot_de_passe = $_POST['confirmation_mot_de_passe'];
    
        if ($nouveau_mot_de_passe !== $confirmation_mot_de_passe) {
            $message = "Les mots de passe ne correspondent pas.";
        } else {
            $mot_de_passe_hash = password_hash($nouveau_mot_de_passe, PASSWORD_DEFAULT);
    
            $conn = new mysqli("localhost", "root", "", "immobilier");
            if ($conn->connect_error) {
                die("Erreur de connexion : " . $conn->connect_error);
            }
    
            $stmt = $conn->prepare("UPDATE utilisateurs SET mot_de_passe = ? WHERE email = ?");
            $stmt->bind_param("ss", $mot_de_passe_hash, $email);
            if ($stmt->execute()) {
                $message = "Mot de passe réinitialisé avec succès.";
                $afficher_formulaire = false;
                session_destroy();
            } else {
                $message = "Erreur lors de la mise à jour du mot de passe.";
            }
    
            $stmt->close();
            $conn->close();
        }
    }  
}  
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Réinitialiser le mot de passe</title>
    <style>
        .container {
            width: 300px;
            margin: auto;
            padding: 20px;
            text-align: center;
        }
        input, button {
            width: 100%;
            margin: 10px 0;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Réinitialiser le mot de passe</h2>
        <p style="color: green;"><?php echo $message; ?></p>

        <?php if ($afficher_formulaire): ?>
            <form method="POST">
    <input type="password" name="nouveau_mot_de_passe" placeholder="Nouveau mot de passe" required>
    <input type="password" name="confirmation_mot_de_passe" placeholder="Confirmez le mot de passe" required>
    <button type="submit">Mettre à jour</button>
</form>

        <?php else: ?>
            <a href="connexion.html">Retour à la connexion</a>
        <?php endif; ?>
    </div>
</body>
</html>
