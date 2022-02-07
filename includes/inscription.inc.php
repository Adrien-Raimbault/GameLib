<?php
date_default_timezone_set('Europe/Paris');

if (isset($_POST['inscription'])) {
    $name = htmlentities(trim($_POST['name'])) ?? '';
    $firstname = htmlentities(trim($_POST['firstname'])) ?? '';
    $email = htmlentities(trim($_POST['email'])) ?? '';
    $pseudo = htmlentities(trim($_POST['pseudo'])) ?? '';
    $password = trim(($_POST['password'])) ?? '';
    $passwordVerif = trim(($_POST['passwordVerif'])) ?? '';
    $bio = htmlentities(trim($_POST['bio'])) ?? '';
    $avatar = $_POST['avatar'] ?? '';


    $erreurs = array();
    $message = "Veuillez renseigner votre ";
    $msgErrAlpha = "Veuillez saisir des caractères alphabéthiques";

    // if (strlen($name) === 0)
    //     array_push($erreurs, $message . "votre nom");
    //     elseif (!ctype_alpha($name))
    //     array_push($erreurs, $msgErrAlpha);

    if (preg_match('/(*UTF8)[[:alpha:]]+$/', $name) !== 1)
        array_push($erreurs, "Veuillez saisir votre nom");

    if (strlen($firstname) === 0)
        array_push($erreurs, $message . "votre prénom");
        elseif (!ctype_alpha($firstname))
        array_push($erreurs, $msgErrAlpha);

    if (strlen($pseudo) === 0)
    array_push($erreurs, $message . "votre pseudo");
    if (!filter_var($email, FILTER_VALIDATE_EMAIL))
        array_push($erreurs, $message . "votre email");
    
    if (strlen($password) === 0)
        array_push($erreurs, $message . "votre mot de passe");
        elseif ($password !== $passwordVerif) {
            array_push($erreurs, "Les mots de passe saisis ne sont pas identiques");
        }
    if (strlen($passwordVerif) === 0)
        array_push($erreurs, $message . " verif de mot de passe");
    
    
    if (isset($_FILES['avatar']) && $_FILES['avatar']['error'] == 0){
        // dump($_FILES['avatar']);
        $fileName = "_" . $_FILES['avatar']['name'];
        $fileType = $_FILES['avatar']['type'];
        $fileTmpName = $_FILES['avatar']['tmp_name'];

        $tableauTypes = array("image/jpeg","image/jpg", "image/png", "image/gif");

        if(in_array($fileType, $tableauTypes)){
            // Chemin absolu
            $prepath = getcwd() . '/avatars/';
            //solution pour uploader un fichier du même nom
            $date = date('Ymdhis');
            $fileName = $date . $fileName;
            $path= $prepath . $fileName;

            if(move_uploaded_file($fileTmpName, $path))
                echo "Déplacement avatar effectué";
        }
        else {
            array_push($erreurs, "Erreur type MIME");
        }
    }
    else {
        array_push($erreurs, "Erreur upload " . $_FILES['avatar']['error']);
    }

    // dump($erreurs);
    if (count($erreurs) === 0) {
        $serverName = "localhost";
        $userName = "root";
        $userDB = "GameLib";
        $userPassword= "root";


        try {
            $conn = new PDO("mysql:host=$serverName; dbname=$userDB", $userName, $userPassword);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $password = password_hash($password, PASSWORD_DEFAULT);

            // CHECK BASE DE DONNEES
            // $requete= $conn->prepare("SELECT * FROM users");
            // $requete->execute();
            // $resultat =$requete->fetchAll(PDO::FETCH_ASSOC);
            // dump($resultat);

            $query = $conn->prepare("INSERT INTO users (id_users, name, firstname, email, pseudo, password, bio, avatar) VALUES (:id_users, :name, :firstname, :email, :pseudo, :password, :bio, :avatar)");

            $id_users =  NULL;

            $query->bindParam(':id_users', $id_users);
            $query->bindParam(':name', $name, PDO::PARAM_STR);
            $query->bindParam(':firstname', $firstname);
            $query->bindParam(':email', $email);
            $query->bindParam(':pseudo', $pseudo);
            $query->bindParam(':password', $password);
            $query->bindParam(':bio', $bio, PDO::PARAM_STR);
            $query->bindParam(':avatar', $path, PDO::PARAM_STR);
            // $query->bindParam(':roles_id_role', $roles_id_role);

            $query->execute();
        }
        catch (PDOException $e){
            die("Erreur : " . $e->getMessage());
        }
        
        $conn = null;
        echo "<script>document.location.replace('http://localhost:8888/GameLib/index.php?page=login')</script>";
    }

    else {
        $messageErreur = "<ul>";
        $i = 0;
        do {
            $messageErreur .= "<li class='alert'>*** 😈 ***</br>";
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
    $name = $firstname = $email = $password = $passwordVerif = $pseudo = $bio = '';
}

include './includes/frmInscription.php' ;