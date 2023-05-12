 <?php

 // Vérifie si l'utilisateur est connecté
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Récupère le nom d'utilisateur de la session
$username = $_SESSION['username'];


// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');

$action = isset($_GET['action']) ? $_GET['action'] : '';
$faq_id = isset($_GET['id']) ? (int)$_GET['id'] : 0;
$faq_data = ['titre' => '', 'contenu' => ''];

if ($action === 'edit' && $faq_id > 0) {
    // Récupère les informations pour l'entrée spécifiée
    $stmt = $pdo->prepare("SELECT * FROM sujetfaq WHERE id = ?");
    $stmt->execute([$faq_id]);
    $faq_data = $stmt->fetch(PDO::FETCH_ASSOC);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $titre = $_POST['titre'];
    $contenu = $_POST['contenu'];

    if ($action === 'edit' && $faq_id > 0) {
        // Met à jour l'entrée spécifiée
        $stmt = $pdo->prepare("UPDATE sujetfaq SET titre = ?, contenu = ? WHERE id = ?");
        $stmt->execute([$titre, $contenu, $faq_id]);
    } else {
        // Insère une nouvelle entrée
        $stmt = $pdo->prepare("INSERT INTO sujetfaq (titre, contenu) VALUES (?, ?)");
        $stmt->execute([$titre, $contenu]);
    }

    // Redirige vers la page de gestion des FAQ
    header('Location: faq2.php');
    exit;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Gérer les FAQ</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/nfaq2.css">
</head>
<body>

<div class="top-bar">
    <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
        <a href="profil2.php" >Utilisateur</a>
        <a href="Faq2.php">Faq</a>
        <span><?php echo $username; ?>   </span>
    </div>


<div class="container">
    <h1><?php echo $action === 'edit' ? 'Modifier' : 'Ajouter'; ?> une FAQ</h1>
    <form method="POST">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" value="<?php echo htmlspecialchars($faq_data['titre']); ?>" required>

        <label for="contenu">Contenu :</label>
        <textarea name="contenu" required><?php echo htmlspecialchars($faq_data['contenu']); ?></textarea>

        <input type="submit" value="<?php echo $action === 'edit' ? 'Modifier' : 'Ajouter'; ?>">
    </form>
</div>

</body>
</html>
