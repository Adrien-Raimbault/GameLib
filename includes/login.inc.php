<?php

if (isset($_POST['frm'])) {
    $email= htmlentities(trim($_POST['email'])) ?? '';
    $mdp= htmlentities(trim($_POST['mdp'])) ?? '';


    $erreurs = array();
    $message = "Veuillez renseigner votre ";
    $msgErrAlpha = "Veuillez saisir des caractères alphabéthiques";


    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($erreurs, $message . "votre email");

    if (strlen($mdp) === 0)
    array_push($erreurs, $message . "votre mot de passe");
       
    
    // dump($erreurs);
    if (count($erreurs) === 0) {
        $serverName = "localhost";
        $userName = "root";
        $userDB = "exercice";
        $userPassword= "root";


        try {
            $conn = new PDO("mysql:host=$serverName; dbname=$userDB", $userName, $userPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);


            $requete = $conn->prepare("SELECT * FROM UTILISATEURS WHERE mail ='$email'");
            $requete->execute();
            $resultat = $requete->fetchAll(PDO::FETCH_ASSOC);
            
            //____ VERIF DE RESULTAT COUNT  ____\\
            $msgNoConnect = "<p>Merci de renseigner une adresse email et/ou un mot de passe valide</p>";

            if(count($resultat) == 0){
                echo $msgNoConnect;
            }
        
            // var_dump($resultat[0]['mdp']);
            else {
                if (password_verify($mdp, $resultat[0]['mdp'])) {
                    if(!isset($_SESSION['login'])){
                        $_SESSION['login'] = true;
                        $_SESSION['nom'] = $resultat[0]['nom'];
                        $_SESSION['prenom'] = $resultat[0]['prenom'];
                        echo "<script>document.location.replace('http://localhost:8888/GameLib')</script>";
                    }
                } else {
                    echo $msgNoConnect;
                }
            }

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
    $email = $mdp = '';
}

include './includes/frmLogin.php';
?>
<p>Pas encore de compte ? <a href="index.php?page=formulaire">Créer un compte</a> </p>