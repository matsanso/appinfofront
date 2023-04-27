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
    <a href="Faq.php">Faq</a>
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

            <label for="prenom">
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
    <?php endif; ?>
</div>

</body>
</html>
