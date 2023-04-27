<!doctype html>
<html>

<head>

    <title>Connexion au compte</title>
    <meta charset="utf-8">
    <!-- importer le fichier de style -->
    <link rel="stylesheet" href="../css/connexion.css" media="screen" type="text/css" />
    <link rel="icon" href="../images/Mon projet (4).png">

</head>

<body>
    <a href="index.php"><img src="../images/Mon projet (4).png">
        </img></a>
    <div id="container">


        <h1>Connexion</h1>

        <label><b>Nom d'utilisateur</b></label>


        <input type="text" placeholder="Entrer le nom d'utilisateur" name="username" required>

        <label><b>Mot de passe</b></label>
        <input type="password" placeholder="Entrer le mot de passe" name="password" required>

        <input type="submit" id='login' value='Se connecter'>

        <a href="mdpoubli.php"><input type="submit" id='oubli' value='Mot de passe oublié ?'></a>

        <a class='inscrit' href="pageinscription.php">Pas encore membre ? </a>



    </div>
</body>

</html>