<?php
function inclusionAuto (string $homePage) : void
{
    $files = glob('./includes/*.inc.php');
    $page = $_GET['page'] ?? 'home';
    $pageTest = './includes/' . $page . '.inc.php';

    if (!in_array($pageTest, $files)) 
    {
        require_once './includes/' . $homePage. '.inc.php';
    }
    else {
        require_once $pageTest;
    }
}