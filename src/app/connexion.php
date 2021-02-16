<?php
//Fonction qui permet d'effectuer une connexion à la BD
function connect() {
    try {
        //$db = new PDO("mysql:host=localhost;dbname=db_as400","root",""); //<--Ancienne BD test
        $db = new PDO("sqlsrv:Server=EF00S24;Database=Histo", "AS400_W", "Enersys21");
    } 
    catch (Exception $e) { //exception
        $db = NULL;
        /* echo("nous ne trouvons pas de bd"); */
        /* echo "Erreur : " . $e->getMessage(); */
    } 
    return $db;
} 
?>


