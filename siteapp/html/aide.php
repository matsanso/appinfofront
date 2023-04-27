<?php

if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Récupère le nom d'utilisateur de la session
$username = $_SESSION['username'];
?>

<!DOCTYPE html>
<html>
  <head>
    <title>Page d'aide</title>
    <link rel="stylesheet" type="text/css" href="../css/nvaide.css">
  </head>
  <body>
    
  <div class="top-bar">
  <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
        <a href="#" >Données</a>
        <a href="profil.php" >Profil</a>
        <a href="aide.php">Aide</a>
        <span><?php echo $username   ; ?>   </span>
    </div>

    <div class="container">
      <h1>Aide</h1>
      <form method="post">
        <div class="form-group">
          <label for="nom">Nom :</label>
          <input type="text" id="nom" name="nom" required>
        </div>
        
        <div class="form-group">
      <label for="sujet">Sujet :</label>
      <input type="text" id="sujet" name="sujet" required>
    </div>
    
    <div class="form-group">
      <label for="probleme">Message :</label>
      <textarea id="probleme" name="probleme" required></textarea>
    </div>
    
    <div class="form-group">
      <input type="submit" value="Envoyer">
    </div>
  </form>
</div>
