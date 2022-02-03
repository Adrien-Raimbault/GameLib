<?php

$serverName = "localhost";
$userName = "root";
$userDB = "exercice";
$userPassword= "root";

try {
    $conn = new PDO("mysql:host=$serverName; dbname=$userDB", $userName, $userPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requete= $conn->prepare("SELECT * FROM utilisateurs");
    $requete->execute();
    $resultat =$requete->fetchAll(PDO::FETCH_ASSOC);

    dump($resultat);
    
}

catch (PDOException $e){
    die("Erreur : " . $e->getMessage());
}