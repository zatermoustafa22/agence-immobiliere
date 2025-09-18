<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>charikat lmanazil</title>
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
            background-color: #000000;
            
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
        header p {
            font-size: 1.2rem;
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
            background-color:  #f4a261;
            color: white;
        }


        
        .hero {
            background: 
                linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.7) 70%, #000000 100%),
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
            background-color: transparent;
            color: rgb(255, 255, 255);
            padding: 10px 20px;
            border-radius: 10px;
            text-decoration: none;
            font-weight: 700;
            border: 2px solid white;
            transition: background-color 0.3s, color 0.3s;
        }
        .hero a:hover {
            background-color: transparent;
            color: #ffffff;
            border-color: #f4a261;
        }

        /* Section */
        .section {
            padding: 40px 20px;
            max-width: 1200px;
            margin: auto;
        }
        .section h2 {
            text-align: center;
            font-size: 2.5rem;
            margin-bottom: 30px;
            color: #000000;
        }
        .properties {
            display: flex;
            gap: 20px;
            flex-wrap: wrap;
            justify-content: center;
        }

        /* Card Styles */
        .card {
            border: 1px solid #ddd;
            border-radius: 10px;
            overflow: hidden;
            width: calc(33% - 20px);
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s, box-shadow 0.3s;
            background-color: rgb(255, 255, 255);
        }
        .card:hover {
            transform: translateY(-5px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }
        .card img {
            width: 100%;
            height: 200px;
            object-fit: cover;
        }
        .card h3 {
            padding: 15px;
            background-color: #000000;
            color: white;
            font-size: 1.25rem;
        }
        .card p {
            padding: 15px;
            font-size: 1rem;
            color: #555;
        }

        /* Add Property Button */
        .add-property-btn {
            display: inline-block;
            background-color: #000000;
            color: white;
            padding: 15px 30px;
            font-size: 1.2rem;
            font-weight: 700;
            text-align: center;
            border-radius: 5px;
            text-decoration: none;
            transition: background-color 0.3s, transform 0.3s;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        .add-property-btn:hover {
            background-color: #000000;
            transform: translateY(-3px);
            box-shadow: 0 6px 10px rgba(0, 0, 0, 0.2);
        }

        /* Footer */
        footer {
            background-color: #000000;
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
    background-color: #000;
    color: white;
    padding: 10px;
    margin: 0;
}

.property-card p {
    padding: 10px;
    color: #555;
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
  max-width: 400px; /* Stretch to large size on focus */
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
    
   <!-- <nav>
        <a href="connexion.html">Accueil</a>
        <a href="connexion.html">acheter</a>
        <a href="connexion.html">vendre</a>
        <a href="connexion.html">louer</a>
        <a href="connexion.html">Propriétés</a>
        <a href="connexion.html">Favoris</a>
        <a href="contact.html">Contact</a>
        <a href="demande_ad.html">demande admin access</a>
        <a href="connexion.html" class="connexion-btn">Connexion</a>
    </nav>-->
    <nav>

    <div class="searchBox">

         


</div>

        
        <a href="interface.php"> 
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
        <a href="connexion.html"><!-- From Uiverse.io by milegelu --> 
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
    d="M4.004 6.417L.762 3.174L2.176 1.76l3.243 3.243H20.66a1 1 0 0 1 .958 1.287l-2.4 8a1 1 0 0 1-.958.713H6.004v2h11v2h-12a1 1 0 0 1-1-1zm2 .586v6h11.512l1.8-6zm-.5 16a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3m12 0a1.5 1.5 0 1 1 0-3a1.5 1.5 0 0 1 0 3"
  />
</svg> Acheter
  </button>
</div>
</a>
        <a href="connexion.html"><!-- From Uiverse.io by milegelu --> 
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
    d="M12.586 2.586A2 2 0 0 0 11.172 2H4a2 2 0 0 0-2 2v7.172a2 2 0 0 0 .586 1.414l8 8a2 2 0 0 0 2.828 0l7.172-7.172a2 2 0 0 0 0-2.828zM7 9a2 2 0 1 1 .001-4.001A2 2 0 0 1 7 9"
  />
</svg>
Déposer
  </button>
</div>
</a>
        
        <a href="connexion.html"><!-- From Uiverse.io by milegelu --> 
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
    d="M19.5 12.572L12 20l-7.5-7.428A5 5 0 1 1 12 6.006a5 5 0 1 1 7.5 6.572"
  />
</svg>
Favoris
  </button>
</div>
</a>
        <a href="connexion.html"><!-- From Uiverse.io by milegelu --> 
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

<a href="connexion.html"><!-- From Uiverse.io by milegelu --> 
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
</svg>demande access admin

  </button>
</div>
</a>

<a href="connexion.html"><!-- From Uiverse.io by milegelu --> 
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
</svg>mes proprietes

  </button>
</div>
</a>



        <a href="connexion.html" class="connexion-btn">Connexion</a>
    </nav>



    <div class="hero">
        <img src="logo2.png" alt="Agence Immobilière Logo" style="max-width: 100px; margin-bottom: 20px;">
        <h1>Votre maison idéale vous attend</h1>


        <a href="connexion.html">Connexion</a>
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
           <div class="property-card" onclick="window.location.href='connexion.html'" style="cursor: pointer;">
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


    <!-- Footer -->
    <footer>
        <p>&copy; 2025 Agence Immobilière. Tous droits réservés.</p>
        <p>
            Contactez-nous : mimwarimmo@gmail.com | +213 0794882726 | +213 0655657509
            <a href="logout.php">Deconnexion</a>

        </p>
    </footer>
</body>
</html>