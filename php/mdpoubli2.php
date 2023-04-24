<!DOCTYPE html>
<html>

<head>

    <title>mot de passe oublié</title>
    <meta charset="utf-8">

    <link rel="stylesheet" href="../css/mdpoubli2.css" media="screen" type="text/css" />
    <link rel="icon" href="../images/Mon projet (4).png">
</head>

<body>

    <div class="backbutton">
        <a href="../html/index.html"><img src="../images/back-button.svg">
            </img></a>
    </div>
    <div class="image">
        <img src="../images/mailsent.png">
        </img></a>
    </div>
    <div class="container">
        <h1>Checkez votre boite Mail et vos indésirables !</h1>
    </div>



</body>

</html>


<?php
if (isset($_POST['submit'])) {
    $to = "destinataire@example.com"; // adresse e-mail du destinataire
    $subject = "Nouveau message"; // sujet de l'e-mail
    $message = $_POST['message']; // récupère le contenu de la zone de texte

    // en-têtes de l'e-mail
    $headers = "From: expéditeur@example.com\r\n";
    $headers .= "Reply-To: expéditeur@example.com\r\n";
    $headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

    // envoie l'e-mail en utilisant la fonction mail() de PHP
    if (mail($to, $subject, $message, $headers)) {
        echo "L'e-mail a bien été envoyé.";
    } else {
        echo "Une erreur est survenue lors de l'envoi de l'e-mail.";
    }
}
?>