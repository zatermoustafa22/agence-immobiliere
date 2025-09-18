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

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = htmlspecialchars(trim($_POST['titre']), ENT_QUOTES, 'UTF-8');
    $description = htmlspecialchars(trim($_POST['description']), ENT_QUOTES, 'UTF-8');
    $prix = floatval($_POST['prix']);
    $type = htmlspecialchars(trim($_POST['type']), ENT_QUOTES, 'UTF-8');
    $localisation = htmlspecialchars(trim($_POST['localisation']), ENT_QUOTES, 'UTF-8');
    $contacts = htmlspecialchars(trim($_POST['contacts']), ENT_QUOTES, 'UTF-8');
    $type_offre = htmlspecialchars(trim($_POST['type_offre']), ENT_QUOTES, 'UTF-8');

    // Traitement des images
    $upload_dir = 'uploads/';
    if (!is_dir($upload_dir)) {
        mkdir($upload_dir, 0777, true);
    }

    $image_fields = ['image_01', 'image_02', 'image_03', 'image_04', 'image_05'];
    $image_paths = [];
    $allowed_types = ['image/jpeg', 'image/png', 'image/gif'];
    $errors = [];

    foreach ($image_fields as $field) {
        if (!empty($_FILES[$field]['name'])) {
            $file_name = time() . '_' . basename($_FILES[$field]['name']);
            $file_tmp = $_FILES[$field]['tmp_name'];
            $file_size = $_FILES[$field]['size'];
            $file_type = mime_content_type($file_tmp);
            $file_path = $upload_dir . $file_name;

            
            if (!in_array($file_type, $allowed_types)) {
                $errors[] = "Format invalide pour $field ! (Seuls JPG, PNG, GIF sont acceptés)";
            } else {
                if (move_uploaded_file($file_tmp, $file_path)) {
                    $image_paths[$field] = $file_name;
                } else {
                    $image_paths[$field] = '';
                }
            }
        } else {
            $image_paths[$field] = '';
        }
    }

    if (!empty($errors)) {
        $_SESSION['message'] = implode("\n", $errors);
        header("Location: ajouter_propriete.php");
        exit();
    }

    // Ajout de la propriété avec utilisateur_id
    $stmt = $conn->prepare("INSERT INTO propriete 
    (utilisateur_id, titre, description, prix, contacts, type, localisation, type_offre, cree_a, modifie_a, image_01, image_02, image_03, image_04, image_05) 
    VALUES (?, ?, ?, ?, ?, ?, ?, ?, NOW(), NOW(), ?, ?, ?, ?, ?)");

    // Lier les paramètres : utilisateur_id est inclus ici
    $stmt->bind_param(
        'issdsssssssss',
        $_SESSION['user_id'], // utilisateur_id
        $titre, 
        $description, 
        $prix, 
        $contacts,
        $type, 
        $localisation, 
        $type_offre,
        $image_paths['image_01'], 
        $image_paths['image_02'], 
        $image_paths['image_03'], 
        $image_paths['image_04'],
        $image_paths['image_05']
    );

    // Exécuter la requête
    if ($stmt->execute()) {
        $_SESSION['message'] =  "Propriété ajoutée à la file d'attente.";
        header("Location: ajouter_propriete.php");
    } else {
        $_SESSION['message'] = "Erreur : " . $stmt->error;
    }

    // Fermeture de la connexion
    $stmt->close();
    $conn->close();
    exit();
}
?>


<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" type="image/png" href="logo2.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Ajouter une propriété</title>
    <script>
        window.onload = function() {
            <?php if (!empty($_SESSION['message'])): ?>
                alert("<?php echo $_SESSION['message']; ?>");
                <?php unset($_SESSION['message']); ?>
            <?php endif; ?>
        };
    </script>
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
            color: #333;
        }
        .form-group {
            margin-bottom: 15px;
        }
        label {
            display: block;
            font-weight: bold;
            margin-bottom: 5px;
        }
        input, textarea, select, button {
            width: 100%;
            padding: 10px;
            border: 1px solid #ccc;
            border-radius: 4px;
            font-size: 16px;
        }
        button {
            background-color: #4CAF50;
            color: white;
            font-weight: bold;
            cursor: pointer;
        }
        button:hover {
            background-color: #45a049;
        }
        .hero {
           /* background: 
                linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.7) 70%, #000000 100%),
                url('amin.jpg') no-repeat center center/cover;*/
            height: 500px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            color: white;
            text-shadow: 2px 2px 6px #000;
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
        nav {
    display: flex;
    justify-content: center;
    background-color: #000000;
    padding: 15px;
    gap: 15px;
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

           /* Footer */
           footer {
            background-color: black;
            color: white;
            text-align: center;
            padding: 20px 10px;
            font-size: 0.9rem;
        }

        footer a {
            color:  #4d4db3;
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

<div class="searchBox">

     


</div>

    
    <a href="accueil.php"> 
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
    <a href="afficher_propriete.php"><!-- From Uiverse.io by milegelu --> 
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
    <a href="changer_role.php"><!-- From Uiverse.io by milegelu --> 
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
    
    <a href="favoris.php"><!-- From Uiverse.io by milegelu --> 
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

<a href="demande_ad.html"><!-- From Uiverse.io by milegelu --> 
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

<a href="profile.php"><!-- From Uiverse.io by milegelu --> 
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

    <a href="connexion.php" class="connexion-btn">Deconnexion</a>
</nav>

    <div class="hero">
        <img src="logo2.png" alt="Agence Immobilière Logo" style="max-width: 100px; margin-bottom: 20px;">
        <h1>Déposer votre annonce</h1>
    </div>

    <?php if (!empty($message)) : ?>
        <p class="message"><?php echo htmlspecialchars($message); ?></p>
    <?php endif; ?>

    <form action="" method="POST" enctype="multipart/form-data">
        <h1>Ajouter une Propriété</h1>
        <div class="form-group">
            <label for="titre">Titre de la propriété :</label>
            <input type="text" id="titre" name="titre" required>
        </div>
        <div class="form-group">
            <label for="description">Description :</label>
            <textarea id="description" name="description" rows="4" required></textarea>
        </div>
        <div class="form-group">
            <label for="prix">Prix (DZD) :</label>
            <input type="number" id="prix" name="prix" step="0.01" required>
        </div>
        <div class="form-group">
            <label for="contacts">contact du proprietaire :</label>
            <input type="text" id="contacts" name="contacts" required>
        </div>
        <div class="form-group">
            <label for="type">Type de propriété :</label>
            <select id="type" name="type" required>
                <option value="appartement">Appartement</option>
                <option value="maison">Maison</option>
                <option value="commercial">Commercial</option>
                <option value="terrain">Terrain</option>
            </select>
        </div>
        <label for="type_offre">Type d'Offre:</label>
<select name="type_offre" id="type_offre">
  <option value="a_louer">À Louer</option>
  <option value="a_vendre">À Vendre</option>
</select>


        <div class="form-group">
            <label for="localisation">Localisation :</label>
            <input type="text" id="localisation" name="localisation" required>
        </div>
        <div class="box">
         <p>image 01 (principale)<span>*</span></p>
         <input type="file" name="image_01" class="input" accept="image/*" required>
      </div>
      <div class="flex"> 
         <div class="box">
            <p>image 02</p>
            <input type="file" name="image_02" class="input" accept="image/*">
         </div>
         <div class="box">
            <p>image 03</p>
            <input type="file" name="image_03" class="input" accept="image/*">
         </div>
         <div class="box">
            <p>image 04</p>
            <input type="file" name="image_04" class="input" accept="image/*">
         </div>
         <div class="box">
            <p>image 05</p>
            <input type="file" name="image_05" class="input" accept="image/*">
         </div>   
      </div>
        <button type="submit">Ajouter la propriété</button>
    </form>

    <footer>
        <p>&copy; 2025 Agence Immobilière. Tous droits réservés.</p>
        <p>
            Contactez-nous : mimwarimmo@gmail.com | +213 0794882726 | +213 0655657509
            <a href="logout.php">Deconnexion</a>

        </p>
    </footer>

</body>
</html>