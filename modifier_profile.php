<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'proprietaire') {
    header("Location: changer_role.php");
    exit();
}

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immobilier";

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erreur de connexion : " . $conn->connect_error);
}

$user_id = $_SESSION['user_id'];

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nouveau_nom_utilisateur = trim($_POST['nom_utilisateur']);
    $mot_de_passe_actuel = $_POST['mot_de_passe_actuel'];
    $mot_de_passe_nouveau = $_POST['mot_de_passe_nouveau'];
    $mot_de_passe_nouveau_confirm = $_POST['mot_de_passe_nouveau_confirm'];

    // Récupérer le hash actuel en base
    $stmt = $conn->prepare("SELECT mot_de_passe FROM utilisateurs WHERE id = ?");
    $stmt->bind_param("i", $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();

    if (!$row || !password_verify($mot_de_passe_actuel, $row['mot_de_passe'])) {
        $message = "Le mot de passe actuel est incorrect.";
    } else {
        // Mot de passe actuel est correct

        if (!empty($mot_de_passe_nouveau)) {
            // Vérifier que les deux nouveaux mots de passe correspondent
            if ($mot_de_passe_nouveau !== $mot_de_passe_nouveau_confirm) {
                $message = "Les nouveaux mots de passe ne correspondent pas.";
            } else {
                // Hacher le nouveau mot de passe
                $hash = password_hash($mot_de_passe_nouveau, PASSWORD_DEFAULT);

                // Mettre à jour nom utilisateur et mot de passe
                $stmt = $conn->prepare("UPDATE utilisateurs SET nom_utilisateur = ?, mot_de_passe = ? WHERE id = ?");
                $stmt->bind_param("ssi", $nouveau_nom_utilisateur, $hash, $user_id);

                if ($stmt->execute()) {
                    $_SESSION['nom_utilisateur'] = $nouveau_nom_utilisateur;
                    $message = "Profil mis à jour avec succès.";
                } else {
                    $message = "Erreur lors de la mise à jour.";
                }
            }
        } else {
            // Pas de nouveau mot de passe, garder l'ancien hash
            $hash = $row['mot_de_passe'];

            $stmt = $conn->prepare("UPDATE utilisateurs SET nom_utilisateur = ?, mot_de_passe = ? WHERE id = ?");
            $stmt->bind_param("ssi", $nouveau_nom_utilisateur, $hash, $user_id);

            if ($stmt->execute()) {
                $_SESSION['nom_utilisateur'] = $nouveau_nom_utilisateur;
                $message = "Profil mis à jour avec succès.";
            } else {
                $message = "Erreur lors de la mise à jour.";
            }
        }
    }
}
// Récupération des infos actuelles
$stmt = $conn->prepare("SELECT nom_utilisateur FROM utilisateurs WHERE id = ?");
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();
$utilisateur = $result->fetch_assoc();

?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" type="image/png" href="logo2.png">
    <meta charset="UTF-8">
    <title>Modifier Profil</title>
</head>
<body>
    <h1>Modifier votre profil</h1>

    <?php if (!empty($message)) echo "<p>$message</p>"; ?>

<form method="post">
    <label>Nom d'utilisateur:</label>
    <input type="text" name="nom_utilisateur" value="<?= htmlspecialchars($utilisateur['nom_utilisateur']) ?>" required><br><br>

    

    <label>Mot de passe actuel :</label>
    <input type="password" name="mot_de_passe_actuel" required><br><br>
    <h3>Changer le mot de passe (facultatif)</h3>
    <label>Nouveau mot de passe (laisser vide pour ne pas changer) :</label>
    <input type="password" name="mot_de_passe_nouveau"><br><br>

    <label>Confirmer nouveau mot de passe :</label>
    <input type="password" name="mot_de_passe_nouveau_confirm"><br><br>

    <input type="submit" value="Mettre à jour">
</form>




    <br><a href="profile.php">Retour au profil</a>
</body>
</html>
