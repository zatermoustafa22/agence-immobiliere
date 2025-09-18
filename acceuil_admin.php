<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Charikat Lmanazil</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="icon" type="image/png" href="logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
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
        .button {
  --bezier: cubic-bezier(0.22, 0.61, 0.36, 1);
  --edge-light: hsla(0, 0%, 50%, 0.8);
  --text-light: rgba(255, 255, 255, 0.4);
  --back-color: 240, 40%;

  cursor: pointer;
  padding: 0.7em 1em;
  border-radius: 0.5em;
  min-height: 2.4em;
  min-width: 3em;
  display: flex;
  align-items: center;
  gap: 0.5em;

  font-size: 13px;
  letter-spacing: 0.05em;
  line-height: 1;
  font-weight: bold;

  background: linear-gradient(
    140deg,
    hsla(var(--back-color), 50%, 1) min(2em, 20%),
    hsla(var(--back-color), 50%, 0.6) min(8em, 100%)
  );
  color: hsla(0, 0%, 90%);
  border: 0;
  box-shadow: inset 0.4px 1px 4px var(--edge-light);

  transition: all 0.1s var(--bezier);
}

.button:hover {
  --edge-light: hsla(0, 0%, 50%, 1);
  text-shadow: 0px 0px 10px var(--text-light);
  box-shadow: inset 0.4px 1px 4px var(--edge-light),
    2px 4px 8px hsla(0, 0%, 0%, 0.295);
  transform: scale(1.1);
}

.button:active {
  --text-light: rgba(255, 255, 255, 1);

  background: linear-gradient(
    140deg,
    hsla(var(--back-color), 50%, 1) min(2em, 20%),
    hsla(var(--back-color), 50%, 0.6) min(8em, 100%)
  );
  box-shadow: inset 0.4px 1px 8px var(--edge-light),
    0px 0px 8px hsla(var(--back-color), 50%, 0.6);
  text-shadow: 0px 0px 20px var(--text-light);
  color: hsla(0, 0%, 100%, 1);
  letter-spacing: 0.1em;
  transform: scale(1);
}
/*search*/ 
.group {
  display: flex;
  line-height: 28px;
  align-items: center;
  position: relative;
  max-width: 200px; /* Start small */
  width: 100%;
  transition: max-width 0.4s ease;
}

.group:focus-within {
  max-width: 550px; /* Stretch to large size on focus */
}

.input {
  font-family: "Montserrat", sans-serif;
  width: 100%;
  height: 45px;
  padding-left: 2.5rem;
  box-shadow: 0 0 0 1.5px #2b2c37, 0 0 25px -17px #000;
  border: 0;
  border-radius: 12px;
  background-color: #16171d;
  outline: none;
  color: #bdbecb;
  transition: all 0.25s cubic-bezier(0.19, 1, 0.22, 1);
  cursor: text;
  z-index: 0;
}

.input::placeholder {
  color: #bdbecb;
}

.input:hover {
  box-shadow: 0 0 0 2.5px #2f303d, 0px 0px 25px -15px #000;
}

.input:active {
  transform: scale(0.95);
}

.input:focus {
  box-shadow: 0 0 0 2.5px #2f303d;
}

.search-icon {
  position: absolute;
  left: 1rem;
  fill: #bdbecb;
  width: 1rem;
  height: 1rem;
  pointer-events: none;
  z-index: 1;
}
    .filter-button {
      background: none;
      border: none;
      font-size: 24px;
      cursor: pointer;
    }

    .filter-form {
      display: none;
      margin-top: 10px;
      padding: 10px;
      border: 1px solid #ccc;
      width: fit-content;
      background-color: #f9f9f9;
      border-radius: 5px;
    }

    .filter-form select,
    .filter-form input {
      margin: 5px;
      padding: 5px;
    }

    .filter-form button {
      margin: 5px;
      padding: 6px 12px;
      background-color: #4CAF50;
      color: white;
      border: none;
      border-radius: 4px;
      cursor: pointer;
    }

    .filter-form button:hover {
      background-color: #45a049;
    }
        .top-left-button {
  position: absolute;
  top: 90px;
  left: 5px;
  z-index: 1000;
}

.button {
  background-color: #007BFF; /* or your preferred color */
  color: white;
  padding: 10px 15px;
  border: none;
  border-radius: 5px;
  font-size: 14px;
  cursor: pointer;
}

.button i {
  margin-right: 5px;
}

.button:hover {
  background-color: #0056b3;
}

    </style>
</head>
<body>

    <nav>

        
    <a href="acceuil_admin.php"> 
<div>
  <button class="button">
    <svg
      viewBox="0 0 16 16"
      class="bi bi-lightning-charge-fill"
      fill="currentColor"
      height="16"
      width="16"
      xmlns="http://www.w3.org/2000/svg"
    >
      <path
        d="M11.251.068a.5.5 0 0 1 .227.58L9.677 6.5H13a.5.5 0 0 1 .364.843l-8 8.5a.5.5 0 0 1-.842-.49L6.323 9.5H3a.5.5 0 0 1-.364-.843l8-8.5a.5.5 0 0 1 .615-.09z"
      ></path></svg>accueil
  </button>
</div>
 </a>

        <a href="manage_prop_en_attente.php"> 
<div>
  <button class="button">
  <svg
  role="img"
  xmlns="http://www.w3.org/2000/svg"
  viewBox="0 0 24 24"
  width="16px"
  height="16px"
>
  <path
    fill="#ffffff"
    d="M21 13.1c-.1 0-.3.1-.4.2l-1 1l2.1 2.1l1-1c.2-.2.2-.6 0-.8l-1.3-1.3c-.1-.1-.2-.2-.4-.2m-1.9 1.8l-6.1 6V23h2.1l6.1-6.1zM12.5 7v5.2l4 2.4l-1 1L11 13V7zM11 21.9c-5.1-.5-9-4.8-9-9.9C2 6.5 6.5 2 12 2c5.3 0 9.6 4.1 10 9.3c-.3-.1-.6-.2-1-.2s-.7.1-1 .2C19.6 7.2 16.2 4 12 4c-4.4 0-8 3.6-8 8c0 4.1 3.1 7.5 7.1 7.9l-.1.2z"
  />
</svg>Gérer demande
  </button>
</div>
 </a> 

       <a href="manage_propriete.php"> 
<div>
  <button class="button">
  <svg
  role="img"
  xmlns="http://www.w3.org/2000/svg"
  viewBox="0 0 24 24"
  width="16px"
  height="16px"
>
  <path
    fill="#ffffff"
    d="m21.41 11.58l-9-9C12.04 2.21 11.53 2 11 2H4c-.53 0-1.04.21-1.41.59C2.21 2.96 2 3.47 2 4v7c0 .26.05.53.15.77c.1.23.25.46.44.65l1.98 1.98L6 13l-2-2V4h7l9 9l-7 7l-2.13-2.13l-.17.17v-.01l-1.25 1.25l2.14 2.14c.38.37.88.58 1.41.58c.53 0 1.04-.21 1.41-.59l7-7c.38-.37.59-.88.59-1.41c0-.26-.05-.5-.15-.77c-.1-.23-.25-.46-.44-.65M6.5 5a1.5 1.5 0 0 1 1.39.93c.11.27.14.57.08.86c-.06.29-.2.56-.41.77c-.21.21-.48.35-.77.41c-.29.06-.59.03-.86-.08A1.5 1.5 0 0 1 6.5 5m4.2 10.35l1-1a.55.55 0 0 0 0-.77l-1.28-1.28a.55.55 0 0 0-.77 0l-1 1zm-2.64-1.47L2 19.94V22h2.06l6.05-6.07z"
  />
</svg>Gérer propriétés
  </button>
</div>
 </a> 
       <a href="manage_users.php"> 
<div>
  <button class="button">
  <svg
  role="img"
  xmlns="http://www.w3.org/2000/svg"
  viewBox="0 0 24 24"
  width="16px"
  height="16px"
>
  <path
    fill="none"
    stroke="#ffffff"
    stroke-linecap="round"
    stroke-linejoin="round"
    stroke-width="2"
    d="M8 7a4 4 0 1 0 8 0a4 4 0 0 0-8 0M6 21v-2a4 4 0 0 1 4-4h3.5m4.92.61a2.1 2.1 0 0 1 2.97 2.97L18 22h-3v-3z"
  />
</svg>Gérer utilisateurs
  </button>
</div>
 </a>

       
        <a href="contact.html"><!-- From Uiverse.io by milegelu --> 
<div>
  <button class="button">
  <svg
  role="img"
  xmlns="http://www.w3.org/2000/svg"
  viewBox="0 0 24 24"
  width="16px"
  height="16px"
>
  <path
    fill="#ffffff"
    d="M19 7h5v2h-5zm-2 5h7v2h-7zm3 5h4v2h-4zM2 22a8 8 0 1 1 16 0h-2a6 6 0 0 0-12 0zm8-9c-3.315 0-6-2.685-6-6s2.685-6 6-6s6 2.685 6 6s-2.685 6-6 6m0-2c2.21 0 4-1.79 4-4s-1.79-4-4-4s-4 1.79-4 4s1.79 4 4 4"
  />
</svg>Contact

  </button>
</div>
</a>

        <a href="logout.php" class="connexion-btn">Deconnexion</a>
    </nav>

    <div class="hero">
        <img src="logo2.png" alt="Agence Immobilière Logo" style="max-width: 100px; margin-bottom: 20px;">
        

        <div class="banner">
        <h2>Gestion du site web</h2>
        
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
            <div class="property-card" onclick="window.location.href='manage_propriete.php'" style="cursor: pointer;">
    <img src="<?= htmlspecialchars($image) ?>" alt="<?= htmlspecialchars($row['titre']) ?>">
    <h3><?= htmlspecialchars($row['titre']) ?></h3>
    <p><?= number_format($row['prix'], 0, ',', ' ') ?> DZD - <?= htmlspecialchars($row['description']) ?></p>
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
            Contactez-nous : mimwarimmo@gmail.com | +213 0794882726 | +213 0655657509
            <a href="logout.php">Deconnexion</a>

        </p>
    </footer>

</body>
</html>
