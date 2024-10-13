<?php
require_once('dbase.php');
$message = '';

function clean_input($data){
  return htmlspecialchars(stripslashes(trim($data)));
}

// on pose une condition pour verifier si l'utilisateur à cliquer sur le bouton
if(isset($_POST['create'])) {
    // Nettoyage des entrées pour éviter les injections SQL
    $nom = clean_input($_POST['nom']);
    $prenom = clean_input($_POST['prenom']);
    $mail = clean_input($_POST['mail']);

    if( (empty($nom )) ||  (empty($prenom ))  || (empty($mail ))   ){
        $message = '<p class="error">Veuillez remplir les champs</p>';
    } else {
          // Vérifier si l'adresse e-mail est déjà utilisée
          $sql_check_email = "SELECT COUNT(*) FROM etudiants WHERE mail = ?";
          $req_check_email = $dbase->prepare($sql_check_email);
          $req_check_email->execute([$mail]);
          $email_exists = $req_check_email->fetchColumn();
  
          if ($email_exists) {
              $message = '<p class="error">L\'adresse e-mail est déjà utilisée</p>';
          } else {
        // nous créons la requette sql pour créer un nouveau client et l'inserer dans notre table
        $sql="INSERT INTO `etudiants` (`nom`, `prenom`, `mail`) VALUES  (?,?,?)";
        // on prepare l'insertion à la table
        $req_insert = $dbase ->prepare($sql);

          // on execute ensuite la requette
        $req_insert->execute([$nom, $prenom, $mail]);
        $message = '<p class="success">Etudiant créé avec success</p>';
    }
}
}



?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta chareqet="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./style.css">
    <title>PHP & SQL</title>
</head>
<body>
    <h1>Créer un nouveau ETUDIANT</h1>
    
    <form action="" method="post">
        <input type="text" name="prenom" placeholder="Prenom">
        <br><br>
        <input type="text" name="nom" placeholder="Nom">
        <br><br>
        <input type="email" name="mail" placeholder="Email">
        <br><br>
        <?= $message; ?>
        <br>
    <input type="submit" name="create" value="Créer">
</form>

<a class="lien" href="http://localhost/cours-2024/php-crud-2024/">Retour</a>
    
</body>
</html>
