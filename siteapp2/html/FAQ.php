<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');

// Récupère les informations de la table 'sujetfaq'
$stmt = $pdo->query("SELECT titre, contenu FROM sujetfaq");
$faq_data = $stmt->fetchAll(PDO::FETCH_ASSOC);

?>



<!DOCTYPE html>
<html>

<head>
<!-- Google Translate Widget -->
<div id="google_translate_element"></div>
  <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'fr'}, 'google_translate_element');
  }
  </script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <!-- End of Google Translate Widget -->
    <title>Technologie de Protection pour les Combattants du Feu</title>
    <link rel="stylesheet" href="../css/FAQ.css">
    <link rel="icon" href="../images/Mon projet (4).png">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/waypoints/4.0.1/jquery.waypoints.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Counter-Up/1.0.0/jquery.counterup.min.js"></script>
</head>


<body>
    <header>
        <div class="logo">
            <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
        </div>

        <nav>
            <ul>
                <div class="superbounce">
                    <li><a href="produit.html">Produit</a></li>
                </div>
                <div class="superbounce2">
                    <li><a href="Histoire.html">Histoire</a></li>
                </div>
                <div class="superbounce2">
                    <li><a href="../html/FAQ.php">FAQ</a></li>

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
                <li><a class="dropdown-item" href="../html/page_connexion_site.php">Connexion</a></li>
                <li><a class="dropdown-item" href="../html/pageinscription.php">Inscription</a></li>
            </ul>
        </div>

    </header>

    <body>

<div class="container">
    <h1>FAQ</h1>
    <ul>
        <?php foreach ($faq_data as $row): ?>
            <li>
                <h2><?php echo htmlspecialchars($row['titre']); ?></h2>
                <p><?php echo htmlspecialchars($row['contenu']); ?></p>
            </li>
        <?php endforeach; ?>
    </ul>
</div>


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


    </body>

</html>