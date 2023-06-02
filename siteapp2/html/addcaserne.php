<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Récupère le nom d'utilisateur de la session
$username = $_SESSION['username'];

// Définition des variables pour stocker les données du formulaire
$nom = '';

// Vérification si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des valeurs du formulaire
    $nomcaserne = $_POST['nom'];

    // Validation des données (vous pouvez ajouter des validations supplémentaires ici)

    // Insertion des données dans la base de données
    $stmt = $pdo->prepare("INSERT INTO caserne (nomcaserne) VALUES (:nom)");
    $stmt->execute(array(':nom' => $nomcaserne));

    // Redirection vers une autre page après l'ajout de la caserne
    header('Location: addcaserne.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter une caserne</title>

    <link rel="stylesheet" type="text/css" href="../css/naddcaserne.css">

    <!-- Google Translate Widget -->
  <div id="google_translate_element"></div>
  <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'fr'}, 'google_translate_element');
  }
  </script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <!-- End of Google Translate Widget -->
</head>
<body>

<div id="top-bar">
    <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
        <a href="profil2.php">Utilisateur</a>
        <a href="faq2.php">Faq</a>
        <a href="addcaserne.php">Caserne</a>
        <div id="user-menu">
          <span><?php echo $username; ?></span>
          <a href="../html/index.html" class="logout-button">Déconnexion</a>
        </div>
    </div>

    <form method="POST">
        <label for="nom">Nom :</label>
        <input type="text" id="nom" name="nom" required>

        <input type="submit" value="Ajouter">
    </form>
</body>
</html>