<?php
//------------------------------------------Page pour voir les plans qui correspondent à un numéro de garantie-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir les plans qui correspondent à un numéro de garantie
    function actionGarantiePlans($twig,$db){
        if(isset($_POST['btRechercherGarant'])){
            $form = array();
            $tacoapp = new Tacoapp($db);

            $rechercheGarant = $_POST['rechercheGarant'];
            $form['rechercheGarant'] = $rechercheGarant;
        
            $listeRechercheGarant = $tacoapp->rechercheGarant($rechercheGarant);
                    
                }

        echo $twig->render('garantie-plans.html.twig', array('form'=>$form, 'listeRechercheGarant'=>$listeRechercheGarant));
    }

?>