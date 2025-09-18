<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "immobilier";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Échec de la connexion : " . $conn->connect_error);
}

// Get filter inputs
$type = $_GET['type'] ?? '';
$type_offre = $_GET['type_offre'] ?? '';
$min_price = $_GET['min_price'] ?? '';
$max_price = $_GET['max_price'] ?? '';

// Build SQL query
$sql = "SELECT * FROM propriete WHERE statut = 'acceptee'";

// Add filters to query
if (!empty($type)) {
    $sql .= " AND type = '" . $conn->real_escape_string($type) . "'";
}
if (!empty($type_offre)) {
    $sql .= " AND type_offre = '" . $conn->real_escape_string($type_offre) . "'";
}
if (!empty($min_price)) {
    $sql .= " AND prix >= " . (float)$min_price;
}
if (!empty($max_price)) {
    $sql .= " AND prix <= " . (float)$max_price;
}

$sql .= " ORDER BY cree_a DESC";

$result = $conn->query($sql);
?>
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
        .container {
    max-width: 1200px;
    margin: 0 auto;
}

h1 {
    text-align: center;
    font-size: 48px;
    color:rgb(255, 255, 255);
    margin-bottom: 40px;
}

.property {
    background: #ffffff;
    padding: 30px;
    margin-bottom: 30px;
    border-radius: 16px;
    box-shadow: 0 6px 20px rgba(0, 0, 0, 0.08);
    transition: transform 0.3s ease, box-shadow 0.3s ease;
}

.property:hover {
    transform: translateY(-5px);
    box-shadow: 0 12px 30px rgba(0, 0, 0, 0.12);
}

.property h2 {
    color: #34495e;
    font-size: 32px;
    margin-bottom: 15px;
}

.property p {
    color: #555;
    margin: 10px 0;
    font-size: 20px;
    line-height: 1.6;
}

.photos-container {
    overflow-x: auto;
    white-space: nowrap;
    padding: 15px 0;
    margin-top: 15px;
    border-top: 1px solid #eee;
}

.photos {
    display: flex;
    gap: 15px;
}

.photos img {
    flex: 0 0 auto;
    width: 350px;
    height: 280px;
    object-fit: cover;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.15);
    transition: transform 0.3s, box-shadow 0.3s;
}

.photos img:hover {
    transform: scale(1.05);
    box-shadow: 0 6px 16px rgba(0, 0, 0, 0.2);
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
/**/
.favorisf {
  background: transparent;
  box-shadow: none;
}
.favoris {
  display: flex;
  justify-content: center;
  align-items: center;
  padding: 20px 25px 20px 22px;
  box-shadow: rgba(10, 37, 64, 0.35) 0px -2px 6px 0px inset;
  background-color: #e8e8e8;
  border-color: #ffe2e2;
  border-style: solid;
  border-width: 9px;
  border-radius: 35px;
  font-size: 25px;
  cursor: pointer;
  font-weight: 900;
  color: rgb(134, 124, 124);
  font-family: monospace;
  transition:
    transform 400ms cubic-bezier(0.68, -0.55, 0.27, 2.5),
    border-color 400ms ease-in-out,
    background-color 400ms ease-in-out;
  word-spacing: -2px;
  position: relative;
}

@keyframes favoris-movingBorders {
  0% {
    border-color: #fce4e4;
  }

  50% {
    border-color: #ffd8d8;
  }

  90% {
    border-color: #fce4e4;
  }
}

.favoris:hover {
  background-color: #eee;
  transform: scale(105%);
  animation: favoris-movingBorders 3s infinite;
}

.favoris svg {
  margin-right: 11px;
  fill: rgb(255, 110, 110);
  transition: opacity 100ms ease-in-out;
}

.favoris .filled {
  position: absolute;
  opacity: 0;
  top: 20px;
  left: 22px;
}

@keyframes favoris-beatingHeart {
  0% {
    transform: scale(1);
  }

  15% {
    transform: scale(1.15);
  }

  30% {
    transform: scale(1);
  }

  45% {
    transform: scale(1.15);
  }

  60% {
    transform: scale(1);
  }
 
}

.image-modal {
  display: none; 
  position: fixed;
  z-index: 9999;
  padding-top: 60px;
  left: 0;
  top: 0;
  width: 100%;
  height: 100%;
  overflow: auto;
  background-color: rgba(0, 0, 0, 0.9);
  cursor: zoom-out;
}

.image-modal-content {
  display: block;
  margin: auto;
  max-width: 90%;
  max-height: 80vh;
  animation: zoomIn 0.4s ease-in-out;
  border-radius: 10px;
}

@keyframes zoomIn {
  from {
    transform: scale(0.6);
    opacity: 0;
  }
  to {
    transform: scale(1);
    opacity: 1;
  }
}

.close {
  position: absolute;
  top: 15px;
  right: 35px;
  color: #fff;
  font-size: 40px;
  font-weight: bold;
  cursor: pointer;
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

    </style>
</head>
<body>
 <nav>

        
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
</svg>Manage demande
  </button>
</div>
 </a> 

       <a href="manage_propriete.php.php"> 
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
</svg>Manage proprietes
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
</svg>Manage utilisateurs
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

<button class="filter-button" onclick="toggleFilter()" style="color: white; display: flex; flex-direction: column; align-items: center; background: transparent; border: none;">
  <i class="fa fa-filter" style="color: white; font-size: 20px;"></i>
  <span style="margin-top: 4px;">Filtrer</span>
</button>


<form method="GET" action="filter_results_admin.php" class="filter-form" id="filterForm">
  <select name="type">
    <option value="">Type de bien</option>
    <option value="appartement">Appartement</option>
    <option value="maison">Maison</option>
    <option value="commercial">Commercial</option>
    <option value="terrain">Terrain</option>
  </select>

  <select name="type_offre">
    <option value="">Type d'offre</option>
    <option value="a_louer">À louer</option>
    <option value="a_vendre">À vendre</option>
  </select>

  <input type="number" name="min_price" placeholder="Prix min">
  <input type="number" name="max_price" placeholder="Prix max">

  <button type="submit">Filtrer</button>
</form>

<script>
  function toggleFilter() {
    const form = document.getElementById('filterForm');
    form.style.display = form.style.display === 'block' ? 'none' : 'block';
  }
</script>

</div>
        
        <a href="logout.php" class="connexion-btn">Deconnexion</a>
    </nav>


<div class="container">
    <h1>Résultats du Filtre</h1>

    <?php if ($result->num_rows > 0) : ?>
        <?php while ($row = $result->fetch_assoc()) : ?>
            <div class="property">
                <h2><?= htmlspecialchars($row['titre']) ?></h2>
                <p><strong>Type :</strong> <?= htmlspecialchars($row['type']) ?></p>
                <p><strong>Prix :</strong> <?= number_format($row['prix'], 2) ?> €</p>
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
                        if (!empty($row['image_05'])) $images[] = "uploads/" . $row['image_05'];
                        if (!empty($row['photos'])) {
                            $more_images = explode(',', $row['photos']);
                            foreach ($more_images as $img) {
                                $images[] = htmlspecialchars($img);
                            }
                        }
                        foreach ($images as $img) : ?>
                            <img src="<?= htmlspecialchars($img) ?>" alt="Photo de la propriété" onclick="openImageModal(this)">
                        <?php endforeach; ?>
                    </div>
                </div>
    <form action="supprimer_propriete.php" method="post" onsubmit="return confirm('Êtes-vous sûr de vouloir supprimer cette propriété ?');">
    <input type="hidden" name="id" value="<?= $row['id'] ?>">
    <input type="hidden" name="redirect" value="manage_propriete.php">
    <button type="submit" class="button" style="background-color:#d9534f;">Supprimer</button>
</form>

                   
            </div>
        <?php endwhile; ?>
    <?php else : ?>
        <p>Aucune propriété ne correspond à vos critères.</p>
    <?php endif; ?>

</div>
     <footer>
        <p>&copy; 2025 Agence Immobilière. Tous droits réservés.</p>
        <p>
            Contactez-nous : mimwarimmo@gmail.com | +213 0794882726 | +213 0655657509
            <a href="logout.php">Deconnexion</a>

        </p>
    </footer>
    <div id="imageModal" class="image-modal" onclick="closeImageModal()">
  <span class="close">&times;</span>
  <img class="image-modal-content" id="modalImage">
</div>
</body>
</html>


</body>