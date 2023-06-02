<?php
// Vérifie si la session est démarrée, sinon la démarre
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Vérifie si l'utilisateur est connecté
if (!isset($_SESSION['username'])) {
    // Redirige l'utilisateur vers la page de connexion
    header("Location: login.php");
    exit();
}

// Récupère le nom d'utilisateur de la session
$username = $_SESSION['username'];

// Récupérer l'ID de la caserne de l'utilisateur depuis la session
$caserneId = $_SESSION['caserne'];

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');

// Récupération des informations sur la caserne de l'utilisateur depuis la base de données
$stmt = $pdo->prepare("SELECT * FROM caserne WHERE nomcaserne = :caserneId");
$stmt->execute(array(':caserneId' => $caserneId));
$caserneInfo = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifie si le formulaire a été soumis pour enregistrer les modifications
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['caserneId'])) {
    $caserneId = $_POST['caserneId'];
    $nomcaserne = $_POST['nomcaserne'];
    $adresse = $_POST['adresse'];
    $telephone = $_POST['telephone'];
    $mail = $_POST['mail'];
    $creation = $_POST['creation'];
    $effectif = $_POST['effectif'];

    // Mettre à jour les informations de la caserne dans la base de données
    $stmt = $pdo->prepare("UPDATE caserne SET nomcaserne = :nomcaserne, adresse = :adresse, telephone = :telephone, mail = :mail, creation = :creation, effectif = :effectif WHERE nomcaserne = :caserneId");
    $stmt->execute(array(
        ':nomcaserne' => $nomcaserne,
        ':adresse' => $adresse,
        ':telephone' => $telephone,
        ':mail' => $mail,
        ':creation' => $creation,
        ':effectif' => $effectif,
        ':caserneId' => $caserneId
    ));

    // Redirige l'utilisateur vers la page d'informations sur la caserne mise à jour
    header("Location: infoscaserne.php");
    exit();
}
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
    <title>Espace Gestionnaire</title>
    <meta charset="utf-8">
    <link rel="icon" href="../images/Mon projet (4).png">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/ninfoscaserne.css" media="screen" type="text/css" />

    <!-- importer le script du sélecteur de date -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
  </head>

  <body>
    <div id="top-bar">
      <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
      <a href="espacegestionnaire.php" >Utilisateur de la caserne</a>
        <a href="infoscaserne.php">Info Caserne</a>
        <a href="profilg.php" >Mon Profil</a>
      <div id="user-menu">
          <span><?php echo $username; ?></span>
          <a href="../html/index.html" class="logout-button">Déconnexion</a>
        </div>
    </div>

<div id="container">
  <h1>Informations sur votre caserne</h1>

  <?php
  if ($caserneInfo) {
    echo '<div class="result">';
    echo '<form method="POST" onsubmit="return confirm(\'Voulez-vous vraiment enregistrer les modifications ?\');">';
    echo '<input type="hidden" name="caserneId" value="' . $caserneId . '">';
    echo '<table>';
    echo '<tr><td><b>Nom de la caserne:</b></td><td><input type="text" name="nomcaserne" value="' . $caserneInfo['nomcaserne'] . '"></td></tr>';
    echo '<tr><td><b>Adresse :</b></td><td><input type="text" name="adresse" value="' . $caserneInfo['adresse'] . '"></td></tr>';
    echo '<tr><td><b>Téléphone :</b></td><td><input type="text" name="telephone" value="' . $caserneInfo['telephone'] . '"></td></tr>';
    echo '<tr><td><b>Adresse mail :</b></td><td><input type="email" name="mail" value="' . $caserneInfo['mail'] . '"></td></tr>';
    echo '<tr><td><b>Création :</b></td><td><input type="text" id="datepicker" name="creation" value="' . $caserneInfo['creation'] . '"></td></tr>';
    echo '<tr><td><b>Effectif :</b></td><td><input type="number" name="effectif" value="' . $caserneInfo['effectif'] . '"></td></tr>';
    echo '<tr><td colspan="2"><input type="submit" value="Enregistrer les modifications"></td></tr>';
    echo '</table>';
    echo '</form>';
    echo '</div>';
  } else {
    echo "<p>Aucune information trouvée pour votre caserne.</p>";
  }
  ?>

  <!-- Script pour initialiser le sélecteur de date -->
  <script>
    flatpickr("#datepicker", {
      dateFormat: "Y-m-d",
    });
  </script>
</div>

  </body>
</html>
