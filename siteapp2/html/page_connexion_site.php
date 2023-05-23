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
  if ($user['ban'] === 'oui'){

    $error_msg = "vous avez été banni. Veuillez contacter l'administrateur.";
  } else if ($user) {
    session_start();

    // Vérifie si le mot de passe saisi correspond au mot de passe stocké dans la base de données
    if (password_verify($password, $user['motDePasse']) ) {
      // Démarre une session pour l'utilisateur
      session_start();

      // Stocke le nom d'utilisateur dans la session
      $_SESSION['username'] = $user['email'];
       // Stocke la caserne de l'utilisateur dans la session, si elle existe
       if (isset($user['caserne'])) {
        $_SESSION['caserne'] = $user['caserne'];
       }

      // Vérifie le type de compte de l'utilisateur
      if ($user['type'] === 'gestionnaire') {
        
        if ($user['caserne'] !== NULL) {
          // Si le gestionnaire a une caserne, redirige vers la page d'espacegestionnaire
          header('Location: espacegestionnaire.php');
          exit;
        } else {
          // Si le gestionnaire n'a pas de caserne, affiche un message d'erreur
          $error_msg = "Vous n'avez pas encore de caserne assignée. Veuillez contacter l'administrateur.";
        }

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
  } 
  else {
    // Utilisateur non trouvé, affiche un message d'erreur
    $error_msg = "Nom d'utilisateur ou mot de passe incorrect";
  }
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
    <title>Connexion au compte</title>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/nconnexion.css" media="screen" type="text/css" />
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

        <div class="button-container">
        <input type="submit" id='login' value='Se connecter'>
        <input type="submit2" id='oubli' value='Mot de passe oublié ?' onclick="window.location.href='../html/mdpoubli.html'">
        </div>

        <a class='inscrit' href="../html/pageinscription.php">Pas encore membre ? </a>
      </form>
    </div>
  </body>
</html>
