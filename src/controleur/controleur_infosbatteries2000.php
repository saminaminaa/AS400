<?php
//------------------------------------------Page pour voir les informations sur les batteries à partir de l'année 2000-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir les informations sur les batteries à partir de l'année 2000
    function actionInfosBatteries2000($twig,$db){
            $tacoapp = new TacoApp($db);
            $liste2000 = $tacoapp->select2000();

        echo $twig->render('infosbatteries2000.html.twig', array('liste2000'=>$liste2000));
    }

?>