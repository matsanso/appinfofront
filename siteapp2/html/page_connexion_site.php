<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupère les valeurs du formulaire
  $Mail = $_POST['Mail'];
  $password = $_POST['password'];

  // Prépare la requête SQL pour vérifier si l'utilisateur existe dans la base de données
  $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = :Mail");

  // Exécute la requête SQL avec les paramètres
  $stmt->execute(array(':Mail' => $Mail));

  // Récupère l'utilisateur correspondant s'il existe
  $user = $stmt->fetch(PDO::FETCH_ASSOC);

  // Vérifie si l'utilisateur a été trouvé dans la base de données
  if ($user) {
    // Vérifie si le mot de passe saisi correspond au mot de passe stocké dans la base de données
    if (password_verify($password, $user['motDePasse'])) {
      // Démarre une session pour l'utilisateur
      session_start();

      // Stocke le nom d'utilisateur dans la session
      $_SESSION['username'] = $user['email'];

      // Vérifie le type de compte de l'utilisateur
      if ($user['type'] === 'gestionnaire') {
        // Si l'utilisateur est un gestionnaire, redirige vers la page d'espacegestionnaire
        header('Location: espacegestionnaire.php');
        exit;
      } elseif($user['type'] === 'administrateur') {
        // Si l'utilisateur est un administrateur, redirige vers la page d'espaceadministrateur
        header('Location: espaceadministrateur.php');
        exit;
      } else {
        // Sinon, redirige vers la page d'espaceclient
        header('Location: espaceclient.php');
        exit;
      }
    } else {
      // Mot de passe incorrect, affiche un message d'erreur
      $error_msg = "Nom d'utilisateur ou mot de passe incorrect";
    }
  } else {
    // Utilisateur non trouvé, affiche un message d'erreur
    $error_msg = "Nom d'utilisateur ou mot de passe incorrect";
  }
}

?>


<!DOCTYPE html>
<html>
  <head>
    <title>Connexion au compte</title>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/connexion.css" media="screen" type="text/css" />
    <link rel="icon" href="../images/Mon projet (4).png">
  </head>

  <body>
    <a href="../html/index.html"><img src="../images/Mon projet (4).png"></a>

    <div id="container">
      <h1>Connexion</h1>

      <?php if (isset($error_msg)) { ?>
        <p><?php echo $error_msg; ?></p>
      <?php } ?>

      <form method="POST">
        <label><b>Adresse Email</b></label>
        <input type="text" placeholder="Entrer votre adresse mail'" name="Mail" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>

        <input type="submit" id='login' value='Se connecter'>
        <a href="../html/mdpoubli.html"><input type="submit" id='oubli' value='Mot de passe oublié ?'></a>

        <a class='inscrit' href="../html/pageinscription.php">Pas encore membre ? </a>
      </form>
    </div>
  </body>
</html>
