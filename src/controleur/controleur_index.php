<?php
//------------------------------------------ACCUEIL-------------------------------------------------------------------------------------------
    //fonction pour la page d'accueil
    function actionAccueil($twig,$db){
    
        echo $twig->render('index.html.twig', array());
    }

?>