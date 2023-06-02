<?php
if (session_status() == PHP_SESSION_NONE) {
  session_start();
}

// Récupère le nom d'utilisateur de la session
$username = $_SESSION['username'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  // Get form data
  $email = $_POST["email"];
  $sujet = $_POST["sujet"];
  $probleme = $_POST["probleme"];

  $headers = "From: $email\r\n";

  // Build the email content
  $message = "Sujet: $sujet\r\n";
  $message .= "Message: $probleme\r\n";

  // Send the email
  $to = "lucassayag7@gmail.com"; // Replace with your own email address
  $subject = "Aide - Formulaire de contact";
  $success = mail($to, $subject, $message, $headers);

  // Check if the email was sent successfully
  if ($success) {
    // Email sent successfully
    echo "Merci! Votre message a été envoyé.";
  } else {
    // Error sending email
    echo "Une erreur s'est produite lors de l'envoi du message. Veuillez réessayer.";
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
    <title>Page d'aide</title>
    <link rel="stylesheet" type="text/css" href="../css/baide.css">
  </head>
  <body>
    
  <div class="top-bar">
  <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
        <a href="donnees.php" >Données</a>
        <a href="aide.php">Aide</a>
        <a href="profil.php">Mon Profil</a>
        <div id="user-menu">
          <span><?php echo $username; ?></span>
          <a href="../html/index.html" class="logout-button">Déconnexion</a>
        </div>
    </div>

    <div class="container">
      <h1>Aide</h1>
      <form method="post">
        <div class="form-group">
          <label for="email">Email :</label>
          <input type="text" id="email" name="email" value="<?php echo $username; ?>" required>
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
