<?php

$serverName = "localhost";
$userName = "root";
$userDB = "exercice";
$userPassword= "root";

try {
    $conn = new PDO("mysql:host=$serverName; dbname=$userDB", $userName, $userPassword);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

    $requete= $conn->prepare("SELECT * FROM utilisateurs ORDER BY utilisateurs.nom ASC");
    $requete->execute();
    $resultat =$requete->fetchAll(PDO::FETCH_ASSOC);

    // dump($resultat);

    $table="<table class='paleBlueRows'>";
    $table.="<tr>";
    $table.="<th>";
    $table.="ID";
    $table.="</th>";
    $table.="<th>";
    $table.="Nom";
    $table.="</th>";
    $table.="<th>";
    $table.="Prenom";
    $table.="</th>";
    $table.="<th>";
    $table.="Adresse email";
    $table.="</th>";



    $table.="</tr>";

    for($i = 0; $i < COUNT($resultat); $i++){
        // var_dump($resultat[$i]);
        $table.="<tr>";
        // $table.="<td>".$resultat[$i]['nom']."</td>";
        // $table.="<td>".$resultat[$i]['prenom']."</td>";
        foreach($resultat[$i] as $key=>$value) {
            if ($key != "mdp"){
                $table.="<td>".$value."</td>";
            }
        }
        
        $table.="</tr>";

    }
    $table.="</table>";

    echo $table;
    
}

catch (PDOException $e){
    die("Erreur : " . $e->getMessage());
}