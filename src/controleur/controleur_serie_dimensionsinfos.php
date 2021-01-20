<?php
//------------------------------------------Page pour voir les dimensions et les informations sur les batteries à partir d'un numéro de série-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir les dimensions et les informations sur les batteries à partir d'un numéro de série
    function actionSerieDimensionsInfos($twig,$db){
        if(isset($_POST['btRechercherSer'])){
            $form = array();
            $seriecommandes = new Seriecommandes($db);

            $rechercheSer = $_POST['rechercheSer'];
            $form['rechercheSer'] = $rechercheSer;

            $listeRechercheSer = $seriecommandes->rechercheSer($rechercheSer);
                    
                }

        echo $twig->render('serie-dimensionsinfos.html.twig', array('form'=>$form, 'listeRechercheSer'=>$listeRechercheSer));
    }

?>