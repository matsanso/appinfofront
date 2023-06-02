<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');

// Définit une variable pour stocker les erreurs
$errors = array();

// Définit un tableau pour stocker les données saisies
$userData = array(
  'username' => '',
  'Mail' => '',
  'password' => '',
  'password2' => '',
  'type' => ''
);

// Vérifie si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  // Récupère les valeurs du formulaire
  $username = $_POST['username'];
  $mail = $_POST['Mail'];
  $password = $_POST['password'];
  $type = $_POST['type'];
  $password2 = $_POST['password2'];

  // Vérification de la longueur du mot de passe
  if (strlen($password) < 8) {
    $errors[] = "Le mot de passe doit contenir au moins 8 caractères.";
  }

  // Vérification de la présence d'au moins un chiffre dans le mot de passe
  if (!preg_match('/\d/', $password)) {
    $errors[] = "Le mot de passe doit contenir au moins un chiffre.";
  }

  // Vérification de la présence d'au moins un caractère spécial dans le mot de passe
  if (!preg_match('/[^A-Za-z0-9]/', $password)) {
    $errors[] = "Le mot de passe doit contenir au moins un caractère spécial.";
  }

  // Vérification de la correspondance entre les deux mots de passe
  if ($password !== $password2) {
    $errors[] = "Les mots de passe ne correspondent pas.";
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
  } else {
    // Stocke les données saisies dans le tableau userData
    $userData = array(
      'username' => $username,
      'Mail' => $mail,
      'password' => $password,
      'password2' => $password2,
      'type' => $type
    );
  }
}

?>

<!doctype html>
<html>
  <head>
    <!-- Google Translate Widget -->
    <div id="google_translate_element"></div>
    <script type="text/javascript">
      function googleTranslateElementInit() {
        new google.translate.TranslateElement({ pageLanguage: 'fr' }, 'google_translate_element');
      }
    </script>
    <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <!-- End of Google Translate Widget -->
    <title>Inscription</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/ninscription.css" media="screen" type="text/css" />
    <link rel="icon" href="../images/Mon projet (4).png">
  </head>
  <body>
    <a href="../html/index.html"><img src="../images/Mon projet (4).png"></a>

    <div id="container">
      <h1>Inscription</h1>
      <?php if (!empty($errors)) : ?>
        <ul class="error">
          <?php foreach ($errors as $error) : ?>
            <li><?php echo $error; ?></li>
          <?php endforeach; ?>
        </ul>
        <script>
          showErrorPopup("Certains champs ne sont pas valides. Veuillez vérifier les erreurs affichées.");
        </script>
      <?php endif; ?>

      <form method="POST" onsubmit="return validateForm();">

        <label><b>Nom de l'utilisateur</b></label>
        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" value="<?php echo $userData['username']; ?>" required>

        <label><b>Adresse Mail</b></label>
        <input type="email" placeholder="Entrez votre adresse Mail" name="Mail" value="<?php echo $userData['Mail']; ?>" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" value="<?php echo $userData['password']; ?>" required>
        <label><b>Le mot de passe doit contenir au moins 8 caracteres dont un chiffre et un caractère special. </b></label>

        <input type="password" placeholder="Confirmez le mot de passe" name="password2" value="<?php echo $userData['password2']; ?>" required>



        <label><b>Rôle</b></label>
        <select name="type" required>
          <option value="" disabled selected hidden>Choisir un type de compte</option>
          <option value="utilisateur" <?php if ($userData['type'] === 'utilisateur') echo 'selected'; ?>>Utilisateur</option>
          <option value="gestionnaire" <?php if ($userData['type'] === 'gestionnaire') echo 'selected'; ?>>Gestionnaire</option>
          <option value="administrateur" <?php if ($userData['type'] === 'administrateur') echo 'selected'; ?>>Administrateur</option>
        </select>

        <input type="checkbox" id="cguCheckbox" name="cgu">
        <label for="cguCheckbox"> <a href="cgu.html">J'accepte les CGU</label>

        <input type="submit" id='Register' value="S'inscrire">
      </form>
    </div>
  </body>
  <script>
  function validateForm() {
    var cguCheckbox = document.getElementById('cguCheckbox');
    if (!cguCheckbox.checked) {
      alert("Veuillez accepter les CGU pour continuer.");
      return false;
    }
    return true;
  }
</script>
</html>
