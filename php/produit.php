<!DOCTYPE html>
<html>

<head>
    <title>La ceinture</title>
    <link rel="stylesheet" type="text/css" href="../css/produit.css">
    <link rel="icon" href="../images/Mon projet (4).png">
    <meta charset="utf-8">
    <script src="../js/produit.js"></script>
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



<div class="container   text-center p-3">
    <div class="row">
        <div class="col-12">
            <h1 class="titre">Le dispositif de protection le plus efficace du marché</h1>
        </div>
    </div>

    <section>
        <div class="caroussel">
            <div class="slides">
                <img src="../images/d1.png">
                <img src="../images/d2.png">
            </div>


        </div>
    </section>
    <div class="card">
        <div class='py-2 d-block'>
            <p class="f-4 p-2 center">Détails du produit : </p>

            <div class='center border-1 border-round-1-label tableContainer' id="productDetail">
                <table id='featuresTable'>
                    <tbody>
                        <tr>
                            <th>Prix</th>
                            <td>129€</td>
                        </tr>
                        <tr>
                            <th>Poids</th>
                            <td>300g</td>
                        </tr>
                        <tr>
                            <th>Technologie de connectivité</th>
                            <td>Bluetooth</td>
                        </tr>
                        <tr>
                            <th>Autonomie</th>
                            <td>24 heures</td>
                        </tr>
                        <tr>
                            <th>Caractéristiques spéciales</th>
                            <td>
                                <ul class="text-left">
                                    <li>Suivi santé en continu </li>
                                    <li>Assistance 24/24h </li>
                                    <li>Ceinture confortable</li>
                                    <li>Site simple d'utilisation </li>
                                    <li>Grande autonomie </li>
                                    <li>Alerte en cas de danger </li>
                                </ul>
                            </td>
                        </tr>
                        <tr>
                            <th>Couleur</th>
                            <td>Rouge et noir</td>
                        </tr>
                        <tr>
                            <th>Temps de chargement</th>
                            <td>2 heure</td>
                        </tr>
                        <tr>
                            <th>Piles nécessaires</th>
                            <td>Non</td>
                        </tr>
                        <tr>
                            <th>Chargeur inclus</th>
                            <td>Oui</td>
                        </tr>
                    </tbody>
                </table>
            </div>
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

</html>