<?php
date_default_timezone_set('Europe/Paris');

if (isset($_POST['frm'])) {
    $nom= htmlentities(trim($_POST['nom'])) ?? '';
    $prenom= htmlentities(trim($_POST['prenom'])) ?? '';
    $email= htmlentities(trim($_POST['email'])) ?? '';
    $pass1 = trim(($_POST['pass1'])) ?? '';
    $pass2 = trim(($_POST['pass2'])) ?? '';

    $erreurs = array();
    $message = "Veuillez renseigner votre ";
    $msgErrAlpha = "Veuillez saisir des caractères alphabéthiques";

    if (strlen($nom) === 0)
        array_push($erreurs, $message . "nom");
    elseif (!ctype_alpha($nom))
        array_push($erreurs, $msgErrAlpha);

    if (strlen($prenom) === 0)
        array_push($erreurs, $message . "votre prénom");
        elseif (!ctype_alpha($prenom))
            array_push($erreurs, $msgErrAlpha);

    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($erreurs, $message . "votre email");
    
    if (strlen($pass1) === 0)
    array_push($erreurs, $message . "votre mot de passe");
        elseif ($pass1 !== $pass2) {
            array_push($erreurs, "Le mot de passe saisi n'est pas identique");
        }
    if (strlen($pass2) === 0)
    array_push($erreurs, $message . " verif de mot de passe");
    
    // dump($erreurs);
    if (count($erreurs) === 0) {
        $serverName = "localhost";
        $userName = "root";
        $userDB = "exercice";
        $userPassword= "root";


        try {
            $conn = new PDO("mysql:host=$serverName; dbname=$userDB", $userName, $userPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $pass1 = password_hash($pass1, PASSWORD_DEFAULT);

            $query = $conn->prepare("
            INSERT INTO UTILISATEURS(id_utilisateur, nom, prenom, mail, mdp) VALUES (?, ?, ?, ?, ?)");

            $query->bindValue(1, null);
            $query->bindValue(2, $nom, PDO::PARAM_STR);
            $query->bindValue(3, $prenom, PDO::PARAM_STR);
            $query->bindValue(4, $email, PDO::PARAM_STR);
            $query->bindValue(5, $pass1, PDO::PARAM_STR);
            $query->execute();
            
            echo "<p>Insertion effectuée</p>";
        }
        catch (PDOException $e){
            die("Erreur : " . $e->getMessage());
        }

        
        $conn = null;

    }

    else {
        $messageErreur = "<ul>";
        $i = 0;
        do {
            $messageErreur .= "<li>";
            $messageErreur .= $erreurs[$i];
            $messageErreur .= "</li>";
            $i++;
        }
        while ($i < count($erreurs));

        $messageErreur .= "</ul>";
        echo $messageErreur;
    }

} else {
    echo "Merci de renseigner le formulaire";
    $nom = $prenom = $email = $pass1 = $pass2 = '';
}


include './includes/frmFormulaire.php' ;
