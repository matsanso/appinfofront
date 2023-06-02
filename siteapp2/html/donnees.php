<?php
// Connexion à la base de données
$pdo = new PDO('mysql:host=localhost;dbname=appg10c_db;charset=utf8', 'root', '');

if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
// Récupère le nom d'utilisateur de la session
$username = $_SESSION['username'];



  $search = $username;

    // Prépare la requête SQL pour chercher l'utilisateur correspondant à l'ID ou à l'adresse e-mail
    $stmt = $pdo->prepare("SELECT * FROM utilisateur WHERE identifiant = :search OR email = :search");

    // Exécute la requête SQL avec les paramètres
    $stmt->execute(array(':search' => $search));

    // Récupère l'utilisateur correspondant s'il existe
    $users = array($stmt->fetch(PDO::FETCH_ASSOC));

    // Vérifie si un utilisateur a été trouvé dans la base de données
if ($users) {
    // Utilisateur trouvé, récupère son identifiant
    $idu = $users[0]['identifiant'];
  

    
    // Prépare la requête SQL pour chercher les données de capteurcardiaque correspondant à l'utilisateur
    $stmt = $pdo->prepare("SELECT * FROM capteurcardiaque WHERE idu = :idu");
    // Exécute la requête SQL avec les paramètres
    $stmt->execute(array(':idu' => $idu));
    // Récupère les données de capteurcardiaque correspondant à l'utilisateur s'il en existe
    $capteurcardiaque = $stmt->fetch(PDO::FETCH_ASSOC);
    // Vérifie si des données ont été trouvées dans la base de données
    if ($capteurcardiaque) {
      // Affiche les données de capteurcardiaque correspondant à l'utilisateur
      $idMesureC = $capteurcardiaque['idMesureC'];
      $mesureC = $capteurcardiaque['mesureC'];
      $boitier = $capteurcardiaque['boitier'];
      $heure = $capteurcardiaque['heure'];

    } 


    $stmt = $pdo->prepare("SELECT * FROM capteursonore WHERE idu = :idu");
    $stmt->execute(array(':idu' => $idu));
    $capteursonore = $stmt->fetch(PDO::FETCH_ASSOC);
    // Vérifie si des données ont été trouvées dans la base de données
    if ($capteursonore) {
        // Affiche les données de CAPTEURSONORE correspondant à l'utilisateur
        $idMesureS = $capteursonore['idMesureS'];
        $mesureS = $capteursonore['mesureS'];
        $boitier2 = $capteursonore['boitier'];
        $heure2 = $capteursonore['heure'];
      } 
  }

  
  $stmt = $pdo->prepare("SELECT * FROM capteurtemperature WHERE idu = :idu");
  $stmt->execute(array(':idu' => $idu));
  $capteurtemperature = $stmt->fetch(PDO::FETCH_ASSOC);
  // Vérifie si des données ont été trouvées dans la base de données
  if ($capteurtemperature) {
    // Affiche les données de capteur temperature correspondant à l'utilisateur
    $idMesureT = $capteurtemperature['idMesureT'];
    $mesureT = $capteurtemperature['mesureT'];
    $boitier3 = $capteurtemperature['boitier'];
    $heure3 = $capteurtemperature['heure'];

  } 


  $stmt = $pdo->prepare("SELECT * FROM capteurgaz WHERE idu = :idu");
  $stmt->execute(array(':idu' => $idu));
  $capteurgaz = $stmt->fetch(PDO::FETCH_ASSOC);
  // Vérifie si des données ont été trouvées dans la base de données
  if ($capteurgaz) {
    // Affiche les données de capteurgaz correspondant à l'utilisateur
    $idMesureG = $capteurgaz['idMesureG'];
    $mesureG = $capteurgaz['mesureG'];
    $boitier4 = $capteurgaz['boitier'];
    $heure4 = $capteurgaz['heure'];

  } 

    
  

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Page d'aide</title>
    <link rel="stylesheet" type="text/css" href="../css/aAbdonnees.css">

   

  </head>

<header>
  <div class="top-bar">
  <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
        <a href="donnees.php" >Données</a>
        <a href="aide.php">Aide</a>
        <a href="profil.php">Mon Profil</a>
        <div id="user-menu">
          <span><?php echo $username; ?></span>
          <a href="../html/index.html" class="logout-button">Déconnexion</a>
          <a class="logout-button"> <!-- Google Translate Widget -->
  <div id="google_translate_element"></div>
  <script type="text/javascript">
  function googleTranslateElementInit() {
    new google.translate.TranslateElement({pageLanguage: 'fr'}, 'google_translate_element');
  }
  </script>
  <script type="text/javascript" src="//translate.google.com/translate_a/element.js?cb=googleTranslateElementInit"></script>
  <!-- End of Google Translate Widget --></a>
        </div>
    </div>
  <body>
</header>
  
    <div id="container">
      <h1>Données utilisateur</h1>

      <?php if (isset($error_msg)) { ?>
        <p><?php echo $error_msg; ?></p>
      <?php } ?>

      

      <?php if (isset($users)) { ?>
        <div class="result">
          <?php if (count($users) === 0) { ?>
            <p>Aucun utilisateur trouvé</p>
          <?php } else { ?>
            <h2>Résultats de la recherche</h2>
            <table>
              <thead>
                <tr>
                  <th>ID</th>
                  <th>Nom</th>
                  <th>Prénom</th>
                  <th>Email</th>
                  <th>Téléphone</th>
                  <th>Âge</th>
                  <th>Poids</th>
                  <th>Taille</th>
                  <th>Type de compte</th>
                </tr>
              </thead>
              <tbody>
              <?php foreach ($users as $user) { ?>
                <tr>
                <td><?php echo isset($user['identifiant']) ? $user['identifiant'] : 'No data'; ?></td>
                <td><?php echo isset($user['nom']) ? $user['nom'] : 'No data'; ?></td>
                <td><?php echo isset($user['prenom']) ? $user['prenom'] : 'No data'; ?></td>
                <td><?php echo isset($user['email']) ? $user['email'] : 'No data'; ?></td>
                <td><?php echo isset($user['telephone']) ? $user['telephone'] : 'No data'; ?></td>
                <td><?php echo isset($user['age']) ? $user['age'] : 'No data'; ?></td>
                <td><?php echo isset($user['poids']) ? $user['poids'] : 'No data'; ?></td>
                <td><?php echo isset($user['taille']) ? $user['taille'] : 'No data'; ?></td>
                <td><?php echo isset($user['type']) ? $user['type'] : 'No data'; ?></td>

                </tr>
              <?php } ?>
              </tbody>
            </table>
          <?php } ?>
        </div>
      <?php } ?>

      <div class="result">
  <h2>Données de capteur cardiaque</h2>
  <table>
    <tr>
      <td><b>ID de la mesure :</b></td>
      <td><?php echo isset($idMesureC) ? $idMesureC : 'No data'; ?></td>
    </tr>
    <tr>
      <td><b>Mesure cardiaque :</b></td>
      <td><?php echo isset($mesureC) ? $mesureC : 'No data'; ?></td>
    </tr>
    <tr>
      <td><b>Boitier :</b></td>
      <td><?php echo isset($boitier) ? $boitier : 'No data'; ?></td>
    </tr>
    <tr>
      <td><b>Heure :</b></td>
      <td><?php echo isset($heure) ? $heure : 'No data'; ?></td>
    </tr>
  </table>
</div>

<div class="result2">
  <h2>Données de capteur sonore</h2>
  <table>
    <tr>
      <td><b>ID de la mesure :</b></td>
      <td><?php echo isset($idMesureS) ? $idMesureS : 'No data'; ?></td>
    </tr>
    <tr>
      <td><b>Mesure sonore :</b></td>
      <td><?php echo isset($mesureS) ? $mesureS : 'No data'; ?></td>
    </tr>
    <tr>
      <td><b>Boitier :</b></td>
      <td><?php echo isset($boitier2) ? $boitier2 : 'No data'; ?></td>
    </tr>
    <tr>
      <td><b>Heure :</b></td>
      <td><?php echo isset($heure2) ? $heure2 : 'No data'; ?></td>
    </tr>
  </table>
</div>

<div class="result3">
  <h2>Données de capteur temperature</h2>
  <table>
    <tr>
      <td><b>ID de la mesure :</b></td>
      <td><?php echo isset($idMesureT) ? $idMesureT : 'No data'; ?></td>
    </tr>
    <tr>
      <td><b>Mesure de la temperature :</b></td>
      <td><?php echo isset($mesureT) ? $mesureT : 'No data'; ?></td>
    </tr>
    <tr>
      <td><b>Boitier :</b></td>
      <td><?php echo isset($boitier3) ? $boitier3 : 'No data'; ?></td>
    </tr>
    <tr>
      <td><b>Heure :</b></td>
      <td><?php echo isset($heure3) ? $heure3 : 'No data'; ?></td>
    </tr>
  </table>
</div>

<div class="result4">
  <h2>Données de capteur GAZ</h2>
  <table>
    <tr>
      <td><b>ID de la mesure :</b></td>
      <td><?php echo isset($idMesureG) ? $idMesureG : 'No data'; ?></td>
    </tr>
    <tr>
      <td><b>Mesure du GAZ :</b></td>
      <td><?php echo isset($mesureG) ? $mesureG : 'No data'; ?></td>
    </tr>
    <tr>
      <td><b>Boitier :</b></td>
      <td><?php echo isset($boitier4) ? $boitier4 : 'No data'; ?></td>
    </tr>
    <tr>
      <td><b>Heure :</b></td>
      <td><?php echo isset($heure4) ? $heure4 : 'No data'; ?></td>
    </tr>
  </table>
</div>

    </div>
  </body>
</html>
