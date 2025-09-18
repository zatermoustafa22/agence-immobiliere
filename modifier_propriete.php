<?php
session_start();

// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immobilier";

$conn = new mysqli($servername, $username, $password, $dbname);

// Vérifier la connexion
if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Vérifier si l'utilisateur est connecté et possède un utilisateur_id
if (!isset($_SESSION['user_id'])) {
    $_SESSION['message'] = "Vous devez être connecté pour modifier une propriété.";
    header("Location: login.php");
    exit();
}

$property_id = $_GET['id'] ?? null; // Récupérer l'ID de la propriété depuis l'URL (GET)

if (!$property_id) {
    $_SESSION['message'] = "Aucune propriété spécifiée.";
    header("Location: profile.php");
    exit();
}

// Récupérer les détails de la propriété à modifier
$sql = "SELECT * FROM propriete WHERE id = ? AND utilisateur_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $property_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    $_SESSION['message'] = "Propriété introuvable ou vous n'avez pas l'autorisation de la modifier.";
    header("Location: profile.php");
    exit();
}

$property = $result->fetch_assoc(); // Récupérer les données de la propriété
$stmt->close();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Traitement du formulaire
    $titre = htmlspecialchars(trim($_POST['titre']), ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars(trim($_POST['description']), ENT_QUOTES, 'UTF-8');
    $prix = floatval($_POST['prix']);
    $type = htmlspecialchars(trim($_POST['type']), ENT_QUOTES, 'UTF-8');
    $localisation = htmlspecialchars(trim($_POST['localisation']), ENT_QUOTES, 'UTF-8');
    $contacts = htmlspecialchars(trim($_POST['contacts']), ENT_QUOTES, 'UTF-8');

    // Mise à jour de la propriété sans gestion des images
    $stmt = $conn->prepare("UPDATE propriete SET titre = ?, description = ?, prix = ?, contacts = ?, type = ?, localisation = ?, modifie_a = NOW() WHERE id = ? AND utilisateur_id = ?");
    $stmt->bind_param(
        'sssssssi', // 7 paramètres : 6 chaînes + 1 entier pour id
        $titre,
        $description,
        $prix,
        $contacts,
        $type,
        $localisation,
        $property_id,
        $_SESSION['user_id']
    );

    if ($stmt->execute()) {
        $_SESSION['message'] = "Propriété modifiée avec succès.";
        header("Location: profile.php");
    } else {
        $_SESSION['message'] = "Erreur : " . $stmt->error;
    }

    $stmt->close();
    $conn->close();
    exit();
}
?>


<!-- Formulaire HTML pour modifier la propriété -->
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo2.png">
    <title>Modifier Propriété</title>
        <style>
        body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    background: linear-gradient(135deg, #ece9e6, #ffffff);
    margin: 0;
    padding: 0;
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 100vh;
}

.container {
    background-color: #ffffff;
    padding: 2rem;
    border-radius: 12px;
    box-shadow: 0 8px 20px rgba(0, 0, 0, 0.1);
    max-width: 500px;
    width: 100%;
    text-align: left;
}

h1 {
    text-align: center;
    margin-bottom: 1.5rem;
    color: #333;
}

form label {
    display: block;
    margin-top: 1rem;
    font-weight: bold;
    color: #444;
}

form input[type="text"],
form input[type="number"],
form textarea {
    width: 100%;
    padding: 0.8rem;
    margin-top: 0.3rem;
    border: 1px solid #ccc;
    border-radius: 8px;
    box-sizing: border-box;
    transition: border 0.3s ease;
}

form input:focus,
form textarea:focus {
    border-color: #4A90E2;
    outline: none;
}

form textarea {
    resize: vertical;
    min-height: 100px;
}

form button {
    margin-top: 1.5rem;
    padding: 0.8rem 1.2rem;
    width: 100%;
    background-color: #4d4db3;
    color: white;
    border: none;
    border-radius: 8px;
    font-size: 1rem;
    font-weight: bold;
    cursor: pointer;
    transition: background 0.3s ease;
}

form button:hover {
    background-color:rgb(109, 109, 255);
}

p {
    text-align: center;
    color: green;
    font-weight: bold;
    margin-bottom: 1rem;
}

    </style>
</head>
<body>
    <div class="container">
        <h1>Modifier la propriété</h1>

        <?php
        if (isset($_SESSION['message'])) {
            echo "<p>" . $_SESSION['message'] . "</p>";
            unset($_SESSION['message']);
        }
        ?>

        <form action="modifier_propriete.php?id=<?= $property_id ?>" method="POST" enctype="multipart/form-data">
            <label for="titre">Titre :</label>
            <input type="text" name="titre" id="titre" value="<?= htmlspecialchars($property['titre'], ENT_QUOTES, 'UTF-8') ?>" required>

            <label for="description">Description :</label>
            <textarea name="description" id="description" required><?= htmlspecialchars($property['description'], ENT_QUOTES, 'UTF-8') ?></textarea>

            <label for="prix">Prix :</label>
            <input type="number" name="prix" id="prix" value="<?= $property['prix'] ?>" required>

            <label for="type">Type :</label>
            <input type="text" name="type" id="type" value="<?= htmlspecialchars($property['type'], ENT_QUOTES, 'UTF-8') ?>" required>

            <label for="localisation">Localisation :</label>
            <input type="text" name="localisation" id="localisation" value="<?= htmlspecialchars($property['localisation'], ENT_QUOTES, 'UTF-8') ?>" required>

            <label for="contacts">Contacts :</label>
            <input type="text" name="contacts" id="contacts" value="<?= htmlspecialchars($property['contacts'], ENT_QUOTES, 'UTF-8') ?>" required>

            <button type="submit">Mettre à jour la propriété</button>
        </form>
    </div>
</body>

</html>
