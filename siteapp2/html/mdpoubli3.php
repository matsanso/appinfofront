<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_GET['email'];
    $newPassword = $_POST["password"];
    $password = $_POST['password'];
    $password2 = $_POST['password2'];

    // Connexion à la base de données
    $pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');
  
  
    // Vérifier si le formulaire de mise à jour a été soumis
  if (isset($_POST['update'])) {
    // Récupérer le code de réinitialisation associé à l'adresse e-mail
    $stmt = $pdo->prepare("SELECT code FROM resetmdp WHERE mail = :email ORDER BY id DESC LIMIT 1");
    $stmt->execute(array(':email' => $email));
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    $resetCode = $row['code'];


    // Définit une variable pour stocker les erreurs
$errors = array();


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
        // Vérifier si le code de réinitialisation correspond à celui saisi par l'utilisateur
        if ($_POST['code'] == $resetCode) {

            $hashed_password = password_hash($newPassword, PASSWORD_DEFAULT);


            // Mettre à jour le mot de passe dans la table utilisateur
            $stmt = $pdo->prepare("UPDATE utilisateur SET motDePasse = :password WHERE email = :email");
            $stmt->execute(array(':password' => $hashed_password, ':email' => $email));

            // Supprimer l'entrée de réinitialisation associée à l'adresse e-mail
            $stmt = $pdo->prepare("DELETE FROM resetmdp WHERE mail = :email");
            $stmt->execute(array(':email' => $email));

            // Afficher un message de succès ou rediriger l'utilisateur vers une page de connexion
            $errors[] =  "Votre mot de passe a été réinitialisé avec succès. Vous pouvez maintenant vous connecter avec votre nouveau mot de passe.";
        } else {
            // Le code de réinitialisation est incorrect
            $errors[] =  "Le code de réinitialisation est incorrect. Veuillez réessayer.";
        }
    }
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
            new google.translate.TranslateElement({ pageLanguage: 'fr' }, 'google_translate_element');
        }
    </script>
    <script type="text/javascript"
        src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
    <!-- End of Google Translate Widget -->
    <title>Réinitialisation du mot de passe</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/amdpoubli3.css" media="screen" type="text/css" />
    <link rel="icon" href="../images/Mon projet (4).png">
</head>

<body>

      <div id="affichageerreur">
            <?php if (!empty($errors)) : ?>
                    <ul class="error">
                        <?php foreach ($errors as $error) : ?>
                            <li><?php echo $error; ?></li>
                        <?php endforeach; ?>
                     </ul>
            <?php endif; ?>
      </div>

    <div id="container">
        <h1>Réinitialisation du mot de passe</h1>

        <form method="post">
            <label><b>E-mail :</b> <?php echo $_GET['email']; ?></label>
            <label><b>Nouveau mot de passe</b></label>
            <input type="password" placeholder="Nouveau mot de passe" name="password" required>
            <label><b>Confirmer le mot de passe</b></label>
            <input type="password" placeholder="Confirmer le mot de passe" name="password2" required>
            <label><b>Code de réinitialisation</b></label>
            <input type="text" placeholder="Code de réinitialisation" name="code" required>
            <input type="submit" name="update" value="Réinitialiser le mot de passe">
        </form>
    </div>
    

</body>

</html>
