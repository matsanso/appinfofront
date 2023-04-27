<!DOCTYPE html>
<html>

<head>

    <title>Technologie de Protection pour les Combattants du Feu</title>
    <link rel="stylesheet" href="../css/index.css">
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
            <img src="../images/Mon projet (4).png" alt="Logo">
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
                    <li><a href="#Quizz">Quizz</a></li>
                </div>
                <div class="superbounce2">
                    <li><a href="FAQ.php">FAQ</a></li>
                </div>
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
                <li><a class="dropdown-item" href="pageconnexion.php">Connexion</a></li>
                <li><a class="dropdown-item" href="pageinscription.php">Inscription</a></li>
            </ul>
        </div>

    </header>

    <section class="hero">
        <h1>Bienvenue sur TPCF, le premier produit de protection complet pour les pompiers</h1>
        <a href="histoire.html" class="cta">En savoir plus</a>
    </section>

    <section class="features">
        <div class="container">
            <h2>Quelques chiffres...</h2>
            <div class="row">
                <div class="counter">
                    <i class="fas fa-users"></i>
                    <div class="num">10000</div>
                    Utilisateurs actifs
                </div>
                <div class="row">
                    <div class="counter">
                        <i class="fas fa-users"></i>
                        <div class="num">38</div>
                        Pompiers sauvés grâce à TPCF
                    </div>
                    <div class="row">
                        <div class="counter">
                            <i class="fas fa-users"></i>
                            <div class="num">100</div>%
                            de clients satisfaits

                        </div>


                    </div>
                </div>
    </section>
    <section>

        <div id="Quizz">
            <div class="container">
                <h1>Pour en apprendre plus sur TPCF :</h1>
                <form>
                    <h2>Question 1 : TPCF est une entreprise</h2>
                    <label for="q1r1">
                        <input type="radio" id="q1r1" name="q1" value="1">
                        100% française
                    </label>
                    <label for="q1r2">
                        <input type="radio" id="q1r2" name="q1" value="0">
                        Américaine
                    </label>
                    <label for="q1r3">
                        <input type="radio" id="q1r3" name="q1" value="0">
                        Japonaise
                    </label>
                    <h2>Question 2 : Combien de pompier pourraient être sauvés par an grâce à TPCF ? (estimation)</h2>
                    <label for="q2r1">
                        <input type="radio" id="q2r1" name="q2" value="1">
                        50
                    </label>
                    <label for="q2r2">
                        <input type="radio" id="q2r2" name="q2" value="0">
                        40000
                    </label>
                    <label for="q2r3">
                        <input type="radio" id="q2r3" name="q2" value="0">
                        0
                    </label>
                    <h2>Question 3 : Par qui à été créée TPCF</h2>
                    <label for="q3r1">
                        <input type="radio" id="q3r1" name="q3" value="0">
                        Des pompiers
                    </label>
                    <label for="q3r2">
                        <input type="radio" id="q3r2" name="q3" value="0">
                        Des commerciaux
                    </label>
                    <label for="q3r3">
                        <input type="radio" id="q3r3" name="q3" value="1">
                        Des ingénieurs
                    </label>
                    <input type="submit" value="Valider" id="submit">
                </form>
                <div class="result"></div>
            </div>
            <script src="script.js"></script>
        </div>

    </section>
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