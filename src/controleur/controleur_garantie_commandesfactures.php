<?php
//------------------------------------------Page pour voir les commandes et factures qui correspondent à un numéro de garantie-------------------------------------------------------------------------------------------
    //fonction pour la page permettant de voir les commandes et factures qui correspondent à un numéro de garantie
    function actionGarantieCommandesFactures($twig,$db){
        if(isset($_POST['btRechercherGarantie'])){
            $form = array();
            $orderserial = new OrderSerial($db);

            $rechercheGarantie = $_POST['rechercheGarantie'];
            $form['rechercheGarantie'] = $rechercheGarantie;
        
            $listeRechercheGarantie = $orderserial->rechercheGarantie($rechercheGarantie);
                    
                }

        echo $twig->render('garantie-commandesfactures.html.twig', array('form'=>$form, 'listeRechercheGarantie'=>$listeRechercheGarantie));
    }

?>