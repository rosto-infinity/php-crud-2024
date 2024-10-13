<!-- On inclus notre fichier avec la méthode require et require_once pour l'appeler une seul fois -->
<?php
// Inclusion du fichier de base de données
require_once('dbase.php');

// Requête SQL pour sélectionner tous les étudiants dans l'ordre décroissant de leur ID
$sql = "SELECT * FROM etudiants ORDER BY id DESC";

// Préparation de la requête
$req_select = $dbase ->prepare($sql);

// Exécution de la requête
$req_select->execute();

?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <link rel="stylesheet" href="./style.css">
    <title>CRUD PHP & SQL</title>
</head>
<body>

<h1>Liste des étudiants</h1>

<table>
    <thead>
        <tr>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Mail</th>
            <th>Actions</th>
</tr>
    </thead>
    <tbody>
<?php 
while( $donnees = $req_select-> fetch(PDO::FETCH_ASSOC)){
?>
        <tr>
            <td><?= $donnees['nom'] ?></td>
            <td><?= $donnees['prenom'] ?></td>
            <td><?= $donnees['mail'] ?></td>
            <td>
                <a class="action update" href="update.php?id=<?= $donnees['id']; ?>">Update</a>
                <a class="action delete" href="delete.php?id=<?= $donnees['id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet étudiant ?');">Delete</a>
            </td>
        </tr>
<?php } ?>

    </tbody>
</table>

<a class="lien" href="create.php">Créer un nouveau Etudiant</a>

</body>
</html>



