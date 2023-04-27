<!DOCTYPE html>
<html>

<head>
    <title>Notre histoire</title>
    <link rel="stylesheet" type="text/css" href="../css/histoire.css">
    <meta charset="utf-8">
</head>
<header>
    <div class="logo">
        <a href="index.php"><img src="../images/Mon projet (4).png" alt="Logo"></a>
    </div>
    <nav>
        <ul>
            <div class="superbounce">
                <li><a href="produit.php">Produit</a></li>
            </div>

            <div class="superbounce2">
                <li><a href="Histoire.php">Histoire</a></li>
            </div>
            <div class="superbounce2">
                <li><a href="FAQ.php">FAQ</a></li>
            </div>
        </ul>
        </ul>
    </nav>

    <div class="search-container">
        <span class="search-icon">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" fill="currentColor" viewBox="0 0 24 24">
                <path
                    d="M21.71 20.29l-3.88-3.88A9.96 9.96 0 0 0 20 10c0-5.52-4.48-10-10-10S0 4.48 0 10s4.48 10 10 10c2.38 0 4.56-.82 6.41-2.17l3.88 3.88a.996.996 0 1 0 1.41-1.41zM10 18c-4.41 0-8-3.59-8-8s3.59-8 8-8 8 3.59 8 8-3.59 8-8 8z">
                </path>
            </svg>
        </span> <!-- Symbole de loupe noire simple -->
        <input type="text" id="search" placeholder="Recherche..." size="8" />
    </div>
    <script src="../js/index.js"></script>
    <div id="nav-dropdown" class="navbar-dropdown dropdown ml-3">
        <button class="btn btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
            <i class="bi bi-person"></i> Mon Compte <i class="bi bi-caret-down"></i>
        </button>
        <ul class="dropdown-content">
            <li><a class="dropdown-item" href="../html/page_connexion_site.html">Connexion</a></li>
            <li><a class="dropdown-item" href="../html/pageinscription.html">Inscription</a></li>
        </ul>
    </div>
</header>


<body>
    <div class="container">
        <div class="ronds">
            <div class="rond">
                <img src="../images/IMG_9994_Facetune_09-01-2022-16-47-16.jpg" alt="image1">
                <span>responsable technique</span>
            </div>
            <div class="rond">
                <img src="image2.jpg" alt="image2">
                <span>responsable technique</span>
            </div>
            <div class="rond">
                <img src="../images/IMG_9994_Facetune_09-01-2022-16-47-16.jpg" alt="image3">
                <span>responsable technique</span>
            </div>
            <div class="rond">
                <img src="image4.jpg" alt="image4">
                <span>responsable technique</span>
            </div>
            <div class="rond">
                <img src="image5.jpg" alt="image5">
                <span>responsable technique</span>
            </div>
            <div class="rond">
                <img src="image6.jpg" alt="image6">
                <span>responsable technique</span>
            </div>
        </div>
        <div class="texte">
            <div class="rectangle">
                <h1>Notre Histoire</h1>
                <p>Nous sommes une équipe de 6 ingénieurs sortant d'école et nous nous demandions comment les pompiers
                    étaient protégés. Après avoir déouvert qu'il y avait encore des blessés et des morts pendant les
                    interventions, nous avons décidé de créer TPCF.</p>
            </div>
        </div>
    </div>
</body>


<footer>
    <div class="separator"></div>
    <div class="social-media">

        <div class="instagram">
            <a href="https://www.instagram.com/tpcf_france/"><img src="../images/instagram-logo.png"
                    alt="Instagram"></a>
        </div>
        <div class="facebook">
            <a href="#"><img src="../images/facebook-logo.png" alt="Facebook"></a>
        </div>
        <div class="twitter">
            <a href="https://twitter.com/TPCF_france"><img src="../images/twitter-logo.png" alt="Twitter"></a>
        </div>

    </div>
    <div class="separator"></div>
    <div class="copyright">
        <p>Tous droits réservés &copy; 2023</p>
    </div>
</footer>


</html>