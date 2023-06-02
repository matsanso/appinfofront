<?php
// Vérifie si l'utilisateur est connecté
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');

// Récupère le nom d'utilisateur de la session
$username = $_SESSION['username'];

// Requête pour récupérer les noms des casernes
$stmt = $pdo->query("SELECT nomcaserne FROM caserne");
$casernes = $stmt->fetchAll(PDO::FETCH_COLUMN);

// Recherche un utilisateur si le formulaire de recherche a été soumis
if (isset($_POST['search_email'])) {
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $stmt->execute(array($_POST['search_email']));
    $user = $stmt->fetch(PDO::FETCH_ASSOC);
} else {
    $user = [];
}

// Vérifie si le formulaire de mise à jour a été soumis
if (isset($_POST['update'])) {
    // Récupère les valeurs du formulaire
    extract($_POST);

    // Prépare la requête SQL pour mettre à jour les données de l'utilisateur
    $stmt = $pdo->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, taille = :taille, poids = :poids, age = :age, caserne = :caserne, ban = :ban WHERE email = :email");

    // Exécute la requête SQL avec les paramètres
    $stmt->execute(array(
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':telephone' => $telephone,
        ':taille' => $taille,
        ':poids' => $poids,
        ':age' => $age,
        ':caserne' => $caserne,
        ':ban' => $ban
        
    ));


    // Redirige vers la page de profil mise à jour
    header('Location: profil2.php');
    exit;
}
// Vérifie si le formulaire de suppression a été soumis
if (isset($_POST['delete'])) {
    $user_id = $_POST['identifiant'];


    
    // Supprime toutes les lignes de la table "boitier" liées à l'utilisateur
    $stmt = $pdo->prepare("DELETE b FROM capteurcardiaque b INNER JOIN utilisateur u ON b.idu = u.identifiant WHERE u.identifiant = ?");
    $stmt->execute(array($_POST['identifiant']));


    // Supprime toutes les lignes de la table "boitier" liées à l'utilisateur
    $stmt = $pdo->prepare("DELETE b FROM boitier b INNER JOIN utilisateur u ON b.utilisateur = u.identifiant WHERE u.identifiant = ?");
    $stmt->execute(array($_POST['identifiant']));

    
    // Supprime l'utilisateur de la base de données
    $stmt = $pdo->prepare("DELETE FROM utilisateur WHERE email = ?");
    $stmt->execute(array($_POST['user_email']));



    // Redirige vers la page de profil
    header('Location: profil2.php');
    exit;
}

// Vérifie si le formulaire d'ajout d'utilisateur a été soumis
if (isset($_POST['add_user'])) {
    // Récupère les valeurs du formulaire
    extract($_POST);

    // Vérifie si l'email existe déjà dans la base de données
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE email = ?");
    $stmt->execute(array($email));
    $existing_user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Si l'utilisateur n'existe pas, insère le nouvel utilisateur dans la base de données
    if (!$existing_user) {

        $hashed_password = password_hash($motDePasse, PASSWORD_DEFAULT);

        $stmt = $pdo->prepare("INSERT INTO utilisateur (motDePasse, nom, prenom, email, telephone, taille, poids, age, type,caserne) VALUES (:motDePasse, :nom, :prenom, :email, :telephone, :taille, :poids, :age, :type, :caserne)");

        $stmt->execute(array(
            ':motDePasse' => $hashed_password,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':telephone' => $telephone,
            ':taille' => $taille,
            ':poids' => $poids,
            ':age' => $age,
            ':type' => $type,
            ':caserne' => $caserne
        ));

        // Redirige vers la page de profil du nouvel utilisateur
        header("Location: profil2.php?search_email=$email");
        exit;
    } else {
        // Si l'utilisateur existe déjà, affiche un message d'erreur
        $error = "Un utilisateur avec cet email existe déjà.";
    }
}


?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil utilisateur</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/nprofil2.css">
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
        <a href="profil2.php">Utilisateur</a>
        <a href="faq2.php">Faq</a>
        <a href="addcaserne.php">Caserne</a>
        <div id="user-menu">
          <span><?php echo $username; ?></span>
          <a href="../html/index.html" class="logout-button">Déconnexion</a>
        </div>
    </div>

<div class="container">
    <h1>Recherche utilisateur</h1>
    <form method="POST" class="search-form">
        <label for="search_email">Rechercher par email :</label>
        <input type="email" name="search_email">
        <input type="submit" value="Rechercher">
        
        <script>
    function confirmSuppression() {
        return confirm("Êtes-vous sûr de vouloir supprimer cet utilisateur ?");
    }
</script>
<?php if (!empty($user)): ?>
    <input type="hidden" name="user_email" value="<?php echo $user['email']; ?>">
    <input type="hidden" name="identifiant" value="<?php echo $user['identifiant']; ?>">

    <input type="submit" name="delete" value="Supprimer l'utilisateur" onclick="return confirmSuppression();">
<?php endif; ?>

</form>

    <?php if (!empty($user)): ?>
        <h2>Profil de <?php echo $user['prenom'] . ' ' . $user['nom']; ?></h2>
        <form method="POST">
            <label for="nom">id : <?php echo $user['identifiant'];?> </label>
            <label for="nom">Nom :</label>
            <input type="text" name="nom" value="<?php echo $user['nom']; ?>">

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom" value="<?php echo $user['prenom']; ?>">

            <label for="email">Adresse e-mail :</label>
            <input type="email" name="email" value="<?php echo $user['email']; ?>">

            <label for="telephone">Téléphone :</label>
            <input type="text" name="telephone" value="<?php echo $user['telephone']; ?>">

            <label for="taille">Taille (cm) :</label>
            <input type="number" name="taille" value="<?php echo $user['taille']; ?>">

            <label for="poids">Poids (kg) :</label>
            <input type="number" name="poids" value="<?php echo $user['poids']; ?>">

            <label for="age">Âge :</label>
            <input type="number" name="age" value="<?php echo $user['age']; ?>">

            <label for="caserne">Caserne :</label>
            <select name="caserne">
                <?php foreach ($casernes as $caserne): ?>
                    <option value="<?php echo $caserne; ?>" <?php if ($caserne === $user['caserne']) echo 'selected'; ?>><?php echo $caserne; ?></option>
                <?php endforeach; ?>
            </select>

            <label for="ban">authoriser l'acces (si non = ban) :</label>
            <select name="ban">
                    <option value=" "> </option>
                    <option value="oui">oui</option>
                    <option value="non">non</option>
            </select>

            <script>
                function confirmEnregistrement() {
                    return confirm("Êtes-vous sûr de vouloir enregistrer les modifications ?");
                }
            </script>
            
            <input type="submit" name="update" value="Enregistrer" onclick="return confirmEnregistrement();">

            
        </form>
        <?php elseif (isset($_POST['search_email']) && empty($user) && empty($error)): ?>
        <p>Aucun utilisateur avec cet email n'a été trouvé. Voulez-vous ajouter un nouvel utilisateur ?</p>
        <form method="POST">

            <label for="motDePasse">Mot de passe :</label>
            <input type="text" name="motDePasse" required>

            <label for="nom">Nom :</label>
            <input type="text" name="nom">

            <label for="prenom">Prénom :</label>
            <input type="text" name="prenom">

            <label for="email">Adresse e-mail :</label>
            <input type="email" name="email" required>

            <label for="telephone">Téléphone :</label>
            <input type="text" name="telephone">

            <label for="taille">Taille (cm) :</label>
            <input type="number" name="taille">

            <label for="poids">Poids (kg) :</label>
            <input type="number" name="poids">

            <label for="age">Âge :</label>
            <input type="number" name="age">

            <select name="type" required>
          <option value="" disabled selected hidden>type :</option>
          <option value="utilisateur">Utilisateur</option>
        </select>

            <?php if (!empty($error)): ?>
                <div class="error"><?php echo $error; ?></div>
            <?php endif; ?>

            <script>
                function confirmEnregistrement() {
                    return confirm("Êtes-vous sûr de vouloir ajouter cet utilisateur ?");
                }
            </script>
            
            <input type="submit" name="add_user" value="Ajouter l'utilisateur" onclick="return confirmEnregistrement();">

        </form>
    <?php endif; ?>
</div>



</body>
</html>
