<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupère les valeurs du formulaire
  $username = $_POST['username'];
  $mail = $_POST['Mail'];
  $password = $_POST['password'];
  $type = $_POST['type'];

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
      <form method="POST" >
        <label><b>Nom d'utilisateur</b></label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

        <label><b>Adresse Mail</b></label>
        <input type="email" placeholder="Entrez votre adresse Mail" name="Mail" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>

        <label><b>2eme mot de passe si gestionnaire ou administrateur</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password2" required>

        <label><b>Rôle</b></label>
        <select name="type">
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
