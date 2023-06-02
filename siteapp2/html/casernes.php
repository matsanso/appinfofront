<!DOCTYPE html>
<html>
<head>
	<title>Technologie de Protection pour les Combattants du Feu</title>
	<link rel="stylesheet" href="../css/abcasernes.css">
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
            <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo">
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
					<li><a href="../html/casernes.php">Casernes</a></li>
				</div>
				<div class="superbounce2">
					<li><a href="../html/FAQ.php">FAQ</a></li>
				</div>
			</ul>
		</nav>


		<div id="nav-dropdown" class="navbar-dropdown dropdown ml-3">
			<button class="btn btn-primary" type="button" data-bs-toggle="dropdown" aria-expanded="false">
				<i class="bi bi-person"></i> Mon Compte <i class="bi bi-caret-down"></i>
			</button>
			<ul class="dropdown-content">
				<li><a class="dropdown-item" href="../html/page_connexion_site.php">Connexion</a></li>
				<li><a class="dropdown-item" href="../html/pageinscription.php">Inscription</a></li>
				<li><a class="dropdown-item"><!-- Google Translate Widget -->
	<div id="google_translate_element"></div>
  <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'fr'}, 'google_translate_element');
  }
  </script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <!-- End of Google Translate Widget --></a></li>
			</ul>
		</div>

	</header>

	<div id="container">

		<form method="POST">
			<select name="caserne" id="caserne">
				<option value="">-- Sélectionner une caserne --</option>
				<?php
				// Connexion à la base de données
                $pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');

				// Récupération des casernes depuis la base de données
				$stmt = $pdo->query("SELECT * FROM caserne");
				$casernes = $stmt->fetchAll(PDO::FETCH_ASSOC);

				// Affichage des options de la liste déroulante
				foreach ($casernes as $caserne) {
					echo '<option value="' . $caserne['id'] . '">' . $caserne['nomcaserne'] . '</option>';
				}
				?>
			</select>
			<input type="submit" value="Rechercher">
		</form>

		<?php
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$caserneId = $_POST['caserne'];

			if (!empty($caserneId)) {
				// Récupération des informations sur la caserne sélectionnée depuis la base de données
				$stmt = $pdo->prepare("SELECT * FROM caserne WHERE id = :caserneId");
				$stmt->execute(array(':caserneId' => $caserneId));
				$caserneInfo = $stmt->fetch(PDO::FETCH_ASSOC);

				if ($caserneInfo) {
					echo '<div class="result">';
					echo '<h2>Informations sur la caserne</h2>';
					echo '<table>';
					echo '<tr><td><b>Nom de la caserne:</b></td><td>' . $caserneInfo['nomcaserne'] . '</td></tr>';
					echo '<tr><td><b>Adresse :</b></td><td>' . $caserneInfo['adresse'] . '</td></tr>';
					echo '<tr><td><b>Telephone :</b></td><td>' . $caserneInfo['telephone'] . '</td></tr>';
					echo '<tr><td><b>Adresse mail :</b></td><td>' . $caserneInfo['mail'] . '</td></tr>';
					echo '<tr><td><b>Création :</b></td><td>' . $caserneInfo['creation'] . '</td></tr>';
					echo '<tr><td><b>Effectif :</b></td><td>' . $caserneInfo['effectif'] . '</td></tr>';


					echo '</table>';
					echo '</div>';
				} else {
					echo "<p>Aucune information trouvée pour la caserne sélectionnée.</p>";
				}
			} else {
				echo "<p>Veuillez sélectionner une caserne.</p>";
			}
		}
		?>
	</div>
</body>


<footer>
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
            <div class="copyright">
                <p>Tous droits réservés &copy; 2023</p>
            </div>
        </footer>
</html>
