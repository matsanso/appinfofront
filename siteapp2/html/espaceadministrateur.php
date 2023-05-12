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

    <title>Espace Administrateur2</title>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/nvespaceadministrateur.css" media="screen" type="text/css" />
    <link rel="icon" href="../images/Mon projet (4).png">

</head>

<body>

    <div id="top-bar">
    <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
        <a href="profil2.php">Utilisateur</a>
        <a href="faq2.php">Faq</a>
        <span>Bonjour, <?php echo $username; ?> !</span>
    </div>

    <div id="container">

        <h1>Espace Administrateur</h1>

        <p>Bienvenue dans votre espace administrateur. Ici, vous pouvez modifier ajouter supprimer ou bannir un utilisateur, et gerer la faq.</p>

        <!-- Contenu de la page ici -->

    </div>
</body>

</html>
