<?php
// Vérifie si la session est démarrée, sinon la démarre
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Récupère le nom d'utilisateur de la session
$username = $_SESSION['username'];
?>

<!doctype html>
<html>

<head>

    <title>Espace Gestionnaire</title>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/espaceg.css" media="screen" type="text/css" />
    <link rel="icon" href="../images/Mon projet (4).png">
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
    <a href="espacegestionnaire.php" >Utilisateur de la caserne</a>
        <a href="infoscaserne.php">Info Caserne</a>
        <a href="profilg.php" >Mon Profil</a>
        <div id="user-menu">
          <span><?php echo $username; ?></span>
          <a href="../html/index.html" class="logout-button">Déconnexion</a>
        </div>
    </div>


    <div id="container">

        <h1>Espace Gestionnaire</h1>

        <p>Bienvenue dans votre espace gestionnaire. Ici, vous pouvez retrouver un utilisateur et afficher ses données, gerer les informations de votre caserne et modifier votre profil.</p>

        

    </div>
</body>

</html>