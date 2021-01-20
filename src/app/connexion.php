<?php

function connect() {
    try {
        //$db = new PDO('mysql:host=' . $config['serveur'] . ';dbname=' . $config['bd'], $config['login'], $config['mdp']);
        $db = new PDO("mysql:host=localhost;dbname=db_as400","root","");
    } 
    catch (Exception $e) {
        $db = NULL;
    } 
    return $db;
} 
?>


