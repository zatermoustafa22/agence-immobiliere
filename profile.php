<?php
session_start();

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'proprietaire') {
    header("Location: changer_role.php");
    exit();
}

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

// ID utilisateur connecté
$user_id = $_SESSION['user_id'];

// Récupérer toutes les propriétés ajoutées par l'utilisateur
$sql = "SELECT * FROM propriete WHERE utilisateur_id = ? ORDER BY cree_a DESC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Affichage des propriétés
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" href="logo2.png">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
    <title>Mon Profil - Propriétaire</title>
    <style>
   body {
    font-family: 'Roboto', sans-serif;
    margin: 0;
    padding: 0;
    color: #264653;
    background: 
        linear-gradient(to bottom, rgba(0, 0, 0, 0) 0%, rgba(0, 0, 0, 0.6) 60%, #000000 100%),
        url('amin.jpg') no-repeat center center fixed;
    background-size: cover;
    background-attachment: fixed;
}



    h1, h2 {
        text-align: center;
        color: #ffffff;
    }

    a {
        color: #4da6ff;
        text-decoration: none;
        font-weight: bold;
    }

    a:hover {
        text-decoration: underline;
        color: #80c1ff;
    }

    .propriete {
        background-color: #1a2b47;
        border: 1px solid #2d3e59;
        border-radius: 10px;
        padding: 20px;
        margin: 20px auto;
        max-width: 800px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.5);
    }

    .propriete img {
    width: 300px;
    height: 300px;
    object-fit: cover;
    border-radius: 10px;
    display: block;
    margin: 10px auto;
}

/*
hadi chwiya kbira 
.propriete img {
    width: 100%;
    max-width: 400px; 
    height: auto;
    border-radius: 10px;
    margin: 10px auto;
    display: block;
    object-fit: cover;
}
*/


    /* Zoomable image styles */
.zoomable {
    cursor: pointer;
    transition: transform 0.3s ease;
}

.zoomable:hover {
    transform: scale(1.02);
}

/* Fullscreen overlay for zoom */
#imageModal {
    display: none;
    position: fixed;
    z-index: 1000;
    top: 0; left: 0;
    width: 100vw;
    height: 100vh;
    
    justify-content: center;
    align-items: center;
}

#imageModal img {
    max-width: 90%;
    max-height: 90%;
    border-radius: 10px;
}

#imageModal:target {
    display: flex;
}


    .propriete h3 {
        margin: 0 0 10px;
        font-size: 1.8em;
        color: #ffffff;
    }

    .propriete p {
        margin: 6px 0;
        color: #d0d0d0;
    }

    .propriete p strong {
        color: #ffffff;
    }

    p a {
        margin-right: 10px;
    }

    .add-link {
        text-align: center;
        margin-top: 30px;
    }

    .add-link a {
        padding: 10px 20px;
        background-color: #004080;
        color: #fff;
        border-radius: 5px;
        display: inline-block;
        transition: background-color 0.3s ease;
    }

    .add-link a:hover {
        background-color: #0059b3;
    }
    footer {
    background: linear-gradient(to top, #000000     50%, transparent);
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
        .container {
  display: flex;
  justify-content: center; /* centers horizontally */
  /* optional: align-items: center; to center vertically if container has a height */
}

@media (max-width: 600px) {
    .propriete {
        padding: 15px;
        margin: 10px;
    }

    .add-property-btn {
        width: 100%;
        text-align: center;
    }
}
.image-slider {
    position: relative;
    max-width: 100%;
    text-align: center;
}

.slide-img {
    width: 100%;
    border-radius: 10px;
    transition: opacity 0.3s ease-in-out;
}

.prev-btn, .next-btn {
    position: absolute;
    top: 50%;
    transform: translateY(-50%);
    background-color: rgba(0,0,0,0.6);
    color: white;
    border: none;
    padding: 10px 14px;
    font-size: 20px;
    cursor: pointer;
    border-radius: 50%;
    z-index: 10;
}

.prev-btn {
    left: 10px;
}

.next-btn {
    right: 10px;
}

.prev-btn:hover, .next-btn:hover {
    background-color: rgba(0,0,0,0.8);
}
 .slide-indicator {
    text-align: center;
    color: #ffffff;
    font-weight: bold;
    margin-top: 5px;
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
            background-color:  #f4a261;
            color: white;
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
  left: 25px;
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




        <a href="logout.php" class="connexion-btn">Deconnexion</a>
    </nav>
<!-- Top-left button container -->
<div class="top-left-button">
  <button class="button" onclick="window.location.href='modifier_profile.php'">
    <i class="fas fa-user-edit"></i> Modifier vos informations personnelle
  </button>
</div>

<h1>Bienvenue, <?php echo htmlspecialchars($_SESSION['nom_utilisateur']); ?> !</h1>

<div class="container">
  <a href="ajouter_propriete.php" class="button">Ajouter une nouvelle propriété</a>
</div>

<h2>Mes propriétés</h2>


<?php
if ($result->num_rows > 0) {
    // Afficher chaque propriété
    while ($row = $result->fetch_assoc()) {
        echo "<div class='propriete'>";
        echo "<h3>" . htmlspecialchars($row['titre']) . "</h3>";
        echo "<p><strong>Description :</strong> " . htmlspecialchars($row['description']) . "</p>";
        echo "<p><strong>Prix :</strong> " . number_format($row['prix'], 2, ',', ' ') . " DZD</p>";
        echo "<p><strong>Localisation :</strong> " . htmlspecialchars($row['localisation']) . "</p>";
        echo "<p><strong>Type d'Offre :</strong> " . htmlspecialchars($row['type_offre']) . "</p>";
        echo "<p><strong>Type :</strong> " . htmlspecialchars($row['type']) . "</p>";
        echo "<p><strong>Contact :</strong> " . htmlspecialchars($row['contacts']) . "</p>";
        if ($row['statut'] === 'en_attente') {
    echo "<p><strong>Statut :</strong> <span style='color: orange;'>En attente</span></p>";
}

        
        // Afficher les images (si elles existent)
// Image slider container
$imageSliderId = "slider_" . $row['id'];
echo "<div class='image-slider' id='$imageSliderId'>";



$images = [];
for ($i = 1; $i <= 5; $i++) {
    $image_field = 'image_0' . $i;
    if (!empty($row[$image_field])) {
        $images[] = 'uploads/' . htmlspecialchars($row[$image_field]);
    }
}

// Display images inside the slider
foreach ($images as $index => $imagePath) {
    $displayStyle = $index === 0 ? "display: block;" : "display: none;";
    echo "<a href='#imageModal' onclick='zoomImage(\"$imagePath\")'>
            <img src='$imagePath' class='zoomable slide-img' style='$displayStyle' data-index='$index'>
          </a>";
}

if (count($images) > 1) {
    echo "<button class='prev-btn' onclick='changeSlide(\"$imageSliderId\", -1)'>❮</button>";
    echo "<button class='next-btn' onclick='changeSlide(\"$imageSliderId\", 1)'>❯</button>";
}

echo "</div>";
if (count($images) > 1) {
    echo "<div class='slide-indicator' id='indicator_$imageSliderId'>1 / " . count($images) . "</div>";
}


        // Optionnel : Ajouter des boutons pour éditer/supprimer
        echo "<p><a href='modifier_propriete.php?id=" . $row['id'] . "'>Modifier</a> | <a href='supprimer_propriete_profile.php?id=" . $row['id'] . "'>Supprimer</a></p>";
        echo "</div>";
    }
} else {
    echo "<p>Vous n'avez pas encore publié de propriétés.</p>";
}
?>




<?php
// Fermer la connexion
$stmt->close();
$conn->close();
?>
<div id="imageModal" onclick="closeImage()">
    <img id="modalImage" src="" >
</div>
<script>
    function zoomImage(src) {
        document.getElementById('modalImage').src = src;
        document.getElementById('imageModal').style.display = 'flex';
    }

    function closeImage() {
        document.getElementById('imageModal').style.display = 'none';
    }
</script>
<script>
function changeSlide(sliderId, direction) {
    const slider = document.getElementById(sliderId);
    const images = slider.querySelectorAll('.slide-img');
    let currentIndex = Array.from(images).findIndex(img => img.style.display === 'block');

    images[currentIndex].style.display = 'none';
    let newIndex = currentIndex + direction;

    if (newIndex < 0) {
        newIndex = images.length - 1;
    } else if (newIndex >= images.length) {
        newIndex = 0;
    }

    images[newIndex].style.display = 'block';

    // Update the slide indicator
    const indicator = document.getElementById('indicator_' + sliderId);
    if (indicator) {
        indicator.textContent = (newIndex + 1) + ' / ' + images.length;
    }
}

</script>
<script>
function createImageSlider(images) {
    const container = document.createElement('div');
    container.className = 'image-slider';

    const image = document.createElement('img');
    image.className = 'slider-image';
    container.appendChild(image);

    const leftBtn = document.createElement('button');
    leftBtn.className = 'slider-button left';
    leftBtn.innerHTML = '&#9664;';
    container.appendChild(leftBtn);

    const rightBtn = document.createElement('button');
    rightBtn.className = 'slider-button right';
    rightBtn.innerHTML = '&#9654;';
    container.appendChild(rightBtn);

    // Slide indicator
    const indicator = document.createElement('div');
    indicator.className = 'slide-indicator';
    container.appendChild(indicator);

    let currentIndex = 0;

    function updateImage() {
        image.src = images[currentIndex];
        indicator.textContent = (currentIndex + 1) + ' / ' + images.length;
    }

    leftBtn.addEventListener('click', () => {
        currentIndex = (currentIndex - 1 + images.length) % images.length;
        updateImage();
    });

    rightBtn.addEventListener('click', () => {
        currentIndex = (currentIndex + 1) % images.length;
        updateImage();
    });

    updateImage();
    return container;
}
</script>
    <footer>
        <p>&copy; 2025 Agence Immobilière. Tous droits réservés.</p>
        <p>
            Contactez-nous : mimwarimmo@gmail.com | +213 0794882726 | +213 0655657509
            <a href="logout.php">Deconnexion</a>

        </p>
    </footer>
</body>
</html>
