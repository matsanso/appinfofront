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

    <title>Espace client</title>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/nvespaceclient.css" media="screen" type="text/css" />
    <link rel="icon" href="../images/Mon projet (4).png">

</head>

<body>

    <div id="top-bar">
    <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
        <a href="donnees.php" class="active">Données</a>
        <a href="profil.php">Profil</a>
        <a href="aide.php">Aide</a>
        <span>Bonjour, <?php echo $username; ?> !</span>
    </div>

    <div id="container">

        <h1>Espace client</h1>

        <p>Bienvenue dans votre espace client. Ici, vous pouvez consulter vos données, modifier votre profil, et accéder à l'aide en ligne.</p>

        <!-- Contenu de la page ici -->

    </div>
</body>

</html>
