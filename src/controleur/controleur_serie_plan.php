<?php
//------------------------------------------Page pour le plan de cyclage et de coffre correspondant à un numéro de série-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir le plan de cyclage et de coffre correspondant à un numéro de série
    function actionSeriePlan($twig,$db){
        if(isset($_POST['btRechercherSerie'])){
            $form = array();
            $seriecommandes = new Seriecommandes($db);

            $rechercheSerie = $_POST['rechercheSerie'];
            $form['rechercheSerie'] = $rechercheSerie;
        
            $listeRechercheSerie = $seriecommandes->rechercheSerie($rechercheSerie);
                    
                }

        echo $twig->render('serie-plan.html.twig', array('form'=>$form, 'listeRechercheSerie'=>$listeRechercheSerie));
    }

?>