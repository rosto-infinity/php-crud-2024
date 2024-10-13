<?php
// On identifie 3 variables
// Dans le DSN nous récupérons le gestionnaire de notre base de données (ici MySQL), puis l'adresse DSN fournie par votre hébergeur ou localhost pour du local.
$dsn = 'mysql:host=localhost;dbname=php-crud-2024;charset=utf8';
$user = 'root';
$pass = '';

// L'objet PDO va recevoir en premier argument toutes les informations de ma base de données, en deuxième le login et au troisième le mot de passe. On utilise la méthode try catch pour sécuriser le tout en cas d'erreur.
try {
    $dbase = new PDO($dsn, $user, $pass);
    $dbase->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_SILENT);

    
} catch(PDOException $e) {
    echo 'Une erreur est survenue : '.$e->getMessage();
}

