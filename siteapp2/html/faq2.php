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
} else {
    // Récupère toutes les FAQ
    $stmt = $pdo->prepare("SELECT * FROM sujetfaq");
    $stmt->execute();
    $all_faq = $stmt->fetchAll(PDO::FETCH_ASSOC);
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
    <!-- Google Translate Widget -->
  <div id="google_translate_element"></div>
  <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'fr'}, 'google_translate_element');
  }
  </script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <!-- End of Google Translate Widget -->
    <title>Gérer les FAQ</title>
    <meta charset="utf-8">
    <link rel="stylesheet" href="../css/nfaq2.css">
</head>
<body>

<div id="top-bar">
    <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
        <a href="profil2.php">Utilisateur</a>
        <a href="faq2.php">Faq</a>
        <a href="addcaserne.php">Caserne</a>
        <span>Bonjour, <?php echo $username; ?> !</span>
    </div>


    <div class="container">
    <h1><?php echo $action === 'edit' ? 'Modifier' : 'Ajouter'; ?> une FAQ</h1>

    <form method="POST">
        <input type="hidden" name="id" value="<?php echo $faq_id; ?>">
        <label for="titre">Titre :</label>
        <input type="text" name="titre" value="<?php echo htmlspecialchars($faq_data['titre']); ?>" required>

        <label for="contenu">Contenu :</label>
        <textarea name="contenu" required><?php echo htmlspecialchars($faq_data['contenu']); ?></textarea>

        <input type="submit" value="<?php echo $action === 'edit' ? 'Modifier' : 'Ajouter'; ?>">
    </form>

    <?php if ($action !== 'edit'): ?>
        <table>
            <thead>
                <tr>
                    <th>Titre</th>
                    <th>Contenu</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($all_faq as $faq): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($faq['titre']); ?></td>
                        <td><?php echo htmlspecialchars($faq['contenu']); ?></td>
                        <td>
                            <a href="?action=edit&id=<?php echo $faq['id']; ?>">Modifier</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    <?php endif; ?>
</div>

</body>
</html>
