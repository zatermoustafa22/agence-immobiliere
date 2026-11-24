<?php
session_start();

// Vérifier si l'utilisateur est connecté


require_once __DIR__ . '/db.php';

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
    <title>Modifier vos infos personnelles</title>
      <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background: #f4f6f8;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            min-height: 100vh;
        }

        .container {
            background: #ffffff;
            margin-top: 40px;
            padding: 30px 40px;
            border-radius: 12px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h1 {
            text-align: center;
            color: #333;
            font-size: 26px;
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin: 12px 0 6px;
            color: #444;
            font-weight: 500;
        }

        input[type="text"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 8px;
            font-size: 16px;
            transition: border-color 0.3s;
        }

        input[type="text"]:focus,
        input[type="password"]:focus {
            border-color: #007BFF;
            outline: none;
        }

        input[type="submit"] {
            margin-top: 20px;
            width: 100%;
            padding: 12px;
            background-color: #4d4db3;
            color: white;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }

        input[type="submit"]:hover {
            background-color:rgb(36, 36, 78);
        }

        .message {
            text-align: center;
            margin-bottom: 20px;
            color: #e53935;
            font-weight: bold;
        }

        .success {
            color: #43a047;
        }

        h3 {
            margin-top: 30px;
            color: #555;
            font-size: 18px;
            border-bottom: 1px solid #ddd;
            padding-bottom: 5px;
        }

        .back-link {
            text-align: center;
            margin-top: 20px;
        }

        .back-link a {
            text-decoration: none;
            color: #007BFF;
            font-weight: 500;
        }

        .back-link a:hover {
            text-decoration: underline;
        }
    </style>
    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier votre profil</h1>

        <?php if (!empty($message)): ?>
            <div class="message <?= strpos($message, 'succès') !== false ? 'success' : '' ?>">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <form method="post">
            <label>Nom d'utilisateur:</label>
            <input type="text" name="nom_utilisateur" value="<?= htmlspecialchars($utilisateur['nom_utilisateur']) ?>" required>

            <label>Mot de passe actuel :</label>
            <input type="password" name="mot_de_passe_actuel" required>

            <h3>Changer le mot de passe (facultatif)</h3>

            <label>Nouveau mot de passe :</label>
            <input type="password" name="mot_de_passe_nouveau">

            <label>Confirmer nouveau mot de passe :</label>
            <input type="password" name="mot_de_passe_nouveau_confirm">

            <input type="submit" value="Mettre à jour">
        </form>

        <div class="back-link">
            <a href="profile.php">← Retour au profil</a>
        </div>
    </div>
</body>
</html>
