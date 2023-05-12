<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');

// Définit une variable pour stocker les erreurs
$errors = array();

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupère les valeurs du formulaire
  $username = $_POST['username'];
  $mail = $_POST['Mail'];
  $password = $_POST['password'];
  $type = $_POST['type'];
  $password2 = $_POST['password2'];

  if (($type === "gestionnaire" || $type === "administrateur") && $password2 !== "verification") {
    $errors[] = "Le deuxième mot de passe pour un compte de type gestionnaire ou administrateur n'est pas correct";
  }

  if (empty($errors)) {
    // Crypte le mot de passe
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prépare la requête SQL d'insertion
    $stmt = $pdo->prepare("INSERT INTO utilisateur (nom, email, motDePasse, type) VALUES (:username, :mail, :password, :type)");

    // Exécute la requête SQL
    $stmt->execute(array(
      ':username' => $username,
      ':mail' => $mail,
      ':password' => $hashed_password, // Utilise le mot de passe crypté
      ':type' => $type
    ));
  }
}

?>

<!doctype html>
<html>
  <head>
    <title>Inscription</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/nvinscription.css" media="screen" type="text/css" />
    <link rel="icon" href="../images/Mon projet (4).png">
  </head>
  <body>
    <a href="../html/index.html"><img src="../images/Mon projet (4).png"></a>

    <div id="container">
      <h1>Inscription</h1>
      <?php if (!empty($errors)): ?>
        <ul>
          <?php foreach ($errors as $error): ?>
            <li><?php echo $error; ?></li>
          <?php endforeach; ?>
        </ul>
      <?php endif; ?>
      <form method="POST">
        <label><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

        <label><b>Adresse Mail</b></label>
        <input type="email" placeholder="Entrez votre adresse Mail" name="Mail" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>

        <label><b>2eme mot de passe si gestionnaire ou administrateur</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password2">

        <label><b>Rôle</b></label>
        <select name="type" required>
          <option value="" disabled selected hidden>Choisir un type de compte</option>
          <option value="utilisateur">Utilisateur</option>
          <option value="gestionnaire">Gestionnaire</option>
          <option value="administrateur">Administrateur</option>
        </select>

        <input type="submit" id='Register' value="S'inscrire">
      </form>
    </div>
  </body>
</html>
