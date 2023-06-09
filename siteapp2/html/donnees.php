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

    } else {
      // Aucune donnée de capteurcardiaque trouvée pour l'utilisateur
      echo "<p>Aucune donnée de capteur cardiaque trouvée pour cet utilisateur.</p>";
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
  
      } else {
        // Aucune donnée de capteurSONORE trouvée pour l'utilisateur
        echo "<p>Aucune donnée de capteur sonore trouvée pour cet utilisateur.</p>";
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

  } else {
    // Aucune donnée de capteur temperature trouvée pour l'utilisateur
    echo "<p>Aucune donnée de capteur temperature trouvée pour cet utilisateur.</p>";
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

  } else {
    // Aucune donnée de capteurgaz trouvée pour l'utilisateur
    echo "<p>Aucune donnée de capteur gaz trouvée pour cet utilisateur.</p>";
  }

    
  

?>

<!DOCTYPE html>
<html>
  <head>
    <title>Page d'aide</title>
    <link rel="stylesheet" type="text/css" href="../css/donnees.css">
  </head>

<header>
  <div class="top-bar">
  <a href="../html/index.html"><img src="../images/Mon projet (4).png" alt="Logo"></a>
        <a href="donnees.php" >Données</a>
        <a href="profil.php" >Profil</a>
        <a href="aide.php">Aide</a>
        <span><?php echo $username   ; ?>   </span>
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
            <h2>Informations</h2>
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
                  <td><?php echo $user['identifiant']; ?></td>
                  <td><?php echo $user['nom']; ?></td>
                  <td><?php echo $user['prenom']; ?></td>
                  <td><?php echo $user['email']; ?></td>
                  <td><?php echo $user['telephone']; ?></td>
                  <td><?php echo $user['age']; ?></td>
                  <td><?php echo $user['poids']; ?></td>
                  <td><?php echo $user['taille']; ?></td>
                  <td><?php echo $user['type']; ?></td>
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
            <td><?php echo $idMesureC; ?></td>
          </tr>
          <tr>
            <td><b>Mesure cardiaque :</b></td>
            <td><?php echo $mesureC; ?></td>
          </tr>
          <tr>
            <td><b>Boitier :</b></td>
            <td><?php echo $boitier; ?></td>
          </tr>
          <tr>
            <td><b>Heure :</b></td>
            <td><?php echo $heure; ?></td>
          </tr>
        </table>
      </div>

      <div class="result2">
        <h2>Données de capteur sonore</h2>
        <table>
          <tr>
            <td><b>ID de la mesure :</b></td>
            <td><?php echo $idMesureS; ?></td>
          </tr>
          <tr>
            <td><b>Mesure sonore :</b></td>
            <td><?php echo $mesureS; ?></td>
          </tr>
          <tr>
            <td><b>Boitier :</b></td>
            <td><?php echo $boitier2; ?></td>
          </tr>
          <tr>
            <td><b>Heure :</b></td>
            <td><?php echo $heure2; ?></td>
          </tr>
        </table>
      </div>

      <div class="result3">
        <h2>Données de capteur temperature</h2>
        <table>
          <tr>
            <td><b>ID de la mesure :</b></td>
            <td><?php echo $idMesureT; ?></td>
          </tr>
          <tr>
            <td><b>Mesure de la temperature :</b></td>
            <td><?php echo $mesureT; ?></td>
          </tr>
          <tr>
            <td><b>Boitier :</b></td>
            <td><?php echo $boitier3; ?></td>
          </tr>
          <tr>
            <td><b>Heure :</b></td>
            <td><?php echo $heure3; ?></td>
          </tr>
        </table>
      </div>

      <div class="result4">
        <h2>Données de capteur GAZ</h2>
        <table>
          <tr>
            <td><b>ID de la mesure :</b></td>
            <td><?php echo $idMesureG; ?></td>
          </tr>
          <tr>
            <td><b>Mesure du GAZ :</b></td>
            <td><?php echo $mesureG; ?></td>
          </tr>
          <tr>
            <td><b>Boitier :</b></td>
            <td><?php echo $boitier4; ?></td>
          </tr>
          <tr>
            <td><b>Heure :</b></td>
            <td><?php echo $heure4; ?></td>
          </tr>
        </table>
      </div>

    </div>
  </body>
</html>
