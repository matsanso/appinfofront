<?php
// Vérifie si l'utilisateur est connecté
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}

// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');

// Récupère le nom d'utilisateur de la session
$username = $_SESSION['username'];

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
    $stmt = $pdo->prepare("UPDATE utilisateur SET nom = :nom, prenom = :prenom, email = :email, telephone = :telephone, taille = :taille, poids = :poids, age = :age WHERE email = :email");

    // Exécute la requête SQL avec les paramètres
    $stmt->execute(array(
        ':nom' => $nom,
        ':prenom' => $prenom,
        ':email' => $email,
        ':telephone' => $telephone,
        ':taille' => $taille,
        ':poids' => $poids,
        ':age' => $age,
        ':id' => $id
    ));

    // Redirige vers la page de profil mise à jour
    header('Location: profil2.php');
    exit;
}
// Vérifie si le formulaire de suppression a été soumis
if (isset($_POST['delete'])) {
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

        $stmt = $pdo->prepare("INSERT INTO utilisateur (motDePasse, nom, prenom, email, telephone, taille, poids, age, type) VALUES (:motDePasse, :nom, :prenom, :email, :telephone, :taille, :poids, :age, :type)");

        $stmt->execute(array(
            ':motDePasse' => $hashed_password,
            ':nom' => $nom,
            ':prenom' => $prenom,
            ':email' => $email,
            ':telephone' => $telephone,
            ':taille' => $taille,
            ':poids' => $poids,
            ':age' => $age,
            ':type' => $type
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
</head>
<body>

<div class="top-bar">
    <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
    <a href="profil2.php">Utilisateur</a>
    <a href="Faq2.php">Faq</a>
    <span><?php echo $username; ?>   </span>
</div>

<div class="container">
    <h1>Recherche utilisateur</h1>
    <form method="POST" class="search-form">
        <label for="search_email">Rechercher par email :</label>
        <input type="email" name="search_email">
        <input type="submit" value="Rechercher">
        <?php if (!empty($user)): ?>
        <input type="hidden" name="user_email" value="<?php echo $user['email']; ?>">
        <input type="submit" name="delete" value="Supprimer l'utilisateur" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet utilisateur ?');">
    <?php endif; ?>
</form>

    <?php if (!empty($user)): ?>
        <h2>Profil de <?php echo $user['prenom'] . ' ' . $user['nom']; ?></h2>
        <form method="POST">
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

            <input type="submit" name="update" value="Enregistrer">
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

            <input type="submit" name="add_user" value="Ajouter l'utilisateur">
        </form>
    <?php endif; ?>
</div>



</body>
</html>
