<?php
// Vérifie si l'utilisateur est connecté
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Récupère le nom d'utilisateur de la session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
<head>
  <title>Profil utilisateur</title>
  <meta charset="utf-8">
  <link rel="stylesheet" href="../css/nvxprofil.css">
</head>
<body>
<div class="top-bar">
    <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
        <a href="profil2.php" >Utilisateur</a>
        <a href="Faq.php">Faq</a>
        <span><?php echo $username; ?>   </span>
    </div>
