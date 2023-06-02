<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve the entered email address from the form
    $email = $_POST["email"];


     // Stocker l'e-mail dans une variable de session
     session_start();
     $_SESSION["user_email"] = $email;


    // Generate a 7-digit code
    $code = mt_rand(1000000, 9999999);

    // Save code et email 
    $pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');
    
    $stmt = $pdo->prepare("INSERT INTO resetmdp (mail, code) VALUES (:email, :code)");
    $stmt->execute(array(':email' => $email, ':code' => $code));


    // Send the email
    $to = $email;
    $subject = "Réinitialisation du mot de passe";
    $message = "Bonjour, veuillez suivre ce lien pour réinitialiser votre mot de passe : http://localhost/siteapp2/html/mdpoubli3.php?email=$email et utiliser le code suivant pour réinitialiser votre mot de passe : $code ";
    $headers = "From: noreplymotdepasse@tpcf.com";
    
    if (mail($to, $subject, $message, $headers)) {
        header('Location: mdpoubli2.html');
    } else {
        // Error sending email
        echo "Une erreur s'est produite lors de l'envoi de l'email. Veuillez réessayer.";
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
    <title>Mot de passe oublié</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/amdpoubli.css" media="screen" type="text/css" />
    <link rel="icon" href="../images/Mon projet (4).png">
</head>

<body>
    <div id="container">
        <form method="POST">
            <h1>Mot de passe oublié ?</h1>

            <label><b>Veuillez indiquer votre adresse e-mail</b></label>
            <input type="text" placeholder="E-mail" name="email" required>

            <input type="submit" id="Register" value="Valider">
        </form>
    </div>
</body>

</html>
