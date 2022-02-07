<?php
session_start(); // Créé une session
date_default_timezone_set('Europe/Paris');
setlocale(LC_ALL, 'fr_FR', 'fr', 'FR');


// Auto Load des classes
spl_autoload_register(function ($className){
    include './classes/'. $className . '.class.php';
});

require_once './functions/autoLoad.php';
// dump($_SESSION);

require_once './includes/head.php';
require_once './includes/main.php';
require_once './includes/footer.php';