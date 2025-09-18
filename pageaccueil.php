<!DOCTYPE html>
<html lang="fr">
<head>
    <link rel="icon" type="image/png" href="logo2.png">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Agence Immobilière</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        /* General Styles */
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            color: #264653;
            background-color:rgb(255, 255, 255);
            
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
        nav .connectBtn {
             margin-left: auto;
            background-color: #f8f9fa;
            color: #000;
            padding: 8px 15px;
            border-radius: 5px;
            font-weight: 700;
            text-decoration: none;
            transition: background-color 0.3s, color 0.3s;
        }
        nav .connectBtn:hover {
            background-color: #f4a261;
            color: white;
        }

      
        .hero {
    text-align: center;
    background:radial-gradient(circle, #ffedea, #ffccb6);
    padding: 40px;
    border-radius: 12px;
    box-shadow: 0 4px 10px rgba(0, 0, 0, 0.1);
  
    max-width: 800px;

    width: 100%;
    margin: auto;
    margin-top: 50px;
    margin-bottom: 50px;
}

.hero img {
    max-width: 100px;
    margin-bottom: 20px;
}

.hero h1 {
    font-size: 24px;
    color: #333;
    margin: 0;
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
/*hover effect*/
button:hover {
  color: #fff;
  background-color: #1A1A1A;
  box-shadow: rgba(0, 0, 0, 0.5) 0 10px 20px;
  transform: translateY(-3px);
}
/*button pressing effect*/
button:active {
  box-shadow: none;
  transform: translateY(0);
}

.searchInput {
  border: none;
  background: none;
  outline: none;
  color: white;
  font-size: 15px;
  padding: 24px 46px 24px 26px;
}
.button {
  cursor: pointer;
  position: relative;
  padding: 10px 24px;
  font-size: 18px;
  color: rgb(193, 163, 98);
  border: 2px solid rgb(193, 163, 98);
  border-radius: 34px;
  background-color: transparent;
  font-weight: 600;
  transition: all 0.3s cubic-bezier(0.23, 1, 0.320, 1);
  overflow: hidden;
}

.button::before {
  content: '';
  position: absolute;
  inset: 0;
  margin: auto;
  width: 50px;
  height: 50px;
  border-radius: inherit;
  scale: 0;
  z-index: -1;
  background-color: rgb(0, 0, 0);
  transition: all 0.6s cubic-bezier(0.23, 1, 0.320, 1);
}

.button:hover::before {
  scale: 3;
}

.button:hover {
  color: #212121;
  scale: 1.1;
  box-shadow: 0 0px 20px rgba(0, 0, 0, 0.4);
}

.button:active {
  scale: 1;
}
.connectBtn {
  width: 120px;
  height: 40px;
  border: none;
  border-radius: 30px;
  display: flex;
  align-items: center;
  justify-content: center;
  gap: 7px;
  color: white;
  font-weight: 600;
  background: linear-gradient( to right,#fcdcc2,#f4a261);
  box-shadow: 0 10px 20px -7px rgba(241, 217, 185, 0.5);
  transition: all 0.3s ease-in-out;
  cursor: pointer;
}

.connectBtn:hover {
  box-shadow: none;
  transform: translate(0px, 2.2px);
}

.connectBtn:active {
  transform: scale(0.96) translate(0px, 3.2px);
}


nav {
    display: flex;
    justify-content: flex-start; /* Aligns items to the left */
    align-items: center;
    background-color: #000000;
    padding: 15px;
    gap: 15px;
}

nav .connectBtn {
    margin-left: 0; /* Remove auto margin */
}

nav .searchBox {
    margin-left: auto; /* Push the search box to the right */
    
}

/**/ 
.banner {
            background: linear-gradient(45deg,rgb(240, 199, 178), #fef6f3);
            padding: 60px 80px;
            text-align: center;
            margin: auto;
            border-radius: 15px;
            width: 100%;
            max-width: 800px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            position: relative;
        }

        .banner h2 {
            color: #111;
            font-family: Arial, sans-serif;
            font-size: 20px;
            margin-bottom: 15px;

        }

        .cta-button {
            display: flex;
            align-items: center;
            justify-content: center;
            background-color: #e65100;
            color: white;
            padding: 10px 20px;
            text-decoration: none;
            font-size: 16px;
            font-weight: bold;
            border-radius: 8px;
            transition: background 0.3s;
            border: none;
            cursor: pointer;
        }

        .cta-button:hover {
            background-color: #f4a261;
        }

        .cta-button img {
            width: 18px;
            height: 18px;
            margin-right: 8px;
        }

        /* Decorative Elements */
        .decor-left, .decor-right {
            position: absolute;
            width: 50px;
            height: 50px;
            opacity: 0.5;
        }

        .decor-left {
            bottom: -10px;
            left: -10px;
        }

        .decor-right {
            top: -10px;
            right: -10px;
        }
        /**/ 
         .first,
.first:focus {
  font-size: 17px;
  padding: 10px 25px;
  border-radius: 0.7rem;
  background-image: linear-gradient(rgb(243, 222, 176), #f4a261);
  border: 2px solid rgb(50, 50, 50);
  border-bottom: 5px solid rgb(50, 50, 50);
  box-shadow: 0px 1px 6px 0px rgb(158, 129, 254);
  transform: translate(0, -3px);
  cursor: pointer;
  transition: 0.2s;
  transition-timing-function: linear;
}

 .first:active {
  transform: translate(0, 0);
  border-bottom: 2px solid rgb(50, 50, 50);
}


    </style>
</head>
<body>
    
    <nav>
   <!-- <button class="button">
<a href="#"><span >Accueil</span></a> 
</button>-->
<a href="#" ><button class="connectBtn">
<svg
  role="img"
  xmlns="http://www.w3.org/2000/svg"
  viewBox="0 0 24 24"
  width="24px"
  height="24px"
>
  <path
    fill="#000000"
    d="M12 22a2.98 2.98 0 0 0 2.818-2H9.182A2.98 2.98 0 0 0 12 22m7-7.414V10c0-3.217-2.185-5.927-5.145-6.742C13.562 2.52 12.846 2 12 2s-1.562.52-1.855 1.258C7.185 4.074 5 6.783 5 10v4.586l-1.707 1.707A.996.996 0 0 0 3 17v1a1 1 0 0 0 1 1h16a1 1 0 0 0 1-1v-1a.996.996 0 0 0-.293-.707z"
  />
</svg> <span >Accueil</span> 
</button></a>

<!--<button class="button">
<a href="#"><span >Propriétés</span></a> 
</button>-->

<a href="#"><button class="connectBtn">
<svg
  role="img"
  xmlns="http://www.w3.org/2000/svg"
  viewBox="0 0 24 24"
  width="24px"
  height="24px"
>
  <path
    fill="#000000"
    d="M0 21V10l7.5-5l7.5 5v11h-5v-7H5v7zM24 2v19h-7V8.93l-1-.66V6h-2v.93l-4-2.66V2zm-3 12h-2v2h2zm0-4h-2v2h2zm0-4h-2v2h2z"
  />
</svg> <span >Propriétés</span> 
</button></a>
<!--<button class="button">
<a href="#"><span >Favoris</span></a> 
</button>-->
<a href="#"><button class="connectBtn">
<svg
    role="img"
    xmlns="http://www.w3.org/2000/svg"
    viewBox="0 0 1024 1024"
    height={height}
    focusable={focusable}
    {...props}
  >
    <path
      fill={fill}
      d="M923 283.6a260.04 260.04 0 0 0-56.9-82.8a264.4 264.4 0 0 0-84-55.5A265.34 265.34 0 0 0 679.7 125c-49.3 0-97.4 13.5-139.2 39c-10 6.1-19.5 12.8-28.5 20.1c-9-7.3-18.5-14-28.5-20.1c-41.8-25.5-89.9-39-139.2-39c-35.5 0-69.9 6.8-102.4 20.3c-31.4 13-59.7 31.7-84 55.5a258.44 258.44 0 0 0-56.9 82.8c-13.9 32.3-21 66.6-21 101.9c0 33.3 6.8 68 20.3 103.3c11.3 29.5 27.5 60.1 48.2 91c32.8 48.9 77.9 99.9 133.9 151.6c92.8 85.7 184.7 144.9 188.6 147.3l23.7 15.2c10.5 6.7 24 6.7 34.5 0l23.7-15.2c3.9-2.5 95.7-61.6 188.6-147.3c56-51.7 101.1-102.7 133.9-151.6c20.7-30.9 37-61.5 48.2-91c13.5-35.3 20.3-70 20.3-103.3c.1-35.3-7-69.6-20.9-101.9M512 814.8S156 586.7 156 385.5C156 283.6 240.3 201 344.3 201c73.1 0 136.5 40.8 167.7 100.4C543.2 241.8 606.6 201 679.7 201c104 0 188.3 82.6 188.3 184.5c0 201.2-356 429.3-356 429.3"
    />
  </svg> <span >Favoris</span> 
</button></a>
<!--<button class="button">
<a href="#"><span >Contact</span></a> 
</button>-->
<!-- From Uiverse.io by vinodjangid07 --> 
<a href="#"><button class="connectBtn">
<svg
  role="img"
  xmlns="http://www.w3.org/2000/svg"
  viewBox="0 0 512 512"
  width="18"
  height="18"
>
  <path
    fill="#000000"
    d="M164.9 24.6c-7.7-18.6-28-28.5-47.4-23.2l-88 24C12.1 30.2 0 46 0 64c0 247.4 200.6 448 448 448c18 0 33.8-12.1 38.6-29.5l24-88c5.3-19.4-4.6-39.7-23.2-47.4l-96-40c-16.3-6.8-35.2-2.1-46.3 11.6L304.7 368c-70.4-33.3-127.4-90.3-160.7-160.7l49.3-40.3c13.7-11.2 18.4-30 11.6-46.3l-40-96z"
  />
</svg>
<span >Contact</span> 
</button></a>
<!--a href="connexion.html">Accueil</a>
        <a href="connexion.html">Propriétés</a>
        <a href="connexion.html">Favoris</a>
        <a href="contact.html">Favoris</a>-->
        <div class="searchBox">

            <input class="searchInput" type="text" name="" placeholder="Search something">
            <button class="searchButton" href="#">
                   
                  

                                <svg xmlns="http://www.w3.org/2000/svg" width="29" height="29" viewBox="0 0 29 29" fill="none">
  <g clip-path="url(#clip0_2_17)">
    <g filter="url(#filter0_d_2_17)">
      <path d="M23.7953 23.9182L19.0585 19.1814M19.0585 19.1814C19.8188 18.4211 20.4219 17.5185 20.8333 16.5251C21.2448 15.5318 21.4566 14.4671 21.4566 13.3919C21.4566 12.3167 21.2448 11.252 20.8333 10.2587C20.4219 9.2653 19.8188 8.36271 19.0585 7.60242C18.2982 6.84214 17.3956 6.23905 16.4022 5.82759C15.4089 5.41612 14.3442 5.20435 13.269 5.20435C12.1938 5.20435 11.1291 5.41612 10.1358 5.82759C9.1424 6.23905 8.23981 6.84214 7.47953 7.60242C5.94407 9.13789 5.08145 11.2204 5.08145 13.3919C5.08145 15.5634 5.94407 17.6459 7.47953 19.1814C9.01499 20.7168 11.0975 21.5794 13.269 21.5794C15.4405 21.5794 17.523 20.7168 19.0585 19.1814Z" stroke="white" stroke-width="3" stroke-linecap="round" stroke-linejoin="round" shape-rendering="crispEdges"></path>
    </g>
  </g>
  <defs>
    <filter id="filter0_d_2_17" x="-0.418549" y="3.70435" width="29.7139" height="29.7139" filterUnits="userSpaceOnUse" color-interpolation-filters="sRGB">
      <feFlood flood-opacity="0" result="BackgroundImageFix"></feFlood>
      <feColorMatrix in="SourceAlpha" type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 127 0" result="hardAlpha"></feColorMatrix>
      <feOffset dy="4"></feOffset>
      <feGaussianBlur stdDeviation="2"></feGaussianBlur>
      <feComposite in2="hardAlpha" operator="out"></feComposite>
      <feColorMatrix type="matrix" values="0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0 0.25 0"></feColorMatrix>
      <feBlend mode="normal" in2="BackgroundImageFix" result="effect1_dropShadow_2_17"></feBlend>
      <feBlend mode="normal" in="SourceGraphic" in2="effect1_dropShadow_2_17" result="shape"></feBlend>
    </filter>
    <clipPath id="clip0_2_17">
      <rect width="28.0702" height="28.0702" fill="white" transform="translate(0.403503 0.526367)"></rect>
    </clipPath>
  </defs>
</svg>
                     

            </button>
        </div>
        <a href="#"><button class="connectBtn">
  <svg xmlns="http://www.w3.org/2000/svg" height="1em" viewBox="0 0 640 512" fill="white"><path d="M579.8 267.7c56.5-56.5 56.5-148 0-204.5c-50-50-128.8-56.5-186.3-15.4l-1.6 1.1c-14.4 10.3-17.7 30.3-7.4 44.6s30.3 17.7 44.6 7.4l1.6-1.1c32.1-22.9 76-19.3 103.8 8.6c31.5 31.5 31.5 82.5 0 114L422.3 334.8c-31.5 31.5-82.5 31.5-114 0c-27.9-27.9-31.5-71.8-8.6-103.8l1.1-1.6c10.3-14.4 6.9-34.4-7.4-44.6s-34.4-6.9-44.6 7.4l-1.1 1.6C206.5 251.2 213 330 263 380c56.5 56.5 148 56.5 204.5 0L579.8 267.7zM60.2 244.3c-56.5 56.5-56.5 148 0 204.5c50 50 128.8 56.5 186.3 15.4l1.6-1.1c14.4-10.3 17.7-30.3 7.4-44.6s-30.3-17.7-44.6-7.4l-1.6 1.1c-32.1 22.9-76 19.3-103.8-8.6C74 372 74 321 105.5 289.5L217.7 177.2c31.5-31.5 82.5-31.5 114 0c27.9 27.9 31.5 71.8 8.6 103.9l-1.1 1.6c-10.3 14.4-6.9 34.4 7.4 44.6s34.4 6.9 44.6-7.4l1.1-1.6C433.5 260.8 427 182 377 132c-56.5-56.5-148-56.5-204.5 0L60.2 244.3z"></path></svg>
  Connect
</button></a>

      <!-- <a href="connexion.html" class="connexion-btn">Connexion</a>-->
    </nav>



    <div class="hero">
        <img src="logo2.png" alt="Agence Immobilière Logo" style="max-width: 100px; margin-bottom: 20px;">
        <h1>Bienvenue sur notre Agence Immobilière</h1>
        
    </div>
    <div class="banner">
        <h2>C'est le moment de vendre</h2>
        <a href="ajouter_propriete.php" class="cta-button">
            <img src="https://cdn-icons-png.flaticon.com/512/1828/1828817.png" alt="icon"> Déposer une annonce
        </a>
        <!--<img src="https://via.placeholder.com/50/FFAB91/FFFFFF?text=🌊" class="decor-left" alt="decor-left">
        <img src="https://via.placeholder.com/50/90CAF9/FFFFFF?text=🌼" class="decor-right" alt="decor-right">-->
    </div>


    <div class="property-examples">
        <div class="property-card">
            <img src="mama.jpg" alt="Maison Moderne">
            <h3>Maison Moderne</h3>
            <p>1DA - 4 chambres, 2 salles de bain</p>
            <a href="#"><button class="first" >Acheter</button></a>
        </div>
        <div class="property-card">
            <img src="4.png" alt="Appartement Chic">
            <h3>Appartement Chic</h3>
            <p>500000000DA - 3 chambres, 1 salle de bain</p>
            <a href="#"><button class="first" >Acheter</button></a>
        </div>
        <div class="property-card">
            <img src="fifa.png" alt="Villa Luxueuse">
            <h3>Villa Luxueuse</h3>
            <p>1,200,00000DA - 5 chambres, piscine</p>
            <a href="#"><button class="first" >Acheter</button></a>
        </div>
        <div class="property-card">
            <img src=".jpg" alt="Maison de Campagne">
            <h3>Maison de Campagne</h3>
            <p>275,00000DA - 3 chambres, grand jardin</p>
            <a href="#"><button class="first" >Acheter</button></a>
        </div>
        <div class="property-card">
            <img src=".jpg" alt="Studio en Ville">
            <h3>Studio en Ville</h3>
            <p>150,00000DA - 1 chambre, idéal étudiant</p>
            <a href="#"><button class="first" >Acheter</button></a>
        </div>
        <div class="property-card">
            <img src=".jpg" alt="Villa en Bord de Mer">
            <h3>Villa en Bord de Mer</h3>
            <p>950,00000DA - Vue imprenable sur la mer</p>
            <a href="#"><button class="first" >Acheter</button></a>
        </div>
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
