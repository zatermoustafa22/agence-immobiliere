<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charikat Lmanazil</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="logo2.png">
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            color: #264653;
            background-color: #000;
        }

        h1, h2, h3 {
            margin: 0;
        }

        /* Header */
        header {
            background-color: #006d77;
            color: white;
            padding: 20px;
            text-align: center;
        }

        /* Navigation */
        nav {
            display: flex;
    justify-content: flex-end; /* Aligns elements to the right */
    align-items: center;
    background-color: black;
    padding: 15px;
    gap: 15px; /* Creates spacing between elements */
}
        

        nav a {
            color: white;
            text-decoration: none;
            font-weight: 500;
            transition: color 0.3s;
        }

        nav a:hover {
            color: #f4a261;
        }

        .connexion-btn {
            order: 1;
            margin-left: auto;
            background-color: #f8f9fa;
            color: black;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: 700;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }

        .connexion-btn:hover {
            background-color: #f4a261;
            color: white;
        }

        /* Hero Section */
        .hero {
            background: linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.7) 70%, #000 100%),
                url('amin.jpg') no-repeat center center/cover;
            height: 550px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-shadow: 5px 2px 6px #000;
            padding: 0 20px;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 20px;
            text-align: center;
        }

        .hero a {
            background-color: #f4a261;
            color: black;
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            border: 2px solid white;
            transition: background-color 0.3s, color 0.3s;
        }

        .hero a:hover {
            background-color: #e76f51;
            color: white;
            border-color: white;
        }

        /* Banner Section */
        .banner {
            
            color: white;
            text-align: center;
            padding: 30px;
            margin: 20px auto;
        }

        .cta-button {
            display: inline-flex;
            align-items: center;
            background-color:rgb(255, 255, 255);
            color: black;
            padding: 10px 20px;
            border-radius: 5px;
            text-decoration: none;
            font-weight: 700;
            transition: background-color 0.3s;
        }

        .cta-button img {
            width: 20px;
            margin-right: 10px;
        }

        .cta-button:hover {
            background-color: #f4a261;
            color:white
        }

        /* Property Section */
        .property-examples {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 20px;
            padding: 20px;
        }

        .property-card {
            width: calc(33.33% - 20px);
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            background-color: white;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s;
            text-align: center;
        }

        .property-card:hover {
            transform: translateY(-5px);
        }

        .property-card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }

        .property-card h3 {
            background-color: black;
            color: white;
            padding: 10px;
            margin: 0;
        }

        .property-card p {
            padding: 10px;
            color: #555;
        }

        .searchBox {
  
  display: flex;
  max-width: 230px;
  align-items: center;
  justify-content: space-between;
  gap: 8px;
  background: #2f3640;
  border-radius: 50px;
  position: relative;
}

.searchButton {
  color: white;
  position: absolute;
  right: 8px;
  width: 50px;
  height: 50px;
  border-radius: 50%;
  background: var(--gradient-2, linear-gradient(90deg, #2AF598 0%, #009EFD 100%));
  border: 0;
  display: inline-block;
  transition: all 300ms cubic-bezier(.23, 1, 0.32, 1);
}

nav .searchBox {
    order: 0; /* Ensures the search box appears first */
    margin-left: 0;
    
}

        /* Footer */
        footer {
            background-color: black;
            color: white;
            text-align: center;
            padding: 20px 10px;
            font-size: 0.9rem;
        }

        footer a {
            color: #f4a261;
            text-decoration: none;
            font-weight: 500;
        }

        footer a:hover {
            text-decoration: underline;
        }

    </style>
</head>
<body>

    <nav>

        
        <a href="acceuil_admin.php">Accueil</a>
        <a href="manage_prop_en_attente.php">Manage demande</a>
        <a href="manage_propriete.php">Manage proprietes</a>
        <a href="manage_users.php">Manage utilisateurs</a>
        <a href="contact.html">Contact</a>
        
        <a href="logout.php" class="connexion-btn">Deconnexion</a>
    </nav>

    <div class="hero">
        <img src="logo2.png" alt="Agence Immobilière Logo" style="max-width: 100px; margin-bottom: 20px;">
        

        <div class="banner">
        <h2>C'est le moment de vendre</h2>
        <a href="ajouter_propriete.php" class="cta-button">
            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828817.png" alt="icon"> Déposer une annonce
        </a>
    </div>
    </div>

    <div class="property-examples">
    <?php
    // Connexion à la base de données
    $conn = new mysqli("localhost", "root", "", "immobilier");
    if ($conn->connect_error) {
        die("Connexion échouée : " . $conn->connect_error);
    }

    $sql = "SELECT titre, prix, image_01, description FROM propriete ORDER BY cree_a DESC LIMIT 3";
    $result = $conn->query($sql);

    if ($result && $result->num_rows > 0):
        while ($row = $result->fetch_assoc()):
            $image = !empty($row['image_01']) ? "uploads/" . $row['image_01'] : "default.png";
            ?>
            <div class="property-card">
                <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($row['titre']) ?>">
                <h3><?= htmlspecialchars($row['titre']) ?></h3>
                <p><?= number_format($row['prix'], 0, ',', ' ') ?> DA - <?= htmlspecialchars($row['description']) ?></p>
            </div>
        <?php
        endwhile;
    else:
        echo "<p>Aucune propriété à afficher.</p>";
    endif;

    $conn->close();
    ?>
</div>


    <footer>
        <p>&copy; 2025 Agence Immobilière. Tous droits réservés.</p>
        <p>
            Contactez-nous : mus2alive@gmail.com | +33 1 23 45 67 89
            <a href="logout.php">Deconnexion</a>

        </p>
    </footer>

</body>
</html>
