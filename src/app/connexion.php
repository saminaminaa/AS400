<?php

function connect() {
    try {
        //$db = new PDO('mysql:host=' . $config['serveur'] . ';dbname=' . $config['bd'], $config['login'], $config['mdp']);
        //$db = new PDO("mysql:host=localhost;dbname=db_as400","root","");
        //$db = new PDO("mysql:host=EF00S24;dbname=Histo","AS400_W","Enersys21");
        //$db = new PDO('mysql:host=' . $config['serveur'] . ';dbname=' . $config['bd'], $config['login'], $config['mdp']);
        //$db = new PDO('mssql:host=' . $config['serveur'] . ';dbname=' . $config['bd'], $config['login'], $config['mdp']);
        //$db = new PDO('sqlsrv:Server=' . $config['serveur'] . '\SQLEXPRESS;Database=' . $config['bd'], $config['login'], $config['mdp']);
        $db = new PDO("sqlsrv:Server=EF00S24;Database=Histo", "AS400_W", "Enersys21");
    } 
    catch (Exception $e) {
        $db = NULL;
        /* echo("nous ne trouvons pas de bd"); */
        /* echo "Erreur : " . $e->getMessage(); */
    } 
    return $db;
} 
?>


