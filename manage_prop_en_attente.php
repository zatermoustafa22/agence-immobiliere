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

// Récupérer les propriétés depuis la base de données
$sql = "SELECT * FROM propriete WHERE statut = 'en_attente' ORDER BY cree_a DESC";

$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <link rel="icon" type="image/png" href="logo2.png">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Liste des Propriétés</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 20px;
            background-color: #f7f7f7;
            background: 
                linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.7) 70%, #000000 100%),
                url('amin.jpg') no-repeat center center/cover;
        }
        form {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }
        h1 {
            text-align: center;
            color: #fff;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        
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
            background-color:  #4d4db3;
            color: white;
        }



        /**/ 
        .property {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
        .property h2 {
            color:rgb(0, 0, 0);
            margin-bottom: 10px;
            
        }
        .property p {
            color: #555;
            margin: 5px 0;
            font-size: 30px;
            
        }
        .photos-container {
            overflow-x: auto;
            white-space: nowrap;
            padding: 10px 0;
        }
        .photos img {
            width: 500px;
            height: 450px;
            object-fit: cover;
            border-radius: 5px;
            margin-right: 10px;
            display: inline-block;
            transition: transform 0.3s;
        }
        .photos img:hover {
            transform: scale(1.1);
        }
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
        .filters form .flex .box .input{
   width: 100%;
   margin: 1rem 0;
   font-size: 1.8rem;
   color: var(--black);
   border: var(--border);
   padding: 1.4rem;
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
  max-width: 600px; /* Stretch to large size on focus */
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

    
/*accept button*/ 
.accept-btn {
      background: linear-gradient(135deg, #4CAF50, #45A049);
      color: white;
      border: none;
      padding: 15px 30px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 12px;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      margin: auto;
    }

    .accept-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .accept-btn:active {
      transform: scale(0.98);
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
    }
    /*suprimmer button*/ 
.suprimmer-btn {
      background: linear-gradient(135deg,rgb(202, 64, 64),rgb(255, 0, 0));
      color: white;
      border: none;
      padding: 15px 30px;
      font-size: 16px;
      font-weight: 600;
      border-radius: 12px;
      cursor: pointer;
      box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
      transition: all 0.3s ease;
      margin: auto;
    }

    .suprimmer-btn:hover {
      transform: scale(1.05);
      box-shadow: 0 6px 16px rgba(0, 0, 0, 0.15);
    }

    .suprimmer-btn:active {
      transform: scale(0.98);
      box-shadow: 0 3px 8px rgba(0, 0, 0, 0.2);
    }
    footer {
    background: linear-gradient(to top, #000000 80%, transparent);
    color: white;
    text-align: center;
    padding: 20px 10px;
    font-size: 0.9rem;
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
 ></path></svg>Acceuil
</button>
</div>
</a>
   <a href="manage_prop_en_attente.php"><!-- From Uiverse.io by milegelu --> 
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
</svg> Gérer demandes
</button>
</div>
</a>
   <a href="manage_propriete.php"><!-- From Uiverse.io by milegelu --> 
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
Gérer propriétés
</button>
</div>
</a>
   <a href="manage_users.php"><!-- From Uiverse.io by milegelu --> 
<div>
<button class="button">
<svg
role="img"
xmlns="http://www.w3.org/2000/svg"
viewBox="0 0 512 512"
width="16px"
height="16px"
>
<path
fill="#ffffff"
d="M218.1 167.17c0 13 0 25.6 4.1 37.4c-43.1 50.6-156.9 184.3-167.5 194.5a20.17 20.17 0 0 0-6.7 15c0 8.5 5.2 16.7 9.6 21.3c6.6 6.9 34.8 33 40 28c15.4-15 18.5-19 24.8-25.2c9.5-9.3-1-28.3 2.3-36s6.8-9.2 12.5-10.4s15.8 2.9 23.7 3c8.3.1 12.8-3.4 19-9.2c5-4.6 8.6-8.9 8.7-15.6c.2-9-12.8-20.9-3.1-30.4s23.7 6.2 34 5s22.8-15.5 24.1-21.6s-11.7-21.8-9.7-30.7c.7-3 6.8-10 11.4-11s25 6.9 29.6 5.9c5.6-1.2 12.1-7.1 17.4-10.4c15.5 6.7 29.6 9.4 47.7 9.4c68.5 0 124-53.4 124-119.2S408.5 48 340 48s-121.9 53.37-121.9 119.17M400 144a32 32 0 1 1-32-32a32 32 0 0 1 32 32"
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


    <div class="container">
        <h1>Liste des Propriétés</h1>

        <?php if ($result->num_rows > 0) : ?>
            <?php while ($row = $result->fetch_assoc()) : ?>
                <div class="property">
                    <h2><?= htmlspecialchars($row['titre']) ?> </h2>
                    <p><strong>Type :</strong> <?= htmlspecialchars($row['type']) ?></p>
                    <p><strong>Prix :</strong> <?= number_format($row['prix'], 2) ?> DZD</p>
                    <p><strong>Localisation :</strong> <?= htmlspecialchars($row['localisation']) ?></p>
                    <p><strong>Type d'Offre :</strong> <?= htmlspecialchars($row['type_offre']) ?></p>
                    <p><strong>Description :</strong> <?= nl2br(htmlspecialchars($row['description'])) ?></p>
                    
                    <div class="photos-container">
                        <div class="photos">
                            <?php 
                            $images = [];
                            if (!empty($row['image_01'])) $images[] = "uploads/" . $row['image_01'];
                            if (!empty($row['image_02'])) $images[] = "uploads/" . $row['image_02'];
                            if (!empty($row['image_03'])) $images[] = "uploads/" . $row['image_03'];
                            if (!empty($row['image_04'])) $images[] = "uploads/" . $row['image_04'];
                            if (!empty($row['photos'])) {
                                $more_images = explode(',', $row['photos']);
                                foreach ($more_images as $img) {
                                    $images[] = htmlspecialchars($img);
                                }
                            }
                            foreach ($images as $img) : ?>
                                <img src="<?= htmlspecialchars($img) ?>" alt="Photo de la propriété">
                            <?php endforeach; ?>
                        </div>
                    </div>
                    <a href="">
                    <div style="display: flex; gap: 10px;">
    <form action="supprimer_propriete_en_attente.php" method="post" 
          onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette propriété ?');"
          style="display: inline;">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <input type="hidden" name="redirect" value="manage_propriete_en_attente.php">
        <button type="submit" style="background-color: #d9534f; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer;">
            Supprimer
        </button>
    </form>

    <form action="accepter_propriete.php" method="POST" style="display: inline;">
        <input type="hidden" name="id" value="<?= $row['id'] ?>">
        <button type="submit" style="background-color: #5cb85c; color: white; border: none; padding: 8px 12px; border-radius: 4px; cursor: pointer;">
            Accepter
        </button>
    </form>
</div>

                    </a>
                </div>
                  
                
            <?php endwhile; ?>
        <?php else : ?>
            <p>Aucune propriété disponible.</p>
        <?php endif; ?>
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

<?php $conn->close(); ?>
