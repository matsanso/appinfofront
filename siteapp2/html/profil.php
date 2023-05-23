<?php
// Vérifie si l'utilisateur est connecté
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Récupère le nom d'utilisateur de la session
$username = $_SESSION['username'];

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');

// Récupère les informations de l'utilisateur connecté à partir de la base de données
$stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
$stmt->execute(array($_SESSION['username']));
$user = $stmt->fetch(PDO::FETCH_ASSOC);

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupère les valeurs du formulaire
  $nom = $_POST['nom'];
  $prenom = $_POST['prenom'];
  $email = $_POST['email'];
  $telephone = $_POST['telephone'];
  $taille = $_POST['taille'];
  $poids = $_POST['poids'];
  $age = $_POST['age'];

  // Prépare la requête SQL pour mettre à jour les données de l'utilisateur
  $stmt = $pdo->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, taille = :taille, poids = :poids, age = :age WHERE email = :email");

  // Exécute la requête SQL avec les paramètres
  $stmt->execute(array(
    ':nom' => $nom,
    ':prenom' => $prenom,
    ':email' => $email,
    ':telephone' => $telephone,
    ':taille' => $taille,
    ':poids' => $poids,
    ':age' => $age,
    ':id' => $user['id']
  ));

  // Redirige vers la page de profil mise à jour
  header('Location: profil.php');
  exit;
}
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profil utilisateur</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/nprofil.css">
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

    <div class="top-bar">
    <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
        <a href="donnees.php" >Données</a>
        <a href="profil.php" >Profil</a>
        <a href="aide.php">Aide</a>
        <span><?php echo $username; ?>   </span>
    </div>

    <div class="container">
        <h1>Bienvenue sur votre profil, <?php echo $user['prenom'] . ' ' . $user['nom']; ?></h1>
      <form method="POST" >
        <label for="nom">Nom :</label>
        <input type="text" name="nom" value="<?php echo $user['nom']; ?>">

        <label for="prenom">Prénom :</label>
        <input type="text" name="prenom" value="<?php echo $user['prenom']; ?>">

        <label for="email">Adresse e-mail :</label>
        <input type="email" name="email" value="<?php echo $user['email']; ?>">

        <label for="telephone">Téléphone :</label>
        <input type="text" name="telephone" value="<?php echo $user['telephone']; ?>">

        <label for="taille">Taille (cm) :</label>
        <input type="number" name="taille" value="<?php echo $user['taille']; ?>">

        <label for="poids">Poids (kg) :</label>
        <input type="number" name="poids" value="<?php echo $user['poids']; ?>">

        <label for="age">Âge :</label>
        <input type="number" name="age" value="<?php echo $user['age']; ?>">

        <input type="submit" value="Enregistrer">
       </form>
    </div>

</body>
</html>
