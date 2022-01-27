<?php

$functionFiles = glob('./functions/*.php');

for ($i = 0 ; $i < count($functionFiles); $i++){
    if ($functionFiles[$i] !== './functions/autoLoad.php') {
        require_once $functionFiles[$i];
    }
}